<?php

require_once "recaptchalib.php";
// Register API keys at https://www.google.com/recaptcha/admin
$siteKey = "6Le4eCQUAAAAAKgpbYvN9Ys0N6tGxtXetyqw-xWb";
$secret = "6Le4eCQUAAAAAHBDZpDzZi3tlkCI42v741YwPkpT";
// reCAPTCHA supported 40+ languages listed here: https://developers.google.com/recaptcha/docs/language
$lang = "en";
// The response from reCAPTCHA
$resp = null;
// The error code from reCAPTCHA, if any
$error = null;
$reCaptcha = new ReCaptcha($secret);
// Was there a reCAPTCHA response?
// if ($_POST["g-recaptcha-response"]) {
if (isset($_POST["g-recaptcha-response"])) {

	$resp = $reCaptcha->verifyResponse(
	$_SERVER["REMOTE_ADDR"],
	$_POST["g-recaptcha-response"]
	);
}
?>