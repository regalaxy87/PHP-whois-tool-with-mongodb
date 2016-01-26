<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="whois lookup and domain name search">
    <meta name="author" content="sami bekkari">
    <?php require_once "config.php"; ?>
    <title><?php echo $title; ?> contact us</title>
    <?php require_once "views/header.php"; ?>
    <!-- Page Content -->

		<div class="container">

        <!-- -->
        <div id="tohide">

        </div>
        <!-- -->


<form class="form-horizontal" role="form" method="post" >
    <div class="form-group">
        <label for="name" class="col-sm-2 control-label">Name</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="name" name="name" placeholder="First and Last Name" required>
        </div>
    </div>
    <div class="form-group">
        <label for="email" class="col-sm-2 control-label">Email</label>
        <div class="col-sm-10">
            <input type="email" class="form-control" id="email" name="email" placeholder="example@domain.com" required>
        </div>
    </div>
    <div class="form-group">
        <label for="message" class="col-sm-2 control-label">Message</label>
        <div class="col-sm-10">
            <textarea class="form-control" rows="4" name="message" maxlength="350" required></textarea>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-10 col-sm-offset-2">
            <input id="submit" name="submit" type="submit" value="Send" class="btn btn-primary">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-10 col-sm-offset-2">
          
        </div>
    </div>
</form>



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
                                    url: "ajax_pages/postmsg.php",
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


        <!-- Footer -->
    <?php require_once "views/footer.php"; ?>

		</div>
	

</body>

</html>
