<?php
include_once('../config.php');
if(isset($_REQUEST['sendEmail']) and $_REQUEST['sendEmail']!=""){
	$userIP = $_SERVER['REMOTE_ADDR'];
    $recaptchaResponse = $_REQUEST['g-recaptcha-response'];
    $secretKey = "6LeXKIkUAAAAAGujGOixcZxUXcl38ixzOR_aA4IC";
    $request = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$secretKey}&response={$recaptchaResponse}&remoteip={$userIP}");

    if(!strstr($request, "true")){
        echo '<div class="alert alert-danger"><i class="fa fa-fw fa-exclamation-triangle"></i> ReCaptcha failed verification! <strong>Reload page and try again.</strong></div>|***|0';
		exit;
    }else{
		$to 		=	explode(',',$_REQUEST['to']);
		$message 	= 	str_replace("\\","", $_REQUEST['mailEditor']);
		
		$message 	.= 	"<br><br>Powered By Learn Code Web <br><br><img src='https://learncodeweb.com/wp-content/uploads/2019/01/logo.png' border='0'><br><br>web : <a href='https://learncodeweb.com' target='_blank'>Learn Code Web</a>";
		
		
		$mail	= 	new	PHPMailer();
		
		/*
		*** You can set SMTP if you want
		*** Change below code as per your need
		*/
		
		/*$mail->IsSMTP();										// Set mailer to use SMTP
		$mail->SMTPDebug	=	2;								// debugging: 1 = errors and messages, 2 = messages only
		$mail->Host 		=	'p3plcpnl0955.prod.phx3.secureserver.net';					// Specify main and backup server
		$mail->Port 		=	587;								// Set the SMTP port
		$mail->SMTPAuth 	=	true;							// Enable SMTP authentication
		$mail->Username 	=	'zaid@learncodeweb.com';		// SMTP username
		$mail->Password 	=	'ZXcv@1234';					// SMTP password
		$mail->SMTPSecure	=	'tls';							// Enable encryption, 'ssl' also accepted
		*/
		
		$mail->CharSet="UTF-8";
		define("FROM_EMAIL","noreply@learncodeweb.com");
		define("FROM_EMAIL_NAME",'Learn Code Web');
		$mail->Subject = $_REQUEST['subject'];
		$mail->SetFrom(FROM_EMAIL, FROM_EMAIL_NAME);
		
		$mail->AddAttachment('../uploads/logo.png');
		
		$mail->MsgHTML($message);
		
		foreach($to as $hoemail){
			$mail->clearAddresses();
			$mail->ClearAllRecipients();
			$mail->AddAddress($hoemail);
			if($mail->Send()){
				$getQuery	=	$db->getRecFrmQry('SELECT * FROM emails WHERE emails="'.$hoemail.'"');
				if(count($getQuery)==0){
					$db->getRecFrmQry('INSERT INTO `emails` (`emails`) VALUES ("'.$hoemail.'")');
				}
				$ms = true;
			}else{
				$ms = false;
				$noemail[]	=	$hoemail;
			}
		}
		if($ms){
			echo '<div class="alert alert-success"><i class="fa fa-fw fa-thumbs-up"></i> Email sent successfylly! Also check in junk and spam.</div>|***|1';
			exit;
		}else{
			echo '<div class="alert alert-danger"><i class="fa fa-fw fa-exclamation-triangle"></i> Email not sent to '.implode(", ",$noemail).' <strong>Please try again or type correct email!</strong></div>|***|0';
			exit;			
		}
    }
}
?>