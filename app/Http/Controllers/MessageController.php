<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReplyMail;

class MessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['store']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $messages = Message::all();
        return view('backend.content.messages.index', compact('messages'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'full_name' => 'required',
                'email' => 'required|email',
                'subject' => 'nullable',
                'message' => 'required'
            ]);

            // Simpan ke database
            Message::create($data);

            return back()->with('success', 'Pesan Anda telah dikirim! Kami akan mengirim balasan melalui email.');
        } catch (\Exception $e) {
            return back()->with('error', 'Silahkan isi semua kolom yang diperlukan.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Message $message) // Change parameter to $message
    {
        try {
            // Force delete if you don't want soft delete functionality
            $message->forceDelete();

            return redirect()->route('messages.index')
                ->with('success', 'Message deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->route('messages.index')
                ->with('error', 'Failed to delete message: ' . $e->getMessage());
        }
    }

    /**
     * Reply to the messages message.
     */
    public function reply(Request $request, $id)
    {
        $message = Message::findOrFail($id);

        $request->validate([
            'reply' => 'required'
        ]);

        // Set nilai reply dan simpan menggunakan save()
        $message->reply = $request->reply;
        $message->save();

        // Kirim email balasan ke user
        Mail::to($message->email)->send(new ReplyMail($message));

        return redirect()->route('messages.index')->with('success', 'Balasan berhasil dikirim!');
    }
}
