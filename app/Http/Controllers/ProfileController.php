<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        if ( $this->isStudent() ) {
        	$student = Student::where("user_id", "=", auth()->user()->id )->first();

        	return view("profile.index", compact("student"));
		} else {
        	return redirect("/");
		}
    }

    public function edit( $id )
    {
		if ( $this->isStudent() ) {
			$student = Student::select("students.*", "users.name", "users.email")
				->join("users", "students.user_id", "=", "users.id")
				->where("students.user_id", "=", auth()->user()->id )
				->firstOrFail();
			$departments = DB::table("departments")->get();

			return view("profile.edit", compact("student", "departments"));
		} else {
			return redirect("/");
		}
    }

    public function update(Request $request, $id)
    {
		$rules = [
			"name" => [ "required", "min:2", "max:60" ],
			"email" => [ "required", "email", "unique:users,email,$id,id" ],
			"password" => [ "same:cpassword"],
			"level" => [ "required" ],
			"department" => [ "required" ],
		];
		$file_to_store = $this->handleImageAndGetFileToStore( $request, "image");

		$request->validate($rules);

		$student = Student::findOrFail( id );
		if ( $file_to_store == "student.jpg" ) {
			$file_to_store = $student->image;
		}

		$student->update([
			"phone" => $request->phone,
			"level" => $request->level,
			"department_id" => $request->department,
			"image" => $file_to_store
		]);

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
