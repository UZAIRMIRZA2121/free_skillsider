<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarketTool extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'img'];

    // Relationship with MarketToolLink
    public function links()
    {
        return $this->hasMany(MarketToolLink::class, 'mt_id');
    }
}
