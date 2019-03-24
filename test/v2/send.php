 <?php
	$to = "rassval@gmail.com";
	$subject = "Support requested by ".$_POST['name'];
	$name = $_POST['name'];
	$from = $_POST['email'];
	$phone = $_POST['phone'];
	$organization = $_POST['organization'];
	$country = $_POST['country'];
	$message = $_POST['message'];

	$headers = 'From: test@test.com' . "\r\n" .
	   'Reply-To: '.$from.'' . "\r\n" .
	   'X-Mailer: PHP/' . phpversion() . "\r\n";
	   
	$headers .= "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

	
	$body = "
		<html>
		<head>
		<title>Contact form</title>
		</head>
		<body>
		<table>
		<tr>
			<td><b>Name</b></td>
			<td>" . $name . "</td>
		</tr>
		<tr>
			<td><b>Phone</b></td>
			<td>" . $phone . "</td>
		</tr>
		<tr>
			<td><b>Email</b></td>
			<td>" . $from . "</td>
		</tr>
		<tr>
			<td><b>Organization</b></td>
			<td>" . $organization . "</td>
		</tr>
		<tr>
			<td><b>Country</b></td>
			<td>" . $country . "</td>
		</tr>
		<tr>
			<td><b>Message</b></td>
			<td>" . $message . "</td>
		</tr>
		</table>
		</body>
		</html>
		";


	mail($to, $subject, $body, $headers );
?>