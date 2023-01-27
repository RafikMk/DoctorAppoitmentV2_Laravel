@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2>{{ __('My Appointments') }}
                        <sub class="badge badge-info">{{ $appointments->count() }}</sub>
                    </h2>
                </div>

                <div class="card-body">
                   <table class="table table-striped">
                       <thead>
                           <tr>
                               <th>#</th>
                               <th>Doctor</th>
                               <th>Date</th>
                               <th>Time</th>
                               <th>Booking Date</th>
                               <th>Status</th>
                           </tr>
                       </thead>
                       <tbody>
                           @forelse ($appointments as $appointment)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $appointment->doctor->name }}</td>
                                    <td>{{ $appointment->date }}</td>
                                    <td>{{ $appointment->time }}</td>
                                    <td>{{ date('Y-m-d', strtotime($appointment->created_at)) }}</td>
                                    <td>
                                        @if ($appointment->status == 0)
                                            <button class="btn btn-primary">
                                                Not Visited
                                            </button>
                                        @else
                                            <button class="btn btn-success">
                                                Visited
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                {{-- <td>No Appointments at the moment!</td> --}}
                            @endforelse
                       </tbody>
                   </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
