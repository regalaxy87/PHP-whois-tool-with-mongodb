<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
   <?php require_once "../../config.php"; ?>

    <title><?php echo $title;?> dashboard</title>

    <!-- Bootstrap Core CSS -->
    <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

     <link href="css/heroic-features.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>


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
                <a class="navbar-brand" href="admin.php"><?php echo $title;?> adminstration</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

            </div>
            <!-- /.navbar-collapse -->
        </div>
    </nav>

<!-- Page Content -->
<div class="container">
     <!-- Jumbotron Header -->
     <div class="jumbotron hero-spacer">

    	<div class="row">
    		<div class="col-md-4">    		
				<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
				<!-- css350 -->
				<ins class="adsbygoogle"
				     style="display:inline-block;width:300px;height:250px"
				     data-ad-client="ca-pub-6881171206018736"
				     data-ad-slot="9680672004"></ins>
				
				<script>(adsbygoogle = window.adsbygoogle || []).push({});</script>		
			</div>

				<div class="col-md-8">
					<form class="form-horizontal" role="form" method="post" action="admin/main.php">

					    <div class="form-group">
					        <label for="email" class="col-sm-2 control-label">Email</label>
					        <div class="col-sm-10">
					            <input type="email" class="form-control" id="email" name="email" placeholder="example@domain.com" value="" required>
					        </div>
					    </div>
					    <div class="form-group">
					        <label for="password" class="col-sm-2 control-label">Password</label>
					        <div class="col-sm-10">
					            <input type="password" class="form-control" id="password" name="password" placeholder="Type password" value="" required>
					        </div>
					    </div>

					    <div class="form-group">
					        <div class="col-sm-10 col-sm-offset-2">
					            <input id="submit" name="submit" type="submit" value="Login to administration" class="btn btn-primary">
					        </div>
					    </div>
					    <div class="form-group">
					        <div class="col-sm-10 col-sm-offset-2">
					            
					        </div>
					    </div>
					</form>
		        </div>
		</div>	
	</div>	        

</div>

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
