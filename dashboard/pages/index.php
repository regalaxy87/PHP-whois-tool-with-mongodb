<?php
session_start();

require_once "../../config.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	        $email 		= $_POST["email"];		
            $password 	    = $_POST["password"];
			$con = new MongoClient();

			if($con){

				$db = $con->$users;
				$selection = $db->$myusers;
				$document = array("email" => $email,"password" => $password);
				$result = $selection->findOne($document);

        			if($result){
						
        				$_SESSION["sessemail"] = $email;        								
        			} 
                    else{ 

                    die("<div class='alert alert-warning'><strong>Alert !</strong> user does notss exist , or user / password is incorrect </div>");

                    } 
		
			} 

            else{ die("Mongo DB not installed");} 

/******************************************************************************/

$today = date('d-m-Y');

$con = new MongoClient();
if($con){
	$db = $con->$tb_addurl;
	$selection = $db->$myusers_tb_addurl;
	$document = array("email" => $_SESSION["sessemail"]);
	$result = $selection->findOne($document);
		if($result){
		$success = "You are successully loggedIn";
		$res = $selection->find($document);
			foreach ($res as $doc)
			{

                if ( $doc["fromdate"] == $today ){

				//echo "<b> YES </b> " .$doc["fromdate"] ."<br />";

	   			$selection->update(array("_id"=>$doc["_id"], "status"=>$doc["status"]), 
      				array('$set'=>array("status" => 0 )));
      				//echo "Document updated successfully <br />";
		
				}

				else {
				//echo "<b> NO </b> " .$doc["fromdate"] ."<br />";

				}

				//echo $doc["_id"] ."<br />";
				//echo $doc["domain"] ."<br />";
				//echo $doc["email"] ."<br />";
				//echo $doc["todate"] ."<br />";
				//echo $doc["status"] ."<br />";

			}	




} 


else{/* die("user does not exist , or user / password is incorrect");*/} 
} 
else{/* die("Mongo DB not installed");*/} 
$con->close();


/******************************************************************************/
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo $title;?> Dashbaord</title>

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

<script>
$(document).ready(function() {
	alert('1');
});
</script>

</head>
<body>
    <div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php"><?php echo $title;?> Dashbaord</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">

               
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="index.php"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>

                        <li>
                            <a href="addbalance.php"><i class="fa fa-money fa-fw"></i> Add Balance</a>
                        </li>

                        <li>
                            <a href="addurl.php"><i class="fa fa-plus fa-fw"></i> Add URL</a>
                        </li>
                        <li>
                            <a href="mywebsite.php"><i class="fa fa-edit fa-fw"></i> My Websites</a>
                        </li>
                        <li>
                            <a href="clicks.php"><i class="fa fa-tasks fa-fw"></i> Clicks</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-support fa-fw"></i> Support</a>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
<?php
		$con = new MongoClient();
		if($con){
			$db = $con->$users;
			$selection = $db->$myusers;
			$document = array("email" => $_SESSION["sessemail"]);
			$result = $selection->findOne($document);
				if($result){
				
				$res = $selection->find($document);
					foreach ($res as $doc)
					{
						echo '<h1 class="page-header">Hello '.$doc["name"].'</h1>';
					}
?>



                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-dollar fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">


<?php
$con = new MongoClient();
if($con){
	$db = $con->$tb_payment;
	$selection = $db->$myusers_tb_payment;
	$document = array("email" => $_SESSION["sessemail"]);
	$result = $selection->findOne($document);
		if($result){
		$success = "You are successully loggedIn";
		$res = $selection->find($document);



			foreach ($res as $doc)
			{

				echo "<div class='huge'>".$doc["balance"]."</div>";

			}	

	} 

} 

?>


					<div>Current Balance</div>
                                </div>
                            </div>
                        </div>
                        <a href="addbalance.php">
                            <div class="panel-footer">
                                <span class="pull-left">Add Balance</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-tasks fa-5x"></i>
                                </div>
<?php
                    $conx = new MongoClient();
                    $db = $conx->$tb_clicks;
                    $selection = $db->$myusers_tb_clicks;
                    $document = array("email" => $_SESSION["sessemail"]);
                    $result = $selection->findOne($document);


                    if($result){
                    $res = $selection->find($document);
                    //echo ($res->count(true));


                                echo'<div class="col-xs-9 text-right">
                                    <div class="huge">'.$res->count(true).'</div>
                                    <div>Clicks</div>
                                </div>';

                    }
                    else{
                                echo'<div class="col-xs-9 text-right">
                                    <div class="huge">0</div>
                                    <div>Clicks</div>
                                </div>';
                    }

?>

                            </div>
                        </div>
                        <a href="clicks.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-play fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">1</div>
                                    <div>Queue</div>
                                </div>
                            </div>
                        </div>
                        <a href="mywebsite.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-support fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">N/A</div>
                                    <div>Support Tickets!</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">Comming Soon</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                              <h1>Profile information</h1>
					<form id="updatepass"> 
					  <div class="form-group">
					    <label for="exampleInputEmail1">Email address</label>

<!-- -->
<div id="tohide">
<div class="alert alert-success">
  <strong>Password has been update !</strong> Please make sure to remember your password <a href="../../signin.php"> Sign in here </a>.
</div>
</div>
<!-- -->


<?php

	echo $doc["email"];
	echo '<input type="hidden" name="email" value="'.$doc["email"].'" class="form-control" id="exampleInputEmail1" placeholder="'.$doc["email"].'" >';
  
					
			}
}
?>
					  </div>
					  <div class="form-group">
					    <label for="exampleInputPassword1">Password</label>
					    <input type="password" name="password"  class="form-control" id="exampleInputPassword1" placeholder="Password" required>
					  </div>

					  <div class="form-group">
					    <label for="exampleInputPassword1">Password Again</label>
					    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Confrim Password" required>
					  </div>
						<input type="submit" name="submit" class="btn btn-primary" value="Update">
					</form>
             </div>
                 </div>
		<div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header"></h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>



