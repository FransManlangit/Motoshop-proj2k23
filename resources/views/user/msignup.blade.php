@extends('layouts.master')
@section('content')
<div class="card push-top">
  <div class="card-header">
  <h3>Mechanic Register</h3>
    <h5>Register to MotoShop:</h5>
  </div>
  <div class="card-body">
    @if ($errors->any())
    <h1>Sign Up</h1>
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
    @endif
      <form method="post" action="{{ route('user.msignups') }}" enctype ="multipart/form-data">
        @csrf
          <div class="form-group">
              @csrf
              <label for="fname"><i class="fa fa-user-circle" aria-hidden="true"></i>First Name</label>
              <input type="text" class="form-control" name="fname" id="fname"/>
          </div>
          <div class="form-group">
              <label for="lname"><i class="fa fa-user-circle" aria-hidden="true"></i>Last Name</label>
              <input type="text" class="form-control" name="lname" id="lname"/>
          </div>

          

          <div class="form-group">
              <label for="address"><i class="fa-solid fa-address-card"></i>Address</label>
              <input type="text" class="form-control" name="address" id="address"/>
          </div>


          <div class="form-group">
              <label for="town"><i class="fa fa-map-marker" aria-hidden="true"></i>Town</label>
              <input type="text" class="form-control" name="town" id="town"/>
          </div>

          <div class="form-group">
              <label for="city"><i class="fa-solid fa-city"></i>City</label>
              <input type="text" class="form-control" name="city" id=""/>
          </div>

             <div class="form-group">
            <label for="phone"><i class="fa fa-phone" aria-hidden="true"></i>Phone</label>
            <input type="tel" class="form-control" name="phone" id="phone"/>
        </div>

          <div class="form-group">
                <label for="email"><i class="fa fa-envelope" aria-hidden="true"></i>Email</label>
                <input type="text" name="email" id="email" class="form-control">
          </div>

          <div class="form-group">
                <label for="password"><i class="fa fa-key" aria-hidden="true"></i>Password</label>
                <input type="password" name="password" id="password" class="form-control">
          </div>

          <div class="form-group">
            <label for="image"><i class="fa-solid fa-photo-film"></i>Upload Photo </label>
            <input type="file" name="mechanic_img" id="mechanic_img" class="form-control">
      </div>


             <button type="submit" class="btn btn-block btn-danger">Register</button>
      </form>
  </div>
</div>
@endsection