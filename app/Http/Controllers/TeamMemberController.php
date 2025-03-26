<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\TeamMember;
use Illuminate\Http\Request;

class TeamMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $team_members = TeamMember::paginate(5);
        $teams = Team::all();
        return view('backend.content.team_members.index', compact('team_members', 'teams'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
                'role' => 'nullable',
                'team_id' => 'required|exists:teams,id',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);

            if ($request->hasFile('image')) {
                $imageFileName = time() . '_' . $request->file('image')->getClientOriginalName();
                $request->file('image')->storeAs('teams', $imageFileName, 'public');
                $request->image = $imageFileName;
            }

            TeamMember::create([
                'name' => $request->name,
                'role' => $request->role,
                'team_id' => $request->team_id,
                'image' => $imageFileName ?? null
            ]);

            return redirect()->route('team_members.index')->with('success', 'Team member added successfully.');
        } catch (\Exception $e) {
            return redirect()->route('team_members.index')->with('error', 'Failed to add team member: ' . $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $team_member = TeamMember::findOrFail($id);

            $request->validate([
                'name' => 'required',
                'role' => 'nullable',
                'team_id' => 'required|exists:teams,id',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);

            $data = [
                'name' => $request->name,
                'role' => $request->role,
                'team_id' => $request->team_id
            ];

            if ($request->hasFile('image')) {
                $imageFileName = time() . '_' . $request->file('image')->getClientOriginalName();
                $request->file('image')->storeAs('teams', $imageFileName, 'public');
                $request->image = $imageFileName;
            }

            $team_member->update($data);

            return redirect()->route('team_members.index')->with('success', 'Team member updated successfully.');
        } catch (\Exception $e) {
            return redirect()->route('team_members.index')->with('error', 'Failed to update team member: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $team_member = TeamMember::findOrFail($id);
            $team_member->delete();
            return redirect()->route('team_members.index')->with('success', 'Team member deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->route('team_members.index')->with('error', 'Failed to delete team member: ' . $e->getMessage());
        }
    }

    /**
     * Search for team members
     */
    public function search(Request $request)
    {
        try {
            $query = trim($request->input('query'));

            if (empty($query)) {
                return redirect()->route('team_members.index');
            }

            $team_members = TeamMember::where('id', 'like', "%{$query}%")
                ->orWhere('name', 'like', "%{$query}%")
                ->orWhere('role', 'like', "%{$query}%")
                ->orWhereHas('team', function($q) use ($query) {
                    $q->where('name', 'like', "%{$query}%");
                })
                ->paginate(5)
                ->appends(['query' => $query]);

            $teams = Team::all();

            if ($team_members->isEmpty()) {
                return redirect()->route('team_members.index')
                    ->with('error', 'No team members found matching your search criteria.');
            }

            return view('backend.content.team_members.index', compact('team_members', 'teams'));

        } catch (\Exception $e) {
            return redirect()->route('team_members.index')
                ->with('error', 'Failed to search team members: ' . $e->getMessage());
        }
    }
}
