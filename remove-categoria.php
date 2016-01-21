<?php require_once("cabecalho.php"); ?>
<?php require_once("conecta.php"); //ARQUIVO QUE FAZ A CONEXÃO COM O BANCO?>
<?php require_once("banco-categoria.php") ?>

<?php 
	$id = $_POST['id'];

	$removeuCategoria = removeCategoria($conexao, $id);

	if($removeuCategoria) {
		header("Location:categoria-formulario-listagem.php?removido=true");
	} else {
		header("Location:categoria-formulario-listagem.php?removido=false");
	}
 ?>