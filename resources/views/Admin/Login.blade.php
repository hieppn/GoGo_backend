<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
 <link rel="shortcut icon" type="image/png" href=""/>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <title>Login</title>
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
.to {
    display: grid;
    grid-template-columns: repeat(12,1fr);
    grid-template-rows: minmax(100px,auto);
}
 
.form {
    border: 1px solid #80808000;
    grid-column: 6/9;
    grid-row: 3;
    height: 470px;
    width: 292px;
    display: flex;
    flex-direction: column;
    align-items: center;
    position: relative;
    border-radius: 15px;
    box-shadow: 0px 0px 14px 0px grey;
    background-color: white;
    padding: 5px;
}
h2 {
    margin-top: 40px;
    margin-bottom: 15px;
}
 
label {
    margin-left: -126px;
    display: block;
    font-weight: lighter;
 
}
input{
    display: block;
    border-bottom: 2px solid #00BCD4;
    margin-top: 6px;
    margin-bottom: 10px;
    outline-style: none;
}
input[type="text"] {
    padding: 5px;
    width: 70%;
}
 
button#submit {
    height:40px;
    width: 50%;
    padding: 7px;
    border-radius: 10px;

    border: none;
    position: absolute;
    bottom: 70px;
    cursor: pointer;
    background: linear-gradient(to right, #fc00ff, #00dbde);
}
button#submit:hover{
 
    background: linear-gradient(to right, #fc466b, #3f5efb); 
}
 
    </style>
      </head>
  <body>
          <div class="to">
            <form class="form" method="post" action="/admin/login">
                        {{ csrf_field() }}
                        <h3 class="card-title text-center" style="margin-top: 20px">Login</h3>
           <label style="margin-left: -205px;margin-top:5px;">Email</label>
                <input type="email" class="form-control" placeholder="Email" required autofocus name="email"value="{{ old('email') }}">
              <label style="margin-left: -190px;margin-top:5px;">Mật khẩu</label>
                <input type="password" class="form-control" placeholder="Password" required name="password" maxlength="10">
              <div class="custom-control custom-checkbox mb-3">
                <input type="checkbox" class="custom-control-input" id="customCheck1">
                <label class="custom-control-label" for="customCheck1">Nhớ mật khẩu</label>
              </div>
              <button id="submit" type="submit" name="submit" value="Login">Login</button>
            </form>
            <br>
  </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  </body>
</html>