<?php

namespace App\Http\Controllers;

use App\Models\Ranks;
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

class RankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
       public function index()
    {
        $ranks = Ranks::all();
        return view('admin.rank.index', compact('ranks'));
    }
    
    public function create()
    {
        return view('admin.rank.add-rank');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
     
        $input = $request->all();
    
        // dd($input);
       Ranks::create($input);

        return redirect()->route('rank.index')->with('success', 'Rank saved successfully!');
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
    public function edit( $id)
    {
        $rank = Ranks::find($id);
      
        return view('admin.rank.edit-rank', compact('rank'));
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
     
        $rank = Ranks::find($id);
        $rank->update($input);
        return redirect()->route('rank.index')->with('success', 'Rank updated successfully.');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $rank = Ranks::where('id', $id)->delete();
    if($rank){
          return redirect()->back()->with('success', 'Rank deleted successfully');
    }
          
      
       
    }

}