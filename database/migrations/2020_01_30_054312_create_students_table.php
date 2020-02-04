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
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('gender');
            $table->date('dob');
            $table->unsignedInteger('class_id');
            $table->timestamps();

            $table->softDeletes();
            $table->foreign('class_id')
                ->references('id')
                ->on('classes');

//            $table->foreign('stream_id')
//                ->references('id')
//                ->on('streams');
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
