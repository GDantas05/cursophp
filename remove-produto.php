<?php 
	require_once("conecta.php");
	require_once("banco-produto.php");

	$id = $_POST['id'];
	$resultado = removeProduto($conexao, $id);

	if($resultado) {
		header("Location:produto-lista.php?removido=true");
	} else {
		header("Location:produto-lista.php?removido=false");
	}
 ?>