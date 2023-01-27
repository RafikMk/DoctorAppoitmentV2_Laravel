@extends('admin.layouts.main')

@section('content')
<div class="container">
    @if (Session::has('message'))
        <div class="alert alert-success">
            {{ Session::get('message') }}
        </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2>{{ __('Todays Prescriptions') }}
                        <sub class="badge badge-info">{{ $bookings->count() }}</sub>
                    </h2>
                </div>

                <div class="card-body">
                    {{-- @if ($bookings->count() > 0) --}}
                   <table class="table table-striped table-responsive">
                       <thead>
                           <tr>
                               <th>#</th>
                               <th>Photo</th>
                               <th>Date</th>
                               <th>Client</th>
                               <th>Email</th>
                               <th>Phone No</th>
                               <th>Gender</th>
                               <th>Time</th>
                               <th>Doctor</th>
                               <th>Status</th>
                               <th>Prescription</th>
                           </tr>
                       </thead>
                       <tbody>
                           @forelse ($bookings as $booking)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td><img src="/profile/{{ $booking->user->image }}" width="80" alt="client photo" style="border-radius: 100%"></td>
                                    <td>{{ $booking->date }}</td>
                                    <td>{{ $booking->user->name }}</td>
                                    <td>{{ $booking->user->email }}</td>
                                    <td>{{ $booking->user->phone_number }}</td>
                                    <td>{{ $booking->user->gender }}</td>
                                    <td>{{ $booking->time }}</td>
                                    <td>{{ $booking->doctor->name }}</td>
                                    <td>
                                        @if ($booking->status == 1)
                                            <button class="btn btn-success">
                                                Visited
                                            </button>
                                        @endif
                                    </td>
                                    <td>
                                        <!-- Button trigger modal -->
                                        @if (!App\Prescription::where('date', date('Y-m-d'))
                                        ->where('doctor_id', auth()->id())
                                        ->where('user_id', $booking->user->id)
                                        ->exists())
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#prescriptionModal{{ $booking->user_id }}">
                                                Make Prescription
                                            </button>
                                        @else
                                            <a href="{{ route('show.prescription', [$booking->user_id, $booking->date]) }}" class="btn btn-secondary">
                                                View Prescription
                                            </a>
                                        @endif
                                        <!-- Modal -->
                                        @include('prescription._modal')
                                    </td>
                                </tr>
                            @empty
                                <td>No Appointments for today yet!</td>
                            @endforelse
                       </tbody>
                   </table>
                    {{-- @else 
                        <h5>No Appointments for today yet!</h5>
                    @endif --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
