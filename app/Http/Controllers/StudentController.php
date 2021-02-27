<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
	public function index()
    {
		if( $this->isAdmin() ) {
			$students = Student::select("students.*", "users.name", "users.email")
				->join("users", "students.user_id" , "=", "users.id")
				->get();

			return view("students.index")->withStudents( $students );
		} elseif ( $this->isProfessor() ) {
			$students = Student::select("students.*", "users.name", "users.email")
				->join("users", "students.user_id" , "=", "users.id")
				->where("faculty_id" , "=", $this->faculty_id() )
				->get();

			return view("students.index")->withStudents( $students );
		} else {
			return redirect("/");
		}
    }

    public function create()
    {
    	if ( $this->isAdmin() ) {
			$faculties = DB::table("faculties")->get();
			$departments = DB::table("departments")->get();

			return view("students.add")->with([
				"faculties" => $faculties,
				"departments" => $departments
			]);
		} elseif ( $this->isProfessor() ) {
			$departments = DB::table("departments")
				->where("faculty_id", "=", $this->faculty_id() )
				->get();

			return view("students.add")->with([
				"departments" => $departments
			]);
		} else {
    		return redirect("/");
		}
    }

    public function store(Request $request)
    {
        $rules = $this->getRules();
        $file_to_store = $this->handleImageAndGetFileToStore( $request, "image" );

        $request->validate($rules);

        $user = User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make( $request->password ),
			"type" => 1
        ]);

        if ( $this->isAdmin() ) {
			Student::create([
				"user_id" => $user->id,
				"phone" => $request->phone,
				"level" => $request->level,
				"faculty_id" => $request->faculty,
				"department_id" => $request->department,
				"image" => $file_to_store
			]);
		} elseif( $this->isProfessor() ) {
			Student::create([
				"user_id" => $user->id,
				"phone" => $request->phone,
				"level" => $request->level,
				"faculty_id" => $this->faculty_id(),
				"department_id" => $request->department,
				"image" => $file_to_store
			]);
		}

        return redirect("students");
    }

    public function show(Student $student)
    {
    	if ( $this->isStudent()
			|| ( $this->isProfessor() && $student->faculty_id != $this->faculty_id() )
		) {
    		return redirect("/");
		} else {
			$student = Student::select("students.*", "users.name", "users.email")
				->join("users", "students.user_id" , "=", "users.id")
				->where("students.id", "=", $student->id)
				->firstOrFail();
			return view("students.show", compact("student"));
		}
    }

    public function edit(Student $student)
    {
		if ( $this->isStudent()
			|| ( $this->isProfessor() && $student->faculty_id != $this->faculty_id() )
		) {
			return redirect("/");
		} elseif ( $this->isAdmin() ) {
			$student = Student::select("students.*", "users.name", "users.email")
				->join("users", "students.user_id", "=", "users.id")
				->where("students.id", "=", $student->id)
				->firstOrFail();
			$departments = DB::table("departments")->get();

			$faculties = DB::table("faculties")->get();

			return view("students.edit", compact("student", "departments", "faculties"));
		} else {
			$student = Student::select("students.*", "users.name", "users.email")
				->join("users", "students.user_id", "=", "users.id")
				->where("students.id", "=", $student->id)
				->firstOrFail();
			$departments = DB::table("departments")
				->where("faculty_id", "=", $this->faculty_id() )
				->get();

			return view("students.edit", compact("student", "departments"));
		}
    }

    public function update(Request $request, Student $student)
    {
        $rules = $this->getRules( $student->user_id );
        $file_to_store = $this->handleImageAndGetFileToStore( $request, "image");

        $request->validate($rules);

        $student = Student::findOrFail( $student->id );
        if ( $file_to_store == "student.jpg" ) {
            $file_to_store = $student->image;
        }

        $student->update([
            "phone" => $request->phone,
            "level" => $request->level,
            "department_id" => $request->department,
            "image" => $file_to_store
        ]);

        if ( $this->isAdmin() ) {
        	$student->update([
				"faculty_id" => $request->faculty,
			]);
		}

        $student->save();

        $user = User::findOrFail( $student->user_id );

        $user->update([
            "name" => $request->name,
            "email" => $request->email
        ]);

        if ( $request->password != "" ) {
            $user->update([
                "password" => Hash::make( $request->password )
            ]);
        }

        $user->save();

        return redirect("students");
    }

    public function destroy(Student $student)
    {
		if ( $this->isStudent()
			|| ( $this->isProfessor() && $student->faculty_id != $this->faculty_id() )
		) {
			return redirect("/");
		} else {
			$student = Student::findOrFail($student->id);
			$student->delete();
			return redirect("students");
		}
    }

    private function getRules( $id = 0 ) {
        return [
            "name" => [ "required", "min:2", "max:60" ],
            "email" => [ "required", "email", "unique:users,email,$id,id" ],
            "password" => $id == 0 ? [ "required", "same:cpassword" ] : [ "same:cpassword"],
            "phone" => [ "required", "unique:students,phone" ],
            "level" => [ "required" ],
            "faculty" => $this->isAdmin() ? [ "required" ] : [],
            "department" => [ "required" ],
        ];
    }

    private function handleImageAndGetFileToStore( $request,$key ) {
        if ( $request->file( $key ) ) {
            $image = $request->file( $key );
            $filename = $image->getClientOriginalName();
            $fileExtension = $image->getClientOriginalExtension();
            $file_to_store = time() . '' . explode('.', $filename )[0] . '.' . $fileExtension;

            $image->move( 'images/students/', $file_to_store );

            return $file_to_store;
        } else {
            return "student.jpg";
        }
    }
}
