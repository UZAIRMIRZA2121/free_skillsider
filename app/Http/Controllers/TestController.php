<?php

namespace App\Http\Controllers;

use App\Models\TestResult;
use App\Models\TestAttempt;
use App\Models\Courses;
use App\Models\Packages;
use App\Models\Question;
use App\Models\VideoHistory;
use Carbon\Carbon;
use Illuminate\Http\Request;

use Auth;
use Log;

class TestController extends Controller
{
    // Display a listing of the testspublic function index()
    public function index()
    {
        // Fetch the tests for the authenticated user
        $tests = TestResult::where('user_id', Auth::id())->get();
    
        // Fetch the user's package based on the user's package_id
        $packages = Packages::where('id', Auth::user()->package_id)->get();
    
        // Initialize an empty array to store all course IDs
        $allCourseIds = [];
    
        // Loop through each package and extract the course_ids
        foreach ($packages as $package) {
            // Convert the comma-separated course_id string into an array of integers
            $courseIds = explode(',', $package->course_id);
            // Merge all course_ids into a single array (avoiding duplicates)
            $allCourseIds = array_merge($allCourseIds, $courseIds);
        }
    
        // Remove duplicates from the merged course IDs
        $allCourseIds = array_unique($allCourseIds);
    
        // Fetch all courses based on the merged and unique course_ids
        $courses = Courses::whereIn('id', $allCourseIds)->get();
    
        // Initialize an empty array to store courses where the video count matches the watched count
        $completedCourses = [];
    
        // Loop through each course to get the video history count and compare with total videos
        foreach ($courses as $course) {
            // Get the count of video history for this specific course
            $video_history = VideoHistory::where('course_id', $course->id)->count();
            
            // Get the total count of videos for this course
            $count_video = $course->videos->count();
    
            // If the number of watched videos matches the total video count, add to completedCourses
            if ($count_video == $video_history) {
                $completedCourses[] = $course;
            }
        }
  
        // Return the data to the view
        return view('admin.tests.index', compact('tests', 'packages', 'completedCourses'));
    }
    
    




    // Show the form for creating a new test
    public function create()
    {
        $courses = Courses::all();  // Get all courses
        return view('admin.tests.create', compact('courses'));
    }
    
    public function store()
    {
     
    }


    // Store a newly created test in storage
    public function test_start(Request $request)
    {
        // Validate the incoming request
        $data = $request->validate([
            'course_id' => 'required|exists:courses,id',
        ]);

        // Set the user_id as the authenticated user's ID
        $data['user_id'] = Auth::id();

        // Check if there's an existing test result with the same user_id and course_id
        $test = TestResult::where('user_id', $data['user_id'])
            ->where('course_id', $data['course_id'])
            ->first();

        if ($test) {
            if ($test->status == 'passed') {
                return redirect()->back()->with('error', "Apologies, you have already completed and passed the test. You will not be able to retake it.");

            } elseif ($test->status == 'failed') {
                // Check if the 'created_at' is more than 24 hours ago
                if ($test->created_at->diffInHours(Carbon::now()) > 24) {
                    // Create a new test record since the existing one is older than 24 hours
                    $test->status = null; // Set initial status or other default values
                    $test->sub_status = 'start'; // Set initial status or other default values
                    $test->created_at = Carbon::now(); // Set the current timestamp
                    $test->save();
                    // TestAttempt::where('test_id', $test->id)->delete();
                    //  TestResult::create($data);

                } else {

                    // Calculate the next available attempt time (24 hours after created_at)
                    $nextAttemptTime = $test->created_at->addHours(24)->format('d M Y h:i A');
                    // Return error with the calculated next attempt time
                    return redirect()->back()->with('error', "You have already attended test. You can attend test once in 24 hours. You can attempt the test after {$nextAttemptTime}");
                }
            }
        } else {
            // If no test result exists, create a new one
             $test = TestResult::create($data);
        }

       
     
        // Pass the questions to the view
        // return view('admin.tests.teststart', compact('questions', 'test'));
        return redirect()->route('std.tests.start', ['test_id' => $test->id])->with('success', "You may now start the test.");

    }
    public function std_test_start($test_id)
    {

     
      
       

        // Check if there's an existing test result with the same user_id and course_id
        $test = TestResult::find(id: $test_id);
        
            if ($test->status == 'passed') {
                return redirect()->back()->with('error', "Apologies, you have already completed and passed the test. You will not be able to retake it.");

            } else if ($test->status == 'failed'){
                $nextAttemptTime = $test->created_at->addHours(24)->format('d M Y h:i A');
                return redirect()->back()->with('error', "You have already attended test. You can attend test once in 24 hours. You can attempt the test after {$nextAttemptTime}");
             
            }
      
        
        // Fetch 10 random questions for the selected course_id
        $questions = Question::where('course_id', $test['course_id'])
            ->inRandomOrder()
            ->limit(10)
            ->get();
         
        // Pass the questions to the view
        return view('admin.tests.teststart', compact('questions', 'test'));
    }


    // Display the specified test
    public function show($id)
    {
        $test = TestResult::findOrFail($id);
        return view('admin.tests.show', compact('test'));
    }

    // Show the form for editing the specified test
    public function edit($id)
    {
        $test = TestResult::findOrFail($id);
        $courses = Course::all();  // Get all courses
        return view('admin.tests.edit', compact('test', 'courses'));
    }

