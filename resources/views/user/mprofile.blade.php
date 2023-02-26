@extends('layouts.master')
@section('content')
<div class="row">
        <div class="col-md-8 col-md-offset-2">
        <h1><i class="fa fa-user-circle-o" aria-hidden="true">User Profile: {{Auth::user()->name}}</i></h1>
        
            @foreach($mechanics as $mechanics)
            <div class="container">
            <h3><img src="{{ asset('img_path/'.$mechanics->mechanic_img)}}" width = "120px" height="120px"></h3>
            <h3><b>First Name:</b>{{$mechanics->fname}}</h3>
            <h3><b>Last Name:</b>{{$mechanics->lname}}</h3>
            <h3><b>Phone:</b>{{$mechanics->phone}}</h3>
            <h3><b>Address:</b>{{$mechanics->address}}</h3>
            <h3><b>Town:</b>{{$mechanics->town}}</h3>
            <h3><b>City:</b>{{$mechanics->city}}</h3>
        <div class="col col-md-6">
        <a href="{{ route('mechanics.edit', $mechanics->id)}}" class = "btn btn-primary btn-sm">Update My Information</a>
        </div>
        @endforeach

</div>
</div>
            
@endsection