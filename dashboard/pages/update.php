<?php
session_start();

require_once "../../config.php";

/****************************************************
$name       = $_POST["name"];
$email      = $_POST["email"];
$password   = $_POST["password"];
$repassword = $_POST["repassword"];
$username   = $_POST["username"];
db.myusers.find()
****************************************************/
$email = $_SESSION["sessemail"];
echo $email."<br />";;

$password   = $_POST["password"];

echo $password."<br />";;

$con = new MongoClient();
if($con){
	$db = $con->$users;
	$selection = $db->$myusers;
	$document = array("email" => $email);
	$result = $selection->findOne($document);
		if($result){
		$success = "You are successully loggedIn";
		$res = $selection->find($document);
			foreach ($res as $doc)
			{
				echo $doc["_id"] ."<br />";
				echo $doc["email"] ."<br />";
				echo $doc["password"] ."<br />";
			}	


      $selection->update(array("password"=>$doc["password"]), 
      array('$set'=>array("password"=>"$password")));
      echo "Document updated successfully";


} 
else{ die("user does not exist , or user / password is incorrect");} 
} 
else{ die("Mongo DB not installed");} 
$con->close();
?>
