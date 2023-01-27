@extends('admin.layouts.main')

@section('content')
    <div class="page-header">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <i class="ik ik-inbox bg-blue"></i>
                    <div class="d-inline">
                        <h5>specialites</h5>
                        <span>List all specialites</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <nav class="breadcrumb-container" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="/">
                                <i class="ik ik-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#">specialites</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Index</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            @if (Session::has('message'))
                <div class="alert alert-success">
                    {{ Session::get('message') }}
                </div>
            @endif
            <div class="card">
                <div class="card-header"><h3></h3></div>
                <div class="card-body">
                    <table id="data_table" class="table">
                        <thead>
                            <tr>
                                <th>icon</th>
                                <th>Name</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($specialites) > 0)
                            @foreach ($specialites as $specialite)
                                <tr>
                                <td><img src="/icons/{{$specialite->image }}" width="30" alt="user image" style="border-radius: 100%"></td>
                                    <td>{{ $specialite->specialite }}</td>
                                    <td>
                                        <div class="table-actions">
                                            <a href="{{ route('specialite.edit', $specialite->id) }}" class="btn btn-primary">
                                                <i class="ik ik-edit-2"></i>
                                            </a>
                                            <form method="POST" action="{{ route('specialite.destroy', $specialite->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button onclick="return confirm('Are you sure?')" type="submit" class="btn btn-danger">
                                                    <i class="ik ik-trash-2"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>

                            @endforeach
                            @else
                                <h1>No specialites</h1>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection