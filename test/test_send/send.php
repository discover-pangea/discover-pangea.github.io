 <?php
	$to = "rassval@gmail.com";
	$subject = "Contact form request";
	$name = $_POST['name'];
	$from = $_POST['email'];
	$phone = $_POST['phone'];
	$organization = $_POST['organization'];
	$country = $_POST['country'];
	$message = $_POST['message'];

	$headers = 'Reply-To: '.$from.'' . "\r\n" .
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


	// mail($to, $subject, $body, $headers );
	
	function MailSmtp($reciever, $subject, $content, $headers, $debug = 0) {

	  $smtp_server = 'smtp.mail.ru'; // адрес SMTP-сервера
	  $smtp_port = 465; // порт SMTP-сервера
	  $smtp_user = 'contact@discover-pangea.com';
	  $smtp_password = '[Ta1aXs7lKBy';
	  $mail_from = 'contact@discover-pangea.com'; // ящик, с которого отправл¤етс¤ письмо

	  $sock = fsockopen($smtp_server,$smtp_port,$errno,$errstr,30);

	  $str = fgets($sock,512);
	  if (!$sock) {
		printf("Socket is not created\n");
		exit(1);
	  }

	  smtp_msg($sock, "HELO " . $_SERVER['SERVER_NAME']);
	  smtp_msg($sock, "AUTH LOGIN");
	  smtp_msg($sock, base64_encode($smtp_user));
	  smtp_msg($sock, base64_encode($smtp_password));
	  smtp_msg($sock, "MAIL FROM: <" . $mail_from . ">");
	  smtp_msg($sock, "RCPT TO: <" . $reciever . ">");
	  smtp_msg($sock, "DATA");

	  $headers = "Subject: " . $subject . "\r\n" . $headers;

	  $data = $headers . "\r\n\r\n" . $content . "\r\n.";

	  smtp_msg($sock, $data);
	  smtp_msg($sock, "QUIT");

	  fclose($sock);
	}


	function smtp_msg($sock, $msg) {

	  if (!$sock) {
		printf("Broken socket!\n");
		exit(1);
	  }

	  if (isset($_SERVER['debug']) && $_SERVER['debug']) {
		printf("Send from us: %s<BR>", nl2br(htmlspecialchars($msg)));
	  }
	  fputs($sock, "$msg\r\n");
	  $str = fgets($sock, 512);
	  if (!$sock) {
		printf("Socket is down\n");
		exit(1);
	  }
	  else {
		if (isset($_SERVER['debug']) && $_SERVER['debug']) {
		  printf("Got from server: %s<BR>", nl2br(htmlspecialchars($str)));
		}

		$e = explode(" ", $str);
		$code = array_shift($e);
		$str = implode(" ", $e);

		if ($code > 499) {
		  printf("Problems with SMTP conversation.<BR><BR>Code %d.<BR>Message %s<BR>", $code, $str);
		  exit(1);
		}
	  }
	}
	
	MailSmtp($to, $subject, $body, $headers)
?>