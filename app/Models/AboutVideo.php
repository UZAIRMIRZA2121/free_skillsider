<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutVideo extends Model
{
    use HasFactory;
    protected $fillable = [
        'video_thumbnail',
        'video_link', 
    ];
}
