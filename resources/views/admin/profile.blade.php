<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Profile</title>
</head>
<body>
<div class="container">
  <div class="row" style="margin-top: 45px; align: center">
  <div class="col-md-4 col-md-offset-3">
  <table class="table table-hover">
  <thead>
  </thead>
  <th>Full name </th>
  <th>Email</th>
  <th>ID</th>
  <th></th>
  <th></th>
  <th></th>
  <th></th>
  <th></th>
  <th></th>
  <tbody>
  <tr>
  <td>{{$UserInfo->full_name}}</td>
  <td>{{$UserInfo->email}}</td>
  <td>{{$UserInfo->id_card}}</td>
  <td>{{$UserInfo->phone}}</td>
  <td>{{$UserInfo->address}}</td>
  <td>{{$UserInfo->id_role}}</td>
  <td>{{$UserInfo->birthday}}</td>
  <td><a href="logout">Logout</a></td>
  </tr>
  </tbody>
  </table>
  </div>
  </div>
</div>
</body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</html>