<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = Client::paginate(5);
        return view('backend.content.clients.index', compact('clients'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'nullable|email',
                'phone' => 'nullable|string|max:12',
                'description' => 'nullable|string',
                'address' => 'nullable|string',
                'logo_img' => 'required|image|mimes:jpeg,png,jpg,gif,svg'
            ]);

            if ($request->hasFile('logo_img')) {
                $imageFileName = time() . '_' . $request->file('logo_img')->getClientOriginalName();
                $request->file('logo_img')->storeAs('clients', $imageFileName, 'public');
                $request->logo_img = $imageFileName;
            }

            Client::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'description' => $request->description,
                'address' => $request->address,
                'logo_img' => $request->logo_img,
                'status' => 1,
            ]);

            return redirect()->route('client.index')->with('success', 'Client added successfully.');
        } catch (\Exception $e) {
            return redirect()->route('client.index')->with('error', 'Failed to add client: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        $client = Client::find($id);

        if (!$client) {
            return redirect()->route('client.index')->with('error', 'Client not found.');
        }

        return view('backend.content.client.index', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Client $client)
    {
        try {
            $request->validate([
                'name' => 'required',
                'email' => 'required|email',
                'phone' => 'required|string|max:12',
                'description' => 'required',
                'address' => 'required',
                'status' => 'required',
                'logo_img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg'
            ]);

            if ($request->hasFile('logo_img')) {
                $imageFileName = time() . '_' . $request->file('logo_img')->getClientOriginalName();
                $request->file('logo_img')->storeAs('clients', $imageFileName, 'public');
                $request->logo_img = $imageFileName;
            }

            Client::where('id', $client->id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'description' => $request->description,
                'address' => $request->address,
                'status' => $request->status,
                'logo_img' => $request->logo_img ?? $client->logo_img
            ]);

            return redirect()->route('client.index')->with('success', 'Client updated successfully!');
        } catch (\Exception $e) {
            return redirect()->route('client.index')->with('error', 'Failed to update client: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        try {
            $client->delete();
            return redirect()->route('client.index')->with('success', 'Client deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->route('client.index')->with('error', 'Failed to delete client: ' . $e->getMessage());
        }
    }

    public function search(Request $request)
    {
        try {
            $query = trim($request->input('query'));

            if (empty($query)) {
                return redirect()->route('client.index');
            }

            $clients = Client::where('id', 'like', "%{$query}%")
                ->orWhere('name', 'like', "%{$query}%")
                ->orWhere('email', 'like', "%{$query}%")
                ->orWhere('phone', 'like', "%{$query}%")
                ->orWhere('description', 'like', "%{$query}%")
                ->orWhere('address', 'like', "%{$query}%")
                ->paginate(5)
                ->appends(['query' => $query]);

            if ($clients->isEmpty()) {
                return redirect()->route('client.index')
                    ->with('error', 'No clients found matching your search criteria.');
            }

            return view('backend.content.clients.index', compact('clients'));

        } catch (\Exception $e) {
            return redirect()->route('client.index')
                ->with('error', 'Failed to search clients: ' . $e->getMessage());
        }
    }
}
