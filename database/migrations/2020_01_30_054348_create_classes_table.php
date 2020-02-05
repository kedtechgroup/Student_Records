<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
//            $table->string('ClassNameNumeric');
//            $table->string('section');
            $table->unsignedInteger('teacher_id');
            $table->unsignedInteger('stream_id');
            $table->timestamps();

            $table->foreign('stream_id')->references('id')->on('streams');
            $table->foreign('teacher_id')->references('id')->on('teachers');
        });

        Schema::create('classes_student', function (Blueprint $table) {
            $table->unsignedInteger('student_id');
            $table->unsignedInteger('class_id');
            $table->timestamp('start_date')->nullable();
            $table->timestamp('end_date')->nullable();
            $table->timestamps();

            $table->foreign('student_id')->references('id')->on('students');
            $table->foreign('class_id')->references('id')->on('classes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('classes');
        Schema::dropIfExists('classes_student');
        Schema::enableForeignKeyConstraints();
    }
}
