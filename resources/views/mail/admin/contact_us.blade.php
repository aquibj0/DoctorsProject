<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>New Contact Us Message</title>
</head>
<body>
    <div class="container">
        <h3><b>New Contact Us Message</b></h3>
    </div>
    <hr>
    <div class="container">
        <div class="row">
            <div class="col-md-4">Name</div>
            <div class="col-md">{{ $msg->name }}</div>
        </div>
        <div class="row">
            <div class="col-md-4">Email</div>
            <div class="col-md">{{ $msg->email }}</div>
        </div>
        <div class="row">
            <div class="col-md-4">Phone</div>
            <div class="col-md">{{ $msg->phone }}</div>
        </div>
        <div class="row">
            <div class="col-md-4">Address</div>
            <div class="col-md">{{ $msg->address }}</div>
        </div>
        <div class="row">
            <div class="col-md-4">Subject</div>
            <div class="col-md">{{ $msg->subject }}</div>
        </div>
        <div class="row">
            <div class="col-md-4">Message</div>
            <div class="col-md">{{ $msg->message }}</div>
        </div>
    </div>
</body>
</html>

{{ $msg }}