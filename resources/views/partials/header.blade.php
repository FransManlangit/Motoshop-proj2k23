
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="/">Motoshop</a>
    </div>

   

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    <ul class="nav navbar-nav navbar-right">

            <li>
            <a href="{{route('getCustomer')}}">
            <i class="fa fa-users" aria-hidden="true">Customers</i>
            </a>
            </li>

                <li>
            <a href="{{route('getMechanic')}}">
            <i class="fa fa-users" aria-hidden="true">Mechanic</i>
            </a>
            </li>

              <li>
            <a href="{{route('getProduct')}}">
            <i class="fa fa-users" aria-hidden="true">Product</i>
            </a>
            </li>


          <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
          aria-expanded="false"><i class="fa fa-user" aria-hidden="true"></i> User Management <span class="caret"></span></a>
          <ul class="dropdown-menu">
            @if (Auth::check())
              <li><i class="fa fa-user" aria-hidden="true"><a href="{{ route('user.profile') }}">Customer Profile</a></i></li>
              <li><i class="fa fa-user" aria-hidden="true"><a href="{{ route('user.mprofile') }}">Mechanic Profile</a></i></li>
              <li role="separator" class="divider"></li>
              <li><i class="fa fa-sign-out" aria-hidden="true"><a href="{{ route('user.logout') }}">Logout</a></i></li>
            @else
              <li><i class="fa fa-user-plus" aria-hidden="true"><a href="{{ route('user.signup') }}">Customer Signup</a></i></li>
              <li><i class="fa fa-user-plus" aria-hidden="true"><a href="{{ route('user.msignup') }}">Mechanic Signup</a></i></li>
              <li><i class="fa fa-sign-in" aria-hidden="true"><a href="{{ route('user.signin') }}">Signin</a></i></li>
            @endif
          </ul>
        </li>
    </ul>
</div>
</div> 
</nav>      