<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function isAdmin() {
    	return \auth()->user()->type == 3;
	}

	protected function isProfessor() {
    	return \auth()->user()->type == 2;
	}

	protected function isStudent() {
    	return \auth()->user()->type == 1;
	}

	protected function faculty_id() {
    	$id = \auth()->user()->id;
    	$professor = DB::table("professors")
			->where("user_id", "=", $id )
			->first();
    	return $professor->faculty_id;
	}

}
