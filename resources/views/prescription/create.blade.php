@extends('admin.layouts.main')

@section('content')
      
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <i class="ik ik-edit bg-blue"></i>
                        <div class="d-inline">
                            <h5>Add Prescription</h5>
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
                    <li class="breadcrumb-item"><a href="#">Prescription</a></li>
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
    <div class="card-header"><h3>Doctor add form </h3></div>
    <div class="card-body">
        <form class="forms-sample" action="{{ route('store.prescription') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                    <label for="name">Ailment</label>
                    <input type="text" class="form-control @error('ailment') is-invalid @enderror" id="ailment" placeholder="ailment" name="ailment" value="{{ old('ailment') }}">
                    @error('ailment')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="text">symptoms</label>
                        <input type="text" name="symptoms" class="form-control @error('symptoms') is-invalid @enderror" id="symptoms" placeholder="symptoms" value="{{ old('symptoms') }}">
                        @error('symptoms')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                    <label for="procedure">procedure</label>
                    <input type="text" class="form-control @error('procedure') is-invalid @enderror" id="procedure" placeholder="procedure" name="procedure" value="{{ old('procedure') }}">
                    @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="feedback">feedback</label>
                        <input type="text" name="feedback" class="form-control @error('feedback') is-invalid @enderror" id="feedback" placeholder="feedback" value="{{ old('feedback') }}">
                        @error('feedback')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="feedback">signature</label>
                        <input type="text" name="signature" class="form-control @error('signature') is-invalid @enderror" id="signature" placeholder="signature" value="{{ old('signature') }}">
                        @error('signature')
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
                    <label for="">Bookings Of Patient</label>
                    <select name="booking_id" class="form-control @error('booking_id') is-invalid @enderror" id="booking_id" value="{{ old('booking_id') }}">
                        <option value="">Select Booking of user</option>
                        @foreach (App\Booking::all() as $user)
                            <option value="{{ $user->id }}">{{ $user->user->name }}</option>
                        @endforeach
                    </select>
                    @error('specialite')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
           </div>

        
           
            <div class="col-md-6">
            <div class="form-group">
    <label for="date">Date</label>
    <input type="date" name="date" class="form-control @error('date') is-invalid @enderror" id="date" value="{{ old('date') }}">
    @error('date')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
</div>
        </div>
            </div>


            
            <button type="submit" class="btn btn-primary mr-2">Submit</button>
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
