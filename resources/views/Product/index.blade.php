@extends('layouts.base')
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
          <td>Description</td>
          <td>Sell Price</td>
          <td>Image</td>
          <td class="text-center">Action</td>
        </tr>
    </thead>
    <tbody>
        @foreach($products as $products)
        <tr>
            <td>{{$products->id}}</td>
            <td>{{$products->fname}}</td>
            <td>{{$products->lname}}</td>
            <td>{{$products->address}}</td>
            <td>{{$products->town}}</td>
            <td>{{$products->city}}</td>
            <td>{{$products->phone}}</td>
            <td><img src="{{ asset('img_path/'.$products->product_img)}}" width = "80px" height="80px"></td>
            <td class="text-center">
            </td>
        </tr>
        @endforeach
    </tbody>
  </table>
<div>
@endsection