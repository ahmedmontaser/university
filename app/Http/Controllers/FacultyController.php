<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use Illuminate\Http\Request;

class FacultyController extends Controller
{
    public function index()
    {
		if( $this->isAdmin() ) {
			$faculties = Faculty::all();

			return view("faculties.index", compact("faculties") );
		} else {
			return redirect("/");
		}
    }

    public function create()
    {
		if ( $this->isAdmin() ) {
			return view("faculties.add");
		} else {
			return redirect("/");
		}
    }

    public function store(Request $request)
    {
		if ( $this->isAdmin() ) {
			$rules = $this->getRules();

			$request->validate($rules);
			Faculty::create([
				"faculty" => $request->name,
			]);
			return redirect("faculties");
		} else {
			return redirect("/");
		}
    }

    public function show(Faculty $faculty)
    {
		if ( $this->isAdmin() ) {
			$faculty = Faculty::where("faculties.id", "=", $faculty->id)->firstOrFail();

			return view("faculties.show", compact("faculty"));
		} else {
			return redirect("/");
		}
    }

    public function edit(Faculty $faculty)
    {
        if( $this->isAdmin() ) {
			$faculty = Faculty::where("faculties.id", "=", $faculty->id)->firstOrFail();

			return view("faculties.edit", compact("faculty"));
		} else {
			return redirect("/");
		}
    }

    public function update(Request $request, Faculty $faculty) {
		if ( $this->isAdmin() ) {
			$rules = $this->getRules();

			$request->validate($rules);

			$faculty = Faculty::findOrFail($faculty->id);

			$faculty->update([
				"faculty" => $request->name
			]);

			$faculty->save();

			return redirect("faculties");
		} else {
			return redirect("/");
		}

    }

    public function destroy(Faculty $faculty)
    {
		if ( $this->isAdmin() ) {
			$faculty = Faculty::findOrFail($faculty);
			$faculty->destroy();
			return redirect("faculties");
		} else {
			return redirect("/");
		}
    }

	private function getRules(): array {
		return [
			"name" => [ "required", "min:2", "max:60" ]
		];
	}
}
