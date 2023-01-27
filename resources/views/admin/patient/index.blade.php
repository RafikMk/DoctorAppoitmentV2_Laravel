@extends('admin.layouts.main')

@section('content')
<div class="container">
    @if (Session::has('message'))
        <div class="alert alert-success">
            {{ Session::get('message') }}
        </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    <h2>{{ __('Appointments/Bookings') }}
                        <sub class="badge badge-info">{{ $bookings->count() }}</sub>
                    </h2>
                </div>
                <div class="card-header">
                   <form action="{{ route('bookings.today') }}" method="GET">
                        @csrf
                        Filter:
                        <div class="row">
                            <div class="col-md-10">
                                <input type="text" class="form-control datetimepicker-input" id="datepicker" data-toggle="datetimepicker" data-target="#datepicker" name="date">
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary">Search</button>
                            </div>
                        </div>
                   </form>
                </div>

                <div class="card-body">
                   <table class="table table-striped">
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
                                        @if ($booking->status == 0)
                                            <a href="{{ route('update.status', $booking->id) }}">
                                                <button class="btn btn-primary">
                                                    Pending
                                                </button>
                                            </a> 
                                        @else
                                            <a href="{{ route('update.status', $booking->id) }}">
                                                <button class="btn btn-success">
                                                    Visited
                                                </button>
                                            </a>
                                            
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
