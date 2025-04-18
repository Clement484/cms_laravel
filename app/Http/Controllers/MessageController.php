<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Http\Requests\StoreMessageRequest;
use App\Http\Requests\UpdateMessageRequest;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $messages = Message::latest()->paginate(10);
        return view('admin.messages.index', compact('messages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMessageRequest $request)
    {
        // Message::create([
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'subject' => $request->subject,
        //     'content' => $request->content,
        //     'status' => 'unread',
        // ]);

        // return redirect()->back()->with('success', 'Message sent successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Message $message)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMessageRequest $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Message $message)
    {
        $message = Message::findOrFail($message->id);
        $message->delete();

        return redirect()->back()->with('success', 'Message deleted successfully.');
    }

    public function read($id)
    {
        $message = Message::findOrFail($id);
        $message->status = 'read';
        $message->save();

        return back()->with('success', 'Message read.');
    }

    public function unread($id)
    {
        $message = Message::findOrFail($id);
        $message->status = 'unread';
        $message->save();

        return back()->with('success', 'Message marked as unread.');
    }
}
