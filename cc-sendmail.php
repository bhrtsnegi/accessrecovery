<?php
$status_arr = '';
$return_arr = array();
require_once "captcha.php";

$m_name = stripslashes($_POST['name']);
$m_email = stripslashes($_POST['email']);
$m_message = stripslashes($_POST['query']);
$m_page = $_SERVER['HTTP_REFERER'];

if ($resp != null && $resp->success) {
	
	if(!empty($m_name) && !empty($m_email) && !empty($m_message))	{
		
		if (preg_match('/^[\w-]+(\.[\w-]+)*@([0-9a-z][0-9a-z-]*[0-9a-z]\.)+([a-z]{2,4})$/i', $m_email )) {

	require("class.phpmailer.php");
	
	$mail             = new PHPMailer();

	//$mail->IsSMTP(); // telling the class to use SMTP
	$mail->Host       = "accessrecoverytool.com";
	$mail->SMTPAuth   = true;
	$mail->Host       = "accessrecoverytool.com";
	$mail->Port       = 25;
	$mail->Username   = "info@accessrecoverytool.com";
	$mail->Password   = "";

	$mail->From =$m_email;
	$mail->FromName =$m_name;

	$mail->AddReplyTo($m_email,$m_name);
	
	//$mail->AddAddress("support@systoolsgroup.com", "Support Team");
	$mail->AddAddress("info@accessrecoverytool.com", "Support Team");
	$mail->AddCC("support@systoolsgroup.com", "SysTools Team");
	
	$mail->Subject    = "Request form";

	$body =	    "First Name : ". $m_name ."\r\n\n" .     
						"Email : ". $m_email ."\r\n\n" .
							"Page : ". $m_page ."\r\n\n".
						"Message : ". $m_message ."\r\n\n";
	
	$mail->Body = $body;
	
			if($mail->Send()){
				$status_arr = "Yes";
			} else {
				$status_arr = "No";
			}
		}		
	}
	$return_arr["value"] = $status_arr;
} else {	
	$return_arr["value"] = "Error";
}

echo json_encode($return_arr);

?>