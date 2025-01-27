<?php

namespace App\Http\Controllers;

use App\Models\FaqAffiliateVideo;
use Illuminate\Http\Request;

class FaqAffiliateVideoController extends Controller
{
    public function index()
    {
        $videos = FaqAffiliateVideo::all();
        return view('admin.faq_affiliate_videos.index', compact('videos'));
    }

    public function create()
    {
        return view('admin.faq_affiliate_videos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'video_link' => 'required',
            'type' => 'required',
        ]);

        FaqAffiliateVideo::create($request->all());

        return redirect()->route('faq_affiliate_videos.index')
                         ->with('success', 'Video created successfully.');
    }

    public function show(FaqAffiliateVideo $faqAffiliateVideo)
    {
        return view('admin.faq_affiliate_videos.show', compact('faqAffiliateVideo'));
    }

    public function edit(FaqAffiliateVideo $faqAffiliateVideo)
    {
        return view('admin.faq_affiliate_videos.edit', compact('faqAffiliateVideo'));
    }

    public function update(Request $request, FaqAffiliateVideo $faqAffiliateVideo)
    {
        $request->validate([
            'title' => 'required',
            'video_link' => 'required',
            'type' => 'required',
        ]);

        $faqAffiliateVideo->update($request->all());

        return redirect()->route('faq_affiliate_videos.index')
                         ->with('success', 'Video updated successfully.');
    }

    public function destroy(FaqAffiliateVideo $faqAffiliateVideo)
    {
        $faqAffiliateVideo->delete();

        return redirect()->route('faq_affiliate_videos.index')
                         ->with('success', 'Video deleted successfully.');
    }
}
