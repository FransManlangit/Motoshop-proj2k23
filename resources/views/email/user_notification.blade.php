<!DOCTYPE html>
<html>
<head>
 <title>New Customer</title>
</head>
<body>
<h1>Thank you for registering ! {{  $name }} {{$email}}</h1>
<img src="{{ $message->embed(public_path('/img_path/logo1.jpg')) }}" style="padding:0px; margin:0px" />
</body>
</html>