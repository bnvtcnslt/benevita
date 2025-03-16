<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = Client::all();

        return view('backend.content.clients', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clients = Client::all();
        return view('backend.content.clients', compact('clients'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required',
            'logo_img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        if ($request->hasFile('logo_img')) {
            $imageFileName = time() . '_' . $request->file('logo_img')->getClientOriginalName();
            $request->file('logo_img')->storeAs('public/images', $imageFileName);
            $request->logo_img = $imageFileName;
        }

        Client::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'logo_img' => $request->logo_img
        ]);

        return redirect()->route('client.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client)
    {
        $clients = Client::findOrFail($client->id);
        return view('backend.content.clients', compact('clients'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Client $client)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required',
            'status' => 'required',
            'logo_img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        if ($request->hasFile('logo_img')) {
            $imageFileName = time() . '_' . $request->file('logo_img')->getClientOriginalName();
            $request->file('logo_img')->storeAs('public/images', $imageFileName);
            $request->logo_img = $imageFileName;
        }

        Client::where('id', $client->id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'status' => $request->status,
            'logo_img' => $request->logo_img ?? $client->logo_img
        ]);

        return redirect()->route('client.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        Client::destroy($client->id);
        return redirect()->route('client.index');
    }
}
