<?php

namespace App\Http\Controllers;

use App\Models\VideoHistory;
use App\Models\Videos;
use Auth;
use Illuminate\Http\Request;
use Log;

class VideoHistoryController extends Controller
{
    /**
     * Display a listing of the video histories.
     */
    public function index()
    {
        $videoHistories = VideoHistory::all();
        return response()->json($videoHistories);
    }

    /**
     * Show the form for creating a new video history.
     */
    public function create()
    {
        // Normally used for rendering a form, not necessary for API.
    }

    /**
     * Store a newly created video history in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'video_id' => 'required',
        ]);
    
        // Fetch the video details to get the course_id
        $video = Videos::where('id', $validated['video_id'])->first();
    
        if (!$video) {
            return response()->json(['message' => 'Video not found'], 404);
        }
    
        // Check if the video history already exists for the same user, course, and video
        $existingHistory = VideoHistory::where('video_id', $validated['video_id'])
            ->where('user_id', Auth::id())
            ->where('course_id', $video->courses_id)
            ->first();
    
        if ($existingHistory) {
            // If a record already exists, return a success response without changes
            return response()->json([
                'message' => 'Video history already exists',
                'data' => $existingHistory
            ], 200);
        }
    
        // Create a new video history record
        $videoHistory = VideoHistory::create([
            'video_id' => $validated['video_id'],
            'user_id' => Auth::id(),
            'course_id' => $video->courses_id, // Assuming `course_id` exists in the videos table
            'watched' => 1, // Mark as watched
        ]);
    
        // Return a JSON response with the created record
        return response()->json([
            'message' => 'Video history updated successfully',
            'data' => $videoHistory
        ], 200);
    }
    
    
    

    /**
     * Display the specified video history.
     */
    public function show(VideoHistory $videoHistory)
    {
        return response()->json($videoHistory);
    }

    /**
     * Show the form for editing the specified video history.
     */
    public function edit(VideoHistory $videoHistory)
    {
        // Normally used for rendering a form, not necessary for API.
    }

    /**
     * Update the specified video history in storage.
     */
    public function update(Request $request, VideoHistory $videoHistory)
    {
        $request->validate([
            'watched' => 'sometimes|boolean',
        ]);

        $videoHistory->update($request->all());
        return response()->json($videoHistory);
    }

    /**
     * Remove the specified video history from storage.
     */
    public function destroy(VideoHistory $videoHistory)
    {
        $videoHistory->delete();
        return response()->json(['message' => 'Video history deleted successfully']);
    }
}
