@extends('layouts.base')
@section('body')
  <div class="container">
    <br />
    @if ( Session::has('success'))
      <div class="alert alert-success">
        <p>{{ Session::get('success') }}</p>
      </div><br />
     @endif
  </div>

 {{-- <div class="col-xs-6">
  <form method="post" enctype="multipart/form-data" action="{{ url('/product/import') }}">
     @csrf
     <input type="file" id="uploadName" name="product_import" required>
 </div> --}}
 
   {{-- @error('product_import')
     <small>{{ $message }}</small>
   @enderror
        <button type="submit" class="btn btn-info btn-primary " >Import Excel File</button>
        </form> 
 </div> --}}
 <div>
  <a href="{{ route('products.create')}}" class="btn btn-success btn-sm">Add New Product</a>
  </div>


<div>
  {{ $dataTable->table(['class' => 'table table-bordered table-striped table-hover '], true) }}
</div>



<div class="modal " id="productModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="width:75%;">
      <div class="modal-content">
        <div class="modal-header text-center">
          <p class="modal-title w-100 font-weight-bold">Add New Product</p>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
   <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form  method="POST" action="#">
        {{csrf_field()}}
          
        <div class="modal-body mx-3" id="inputfacultyModal">
          <div class="md-form mb-5">
<i class="fas fa-user prefix grey-text"></i>
            <label data-error="wrong" data-success="right" for="name" style="display: inline-block;
          width: 150px; "> Description</label>
            <input type="text" id="description" class="form-control validate" name="description">
          </div>

          <div class="md-form mb-5">
<i class="fas fa-user prefix grey-text"></i>
            <label data-error="wrong" data-success="right" for="name" style="display: inline-block;
          width: 150px; "> Sell Price</label>
            <input type="text" id="sell_price" class="form-control validate" name="sell_price">
          </div>

         <div class="md-form mb-5">
         <i class="fas fa-user prefix grey-text"></i>
        <label data-error="wrong" data-success="right" for="name" style="display: inline-block;
        width: 150px; "> Product Image </label>
        <input type="number" id="product_img" class="form-control validate" name="product_img">
        </div>
 

 <div class="modal-footer d-flex justify-content-center">
            <button type="submit" class="btn btn-success">Save</button>
            <button class="btn btn-light" data-dismiss="modal">Cancel</button>
          </div>
        </form>
</div>
</div> 
</div>

  @push('scripts')
  {{ $dataTable->scripts() }}
@endpush
@endsection