<?php
/*************************************************************************
php easy :: whois lookup script
==========================================================================
Author:      php easy code, www.phpeasycode.com
Web Site:    http://www.phpeasycode.com
Contact:     webmaster@phpeasycode.com
*************************************************************************/
require_once __DIR__ . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';
use \SEOstats\Services as SEOstats;

$domain = $_GET['domain'];

if ($domain=='') {die('please enter domain');}

	if(!preg_match("/^([-a-z0-9]{2,100})\.([a-z\.]{2,8})$/i", $domain)) {
		
		die('domain invalid');
		
	}
	

require_once "whois_server.php";

function LookupDomain($domain){
	global $whoisservers;
	$domain_parts = explode(".", $domain);
	$tld = strtolower(array_pop($domain_parts));
	$whoisserver = $whoisservers[$tld];
	if(!$whoisserver) {
		return "Error: No appropriate Whois server found for $domain domain!";
	}
	$result = QueryWhoisServer($whoisserver, $domain);
	if(!$result) {
		return "Error: No results retrieved from $whoisserver server for $domain domain!";
	}
	else {
		while(strpos($result, "Whois Server:") !== FALSE){
			preg_match("/Whois Server: (.*)/", $result, $matches);
			$secondary = $matches[1];
			if($secondary) {
				$result = QueryWhoisServer($secondary, $domain);
				$whoisserver = $secondary;
			}
		}
	}
	return "$domain domain lookup results from $whoisserver server:\n\n" . $result;
}

function LookupIP($ip) {
	$whoisservers = array(
		//"whois.afrinic.net", // Africa - returns timeout error :-(
		"whois.lacnic.net", // Latin America and Caribbean - returns data for ALL locations worldwide :-)
		"whois.apnic.net", // Asia/Pacific only
		"whois.arin.net", // North America only
		"whois.ripe.net" // Europe, Middle East and Central Asia only
	);
	$results = array();
	foreach($whoisservers as $whoisserver) {
		$result = QueryWhoisServer($whoisserver, $ip);
		if($result && !in_array($result, $results)) {
			$results[$whoisserver]= $result;
		}
	}
	$res = "RESULTS FOUND: " . count($results);
	foreach($results as $whoisserver=>$result) {
		$res .= "\n\n-------------\nLookup results for " . $ip . " from " . $whoisserver . " server:\n\n" . $result;
	}
	return $res;
}

function ValidateIP($ip) {
	$ipnums = explode(".", $ip);
	if(count($ipnums) != 4) {
		return false;
	}
	foreach($ipnums as $ipnum) {
		if(!is_numeric($ipnum) || ($ipnum > 255)) {
			return false;
		}
	}
	return $ip;
}

function ValidateDomain($domain) {
	if(!preg_match("/^([-a-z0-9]{2,100})\.([a-z\.]{2,8})$/i", $domain)) {
		
		die('domain invalid');
		return false;
	}
	return $domain;
}

function QueryWhoisServer($whoisserver, $domain) {
	$port = 43;
	$timeout = 15;
	$fp = @fsockopen($whoisserver, $port, $errno, $errstr, $timeout) or die("Socket Error " . $errno . " - " . $errstr);
	//if($whoisserver == "whois.verisign-grs.com") $domain = "=".$domain; // whois.verisign-grs.com requires the equals sign ("=") or it returns any result containing the searched string.
	fputs($fp, $domain . "\r\n");
	$out = "";
	while(!feof($fp)){
		$out .= fgets($fp);
	}
	fclose($fp);

	$res = "";
	if((strpos(strtolower($out), "error") === FALSE) && (strpos(strtolower($out), "not allocated") === FALSE)) {
		$rows = explode("\n", $out);
		foreach($rows as $row) {
			$row = trim($row);
			if(($row != '') && ($row{0} != '#') && ($row{0} != '%')) {
				$res .= $row."\n";
			}
		}
	}
	return $res;
}
		$url=$domain;
		$xml = simplexml_load_file('http://data.alexa.com/data?cli=10&dat=snbamz&url='.$url);
		$rank=isset($xml->SD[1]->POPULARITY)?$xml->SD[1]->POPULARITY->attributes()->TEXT:0;
                $web=(string)$xml->SD[0]->attributes()->HOST;
