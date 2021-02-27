<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Professor extends Model
{
    use HasFactory;

    protected $fillable = [ "faculty_id", "user_id" ];

	public function faculty() {
		return $this->belongsTo( Faculty::class );
	}
}
