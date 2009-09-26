<?php

echo "Ok commande pour :  $ajax_client_mail"

//$valid2error = "";
//$valid2mail = "";
//
////Set mail
//if(isset($_POST["mail"])){
//	//TODO check mail
//	$valid2mail = $_POST["mail"];
//}
//
//
//
////Test captcha
//if($valid2error == ""){
//	require_once("recaptcha-php-1.10/recaptchalib.php");
//	$privatekey = "6Ld1-AcAAAAAANpWKYFWRgGmtLtMnTsSeGLUsix3";
//	if (isset($_POST["recaptcha_response_field"])) {
//		$resp = recaptcha_check_answer ($privatekey,
//		$_SERVER["REMOTE_ADDR"],
//		$_POST["recaptcha_challenge_field"],
//		$_POST["recaptcha_response_field"]);
//
//		if (!$resp->is_valid) {
//			$valid2error = "captcha";
//		}
//	}else{
//		$valid2error = "captcha";
//	}
//}
////Test panier
//if($valid2error == ""){
//	require_once("tools/visitor_panier_functions.php");
//	if(panierNbProduits()==0){
//		$valid2error = "panier";
//	}
//}
////Test mail
//if($valid2error == ""){
//	if($valid2mail == ""){
//		$valid2error = "mail";
//	}
//}
//
//
////redirect after tests
//$_SESSION['valid2error'] = $valid2error;
//$_SESSION['valid2mail']=$valid2mail;
//
//switch($valid2error){
//	case "":
//		include('valid3.php');
//		break;
//	default :
//		include('valid1.php');
//		break;
//}
//$_SESSION['check_mail']="";
//$_SESSION['check_error']="";
?>