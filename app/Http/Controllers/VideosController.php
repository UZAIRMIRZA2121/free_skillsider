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
use App\Models\User;
use Illuminate\Support\Str;

class VideosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $videos = videos::all();


        return view('admin.video.index', compact('videos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $courses = courses::select('id', 'course_title')->get();
        return view('admin.video.add-video', compact('courses'));
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
            'video_title' => 'required',
            'video_link' => 'required',
            'course_id' => 'required',
            'video_seq' => 'required',
            'video_duration' => 'required',

        ], [
            'video_title.required' => 'The video title  is required.',
            'video_link.required' => 'The video link  is required.',
            'course_id.required' => 'Please select a course.',
            'video_seq.required' => 'The video sequence  is required.',
            'video_duration.required' => 'The video duartion  is required.'
        ]);
       
        Videos::create([
            'video_seq' => $request->video_seq,
            'video_title' => $request->video_title,
            'video_link' => $request->video_link,
            'courses_id' => $request->course_id,
            'video_duration' => $request->video_duration,
            'video_type' => $request->video_type,
            'resource_link' => $request->resource_link,
            'resource_text' => $request->resource_text,
            'created_at' => carbon::now(),
            'updated_at' => carbon::now(),
        ]);
        return redirect()->route('videos.index')->with('success', 'Video saved successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\videos  $videos
     * @return \Illuminate\Http\Response
     */
    public function show(Videos $videos, $id)
    {
        $video = Videos::find($id);
        $courses = Courses::select('id', 'course_title')->get();
        return view('admin.video.edit-video', compact('video', 'courses'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\videos  $videos
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $videos = Videos::where('id', $id)->first();

        unset($request['_token']);
        if ($videos) {
            $videos->update($request->all());
            return redirect()->route('videos.index')->with('success', 'Package updated successfully.');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\videos  $videos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, videos $videos)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\videos  $videos
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $video_del = videos::where('id', $id)->delete();
        if($video_del)
        {
           return redirect()->back()->with('success','Videos deleted successfully');
        }
           return redirect()->back()->with('error','Something is went wrong');
    }
}