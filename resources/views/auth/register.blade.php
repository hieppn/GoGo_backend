<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
 <link rel="shortcut icon" type="image/png" href=""/>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <title>Register</title>
    <style>
    *{
    margin:0;
    padding:0;
    border:none;
    font-family: 'Open Sans', sans-serif;
}
body {
    background-image: url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQV94lDvga3FIjsmkVYya1cvQEBFdiy05YXzQ&usqp=CAU');
    background-repeat: no-repeat;
    overflow: hidden;
    background-attachment: fixed;  
    background-size: cover;
    /* background-color: #ededed; */
}
    </style>
      </head>
  <body>
  <div class="container">
  <div class="row" style="margin-top: 45px; align: center">
  <div class="col-md-4 col-md-offset-4">
  <h3>Register</h3>
  <hr>
  <form method="post" action="{{route('auth.create')}}">
            @csrf
            <div class="results">
            @if(Session::get('success'))
                <div class="alert alert-success">
                    {{Session::get('success')}}
                </div>
            @endif
            @if(Session::get('fail'))
                <div class="alert alert-danger">
                    {{Session::get('fail')}}
                </div>
            @endif
            </div>
                <div class="form-group">
                    <label>Full name</label>
                    <small class="text-danger">@error('full_name'){{$message}} @enderror </small>
                    <input type="text" class="form-control" placeholder="Full name"  autofocus name="full_name" value="{{old('full_name')}}">
                </div>
                <div class="form-group">
                <label>Email</label>
                <small class="text-danger">@error('email'){{$message}} @enderror </small>
                <input type="email" class="form-control" placeholder="Email" autofocus  name="email"value="{{old('email')}}">
                </div>
                <div class="form-group">
                <label>Phone</label>
                <small class="text-danger">@error('phone'){{$message}} @enderror </small>
                <input type="text" class="form-control" placeholder="Phone" autofocus  name="phone"value="{{old('phone')}}">
                </div>
                <div class="form-group">
                <label>Address</label>
                <small class="text-danger">@error('address'){{$message}} @enderror </small>
                <input type="text" class="form-control" placeholder="Address" autofocus  name="address"value="{{old('address')}}">
                </div>
                <div class="form-group">
                <label>Id Card</label>
                <small class="text-danger">@error('id_card'){{$message}} @enderror </small>
                <input type="text" class="form-control" placeholder="Id Card" autofocus  name="id_card"value="{{old('id_card')}}">
                </div>
                <div class="form-group">
                <label>Birthday</label>
                <small class="text-danger">@error('birthday'){{$message}} @enderror </small>
                <input type="date" class="form-control" id="birthday" autofocus  name="birthday"value="{{old('birthday')}}">
                </div>
                <div class="form-group">
                <label>Password</label>
                <small class="text-danger">@error('password'){{$message}} @enderror </small>
                <input type="password" class="form-control" placeholder="Password" autofocus  name="password"value="{{old('password')}}">
                </div>
                <div class="form-group">
                <button id="submit" type="submit" name="submit" class="btn btn-block btn-primary" value="Register">Register</button>
                </div>
                <br>
                <a href="login">I already have an account!</a>
            </form>
  </div>
  </div>
  </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  </body>
</html>