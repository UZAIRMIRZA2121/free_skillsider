<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Courses extends Model
{
    use HasFactory;
    protected $fillable = [
        'course_title',
        'image',
        'course_type',
        'course_seq',
        
    ];
    public function videos()
    {
        return $this->hasMany(Videos::class);
    }
    public function packages()
{
    return $this->hasMany(Package::class, 'course_id');  // Make sure the foreign key is correct (i.e., course_id)
}
    
}
