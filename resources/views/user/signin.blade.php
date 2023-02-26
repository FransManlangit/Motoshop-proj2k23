@extends('layouts.master')
@section('content')
<div class="row">
        <div class="col-md-4 col-md-offset-4">

            <h1><i class="fa fa-sign-in" aria-hidden="true">Sign In</i></h1>
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form class="" action="{{ route('user.signins') }}" method="post">
                {{ csrf_field() }}

                <div class="form-group">
                    <label for="email"><i class="fa fa-envelope" aria-hidden="true">Email:</i></label>
                    <input type="text" name="email" id="email" class="form-control">
                    @if($errors->has('email'))
                        <div class="error">{{ $errors->first('email') }}</div>
                    @endif
                </div>
                <div class="form-group">
                    <label for="password"><i class="fa fa-key" aria-hidden="true"></i>Password:</li></label>
                    <input type="password" name="password" id="password" class="form-control">
                    @if($errors->has('password'))
                        <div class="error">{{ $errors->first('password') }}</div>
                    @endif
                </div>
                    <input type="submit" value="Sign In" class="btn btn-primary">
             </form>
        </div>
</div>
@endsection