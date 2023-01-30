<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Chat;
use Pusher\Pusher;
use App\User;

class ChatsController_Web extends Controller
{
   
/**
 * Show chats
 *
 * @return \Illuminate\Http\Response
 */
public function index()
{
 //dd("nnn");
  return view('admin.chats.chat');
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
public function GetMessageByDoctor($request)
{
    $doctor_id = $request;
    $chats = Chat::where('doctor_id', $doctor_id)->get();
    $patientIds = [];
    foreach ($chats as $chat) {
        array_push($patientIds, $chat->patient_id);
    }
    $uniquePatientIds = array_unique($patientIds);
    $latestMessages = [];
    foreach ($uniquePatientIds as $patientId) {
        $latestMessage = Chat::where('patient_id', $patientId)->with('patient')->latest()->first();
      //  $latestMessages[$patientId] = $latestMessage;
      array_push($latestMessages, $latestMessage);
    }
 return $latestMessages;
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
  return $chats;
}


/**
 * Persist message to database
 *
 * @param  Request $request
 * @return Response
 */
public function sendMessage(Request $request)
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
  //$doctor = Auth::user();

  $chat = new Chat();
  $chat->envoye_par = $doctor->id;
  $chat->doctor_id = $doctor->id;
  $chat->patient_id = $patient->id;;
  $chat->message = $message;
  $chat->save();
  $chat->doctor = $doctor;
  $chat->patient = $patient;
 // $patient_id = 2;
 // $doctor_id = 1;
  $channel = 'doctor_' . $doctor_id;
  $event = 'patient_' . $patient_id;
 // $pusher->trigger('my-channel', 'my-event', $chat);

 $pusher->trigger($channel, $event, $chat);
  return ['status' => 'Message Sent!'];
}
}