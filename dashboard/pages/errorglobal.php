<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Notification page</title>

    <!-- Bootstrap Core CSS -->
    <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

<?php

class error {

public function error_success()


{

	echo '<div class="alert alert-success">
  <strong>Success!</strong> Indicates a successful or positive action.
</div>';
}

public function error_info()


{

	echo '<div class="alert alert-info">
  <strong>Info!</strong> Indicates a neutral informative change or action.
</div>';
}


public function error_warning()


{

	echo '<div class="alert alert-warning">
  <strong>Warning!</strong> Indicates a warning that might need attention.
</div>';
}



public function error_danger($msg)


{

echo '<div class="alert alert-danger"><strong>Danger ! </strong> '.$msg.' .</div>';
}





}














?>

</body>
</html>
