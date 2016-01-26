<?php

require_once "../config.php";

try {

     $m = new MongoClient();
     $db = $m->$domains;
     $collection = $db->$mydmn;
     $cursor = $collection->find();
     $cursor->sort(array("_id" => -1));
     $cursor->limit(4);
         foreach ($cursor as $document) {
             echo"<div class='col-md-3 col-sm-6 hero-feature'>
                      <div class='thumbnail'>
                         
                          <div class='caption'>
                              <h3>".$document["domain"]."</h3>
                              <p>has alexa rank of ".$document["alexa"]."</p>
                              <p>
                                  <a href='/".$document["domain"]."' class='btn btn-primary'>More Info</a> 
                              </p>
                          </div>
                      </div>
                  </div>";
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
