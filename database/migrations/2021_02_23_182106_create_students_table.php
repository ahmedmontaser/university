<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id("id");
            $table->bigInteger("user_id")->unsigned();
            $table->string("level");
            $table->string("phone")->unique()->nullable();
            $table->string("image")->nullable();
            $table->bigInteger("faculty_id")->unsigned();
            $table->bigInteger("department_id")->unsigned();


            $table->foreign("user_id")->references("id")
                ->on("users")->onUpdate("CASCADE")->onDelete("CASCADE");
            $table->foreign("faculty_id")->references("id")
                ->on("faculties")->onUpdate("CASCADE")->onDelete("CASCADE");
            $table->foreign("department_id")->references("id")
                ->on("departments")->onUpdate("CASCADE")->onDelete("CASCADE");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}
