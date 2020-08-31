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
    <table class="table table-borderless">
        <tbody>
          <tr>
              <tr>
                <th scope="col">Name</th>
                <th scope="row">{{ $msg->name }}</th>
              </tr>
              <tr>
                <th scope="col">Email</th>
                <td>{{ $msg->email }}</td>
              </tr>
              <tr>
                <th scope="col">Phone</th>
                <td>{{ $msg->phone }}</td>
              </tr>
              <tr>
                <th scope="col">Address</th>
                <td>{{ $msg->address }}</td>
              </tr>
              <tr>
                <th scope="col">Subject</th>
                <td>{{ $msg->subject }}</td>
              </tr>
              <tr>
                <th scope="col">Message</th>
                <td>{{ $msg->message }}</td>
              </tr>
          </tr>
        </tbody>
    </table>
</body>
</html>