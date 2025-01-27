<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Videos;
class Reviews extends Model
{
    use HasFactory;
    protected $fillable = [
        'video_id', 
        'review',  
        'video_thumbnail',  
    ];
    // public function courses()
    // {
    //     return $this->belongsTo(courses::class);
    // }
      public function video()
    {
        return $this->belongsTo(Videos::class, 'video_id');
    }
}
