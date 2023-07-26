<?php

$receiverName = "";

if (isset($_GET["currentEmail"])) {
	$receiverName = $_GET["currentEmail"];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Email
		<?php echo $receiverName; ?>
	</title>
	<link rel="stylesheet" type="text/css" href="style.css">

</head>

<body>
	<form method="post" action="" id="mail_form">
		<button type="button" class="icon-btn" id="cancel_email"><i class="bi bi-arrow-left"></i></button>
		<h2>Send Email to
			<?php echo $receiverName; ?>
		</h2>
		<label for="name">Name:</label>
		<input type="text" id="Name " name="name" required placeholder="Enter Name for your Email (Not required)" autocomplete="false">
		<label for="subject">Subject:</label>
		<input type="text" id="Subject" name="subject" required placeholder="Enter your Subject" autocomplete="false">
		<label for="msg">Compose Email:</label>
		<textarea name="msg" id="msg" cols="30" rows="10" ></textarea><br>

		<button type="submit" name="send_mail">Send Email</button>
	</form>

	<script src="script.js"></script>
	
	<?php 
	use PHPMailer\PHPMailer\PHPMailer;
	
	require 'PHPMailer/src/Exception.php';
	require 'PHPMailer/src/PHPMailer.php';
	require 'PHPMailer/src/SMTP.php';
	
	if(isset($_POST["send_mail"])){
		
		$mail=new PHPMailer(true);
		$mail->isSMTP();
		$mail->Host='smtp.gmail.com';
		$mail->SMTPAuth=true;
		$mail->Username='gavaidinesh26@gmail.com';
		$mail->Password='nlwmhztinwcfdvzm';
		$mail->SMTPSecure='ssl';
		$mail->Port=465;
	
		$mail->setFrom('gavaidinesh26@gmail.com',$_POST['name']);
		
	
		$mail->addAddress($receiverName);
	
		$mail->isHTML(true);
	
		$mail->Subject=$_POST['subject'];
		$mail->Body=$_POST['msg'];
		$mail->send();
	
		echo "
		<script>
		alert('Send Successfully');
		document.location.href='index.php';
		
		</script>";
	
	}
	
	?>

</body>


</html>