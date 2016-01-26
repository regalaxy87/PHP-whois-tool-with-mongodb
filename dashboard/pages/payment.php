<?php
session_start();

require_once "../../config.php";

$email = $_SESSION["sessemail"];

echo $email;

$balance   = $_POST["balance"];

$con = new MongoClient();
if($con){
	$db = $con->$tb_payment;
	$selection = $db->$myusers_tb_payment;
	$document = array("email" => $email);
	$result = $selection->findOne($document);
		if($result){
		$success = "You are successully loggedIn";
		$res = $selection->find($document);
			foreach ($res as $doc)
			{
				echo $doc["_id"] ."<br />";
				echo $doc["email"] ."<br />";
				echo $doc["balance"] ."<br />";
			}	


       $selection->update(array("balance"=>$doc["balance"]), 
       array('$set'=>array("balance"=>"$balance")));
       echo "Document updated successfully";


} 
else{ die("user does not exist , or user / password is incorrect");} 
} 
else{ die("Mongo DB not installed");} 
$con->close();
?>
