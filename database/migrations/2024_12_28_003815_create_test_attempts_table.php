<?php
// database/migrations/xxxx_xx_xx_create_test_attempts_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestAttemptsTable extends Migration
{
    public function up()
    {
        Schema::create('test_attempts', function (Blueprint $table) {
            $table->id();  // Auto-incrementing ID
            $table->unsignedBigInteger('test_id');  // Foreign key to test_results table
            $table->unsignedBigInteger('question_id');  // Foreign key to questions table
            $table->integer('correct_option');  // The correct option for the question
            $table->integer('selected_option');  // The option selected by the user
            $table->timestamps();  // Created and updated timestamps

            // Foreign key constraints
            $table->foreign('test_id')->references('id')->on('test_results')->onDelete('cascade');
            $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('test_attempts');
    }
}
