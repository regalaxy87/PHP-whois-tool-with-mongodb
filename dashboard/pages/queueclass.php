<?php

$domain = $_POST['domain'];

ValidateDomain($domain);

function ValidateDomain($domain) {
    if(!preg_match("/^([-a-z0-9]{2,100})\.([a-z\.]{2,8})$/i", $domain)) {
		echo '<div class="alert alert-success">';
		die("<strong>Domain invalid !</strong> Please use domain name without slash or http: (example : mydomain.com) ");
		echo '</div>';
    }
    return $domain;
}

?>


<?php
session_start();

require_once "../../config.php";


date_default_timezone_set("America/New_York");

$con = new MongoClient();

if ($_SESSION["sessemail"]) {


					if($con){
						
						$db = $con->$users;
						$selection = $db->$myusers;
						$document = array("email" => $_SESSION["sessemail"]);
						$result = $selection->findOne($document);
							if($result){
								//echo "<h1> SESSION EMAIL : $email</h1>";
								//echo "<h1> SESSION PASS  : $password</h1>";
								
							} else{ die("user does not exist , or user / password is incorrect");} 
		
						 } else{ die("Mongo DB not installed");} 


}

else {


	die ("no session please login");
}


class database {


	public function con_db_findall($database,$table){


		$con_mongo 	= new MongoClient();
		$db 		= $con_mongo->$database;
		$selection 	= $db->$table;
		$res 		= $selection->find();
		$res->sort(array("_id" => 1)); 
   		//$res->limit(1);
   		$email = $_SESSION["sessemail"];
		foreach ($res as $doc){
		//echo "".$doc["email"]." - start_date : ".$doc["start_date"]."- end_date : ".$doc["end_date"]."- status : ".$doc["status"]."<br />";
		}
		require "../../config.php";	
			$dbaddurl		= $con_mongo->$tb_addurl;
			$selectionaddurl 	= $dbaddurl->$myusers_tb_addurl;
			$documentaddurl 	= array("end_date" => $doc["end_date"]);
			$resultaddurl 		= $selectionaddurl->findOne($documentaddurl);

		$res = $selectionaddurl->find($documentaddurl);
			foreach ($res as $doc){
				//echo "<div>".$doc["_id"]." ".$doc["email"]." ".$doc["domain"]." ".$doc["end_date"]."</div>";
            }	
           	   $counting = $res->count(true);
		   //echo  $counting;
		   $today = date('d-m-Y');

			$date1 = date_create($today);
			$date2 = date_create($doc["end_date"]);

				if ( $date1 > $date2) {

					//echo "yes today is $today and it is big than ".$doc["end_date"];
					$selection->drop();
					//echo "<br />";	
					$email = $_SESSION["sessemail"];					
					$con_mongo 		= new MongoClient();
					$db 			= $con_mongo->$database;
					$selection 		= $db->$table;
					$t1 = $doc["balance"];
					$t2 = 2;
					$balance = $t1-$t2;
					//echo "<h1>".$balance."</h1>";
					$domain 		= $_POST["domain"];
					$d = new DateTime($today);
					//echo "found<br />";
					$d->modify( '+7 day' );
					$today 			= $today;
					$sevendays 		= $d->format('d-m-Y');
					$toplay 		= $today;
					$documents 		= array( 
					      "domain"     		=> "$domain", 
					      "email"     	 	=> "$email", 
					      "start_date"  	=> "$today", 
					      "end_date"     	=> "$sevendays", 
					      "toplay"     		=> "$toplay",
					      "clicks"     		=> "0", 
					      "status"     		=> "1", 
					      "balance"    		=> "$balance"
					   );
					$selection->insert($documents);	
							echo '<div class="alert alert-success">';
							echo  "<strong>Website added successfully !</strong> Please check <a href='mywebsite.php'>  here </a>.";
							echo '</div>';

				}
				elseif ($counting >= 4) {
					echo "<br />";	
					$email = $_SESSION["sessemail"];					
					$con_mongo 		= new MongoClient();
					$db 			= $con_mongo->$database;
					$selection 		= $db->$table;
					$t1 = $doc["balance"];
					$t2 = 2;
					$balance = $t1-$t2;
					//echo "<h1>".$balance."</h1>";
					$domain 		= $_POST["domain"];
					$d = new DateTime($doc["end_date"]);
					//echo "found<br />";
					$d->modify( '+7 day' );
					$today 			= $doc["end_date"];
					$sevendays 		= $d->format('d-m-Y');
					$toplay 		= $today;
					$documents 		= array( 
					      "domain"     		=> "$domain", 
					      "email"     	 	=> "$email", 
					      "start_date"  		=> "$today", 
					      "end_date"     		=> "$sevendays", 
					      "toplay"     		=> "$toplay",
					      "clicks"     		=> "0", 
					      "status"     		=> "1", 
					      "balance"    		=> "$balance"
					   );
					$selection->insert($documents);	
							echo '<div class="alert alert-success">';
							echo  "<strong>Website added successfully !</strong> Please check <a href='mywebsite.php'>  here </a>.";
							echo '</div>';					
				}
				else{
							$con_mongo 	= new MongoClient();
							$db 		= $con_mongo->$database;
							$selection 	= $db->$table;
							$res 		= $selection->find();
							$res->sort(array("_id" => -1));
					   		$res->limit(1);
							foreach ($res as $doc){
			//echo "<h1>".$doc["email"]." - start_date : ".$doc["start_date"]."- end_date : ".$doc["end_date"]."- status : ".$doc["status"]."</h1>";
							}
                            $email = $_SESSION["sessemail"];
							$con_mongo 		= new MongoClient();
							$db 			= $con_mongo->$database;
							$selection 		= $db->$table;
							//$balance 		= $doc["balance"];
							$t1 = $doc["balance"];
							$t2 = 2;
							$balance = $t1-$t2;
							//echo "<h1>".$balance."</h1>";
					 
							$domain 		= $_POST["domain"];
							$today 			= $doc["start_date"];
							$sevendays 		= $doc["end_date"];
							$toplay 		= $today;
							$documents 		= array( 
							      "domain"     		=> "$domain", 
							      "email"     	 	=>  "$email", 
							      "start_date"  	=> "$today", 
							      "end_date"     	=> "$sevendays", 
							      "toplay"     		=> "$toplay",
							      "clicks"     		=> "0", 
							      "status"     		=> "1", 
							      "balance"    		=> "$balance"
							   );
							$selection->insert($documents);

							echo '<div class="alert alert-success">';
							echo  "<strong>Website added successfully !</strong> Please check <a href='mywebsite.php'>  here </a>.";
							echo '</div>';

				}


	}
		public function con_db_findone($database,$table,$email){
		
		$email 				= $_SESSION["sessemail"];

		$con_mongo			= new MongoClient();
		$db 				= $con_mongo->$database;
		$selection 			= $db->$table;
		$document 			= array("email" => $email); //"_id" => "_id",
		$result 			= $selection->findOne($document);
		$output      			= end($result);
		//echo $output;
		$res 				= $selection->find($document);

		foreach ($res as $doc){

			//echo "<div class='huge'>".$doc["balance"]."</div>";
			//echo "<br />";
		}	

		if ($output >= 2) { 
			//echo "YES <br />";
		}  
			else {
echo '<div class="alert alert-success">';
die("<strong>No available balance !</strong> Please add some funds <a href='addbalance.php'>  here </a>.");
echo '</div>';
			}		
	}



/************************************************************/
	public function con_db_updates($database,$table,$email){

		$email  = $_SESSION["sessemail"];
		//echo $email."pppp";
		$conx = new MongoClient();
		$db = $conx->$database;
		$selection = $db->$table;
		$document = array("email" => $email);
		$result = $selection->findOne($document);
		if($result){
		$res = $selection->find($document);
			foreach ($res as $doc)
			{
				//echo $doc["_id"] ."<br />";
				//echo $doc["email"] ."<br />";
				//echo $doc["balance"] ."<br />";
			}
							$t1 = $doc["balance"];
							$t2 = 2;
							$balance = $t1-$t2;
							//echo "<h1>".$balance."9999 </h1>";

       $selection->update(array("_id"=>$doc["_id"]), 
       array('$set'=>array("balance"=>"$balance")));//problem here
       //echo "Document updated successfully";

}

}
/******************************************************************/



}






$email = $_SESSION["sessemail"];

$obj = new database();

$obj->con_db_findone("$tb_payment","$myusers_tb_payment", "$email");

$obj->con_db_findall("$tb_addurl","$myusers_tb_addurl");

$obj->con_db_updates("$tb_payment","$myusers_tb_payment", "$email");









?>
