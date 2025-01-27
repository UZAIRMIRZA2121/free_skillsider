<?php

namespace App\Http\Controllers;

use App\Models\CommissionStructure;
use App\Models\Earning;
use App\Models\Notification;
use App\Models\Packages;
use App\Models\Ranks;
use App\Models\User;
use App\Models\Transection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\Verification_Mail;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Mail;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        // All fields are present, proceed with fetching students
        $students = (Auth::user()->role == 1 || Auth::user()->role == 2) ?
            User::where('role', 0)->where('id', '>', 2)->orderByDesc('id')->paginate(20) :
            User::where('role', 0)->where('id', '>', 2)->where('referral_by', Auth::user()->referral_code)->orderByDesc('id')->paginate(20);
        return view('admin.students.index', compact('students'));

    }




    public function searchstudents(Request $request)
    {
        $query = $request->input('query');
        if(Auth::user()->role == 1 || Auth::user()->role == 2){
            $students = User::where('first_name', 'like', "%$query%")
            ->orWhere('email', 'like', "%$query%")
            ->orWhere('referral_code', 'like', "%$query%")
            ->orWhere('referral_by', 'like', "%$query%")
            ->where('role', 0)
            ->where('id', '!=', Auth::id())
            ->paginate(20);
        }else{
            $students = User::where('first_name', 'like', "%$query%")
            ->orWhere('email', 'like', "%$query%")
            ->orWhere('referral_code', 'like', "%$query%")
            ->orWhere('referral_by', 'like', "%$query%")
            ->where('role', 0)
            ->where('id', '!=', Auth::id())
            ->where('referral_by', Auth::user()->referral_code)
            ->paginate(20);
        }

    
        if(Auth::user()->role == 1 || Auth::user()->role == 2){
            return view('admin.students.index', compact('students'));
        }else{
            return view('admin.students.index', compact('students'));
        }



      
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        $single_students = User::where('role', '=', 0)->where('id', $id)->first();
        // dd( $students );
        return view('admin.students.single_student', compact('single_students'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    public function edit($id)
    {

        $student = User::where('id', $id)->first();
        $new_std_package = Packages::where('id', $student->package_id)->first();
        $ref_by_user_first = User::where('referral_code', $student->referral_by)->first();
        if ($ref_by_user_first->status == 0) {
            $ref_by_user_first = User::where('referral_code', '4-pgevZV')->first();
        }
        $package_percentage_first = Packages::where('id', $ref_by_user_first->package_id)->first();
        $cummission_structure = CommissionStructure::where('second_package', $new_std_package->id)->where('first_package', $package_percentage_first->id)->first();

        // dd('new use pck_id  '. $new_std_package->id.'------------'.'old use pck_id  '.$package_percentage_first->id  .'     cummission_structure  '.$cummission_structure);
        if($cummission_structure){
            $cummission_amount = $cummission_structure->amount;
            $first_person_amount = $cummission_amount;
            $second_person_amount = 0;
        }else{
            if ($new_std_package->id >= $package_percentage_first->id) {
                $ref_by_user_second = User::where('referral_code', $ref_by_user_first->referral_by)->where('passive_income', 1)->first();
                // same package condition for  4 pck
                if ($ref_by_user_second) {
                    $package_percentage_second = Packages::where('id', $ref_by_user_second->package_id)->first();
                    if ($new_std_package->id = $package_percentage_first->id = $package_percentage_second->id = 4) {
                        $second_std_per = $package_percentage_first->second_percentage;
                        $second_std_price = $package_percentage_first->price;
                        $second_person_amount = ($second_std_per * $second_std_price) / 100;
                    }
                } else {
                    $second_person_amount = 0;
                }
                $old_std_per = $package_percentage_first->first_percentage;
                $old_std_price = $package_percentage_first->price;
                $first_per = $old_std_per;
                $first_person_amount = ($old_std_per * $old_std_price) / 100;
    
            } else {
                $new_std_per = $package_percentage_first->first_percentage;
                $new_std_price = $new_std_package->price;
                $first_per = $new_std_per;
                $first_person_amount = ($new_std_price * $new_std_per) / 100;
            }
        }

   

     









        // dd($first_person_amount);
        // dd($second_person_amount);

        $current_std_email = $student->email;
        $first_std_email = $ref_by_user_first->email;
        $second_std_email = $ref_by_user_second->email ?? null;

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
            $subject = "Welcome, Current User!";
            $messageContent = "Congratulations! $student->first_name, your $new_std_package->package_title package has been activated successfully!";
            sendEmail($current_std_email, $subject, $messageContent);

            // Add notification for current user
            $userNotifications[] = [
                'user_id' => $student->id,
                'title' => $subject,
                'message' => $messageContent,
            ];
        }

        if ($first_std_email  && $first_person_amount > 0) {
            $subject = "New Earning!";
            $roundedFirstPersonAmount = round($first_person_amount, 0); // Rounded to the nearest integer
            $formattedFirstPersonAmount = 'Rs ' . number_format($roundedFirstPersonAmount, 0); // Formatted with commas

            $messageContent = "Congratulations! $ref_by_user_first->first_name, you have earned  $formattedFirstPersonAmount affiliate income from $student->first_name $student->last_name on $new_std_package->package_title course purchase.";
            sendEmail($first_std_email, $subject, $messageContent);

            // Add notification for first referral
            $userNotifications[] = [
                'user_id' => $ref_by_user_first->id,
                'title' => $subject,
                'message' => $messageContent,
            ];
        }

        if ($second_std_email  && $second_person_amount > 0) {
            $subject = "New Earning!";
            $roundedSecondPersonAmount = round($second_person_amount, 0); // Rounded to the nearest integer
            $formattedsecondPersonAmount = 'Rs ' . number_format($roundedSecondPersonAmount, 0); // Formatted with commas

            $messageContent = "Congratulations! $ref_by_user_second->first_name, you earned  $formattedsecondPersonAmount reward from your student $ref_by_user_first->first_name $ref_by_user_first->last_name's sale of $new_std_package->package_title course.";
            sendEmail($second_std_email, $subject, $messageContent);

            // Add notification for second referral
            $userNotifications[] = [
                'user_id' => $ref_by_user_second->id,
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




        // dd($id, $ref_by_user_first, $ref_by_user_second);



        if ($student->status == 0) {
            if ($student->commission == 0) {
                $status_update = User::where('id', $id)->update([
                    'status' => 1,
                    'commission' => 1,
                    'verified_at' => \Carbon\Carbon::now()
                ]);
                $second_student = User::where('referral_code', $ref_by_user_first->referral_by)->first();
                $a = Earning::create([
                    'user_id' => $ref_by_user_first->id,
                    'user_by_id' => $student->id,
                    'amount' => $first_person_amount,
                    'percentage' => $first_per ?? null,
                    'status' => 0,
                    'percentage_type' => 'first person'
                ]);
                if ($student->package_id == 4) {
                    if (($second_person_amount) > 0 && ($ref_by_user_second)) {
                        $b = Earning::create(attributes: [
                            'user_id' => $second_student->id,
                            'user_by_id' => $student->id,
                            'amount' => $second_person_amount,
                            'percentage' => $second_std_per,
                            'status' => 0,
                            'percentage_type' => 'second person'
                        ]);
                    }
                }


            } else {
                User::where('id', $id)->update([
                    'status' => 1,
                ]);
            }
            return redirect()->back()->with('success', 'Student again verify successfully.');

            if ($status_update) {
                // $second_student = User::where('referral_code', $ref_by_user_first->referral_by)->first();
                // $a =   Earning::create([
                //     'user_id' => $ref_by_user_first->id,
                //     'user_by_id' => $student->id,
                //     'amount' => $first_person_amount,
                //     'percentage' => $first_per,
                //     'status' => 0,
                //     'percentage_type' => 'first person'
                // ]);

                // if (($second_person_amount) > 0 && ($second_student)) {
                //     $b =   Earning::create([
                //         'user_id' => $second_student->id,
                //         'user_by_id' => $student->id,
                //         'amount' => $second_person_amount,
                //         'percentage' => $second_per,
                //         'status' => 0,
                //         'percentage_type' => 'second person'
                //     ]);
                // }
                // if($ref_by_user_first->created_at >= '2023-11-01' &&  $ref_by_user_first->package_id == 3)
                // {
                //      //--ranks--system--//
                //     $student_total_earning = Earning::where('user_id', $ref_by_user_first->id)->sum('amount');
                //     $count_ref_students = User::where('referral_by', $ref_by_user_first->referral_code)->count();
                //     //--task--//
                //     $tasks = Ranks::where('task_people', '<=', $count_ref_students)
                //     ->orWhere('task_amount', '<=', $student_total_earning)
                //     ->orderBy('task_people', 'desc')
                //     ->first();
                //     if ($tasks) {
                //     $rank_update = User::where('id', $ref_by_user_first->id)->update([
                //         'rank' => $tasks->id,]);
                //     Earning::create([
                //         'user_id' => $ref_by_user_first->id,
                //         'user_by_id' => null,
                //         'amount' => $tasks->reward_amount,
                //         'percentage' => null, 
                //         'status' => 0,
                //         'percentage_type' => 'task completed']);
                //     } 
                // }
                // else
                // {   
                //     if($ref_by_user_first->package_id == 3)
                //     {
                //          $tasks = Ranks::where('task_people', '<=', $count_ref_students)
                //         ->orWhere('task_amount', '<=', $student_total_earning)
                //         ->orderBy('task_people', 'desc')
                //         ->first();

                //          $rank_update = User::where('id', $ref_by_user_first->id)->update([
                //         'rank' => $tasks->id,]);
                //     }

                // }

            }

            // $details = [

            //     'name' => $student->first_name,
            //     'package' => $student->package->package_title,
            //     'verify' => 1,
            // ];

            //  Mail::to($student->email)->send(new Verification_Mail($details));


            return redirect()->back()->with('success', 'Student verify successfully.');
        } else {
            User::where('id', $id)->update([
                'status' => 0,
            ]);
            $details = [
                'name' => $student->first_name,
                'package' => $student->package->package_title,
                'verify' => 0,
            ];

            //  Mail::to($student->email)->send(new Verification_Mail($details));

            return redirect()->back()->with('success', 'Student rejected Successfully.');
        }
    }
    public function update(Request $request, $id)
    {
    }

    /** 
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //   dd($id);
        $std_del = User::where('id', $id)->delete();
        if ($std_del) {
            $earningsExist = Earning::where('user_id', $id)->exists();
            $transactionsExist = Transection::where('user_id', $id)->exists();

            if ($earningsExist || $transactionsExist) {
                // If either earnings or transactions exist for the user
                if ($earningsExist) {
                    Earning::where('user_id', $id)->delete();
                }

                if ($transactionsExist) {
                    Transection::where('user_id', $id)->delete();
                }
            }

            return redirect()->back()->with('success', 'Student deleted successfully');
        } else {

            return redirect()->back()->with('error', 'Something is went wrong');
        }
    }


    public function updateEmail(Request $request)
    {

        // Retrieve the student by ID
        $student = User::find($request->input('student_id'));

        // Check if referral_by code exists, if provided
        if ($request->has('new_ref_by_code')) {
            $referrer = User::where('referral_code', $request->input('new_ref_by_code'))->first();
            if (!$referrer) {
                return redirect()->back()->with('error', 'Referral code not found.');
            }
            $user_email = User::where('email', $request->input('new_email'))->where('id', "!=", $request->input('student_id'))->first();
            if ($user_email) {
                return redirect()->back()->with('error', 'Email already exist.');
            }

            $student->referral_by = $referrer->referral_code;
        }
        // Update the email
        $student->email = $request->input('new_email');
        $student->first_name = $request->input('first_name');
        $student->last_name = $request->input('last_name');
        $student->phone = $request->input('phone');
        $student->save();
        return redirect()->back()->with('success', 'Email and referral code updated successfully.');
        // Return a success response

    }

}
