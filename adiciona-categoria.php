<?php require_once("cabecalho.php"); ?>
<?php require_once("conecta.php"); //ARQUIVO QUE FAZ A CONEXÃO COM O BANCO?>
<?php require_once("banco-categoria.php"); ?>
<?php require_once("autoload.php");//require_once("categoria.php") ?>

<?php 
	$categoria = new Categoria();
	$categoria->setNome($_POST['nome']);

	$inseriuCategoria = insereCategoria($conexao, $categoria);

	if($inseriuCategoria) {
		header("Location:categoria-formulario-listagem.php?cadastrado=true");
	} else {
		header("Location:categoria-formulario-listagem.php?cadastrado=false");
	}
 ?>