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
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->text('question');
			$table->text('description');
			$table->foreignId('subject_id')->constrained('subjects')->cascadeOnUpdate()->cascadeOnDelete();
			$table->foreignId('lesson_id')->constrained('lessons')->cascadeOnUpdate()->cascadeOnDelete();
			$table->foreignId('unit_id')->constrained('units')->cascadeOnUpdate()->cascadeOnDelete();
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
        Schema::dropIfExists('questions');
    }
};