?>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="whois lookup and domain name search">
    <meta name="author" content="sami bekkari">
	<link rel="shortcut icon" href="/favicon.ico" />
 <?php require_once "config.php"; ?>
    <title>Whois lookup for <?php echo $domain; ?> </title>
    <?php require_once "views/header.php"; ?>
    <!-- Page Content -->
    <div class="container">

<!-- Jumbotron Header -->
        <div class="jumbotron hero-spacer">

    <div class="row">
                <div class="col-md-4">
		<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
		<!-- css350 -->
		<ins class="adsbygoogle"
		     style="display:inline-block;width:300px;height:250px"
		     data-ad-client="ca-pub-6881171206018736"
		     data-ad-slot="9680672004"></ins>
		<script>
		(adsbygoogle = window.adsbygoogle || []).push({});
		</script>
		</div>

       <div class="col-md-8">
	<form action="whois.php" class="form-inline">
			<input type="text" name="domain" id="domain" size="50%" class="form-control" value="<?=$domain;?>" placeholder="Domain or IP address">
			<input type="submit" class="btn btn-primary" value="Whois?">
			<p></p>
			<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
			<!-- smhrgray -->
			<ins class="adsbygoogle"
			     style="display:inline-block;width:468px;height:15px"
			     data-ad-client="ca-pub-6881171206018736"
			     data-ad-slot="8892130405"></ins>
			<script>
			(adsbygoogle = window.adsbygoogle || []).push({});
			</script>
            <h3>Whois lookup for <span class="label label-success"><?php echo $domain; ?></span> </h3>
            <h3>Whois Search for websites and ip addresses</h3>
 <h3>
<span class='st_sharethis_large' displayText='ShareThis'></span>
<span class='st_facebook_large' displayText='Facebook'></span>
<span class='st_twitter_large' displayText='Tweet'></span>
<span class='st_linkedin_large' displayText='LinkedIn'></span>
<span class='st_pinterest_large' displayText='Pinterest'></span>
<span class='st_email_large' displayText='Email'></span> 
</h3>

</form>

<br />
	 
     </div>
     </div>

</div>

<?php
	if($domain) {
		$url=$domain;
		$xml = simplexml_load_file('http://data.alexa.com/data?cli=10&dat=snbamz&url='.$url);
		$rank=isset($xml->SD[1]->POPULARITY)?$xml->SD[1]->POPULARITY->attributes()->TEXT:0;
		$web=(string)$xml->SD[0]->attributes()->HOST;
		$domain = trim($domain);
		if(substr(strtolower($domain), 0, 7) == "http://") $domain = substr($domain, 7);
		if(substr(strtolower($domain), 0, 4) == "www.") $domain = substr($domain, 4);
		if(ValidateIP($domain)) {
			$result = LookupIP($domain);
		}
		elseif(ValidateDomain($domain)) {
			$result = LookupDomain($domain);

			    try {

					      $conn = new MongoClient();
					      $db = $conn->domain;
					      $collection = $db->mydmn;

					      $criteria = array('domain' => $domain,);
					     // var_dump ($criteria);
					      $doc = $collection->findOne($criteria);

					      if(!empty($doc)) {
						// echo 'Data Already Exist';
					      } else {
					      $object = array(
				     		 "domain" => $domain, 
				      		  "alexa" => "$rank"
					     );


					     $collection->save($object);
					     //echo 'Added Successfully!';
						}
					      // disconnect from server
					      $conn->close();
			    } 

			    catch (MongoConnectionException $e) {
			      		die('Error connecting to MongoDB server');
			    } 

			    catch (MongoException $e) {
			      		die('Error: ' . $e->getMessage());
			    }



		}
		else 
		{
		die("Invalid Input! remove http:// from url");
		}

	}
