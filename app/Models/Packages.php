<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Packages extends Model
{
    use HasFactory;

    protected $fillable = [
        'package_title',
        'price',
        'first_percentage',
        'second_percentage',
        'image',
        'description',
        'user_id',
        'course_id',
        'color_code',
        'text_color_code',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
   // In the Packages model
public function course()
{
    return $this->belongsTo(Courses::class, 'course_id');  // Adjust 'course_id' if necessary
}


}
