<?php

namespace App\Http\Controllers;

use App\Models\InformationContact;
use Illuminate\Http\Request;

class InformationContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contact = InformationContact::first();
        return view('backend.content.information-contact.index', compact('contact'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, InformationContact $informationContact)
    {
        try {
            $request->validate([
                'address' => 'required|string',
                'phone' => 'required|string',
                'email' => 'required|email',
            ]);

            InformationContact::where('id', $informationContact->id)->update([
                'address' => $request->address,
                'phone' => $request->phone,
                'email' => $request->email,
            ]);

            return redirect()->route('information-contact.index')->with('success', 'Contact information updated successfully.');
        } catch (\Exception $e) {
            return redirect()->route('information-contact.index')->with('error', 'Failed to update contact information: ' . $e->getMessage());
        }
    }
}
