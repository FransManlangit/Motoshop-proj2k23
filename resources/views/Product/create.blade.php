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
    Add New Record
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
    
      <form method="post" action="{{ route('products.store') }}" enctype ="multipart/form-data">
        @csrf
          <div class="form-group">
              @csrf
              <label for="description"><i class="fa-solid fa-bell-concierge"></i>Description</label>
              <input type="text" class="form-control" name="description" id="description"/>
           </div>
    
          <div class="form-group">
              <label for="sell_price"><i class="fa-solid fa-money-bill"></i>Sell Price</label>
              <input type="number" class="form-control" name="sell_price" id="sell_price"/>
          </div>

          <div class="form-group">
          <label for="product_img" class="control-label"><i class="fa-solid fa-photo-film"></i>Product Image</label>
          <input type="file" class="form-control" id="product_img" name="product_img">
          @error('images')
          <div class="alert alert-danger">{{ $message }}</div>
          @enderror 
  </div>
          <button type="submit" class="btn btn-block btn-danger">Add New Service</button>
      </form>
  </div>

</div>
@endsection
