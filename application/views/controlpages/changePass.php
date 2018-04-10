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
    <link href="<?=base_url()?>css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?=base_url()?>css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="<?=base_url()?>css/plugins/timeline.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?=base_url()?>css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="<?=base_url()?>css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?=base_url()?>css/font-awesome/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="<?=base_url()?>https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="<?=base_url()?>https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                      <h3>Change Password</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" method="post" action=<?=base_url() . 'confirmPwChange'?>>
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="NewPassword" id=password type="password" onKeyUp="return check()" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="ConfirmPassword" id=confirm_password name="NewPass" type="password" value="">
                                    <input  name="NewPass" type="password" value="Email" hidden="true" type="hidden">
                                </div>

                                <!-- Change this to a button or input when using this as a form -->
                                <input type=submit class="btn btn-lg btn-danger btn-block" id=button onKeyUp="return check()" value=Submit disabled="true"></input>
                                <br>
                                <br>
                                <span class="btn btn-danger center-block" id=message >Please Enter a New Password</span>

                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
      function check() {
        if (document.getElementById('password').value ==
        document.getElementById('confirm_password').value) {
        document.getElementById('message').class = 'btn btn-danger center-block';
        document.getElementById('message').innerHTML = 'Missmatch';
        document.getElementById('button').disabled = false;
      } else {
        document.getElementById('message').class = 'btn btn-primary center-block';
        document.getElementById('message').innerHTML = 'Match';
        document.getElementById('button').disabled = true;
      }
      }
    </script>

    <!-- jQuery Version 1.11.0 -->
    <script src="<?=base_url()?>js/jquery-1.11.0.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?=base_url()?>js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?=base_url()?>js/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?=base_url()?>js/sb-admin-2.js"></script>

</body>

</html>
