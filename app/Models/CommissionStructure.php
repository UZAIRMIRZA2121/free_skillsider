<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommissionStructure extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'commission_structures';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_package',
        'second_package',
        'amount',
        'status',
    ];

    public function firstPackage()
    {
        return $this->belongsTo(Packages::class, 'first_package');
    }

    /**
     * Get the second package associated with the commission structure.
     */
    public function secondPackage()
    {
        return $this->belongsTo(Packages::class, 'second_package');
    }
}
