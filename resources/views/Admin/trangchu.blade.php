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
                      <a href="{!! url('OrderManagement') !!}"><button class="tablinks">Order</button></a>
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
                  <div class="static">
                        <div class="Trucker">
                          <a href=''>Trucker  <h4>count_account</h4></a>
                          
                          <i class="fa fa-user"></i>
                        </div>
                        <hr>
                        <div class="Sender">
                          <a href=''>Sender <h4>100</h4></a>
                          <i class="fa fa-users"></i>
                        </div>
                        <div class="Orders">
                          <a href=''>Orders  <h4>100</h4></a>
                          <i class="fa fa-list-alt"></i>
                        </div>
                  </div>
                  <h1>Laravel 8 Highcharts Example - ItSolutionStuff.com</h1>
                    <div id="container"></div>
            
              </div> 
              
             
                
              </div>

          </div>
   
    </body>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script type="text/javascript">
        var order = <?php echo json_encode($order) ?>;
    
        Highcharts.chart('container', {
            title: {
                text: 'Total Order in Month, 2019'
            },
            subtitle: {
                text: 'GOGO'
            },
            xAxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
            },
            yAxis: {
                title: {
                    text: 'Number of New Users'
                }
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle'
            },
            plotOptions: {
                series: {
                    allowPointSelect: true
                }
            },
            series: [{
                name: 'New Users',
                data: order
            }],
            responsive: {
                rules: [{
                    condition: {
                        maxWidth: 500
                    },
                    chartOptions: {
                        legend: {
                            layout: 'horizontal',
                            align: 'center',
                            verticalAlign: 'bottom'
                        }
                    }
                }]
            }
    });
    </script>
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