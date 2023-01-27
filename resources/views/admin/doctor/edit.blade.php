@extends('admin.layouts.main')

@section('content')
      
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-edit bg-blue"></i>
                        <div class="d-inline">
                            <h5>Admins/Doctors</h5>
                            <span>Update User Information</span>
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
                    <li class="breadcrumb-item active" aria-current="page">Update</li>
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
    <div class="card-header"><h3>Doctor add form </h3></div>
    <div class="card-body">
        <form class="forms-sample" action="{{ route('doctor.update', $user->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" value="{{ $user->id }}">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                    <label for="name">Full name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Name" name="name" value="{{ $user->name }}">
                    @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Email" value="{{ $user->email }}">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="" placeholder="password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="gender">Gender</label>
                        <select name="gender" class="form-control @error('gender') is-invalid @enderror" id="gander" value="{{ old('gender') }}">
                            @foreach (['male', 'female'] as $gender)
                                <option value="{{ $gender }}" @if($user->gender == $gender) selected @endif>{{ $gender }}</option>
                            @endforeach
                        </select>
                        @error('gender')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="education">Highest education</label>
                        <input type="text" class="form-control @error('education') is-invalid @enderror" id="education" name="education" placeholder="education" value="{{ $user->education }}">
                        @error('education')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" id="location" class="form-control @error('address') is-invalid @enderror" id="address" name="address" placeholder="address" value="{{ $user->address }}">
                        <input type="hidden" name="latitude" class="form-control @error('latitude') is-invalid @enderror" id="latitude" placeholder="latitude"  value="{{ old('latitude') }}">
                        <input type="hidden" name="longitude" class="form-control @error('longitude') is-invalid @enderror" id="longitude" placeholder="longitude"  value="{{ old('longitude') }}">

                        @error('address')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Specialist</label>
                        <select name="department" class="form-control @error('department') is-invalid @enderror" id="department">
                        @foreach (App\Specialite::all() as $specialite)
                        <option value="{{ $specialite->specialite }}">{{ $specialite->specialite }}</option>
                            @endforeach
                        </select>
                        @error('department')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Phone number</label>
                        <input type="text" name="phone_number" class="form-control @error('phone_number') is-invalid @enderror" value="{{ $user->phone_number }}">
                        @error('phone_number')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

            </div>
            <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>File Upload</label>
                    <input type="file" name="image" class="form-control file-upload-info @error('image') is-invalid @enderror"  placeholder="Upload Image">
                    <span class="input-group-append">
                    <button class="file-upload-browse btn btn-primary" type="button">Choose Image</button>
                    </span>
                    @error('image')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Role</label>
                    <select name="role_id" class="form-control @error('role_id') is-invalid @enderror">
                        @foreach (App\Role::where('name', '!=', 'patient')->get() as $role)
                            <option value="{{ $role->id }}" @if($user->role_id == $role->id) selected @endif>
                                {{ $role->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('role_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="description">About</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" rows="4" name="description">
                        {{ $user->description }}
                    </textarea>
                    @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <button type="submit" class="btn btn-primary mr-2">Update</button>
            <button class="btn btn-light">Cancel</button>
        </form>
    </div>
</div>
</div>
</div>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBw834lTlc-gq-XDeBV8jSk3cleQl0i_j0&libraries=places"></script>
<script>
    var bounds = new google.maps.LatLngBounds(
  new google.maps.LatLng(30.75, 9.25), // South West corner of Tunisia
  new google.maps.LatLng(37.5, 11.5) // North East corner of Tunisia
);

    function initAutocomplete() {
    var input = document.getElementById('location');
    var autocomplete = new google.maps.places.Autocomplete(input, { bounds: bounds });
    google.maps.event.addListener(autocomplete, 'place_changed', function () {
    var place = autocomplete.getPlace();
    var latitude = place.geometry.location.lat();
    var longitude = place.geometry.location.lng();
    document.getElementById('latitude').value =latitude ;
 document.getElementById('longitude').value =longitude ;
  // alert(typeof document.getElementById('latitude').value)

    console.log("Latitude: " + latitude + ", Longitude: " + longitude);
});

}
google.maps.event.addDomListener(window, 'load', initAutocomplete);

    </script>
@endsection
