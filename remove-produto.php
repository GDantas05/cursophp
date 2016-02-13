<?php 
	require_once("conecta.php");
	//require_once("banco-produto.php");
	require_once("autoload.php");

	$id = $_POST['id'];
	$dao = new ProdutoDAO($conexao);
	$resultado = $dao->removeProduto($id);

	if($resultado) {
		header("Location:produto-lista.php?removido=true");
	} else {
		header("Location:produto-lista.php?removido=false");
	}
 ?>