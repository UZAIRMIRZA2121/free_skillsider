<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarketToolLink extends Model
{
    use HasFactory;

    protected $fillable = ['mt_id', 'name', 'link'];

    // Relationship with MarketTool
    public function marketTool()
    {
        return $this->belongsTo(MarketTool::class, 'mt_id');
    }
}
