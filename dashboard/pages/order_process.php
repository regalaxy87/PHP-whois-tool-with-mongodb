<?php
session_start();

require_once "../../config.php";



define('CLIENT_ID', 'AczIJVqg1MPK3ItForTYH_o9A-G8fIUb8nDbcoN7tPHeK2m5ec6Fu78dA-yFiuDfc_o314DP1KGcnev5'); //your PayPal client ID
define('CLIENT_SECRET', 'ED8dxaMsZcwfP0FBq4Mk34GAhgozzYCMSJJBCtps4JjCMlwrykbMI0CmFN1UW_2gQNCjYVwJWZ_B0veK'); //PayPal Secret
define('RETURN_URL', "http://www.".$title."/dashboard/pages/order_process.php"); //return URL where PayPal redirects user
define('CANCEL_URL', "http://www.".$title."/dashboard/pages/index.php"); //cancel URL
define('PP_CURRENCY', 'USD'); //Currency code
define('PP_CONFIG_PATH', 'sdk_config.ini'); //PayPal config path (sdk_config.ini)

include_once __DIR__ . "/vendor/autoload.php"; //include PayPal SDK
include_once __DIR__ . "/functions.inc.php"; //our PayPal functions




#### Prepare for Payment ####
$email = $_SESSION["sessemail"];


if(isset($_POST["item_code"])){
	
	$item_name = $_POST["item_name"]; //get item code
	$item_code = $_POST["item_code"]; //get item code
	$item_price = $_POST["item_price"]; //get item price


if ($item_price < 2)

{

die ("wrong price");

}

if (!(ctype_digit($item_price)))

{

die ("wrong type price");

}




	$item_qty = $_POST["qty"]; //get quantity
	/* 
	Note: DO NOT rely on item_price you get from products page, in production mode get only "item code" 
	from the products page and then fetch its actual price from Database.
	Example :
	$results = $mysqli->query("SELECT item_name, item_price FROM products WHERE item_code= '$item_code'");
	while($row = $results->fetch_object()) {
		$item_name = $row->item_name;
		$item_price = item_price ;
	}  
	*/

	//set array of items you are selling, single or multiple
	$items = array(
		array('name'=> $item_name, 'quantity'=> $item_qty, 'price'=> $item_price, 'sku'=> $item_code, 'currency'=>PP_CURRENCY)
	);
	
	//calculate total amount of all quantity. 
	$total_amount = ($item_qty * $item_price);
	
	try{ // try a payment request
		//if payment method is paypal
		$result = create_paypal_payment($total_amount, PP_CURRENCY, '', $items, RETURN_URL, CANCEL_URL);
			
		//if payment method was PayPal, we need to redirect user to PayPal approval URL
		if($result->state == "created" && $result->payer->payment_method == "paypal"){
			$_SESSION["payment_id"] = $result->id; //set payment id for later use, we need this to execute payment
			header("location: ". $result->links[1]->href); //after success redirect user to approval URL 
			exit();
		}
		
	}catch(PPConnectionException $ex) {
		echo parseApiError($ex->getData());
	} catch (Exception $ex) {
		echo $ex->getMessage();
	}
}


