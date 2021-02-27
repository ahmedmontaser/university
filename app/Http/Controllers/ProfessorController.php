<?php

namespace App\Http\Controllers;

use App\Models\Professor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProfessorController extends Controller
{
	public function index()
	{
		if( $this->isAdmin() ) {
			$professors = Professor::select("professors.*", "users.name", "users.email")
				->join("users", "professors.user_id" , "=", "users.id")
				->get();

			return view("professors.index", compact("professors"));
		} else {
			return redirect("/");
		}
	}

	public function create()
	{
		if ( $this->isAdmin() ) {
			$faculties = DB::table("faculties")->get();

			return view("professors.add")->with([
				"faculties" => $faculties
			]);
		} else {
			return redirect("/");
		}
	}

	public function store(Request $request)
	{
		if ( $this->isAdmin() ) {
			$rules = $this->getRules();
			// $request->validate($rules);

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
		}

		return redirect("professors");
	}

	public function show(Professor $professor)
	{
		if ( $this->isAdmin() ) {
			$professor = Professor::select("professors.*", "users.name", "users.email")
				->join("users", "professors.user_id" , "=", "users.id")
				->where("professors.id", "=", $professor->id)
				->firstOrFail();
			return view("professors.show", compact("professor"));
		} else {
			return redirect("/");
		}
	}

	public function edit(Professor $professor)
	{
		if ( $this->isAdmin() ) {
			$professor = Professor::select("professors.*", "users.name", "users.email")
				->join("users", "professors.user_id", "=", "users.id")
				->where("professors.id", "=", $professor->id)
				->firstOrFail();
			$faculties = DB::table("faculties")->get();

			return view("professors.edit", compact("professor", "faculties"));
		} else {
			return redirect("/");
		}
	}

	public function update(Request $request, Professor $professor)
	{
		if ( $this->isAdmin() ) {

			$rules = $this->getRules($professor->user_id);

			$request->validate($rules);

			$professor = Professor::findOrFail( $professor->id );

			$professor->update([
				"faculty_id" => $request->faculty,
			]);

			$professor->save();

			$user = User::findOrFail( $professor->user_id);

			$user->update([
				"name" => $request->name,
				"email" => $request->email
			]);

			if ( $request->password != "" ) {
				$user->update([
					"password" => Hash::make($request->password)
				]);
			}

			$user->save();

			return redirect("professors");
		} else {
			return redirect("/");
		}
	}

	public function destroy(Professor $professor)
	{
		if ( $this->isAdmin() ) {
			$professor = Professor::findOrFail( $professor );
			$professor->destroy();
			return redirect("professors");
		} else {
			return redirect("");
		}
	}

	private function getRules( $id = 0 ) {
		return [
			"name" => [ "required", "min:2", "max:60" ],
			"email" => [ "required", "email", "unique:users,email,$id,id" ],
			"password" => $id == 0 ? [ "required", "same:cpassword" ] : [ "same:cpassword"],
			"faculty" => [ "required" ],
		];
	}
}
