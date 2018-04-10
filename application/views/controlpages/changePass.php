<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Karter Dashboard</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="css/plugins/timeline.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="css/font-awesome/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Sign In</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" method="post" action=<?=base_url() . 'confirmPwChange'?>>
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="NewPassword" id=password type="text" onkeyup=check() autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="ConfirmPassword" id=confirm_password name="NewPass" type="password" value="">
                                </div>

                                <!-- Change this to a button or input when using this as a form -->
                                <input type=submit class="btn btn-lg btn-success btn-block" id=button onkeyup=check() value=Login></input>

                                <span class="btn btn-danger center-block" id=message >Please Enter a New Password</span>

                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
      public function check () {
        if (document.getElementById('password').value ==
        document.getElementById('confirm_password').value) {
        document.getElementById('message').class = 'btn btn-success center-block';
        document.getElementById('message').innerHTML = 'Matching';
        document.getElementById('button').disabled = true;
      } else {
        document.getElementById('message').class = 'btn btn-danger center-block';
        document.getElementById('message').innerHTML = 'Matching';
        document.getElementById('button').disabled = false;
      }
      }
    </script>

    <!-- jQuery Version 1.11.0 -->
    <script src="js/jquery-1.11.0.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="js/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="js/sb-admin-2.js"></script>

</body>

</html>