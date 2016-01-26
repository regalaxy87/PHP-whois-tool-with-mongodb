<?php

require_once "../config.php";

/****************************************************
$name       = $_POST["name"];
$email      = $_POST["email"];
$password   = $_POST["password"];
$repassword = $_POST["repassword"];
$username   = $_POST["username"];
db.myusers.find()
****************************************************/
$email = $_POST["email"];
if ($email=="") {die(" email cannot be empty");}

$password = $_POST["password"];
if ($password=="") {die("password cannot be empty");}
$con = new MongoClient();
if($con){
	$db = $con->$users;
	$selection = $db->$myusers;
	$document = array("email" => $email,"password" => $password,);
	$result = $selection->findOne($document);
		if($result){
		$success = "You are successully loggedIn";
		$res = $selection->find($document);
			foreach ($res as $doc)
			{
				echo $doc["_id"] ."<br />";
				echo $doc["name"] ."<br />";
				echo $doc["username"] ."<br />";
			}	
} 
else{ die("user does not exi44st , or user / password is incorrect");} 
} 
else{ die("Mongo DB not installed");} 
$con->close();
?>