### After PayPal payment method confirmation, user is redirected back to this page with token and Payer ID ###
if(isset($_GET["token"]) && isset($_GET["PayerID"]) && isset($_SESSION["payment_id"])){
	try{
		$result = execute_payment($_SESSION["payment_id"], $_GET["PayerID"]);  //call execute payment function.

		if($result->state == "approved"){ //if state = approved continue..
			//SUCESS
			
			unset($_SESSION["payment_id"]); //unset payment_id, it is no longer needed 
			
			//get transaction details
			$transaction_id 		= $result->transactions[0]->related_resources[0]->sale->id;
			$transaction_time 		= $result->transactions[0]->related_resources[0]->sale->create_time;
			$transaction_currency 	= $result->transactions[0]->related_resources[0]->sale->amount->currency;
			$transaction_amount 	= $result->transactions[0]->related_resources[0]->sale->amount->total;
			$transaction_method 	= $result->payer->payment_method;
			$transaction_state 		= $result->transactions[0]->related_resources[0]->sale->state;
			
			//get payer details
			$payer_first_name 		= $result->payer->payer_info->first_name;
			$payer_last_name 		= $result->payer->payer_info->last_name;
			$payer_email 			= $result->payer->payer_info->email;
			$payer_id				= $result->payer->payer_info->payer_id;
			
			//get shipping details 
			$shipping_recipient		= $result->transactions[0]->item_list->shipping_address->recipient_name;
			$shipping_line1			= $result->transactions[0]->item_list->shipping_address->line1;
			$shipping_line2			= $result->transactions[0]->item_list->shipping_address->line2;
			$shipping_city			= $result->transactions[0]->item_list->shipping_address->city;

			$shipping_state			= $result->transactions[0]->item_list->shipping_address->state;
			$shipping_postal_code	= $result->transactions[0]->item_list->shipping_address->postal_code;
			$shipping_country_code	= $result->transactions[0]->item_list->shipping_address->country_code;
						
			  /*
				####  AT THIS POINT YOU CAN SAVE INFO IN YOUR DATABASE ###
				//see (http://www.sanwebe.com/2013/03/basic-php-mysqli-usage) for mysqli usage
			   
				//Open a new connection to the MySQL server
				$mysqli = new mysqli('host','username','password','database_name');
			   
				//Output any connection error
				if ($mysqli->connect_error) {
					die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
				}      
			   
				$insert_row = $mysqli->query("INSERT INTO transactions (payer_id, payer_name, payer_email, transaction_id)
					VALUES ('payer_first_name' , '$payer_email' , '$transaction_id')");
				*/
			   			
			//Set session for later use, print_r($result); to see what is returned
			$_SESSION["results"]  = array(
					'transaction_id' => $transaction_id, 
					'transaction_time' => $transaction_time,
					'transaction_currency' => $transaction_currency,
					'transaction_amount' => $transaction_amount,
					'transaction_method' => $transaction_method,
					'transaction_state' => $transaction_state
					);
						
			header("location: ". RETURN_URL); //$_SESSION["results"] is set, redirect back to order_process.php
			exit();
		}
		
	}catch(PPConnectionException $ex) {
		$ex->getData();
	} catch (Exception $ex) {
		echo $ex->getMessage();
	}

}

### Display order confirmation if $_SESSION["results"] is set  ####
if(isset($_SESSION["results"]))
{
$content = <<<EOD
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Payment gateway</title>
<style type="text/css">
.transaction_info {margin:0px auto; background:#F2FCFF;; max-width: 750px; color:#555;font-size: 13px;font-family: Arial, sans-serif;}
.transaction_info thead {background: #BCE4FA;font-weight: bold;}
.transaction_info thead tr th {border-bottom: 1px solid #ddd;}
</style>
</head>
<body>
<div align="center"><h2>Payment Success</h2></div>
<table border="0" cellpadding="10" cellspacing="0" class="transaction_info">
<thead><tr>
<td>Transaction ID</td>
<td>Date</td><td>Currency</td>
<td>Amount</td><td>Method</td>
<td>State</td></tr></thead>
<tbody>
<tr>
<td>{$_SESSION["results"]["transaction_id"]}</td>
<td>{$_SESSION["results"]["transaction_time"]}</td>
<td>{$_SESSION["results"]["transaction_currency"]}</td>
<td>{$_SESSION["results"]["transaction_amount"]}</td>
<td>{$_SESSION["results"]["transaction_method"]}</td>
<td>{$_SESSION["results"]["transaction_state"]}</td></tr><tr>
<td colspan="6">
<div align="center">
<a href="index.php">Back to Products Page</a></div></td></tr></tbody></table>
</body></html>	
</body>
</html>
EOD;
}
print $content;

//echo "<h1>".$_SESSION["results"]["transaction_amount"]."</h1>";

$balance = $_SESSION["results"]["transaction_amount"];

//echo $balance; 

    if (is_numeric($balance) && $balance >= 2) {



$con = new MongoClient();
if($con){
	$db = $con->$tb_payment;
	$selection = $db->$myusers_tb_payment;
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

       $selection->update(array("_id"=>$doc["_id"]), 
       array('$set'=>array("balance"=>"$balance")));
       //echo "Document updated successfully";



			foreach ($res as $doc)
			{
				//echo $doc["_id"] ."<br />";
				//echo $doc["email"] ."<br />";
				//echo $doc["balance"] ."<br />";
			}




} 
else{ die("user does not exist , or user / password is incorrect");} 
} 
else{ die("Mongo DB not installed");} 
    } 


else {

include_once "errorglobal.php";
$obj = new error;

$obj->error_danger("oOps error occured");

}


unset($_SESSION["results"]);


?>
