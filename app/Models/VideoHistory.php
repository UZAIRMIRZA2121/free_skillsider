<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'course_id',
        'video_id',
        'watched',
    ];

    /**
     * Define the relationship with the User model.
     * A video history belongs to a user.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Define the relationship with the Course model.
     * A video history belongs to a course.
     */
    public function course()
    {
        return $this->belongsTo(Courses::class);
    }

    /**
     * Define the relationship with the Video model.
     * A video history belongs to a video.
     */
    public function video()
    {
        return $this->belongsTo(Videos::class);
    }
}
