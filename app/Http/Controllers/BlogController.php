<?php 
namespace App\Http\Controllers;

use App\Models\Blog;
use Auth;
use Illuminate\Http\Request;
use Storage;

class BlogController extends Controller
{
    // Display a listing of the resource
    public function index()
    {
        $blogs = Blog::all();
        
        // For Web/Blade views
        return view('admin.blogs.index', compact('blogs'));  // Passing $blogs to the Blade view
        
        // For API responses
        // return response()->json($blogs);
    }

    // Show the form for creating a new resource
    public function create()
    {
        return view('admin.blogs.create');  // Returning the view for the form to create a new blog
    }

    // Store a newly created resource in storage
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'desc' => 'required|string',
            'long_desc' => 'required|string', // Validate long_desc content
            'img' => 'required|image|mimes:jpeg,png,jpg,gif,svg', // Image validation for the primary image
        ]);
    
        $validated['user_id'] = Auth::id();
    
        // Handle the main blog image upload
        if ($request->hasFile('img')) {
            $image = $request->file('img');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('blogs_img'), $imageName);
            $validated['img'] = 'blogs_img/' . $imageName;
        }
    
        // Create the blog post and save it to the database
        Blog::create($validated);
    
        return redirect()->route('blogs.index')->with('success', 'Blog created successfully!');
    }
    

    
    
    public function show($title)
    {
        $formattedTitle = str_replace('-', ' ', $title);
        $blog = Blog::with('user')->where('title',$formattedTitle)->first();
   
        // Fetch other blogs except the current one
        $otherBlogs = Blog::where('id', '!=', value: $blog->id)->latest()->take(5)->get(); // Adjust the number as needed
    
        return view('student.blog-show', compact('blog', 'otherBlogs'));
    }
    


    // Display the specified resource
   

    // Show the form for editing the specified resource
    public function edit($id)
    {
        $blog = Blog::findOrFail($id);

        // For Web/Blade views
        return view('admin.blogs.edit', compact('blog'));  // Returning the edit form with the blog data
        
        // For API response
        // return response()->json($blog);
    }

    // Update the specified resource in storage
  
public function update(Request $request, $id)
{
    // Validate the incoming data
    $request->validate([
        'title' => 'required|string|max:255',
        'desc' => 'required|string',
        'long_desc' => 'required|string',
        'img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
    ]);
    $blog = Blog::findOrFail($id);

          // Handle the image upload (only if a new image is uploaded)
          if ($request->hasFile('img')) {
            // Get the file
            $image = $request->file('img');
    
            // Generate a unique name for the image
            $imageName = time() . '_' . $image->getClientOriginalName();
    
            // Move the image to the public/blogs_img directory
            $image->move(public_path('blogs_img'), $imageName);
    
            // Set the image path for saving in the database
            $imagePath = 'blogs_img/' . $imageName;
    
            // Delete the old image if it exists
            if ($blog->img && file_exists(public_path($blog->img))) {
                unlink(public_path($blog->img));
            }
        } else {
            // If no new image is uploaded, keep the existing image
            $imagePath = $blog->img;
        }
    // Find the blog to update

        // Add the image path and long_desc to the validated data
       
    // Update the blog's details
    $blog->title = $request->title;
    $blog->desc = $request->desc;
    $blog->long_desc = $request->long_desc;
    $blog->img = $imagePath;



    $blog->save();

    // Redirect back with a success message
    return redirect()->route('blogs.index')->with('success', 'Blog updated successfully!');
}
    

    // Remove the specified resource from storage
    public function destroy($id)
    {
        // Find the blog by its ID or fail if not found
        $blog = Blog::findOrFail($id);
    
        // Check if the blog has an associated image and delete it if it exists
        if ($blog->img && file_exists(public_path($blog->img))) {
            unlink(public_path($blog->img)); // Delete the image from the server
        }
    
        // Delete the blog post
        $blog->delete();
    
        // For Web/Redirect: Redirect to the blogs index page with a success message
        return redirect()->route('blogs.index')->with('success', 'Blog deleted successfully!');
        
        // For API response: Return a JSON response indicating success
        // return response()->json(['message' => 'Blog deleted successfully']);
    }

    
    public function uploadImage(Request $request)
    {
        // Validate the image upload
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Add your preferred validation
        ]);
    
        // Store the image in the 'blogs_images' folder
        $image = $request->file('image');
        $imageName = time() . '_' . $image->getClientOriginalName();
        $image->move(public_path('blogs_img'), $imageName);
    
        // Return the image URL as a JSON response
        return response()->json([
            'success' => true,
            'url' => asset('blogs_img/' . $imageName)  // URL to be inserted into Quill editor
        ]);
    }
    
    
}
