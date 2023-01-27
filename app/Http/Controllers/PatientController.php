<?php

namespace App\Http\Controllers;

use App\Booking;
use App\User;

class PatientController extends Controller
{ public function findPatient($id)
    {
        $user = User::findOrFail($id);
      //  dd($user);
        return response()->json($user);
    }
    
    public function index()
    {
        if (request('date')) {
            $bookings = Booking::with(['doctor', 'user'])->latest()
                ->where('date', request('date'))
                ->get();
        } else {
            $bookings = Booking::with(['doctor', 'user'])->latest()
                ->where('date', date('Y-m-d'))
                ->get();
        }

        return view('admin.patient.index', compact('bookings'));
    }

    public function allBookings()
    {
        $bookings = Booking::latest()->paginate(10);
        return view('admin.patient.all-bookings', compact('bookings'));
    }

    public function updateStatus($id)
    {
        $booking = Booking::find($id);
        $booking->status = !$booking->status;
        $booking->save();

        return redirect()->back()->with('message', 'Booking Updated!');
    }
}
