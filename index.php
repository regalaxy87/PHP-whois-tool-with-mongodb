<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="whois lookup and domain name search">
    <meta name="author" content="sami bekkari">
	<link rel="shortcut icon" href="/favicon.ico" />
	<meta name="google-site-verification" content="ptInSyMmKaa9_6VAx9sV2p3Op9RLyslyIPxnqB3i9Nw" />
    <?php require_once "config.php"; ?>
    <title><?php echo $title; ?> whois lookup of domain names</title>
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
			<form action="whois.php"  class="form-inline">
					<div class="input-group">
<input class="form-control input-lg" value="<?=$domain;?>" placeholder="example.com" name="domain" id="domain" size="10%" type="text">												<span class="input-group-btn">
					<button type="submit" id="submit" class="btn btn-primary" style="padding: 14px 28px 15px 28px !important">Whois </button>
					</div>
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
			            <h2>Welcome to <?php echo $title; ?>!</h2>
			            <p>Whois Search for websites and ip addresses</p>
						 <h3>
						<span class='st_sharethis_large' displayText='ShareThis'></span>
						<span class='st_facebook_large' displayText='Facebook'></span>
						<span class='st_twitter_large' displayText='Tweet'></span>
						<span class='st_linkedin_large' displayText='LinkedIn'></span>
						<span class='st_pinterest_large' displayText='Pinterest'></span>
						<span class='st_email_large' displayText='Email'></span> 
						</h3>
			</form>

<script type="text/javascript">
 $(document).ready(function() {

      $.ajax({    
        type: "GET",
        url: "ajax_pages/count.php",             
        dataType: "html",   //expect html to be returned                
        success: function(response){                    
            $("#countdomains").html(response); 
            //alert(response);
        }
    });

});
</script>


<div id="countdomains"></div>

     </div>
     </div>
</div>


<script type="text/javascript">
 $(document).ready(function() {

      $.ajax({    
        type: "GET",
        url: "ajax_pages/domains.php",             
        dataType: "html",   //expect html to be returned                
        success: function(response){                    
            $("#lastestwhois").html(response); 
            //alert(response);
        }
    });

});
</script>


<script type="text/javascript">
 $(document).ready(function() {

      $.ajax({    
        type: "GET",
        url: "ajax_pages/premium.php",             
        dataType: "html",   //expect html to be returned                
        success: function(response){                    
            $("#premiumlisting").html(response); 
            //alert(response);
        }
    });

});
</script>


<div class="panel panel-default">
		    <div class="panel-heading">
		        <h3 class="panel-title">
		            <img src="img/Award-Star-Gold-3-32.png" alt="whois">
		            &nbsp;
		            Premium listing for 1 week (hot offer)        </h3>
		    </div>
		    <div class="panel-body">
		        <div class="row">
		        <h3 class="panel-title">
		            &nbsp;
		           <span> # </span> our latest users for premium listing    </h3>
		          &nbsp;
					<div id="premiumlisting"></div>
		        </div>
		    </div>
</div>

<div class="row">
<div class="col-lg-12">
  
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- default -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-6881171206018736"
     data-ad-slot="3984252806"
     data-ad-format="auto"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>

</div>
</div>
<br />

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">
            <img src="img/whois.png" alt="whois">
            &nbsp;
            Latest whois lookup        </h3>
    </div>
    <div class="panel-body">
        <div class="row">
        <h3 class="panel-title">
            &nbsp;
           <span> # </span> view more information about the domain listed below        </h3>
          &nbsp;
		  <div id="lastestwhois"></div>
        </div>
    </div>
</div>

        <!-- Footer -->
    <?php require_once "views/footer.php"; ?>
    <!-- /.container -->
</div>


</body>
</html>
