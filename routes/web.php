<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
	if( auth()->user() == null ) {
		return redirect("login");
	} else {
		if ( auth()->user()->type == 3 ) {
			return redirect("faculties");
		} elseif ( auth()->user()->type == 2 ) {
			return redirect("departments");
		} elseif ( auth()->user()->type == 1 ) {
			return redirect("profile");
		} else {
			abort(500);
		}
	}
});

Route::resource("students", "StudentController")->middleware(["auth"]);
Route::resource("faculties", "FacultyController")->middleware([ "auth" ]);
Route::resource("departments", "DepartmentController")->middleware(["auth"]);
Route::resource("professors", "ProfessorController")->middleware(["auth"]);
Route::resource("profile", "ProfileController")->middleware(["auth"]);

require __DIR__.'/auth.php';
