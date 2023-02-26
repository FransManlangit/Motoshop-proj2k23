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
    <a href="#">Add New Record</a>
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
        @foreach($mechanics as $mechanics)
        <tr>
            <td>{{$mechanics->id}}</td>
            <td>{{$mechanics->fname}}</td>
            <td>{{$mechanics->lname}}</td>
            <td>{{$mechanics->address}}</td>
            <td>{{$mechanics->town}}</td>
            <td>{{$mechanics->city}}</td>
            <td>{{$mechanics->phone}}</td>
            <td><img src="{{ asset('img_path/'.$mechanics->mechanic_img)}}" width = "80px" height="80px"></td>
            <td class="text-center">
            </td>
        </tr>
        @endforeach


       

    </tbody>
  </table>
<div>
@endsection