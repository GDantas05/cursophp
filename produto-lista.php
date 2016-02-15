<?php require_once("cabecalho.php"); ?>
<?php require_once("conecta.php"); //ARQUIVO QUE FAZ A CONEXÃO COM O BANCO?>
<?php //require_once("banco-produto.php") ?>
<?php require_once("logica-usuario.php"); ?>
<?php require_once("autoload.php");  ?>
<?php 
	  $dao = new ProdutoDAO($conexao);
	  $produtos = $dao->listaProdutos($conexao);
	  verificaUsuario();
?>

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
			<th>Tipo do Produto</th>
			<th>Usado?</th>
			<th>ISBN</th>
			<th>Watermark</th>
			<th>Taxa de Impressão</th>
			<th>Valor sem Imposto</th>
			<th></th>
			<th></th>
		</tr>
		<?php foreach ($produtos as $produto): ?>
		<tr>
			<td><?= $produto->getNome() ?></td>
			<td><?= $produto->getPreco() ?></td>
			<td><?= substr($produto->getDescricao(), 0, 40) ?></td>
			<td><?= $produto->getCategoria()->getNome() ?></td>
			<td><?= $produto->getTipoProduto() ?></td>
			<td><?php if($produto->getUsado() == 1) {
							echo "Sim";
					  } else {
					  		echo "Não";
				        } ?>
			</td>
			<td><?php if ($produto->temIsbn()):?> 
						<?= $produto->getIsbn(); ?>
			   <?php endif ?>
			</td>
			<td> <?php if ($produto->temWaterMark()): ?>
							aaaaa<?= $produto->getWaterMark(); ?>
				 <?php endif ?>			
			</td>
			<td> <?php if ($produto->temTaxaImpressao()): ?>
							<?= $produto->getTaxaImpressao(); ?>
				 <?php endif ?>			
			</td>
			<td><?= $produto->calculaImposto() ?></td>
			<td><a href="produto-formulario.php?id=<?= $produto->getId() ?>" class="btn btn-primary">Altera</a></td>
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
