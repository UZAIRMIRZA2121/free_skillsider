<?php

// database/migrations/xxxx_xx_xx_create_test_results_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestResultsTable extends Migration
{
    public function up()
    {
        Schema::create('test_results', function (Blueprint $table) {
            $table->id();  // Auto-incrementing ID
            $table->unsignedBigInteger('user_id');  // Foreign key to users table
            $table->unsignedBigInteger('course_id');  // Foreign key to courses table
            $table->enum('status', ['passed', 'failed'])->nullable();  // Status (Passed/Failed)
            $table->enum('sub_status', ['start', 'end'])->default('start');  // Sub-status (Start/End)
            $table->timestamps();  // Created and updated timestamps

            // Foreign key constraints
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('test_results');
    }
}
