<?php require_once("cabecalho.php"); ?>
<?php require_once("conecta.php"); //ARQUIVO QUE FAZ A CONEXÃO COM O BANCO?>
<?php require_once("banco-categoria.php") ?>

<?php 
	$nome = $_POST['nome'];

	$inseriuCategoria = insereCategoria($conexao, $nome);

	if($inseriuCategoria) {
		header("Location:categoria-formulario-listagem.php?cadastrado=true");
	} else {
		header("Location:categoria-formulario-listagem.php?cadastrado=false");
	}
 ?>