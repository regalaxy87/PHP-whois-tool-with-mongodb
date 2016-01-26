<?php
session_start();

require_once "../../config.php";

if ($_SESSION["sessemail"]) {


?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo $title;?> Dashbaord Add URL</title>

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
                <a class="navbar-brand" href="index.php"><?php echo $title;?> Dashbaord Add URL</a>
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
                        <h1 class="page-header"><?php echo $_SESSION["sessemail"]; ?></h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>





                <!-- /.row -->
<!-- -->
<div id="tohide">

</div>
<!-- -->

			 <form method="post" class="myform" >
					  <div class="form-group">
					    <label for="domain">Add your URL (website) below</label>
						<input type="text" name="domain" class="form-control" id="domain" placeholder="example.com" required>

					  </div>
					  <div class="form-group">
					    <label for="exampleInputPassword1">7 Days Premium Listing</label>
					    <input type="text" name="premium"  class="form-control" placeholder="7 Days Premium Listing" disabled>
					  </div>

						<input type="submit" name="submit"  class="btn btn-success" value="Add URL Now">
			</form>

            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
    <!-- jQuery -->
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>




<script> 
            
$(document).ready(function(){
                    $(".myform").submit(function(){


                        var domain = $('#domain').val();
                        if (!domain)
                        {

                            alert('please enter domain');
                        }


                

                        else
                        {
                        var $form = $(this);
                        var $inputs = $form.find("input, select, button, textarea");
                        var serializedData = $form.serialize();
                        $inputs.prop("disabled", true);   
    
                                    $.ajax({
                                    type: "POST",
                                    url: "queueclass.php",
                                    data: serializedData,
                                    cache: false,
                                    success: function(html){
                                    //alert(html);
                                    $("#tohide").html(html);
                                    }
                                    });
                        }
                    return false;
                    });
});

</script>
    <!-- Bootstrap Core JavaScript -->
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

</body>

</html>

<?php
}
else{ 
header("Location: http://www.getwhois.pw/signin.php");
die();
}
?>
