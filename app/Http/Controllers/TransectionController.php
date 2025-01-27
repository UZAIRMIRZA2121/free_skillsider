<?php

namespace App\Http\Controllers;

use App\Models\Earning;
use App\Models\Notification;
use App\Models\Transection;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Mail;

class TransectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Request $request, Transection $Transection, $id)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transection  $transection
     * @return \Illuminate\Http\Response
     */
    public function show(Transection $transection)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transection  $transection
     * @return \Illuminate\Http\Response
     */
    public function edit(Transection $transection)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transection  $transection
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();
        if ($request->file('image')) {
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
        }
        if (Auth::user()->role == 1 || Auth::user()->role == 4) {
            Earning::where('status', 2)
                ->where('user_id', $id)
                ->update([
                    'status' => 1,
                    'updated_at' => Carbon::now(),
                ]);


            $transection = Transection::where('user_id', $id)->where('status', 0)->first();


            if ($transection) {
                if ($request->file('image')) {
                    $file = $request->image;
                    $extension = $file->getClientOriginalExtension();
                    $filename = time() . '.' . $extension;
                    $file->move(public_path('receipt-image/'), $filename);
                    $input['receipt'] = $filename;
                } else {
                    unset($input['receipt']);
                }

                $input['assign_by_id'] = Auth::user()->id;
                $input['status'] = 1;

                $transection->update($input);
                $email = $transection->user->email;
                $receiver_name = $transection->user->first_name;
                
                $subject = "Payment Successfully Processed";
                $messageContent = "Dear " . $receiver_name . ", 
                We are pleased to inform you that your withdrawal request of Rs" . $transection->amount . " has been successfully processed.
                If you have any questions or encounter any issues, please don't hesitate to contact us.
                Thank you for choosing our service.
                
                Best regards,
                SkillSider Team";
                
                Mail::raw($messageContent, function ($message) use ($email, $subject) {
                    $message->to($email)
                            ->subject($subject)
                            ->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
                });
                
                $notification = Notification::create([
                    'title' => 'Withdrawal Received Successfully. ',
                    'message' => 'Dear ' . $receiver_name . ', Your withdrawal of Rs' . $transection->amount . ' has been successfully processed. If you have any questions, feel free to contact us. Thank you for choosing our service.',
                    'created_by' => 1, // The admin who created the notification
                ]);
                
                // Attach notification to the specific user
                $notification->users()->attach($transection->user->id, ['is_read' => 0]);
                

                return redirect()->back()->with('success', 'Payment has been sent successfully.');
            } else {
                return redirect()->back()->with('error', 'Transaction not found or status is not 0.');
            }
        } else {
            return redirect()->back()->with('error', 'Transaction not found or status is not 0.');
        }


    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transection  $transection
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transection $transection)
    {
        //
    }
}