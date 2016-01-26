<?php

require_once "../config.php";


$name 	= $_POST["name"];
$email = $_POST["email"];
$message = $_POST["message"];

$message = substr($message, 0, 350);



if(!isset($name) || trim($name) == '')
{
   die ('name should not be empty');
}

else{

$a = 1;

}



if(!isset($email) || trim($email) == '')
{
   die ('email should not be empty');
}


else{

$b = 1;

}


if(!isset($message) || trim($message) == '')
{
   die ('message should not be empty');
}

else{

$c = 1;

}


$z = $a+$b+$c;

    if ($z==3){

        echo '<div class="alert alert-success">
          <strong>Message received</strong> Dear '.$name.' We will contact you soon.
        </div>';
                try {

                        $conn = new MongoClient();
                        $db = $conn->$tb_messages;
                        $collection = $db->$myusers_tb_messages;

                        $object = array(
                             "name"     => $name, 
                             "email"    => $email, 
                             "message"  => $message                             
                        );   

                        $collection->save($object);
                        $conn->close();
                } 

                catch (MongoConnectionException $e) {
                        die('Error connecting to MongoDB server');
                } 

                catch (MongoException $e) {
                        die('Error: ' . $e->getMessage());
                }
    }

    else {

        die ('error, check again later');
    }


?>
