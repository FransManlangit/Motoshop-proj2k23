@extends('layouts.master')
@section('content')
<style>
    .container {
      max-width: 450px;
    }
    .push-top {
      margin-top: 50px;
    }
</style>
<div class="card push-top">
  <div class="card-header">
    Update Customer's Data
  </div>
  <div class="card-body">
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
    @endif
      <form method="post" action="{{ route('customers.update', $customers->id) }}" enctype ="multipart/form-data">

          <div class="form-group">
          @csrf 
              @method('PUT')
              <label for="fname"><i class="fa fa-user-circle" aria-hidden="true"></i>First Name</label>
              <input type="text" class="form-control" name="fname" value="{{ $customers->fname }}"/>
          </div>


          <div class="form-group">
              <label for="lname"><i class="fa fa-user-circle" aria-hidden="true"></i>Last Name</label>
              <input type="text" class="form-control" name="lname" value="{{ $customers->lname }}"/>
          </div>




          <div class="form-group">
              <label for="address"><i class="fa-solid fa-address-card"></i>Address</label>
              <input type="text" class="form-control" name="address" value="{{ $customers->address }}"/>
          </div>

          

          <div class="form-group">
              <label for="town"><i class="fa fa-map-marker" aria-hidden="true"></i>Town</label>
              <input type="text" class="form-control" name="town" value="{{ $customers->town }}"/>
          </div>

          <div class="form-group">
              <label for="city"><i class="fa-solid fa-city"></i>City</label>
              <input type="text" class="form-control" name="city" value="{{ $customers->city }}"/>
          </div>

            <div class="form-group">
            <label for="phone"><i class="fa fa-phone" aria-hidden="true"></i>Phone</label>
            <input type="text" class="form-control" name="phone" value="{{ $customers->phone }}"/>
        </div>

          <div class="form-group">
          <label for="image" class="control-label"><i class="fa-solid fa-photo-film"></i>Your Photo</label>
          <input type="file" class="form-control" id="id" name="cust_img" value="{{$customers->cust_img}}"/>
           @if($errors->has('cust_img'))
           <small>{{ $errors->first('cust_img') }}</small>
           @endif
          </div>

          <button type="submit" class="btn btn-block btn-danger">Update</button>
      </form>
  </div>
</div>
@endsection

