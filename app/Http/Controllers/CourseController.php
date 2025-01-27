<?php

namespace App\Http\Controllers;

use App\Models\Courses;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use Hash;
use Session;
use Auth;
use App\Models\packages;
use App\Models\Videos;
use App\Models\User;
use Illuminate\Support\Str;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Courses::all();
        // dd($courses ); 
        return view('admin.course.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.course.add-course');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate input fields
        $request->validate([
            'course_title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048', // Accept only JPG or PNG files, up to 2MB
           
        ]);
    
        // Handle the input data
        $input = $request->all();
    
        // Handle image upload
        if ($request->file('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('course-image/'), $filename);
            $input['image'] = $filename;
        } else {
            unset($input['image']); // Remove image field if no file is uploaded
        }
    
       
    
        // Save the course to the database
        Courses::create($input);
    
        // Redirect with a success message
        return redirect()->route('courses.index')->with('success', 'Course saved successfully!');
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
        $courses = Courses::find($id);
        return view('admin.course.edit-course', compact('courses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();

        $request->validate([
            'image' => 'image|mimes:jpeg,png|max:2048', // Add validation for JPG and PNG files, up to 2MB
        ]);
        $courses = Courses::where('id', $id)->first();
        if ($request->file('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move(public_path('course-image/'), $filename);
            $input['image'] = $filename;
        } else {
            unset($input['image']);
        }
        // dd($input, $request->file('image'));
        $courses->update($input);
        return redirect()->route('courses.index')->with('success', 'Course updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $courses_del = Courses::where('id', $id)->delete();
        if ($courses_del) {
            return redirect()->back()->with('success', 'Courses deleted successfully');
        }else{
            return redirect()->back()->with('error', 'Please first delete videos of this course');
        }
       
    }
    public function certificate(Request $request, $courseTitle)
    {   
        $student = User::where('id', Auth::user()->id)->first();
    
        $student_name = $student->first_name . '-' . $student->last_name;
        $course_title=$courseTitle;
        return view('student.certificate', compact('student_name', 'course_title'));
        
        
       
    }
    public function free_courses(){
        return view('student.free-courses');
    }
    public function showFreeCourseVideo($id)
{
    $course = Courses::findOrFail($id); // Retrieve the course based on the ID
    if($course->course_type == 0 || $course->course_type == 2) {
      $all_video =  Videos::where('courses_id', $id)->get();
      return view('student.free-courses-videos', compact('all_video','course'));

    }else{
        return redirect()->back()->with('error', '');
    }
}



}