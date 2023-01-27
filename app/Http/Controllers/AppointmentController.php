<?php

namespace App\Http\Controllers;

use App\Appointment;
use App\Time;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $appointments = Appointment::latest()
            ->where('user_id', auth()->id())
            ->get();

        return view('admin.appointment.index', compact('appointments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.appointment.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'date' => 'required|unique:appointments,date,NULL,id,user_id,' . auth()->id(),
            'time' => 'required',
        ]);

        $appointment = Appointment::create([
            'user_id' => auth()->id(),
            'date' => date('Y-m-d', strtotime($request->date)),
        ]);

        foreach ($request->time as $time) {
            Time::create([
                'appointment_id' => $appointment->id,
                'time' => $time,
            ]);
        }

        return redirect()->back()->with('message', 'Appointment created for ' . $request->date);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function show(Appointment $appointment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function edit(Appointment $appointment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Appointment $appointment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Appointment $appointment)
    {
        //
    }

    public function check(Request $request)
    {
        $date = $request->date;

        $appointment = Appointment::where('date', $date)
            ->where('user_id', auth()->id())
            ->first();

        if (!$appointment) {
            return redirect()->to('/appointment')->with('error_message', 'Appointment time not available for this date!');
        }

        $appointmentId = $appointment->id;

        $times = Time::where('appointment_id', $appointmentId)->get();

        // return $times;

        return view('admin.appointment.index', compact('times', 'appointmentId', 'date'));
    }

    public function updateTime(Request $request)
    {
        $appointmentId = $request->appointmentId;
        $appointment = Time::where('appointment_id', $appointmentId)
            ->delete();

        foreach ($request->time as $time) {
            Time::create([
                'appointment_id' => $appointmentId,
                'time' => $time,
            ]);
        }

        return redirect()->route('appointment.index')->with('message', 'Appointment time updated');
    }
}
