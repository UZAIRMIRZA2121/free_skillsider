<?php

namespace App\Http\Controllers;

use App\Models\Videos;
use App\Models\Courses;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use Hash;
use Session;
use Auth;
use App\Models\packages;
use App\Models\Reviews;
use App\Models\User;
use Illuminate\Support\Str;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reviews = Reviews::all();
 

        return view('admin.review.index', compact('reviews'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */ 
    public function create()
    {
        $videos = Videos::all();
        return view('admin.review.add-review', compact('videos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        
    //   dd($request->all());
        $request->validate([
            'video_id' => 'required',
            'video_thumbnail' => 'required',

 
        ]);
        
        if (!empty($request->video_thumbnail)) {
            $request->validate([
                'video_thumbnail' => 'required|image|mimes:jpeg,png|max:2048', // Adjust validation for JPG and PNG files, up to 2MB
            ]);
            $file = $request->video_thumbnail;
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move(public_path('review_image/'), $filename);
            $data['image'] = 'public/review_image/' . $filename;

            Reviews::create([
                'video_id' => $request->video_id,
                'review' => $request->review,
                'video_thumbnail' =>  $filename,
                'created_at' => carbon::now(),
                'updated_at' => carbon::now(),
            ]);
        
        return redirect()->route('review.index')->with('success', 'Review saved successfully!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\videos  $videos
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\videos  $videos
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
     
        $review = Reviews::find($id);
         $videos = Videos::all();
        return view('admin.review.edit-review', compact('review','videos','id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\videos  $videos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
          $input = $request->all();
        if ($request->video_thumbnail) {
            $request->validate([
                'video_thumbnail' => 'required|image|mimes:jpeg,png|max:2048', // Adjust validation for JPG and PNG files, up to 2MB
            ]);
            $file = $request->video_thumbnail;
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move(public_path('review_image/'), $filename);
            $input['video_thumbnail'] = $filename;
        }else{
            unset($input['video_thumbnail']);
        }
        // dd($input['image']);
        $reviews = Reviews::find($id);
        $reviews->update($input);
        return redirect()->route('review.index')->with('success', 'Review updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\videos  $videos
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $reviews = Reviews::where('id', $id)->delete();
        if($reviews)
        {
             return redirect()->back()->with('success', 'Review deleted successfully');
        }  
    }
}