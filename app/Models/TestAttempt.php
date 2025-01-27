<?php

// app/Models/TestAttempt.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestAttempt extends Model
{
    use HasFactory;

    // Define the table name if it's not the plural of the model name
    protected $table = 'test_attempts';

    // Allow mass assignment for these fields
    protected $fillable = [
        'test_id',
        'question_id',
        'correct_option',
        'selected_option',
    ];

    // Define the relationship with TestResult (test_results table)
    public function testResult()
    {
        return $this->belongsTo(TestResult::class, 'test_id');
    }

    // Define the relationship with Question (questions table)
    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id');
    }
}
