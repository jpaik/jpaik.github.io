<?php
if(isset($_POST['contact-email'])) {
 
    $email_to = "jpaik14@gmail.com";
    $email_subject = "Contact Me form";
 
    function died($error) {
        echo "We are very sorry, but there were error(s) found with the form you submitted. ";
        echo "These errors appear below.<br /><br />";
        echo $error."<br /><br />";
        echo "Please go back and fix these errors.<br /><br />";
        die();
    }
 
    // validation expected data exists
    if(!isset($_POST['contact-name']) ||
        !isset($_POST['contact-email']) ||        
        !isset($_POST['contact-msg'])) {
        died('We are sorry, but there appears to be a problem with the form you submitted.');      
    }
 
    $contact_name = $_POST['contact-name']; // required
    $email_from = $_POST['contact-email']; // required    
    $comments = $_POST['contact-msg']; // required
 
    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
  if(!preg_match($email_exp,$email_from)) {
    $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
  }
    $string_exp = "/^[A-Za-z .'-]+$/";
  if(!preg_match($string_exp,$contact_name)) {
    $error_message .= 'The Name you entered does not appear to be valid.<br />';
  }
  if(strlen($comments) < 2) {
    $error_message .= 'The message you entered do not appear to be valid.<br />';
  }
  if(strlen($error_message) > 0) {
    died($error_message);
  }
    $email_message = "Message information below.\n\n";
 
    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }
 
    $email_message .= "Name: ".clean_string($contact_name)."\n";
    $email_message .= "Email: ".clean_string($email_from)."\n";  
    $email_message .= "Comments: ".clean_string($comments)."\n";
 
// create email headers
$headers = 'From: '.$email_from."\r\n".
'Reply-To: '.$email_from."\r\n" .
'X-Mailer: PHP/' . phpversion();
@mail($email_to, $email_subject, $email_message, $headers);  

?>
<!--HTML Part-->
	<head>
		<title>James Paik | Gamer</title>
		<meta name = "viewport" content="width=device-width, initial-scale=1.0">
		<meta name= "author" content = "James Paik">
		<link href="img/favicon.ico" rel="shortcut icon">
		<link href = "css/bootstrap.min.css" rel= "stylesheet">
		<link href = "css/styles.css" rel= "stylesheet">
	</head>
	
	<body>
		<div class = "container">
				<div class = "jumbotron text-center">
					<h1>Thank you! Your email has been successfully sent.</h1>	
					<br />
					<h2>Please wait a few seconds to be redirected to the home page.</h2>
			</div>
		</div>
	</body>

<?php
	header('Refresh: 3;url=http://www.jpaik.tk');
}
?>