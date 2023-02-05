<?php

namespace App\Http\Controllers;

use App\Booking;
use App\Prescription;
use Illuminate\Http\Request;
use App\User;
use Carbon\Carbon;

class PrescriptionController extends Controller
{
    public function index()
    {
        $bookings = Prescription::latest()
        ->where('date', Carbon::today()->format('Y-m-d'))
            ->get();
        return view('prescription.index', compact('bookings'));
    }

    public function allPresriptions()
    {
        $prescriptions = Prescription::with(['user', 'booking'])->get();
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
        $data = $request->all();
    //  dd($request->ailment);

     //  $data['medicine'] = implode(',', $request->user);
     $name = User::findOrFail(auth()->id());
     $data['medicine']  = $name->name;
    
  //  dd( $data) ;

       Prescription::create($data);

        return redirect()->back()->with('message', 'Prescription created successfully!');
    }

    public function show($id)
    {
        $prescription = Prescription::where('id', $id)
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
