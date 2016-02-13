<?php 

require_once 'PHPMailerAutoload.php';

$nome  	   = $_POST['nome'];
$email 	   = $_POST['email'];
$mensagem  = $_POST['mensagem'];

$mail = new PHPMailer();

$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->Port = 587;
$mail->SMTPSecure = 'tls';
$mail->SMTPAuth = true;
$mail->Username = 'meu_email';
$mail->Password = 'minha_senha';
$mail->From = 'meu_email';
$mail->addAddress($email);
$mail->Subject = 'Teste de envio de email';
$mail->msgHTML("<html>De: {$nome}<br/>Email: {$email}<br/>Mensagem: {$mensagem}</html>");
$mail->AltBody = "De: {$nome}\nemail: {$email}\nMensagem: {$mensagem}";

if ($mail->send()) {
	header("Location: contato.php?sucesso='Mensagem enviada com sucesso'");
} else {
	header("Location: contato.php?falha='Erro ao enviar a mensagem'");
}
die();