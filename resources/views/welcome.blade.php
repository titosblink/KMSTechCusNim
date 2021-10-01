<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MSC</title>
    <link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
    <link type="text/css" href="css/theme.css" rel="stylesheet">
    <link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
    <link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600' rel='stylesheet'>
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css"> -->
</head>
<body>

    <div class="navbar navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container">
                <a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-inverse-collapse">
                    <i class="icon-reorder shaded"></i>
                </a>

                <a class="brand" href="index.html">
                  <!--  MSC Mediterranean Shipping Company -->
                  <img src="images/logo.png">
                </a>

                <div class="nav-collapse collapse navbar-inverse-collapse">
                
                    <ul class="nav pull-right">
 
                        <li><a href="#">
                           <h3>{{ date('D d M Y' )}}</h3>
                        </a></li>
                    </ul>
                </div><!-- /.nav-collapse -->
            </div>
        </div><!-- /navbar-inner -->
    </div><!-- /navbar -->

    <div class="wrapper">
        <div class="container">
            <div class="row">
                <div class="module module-login span4 offset4">
                    <form method="post" action="adminlogin" class="form-vertical">
                        @csrf
                        <div class="module-head">
                            <h3>LOGIN</h3>
                        </div>
                        <div class="module-body">

                            <div class="control-group">
                                <div class="controls row-fluid">
                                    <input class="span12" type="text" id="unameBTN" placeholder="Username" name="username">
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="controls row-fluid">
                                    <input class="span12" type="password" id="pwordBTN" placeholder="Password" name="password">
                                </div>
                            </div>
                        </div>
                        <div class="module-foot">
                            <div class="control-group">
                                <div class="controls clearfix">
                                    <button type="submit" id="submitBtn" class="btn btn-primaryBlack pull-right">Login</button>
                                    <label class="checkbox">
                                        <input type="checkbox"> Remember me
                                    </label>
                                </div>
                            </div>
                        </div>
                    </form>
                    @if(Session::has('error'))
                        <p class="alert alert-danger">{{ Session::get('error') }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div><!--/.wrapper-->

    <div class="footer">
        <div class="container">
            <b class="copyright">&copy; {{ date('Y') }} MSC -   All rights reserved | Powered by KMS-Tech Solutions </b>
        </div>
    </div>
    <script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
    <script src="scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
    <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
</body>

 <script>
    $(document).ready(function(){  

      var checkField;

      //checking the length of the value of message and assigning to a variable(checkField) on load
      checkField = $("input#unameBTN").val().length && $("input#pwordBTN").val().length;  

      var enableDisableButton = function(){         
        if(checkField > 0){
          $('#submitBtn').removeAttr("disabled");
        } 
        else {
          $('#submitBtn').attr("disabled","disabled");
        }
      }        

      //calling enableDisableButton() function on load
      enableDisableButton();            

      $('input#unameBTN').keyup(function(){ 
        //checking the length of the value of message and assigning to the variable(checkField) on keyup
        checkField = $("input#unameBTN").val().length && $("input#pwordBTN").val().length;
        //calling enableDisableButton() function on keyup
        enableDisableButton();
      });
       $('input#pwordBTN').keyup(function(){ 
        //checking the length of the value of message and assigning to the variable(checkField) on keyup
        checkField = $("input#pwordBTN").val().length && $("input#unameBTN").val().length;
        //calling enableDisableButton() function on keyup
        enableDisableButton();
      });
    });
    </script>