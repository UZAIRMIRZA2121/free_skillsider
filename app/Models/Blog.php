<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'desc',
        'img',
        'long_desc',
    ];
    public function user()
    {
        return $this->belongsTo(User::class); // Each blog belongs to a user
    }
}
