<?php

namespace App\Http\Controllers;
use App\Events\ChatMessage;

use Illuminate\Http\Request;
use App\Chat;
use App\User;
use Pusher\Pusher;

use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index()
{
    $messages = Chat::with('user')->get();
    return response()->json($messages);
}

public function triggerEvent(Request $request)
{
    $message = $request->input('message');

    $pusher = new Pusher(env('PUSHER_APP_KEY'), env('PUSHER_APP_SECRET'), env('PUSHER_APP_ID'), [
        'cluster' => env('PUSHER_APP_CLUSTER'),
        'useTLS' => true
    ]);

    $user = User::findOrFail(1);

    $chat = new Chat();
    $chat->user_id = $user->id;
    $chat->message = $message;
    $chat->save();
    $chat->user = $user;
    $message = $request->input('message');
    $patient_id = 2;
    $doctor_id = 1;
    $channel = 'doctor_' . $doctor_id;
    $event = 'patient_' . $patient_id;
    $pusher->trigger($channel, $event, $chat);
     return response()->json(['status' => 'success']);

}

    public function sendMessage(Request $request)
{
   // dd($request) ;
   // $user = Auth::user();
      //  dd($user) ;
      $user = User::findOrFail(1);
    $message = $request->input('message');
   // dd( $message );
    // Use Pusher to trigger an event to send the message
   // event(new ChatMessage($user, $message));
    broadcast(new ChatMessage($user, $message))->toOthers();

    // Save the message to the database
    $chat = new Chat();
    $chat->user_id = $user->id;
    $chat->message = $message;
    $chat->save();

    return response()->json(['status' => 'success']);
}

}
