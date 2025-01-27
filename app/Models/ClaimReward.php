<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClaimReward extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'reward_id', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reward()
    {
        return $this->belongsTo(EarningReward::class);
    }
}
