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
   // $messages = Chat::with('user')->get();
   $messages = Chat::with(['doctor', 'patient'])->get();

    return response()->json($messages);

}
public function GetMessageByDoctor_Patient($doctor_id, $patient_id)
{
  $chats = Chat::where('patient_id', $patient_id)
  ->where('doctor_id', $doctor_id)
  ->get();
  $doctor = User::findOrFail($doctor_id);
  $patient = User::findOrFail($patient_id);
 
  foreach ($chats as $chat) {
    $chat->doctor = $doctor;
    $chat->patient = $patient;
  }
  return response()->json($chat);
}
public function triggerEvent(Request $request)
{
    $message = $request->input('message');
    $doctor_id = $request->input('doctor_id');
    $patient_id = $request->input('patient_id');

    $options = array(
        'cluster' => 'eu',
        'useTLS' => true
    );

    $pusher = new Pusher(
        '7d715600526512bac5e3',
        '3851fd23c61c0e0a828a',
        '1543476',
        $options
    );
    $doctor = User::findOrFail($doctor_id);
    $patient = User::findOrFail($patient_id);

    $chat = new Chat();
    $chat->envoye_par = $patient->id;
    $chat->doctor_id = $doctor->id;
    $chat->patient_id = $patient->id;;
    $chat->message = $message;
    $chat->save();
    $chat->doctor = $doctor;
    $chat->patient = $patient;  
   //   $patient_id = 2;
   // $doctor_id = 1;
    $channel = 'doctor_' . $doctor_id;
    $event = 'patient_' . $patient_id;
   // $pusher->trigger('my-channel', 'my-event', $chat);

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
