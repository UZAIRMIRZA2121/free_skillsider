<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EarningReward extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'reward','target_amount', 'image', 'start_date', 'end_date'];
}
