<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; 

class Videos extends Model
{
    use HasFactory;
    protected $fillable = [
        'video_seq',
        'video_title', 
        'video_link', 
        'courses_id', 
        'video_duration', 
        'video_type', 
        'resource_link', 
        'resource_text', 
    ];
    // public function courses()
    // {
    //     return $this->belongsTo(courses::class);
    // }
    public function courses()
    {
        return $this->belongsTo(Courses::class,'courses_id');
    }
}
