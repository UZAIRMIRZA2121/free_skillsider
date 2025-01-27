<?php

// app/Models/TestResult.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestResult extends Model
{
    use HasFactory;

    // Define the table name if it's not the plural of the model name
    protected $table = 'test_results';

    // Allow mass assignment for these fields
    protected $fillable = [
        'user_id',
        'course_id',
        'status',
        'sub_status',
    ];

    // Define relationship with User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Define relationship with Course model
    public function course()
    {
        return $this->belongsTo(Courses::class);
    }
}
