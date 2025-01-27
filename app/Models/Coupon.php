<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    
    use HasFactory;
    protected $fillable = ['name','code', 'percentage','status','pck_id','start_time','end_time'];
    
    public function packages()
    {
        return $this->belongsToMany(Packages::class, 'coupons', 'coupon_id', 'pck_id');
    }
    
}
