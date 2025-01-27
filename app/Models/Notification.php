<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Notification extends Model
{
    protected $fillable = ['title', 'package_id', 'message', 'long_message', 'created_by'];

    // One to Many relationship with the NotificationUser pivot model
    public function notificationUsers()
    {
        return $this->hasMany(NotificationUser::class);
    }

    // Many to Many relationship with users through the NotificationUser pivot table
    public function users()
    {
        return $this->belongsToMany(User::class, 'notification_user')->withPivot('is_read')->withTimestamps();
    }

    // Get the admin (creator) of the notification
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Get the associated package for this notification
    public function package()
    {
        return $this->belongsTo(Packages::class, 'package_id');
    }

    // Mark all notifications as read for the logged-in user
    public function markAllAsRead()
    {
        // Mark all unread notifications as read for the logged-in user
        Auth::user()->unreadNotifications()->update(['is_read' => 1]);

        // Redirect to the notifications index with a success message
        return redirect()->route('notifications.index')->with('success', 'All notifications marked as read.');
    }
}
