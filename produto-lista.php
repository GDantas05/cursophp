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
			<th>10% Desconto</th>
			<th></th>
		</tr>
		<?php foreach ($produtos as $produto): ?>
		<tr>
			<td><?= $produto->getNome() ?></td>
			<td><?= $produto->getPreco() ?></td>
			<td><?= substr($produto->getDescricao(), 0, 40) ?></td>
			<td><?= $produto->getCategoria()->getNome() ?></td>
			<td><?php if($produto->getUsado() == 1) {
							echo "Sim";
					  } else {
					  		echo "Não";
				        } ?>
			</td>
			<td><?= $produto->subtraiDesconto(0.1) ?></td>
			<td>
				<form action="remove-produto.php" method="post">
					<input type="hidden" name="id" value="<?= $produto->getId() ?>">
					<button class="btn btn-danger">Remove</button>
				</form>
			</td>
		</tr>
		<?php endforeach ?>
	</table>

 <?php require_once("rodape.php"); ?>
