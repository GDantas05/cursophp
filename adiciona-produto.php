<?php require_once("cabecalho.php"); ?>
<?php require_once("conecta.php"); //ARQUIVO QUE FAZ A CONEXÃO COM O BANCO?>
<?php require_once("banco-produto.php"); ?>
<?php require_once("logica-usuario.php"); 
	  verificaUsuario();
?>
	 
	 <?php 
	 	 $nome         = $_POST["nome"];
		 $preco        = $_POST["preco"];
		 $descricao    = $_POST["descricao"];
		 $categoria_id = $_POST["categoria_id"];
		 //$usado        = $_POST["usado"];
		 
		 if(array_key_exists("usado", $_POST)) {
		 	$usado = "true";	
		 } else {
		 	$usado = "false";
		 }

		 $inseriuProduto = insereProduto($conexao, $nome, $preco, $descricao, $categoria_id, $usado);

		 if ($inseriuProduto) {
			echo "<p class='alert-success'>Produto {$nome}, R$ {$preco} adicionado com sucesso</p>";
		 } else {
			echo "<p class='alert-danger'>Erro ao cadastrar o produto {$nome}</p>";
		 }

		 //SEMPRE LEMBRAR DE FECHAR A CONEXÃO
		 mysqli_close($conexao);
	 ?>
	 <!--<p>Produto <?= $nome; ?>, R$ <?= $preco ?> adicionado com sucesso!</p>-->
<?php require_once("rodape.php"); ?>