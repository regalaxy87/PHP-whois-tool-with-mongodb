<?php require_once "config.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="whois lookup and domain name search">
    <meta name="author" content="sami bekkari">
<link rel="shortcut icon" href="/favicon.ico" />

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/heroic-features.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-70743372-1', 'auto');
  ga('send', 'pageview');

</script>
</head>

<body>

    <div class="container">

<?php

if(!empty($_SERVER['HTTP_USER_AGENT']) and preg_match('~(bot|crawl|spider)~i', $_SERVER['HTTP_USER_AGENT'])){

    die("bots");
}


$dmn = $_GET['domain'];
//echo $dmn;


$ip = $_SERVER['REMOTE_ADDR'];


echo "<h1 class='jumbotron hero-spacer' style='margin-top:-45px'>  Thank you for visiting $dmn </h1>";


		$conx = new MongoClient();
		$db = $conx->$tb_clicks;
		$selection = $db->$myusers_tb_clicks;
		$document = array("domain" => $dmn,"ip" => $ip);
		$resultx = $selection->findOne($document);

		if($resultx){

		$res = $selection->find($document);
			foreach ($res as $doc)
			{
				//echo $doc["_id"] ."<br />";
				//echo $doc["domain"] ."<br />";
				//echo $doc["ip"] ."<br />";
				//echo $doc["clicks"] ."<br />";

			}

		}


		else{

					$conx = new MongoClient();
					$db = $conx->$tb_addurl;
					$selection = $db->$myusers_tb_addurl;
					$document = array("domain" => $dmn,"status" => "1");
					$result = $selection->findOne($document);


					if($result){
					$res = $selection->find($document);
						foreach ($res as $doc)
						{
							//echo $doc["_id"] ."<br />";
							//echo $doc["domain"] ."<br />";

						}

										$con_mongo 	= new MongoClient();
										$db 		= $con_mongo->$tb_clicks;
										$selection 	= $db->$myusers_tb_clicks;
										$domain 		= $doc["domain"];
										$email 		= $doc["email"];
										$ip 			= $ip;
										$documents 		= array( 
										      "domain"     		=> "$domain",
										      "email"     	 	=>  "$email",  
										      "ip"     	 		=>  "$ip", 
										      "clicks"     		=> "1"	
										   );

										$selection->insert($documents);
					}
					else{

						die('domain not found');
					}


		}

					$conx = new MongoClient();
					$db = $conx->$tb_clicks;
					$selection = $db->$myusers_tb_clicks;
					$document = array("domain" => $dmn);
					$result = $selection->findOne($document);


					if($result){
					$res = $selection->find($document);
					//echo ($res->count(true));

					}
					else{

						//echo"0";
					}


?>
</div>
</body>
</html>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"> 
<html> 
<head> 
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1"> 
<title><?php  echo $dmn." viewing..."; ?></title> 
</head> 
<style type="text/css"> 
#test iframe { 
width: 100%; 
height: 100%; 
border: none; } 

#test { 
width: 100%; 
height: 3530px; 
padding: 0; 
overflow: hidden; } 

</style> 

<body style="margin:0;"> 
<div id="test"> 

<?php
echo '<iframe src="http://'.$dmn.'" scrolling="no"></iframe>';

?>




</div> 
</body> 
</html>
