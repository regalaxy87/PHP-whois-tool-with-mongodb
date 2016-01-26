<?php
if(isset($_POST['submit'])) 
{ 

$name 	 = substr($_POST["name"],    0, 30);
$email 	 = substr($_POST["email"],   0, 40);
$subject = substr($_POST["subject"], 0, 30);
$body	 = substr($_POST["body"],    0, 450);

$arr = array(
		$name, 
		$email, 
		$subject, 
		$body 
	    );

foreach ($arr as $value) {
   
    if ($value=="") {die("all fields should not be empty");}   	


}

    echo "Your message has been sent  : <b> $email </b>";
    echo "<br>Thank you for contacting us, we will answer you as soon as possible."; 



$mdemail = md5($email);
$mdemailx = substr($mdemail,   0, 6);

// multiple recipients
$to  = 'sami87bekkari@gmail.com'; // note the comma

// subject
$subjectof = 'contact hrankdir ref#'.$mdemailx.'';

// message
$message = '
<html>
<head>
  <title></title>
</head>
<body>

<p>ref#'.$mdemail.'</p>

<p>name    : '.$name.'</p>
<p>email   : '.$email.'</p>
<p>subject : '.$subject.'</p>
<p>message :'.$body.'</p>

</body>
</html>';

// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// Additional headers

$headers .= 'From: contact <noreply@highrankdir.com>' . "\r\n";


// Mail it
mail($to, $subjectof, $message, $headers);


}
?>
<form class="form-horizontal" method="post" action="http://www.highrankdir.com/en/contact">
	<fieldset>
		<legend><p>Please fill out following form to contact us by e-mail.</p></legend>
		<div class="form-group">
		<label class="col-lg-2 control-label" for="ContactForm_name" >Name</label>		<div class="col-lg-10">
		<input class="form-control" name="name"  type="text" required/>		</div>
		</div>


		<div class="form-group">
		<label class="col-lg-2 control-label" for="ContactForm_email">Email</label>		<div class="col-lg-10">
		<input class="form-control" name="email"  type="text" required/>		</div>
		</div>

		<div class="form-group">
		<label class="col-lg-2 control-label" for="ContactForm_subject">Subject</label>		<div class="col-lg-10">
		<input class="form-control" name="subject"  type="text" required/>		</div>
		</div>

		<div class="form-group">
		<label class="col-lg-2 control-label" for="ContactForm_body">Body</label>		<div class="col-lg-10">
		<textarea class="form-control" rows="6" name="body" maxlength="450" required></textarea>		</div>
		</div>

		<div class="form-group">
		<div class="col-lg-10 col-lg-offset-2">
  		<input type="submit" class="btn btn-large btn-primary" value="Submit" name="submit">
		</div>
		</div>

	</fieldset>
</form>
