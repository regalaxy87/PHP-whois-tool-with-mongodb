<?php
										$con = new MongoClient();


										echo "NO EMAIL WE WILL ADD NEW EMAIL WITH DOMAIN <br />";
										$db 		= $con->tb_addurl;
										$coll	 	= $db->myusers_tb_addurl;
										$balance 		= "2";
										$domain 		= "sitepo.com";
										$today 			= date('20-12-2015');
										$sevendays 		= date('27-12-2015');
										$toplay 		= $today;
										$documents 		= array( 
										      "domain"     => "sitedd.com", 
										      "email"      => "pool@gg.vom", 
										      "start_date"   => "$today", 
										      "end_date"     => "$sevendays", 
										      "toplay"     => "$toplay",
										      "clicks"     => "0", 
										      "status"     => "1", 
										      "balance"    => "$balance"
										   );
										$coll->insert($documents);
										echo "Collection inserted succsessfully<br />";


?>
