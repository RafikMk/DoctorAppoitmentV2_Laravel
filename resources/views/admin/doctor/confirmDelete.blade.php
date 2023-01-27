@extends('admin.layouts.main')

@section('content')
      
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-edit bg-blue"></i>
                        <div class="d-inline">
                            <h5>Delete Doctor</h5>
                            <span>lorem ipsum dolor sit amet, consectetur adipisicing elit</span>
                        </div>
                    </div>
                </div>
        <div class="col-lg-4">
            <nav class="breadcrumb-container" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="../index.html"><i class="ik ik-home"></i></a>
                    </li>
                    <li class="breadcrumb-item"><a href="#">Doctor</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Add</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<div class="row justify-content-center">
<div class="col-md-10">
    @if (Session::has('message'))
        <div class="alert alert-success">
            {{ Session::get('message') }}
        </div>
    @endif
<div class="card">
    <div class="card-header"><h3>Confirm Delete</h3></div>
    <div class="card-body">
        <h2>{{ $user->name }}</h2>
        <img src="{{ asset('images') }}/{{ $user->image }}" width="120" alt="" class="mb-3">
        <form class="forms-sample" action="{{ route('doctor.destroy', $user->id) }}" method="POST">
            @csrf
            @method('DELETE')

            <div class="card-footer">
                <button type="submit" class="btn btn-danger mr-2">Confirm</button>
                <a href="{{ route('doctor.index') }}" class="btn btn-secondary">
                    Cancel
                </a>
            </div>

        </form>
    </div>
</div>
</div>
</div>
@endsection
