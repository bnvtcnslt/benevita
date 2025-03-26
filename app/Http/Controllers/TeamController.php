<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $teams = Team::paginate(5);
        return view('backend.content.teams.index', compact('teams'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
                'description' => 'nullable',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);

            if ($request->hasFile('image')) {
                $imageFileName = time() . '_' . $request->file('image')->getClientOriginalName();
                $request->file('image')->storeAs('teams', $imageFileName, 'public');
                $request->image = $imageFileName;
            }

            Team::create([
                'name' => $request->name,
                'description' => $request->description,
                'image' => $request->image
            ]);

            return redirect()->route('team.index')->with('success', 'Team added successfully.');
        } catch (\Exception $e) {
            return redirect()->route('team.index')->with('error', 'Failed to add team: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        $team = Team::findOrFail($id);

        // Paginate members separately
        $members = $team->members()->withTrashed()->paginate(5);

        return view('backend.content.teams.detail', compact('team', 'members'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Team $team)
    {
        try {
            $request->validate([
                'name' => 'required',
                'description' => 'required',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);

            if ($request->hasFile('image')) {
                $imageFileName = time() . '_' . $request->file('image')->getClientOriginalName();
                $request->file('image')->storeAs('teams', $imageFileName, 'public');
                $request->image = $imageFileName;
            }

            Team::where('id', $team->id)->update([
                'name' => $request->name,
                'description' => $request->description,
                'image' => $request->image ?? $team->image
            ]);

            return redirect()->route('team.index')->with('success', 'Team updated successfully.');
        } catch (\Exception $e) {
            return redirect()->route('team.index')->with('error', 'Failed to update team: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Team $team)
    {
        try {
            $team->delete();
            return redirect()->route('team.index')->with('success', 'Team deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->route('team.index')->with('error', 'Failed to delete team: ' . $e->getMessage());
        }
    }

    public function search(Request $request)
    {
        try {
            $query = trim($request->input('query'));

            if (empty($query)) {
                return redirect()->route('team.index');
            }

            $teams = Team::where('id', 'like', "%{$query}%")
                ->Where('name', 'like', "%{$query}%")
                ->orWhere('description', 'like', "%{$query}%")
                ->paginate(5)
                ->appends(['query' => $query]);

            if ($teams->isEmpty()) {
                return redirect()->route('team.index')
                    ->with('error', 'No teams found matching your search criteria.');
            }

            return view('backend.content.teams.index', compact('teams'));

        } catch (\Exception $e) {
            return redirect()->route('team.index')
                ->with('error', 'Failed to search team: ' . $e->getMessage());
        }
    }
}
