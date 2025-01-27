<?php

namespace App\Http\Controllers;

use App\Models\Courses;
use App\Models\FaqAffiliateVideo;
use Carbon\Carbon;
use DB;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\User;
use App\Models\Packages;
use App\Models\Coupon;
use App\Models\Team;
use App\Models\Faq;
use App\Models\Reviews;
use App\Models\Video;
use App\Models\Earning;
use Illuminate\Support\Str;
use App\Http\Controllers\toastr;
use App\Models\Skillsider_payment_method;

use Illuminate\Support\Facades\Mail;
use App\Mail\Register_Mail;
use App\Models\AboutVideo;
use App\Models\DashboardImage;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payment_methods = Skillsider_payment_method::all()->where('user_id', 1);
        $packages = packages::get();

        return view('admin.users.index', compact('packages', 'payment_methods'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $payment_methods = Skillsider_payment_method::all()->where('user_id', 1);
        $packages = packages::get();
        // dd($packages);
        return view('auth.register', compact('packages', 'payment_methods'));
    }
    public function registeration(Request $request)
    {


        // dd($request->all());
        $validatedData = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',

            'phone' => 'required',
            'referral_code' => 'required',
            'package_id' => 'required',

            'trxid' => 'required',
            // Other validation rules...
        ], [
            'first_name.required' => 'Please enter your first name.',
            'last_name.required' => 'Please enter your last name.',
            'email.required' => 'Please enter your email address.',
            'email.email' => 'Please enter a valid email address.',

            'phone.required' => 'Please enter your phone number.',
            'referral_code.required' => 'Please enter referral code.',
            'package_id.required' => 'Please select a package.',
            'trxid.required' => 'Please enter Transaction ID.',
        ]);

        $package = Packages::where('id', $request->package_id)->first(); // Use first() to get the first result.

        if ($request->coupon_code) {
            $coupon = Coupon::where('code', $request->coupon_code)->first();

            if ($coupon) {
                $discounted = $package->price - ($package->price * $coupon->percentage) / 100;
                $paid_amount = $discounted;
            } else {

                $paid_amount = $package->price;
            }
        } else {
            $paid_amount = $package->price;
        }


        $email_exsist = User::where('email', $request->email)->first();
        $Trx_id_exsist = User::where('trx_id', $request->trxid)->first();
        $referral_code_exsist = User::where('referral_code', $request->referral_code)->first();

        if ($referral_code_exsist->status == 0) {
            Session::flash('error', 'Your Sponsor is unverify');
            return redirect()->back();
        }
        if ($email_exsist) {
            Session::flash('error', 'Email already registered.');
            return redirect()->back();
        } else {
            if ($referral_code_exsist) {
                if ($Trx_id_exsist) {
                    Session::flash('error', 'This transaction ID is already use');
                    return redirect()->back();
                } else {


                    // $file = $request->payment_image;
                    // $extension = $file->getClientOriginalExtension(); 
                    // $filename = time() . '.' . $extension;
                    // $file->move(public_path('payment_image/'), $filename);
                    // $data['image'] = 'public/payment_image/' . $filename;

                    $randomCharacterString = Str::random(6);
                    $lettersOnly = preg_replace('/[^a-zA-Z]/', '', $randomCharacterString);
                    $user_id = User::max('id');
                    $referral_by = $user_id + 1 . "-" . $lettersOnly;
                    $password = Hash::make($request->password);
                    User::create([
                        'first_name' => $request->first_name,
                        'last_name' => $request->last_name,
                        'email' => $request->email,
                        'email_verified_at' => null,
                        'password' => $password,
                        'phone' => $request->phone,
                        'trx_id' => $request->trxid,
                        'referral_by' => $request->referral_code,
                        'referral_code' => $referral_by,
                        'referral_coupen_code' => $request->referral_code,
                        'package_id' => $request->package_id,
                        'coupen_code' => $request->coupon_code,
                        'paid_amount' => $paid_amount,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ]);


                    $details = [
                        'name' => $request->first_name,
                        'package' => $package->title,
                    ];

                    Mail::to($request->email)->send(new Register_Mail($details));
                    return view('welcome');
                }
            } else {
                Session::flash('error', ' Referral code does not exsist.');
                return redirect()->back();
            }
        }
    }


    /**
     * Display the specified resource.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $single_user = User::where('id', $id)->first();
        // return view('admin.users.edit', compact('single_user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $single_user = User::where('id', Auth::user()->id)->first();
        return view('admin.users.edit', compact('single_user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $users = User::where('id', Auth::user()->id)->first();
        $input = $request->all();
     
        // Handle password update
        if ($request->password) {
            // Validate input fields
            $request->validate([
                'oldpassword' => 'required',
                'password' => 'required|confirmed|min:6', // ensures password and password_confirmation match
            ]);

            // Check if the old password is correct
            if (!Hash::check($request->oldpassword, $users->password)) {
            return redirect()->route('users.index')->with('error', 'The provided old password does not match our records.');

            }

            // Update the password
           
            $users->password = Hash::make($request->password);
            $users->save();
            return redirect()->route('users.index')->with('success', 'Profile updated successfully!');
        }


        // Handle profile photo update
        if ($request->file('profile_photo_path')) {
            // Validate the uploaded image
            $this->validate($request, [
                'profile_photo_path' => 'image|mimes:jpg,jpeg,png|max:300',
            ]);

            // Delete the old profile photo if it exists
            if ($users->profile_photo_path && file_exists(public_path('profile-image/' . $users->profile_photo_path))) {
                unlink(public_path('profile-image/' . $users->profile_photo_path));
            }

            // Save the new profile photo
            $profile_file = $request->file('profile_photo_path');
            $profile_filename = time() . '.' . $profile_file->getClientOriginalExtension();
            $profile_file->move(public_path('profile-image/'), $profile_filename);
            $input['profile_photo_path'] = $profile_filename;
        } else {
            unset($input['profile_photo_path']);
        }

        // Handle payment image update
        if ($request->file('payment_image')) {
            // Validate the uploaded image
            $this->validate($request, [
                'payment_image' => 'image|mimes:jpeg,png|max:2048',
            ]);

            // Delete the old payment image if it exists
            if ($users->payment_image && file_exists(public_path('payment_image/' . $users->payment_image))) {
                unlink(public_path('payment_image/' . $users->payment_image));
            }

            // Save the new payment image
            $file = $request->file('payment_image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('payment_image/'), $filename);
            $input['payment_image'] = $filename;
        } else {
            unset($input['payment_image']);
        }

        // Update user data
        $users->update($input);

        // Redirect based on user role
        if (Auth::user()->role == 1) {
            return redirect()->route('admin.index')->with('success', 'Profile updated successfully!');
        } else {
            return redirect()->route('users.index')->with('success', 'Profile updated successfully!');
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }


    public function graphData(Request $request)
    {
        $graph_date = $request->input('date');
        $oneWeekAgo = now()->subWeek();
        $oneMonthAgo = now()->subMonth();
        $sixMonthsAgo = now()->subMonths(6);
        $oneYearAgo = now()->subYear();
        if ($graph_date == '1w') {
            $graph_data = Earning::select(
                DB::raw("(sum(amount)) as total_amount"),
                DB::raw("(DATE_FORMAT(created_at, '%d-%m-%Y')) as my_date")
            )->where('user_id', '=', Auth::user()->id)
                ->where('created_at', '>=', $oneWeekAgo)
                ->orderBy('created_at')
                ->groupBy(DB::raw("DATE_FORMAT(created_at, '%d-%m-%Y')"))
                ->get();


            return response()->json($graph_data);
        } elseif ($graph_date == '1m') {
            $graph_data = Earning::select(
                DB::raw("(sum(amount)) as total_amount"),
                DB::raw("(DATE_FORMAT(created_at, '%d-%m-%Y')) as my_date")
            )->where('user_id', '=', Auth::user()->id)
                ->where('created_at', '>=', $oneMonthAgo)
                ->orderBy('created_at')
                ->groupBy(DB::raw("DATE_FORMAT(created_at, '%d-%m-%Y')"))
                ->get();

            return response()->json($graph_data);
        } elseif ($graph_date == '6m') {
            $graph_data = Earning::select(
                DB::raw("(sum(amount)) as total_amount"),
                DB::raw("(DATE_FORMAT(created_at, '%d-%m-%Y')) as my_date")
            )->where('user_id', '=', Auth::user()->id)
                ->where('created_at', '>=', $sixMonthsAgo)
                ->orderBy('created_at')
                ->groupBy(DB::raw("DATE_FORMAT(created_at, '%d-%m-%Y')"))
                ->get();


            return response()->json($graph_data);
        } elseif ($graph_date == '1y') {
            $graph_data = Earning::select(
                DB::raw("(sum(amount)) as total_amount"),
                DB::raw("(DATE_FORMAT(created_at, '%d-%m-%Y')) as my_date")
            )
                ->where('user_id', '=', Auth::user()->id)
                ->where('created_at', '>=', $oneYearAgo)
                ->orderBy('created_at')
                ->groupBy(DB::raw("DATE_FORMAT(created_at, '%d-%m-%Y')"))
                ->get();

            return response()->json($graph_data);
        } else {
            $graph_data = Earning::select(
                DB::raw("(sum(amount)) as total_amount"),
                DB::raw("(DATE_FORMAT(created_at, '%d-%m-%Y')) as my_date")
            )
                ->where('user_id', '=', Auth::user()->id)
                ->orderBy('created_at')
                ->groupBy(DB::raw("DATE_FORMAT(created_at, '%d-%m-%Y')"))
                ->get();

            return response()->json($graph_data);
        }
    }

    public function userregionsdata(Request $request)
    {
        $userCounts = [
            'Punjab' => 100,
            'Sindh' => 66,
            'KPK' => 44,
            'Balochistan' => 77,
        ];

        return response()->json($userCounts);
    }

    public function dashboard()
    {
        $earnings = Earning::with('user')->where('status', 2)->orderBy('created_at', 'desc')->get();

        $user = Auth::user();
        ////todays earning///////////
        $today_earning = Earning::where('user_id', '=', $user->id)
            ->whereDate('created_at', Carbon::today())->sum('amount'); // Filter by today's date
        ////7 days earning///////////
        $startDate = Carbon::now()->subDays(7)->startOfDay();
        $endDate = Carbon::now()->endOfDay();
        $last7Days_earning = Earning::where('user_id', $user->id)
            ->whereBetween('created_at', [$startDate, $endDate])
            ->sum('amount');
        ////30 days earning///////////
        $startDate = Carbon::now()->subDays(30)->startOfDay();
        $endDate = Carbon::now()->endOfDay();

        $last30Days_earning = Earning::where('user_id', $user->id)
            ->whereBetween('created_at', [$startDate, $endDate])
            ->sum('amount');

        $all_time__earning = Earning::where('user_id', $user->id)
            ->sum('amount');


        $totalPaid = $totalRequested = $totalUnRequested = 0;

        $totalPaid = Earning::where('status', '=', '1')->sum('amount');
        $totalRequested = Earning::where('status', '=', '2')->sum('amount');
        $totalUnRequested = Earning::where('status', '=', '0')->sum('amount');



        $total_earnings = Earning::where('user_id', $user->id)
            ->orderBy('id', 'desc')
            ->get();


        $total_student_count = User::where('role', '=', '0')->count();
        $verifyl_student_count = User::where('role', '=', '0')->where('status', '=', '1')->count();
        $unverify_student_count = User::where('role', '=', '0')->where('status', '=', '0')->count();

        $total_student_count_punjab = User::where('role', '=', '0')->where('state', 'Punjab')->count();
        $total_student_count_sindh = User::where('role', '=', '0')->where('state', 'Sindh')->count();
        $total_student_count_Gilgit = User::where('role', '=', '0')->where('state', 'Gilgit Bultistan')->count();
        $total_student_count_kpk = User::where('role', '=', '0')->where('state', 'KPK')->count();

        // Calculate the date 6 months ago
        $sixMonthsAgo = now()->subMonths(12);
        $formattedDate = $sixMonthsAgo->format('Y-m-d H:i:s');
        if (auth::user()->role == 1 || auth::user()->role == 3)
        // Retrieve students data from the database for the last 6 months
        {
            $students = User::all();

        } else {
            $students = User::where('referral_by', '=', auth::user()->referral_code)
                ->where('status', '=', '1')
                ->whereDate('created_at', '>=', $sixMonthsAgo)
                ->orderBy('verified_at', 'asc')
                ->get();
        }




        // Group the records by date and count occurrences
        $dateCounts = $students->groupBy(function ($student) {
            return optional($student->created_at)->format('Y-m-d');
        })->map(function ($group) {
            return $group->count();
        });

        // Prepare data array with date counts
        $data = $dateCounts->map(function ($count, $date) {
            return [
                $date, // Date
                $count // Count of records for this date
            ];
        })->values()->toArray();

        if (auth::user()->role == 1 || auth::user()->role == 3)
        // Retrieve students data from the database for the last 6 months
        {
            return view(
                'admin.analytic_chart',
                compact(
                    'earnings',
                    'today_earning',
                    'last7Days_earning',
                    'last30Days_earning',
                    'all_time__earning',
                    //  'graph_date',
                    //  'graph_amount',
                    'totalPaid',
                    'totalRequested',
                    'totalUnRequested',
                    'total_earnings',
                    'total_student_count',
                    'verifyl_student_count',
                    'unverify_student_count',
                    'total_student_count_punjab',
                    'total_student_count_kpk',
                    'total_student_count_Gilgit',
                    'total_student_count_sindh',
                    'data'
                )
            )->with('success', 'Payment have been sent successfully.');

        } else {
            return view(
                'admin.dashboard',
                compact(
                    'earnings',
                    'today_earning',
                    'last7Days_earning',
                    'last30Days_earning',
                    'all_time__earning',
                    //  'graph_date',
                    //  'graph_amount',
                    'totalPaid',
                    'totalRequested',
                    'totalUnRequested',
                    'total_earnings',
                    'total_student_count',
                    'verifyl_student_count',
                    'unverify_student_count',
                    'total_student_count_punjab',
                    'total_student_count_kpk',
                    'total_student_count_Gilgit',
                    'total_student_count_sindh',
                    'data'
                )
            )->with('success', 'Payment have been sent successfully.');
        }


    }
    public function leaderboard()
    {
        // Fetch all student IDs
        $all_std_ids = User::where('role', 0)->pluck('id');

        // Get the date 7 days ago
        $sevenDaysAgo = now()->subDays(7)->toDateString();
        // Initialize a collection to store results for 7 days earnings
        $topEarnings_7_days = collect();

        // Get the date 30 days ago
        $thirtyDaysAgo = now()->subDays(30)->toDateString();
        // Initialize a collection to store results for 30 days earnings
        $topEarnings_30_days = collect();

        // Initialize a collection to store results for all-time earnings
        $topEarnings_AllTime = collect();

        // Define the chunk size
        $chunkSize = 10000; // Adjust this value if needed

        // Process the student IDs in chunks to avoid too many placeholders error
        foreach (array_chunk($all_std_ids->toArray(), $chunkSize) as $chunk) {
            // 7 days earnings
            $results7Days = Earning::with('user')
                ->whereIn('user_id', $chunk)
                ->where('created_at', '>=', $sevenDaysAgo)
                ->select('user_id', DB::raw('SUM(amount) as total_amount'))
                ->groupBy('user_id')
                ->orderByDesc('total_amount')
                ->get();
            $topEarnings_7_days = $topEarnings_7_days->merge($results7Days);

            // 30 days earnings
            $results30Days = Earning::with('user')
                ->whereIn('user_id', $chunk)
                ->where('created_at', '>=', $thirtyDaysAgo)
                ->select('user_id', DB::raw('SUM(amount) as total_amount'))
                ->groupBy('user_id')
                ->orderByDesc('total_amount')
                ->get();
            $topEarnings_30_days = $topEarnings_30_days->merge($results30Days);

            // All-time earnings
            $resultsAllTime = Earning::with('user')
                ->whereIn('user_id', $chunk)
                ->select('user_id', DB::raw('SUM(amount) as total_amount'))
                ->groupBy('user_id')
                ->orderByDesc('total_amount')
                ->get();
            $topEarnings_AllTime = $topEarnings_AllTime->merge($resultsAllTime);
        }

        // After merging all chunks, sort and take the top 10 records for each period
        $topEarnings_7_days = $topEarnings_7_days->sortByDesc('total_amount')->take(10)->values();
        $topEarnings_30_days = $topEarnings_30_days->sortByDesc('total_amount')->take(10)->values();
        $topEarnings_AllTime = $topEarnings_AllTime->sortByDesc('total_amount')->take(10)->values();

        return view('admin.leaderboard', compact('topEarnings_7_days', 'topEarnings_30_days', 'topEarnings_AllTime'));
    }

    public function certificate()
    {
        return view('admin.certificate');
    }
    public function affilate_training()
    {
        return view('admin.affilate_training');
    }
    public function faq()
    {
        $faqaffiliatevideos = FaqAffiliateVideo::where('type', 1)->get();

        return view('admin.faq', compact('faqaffiliatevideos'));
    }
    public function affiliatetraining()
    {
        $faqaffiliatevideos = FaqAffiliateVideo::where('type', 0)->get();

        return view('admin.affiliattraining', compact('faqaffiliatevideos'));
    }
    public function community()
    {
        return view('admin.community');
    }


    public function update_password()
    {
        return ('admin.profile');
    }

    public function std_index()
    {
        $packages = Packages::get();
        $all_courses = Courses::get();
        $teams = Team::all();
        $reviews = Reviews::with('video')->get();
        $faqs = Faq::all();
        return view('student.index', compact('packages', 'all_courses', 'teams', 'reviews', 'faqs'));
    }
    public function std_about_us()
    {
        $teams = Team::all();
        return view('student.about-us', compact('teams'));
    }
    public function std_blog()
    {
        return view('student.blog');
    }

    //    public function golden_package()
    //    {
    //        return view('student.golden-package');
    //    }
    //    public function platium_package()
    //    {
    //        return view('student.platium-package');
    //    }
    public function contact_us()
    {
        return view('student.contact-us');
    }

    public function student_review()
    {
        $reviews = Reviews::all();
        return view('student.student-review', compact('reviews'));
    }
    public function student_review_show($id)
    {
        $reviews = Reviews::where('id', '!=', $id)->get();
        $review = Reviews::find($id);
        return view('student.student-review-single', compact('review', 'reviews'));
    }
    public function affiliate_veification()
    {
        return view('auth.affiliate-veification');
    }
    public function affiliate_veification_check(Request $request)
    {
        //    dd ($request->referral_code);
        $all_users = User::where('referral_code', $request->referral_code)->first();
        if ($all_users) {
            return view('auth.affiliate-veification', compact('all_users'));
        } else {
            return redirect()->back()->with('error', 'Not Found');
        }
    }
    public function affiliate_verification_check_ajax(Request $request)
    {
        // Validate the code input
        $request->validate([
            'code' => 'required|string|max:255',
        ]);

        $code = $request->input('code');

        // Ensure the referral_code exists in the database
        $user = User::where('referral_code', $code)->with('package')->first();

        if ($user) {
            return response()->json(['exists' => 1, 'data' => $user]);

        } else {
            return response()->json(['exists' => 0]);
        }
    }

    public function register_by_referral($referral_code)
    {
        $payment_methods = Skillsider_payment_method::all()->where('user_id', 1);
        $packages = packages::get();
        return view('auth.register', compact('packages', 'payment_methods', 'referral_code'));
    }

    public function rank_index()
    {

        dd('admin.course.index');
    }
    public function paymennt_link()
    {
        $payment_methods = Skillsider_payment_method::all()->where('user_id', 1);
        return view('auth.payment-link', compact('payment_methods'));
    }
    public function aboutvideoindex()
    {

        $aboutvideos = AboutVideo::all();
        return view('admin.aboutvideo.index', compact('aboutvideos'));
    }
    public function editaboutvideo()
    {
        $aboutvideos = AboutVideo::first();
        return view('admin.aboutvideo.edit-video', compact('aboutvideos'));
    }
    public function updateaboutvideo(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'video_link' => 'required|string',
            'video_thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Find the AboutVideo record
        $aboutVideo = AboutVideo::find(1); // Assuming there's only one record, you may need to adjust this

        // Update video link
        $aboutVideo->video_link = $request->input('video_link');

        // Handle the file upload if a file is provided
        // if ($request->hasFile('video_thumbnail')) {
        //     // Delete the old thumbnail if it exists
        //     if ($aboutVideo->video_thumbnail) {
        //         Storage::delete($aboutVideo->video_thumbnail);
        //     }

        //     // Store the new thumbnail
        //     $path = $request->file('video_thumbnail')->store('thumbnails', 'public');
        //     $aboutVideo->video_thumbnail = $path;
        // }
        if ($request->Hasfile('video_thumbnail')) {
            $profile_file = $request->file('video_thumbnail');
            $profile_extension = $profile_file->getClientOriginalExtension();
            $profile_filename = time() . '.' . $profile_extension;
            $profile_file->move(public_path('thumbnails/'), $profile_filename);
            $input['video_thumbnail'] = $profile_filename;
        } else {
            unset($input['video_thumbnail']);
        }
        $aboutVideo->video_thumbnail = $input['video_thumbnail'];
        // Save the updated record
        $aboutVideo->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Video updated successfully.');
    }


    public function dashboardimageindex()
    {
        $dashboardImages = DashboardImage::all();
        return view('admin.dashboardimg.index', compact('dashboardImages'));
    }

    public function dashboardimagecreate()
    {
        return view('admin.dashboardimg.create');
    }

    public function dashboardimagestore(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'nullable|string|max:255',
        ]);

        if ($request->Hasfile('image')) {
            $profile_file = $request->file('image');
            $profile_extension = $profile_file->getClientOriginalExtension();
            $profile_filename = time() . '.' . $profile_extension;
            $profile_file->move(public_path('thumbnails/'), $profile_filename);
            $input['image'] = $profile_filename;
        } else {
            unset($input['image']);
        }
        $image = $input['image'];
        DashboardImage::create([
            'image' => $image,
            'visibility' => $request->visibility
        ]);

        return redirect()->back()->with('success', 'Image uploaded successfully.');
    }

    public function dashboardimagesedit(DashboardImage $dashboardImage)
    {
        return view('admin.dashboardimg.edit', compact('dashboardImage'));
    }

    public function dashboardimagesupdate(Request $request, DashboardImage $dashboardImage)
    {
        // Validate the request
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'visibility' => 'required|in:public,private,both', // Ensure visibility is one of the allowed values
        ]);

        // Handle the image upload
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($dashboardImage->image) {
                Storage::disk('public')->delete($dashboardImage->image);
            }

            // Upload the new image
            $profile_file = $request->file('image');
            $profile_extension = $profile_file->getClientOriginalExtension();
            $profile_filename = time() . '.' . $profile_extension;
            $profile_file->move(public_path('thumbnails/'), $profile_filename);
            $dashboardImage->image = $profile_filename;
        }

        // Update visibility
        $dashboardImage->visibility = $request->input('visibility');

        // Save the updated image data
        $dashboardImage->save();

        // Redirect with success message
        return redirect()->route('dashboard.images.index')->with('success', 'Image updated successfully.');
    }


    public function dashboardimagesdestroy(DashboardImage $dashboardImage)
    {
        // Delete the image file
        // Storage::disk('thumbnails')->delete($dashboardImage->image_path);

        // Delete the record from the database
        $dashboardImage->delete();

        return redirect()->route('dashboard.images.index')->with('success', 'Image deleted successfully.');
    }
    public function stdearning()
    {
        // Sum the amounts for each user_id where status is 0, ordered by the summed amount in descending order
        $earnings = Earning::selectRaw('user_id, SUM(amount) as total_amount')
            ->where('status', 0)
            ->groupBy('user_id')
            ->orderBy('total_amount', 'desc') // Ensure descending order
            ->with('user') // Eager load the user relationship
            ->get();

        // Pass the earnings to the view
        return view('admin.stdearning.index', compact('earnings'));
    }
    public function stdtotalearning()
    {
        $earnings = Earning::selectRaw('user_id, SUM(amount) as total_amount')
            ->groupBy('user_id')
            ->with('user')
            ->get();

        return view('admin.stdearning.stdtotalearning_index', compact('earnings'));
    }
    public function updateStatus(Request $request)
    {
        try {
            $field = $request->input('field');
            $value = $request->input('value');

            // Validate the field
            if (!in_array($field, ['passive_income', 'sounds'])) {
                return response()->json(['success' => false, 'message' => 'Invalid field'], 400);
            }

            // Get the authenticated user
            $user = Auth::user();

            // Check if the user exists
            if (!$user) {
                return response()->json(['success' => false, 'message' => 'User not found'], 404);
            }

            // Update the user status field
            $user->$field = $value;

            // Save the user and check if the save was successful
            if ($user->save()) {
                return response()->json(['success' => true, 'message' => 'Status updated successfully']);
            }

            return response()->json(['success' => false, 'message' => 'Failed to update status'], 500);

        } catch (\Exception $e) {
            // Log the error
            \Log::error("Error updating user status: " . $e->getMessage());

            return response()->json(['success' => false, 'message' => 'An error occurred. Please try again later.'], 500);
        }
    }

    public function refund_policy(){
        return view('student.refund-policy');
    }

}
