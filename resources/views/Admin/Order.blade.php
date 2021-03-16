<!DOCTYPE html>
<html lang="en">
    <head>
    <title></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/style.css" rel="stylesheet">
        <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
      <script src='https://kit.fontawesome.com/a076d05399.js'></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js"></script>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <link rel="stylesheet" href="{{asset('css/AdminPage.css')}}">
      <script src='Chart.min.js'></script>
    </head>
    <body>
    <nav class="navbar navbar-inverse">
              <div class="navbar-header">       
                  <a class="navbar-brand" href="#">
                  <img src="{{asset('Image/logo2.png')}}" alt="" height="40" width="80" />
                  </a>
                  <a class="navbar-brand" href="#">uigyuj</a>
              </div>
              <div class="collapse navbar-collapse" id="myNavbar">
                  <ul class="nav navbar-nav navbar-right">
                      <li><a href="#">Admin</a></li>
                      <li><a href=""><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
                  </ul>
              </div>     
      </nav>
      <div class="container-fluid text-center">
          <div class="row content">
              <div class="col-sm-2 sidenav">
                  <div class="input-group">
                      <input type="text" class="form-control" placeholder="Search">
                      <div class="input-group-btn">
                          <button class="btn btn-default" type="submit">
                          <i class="glyphicon glyphicon-search"></i>
                        </button>
                      </div>
                  </div>
                  <div class="tab">
                      <div> 
                      <a href="{!! url('indexAdmin') !!}"> <button class="tablinks active">Dashboard</button><</a>
                    </div>
                      <hr/>
                      <a href="{!! url('OrderManagement') !!}"><button class="tablinks active">Order</button></a>
                      <hr/>
                
                       <button class="dropdown-btn">User 
                          <i class="fa fa-caret-down"></i>
                        </button>
                        <div class="dropdown-container">
                        <a href="{!! url('Trucker') !!}"><button class="tablinks">Trucker </button></a>
                        <hr/>
                        <a href="{!! url('Sender') !!}"><button class="tablinks">Sender </button></a>
                        <hr/>
                        </div>
                      <!-- <button class="dropdown-btn">Statistics 
                          <i class="fa fa-caret-down"></i>
                        </button>
                        <div class="dropdown-container">
                        <a href="{!! url('MonthlyChart') !!}"><button class="tablinks">Monthly </button></a>
                        <hr/>
                        <a href="{!! url('DailyChart') !!}"><button class="tablinks">Daily </button></a>
                        <hr/>
                        </div> -->
                  </div>

              </div>
               <div class="col-sm-10 text-left">     
               <div id="Order" class="tabcontent">
                    <h1>Order Management</h1>
                    <table class="table table-bordered table table-hover">
                    <thead>
                        <tr>
                          <th>Id</th>
                          <th>Name Customer</th>
                          <th>Date</th>
                          <th>Send Form</th>
                          <th>Send to</th>
                          <th>Name</th>
                          <th>Mass</th>
                          <th>Unit</th>
                          <th>Note</th>
                          <th>Car type</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($order as $order)
                        <tr>
                          <td>{!! $order["id"] !!}</td>
                          <td>
                          @foreach($customers as $customer)
                                @if($order["id_cus"] == $customer["id"])
                                 {{$customer["name"]}}
                                 @endif
                             @endforeach
                          </td>
                          <td>{!! $order["date"] !!}</td>
                          <td>{!! $order["total_price"] !!}</td>
                          <td>{!! $order["payment"] !!}</td>
                          <td>{!! $order["note"] !!}</td>
                          <td><a href="{!! url('viewDetail', $order["id"]) !!}"><i class='fas'>&#xf15c;</i> </a></td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                 
              </div>
            
              </div> 
              
             
                
              </div>

          </div>
   
    </body>
    
    <script>
        var dropdown = document.getElementsByClassName("dropdown-btn");
        var i;
        for (i = 0; i < dropdown.length; i++) {
          dropdown[i].addEventListener("click", function() {
          this.classList.toggle("active");
          var dropdownContent = this.nextElementSibling;
          if (dropdownContent.style.display === "block") {
          dropdownContent.style.display = "none";
          } else {
          dropdownContent.style.display = "block";
          }
          });
        }
        </script>
</html>