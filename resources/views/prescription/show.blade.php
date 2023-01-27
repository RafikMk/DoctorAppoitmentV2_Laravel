@extends('admin.layouts.main')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2>{{ __('Prescription') }}
                    </h2>
                </div>

                <div class="card-body">
                   <p><b>Date:</b> {{ $prescription->date }}</p>
                   <p><b>Patient:</b> {{ $prescription->user->name }}</p>
                   <p><b>Doctor:</b> {{ $prescription->doctor->name }}</p>
                   <p><b>Ailment:</b> {{ $prescription->ailment }}</p>
                   <p><b>Symptoms:</b> {{ $prescription->symptoms }}</p>
                   <p><b>Medicine:</b> {{ $prescription->medicine }}</p>
                   <p><b>Procedure to use Medicine:</b> {{ $prescription->procedure }}</p>
                   <p><b>Feedback:</b> {{ $prescription->feedback }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
