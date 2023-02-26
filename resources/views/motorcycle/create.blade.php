@extends('layouts.base')
@section('body')
<div class="container">
  <h2>Create New motorcycle</h2>
  <br>
  <form method="post" action="{{ route('motorcycle.store') }}" enctype="multipart/form-data">
  @csrf
   <div class="jumbotron">
   
   <div class="form-row">
    @if(Auth::user()->role == 'customer')

    <input type="text" class="form-control" id="customer_id" model="customer_id" hidden value="{{ Auth::user()->customers->id }}" >
    
    @else
  <div class="col-md-4 mb-3">
    <label for="customer_id">Owner Name</label>
    <select class="form-control" id="customer_id" name="customer_id" required="">
      @foreach($customers as $id => $customer)
        <option value="{{$id}}"><a> {{$customer}} </a></option>
      @endforeach
    </select>
  </div>
   @endif

  

  <div class="col-md-4 mb-3">
    <label for="model" class="control-label">motorcycle model</label>
    <input type="text" class="form-control" id="model" name="model" value="{{old('model')}}" required="">
    @if($errors->has('model'))
    <small style="color: red">{{ $errors->first('model') }}</small>
   @endif 
 </div>
</div>

<div class="form-row">
     

</div>
  <div class="form-row">
    <div class="col-md-3 mb-3">
    <label for="color" class="control-label">Species</label>
    <input type="text" class="form-control" id="color" name="color" value="{{old('color')}}" required="">
    @if($errors->has('color'))
    <small style="color: red">{{ $errors->first('color') }}</small>
   @endif 
  </div>
  
</div>
   <div class="form-group">
                <label for="motorcycle_img" class="control-label">motorcycle Picture</label>
                <input type="file" class="form-control-file" id="motorcycle_img" name="image" required="">
                @error('image')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                </div>
<button type="submit" class="btn btn-primary">Save</button>
  <a href="{{url()->previous()}}" class="btn btn-default" role="button">Cancel</a>
  </div>
  </div>     
</div>
</form>
@endsection