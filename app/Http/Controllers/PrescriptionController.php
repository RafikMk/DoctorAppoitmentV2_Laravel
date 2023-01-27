<?php

namespace App\Http\Controllers;

use App\Booking;
use App\Prescription;
use Illuminate\Http\Request;
use App\User;

class PrescriptionController extends Controller
{
    public function index()
    {
        $bookings = Booking::latest()
            ->where('date', date('Y-m-d'))
            ->where('doctor_id', auth()->id())
            ->where('status', 1)
            ->get();

        return view('prescription.index', compact('bookings'));
    }

    public function allPresriptions()
    {
        $prescriptions = Prescription::with(['user', 'doctor'])->get();
        return view('prescription.all', compact('prescriptions'));
    }

    public function myPrescriptions()
    {
        $prescriptions = Prescription::where('user_id', auth()->id())
            ->get();

        return view('prescription.my-prescription', compact('prescriptions'));
    }
    public function create()
    {

        return view('prescription.create');
    }

    public function store(Request $request)
    {
    //  dd($request->symptoms);
        $data = $request->all();
     //  $data['medicine'] = implode(',', $request->user);
     $data['doctor_id']  = auth()->id();
     $name = User::findOrFail(auth()->id());
     $data['medicine']  = $name->name;


        Prescription::create($data);

        return redirect()->back()->with('message', 'Prescription created successfully!');
    }

    public function show($userId, $date)
    {
        $prescription = Prescription::where('user_id', $userId)
            ->where('date', $date)
            ->first();

        return view('prescription.show', compact('prescription'));
    }

    public function showapi($appointment_id,$doctor_id)
{
    $prescription = Prescription::where('user_id', $appointment_id)
    ->where('doctor_id', $doctor_id)
    ->get();      //  dd($appointment_id);

    return response()->json([
        'data' => $prescription
    ], 200);
}

}
