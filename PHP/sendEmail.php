<?php 

//Este comando para instalar a biblioteca
//composer require phpmailer/phpmailer

require './vendor/autoload.php';
//var_dump($_POST).'<pre>'; 


if(!isset($_POST['name']) || !isset($_POST['email'])) {
	header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
	exit;
}



 $mail = new PHPMailer();

    $mail->IsSMTP();            /* Ativar SMTP*/
    $mail->SMTPOptions = array(
		'ssl' => array(
		    'verify_peer' => false,
		    'verify_peer_name' => false,
		    'allow_self_signed' => true
		));
    $mail->SMTPDebug = 1;        /* Debugar: 1 = erros e mensagens, 2 = mensagens apenas*/
    $mail->SMTPAuth = true;        /* Autenticação ativada    */
    $mail->SMTPSecure = 'tls';    /* TLS REQUERIDO pelo GMail*/
    $mail->Host = 'smtp.live.com';    /* SMTP utilizado*/
    $mail->Port = 25;             
    $mail->Username = "***";
    $mail->Password = "***";
    $mail->SetFrom($_POST['email'], $_POST['name']);
    $mail->Subject = "Landing page - " . $_POST['type']; 
    $mail->Body = $_POST['description'] . " Email - " . $_POST['email'] . " Nome - " . $_POST['name'];
    $mail->AddAddress("thuran_eduardo@hotmail.com");
    $mail->IsHTML(false);
 
    /* Função Responsável por Enviar o Email*/
   if (!$mail->send()) {
   	 	echo "Mailer Error: " . $mail->ErrorInfo;
   		//header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
		exit;
	} else {
	    echo "Message sent!";
	}