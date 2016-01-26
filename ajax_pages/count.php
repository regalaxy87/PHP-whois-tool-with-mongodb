<?php

require_once "../config.php";

try {
   $m = new MongoClient();
   $db = $m->$domains;
   $collection = $db->$mydmn;
   $cursor = $collection->find();
   echo "<p><span class='label label-success'>";
   echo ($cursor->count(true));
   echo "</span> total whois website calculated </p>";
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
