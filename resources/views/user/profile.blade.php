@extends('layouts.master')
@section('content')
<div class="row">
        <div class="col-md-8 col-md-offset-2">
        <h1><i class="fa fa-user-circle-o" aria-hidden="true">User Profile: {{Auth::user()->name}}</i></h1>
        
            @foreach($customers as $customers)
            <div class="container">
            <h3><img src="{{ asset('img_path/'.$customers->cust_img)}}" width = "120px" height="120px"></h3>
            <h3><b>First Name:</b>{{$customers->fname}}</h3>
            <h3><b>Last Name:</b>{{$customers->lname}}</h3>
            <h3><b>Phone:</b>{{$customers->phone}}</h3>
            <h3><b>Address:</b>{{$customers->address}}</h3>
            <h3><b>Town:</b>{{$customers->town}}</h3>
            <h3><b>City:</b>{{$customers->city}}</h3>
        <div class="col col-md-6">
        <a href="{{ route('customers.edit', $customers->id)}}" class = "btn btn-primary btn-sm">Update My Information</a>
        </div>
        @endforeach

</div>
</div>
            
@endsection