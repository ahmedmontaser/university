<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [ "user_id", "level", "faculty_id", "department_id", "image", "phone" ];

    public function faculty() {
    	return $this->belongsTo( Faculty::class );
	}

	public function department() {
		return $this->belongsTo( Department::class );
	}


}
