<?php require_once("cabecalho.php"); ?>
<?php require_once("conecta.php"); //ARQUIVO QUE FAZ A CONEXÃO COM O BANCO?>
<?php require_once("banco-produto.php") ?>
<?php $produtos = listaProdutos($conexao); ?>

	<?php if(array_key_exists("removido", $_GET)) {
			if ($_GET['removido']) {
				echo "<p class='text-success'>Produto removido com sucesso</p>";
			} else {
				echo "<p class='text-danger'>Erro ao excluir produto</p>";
			}
		  }
	?>

	<h3>Listagem de Produtos</h3>
	<table class="table table-striped table-bordered">
		<tr>
			<th>Nome do Produto</th>
			<th>Preço</th>
			<th>Descrição</th>
			<th>Categoria</th>
			<th>Usado?</th>
			<th></th>
		</tr>
		<?php foreach ($produtos as $produto): ?>
		<tr>
			<td><?= $produto->nome ?></td>
			<td><?= $produto->preco ?></td>
			<td><?= substr($produto->descricao, 0, 40) ?></td>
			<td><?= $produto->categoria->nome ?></td>
			<td><?php if($produto->usado == 1) {
							echo "Sim";
					  } else {
					  		echo "Não";
				        } ?></td>
			<td>
				<form action="remove-produto.php" method="post">
					<input type="hidden" name="id" value="<?= $produto->id ?>">
					<button class="btn btn-danger">Remove</button>
				</form>
			</td>
		</tr>
		<?php endforeach ?>
	</table>

 <?php require_once("rodape.php"); ?>
