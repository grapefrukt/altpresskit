<?php 

require 'phpmailer/class.phpmailer.php';

class EmailHelper {

	public static function send($toAdress, $fromAdress, $subject, $body){
		$result = '';

		$mail = new PHPMailer;

		if (EMAIL_SMTP_SERVER != ''){
			$mail->IsSMTP();
			$mail->SMTPDebug = 1;
			$mail->Host = EMAIL_SMTP_SERVER;
			$mail->SMTPAuth = true;
			$mail->Username = EMAIL_SMTP_USER;
			$mail->Password = EMAIL_SMTP_PASS;
			$mail->SMTPSecure = EMAIL_ENCRYPTION;
		}

		// set up sender and recipient
		$mail->From = $fromAdress;
		$mail->FromName = $fromAdress;
		$mail->AddAddress($toAdress);

		// set word wrap to 50 characters
		$mail->WordWrap = 50;

		$mail->Subject = $subject;
		$mail->Body	 = $body;

		if(!$mail->Send()) {
			$result .= 'Message could not be sent.';
			$result .= "\n" . 'Mailer Error: ' . $mail->ErrorInfo;
		}

		if($result == '') return true;

		return $result;
	}

}