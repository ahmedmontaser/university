<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Faculty;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
	public function index()
    {
        if( $this->isAdmin() ) {
			$departments = Department::all();
		} elseif( $this->isProfessor() ) {
			$departments = Department::where("faculty_id" , "=", $this->faculty_id() )->get();
        } else {
        	return redirect("/");
		}

		return view("departments.index", compact("departments"));
    }

    public function create()
    {
		if ( $this->isAdmin() ) {
			$faculties = Faculty::all();

			return view("departments.add", compact("faculties") );
		} elseif( $this->isProfessor() ) {
			return view("departments.add" );
		} else {
			return redirect("/");
		}
    }

    public function store(Request $request)
    {
		$rules = $this->getRules();

		$request->validate($rules);

		if ( $this->isAdmin() ) {
			Department::create([
				"department" => $request->name,
				"faculty_id" => $request->faculty
			]);

			return redirect("departments");
		} elseif ( $this->isProfessor() ) {
			Department::create([
				"department" => $request->name,
				"faculty_id" => $this->faculty_id()
			]);

			return redirect("departments");
		} else {
			return redirect("/");
		}
    }

    public function show(Department $department)
    {
		if ( $this->isAdmin()
			||  ( $this->isProfessor() && $department->faculty->id == $this->faculty_id() )
		) {
			$department = Department::where("departments.id", "=", $department->id)->firstOrFail();

			return view("departments.show", compact("department"));
		} else {
			return redirect("/");
		}
    }

    public function edit(Department $department)
    {
		if( $this->isAdmin() ) {
			$department = Department::where("departments.id", "=", $department->id)->firstOrFail();
			$faculties = Faculty::all();

			return view("departments.edit", compact("department", "faculties") );
		} elseif( $this->isProfessor() ) {
			$department = Department::where("departments.id", "=", $department->id)->firstOrFail();

			return view("departments.edit", compact("department") );
		} else {
			return redirect("/");
		}
    }

    public function update(Request $request, Department $department)
    {
		$rules = $this->getRules();

		$request->validate($rules);
		$department = Department::findOrFail( $department->id );

		if( $this->isAdmin() ) {

			$department->update([
				"department" => $request->name,
				"faculty_id" => $request->faculty
			]);

			$department->save();

			return redirect("departments");
		} elseif ( $this->isProfessor() ) {
			$department->update([
				"department" => $request->name,
			]);

			$department->save();

			return redirect("departments");
		} else {
			return redirect("/");
		}
    }

    public function destroy(Department $department)
    {
		if ( $this->isAdmin()
			||  ( $this->isProfessor() && $department->faculty->id == $this->faculty_id() )
		) {
			$department = Department::findOrFail($department->id);
			$department->delete();
			return redirect("departments");
		} else {
			return redirect("/");
		}
    }

	private function getRules(): array {
		return [
			"name" => [ "required", "min:2", "max:60" ],
			"faculty" => $this->isAdmin() ? [ "required" ] : []
		];
	}
}
