<?php

namespace App\Http\Controllers;

use App\Models\SocialMedia;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SocialMediaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $social_media = SocialMedia::all();
        return view('backend.content.social-media.index', compact('social_media'));
    }
    public function update(Request $request, SocialMedia $socialMedia)
    {
        try {
            $request->validate([
                'url' => 'required',
                'status' => 'required',
            ]);

            SocialMedia::where('id', $socialMedia->id)->update([
                'url' => $request->url,
                'status' => $request->status
            ]);

            $socialMedia->update($request->all());
            return redirect()->route('social_media.index')->with('success', 'Social Media updated successfully.');
        } catch (\Exception $e) {
            return redirect()->route('social_media.index')->with('error', 'Failed to update social media: ' . $e->getMessage());
        }

    }
}
