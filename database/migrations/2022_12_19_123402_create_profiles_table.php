<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->text('lname');
			$table->text('phone');
			$table->text('gender');
			$table->foreignId('classroom_id')->constrained('classrooms')->cascadeOnUpdate()->cascadeOnDelete();
			$table->foreignId('school_grade_id')->constrained('school_grades')->cascadeOnUpdate()->cascadeOnDelete();
			$table->foreignId('user_id')->constrained('users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profiles');
    }
};
