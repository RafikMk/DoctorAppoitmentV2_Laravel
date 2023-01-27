@extends('layouts.app')

@section('content')
<div class="container">
    @if (Session::has('message'))
        <div class="alert alert-success">{{ Session::get('message') }}</div>
    @endif
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    <h1>{{ __('User Profile') }}</h1>
                </div>

                <div class="card-body">
                    <p>Name: {{ auth()->user()->name }}</p>
                    <p>Email: {{ auth()->user()->email }}</p>
                    <p>Address: {{ auth()->user()->address }}</p>
                    <p>Phone No: {{ auth()->user()->phone_number }}</p>
                    <p>Gender: {{ ucfirst(auth()->user()->gender) }}</p>
                    <p>Bio: {{  auth()->user()->description }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h1>{{ __('Update Profile') }}</h1>
                </div>
                <div class="card-body">
                    <form action="{{ route('store.profile') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ auth()->user()->name }}">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Address</label>
                            <input type="text" id="location" name="address" class="form-control" value="{{ auth()->user()->address }}">
                            <input type="hidden" name="latitude" class="form-control @error('latitude') is-invalid @enderror" id="latitude" placeholder="latitude"  value="{{ auth()->user()->latitude }}">
                        <input type="hidden" name="longitude" class="form-control @error('longitude') is-invalid @enderror" id="longitude" placeholder="longitude"  value="{{ auth()->user()->longitude}}">

                        </div>
                        <div class="form-group">
                            <label>Phone No</label>
                            <input type="text" name="phone_number" class="form-control" value="{{ auth()->user()->phone_number }}">
                        </div>
                        <div class="form-group">
                            <label>Gender</label>
                            <select name="gender" class="form-control @error('gender') is-invalid @enderror">
                                <option value="">Select Gender</option>
                                <option value="male" @if(auth()->user()->gender == 'male') selected @endif>Male</option>
                                <option value="female" @if(auth()->user()->gender == 'female') selected @endif>Female</option>
                            </select>
                            @error('gender')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                        <label>Specialite</label>
               
<select name="specialite" class="form-control">
  <option value="">Select specialite</option>
  @if (count($specialites) > 0)
    @foreach ($specialites as $specialite)
      <option value="{{$specialite->specialite}}" 
        @if(auth()->user()->specialite == $specialite->specialite) selected @endif>
        {{$specialite->specialite}}
      </option>
    @endforeach
  @else
    <option value="no specialite">No specialite</option>
  @endif
</select>
                         </div>
                        <div class="form-group">
                            <label>Bio</label>
                            <textarea name="description" class="form-control">
                                {{ auth()->user()->description }}
                            </textarea>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary" type="Submit">
                                Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    <h1>{{ __('Update Avatar') }}</h1>
                </div>
                <div class="card-body">
                   <form action="{{ route('update.avatar') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                        <div class="form-group">
                            @if (auth()->user()->image)
                                <img src="/profile/{{ auth()->user()->image }}" width="120" alt="user image" style="border-radius: 100%">
                            @endif
                        </div>
                        <div class="form-group">
                            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                            @error('image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        
                        <button class="btn btn-primary">Update</button>
                   </form>
                </div>
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
