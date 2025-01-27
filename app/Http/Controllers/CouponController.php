<?php

namespace App\Http\Controllers;
use App\Models\Coupon;
use App\Models\Packages;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coupons = Coupon::all();
    
        foreach ($coupons as $coupon) {
            $packageIds = json_decode($coupon->pck_id); // Assuming the packages are stored as JSON
            $coupon->packages = packages::whereIn('id', $packageIds)->get(); // Fetch the packages by ID
        }
       return view("admin.coupen.index", compact("coupons"));  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $all_packages = Packages::all();
        return view("admin.coupen.add-coupen", compact('all_packages'));  
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validation rules
        $validatedData = $request->validate([
            'name' => 'required|string|max:255', // Assuming you want the coupon code to be unique
            'code' => 'required|string|max:255|unique:coupons,code', // Assuming you want the coupon code to be unique
            'percentage' => 'required|numeric|min:0|max:100', // Ensures the percentage is between 0 and 100
            'all_packages' => 'required|array|min:1', // Ensures at least one package is selected
            'all_packages.*' => 'exists:packages,id', // Ensures all selected package ids exist in the database
            'start_date' => 'required|date|before_or_equal:end_date', // Ensure the start date is before or equal to the end date
            'end_date' => 'required|date|after_or_equal:start_date', // Ensure the end date is after or equal to the start date
        ]);
    
        // Create the coupon
        Coupon::create([
            'name' => $validatedData['name'],
            'code' => $validatedData['code'],
            'percentage' => $validatedData['percentage'],
            'start_time' => $validatedData['start_date'],
            'end_time' => $validatedData['end_date'],
            // Store selected package ids as an array or related table (e.g., coupon_package)
            // Assuming there is a pivot table for many-to-many relationship with packages
            'pck_id' => json_encode($validatedData['all_packages']),
        ]);
    
        // Redirect back with success message
        return redirect()->route('coupons.index')->with('success', 'Coupon added successfully.');
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update( $id)
    {   
        // dd($id);
        $coupons = Coupon::all()->where('id', $id)->first();
        if ($coupons->status == 0) {
           Coupon::where('id', $id)->update([
                'status' => 1
            ]);
            return redirect()->route('coupons.index')->with('success', 'Coupon Activate.');
        }
          else
          {
            Coupon::where('id', $id)->update([
                'status' => 0
            ]);
            return redirect()->route('coupons.index')->with('success', 'Coupon Deactivate.');
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
       
      $coupon_del =   Coupon::where('id', $id)->delete();
     if($coupon_del)
     {
        return redirect()->back()->with('success','Coupon deleted successfully');
     }
        return redirect()->back()->with('error','Something is went wrong');
    }
    // CouponController.php

public function checkCoupon(Request $request)
{
    $couponCode = $request->input('coupon_code');
    $coupon = Coupon::where('code', $couponCode)->where('status',1)->where('end_time' , '>=',Carbon::now())->first();

    if ($coupon) {
        // Coupon code exists, return coupon details
        return response()->json([
            'exists' => true,
            'coupon' => $coupon,
        ]);
    } else {
        // Coupon code does not exist
        return response()->json([
            'exists' => false,
        ]);
    }
}

public function coupon_code()
{
    $coupons = Coupon::where('end_time' , '>=',Carbon::now())->get();

    foreach ($coupons as $coupon) {
        $packageIds = json_decode($coupon->pck_id); // Assuming the packages are stored as JSON
        $coupon->packages = packages::whereIn('id', $packageIds)->get(); // Fetch the packages by ID
    }
   return view("admin.students.coupon_code", compact("coupons"));  
}
}
