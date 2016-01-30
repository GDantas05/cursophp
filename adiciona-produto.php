<?php require_once("cabecalho.php"); ?>
<?php require_once("conecta.php"); //ARQUIVO QUE FAZ A CONEXÃO COM O BANCO?>
<?php require_once("banco-produto.php"); ?>
<?php require_once("logica-usuario.php"); 
	  require_once("produto.php");
	  verificaUsuario();
?>
	 
	 <?php 
	 	 $produto = new Produto();
	 	 $produto->setNome($_POST["nome"]);
		 $produto->setPreco($_POST["preco"]);
		 $produto->setDescricao($_POST["descricao"]);
		 $produto->setCategoria($_POST["categoria_id"]);
		 $produto->setUsado($_POST["usado"]);

		 $inseriuProduto = insereProduto($conexao, $produto);

		 if ($inseriuProduto) {
			echo "<p class='alert-success'>Produto {$produto->getNome()}, R$ {$produto->getPreco()} adicionado com sucesso</p>";
		 } else {
			echo "<p class='alert-danger'>Erro ao cadastrar o produto {$produto->getNome()}</p>";
		 }

		 //SEMPRE LEMBRAR DE FECHAR A CONEXÃO
		 mysqli_close($conexao);
	 ?>
	 <!--<p>Produto <?= $nome; ?>, R$ <?= $preco ?> adicionado com sucesso!</p>-->
<?php require_once("rodape.php"); ?>