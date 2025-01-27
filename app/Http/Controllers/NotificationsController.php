<?php

// app/Http/Controllers/NotificationsController.php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\Packages;
use App\Models\NotificationUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationsController extends Controller
{
    // Admin method to list all notifications
    public function index()
    {
        $notifications = Notification::all();
        return view('admin.notification.index', compact('notifications'));
    }

    // Admin method to show the form for creating a new notification
    public function create()
    {
        $packages = Packages::all(); // Fetch all available packages
        return view('admin.notification.create', compact('packages'));
    }

    // Admin method to store a newly created notification
    public function store(Request $request)
    {



        // Validate the incoming request data
        $request->validate([
            'title' => 'required|string|max:255',
            'message' => 'required|string',
            'long_desc' => 'required|string|max:5000',

            'package_id' => 'nullable|exists:packages,id', // Make package_id optional and ensure it exists in the packages table if provided
        ]);

        $users = User::where('role', 0);

        // Handle the main blog image upload
        if ($request->hasFile('img')) {
            $image = $request->file('img');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('blogs_img'), $imageName);
            $validated['img'] = 'blogs_img/' . $imageName;
        }

        $package_id = $request->package_id;
        // Create the notification
        try {
            $notification = Notification::create([
                'title' => $request->title,
                'message' => $request->message,
                'long_message' => $request->long_desc,
                'package_id' => $package_id ?? null,
                'created_by' => Auth::id(), // The admin who created the notification
            ]);

            // Check if notification was saved successfully
            if (!$notification) {
                dd('Failed to create notification');
            }

            if ($package_id) {
                $users = $users->where('package_id', $package_id);
            }

            // Attach each user to the notification with the "is_read" value set to 0 (unread)
            foreach ($users->get() as $user) {
                $notification->users()->attach($user->id, ['is_read' => 0]);
            }

            // Redirect back to the notifications index with a success message
            return redirect()->route('notifications.index')->with('success', 'Notification created successfully.');

        } catch (\Exception $e) {
            // If there's an error, display the error message using dd
            dd('Error: ' . $e->getMessage());
        }
    }



    // Admin method to show the form for editing an existing notification
    public function edit($id)
    {
        $notification = Notification::findOrFail($id);
        $packages = Packages::all(); // Fetch available packages

        return view('admin.notification.edit', compact('notification', 'packages'));
    }

    // Admin method to update an existing notification
    public function update(Request $request, $id)
    {
        // Validate the incoming request data
        $request->validate([
            'title' => 'required|string|max:255',
            'message' => 'required|string',
            'package_id' => 'nullable|exists:packages,id', // Make package_id optional and ensure it exists in the packages table if provided
        ]);

        // Find the notification by id
        $notification = Notification::findOrFail($id);

        // Update the notification
        $notification->title = $request->title;
        $notification->message = $request->message;
        $notification->package_id = $request->package_id ?? null;
        $notification->save();

        // Define the users based on package_id
        $users = User::where('role', 0); // Assuming 'role' 0 means regular users

        $package_id = $request->package_id;

        // Filter users by package_id if one is provided
        if ($package_id) {
            $users = $users->where('package_id', $package_id);
        }

        // Get the filtered users
        $users = $users->get();

        // Attach each user to the notification with the "is_read" value set to 0 (unread)
        foreach ($users as $user) {
            // Using syncWithoutDetaching ensures existing associations aren't removed, and the "is_read" flag is updated to 0
            $notification->users()->syncWithoutDetaching([$user->id => ['is_read' => 0]]);
        }

        // Redirect back to the notifications index with a success message
        return redirect()->route('notifications.index')->with('success', 'Notification updated successfully.');
    }


    // Admin method to delete a notification
    public function destroy($id)
    {
        $notification = Notification::findOrFail($id);
        $notification->delete();

        return redirect()->route('notifications.index')->with('success', 'Notification deleted successfully.');
    }
    public function markAllAsRead()
    {


        // Redirect to the notifications index (or wherever you want to send the user) with a success message
        return redirect()->back()->with('success', 'All notifications marked as read.');
    }

    public function show($id)
    {
        // Update all unread notifications for the logged-in user
        NotificationUser::where('user_id', Auth::id())
            ->where('is_read', 0)
            ->update(['is_read' => 1]);
    
        // Fetch all notifications ordered by creation date
        $notifications = Notification::orderBy('created_at', 'desc')->get();
    
        return view('admin.students.notification', compact('notifications'));
    }
    


}
