@extends('layouts.master')
@section('content')
<style>
  .push-top {
    margin-top: 50px;
  }
</style>
<div class="push-top">
  @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}  
    </div><br />
  @endif
 
  <div class="col col-md-6">
    <i class="fa fa-plus-circle" aria-hidden="true">
    <a href="{{ route('customers.create')}}">Add New Record</a>
  </li>
  </div>

  <table class="table">
    <thead>
        <tr class="table-warning">
          <td>ID</td>
          <td>First Name</td>
          <td>Last Name</td>
          <td>Address</td>
          <td>Town</td>
          <td>City</td> 
          <td>Phone</td>
          <td>Image</td>
          <td class="text-center">Action</td>
        </tr>
    </thead>
    <tbody>
        @foreach($customers as $customers)
        <tr>
            <td>{{$customers->id}}</td>
            <td>{{$customers->fname}}</td>
            <td>{{$customers->lname}}</td>
            <td>{{$customers->address}}</td>
            <td>{{$customers->town}}</td>
            <td>{{$customers->city}}</td>
            <td>{{$customers->phone}}</td>
            <td><img src="{{ asset('img_path/'.$customers->cust_img)}}" width = "80px" height="80px"></td>
            <td class="text-center">
            </td>
        </tr>
        @endforeach


       

    </tbody>
  </table>
<div>
@endsection