<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Earning extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'user_by_id',
        'amount',
        'percentage',
        'percentage_type',
        'status',
        'package_id',
        
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    
}
