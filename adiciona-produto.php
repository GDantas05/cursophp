<?php require_once("cabecalho.php"); ?>
<?php require_once("conecta.php"); //ARQUIVO QUE FAZ A CONEXÃO COM O BANCO?>
<?php //require_once("banco-produto.php"); ?>
<?php require_once("logica-usuario.php"); 
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

		 $inseriuProduto = $dao->insereProduto($produto);

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