<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class package_upgrade extends Model
{
    use HasFactory;
    protected $fillable = [
        'package_id',
        'user_id',
        'payment_image',
        'message',
        'trx_id',
        'amount',
        'status',
    ];
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function package()
    {
        return $this->belongsTo(Packages::class,'package_id');
    }
}
