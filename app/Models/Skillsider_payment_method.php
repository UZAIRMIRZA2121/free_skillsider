<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skillsider_payment_method extends Model
{
    use HasFactory;
    protected $fillable = [
        'bank', 
        'account_name',
        'account_number', 
        'logo', 
        'user_id', 
    ];
}
