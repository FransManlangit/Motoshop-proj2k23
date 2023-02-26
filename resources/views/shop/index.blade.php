@extends('layouts.base')
@section('body')
@section('title')
Acme Clinic Shop
@endsection
<div id="viewport">
<div class="container">
  <!-- Page Heading -->
  @if (count($errors) > 0)
  @include('layouts.flash-messages')
  @else
  @include('layouts.flash-messages')
  @endif
  <hr>
  <h1 class="my-4">Motorcycle Shop
    <small>“We Know you love your Motorcycle more.”</small>
  </h1>
  <div class="row">
   @foreach ($products->chunk(3) as $itemChunk)
            @foreach ($itemChunk as $product)
                <div class="col-lg-4 col-sm-6 mb-4">
                  <div class="card h-100 shadow rounded">
                    <img src="{{ $product->product_img }}" alt="..." class="img-responsive">
                      <div class="card-body">
                            <h3 class="card-title">
                                <a href="#">{{ $product->description }}</a>
                            </h3>
                        <p class="card-text">Price of Service: ${{ $product->price}}</p>
                     </div>
                     <a href="{{ route('shop.review',$product->id) }}" class="btn btn-default"><i class="fas fa-comments"></i> Services Review</a> 
                     <a href="{{ route('product.addToCart', ['id'=>$product->id]) }}" class="btn btn-primary"><i class="fas fa-cart-plus"></i> Add to Cart</a>
                  </div>
                </div>
            @endforeach
    @endforeach
</div>
{{ $products->links() }}
</div>
@endsection