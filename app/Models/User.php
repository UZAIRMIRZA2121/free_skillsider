<?php

namespace App\Models;

use App\Models\Earning;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'phone',
        'token',
        'state',
        'role',
        'status',
        'commission',
        'referral_by',
        'referral_code',
        'coupen_code',
        'paid_amount',
        'trx_id',
        'package_id',
        'profile_photo_path',
        'rank',
        'id_card_name',
        'id_card_number',
        'gender',
        'address',
        'city',
        'pin_code',
        'dob',
        'verified_at'

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function package()
{
    return $this->belongsTo(Packages::class);
}
public function earnings()
{
    return $this->hasMany(Earning::class);
}

  // Many to Many relationship with notifications through the pivot table
 
  public function notifications()
  {
      return $this->belongsToMany(Notification::class, 'notification_user')->withPivot('is_read');
  }
  // Get unread notifications count
  public function unreadNotifications()
  {
      return $this->notifications()->where('is_read', 0);
  }

}
