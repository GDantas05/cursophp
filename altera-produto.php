<?php

    require_once("cabecalho.php");
	require_once("conecta.php"); //ARQUIVO QUE FAZ A CONEXÃO COM O BANCO
	//require_once("banco-produto.php");
    require_once("logica-usuario.php");
    require_once("autoload.php");
	  //require_once("produto.php");
	verificaUsuario();
?>

	 <?php
	 	 $tipoProduto = $_POST['tipo_produto'];
	 	 
	 	 $factory = new ProdutoFactory();
	 	 $produto = $factory->criaPor($tipoProduto);
	 	 $produto->atualizaBaseadoEm($_POST);
		 
		 $dao = new ProdutoDAO($conexao);

		 $alterouProduto = $dao->alteraProduto($produto);

		 if ($alterouProduto) {
			echo "<p class='alert-success'>Produto {$produto->getNome()}, R$ {$produto->getPreco()} alterado com sucesso</p>";
		 } else {
			echo "<p class='alert-danger'>Erro ao alterar o produto {$produto->getNome()}</p>";
		 }

	 ?>

<?php require_once("rodape.php"); ?>
