<?php

    require_once("cabecalho.php");
	  require_once("conecta.php"); //ARQUIVO QUE FAZ A CONEXÃO COM O BANCO
	  require_once("banco-produto.php");
    require_once("logica-usuario.php");
	  require_once("produto.php");
	  verificaUsuario();
?>

	 <?php
	 	 $produto = new Produto();
	 	 $produto->setId($_POST["id"]);
	 	 $produto->setNome($_POST["nome"]);
		 $produto->setPreco($_POST["preco"]);
		 $produto->setDescricao($_POST["descricao"]);

		 $categoria = new Categoria();
		 $categoria->setId($_POST['categoria_id']);
		 $produto->setCategoria($categoria);
		 $usado = "false";

		 if (array_key_exists('usado', $_POST)) {
		 	$usado = "true";
		 }

		 $produto->setUsado($usado);

		 $alterouProduto = alteraProduto($conexao, $produto);

		 if ($alterouProduto) {
			echo "<p class='alert-success'>Produto {$produto->getNome()}, R$ {$produto->getPreco()} alterado com sucesso</p>";
		 } else {
			echo "<p class='alert-danger'>Erro ao alterar o produto {$produto->getNome()}</p>";
		 }

	 ?>

<?php require_once("rodape.php"); ?>
