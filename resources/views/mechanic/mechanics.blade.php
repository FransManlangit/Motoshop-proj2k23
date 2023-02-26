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

 <div class="col-xs-6">
  <form method="post" enctype="multipart/form-data" action="{{ url('/mechanic/import') }}">
     @csrf
     <input type="file" id="uploadName" name="mechanic_import" required>
 </div>
 
   @error('mechanic_import')
     <small>{{ $message }}</small>
   @enderror
        <button type="submit" class="btn btn-info btn-primary " >Import Excel File</button>
        </form> 
 </div>


<div>
  {{ $dataTable->table(['class' => 'table table-bordered table-striped table-hover '], true) }}
</div>



<div class="modal " id="mechanicModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="width:75%;">
      <div class="modal-content">
        <div class="modal-header text-center">
          <p class="modal-title w-100 font-weight-bold">Add New Mechanic</p>
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
          width: 150px; "> First Name</label>
            <input type="text" id="fname" class="form-control validate" name="fname">
          </div>

          <div class="md-form mb-5">
<i class="fas fa-user prefix grey-text"></i>
            <label data-error="wrong" data-success="right" for="name" style="display: inline-block;
          width: 150px; "> Last Name</label>
            <input type="text" id="lname" class="form-control validate" name="lname">
          </div>


          <div class="md-form mb-5">
            <i class="fa fa-map-marker" aria-hidden="true"></i>
            <label data-error="wrong" data-success="right" for="name" style="display: inline-block;
          width: 150px; "> Address</label>
            <input type="text" id="address" class="form-control validate" name="address">
          </div>

      
          <div class="md-form mb-5">
            <i class="fa-solid fa-city"></i>
            <label data-error="wrong" data-success="right" for="name" style="display: inline-block;
          width: 150px; "> Town </label>
            <input type="text" id="town" class="form-control validate" name="town">
          </div>

          <div class="md-form mb-5">
<i class="fa-solid fa-city"></i>
            <label data-error="wrong" data-success="right" for="name" style="display: inline-block;
          width: 150px; "> City</label>
            <input type="text" id="city" class="form-control validate" name="city">
          </div>

            <div class="md-form mb-5">
            <i class="fa fa-phone" aria-hidden="true"></i>
            <label data-error="wrong" data-success="right" for="name" style="display: inline-block;
          width: 150px; "> Phone </label>
            <input type="text" id="phone" class="form-control validate" name="phone">
          </div>

          <div class="md-form mb-5">
            <i class="fa fa-envelope" aria-hidden="true"></i>
            <label data-error="wrong" data-success="right" for="email" style="display: inline-block;
          width: 150px; "> Email:</label>
            <input type="email" id="email" class="form-control validate" name="email">
          </div>
          <div class="md-form mb-5">

<i class="fa fa-key" aria-hidden="true"></i>
            <label data-error="wrong" data-success="right" for="password" style="display: inline-block;
          width: 150px; "> Password:</label>
            <input type="password" id="password" class="form-control validate" name="password">
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