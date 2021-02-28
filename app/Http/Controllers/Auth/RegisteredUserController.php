<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Professor;
use App\Models\Student;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RegisteredUserController extends Controller
{
    public function index()
    {
        return view('auth.register.index');
    }

    public function student() {
        $faculties = DB::table("faculties")->get();
        $departments = DB::table("departments")->get();

        return view("auth.register.student")->with([
            "faculties" => $faculties,
            "departments" => $departments
        ]);
    }

    public function professor() {
    $faculties = DB::table("faculties")->get();

    return view("auth.register.professor")->with([
        "faculties" => $faculties,
    ]);
}

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        if ( $request->user_type == "student" ) {
            $rules = [
                "name" => [ "required", "min:2", "max:60" ],
                "email" => [ "required", "email", "unique:users,email" ],
                "password" => [ "required", "same:cpassword" ],
                "phone" => [ "required", "unique:students,phone" ],
                "level" => [ "required" ],
                "faculty" =>[ "required" ],
                "department" => [ "required" ],
            ];
            $file_to_store = $this->handleImageAndGetFileToStore( $request, "image", "studnets" );

            $request->validate($rules);

            $user = User::create([
                "name" => $request->name,
                "email" => $request->email,
                "password" => Hash::make( $request->password ),
                "type" => 1
            ]);

            Student::create([
                "user_id" => $user->id,
                "phone" => $request->phone,
                "level" => $request->level,
                "faculty_id" => $request->faculty,
                "department_id" => $request->department,
                "image" => $file_to_store
            ]);


        } elseif ( $request->user_type == "professor" ) {
            $rules = [
                "name" => [ "required", "min:2", "max:60" ],
                "email" => [ "required", "email", "unique:users,email" ],
                "password" => [ "required", "same:cpassword" ],
                "faculty" => [ "required" ],
            ];

            $request->validate($rules);

            $user = User::create([
                "name" => $request->name,
                "email" => $request->email,
                "password" => Hash::make( $request->password ),
                "type" => 2
            ]);

            Professor::create([
                "user_id" => $user->id,
                "faculty_id" => $request->faculty,
            ]);
        } else {
            abort(500);
        }

        Auth::login($user);

        event(new Registered($user));

        return redirect(RouteServiceProvider::HOME);
    }

    private function handleImageAndGetFileToStore( $request,$key, $folder ) {
        if ( $request->file( $key ) ) {
            $image = $request->file( $key );
            $filename = $image->getClientOriginalName();
            $fileExtension = $image->getClientOriginalExtension();
            $file_to_store = time() . '' . explode('.', $filename )[0] . '.' . $fileExtension;

            $image->move( 'images/' . $folder . '/', $file_to_store );

            return $file_to_store;
        } else {
            if ( $folder == "students" ) {
                return "student.jpg";
            } else {
                return "professor.jpg";
            }
        }
    }
}
