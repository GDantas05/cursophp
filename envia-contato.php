<?php 

require_once 'PHPMailerAutoload.php';

$nome  	   = $_POST['nome'];
$email 	   = $_POST['email'];
$mensagem  = $_POST['mensagem'];

$mail = new PHPMailer();

$meuEmail = getenv('USER_EMAIL');
$minhaSenha = getenv('USER_PASS');

$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->Port = 587;
$mail->SMTPSecure = 'tls';
$mail->SMTPAuth = true;
$mail->Username = $meuEmail;
$mail->Password = $minhaSenha;
$mail->From = $meuEmail;
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