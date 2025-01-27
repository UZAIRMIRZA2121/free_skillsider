<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use Hash;
use Session;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Skillsider_payment_method;
use Illuminate\Support\Str;
use App\Http\Controllers\toastr;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {    $exist ="";
        $payment_methods = Skillsider_payment_method::all()->where('user_id', Auth::user()->id);
   if(Auth::user()->role == 0)
   {
        $exist = Skillsider_payment_method::where('user_id', Auth::user()->id)->exists() ;
   }  
        
        
        return view('admin.payments.index', compact('payment_methods','exist'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.payments.add_payments');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'account_number' => 'required',
            'account_name' => 'required',
            'bank' => 'required',
        ]);

        
        $input = $request->all();

        if($request->logo)
        {
            $file = $request->logo;
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move(public_path('payment-method-image/'), $filename);
            $input['logo'] = $filename;
        }
           
        $input['user_id'] = Auth::user()->id;
        
        // dd($input);
        $paymentcreate = Skillsider_payment_method::create($input);
        if ($paymentcreate) {
             if(Auth::user()->role == 1){
          return redirect()->route('payment.admin.store')->with('success', 'Payment saved successfully!');
        }else
        {
             return redirect()->route('student.payments')->with('success','Payment saved successfully!');
        }
          
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $payment_method = Skillsider_payment_method::find($id);
        return view('admin.payments.edit', compact('payment_method'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {    

        $payment_method = Skillsider_payment_method::find($id);
    
        if (!$payment_method) {
              if(Auth::user()->role == 1)
    {
            return redirect()->route('payment.admin.store')->with('error', 'Payment method not found.');
        }else
        {
               return redirect()->route('payment.index')->with('error', 'Payment method not found.');
        }
      
         
        }
        $input = $request->all();
        if ($request->hasFile('logo')) {

            $request->validate([
                'logo' => 'image|mimes:jpeg,png|max:2048', // Add validation for JPG and PNG files, up to 2MB
                
            ]);
            $file = $request->file('logo');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move(public_path('payment-method-image/'), $filename);
            $input['logo'] = $filename;
        } else {
            unset($input['logo']);
        }
          $input['bank']=$request->method;
      
        $payment_method->update($input);
    
        
    if(Auth::user()->role == 1)
    {
          return redirect()->route('payment.admin.index')->with('success', 'Payment method updated successfully');
        }else
        {
             return redirect()->route('student.payments')->with('success','Payment method updated successfully');
        }
      

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
     $payment_method_del =   Skillsider_payment_method::where('id', $id)->delete();
     if($payment_method_del)
     {  
        if(Auth::user()->role == 1){
             return redirect()->back()->with('success','Payment Method deleted successfully');
        }else
        {
             return redirect()->route('student.payments')->with('success','Payment Method deleted successfully');
        }
       
     }
        return redirect()->back()->with('error','Something is went wrong');
    }

    public function payment_request()
    {
        return view('admin.payments.payment-request');
    }
    public function confirm_payment()
    {
        return view('admin.payments.payment-request');
    }
    public function recieved_payment()
    {
        return view('admin.payments.recieved_payment');
    }
      public function package_update()
    {
        return ('khgj');
    }
}