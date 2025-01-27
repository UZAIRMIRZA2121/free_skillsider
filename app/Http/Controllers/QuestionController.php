<?php

namespace App\Http\Controllers;

use App\Models\Courses;
use App\Models\Question;
use App\Models\Course;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    // Display a listing of the questions
    public function index()
    {
        $questions = Question::all();
        return view('admin.questions.index', compact('questions'));
    }

    // Show the form for creating a new question
    public function create()
    {
        $courses = Courses::all(); // Fetch all courses for dropdown
        return view('admin.questions.create', compact('courses'));
    }

    // Store a newly created question in storage
    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'question_text' => 'required|string',
            'option_1' => 'required|string',
            'option_2' => 'required|string',
            'option_3' => 'required|string',
            'option_4' => 'required|string',
            'correct_option' => 'required|integer|between:1,4',
        ]);

        Question::create($request->all());
 
        return redirect()->route('questions.index')->with('success', 'Question created successfully.');
    }

    // Display the specified question
    public function show(Question $question)
    {
        return view('admin.questions.show', compact('question'));
    }

    // Show the form for editing the specified question
    public function edit(Question $question)
    {
        $courses = Courses::all(); // Fetch all courses for dropdown
        return view('admin.questions.edit', compact('question', 'courses'));
    }

    // Update the specified question in storage
    public function update(Request $request, Question $question)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'question_text' => 'required|string',
            'option_1' => 'required|string',
            'option_2' => 'required|string',
            'option_3' => 'required|string',
            'option_4' => 'required|string',
            'correct_option' => 'required|integer|between:1,4',
        ]);

        $question->update($request->all());
        return redirect()->route('questions.index')->with('success', 'Question updated successfully.');
    }

    // Remove the specified question from storage
    public function destroy(Question $question)
    {
        $question->delete();
        return redirect()->route('questions.index')->with('success', 'Question deleted successfully.');
    }
}
