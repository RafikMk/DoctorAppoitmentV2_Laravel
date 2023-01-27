@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2>{{ __('My Prescriptions') }}</h2>
                </div>

                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Date</th>
                                <th>Doctor</th>
                                <th>Ailment</th>
                                <th>Symptoms</th>
                                <th>Medicine</th>
                                <th>Procedure to Use</th>
                                <th>Doctor's Feedback</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($prescriptions as $prescription)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $prescription->date }}</td>
                                    <td>{{ $prescription->doctor->name }}</td>
                                    <td>{{ $prescription->ailment }}</td>
                                    <td>{{ $prescription->symptoms }}</td>
                                    <td>{{ $prescription->medicine }}</td>
                                    <td>{{ $prescription->procedure }}</td>
                                    <td>{{ $prescription->feedback }}</td>
                                </tr>
                            @empty
                                <td>You have no prescriptions</td>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
