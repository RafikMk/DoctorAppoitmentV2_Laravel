<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Chat;
use Pusher\Pusher;

class ChatsController_Web extends Controller
{
   
/**
 * Show chats
 *
 * @return \Illuminate\Http\Response
 */
public function index()
{
  return view('chat');
}

/**
 * Fetch all messages
 *
 * @return Message
 */
public function fetchMessages()
{
  return Chat::with('user')->get();
}
public function GetMessageByDoctor( $request)
{
 $doctor_id=$request ;
// return $chats = Chat::where('doctor_id', $doctor_id)->with('patient','doctor')->get();

     $chats = Chat::where('doctor_id', $doctor_id)->get();
    $patientIds = [];
foreach ($chats as $chat) {
    array_push($patientIds, $chat->patient_id);
}
 $uniquePatientIds = array_unique($patientIds);
$latestMessages = [];
foreach ($uniquePatientIds as $patientId) {
    $latestMessage = Chat::where('patient_id', $patientId)->with('patient')->latest()->first();
    $latestMessages[$patientId] = $latestMessage;
}

return  $latestMessages;
}

/**
 * Persist message to database
 *
 * @param  Request $request
 * @return Response
 */
public function sendMessage(Request $request)
{
  $doctor = Auth::user();
  $message = $request->input('message');

  $pusher = new Pusher(env('PUSHER_APP_KEY'), env('PUSHER_APP_SECRET'), env('PUSHER_APP_ID'), [
      'cluster' => env('PUSHER_APP_CLUSTER'),
      'useTLS' => true
  ]);

 // $user = User::findOrFail(1);

  $chat = new Chat();
  $chat->doctor_id = $doctor->id;
  $chat->message = $message;
  $chat->save();
  $chat->user = $user;
  $patient_id = 2;
  $doctor_id = $doctor->id;
  $channel = 'doctor_' . $doctor_id;
  $event = 'patient_' . $patient_id;
  $pusher->trigger($channel, $event, $chat);
  return ['status' => 'Message Sent!'];
}
}