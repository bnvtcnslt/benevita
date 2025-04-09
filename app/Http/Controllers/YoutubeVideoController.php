<?php

namespace App\Http\Controllers;

use App\Models\YoutubeVideo;
use Illuminate\Http\Request;

class YoutubeVideoController extends Controller
{
    public function index()
    {
        $videos = YoutubeVideo::all();
        return view('backend.content.youtube.index', compact('videos'));
    }

    public function update(Request $request, YoutubeVideo $youtubeVideo)
    {
        try{
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'url' => 'required|url',
                'channel_url' => 'nullable|url',
                'position_right' => 'boolean',
            ]);

            $videoId = YoutubeVideo::extractVideoId($validated['url']);
            if (!$videoId) {
                return back()->withErrors(['url' => 'Invalid YouTube URL'])->withInput();
            }

            $youtubeVideo->update([
                'title' => $validated['title'],
                'description' => $validated['description'],
                'video_id' => $videoId,
                'url' => $validated['url'],
                'channel_url' => $validated['channel_url'],
                'position_right' => $request->has('position_right'),
            ]);

            return redirect()->route('youtube-videos.index')->with('success', 'Video updated successfully');
        } catch (\Exception $e) {
            return redirect()->route('youtube-videos.index')->with('error', 'Failed to add video: ' . $e->getMessage());
        }
    }

// Fungsi toggle status
    public function toggleStatus(YoutubeVideo $video)
    {
        $video->update(['is_active' => !$video->is_active]);
        return back()->with('success', 'Video status updated');
    }
}