?>	





<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">
            <img src="img/search_engine.png" alt="Search Engine Stats">
            &nbsp;
            Search Engine Stats        </h3>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-6">
                <table class="table custom-border">
                    <tr>
                        <td class="vmiddle width30pers">
                            <img src="img/google.png" alt="Google Index">
                            &nbsp;
                            Google Index                        </td>
                        <td class="vmiddle">
                            <strong>
                            <?php 
							$seostats = new \SEOstats\SEOstats;
				 			$url = "http://www.".$domain;
				  				if ($seostats->setUrl($url)) {
									print SEOstats\Google::getSiteindexTotal();
				 				}
							?>
							</strong>
                        </td>
                    </tr>
                    <tr>
                        <td class="vmiddle">
                            <img src="img/yahoo.png" alt="Yahoo Index">
                            &nbsp;
                            Yahoo Index                        </td>
                        <td class="vmiddle">
                            <strong>0</strong>
                        </td>
                    </tr>
                    <tr>
                        <td class="vmiddle">
                            <img src="img/bing.png" alt="Bing Index">
                            &nbsp;
                            Bing Index                        </td>
                        <td class="vmiddle">
                            <strong>0</strong>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-md-6">
                <table class="table custom-border">
                    <tr>
                        <td class="width40pers" style="vertical-align: middle">
                            <img src="img/page_rank_icon.png" width="32" height="32" alt="PageRank">
                            &nbsp;
                            PageRank                        </td>
                        <td>
                            <img src="img/n-a.png" alt="PageRank n-a">
                        </td>
                    </tr>
                    <tr>
                        <td class="vmiddle">
                            <img src="img/backlink.png" alt="Google Backlinks">
                            &nbsp;
                            Google Backlinks                        </td>
                        <td class="vmiddle">
                            <strong>N.A</strong>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>


<div class="panel panel-default">
    <div class="panel-heading">

        <h3 class="panel-title">
            <img src="img/alexa.png" alt="Alexa Stats">
            Alexa Stats    <?php echo $web; ?>        &nbsp;
        </h3>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-6">
                <table class="table custom-border">
                    <tr>
                        <td class="width30pers">
                            Global Rank                        </td>
                        <td>
                            <strong><?php echo $rank; ?></strong>
                        </td>
                    </tr>
                    <tr>
                        <td>
                           Links in                        </td>
                        <td>
                            <strong>0</strong>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Review count                        </td>
                        <td>
                            <strong>0</strong>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Review average                        </td>
                        <td>
                            <strong>0</strong>
                        </td>
                    </tr>
                </table>
            </div>

                        <div class="clearfix"></div>
            <img class="img-thumbnail" style="margin: 15px 0 0 15px" src=<?php echo "http://traffic.alexa.com/graph?&amp;w=320&amp;h=230&amp;o=f&amp;c=1&amp;y=t&amp;b=ffffff&amp;r=1m&amp;u=$domain"; ?> alt="Daily Global Rank Trend">
            <img class="img-thumbnail" style="margin: 15px 15px 0 15px" src=<?php echo "http://traffic.alexa.com/graph?&amp;w=320&amp;h=230&amp;o=f&amp;c=1&amp;y=r&amp;b=ffffff&amp;r=1m&amp;u=$domain"; ?> alt="Daily Reach (Percent)">
        </div>
    </div>
</div>



<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">
            <img src="img/whois.png" alt="WHOIS">
            &nbsp;
            WHOIS           
        </h3>
    </div>

        <div class="panel-body">
			<?php

			echo "<textarea class='form-control' rows='18' >. $result .</textarea>";

			?>

    </div>
</div>

        <!-- Footer -->
    <?php require_once "views/footer.php"; ?>

    </div>
    <!-- /.container -->
</body>
</html>
