<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Shop Homepage - Start Bootstrap Template</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/shop-homepage.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

  </head>

  <body ng-app="mainApp">

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Start Bootstrap</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" ng-controller="MenuController">
          <ul class="nav navbar-nav">
            <li ng-repeat="menu in menus">
              <a href="{{menu.Url}}">{{menu.Name}}</a>
            </li>
            
          </ul>
        </div>
        <!-- /.navbar-collapse -->
      </div>
      <!-- /.container -->
    </nav>

    <!-- Page Content -->
    <div class="container" ng-controller="MainController">

      
      <div class="row">

        <div class="col-md-3">
          <p class="lead">Shop Isle</p>
          <div class="list-group">
            <button class="list-group-item form-control" ng-click="read('1')">1</button>
            <button class="list-group-item form-control" ng-click="read('2')">2</button>
            <button class="list-group-item form-control" ng-click="read('3')">3</button>
            <button class="list-group-item form-control" ng-click="read('4')">4</button>
          </div>
        </div>

        <div class="col-md-9">

          <div class="row">

            <div class="col-md-12">
              <form class="form form-horizontal" role="form" ng-submit="submit()">
                <div class="form-group">
                  <div class="col-sm-2"><label for="inputfield1" class="col-sm-2 control-label">Items:</label></div>
                  <div class="col-sm-10">
                    <div class="input-group">
                      <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                      <input type="text" class="form-control" id="inputfield1" placeholder="Input 1" ng-model="item" required> </div>
                      <input type="submit" value="" class="hidden"/>
                  </div>
                </div>
                <div class="form-group">
                  <shoppinglist model="List" name="Shopping List" suffix="danger"></shoppinglist>
                  
                </div>
                <div class="form-group">
                  <shoppinglist model="List" name="Shopping List" suffix="success"></shoppinglist>
                  
                </div>

              </form>

            </div>

          </div>

        </div>

      </div>

    </div>
    <!-- /.container -->

    <div class="container">

      <hr>

      <!-- Footer -->
      <footer>
        <div class="row">
          <div class="col-lg-12">
            <p>Copyright &copy; Your Website 2014</p>
          </div>
        </div>
      </footer>

    </div>
    <!-- /.container -->
    <script src="js/angular.min.js" type="text/javascript"></script>
    <script src="js/main.js" type="text/javascript"></script>
  </body>

</html>
