@extends('layouts.base')
@section('body')

<div class="container">
  <h2>Order's History</h2><br/>

  @if (count($errors) > 0)
  @include('layouts.flash-messages')
  @else
  @include('layouts.flash-messages')
  @endif

 <div class="jumbotron">

 	<div>
    {{$dataTable->table(['class' => 'table table-striped table-hover '], true)}}
  </div>

  </div>
</div>

  @push('scripts')
    {{$dataTable->scripts()}}
  @endpush
@endsection