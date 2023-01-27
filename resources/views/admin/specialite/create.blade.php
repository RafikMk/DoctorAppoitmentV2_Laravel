@extends('admin.layouts.main')

@section('content')
      
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-edit bg-blue"></i>
                        <div class="d-inline">
                            <h5>Add specialite</h5>
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
                    <li class="breadcrumb-item"><a href="#">specialite</a></li>
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
    <div class="card-header"><h3>Add specialite </h3></div>
    <div class="card-body">
        <form class="forms-sample" action="{{ route('specialite.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                    <label for="specialite">specialite</label>
                    <input type="text" class="form-control @error('specialite') is-invalid @enderror" id="specialite" placeholder="specialite" name="specialite" value="{{ old('specialite') }}" required>
                    @error('specialite')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>
                <div class="form-group">
                <label for="image">image</label>
                            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                            @error('image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                <label for="color">color</label>
                            <input type="color" name="color" value="#F2F2F3" class="form-control @error('color') is-invalid @enderror">
                            @error('color')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $color }}</strong>
                                </span>
                            @enderror
                        </div>
                </div>
            </div>


            <button type="submit" class="btn btn-primary mr-2">Submit</button>

        </form>
    </div>
</div>
</div>
</div>
@endsection
