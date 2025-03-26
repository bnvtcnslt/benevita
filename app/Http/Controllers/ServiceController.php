<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Team;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Service::paginate(5);
        $teams = Team::all();
        return view('backend.content.services.index', compact('services', 'teams'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required',
                'description' => 'required',
                'team_id' => 'required|exists:teams,id',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);

            if ($request->hasFile('image')) {
                $imageFileName = time() . '_' . $request->file('image')->getClientOriginalName();
                $request->file('image')->storeAs('public/services', $imageFileName);
                $request->image = $imageFileName;
            }

            Service::create([
                'title' => $request->title,
                'description' => $request->description,
                'team_id' => $request->team_id,
                'image' => $request->image
            ]);

            return redirect()->route('service.index')->with('success', 'Service added successfully.');
        } catch (\Exception $e) {
            return redirect()->route('service.index')->with('error', 'Failed to add service: ' . $e->getMessage());
        }
    }

    public function show(Service $service)
    {
        $teams = Team::all();
        return view('backend.content.services.detail', compact('service', 'teams'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Service $service)
    {
        try {
            $request->validate([
                'title' => 'required',
                'description' => 'required',
                'team_id' => 'required|exists:teams,id',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);

            if ($request->hasFile('image')) {
                $imageFileName = time() . '_' . $request->file('image')->getClientOriginalName();
                $request->file('image')->storeAs('public/services', $imageFileName);
                $request->image = $imageFileName;
            }

            Service::where('id', $service->id)->update([
                'title' => $request->title,
                'description' => $request->description,
                'team_id' => $request->team_id,
                'image' => $request->image ?? $service->image
            ]);

            return redirect()->route('service.index')->with('success', 'Service updated successfully.');
        } catch (\Exception $e) {
            return redirect()->route('service.index')->with('error', 'Failed to update service: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        try {
            $service->delete();
            return redirect()->route('service.index')->with('success', 'Service deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->route('service.index')->with('error', 'Failed to delete service: ' . $e->getMessage());
        }
    }

    public function search(Request $request)
    {
        try {
            $query = trim($request->input('query'));

            if (empty($query)) {
                return redirect()->route('service.index');
            }

            $services = Service::where('id', 'like', "%{$query}%")
                ->orWhere('title', 'like', "%{$query}%")
                ->orWhere('description', 'like', "%{$query}%")
                ->orWhereHas('team', function($q) use ($query) {
                    $q->where('name', 'like', "%{$query}%");
                })
                ->paginate(5)
                ->appends(['query' => $query]);

            $teams = Team::all();

            if ($services->isEmpty()) {
                return redirect()->route('service.index')
                    ->with('error', 'No services found matching your search criteria.');
            }

            return view('backend.content.services.index', compact('services', 'teams'));

        } catch (\Exception $e) {
            return redirect()->route('service.index')
                ->with('error', 'Failed to search services: ' . $e->getMessage());
        }
    }
}
