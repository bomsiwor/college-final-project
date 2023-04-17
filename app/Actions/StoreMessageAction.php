<?php

namespace App\Actions;

use App\Models\Message;

class StoreMessageAction
{

    public function handle($request): Message
    {
        $validated = $request->validate([
            'subject' => 'required',
            'message_text' => 'required'
        ]);

        if (!$request->anonymous) :
            $validated += [
                'name' => $request->name,
                'email' => $request->email,
            ];
        endif;

        $message = Message::create($validated);

        if ($message->wasRecentlyCreated) :
            return $message;
        endif;

        return $message;
    }
}
