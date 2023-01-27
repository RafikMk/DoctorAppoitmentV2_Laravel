@extends('admin.layouts.main')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2>{{ __('All Prescriptions') }}
                        <sub class="badge badge-info">{{ $prescriptions->count() }}</sub>
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
                               <th>Doctor</th>
                               <th>Prescription</th>
                           </tr>
                       </thead>
                       <tbody>
                           @forelse ($prescriptions as $prescription)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td><img src="/profile/{{ $prescription->user->image }}" width="80" alt="client photo" style="border-radius: 100%"></td>
                                    <td>{{ $prescription->date }}</td>
                                    <td>{{ $prescription->user->name }}</td>
                                    <td>{{ $prescription->user->email }}</td>
                                    <td>{{ $prescription->user->phone_number }}</td>
                                    <td>{{ $prescription->user->gender }}</td>
                                    {{-- <td>{{ $prescription->time }}</td> --}}
                                    <td>{{ $prescription->doctor->name }}</td>
                                    <td>
                                        <a href="{{ route('show.prescription', [$prescription->user_id, $prescription->date]) }}" class="btn btn-secondary">
                                            View Prescription
                                        </a>
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
