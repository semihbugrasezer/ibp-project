<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\Message;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $currentUser = auth()->user();
        $content = $request->textContent;
        $chatId = $request->chatId;
        $chat = Chat::find($chatId);

        if ($content !== null) {
            $message = new Message();
            $message->chat()->associate($chat);
            $message->sender()->associate($currentUser);
            $message->isSent = true;
            $message->sent_at = Carbon::now('Europe/Istanbul');
            $message->content = $content;
            $message->save();
        }

        return redirect()->route('admin.chat.show', [
            'id'=>$chatId
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $id)
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
    public function update(Request $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Message $message)
    {
        //
    }
}
