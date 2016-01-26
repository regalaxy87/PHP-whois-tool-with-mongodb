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
    <title><?php echo $title; ?>  Sign up free account</title>
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

		<!-- -->
		<div id="tohide">

		</div>
		<!-- -->

<form class="form-horizontal" role="form" method="post"> 

<!--<form  role="form" method="post" class="form-horizontal" action="arr.php">  -->
    <div class="form-group">
        <label for="name" class="col-sm-2 control-label">Name</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="name" name="name" maxlength="30" placeholder="First & Last Name" value="" required>
        </div>
    </div>
    <div class="form-group">
        <label for="email" class="col-sm-2 control-label">Email</label>
        <div class="col-sm-10">
            <input type="email" class="form-control" id="email" name="email" maxlength="40" placeholder="example@domain.com" value="" required>
        </div>
    </div>
    <div class="form-group">
        <label for="password" class="col-sm-2 control-label">Password</label>
        <div class="col-sm-10">
            <input type="password" class="form-control" id="password" name="password" maxlength="16" placeholder="Type password (max : 16 characters) " value="" required>
        </div>
    </div>
    <div class="form-group">
        <label for="repassword" class="col-sm-2 control-label">Repassword</label>
        <div class="col-sm-10">
            <input type="password" class="form-control" id="repassword" name="repassword" maxlength="16" placeholder="Type password again (max : 16 characters)" value="" required>
        </div>
    </div>
    <div class="form-group">
        <label for="username" class="col-sm-2 control-label">Username</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="username" name="username" maxlength="30" placeholder="Choose username" value="" required>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-10 col-sm-offset-2">
            <input id="submit" name="submit" type="submit" value="Register" class="btn btn-primary">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-10 col-sm-offset-2">
            
        </div>
    </div>
</form>



     </div>
     </div>

</div>


<script> 
            
$(document).ready(function(){

                    $(".form-horizontal").submit(function(){


                        var name = $('#name').val();
                        if (!name)
                        {

                            alert('please enter name');
                        }

                        else
                        {
                        var $form = $(this);
                        var $inputs = $form.find("input, select, button, textarea");
                        var serializedData = $form.serialize();
                        $inputs.prop("enabled", true);   
    
                                    $.ajax({
                                    type: "POST",
                                    url: "ajax_pages/checkin.php",
                                    data: serializedData,
                                    cache: false,
                                    success: function(html){
                                    //alert(html);
                                    $("#tohide").html(html);
				    $('.form-horizontal')[0].reset();
                                    }
                                    });
                        }
                    return false;
                    });
});

</script>


        <?php require_once "views/footer.php"; ?>

    </div>
    <!-- /.container -->



</body>

</html>
