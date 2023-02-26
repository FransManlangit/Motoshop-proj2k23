@extends('layouts.base')
@section('body')

 <div class="container">
    
      <h2>Status Update</h2><br/>
      {{-- dd($artists) --}}
      @if (count($errors) > 0)
                    @include('layouts.flash-messages')
            @endif
            
      {{ Form::model($orderinfo,['route' => ['order.update',$orderinfo->id],'method'=>'POST', 'enctype' =>'multipart/form-data']) }}

      <div class="jumbotron">
        <div class="d-flex justify-content-end">
         <a href="{{url()->previous()}}" class="btn btn-secondary btn-sm" role="button">Back</a>
       </div>

        <div class="form-row">
          <div class="col-md-4 mb-3">
            <label for="Name">Register as:</label>
            {!! Form::select('status', ['Finished' => 'Finished', 'Ongoing' => 'Ongoing', 'Cancelled' => 'Cancelled'], $orderinfo->status, ['class' => 'form-control']) !!}
            {{-- {!! Form::select('role', $user->role, null, ['class' => 'form-control', 'id' => 'role']) !!} --}}
          </div>
        </div>


        <ol class="list-group list-group-numbered">
          <p>Item Order List</p>
          @foreach($orders as $order)
          <li class="list-group-item d-flex justify-content-between align-items-start">
            <div class="ms-2 me-auto">
              <div class="fw-bold"><strong>{{ $order->description }}</strong></div>
              Price: {{ $order->price }}
            </div>
          </li>
          @endforeach
        </ol>

        <div class="row">
          <div class="form-group col-md-4" style="margin-top:30px">
            <button type="submit" class="btn btn-success">Submit</button>
          </div>
        </div>
     {!! Form::close() !!}
   </div>
    </div>
  </div>
@endsection