<script>
$( document ).ready(function() {
var request;



 $("#tohide").hide();



// Bind to the submit event of our form
$("#updatepass").submit(function(event){





    // Abort any pending request
    if (request) {
        request.abort();
    }
    // setup some local variables
    var $form = $(this);

    // Let's select and cache all the fields
    var $inputs = $form.find("input, select, button, textarea");

    // Serialize the data in the form
    var serializedData = $form.serialize();

    // Let's disable the inputs for the duration of the Ajax request.
    // Note: we disable elements AFTER the form data has been serialized.
    // Disabled form elements will not be serialized.
    $inputs.prop("disabled", true);

    // Fire off the request to /form.php
    request = $.ajax({
        url: "update.php",
        type: "post",
        data: serializedData
    });

    // Callback handler that will be called on success
    request.done(function (response, textStatus, jqXHR){
        // Log a message to the console

 $("#tohide").show();

    });

    // Callback handler that will be called on failure
    request.fail(function (jqXHR, textStatus, errorThrown){
        // Log the error to the console
        console.error(
            "The following error occurred: "+
            textStatus, errorThrown
        );
    });

    // Callback handler that will be called regardless
    // if the request failed or succeeded
    request.always(function () {
        // Reenable the inputs
        $inputs.prop("disabled", false);
    });

    // Prevent default posting of form
    event.preventDefault();
});
});
</script>

</body>
</html>




<?php
return;
}
?>

<?php

