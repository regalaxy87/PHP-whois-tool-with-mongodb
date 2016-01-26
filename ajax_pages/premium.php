<?php

require_once "../config.php";


try {


date_default_timezone_set("America/New_York");


$m = new MongoClient;
$db = $m->$tb_addurl;
$collection = $db->$myusers_tb_addurl;
$cursor = $collection->aggregateCursor(array(

    array(
      '$sort' => array(
          '_id' => 1
	
      ),
    ),
    array(
      '$limit' => 4
    )
));
$cursor->timeout( 60000 );

$today = date('d-m-Y');     
$date1 = date_create($today);

foreach ($cursor as $document) {



$date2 = date_create($document["end_date"]);

//var_dump($date2);

if ( $date1 == $date2) {

$idrm = $document["_id"];

$collection->remove(array( '_id' => new MongoID( $idrm )));


}
else{
       echo"<div class='col-md-3 col-sm-6 hero-feature'>
                <div class='thumbnail'>
                    <div class='col-md-3'> <img src='//www.google.com/s2/favicons?domain_url=".$document["domain"]."'> </div>
                    <div class='caption'>
                        <h3>".$document["domain"]."</h3>";
                       
                    $dom = $document["domain"];
                    $m = new MongoClient();
                    $db = $m->$tb_clicks;
                    $selection = $db->$myusers_tb_clicks;
                    $document = array("domain" => $dom);
                    $result = $selection->findOne($document);
                    if($result){
                    $res = $selection->find($document);                  

                                echo"<p> ".$res->count(true)." Users visited this site </p>";
                              
                                    

                    }
                    else{
                      echo"<p> 0 Users visited this site </p>";
    
                    }

                        echo"<p>
                            <a href='check.php?domain=".$document["domain"]."' target='_blank'  class='btn btn-primary'>Check now</a> 
                        </p>
                    </div>
                </div>
            </div>";


   
}




}

$m->close();


}

catch ( MongoConnectionException $e )
{
  echo "<b> Error message Connection: </b>"   .$e->getMessage()."<br />";
}
catch ( MongoException $e )
{
    echo "<b> Error message Exception: </b>"  .$e->getMessage()."<br />";
}
catch (MongoCursorException $e) {
    echo "<b> Error message: </b>"            .$e->getMessage()."<br />";
    echo "<b> Error code: </b>"               .$e->getCode()."<br />";
}


?>
