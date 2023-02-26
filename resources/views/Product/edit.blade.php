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
    Update Product's Data
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
      <form method="post" action="{{ route('products.update', $products->id) }}" enctype ="multipart/form-data">

          <div class="form-group">
          @csrf 
              @method('PUT')
              <label for="description"><i class="fa fa-user-circle" aria-hidden="true"></i>Description</label>
              <input type="text" class="form-control" name="description" value="{{ $products->description }}"/>
          </div>


          <div class="form-group">
              <label for="sell_price"><i class="fa fa-user-circle" aria-hidden="true"></i>Sell Price</label>
              <input type="text" class="form-control" name="sell_price" value="{{ $products->sell_price }}"/>
          </div>

          <div class="form-group">
          <label for="image" class="control-label"><i class="fa-solid fa-photo-film"></i>Item Photo</label>
          <input type="file" class="form-control" id="id" name="product_img" value="{{$products->product_img}}"/>
           @if($errors->has('product_img'))
           <small>{{ $errors->first('product_img') }}</small>
           @endif
          </div>

          <button type="submit" class="btn btn-block btn-danger">Update</button>
      </form>
  </div>
</div>
@endsection