    // Update the specified test in storage
    public function update(Request $request, $id)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'status' => 'required|in:passed,failed',
            'sub_status' => 'required|in:start,end',
        ]);

        $test = TestResult::findOrFail($id);
        $test->update($request->all());
        return redirect()->route('tests.index')->with('success', 'Test updated successfully');
    }

    // Remove the specified test from storage
    public function destroy($id)
    {
        $test = TestResult::findOrFail($id);
        $test->delete();
        return redirect()->route('tests.index')->with('success', 'Test deleted successfully');
    }

    // --- Test Attempt Methods --- //

    // Display a listing of the test attempts for a specific test
    public function indexAttempts($testId)
    {
        $testAttempts = TestAttempt::where('test_id', $testId)->get();
        return view('admin.test_attempts.index', compact('testAttempts', 'testId'));
    }

    // Show the form for creating a new test attempt for a specific test
    public function createAttempt($testId)
    {
        $test = TestResult::findOrFail($testId);
        $questions = Question::where('course_id', $test->course_id)->get();
        return view('admin.test_attempts.create', compact('test', 'questions'));
    }

    // Store a newly created test attempt in storage
    public function storeAttempt(Request $request, $testId)
    {
        $request->validate([
            'question_id' => 'required|exists:questions,id',
            'correct_option' => 'required|integer',
            'selected_option' => 'required|integer',
        ]);

        $data = $request->all();
        $data['test_id'] = $testId;
        TestAttempt::create($data);

        return redirect()->route('tests.index')->with('success', 'Test attempt recorded successfully');
    }

    // Display the specified test attempt
    public function showAttempt($testId, $id)
    {
        $testAttempt = TestAttempt::findOrFail($id);
        return view('admin.test_attempts.show', compact('testAttempt', 'testId'));
    }

    // Show the form for editing the specified test attempt
    public function editAttempt($testId, $id)
    {
        $testAttempt = TestAttempt::findOrFail($id);
        $questions = Question::where('course_id', $testAttempt->testResult->course_id)->get();
        return view('admin.test_attempts.edit', compact('testAttempt', 'questions', 'testId'));
    }

    // Update the specified test attempt in storage
    public function updateAttempt(Request $request, $testId, $id)
    {
        $request->validate([
            'question_id' => 'required|exists:questions,id',
            'correct_option' => 'required|integer',
            'selected_option' => 'required|integer',
        ]);

        $testAttempt = TestAttempt::findOrFail($id);
        $testAttempt->update($request->all());

        return redirect()->route('tests.index')->with('success', 'Test attempt updated successfully');
    }

    // Remove the specified test attempt from storage
    public function destroyAttempt($testId, $id)
    {
        $testAttempt = TestAttempt::findOrFail($id);
        $testAttempt->delete();

        return redirect()->route('tests.index')->with('success', 'Test attempt deleted successfully');
    }

    // PackageController.php
    public function getCoursesByPackage($packageId)
    {
        // Fetch the package by ID
        $package = Packages::find($packageId);

        if ($package) {
            // Split the course_ids stored as a string and fetch the related courses
            $courseIds = explode(',', $package->course_id);

            // Fetch courses using the course_ids array
            $courses = Courses::whereIn('id', $courseIds)->get();

            // Return the courses as JSON
            return response()->json($courses);
        }

        // If no package found, return empty array
        return response()->json([]);
    }
    public function submit_test(Request $request)
    {

        $testId = $request->input('test_id');
        $responses = [];
        $correctAnswers = 0; // Counter for correct answers
        $details = []; // To store question details
        $testResult = TestResult::find($testId);


        foreach ($request->all() as $key => $value) {
            if (strpos($key, 'question_') === 0) {
                $questionId = str_replace('question_', '', $key);
                $question = Question::find($questionId);

                if (!$question) {
                    continue;
                }

                $isCorrect = $question->correct_option == $value; // Check if the selected option is correct
                if ($isCorrect) {
                    $correctAnswers++;
                }

                // Store question details
                $details[] = [
                    'question' => $question->question_text,
                    'correct_option' => $question->correct_option,
                    'selected_option' => $value,
                    'is_correct' => $isCorrect
                ];

                $responses[] = [
                    'test_id' => $testId,
                    'question_id' => $questionId,
                    'correct_option' => $question->correct_option,
                    'selected_option' => $value,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }


        if (!$testResult->status) {
            TestAttempt::insert($responses);

        }
        // Insert responses into the database

        // Determine pass or fail
        $totalQuestions = count($responses);
        $requiredCorrectAnswers = 8; // Minimum correct answers to pass
        $status = $correctAnswers >= $requiredCorrectAnswers ? 'passed' : 'failed';

        // Update the test result
        $testResult = TestResult::find($testId);
        if ($testResult) {
            $testResult->status = $status;
            $testResult->sub_status = 'end';
            $testResult->save();
        }


        return view('admin.tests.result', compact('status', 'correctAnswers', 'totalQuestions', 'details','testResult'));
    }
    public function reviewReport($id)
    {
        $testResult = TestResult::findOrFail($id); // Fetch the test result by ID

        // Fetch all attempts for this test
        $testAttempts = TestAttempt::where('test_id', $id)->get();

        $details = $testAttempts->map(function ($attempt) {
            $question = Question::find($attempt->question_id);
            return [
                'question' => $question->question_text ?? 'Question not found',
                'correct_option' => $attempt->correct_option,
                'selected_option' => $attempt->selected_option,
                'is_correct' => $attempt->correct_option == $attempt->selected_option,
            ];
        });

        $totalQuestions = $details->count();
        $correctAnswers = $details->where('is_correct', true)->count();
        $status = $testResult->status;
        $nextAttemptTime = $testResult->created_at->addHours(24)->format('d M Y h:i A');
     
        return view('admin.tests.result', compact('status', 'correctAnswers', 'totalQuestions', 'details', 'testResult', 'nextAttemptTime','testResult'))
            ->with('error', "Apologies, you have already completed and passed the test. You will not be able to retake it.");

    }


}
