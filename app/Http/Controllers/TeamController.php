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
        return view('backend.content.teams', compact('teams'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $teams = Team::all();
        return view('backend.content.teams', compact('teams'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
                'position' => 'required',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);

            if ($request->hasFile('image')) {
                $imageFileName = time() . '_' . $request->file('image')->getClientOriginalName();
                $request->file('image')->storeAs('public/teams', $imageFileName);
                $request->image = $imageFileName;
            }

            Team::create([
                'name' => $request->name,
                'position' => $request->position,
                'image' => $request->image
            ]);

            return redirect()->route('team.index')->with('success', 'Team added successfully.');
        } catch (\Exception $e) {
            return redirect()->route('team.index')->with('error', 'Failed to add team: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        $team = Team::find($id);

        if (!$team) {
            return redirect()->route('team.index')->with('error', 'Team not found.');
        }

        return view('backend.content.team', compact('team'));
    }

    public function edit(Team $team)
    {
        $teams = Team::findOrFail($team->id);
        return view('backend.content.teams', compact('teams'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Team $team)
    {
        try {
            $request->validate([
                'name' => 'required',
                'position' => 'required',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);

            if ($request->hasFile('image')) {
                $imageFileName = time() . '_' . $request->file('image')->getClientOriginalName();
                $request->file('image')->storeAs('public/teams', $imageFileName);
                $request->image = $imageFileName;
            }

            Team::where('id', $team->id)->update([
                'name' => $request->name,
                'position' => $request->position,
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
            return redirect()->route('team.index')->with('success', 'Client deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->route('team.index')->with('error', 'Failed to delete client: ' . $e->getMessage());
        }
    }

    public function search(Request $request)
    {
        try {
            $query = trim($request->input('query'));

            if (empty($query)) {
                return redirect()->route('team.index');
            }

            $teamsQuery = Team::query();

            if (is_numeric($query)) {
                $teamsQuery->where(function($q) use ($query) {
                    $q->where('id', '=', $query)
                        ->orWhere('name', 'like', "%{$query}%")
                        ->orWhere('position', 'like', "%{$query}%");
                });
            } else {
                $teamsQuery->where(function($q) use ($query) {
                    $q->where('name', 'like', "%{$query}%")
                        ->orWhere('position', 'like', "%{$query}%");
                });
            }

            $teams = $teamsQuery->paginate(5)->appends(['query' => $query]);

            // Check if no results were found
            if ($teams->isEmpty()) {
                // Flash a message to the session that will be used by SweetAlert
                session()->flash('sweet_error', 'No teams found matching your search criteria.');
            }

            return view('backend.content.teams', compact('teams'));
        } catch (\Exception $e) {
            return redirect()->route('team.index')->with('error', 'Failed to search team: ' . $e->getMessage());
        }
    }
}
