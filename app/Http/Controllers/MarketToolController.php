<?php

namespace App\Http\Controllers;

use App\Models\MarketTool;
use App\Models\MarketToolLink;
use Illuminate\Http\Request;

class MarketToolController extends Controller
{
    // Display a listing of the tools
    public function index()
    {
        $marketTools = MarketTool::with('links')->get();
    
        return view('admin.marketTool.index', compact('marketTools'));
    }

    // Show the form for creating a new tool
    public function create()
    {
        return view('admin.marketTool.create');
    }

    // Store a newly created tool and its links
    public function store(Request $request)
    {
      
       
      
        // Handle the market tool image upload
        if ($request->hasFile('img')) {
            $image = $request->file('img');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/market_tools'), $imageName);
        }
    
        // Store the main market tool
        $marketTool = MarketTool::create([
            'title' => $request->input('title'),
            'img' => $imageName,
        ]);
    
        // Now handle storing the links related to the market tool
        if ($request->has('resources')) {
            foreach ($request->resources as $index => $resource) {
             
    
                // Store the market tool link
                MarketToolLink::create([
                    'mt_id' => $marketTool->id,
                    'name' => $resource['name'],
                    'link' => $resource['link'],
                ]);
            }
        }
 
        // Redirect with success message
        return redirect()->route('market_tools.index')->with('success', 'Market tool created successfully!');
    }
    

    // Show the form for editing the specified tool
    public function edit($id)
    {
        // Retrieve the tool along with its related links
        $tool = MarketTool::with('links')->findOrFail($id);
        
        // Ensure the links are always an array
        $links = $tool->links ?? []; // Default to empty array if no links
        
        // Pass the tool and its links to the view
        return view('admin.marketTool.edit', compact('tool', 'links'));
    }
    // Update the specified tool and its links
    public function update(Request $request, $id)
    {
        // Find the existing MarketTool by ID
        $marketTool = MarketTool::findOrFail($id);
        
        // Update the title
        $marketTool->title = $request->input('title');
    
        // Handle the market tool image upload
        if ($request->hasFile('img')) {
            // Delete the old image if it exists
            if ($marketTool->img && file_exists(public_path('uploads/market_tools/' . $marketTool->img))) {
                unlink(public_path('uploads/market_tools/' . $marketTool->img)); // Delete the old image file
            }
    
            // Process the new image
            $image = $request->file('img');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/market_tools'), $imageName);
            $marketTool->img = $imageName; // Update the image path with the new image
        }
    
        // Save the updated MarketTool
        $marketTool->save();
    
        // Now handle updating the links related to the market tool
        if ($request->has('resources')) {
            // Extract current resource IDs from the request
            $currentResourceIds = collect($request->resources)->pluck('id')->filter(); // Filter out any null IDs
    
            // Delete links that are no longer included in the current request
            MarketToolLink::where('mt_id', $marketTool->id)
                ->whereNotIn('id', $currentResourceIds)
                ->delete();
    
            // Update existing links or create new ones
            foreach ($request->resources as $resource) {
                // Check if the resource has an ID for updating
                if (isset($resource['id'])) {
                    // Update the existing link
                    $link = MarketToolLink::find($resource['id']);
                    if ($link) {
                        $link->name = $resource['name'];
                        $link->link = $resource['link'];
                        $link->save();
                    }
                } else {
                    // Create a new link if no ID exists
                    MarketToolLink::create([
                        'mt_id' => $marketTool->id,
                        'name' => $resource['name'],
                        'link' => $resource['link'],
                    ]);
                }
            }
        }
    
        // Redirect with success message
        return redirect()->route('market_tools.index')->with('success', 'Market tool updated successfully!');
    }
    
    
    
    

    // Remove the specified tool and its links
    public function destroy($id)
    {
        // Find the MarketTool by ID
        $marketTool = MarketTool::findOrFail($id);
        
        // Check if the image file exists and delete it
        if ($marketTool->img && file_exists(public_path('uploads/market_tools/' . $marketTool->img))) {
            unlink(public_path('uploads/market_tools/' . $marketTool->img)); // Delete the image file
        }
    
        // Delete the MarketTool from the database
        $marketTool->delete();
        
        // Redirect with success message
        return redirect()->route('market_tools.index')->with('success', 'Market Tool deleted successfully');
    }







///////  std_functions

    public function index_std()
    {
       
        $marketTools = MarketTool::with('links')->get();
    
        return view('student.marketTool.index', compact('marketTools'));
    }
    public function show($id)
{
    // Fetch the market tool by ID
    $marketTool = MarketTool::findOrFail($id);
    
    // Optionally, fetch any related data (like links)
    $links = MarketToolLink::where('mt_id', $id)->get();

    // Return a view to display the tool's details
    return view('student.marketTool.links_show', compact('marketTool', 'links'));
}

    
}