if ($_SESSION["sessemail"]) {

		//echo $_SESSION["sessemail"];
                

		
			$con = new MongoClient();

					if($con){
						$db = $con->$users;
						$selection = $db->$myusers;
						$document = array("email" => $_SESSION["sessemail"]);
						$result = $selection->findOne($document);
							if($result){
								//echo "<h1> SESSION : $email</h1>";
								$con->close();	
							} else{ /*die("user does not exist , or user / password is incorrect");*/} 
		
						 } else{ die("Mongo DB not installed");} 
			   




/******************************************************************************/

$today = date('d-m-Y');

$con = new MongoClient();
if($con){
	$db = $con->$tb_addurl;
	$selection = $db->$myusers_tb_addurl;
	$document = array("email" => $_SESSION["sessemail"]);
	$result = $selection->findOne($document);
		if($result){
		$success = "You are successully loggedIn";
		$res = $selection->find($document);
			foreach ($res as $doc)
			{

                               if ( $doc["fromdate"] == $today ){

				//echo "<b> YES </b> " .$doc["fromdate"] ."<br />";

	   			$selection->update(array("_id"=>$doc["_id"], "status"=>$doc["status"]), 
      				array('$set'=>array("status" => 0 )));
      				//echo "Document updated successfully <br />";
		
				}

				else {
				//echo "<b> NO </b> " .$doc["fromdate"] ."<br />";

				}

				//echo $doc["_id"] ."<br />";
				//echo $doc["domain"] ."<br />";
				//echo $doc["email"] ."<br />";
				//echo $doc["todate"] ."<br />";
				//echo $doc["status"] ."<br />";
			}
} 
else{/* die("user does not exist , or user / password is incorrect");*/} 
} 
else{/* die("Mongo DB not installed");*/} 
$con->close();

/******************************************************************************/

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo $title;?> Dashbaord</title>

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
    <div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php"><?php echo $title;?> Dashbaord</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">

               
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">

                        <li>
                            <a href="index.php"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>

                        <li>
                            <a href="addbalance.php"><i class="fa fa-money fa-fw"></i> Add Balance</a>
                        </li>

                        <li>
                            <a href="addurl.php"><i class="fa fa-plus fa-fw"></i> Add URL</a>
                        </li>
                        <li>
                            <a href="mywebsite.php"><i class="fa fa-edit fa-fw"></i> My Websites</a>
                        </li>
                        <li>
                            <a href="clicks.php"><i class="fa fa-tasks fa-fw"></i> Clicks</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-support fa-fw"></i> Support</a>
                        </li>

                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
<?php
		$con = new MongoClient();
		if($con){
			$db = $con->$users;
			$selection = $db->$myusers;
			$document = array("email" => $_SESSION["sessemail"]);
			$result = $selection->findOne($document);
				if($result){
				
				$res = $selection->find($document);
					foreach ($res as $doc)
					{
						echo '<h1 class="page-header">Hello '.$doc["name"].'</h1>';
					}
?>



                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-dollar fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">


<?php
$con = new MongoClient();
if($con){
	$db = $con->$tb_payment;
	$selection = $db->$myusers_tb_payment;
	$document = array("email" => $_SESSION["sessemail"]);
	$result = $selection->findOne($document);
		if($result){
		$success = "You are successully loggedIn";
		$res = $selection->find($document);



			foreach ($res as $doc)
			{

				echo "<div class='huge'>".$doc["balance"]."</div>";

			}	

	} 

} 

?>

					<div>Current Balance</div>
                                </div>
                            </div>
                        </div>
                        <a href="addbalance.php">
                            <div class="panel-footer">
                                <span class="pull-left">Add Balance</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-tasks fa-5x"></i>
                                </div>

<?php
                    $conx = new MongoClient();
                    $db = $conx->$tb_clicks;
                    $selection = $db->$myusers_tb_clicks;
                    $document = array("email" => $_SESSION["sessemail"]);
                    $result = $selection->findOne($document);


                    if($result){
                    $res = $selection->find($document);
                    //echo ($res->count(true));


                                echo'<div class="col-xs-9 text-right">
                                    <div class="huge">'.$res->count(true).'</div>
                                    <div>Clicks</div>
                                </div>';

                    }
                    else{
                                echo'<div class="col-xs-9 text-right">
                                    <div class="huge">0</div>
                                    <div>Clicks</div>
                                </div>';
                    }

?>

                            </div>
                        </div>
                        <a href="clicks.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-play fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">1</div>
                                    <div>Queue</div>
                                </div>
                            </div>
                        </div>
                        <a href="mywebsite.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-support fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">N/A</div>
                                    <div>Support Tickets!</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">Comming Soom</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                              <h1>Profile information</h1>
					<form id="updatepass"> 
					  <div class="form-group">
					    <label for="exampleInputEmail1">Email address</label>

<?php
					
	echo $doc["email"];
	echo '<input type="hidden" name="email" value="'.$doc["email"].'" class="form-control" id="exampleInputEmail1" placeholder="'.$doc["email"].'" >';
	  
					
			}
}
?>
					  </div>

<!-- -->
<div id="tohide">
<div class="alert alert-success">
  <strong>Password has been update !</strong> Please make sure to remember your password <a href="../../signin.php"> Sign in here </a>.
</div>
</div>
<!-- -->


					  <div class="form-group">
					    <label for="exampleInputPassword1">Password</label>
					    <input type="password" name="password"  class="form-control" id="exampleInputPassword1" placeholder="Password">
					  </div>

					  <div class="form-group">
					    <label for="exampleInputPassword1">Password Again</label>
					    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Confrim Password">
					  </div>
						<input type="submit" name="submit" class="btn btn-primary" value="Update">
					</form>
             </div>
                 </div>
		<div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header"></h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

<script>
$( document ).ready(function() {
var request;



 $("#tohide").hide();



// Bind to the submit event of our form
$("#updatepass").submit(function(event){





    // Abort any pending request
    if (request) {
        request.abort();
    }
    // setup some local variables
    var $form = $(this);

    // Let's select and cache all the fields
    var $inputs = $form.find("input, select, button, textarea");

    // Serialize the data in the form
    var serializedData = $form.serialize();

    // Let's disable the inputs for the duration of the Ajax request.
    // Note: we disable elements AFTER the form data has been serialized.
    // Disabled form elements will not be serialized.
    $inputs.prop("disabled", true);

    // Fire off the request to /form.php
    request = $.ajax({
        url: "update.php",
        type: "post",
        data: serializedData
    });

    // Callback handler that will be called on success
    request.done(function (response, textStatus, jqXHR){
        // Log a message to the console

 $("#tohide").show();

    });

    // Callback handler that will be called on failure
    request.fail(function (jqXHR, textStatus, errorThrown){
        // Log the error to the console
        console.error(
            "The following error occurred: "+
            textStatus, errorThrown
        );
    });

    // Callback handler that will be called regardless
    // if the request failed or succeeded
    request.always(function () {
        // Reenable the inputs
        $inputs.prop("disabled", false);
    });

    // Prevent default posting of form
    event.preventDefault();
});
});
</script>

</body>
</html>

<?php
}
else{

header("Location: http://www.getwhois.pw/signin.php");
die();

}
?>


