<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    Hello {{ $user->userFirstName }},
    <hr>
    <p>Your password link is this: <a href="{{ $link }}" target="_blank">Click here</a>
    <br>Or copy the link {{$link}}</p>
    <hr>
    <p> Best Regards,<br>
    Team BIRTH</p>
</body>
</html>