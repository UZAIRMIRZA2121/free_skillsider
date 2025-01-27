<?php

namespace App\Http\Controllers;

use App\Models\CommissionStructure;
use App\Models\Faq;
use App\Models\Notification;
use App\Models\Skillsider_payment_method;
use App\Models\VideoHistory;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Hash;
use Mail;
use Session;
use Auth;
use App\Models\Packages;
use App\Models\Earning;
use App\Models\Videos;
use App\Models\package_upgrade;
use App\Models\Courses;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $packages = Packages::with('user')->get();

        return view('admin.packages.index', compact('packages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $courses = Courses::all();
        return view('admin.packages.add_packages', compact('courses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'package_title' => 'required',
            'description' => 'required',
            'color_code' => 'required',
            'price' => 'required|numeric',
            'first_percentage' => 'required|numeric',
            'second_percentage' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if (!empty($request->image)) {
            $file = $request->image;
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move(public_path('packages_image/'), $filename);
            $data['image'] = 'public/packages_image/' . $filename;



            Packages::create([
                'package_title' => $request->package_title,
                'price' => $request->price,
                'description' => $request->description,
                'first_percentage' => $request->first_percentage,
                'second_percentage' => $request->second_percentage,
                'image' => $filename,
                'courses_id' => $request->course_id,
                'user_id' => Auth::user()->id,
                'color_code' => $request->color_code,
                'text_color_code' => $request->text_color_code,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
            return redirect()->route('packages.index')->with('success', 'Package saved successfully!');
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $courses = Courses::all();
        $package = Packages::where('id', $id)->first();
        $courseIds = explode(",", $package->course_id);
        $course_selected = Courses::whereIn('id', $courseIds)->get();
        $commission_structure = CommissionStructure::where('first_package', $id)->get();


        return view('admin.packages.edit', compact('package', 'courses', 'course_selected', 'courseIds', 'commission_structure'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Packages $package)
    {

        $input = $request->all();
        // Loop through each commission structure
        foreach ($input['amount'] as $structureId => $amount) {
            // Find the structure by ID
            $structure = CommissionStructure::find($structureId);

            if ($structure) {
                // Save or update the amount in the database
                $structure->amount = $amount;
                $structure->save();
            }
        }

        if ($request->file('image')) {
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $file = $request->image;
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move(public_path('packages_image/'), $filename);
            $input['image'] = $filename;
        } else {
            unset($input['image']);
        }
        //dd($input['image']);
        $package->update($input);
        return redirect()->route('packages.index')->with('success', 'Post updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // dd($id);
        $package_del = Packages::where('id', $id)->delete();
        if ($package_del) {
            return redirect()->back()->with('success', 'package deleted successfully');
        }
        return redirect()->back()->with('error', 'Something is went wrong');
    }


    public function single_package($id)
    {
        // Retrieve the package by ID
        $package = Packages::findOrFail($id);

        // Get course IDs from the package and sort courses by course_seq in descending order
        $courseIds = explode(",", $package->course_id);
        $courses = Courses::whereIn('id', $courseIds)
            ->orderBy('course_seq', 'desc')
            ->get();

        // Pluck the course IDs from the sorted courses
        $course_Id = $courses->pluck('id')->toArray();

        // Retrieve videos related to the sorted courses, ordered by video_seq
        $videos = Videos::whereIn('courses_id', $course_Id)
            ->orderBy('video_seq', 'asc') // 'asc' for ascending order, use 'desc' for descending
            ->get();
        // Calculate the sum of video durations
        $sumOfVideoDurations = $videos->sum('video_duration');

        // Retrieve FAQs for the package page
        $faqs = Faq::all();
        $single_package = $package;
        // Return the view with the required data
        return view('student.package', compact('faqs', 'single_package', 'package', 'sumOfVideoDurations', 'courses', 'videos'));
    }


    public function my_package()
    {
        $packages = Packages::with('user')->get();

        return view('student.package.index-student', compact('packages'));
    }
    public function single_package_course($id)
    {
        // Check if the user's package allows access to the requested package
        if (Auth::user()->package_id >= $id) {
            // Retrieve the requested package
            $single_package = Packages::find($id);

            // If the package doesn't exist, redirect with an error message
            if (!$single_package) {
                return redirect()->back()->with('error', 'Package not found!');
            }

            // Retrieve associated courses and order by course_seq in ascending order
            $courseIds = explode(",", $single_package->course_id);
            $course_selected = Courses::whereIn('id', $courseIds)
                ->orderBy('course_seq', 'asc')  // Ordering by course_seq in ascending order
                ->get();

            // Retrieve all packages with associated user data
            $packages = Packages::with('user')->get();

            // Return the view with the selected package and courses
            return view('student.package.single_package_course', compact('course_selected', 'packages', 'id'));
        } else {
            return redirect()->back()->with('error', "You don't have access to this package!");
        }
    }


    public function course_video($id)
    {
        $id = decrypt($id);
        $userId = Auth::id();
        $videos = Videos::where('courses_id', $id)->orderBy('video_seq', 'asc')->get();
        // dd($videos);

        $course_name = Courses::where('id', $id)->first();
        // Fetch the actual video history records (if needed)
        $watched_video_count = VideoHistory::where('user_id', Auth::id())
            ->where('course_id', $id)
            ->count();
        $latestWatchedVideo = VideoHistory::where('user_id', Auth::id())
            ->where('course_id', $id)
            ->latest() // Orders by `created_at` in descending order
            ->first(); // Fetches the first record

        return view('student.package.single_course_video', compact('videos', 'latestWatchedVideo', 'course_name', 'watched_video_count'));
    }
    public function package_update(Request $request, $id)
    {
        $package_price = Packages::where('id', $request->package_id)->select('price','package_title')->first();
        $current_price = Auth::user()->package->price;
        $new_price = $package_price->price - $current_price;
        $upgrade_request_exist = package_upgrade::where('user_id', Auth::user()->id)->where('status', 0)->first();

        if (Auth::user()->package_id < $request->package_id && !$upgrade_request_exist) {
            package_upgrade::create([
                'package_id' => $request->package_id,
                'trx_id' => $request->trx_id,
                'user_id' => Auth::user()->id,
                'message' => $request->message,
                'amount' => $new_price,
                'status' => 0,
            ]);
   
            $email = Auth::user()->email;
            // Email content and notifications for each user
            $subject = "Upgrade Request sent successfully";
            $messageContent = "Dear " . Auth::user()->first_name . ",<br><br>
            Your course upgrade request from " . Auth::user()->package->package_title . " to " . $package_price->package_title . " has been received.<br>
            Please allow up to 24 hours for your request to be approved.";
            
                if ($email) {
                    Mail::raw($messageContent, function ($message) use ($email, $subject) {
                        $message->to($email)
                            ->subject($subject)
                            ->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
                    });
                }
            
            $notification = Notification::create([
                'title' => $subject,
                'message' =>  $messageContent,
                'created_by' => Auth::id(), // The admin who created the notification
            ]);

            // Attach notification to the specific user
            $notification->users()->attach(Auth::user()->id, ['is_read' => 0]);
         
            return redirect()->back()->with('success', 'Package update request sent successfully');
        } else {
            return redirect()->back()->with('error', 'Package update request error');
        }
    }
    public function upgrade_request_index()
    {
        $all_requests = package_upgrade::where('status', 0)->with('user', 'package')->orderBy('created_at', 'desc')->get();
        return view('admin.packages.update-package', compact('all_requests'));
    }
    public function upgrade_approved_index()
    {
        $all_requests = package_upgrade::where('status', 1)->with('user', 'package')->orderBy('created_at', 'desc')->get();
        return view('admin.packages.update-package', compact('all_requests'));
    }
    public function upgrade_request_accept(Request $request, $id)
    {
        $status = $request->query('status');
        $package_request = package_upgrade::where('id', $id)->first();

        $ref_by_user_first = User::where('referral_code', $package_request->user->referral_by)->first();
        $ref_by_user_first_id = $ref_by_user_first->id;
        if ($ref_by_user_first->status == 0) {
            $ref_by_user_first_id = 2;
        }
        $first_person_amount = ($package_request->amount * 20) / 100;

    

        
        $current_std_email = $package_request->user->email;
        $first_std_email = $ref_by_user_first->email;

        $notifiedUsers = []; // Array to track notified users

        // Function to send email
        function sendEmail($email, $subject, $messageContent)
        {
            if ($email) {
                Mail::raw($messageContent, function ($message) use ($email, $subject) {
                    $message->to($email)
                        ->subject($subject)
                        ->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
                });
            }
        }
        // Array to store notifications for multiple users
        $userNotifications = [];

        // Email content and notifications for each user
        if ($current_std_email) {
            $subject = "Course has been upgraded successfully";
            $messageContent = "Congratulations, " . $package_request->user->first_name . "!
            Your account has been upgraded to, " . $package_request->package->package_title . ", successfully .";
              sendEmail($current_std_email, $subject, $messageContent);

            // Add notification for current user
            $userNotifications[] = [
                'user_id' =>  $package_request->user->id,
                'title' => $subject,
                'message' => $messageContent,
            ];
        }

        if ($first_std_email  && $first_person_amount > 0) {
            $subject = "New Earning!";
            $roundedFirstPersonAmount = round($first_person_amount, 0); // Rounded to the nearest integer
            $formattedFirstPersonAmount = 'Rs ' . number_format($roundedFirstPersonAmount, 0); // Formatted with commas

            $messageContent = "Congratulations, " . $ref_by_user_first->first_name . "!<br>
            You have earned " . $formattedFirstPersonAmount . " from your student " . $package_request->user->first_name . "'s course upgrade.<br>
            The student has upgraded their course from " . $package_request->user->package->package_title . " to " . $package_request->package->package_title . ".";
              sendEmail($first_std_email, $subject, $messageContent);

            // Add notification for first referral
            $userNotifications[] = [
                'user_id' => $ref_by_user_first->id,
                'title' => $subject,
                'message' => $messageContent,
            ];
        }


        // Create and attach notifications for each user
        foreach ($userNotifications as $userNotification) {
            $notification = Notification::create([
                'title' => $userNotification['title'],
                'message' => $userNotification['message'],
                'created_by' => Auth::id(), // The admin who created the notification
            ]);

            // Attach notification to the specific user
            $notification->users()->attach($userNotification['user_id'], ['is_read' => 0]);
        }
    Earning::create(attributes: [
            'user_id' => $ref_by_user_first_id,
            'user_by_id' => $package_request->user->id,
            'amount' => $first_person_amount,
            'percentage' => "20",
            'status' => 0,
            'percentage_type' => "Upgarde Package",
            'package_id' => $package_request->package_id
        ]);

        package_upgrade::where('id', $id)->update(['status' => 1]);

        User::where('id', $package_request->user_id)->update([
            'package_id' => $package_request->package_id,
            'trx_id' => $package_request->trx_id,
            'paid_amount' => $package_request->package->price,
        ]);


     
        return redirect()->back()->with('success', 'Package Updated Successfully');

    }
    public function upgrade_request_destroy(Request $request, $id)
    {

        $upgrade_request_del = package_upgrade::where('id', $id)->delete();

        if ($upgrade_request_del) {
            return redirect()->back()->with('success', 'Upgrade Requeste Deleted Successfully');
        }
        return redirect()->back()->with('error', 'Something is went wrong');

    }
    public function package_update_form()
    {

        $packages = Packages::all();
        $payment_methods = Skillsider_payment_method::where('user_id', 1)->get();
        return view('admin.students.package_update', compact('packages', 'payment_methods'));
    }

}