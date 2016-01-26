<?php

require_once "../config.php";

class validation
{
    // method email
    public function email($email){
        		 
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
		  $emailErr = "<div class='alert alert-warning'><strong>Alert !</strong> Invalid email format </div>";
		  die($emailErr);
		}
			
    }
	
	// method name
    public function name($vname){
		
		if (!preg_match("/^[a-zA-Z ]*$/",$vname)){
			$nameErr = "<div class='alert alert-warning'><strong>Alert !</strong> Only letters are allowed in name </div>";
			die($nameErr);
		}
				
	}
	// method username
    public function username($vname){
		
		if (!preg_match("/^[a-zA-Z0-9 ]*$/",$vname)){
			$nameErr = "<div class='alert alert-warning'><strong>Alert !</strong> Only letters and numbers allowed in username </div>";
			die($nameErr);
		}
				
	}	
}




$name 			= substr($_POST["name"], 		0, 30);
$email 			= substr($_POST["email"], 		0, 40);
$password 		= substr($_POST["password"], 	0, 16);
$repassword 	= substr($_POST["repassword"], 	0, 16);
$username 		= substr($_POST["username"], 	0, 30);

$arr = array(
				$name, 
				$email, 
				$password, 
				$repassword, 
				$username 
			);

foreach ($arr as $value) {
    
    if ($value=="") {die("name cannot be empty");}   	
}


$valne = new validation();
$valne->name($name);
$valne->email($email);
$valne->username($username);


			$con = new MongoClient();
			if($con){
			
					$db = $con->$users;
					$people = $db->$myusers;
					$qry = array("email" => $email);
					$result = $people->findOne($qry);
					if($result){
					$success = "<div class='alert alert-warning'><strong>Alert !</strong> $email already exists </div>";
					echo $success;
					die();
					} 

					$qry1 = array("username" => $username);
					$result1 = $people->findOne($qry1);
					if($result1){
					$success1 = "<div class='alert alert-warning'><strong>Alert !</strong> $username already exists</div>";
					echo $success1;
					die();
					} 

   					else{ 

						  $m = new MongoClient();
						   //echo "Connection to database successfully<br />";
	
						   // select a database
						   $db = $m->$users;
						   //echo "Database users selected<br />";
						   $collection = $db->$myusers;
						   //echo "Collection selected succsessfully<br />";
	
						   $document = array( 
						      "name"       => "$name", 
						      "email"      => "$email", 
						      "password"   => "$password",
						      "repassword" => "$repassword",
						      "username"   => "$username"
						   );
						   $collection->insert($document);
						   //echo "Document inserted successfully<br />";

						  $c = new MongoClient();
						   //echo "Connection to database successfully<br />";
	
						   // select a database
						   $dbc = $c->$tb_payment;
						   //echo "Database users selected<br />";
						   $collectionc = $dbc->$myusers_tb_payment;
						   //echo "Collection selected succsessfully<br />";
	
						   $documentc = array( 
						      "email"      => "$email", 
						      "balance"   => "0"
						   );
						   $collectionc->insert($documentc);
						   echo "<div class='alert alert-success'><strong>Congrats ! </strong> <strong>$email</strong> has been registered successfully";
						   echo " you may now login  <a href='signin.php'> here </a></div>";

						/****************** SENDING EMAIL *************************/					   
							$mdemail = md5($email);
							$mdemailx = substr($mdemail,   0, 6);

							// multiple recipients
							$to  = $email; // note the comma

							// subject
							$subjectof = 'details '.$username.'';

							// message
							$message = '
							<html>
							<head>
							  <title></title>
							</head>
							<body>

							<p>ref#'.$username.'</p>

							<p>name    : '.$name.'</p>
							<p>email   : '.$email.'</p>
							<p>password : '.$password.'</p>
							

							</body>
							</html>';

							// To send HTML mail, the Content-type header must be set
							$headers  = 'MIME-Version: 1.0' . "\r\n";
							$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

							// Additional headers

							$headers .= 'From: details <noreply@whois-finder.com>' . "\r\n";


							// Mail it
							mail($to, $subjectof, $message, $headers);
						/****************** SENDING EMAIL *************************/	


						} 
					} 
                        
                       else{ die("Mongo DB not installed");} 
?>
