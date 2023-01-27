@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h4 class="text-center">Doctor's Profile</h4>
                    <img src="{{ asset('images') }}/{{ $doctor->image }}" width="100px" alt="" style="border-radius: 50%;">
                    <br>
                    <p class="lead">Name: {{ ucfirst($doctor->name) }}</p>
                    <p class="lead">Education: {{ $doctor->education }}</p>
                    <p class="lead">Expertise: {{ $doctor->department }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger">{{ $error }}</div>
            @endforeach
            @if (Session::has('message'))
                <div class="alert alert-success">
                    {{ Session::get('message') }}
                </div>
            @endif
            @if (Session::has('error_message'))
                <div class="alert alert-warning">
                    {{ Session::get('error_message') }}
                </div>
            @endif
            <form action="{{ route('store.appointment') }}" method="post">
                @csrf
                <div class="card">
                    <div class="card-header lead">{{ $date }}</div>
                    <div class="card-body">
                        <div class="row">
                            @foreach ($times as $time)
                                <div class="col-md-3">
                                    <label class="btn btn-outline-primary">
                                        <input type="radio" name="time" value="{{ $time->time }}">
                                        <span>{{ $time->time }}</span>
                                    </label>
                                </div>
                                <input type="hidden" name="doctorId" value="{{ $doctor->id }}">
                                <input type="hidden" name="appointmentId" value="{{ $time->appointment_id }}">
                                <input type="hidden" name="date" value="{{ $date }}">
                            @endforeach
                        </div>
                    </div>
                    <div class="card-footer">
                        @auth
                            <button type="submit" class="btn btn-success" style="width: 100%">Book Appointment</button>
                        @else
                            <p>Kindly login to book an appointment.</p>
                            <a href="{{ url('/login') }}" class="btn btn-primary">Login</a>
                        @endauth
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
