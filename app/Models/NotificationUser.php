<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationUser extends Model
{
    use HasFactory;

    // Specify the table name if it is not the plural of the model name
    protected $table = 'notification_user';

    // Fillable attributes
    protected $fillable = [
        'notification_id',
        'user_id',
        'is_read',
    ];

    // Relationships
    public function notification()
    {
        return $this->belongsTo(Notification::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
