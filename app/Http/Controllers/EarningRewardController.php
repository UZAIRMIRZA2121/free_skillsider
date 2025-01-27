<?php

namespace App\Http\Controllers;

use App\Models\EarningReward;
use App\Models\Earning;
use App\Models\ClaimReward;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EarningRewardController extends Controller
{

    public function index()
    {
        $earningRewards = EarningReward::all();
        return view('admin.earning-rewards.index', compact('earningRewards'));
    }

    public function create()
    {
        return view('admin.earning-rewards.create');
    }

    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'reward' => 'required|string',
            'target_amount' => 'required|numeric|min:1',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image
        ]);

        // Handle the image upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');

            // Generate a unique file name using microtime
            $fileName = microtime(true) . '.' . $file->getClientOriginalExtension();

            // Store the image in the public/reward-img directory
            $file->move(public_path('reward-img'), $fileName);

            // Save the path relative to the public directory
            $imagePath = 'reward-img/' . $fileName;
        }

        // Prepare the data for insertion
        $data = $request->all();
        $data['image'] = $imagePath;

        // Create the earning reward record
        EarningReward::create($data);

        return redirect()->route('earning-rewards.index')->with('success', 'Earning reward created successfully.');
    }



    public function show(EarningReward $earningReward)
    {
        return view('admin.earning-rewards.show', compact('earningReward'));
    }

    public function edit(EarningReward $earningReward)
    {
        return view('admin.earning-rewards.edit', compact('earningReward'));
    }

    public function update(Request $request, EarningReward $earningReward)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'reward' => 'required|string',
            'target_amount' => 'required|string|numeric|min:1',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Image validation (optional)
        ]);

        // Handle the image upload (if present)
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($earningReward->image && file_exists(public_path($earningReward->image))) {
                unlink(public_path($earningReward->image));
            }

            // Handle the new image upload
            $file = $request->file('image');
            $fileName = microtime(true) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('reward-img'), $fileName);
            $imagePath = 'reward-img/' . $fileName;
        } else {
            // If no new image is uploaded, retain the existing image
            $imagePath = $earningReward->image;
        }

        // Update the earning reward with the new image (if any)
        $earningReward->update([
            'name' => $request->input('name'),
            'reward' => $request->input('reward'),
            'target_amount' => $request->input('target_amount'),
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
            'image' => $imagePath, // Update the image path
        ]);

        return redirect()->route('earning-rewards.index')->with('success', 'Earning reward updated successfully.');
    }


    public function destroy(EarningReward $earningReward)
    {
        try {
            // Check if the image file exists and delete it from the server
            if ($earningReward->image && file_exists(public_path($earningReward->image))) {
                unlink(public_path($earningReward->image)); // Delete the image file
            }

            // Delete the EarningReward record
            $earningReward->delete();

            // Redirect with success message
            return redirect()->route('earning-rewards.index')->with('success', 'Earning reward deleted successfully.');
        } catch (\Exception $e) {
            // Log the error for debugging
            \Log::error('Error deleting earning reward: ' . $e->getMessage());

            // Return an error message to the user
            return redirect()->route('earning-rewards.index')->with('error', 'There was an error deleting the earning reward. Please try again.');
        }
    }

    // public function stdindex()
    // {
    //     // Get all EarningReward records
    //     $earningRewards = EarningReward::all();

    //     // Get the authenticated user's ID
    //     $userId = Auth::id();

    //     // Initialize a variable to hold the total earnings
    //     $totalEarnings = 0;

    //     // Initialize an array to hold unclaimed earning rewards
    //     // $unclaimedRewards = [];

    //     $rewardID = null; // Initialize rewardID outside the loop

    //     // Loop through each EarningReward record
    //     foreach ($earningRewards as $earningReward) {
    //         // Get the start and end dates from the current EarningReward record
    //         $earningRewardsStartDate = $earningReward->start_date;
    //         $earningRewardsEndDate = $earningReward->end_date;

    //         // Retrieve earnings within the specified date range and for the authenticated user
    //         $earnings = Earning::where('user_id', $userId)
    //             ->whereBetween('created_at', [$earningRewardsStartDate, $earningRewardsEndDate])
    //             ->sum('amount'); // Sum up the 'amount' column to get total earnings

    //         // Add the earnings for the current EarningReward period to the total earnings
    //         // $totalEarnings = $earnings;

    //         // Check if the current EarningReward ID has been claimed by the user
    //         $claimed = ClaimReward::where('user_id', $userId)
    //             ->where('reward_id', $earningReward->id)
    //             ->first();
    //         // Get the first matching claimed reward

    //         // Check if claimed reward exists
    //         if ($claimed) {
    //             $rewardID = $claimed->reward_id; // Assign rewardID if claimed reward exists
    //         }
    //     }
    //     // Now you can use $rewardID outside the loop

    //     return view('admin.earning-rewards.index', compact('earningRewards', 'totalEarnings', 'rewardID',));
    // }

    public function stdindex()
    {
        // Get all EarningReward records
        $earningRewards = EarningReward::all();

        // Now you can use $rewardID outside the loop

        return view('admin.students.earning.index', compact('earningRewards'));
    }
    public function stdshow($id)
    {
        // Retrieve the reward by ID
        $earningRewards = EarningReward::findOrFail($id);
 
        // Get the authenticated user's ID
        $userId = Auth::id();

        // Initialize a variable to hold the total earnings
        $totalEarnings = 0;

        $claimReward = ClaimReward::where('user_id', Auth::id())->where('reward_id', $id)->first();

    
        // Return the view and pass the reward data
        return view('admin.students.earning.single-reward', compact('earningRewards','claimReward'));
    }

    public function claim($earning_reward)
    {
        // Your logic for claiming the reward with the given $earning_reward ID
        // You can use $earning_reward to identify the specific reward to claim

        // For example, if you need to find the reward with this ID:
        $reward = EarningReward::find($earning_reward);
        $ClaimReward = ClaimReward::where('user_id', Auth::id())->where('reward_id', $earning_reward)->first();

        if (!$ClaimReward) {
            ClaimReward::create([
                'user_id' => Auth::id(),
                'reward_id' => $earning_reward,
            ]);
            return redirect()->back()->with('success', 'Claim reward successfully');
        }
        // Then you can proceed with your claim logic


        return redirect()->back()->with('error', 'You Have already claimed');
        // This will return a view named 'claim-reward' and pass the $reward variable to it
    }
    public function claimrewardsindexstd()
    {

        $claimRewards = ClaimReward::where('user_id', '=', Auth::id())->get();

        return view('admin.claim-rewards.index', compact('claimRewards'));
    }

    public function claimrewardsindex()
    {

        $claimRewards = ClaimReward::all();

        return view('admin.claim-rewards.index', compact('claimRewards'));
    }

    public function changeStatus($id, Request $request)
    {
        $claimReward = ClaimReward::find($id);
        if ($claimReward) {
            $claimReward->status = $request->input('status');
            $claimReward->save();
            return redirect()->back()->with('success', 'Status updated successfully');
        }
        return redirect()->back()->with('error', 'Failed to update status');
    }
}
