<?php require_once('cabecalho.php'); ?>
<?php require_once('conecta.php'); ?>
<?php require_once('banco-categoria.php'); ?>

<?php $categorias = listaCategorias($conexao); ?>

<?php if(array_key_exists("removido", $_GET)) {
		if($_GET['removido']) {
			echo "<p class='text-success'>Categoria removida com sucesso</p>";
		} else {
			echo "<p class='text-danger'>Erro ao remover a categoria, tente novamente</p>";
		}
	  }

	  if(array_key_exists("cadastrado", $_GET)) {
		if($_GET['cadastrado']) {
			echo "<p class='text-success'>Categoria cadastrada com sucesso</p>";
		} else {
			echo "<p class='text-danger'>Erro ao cadastrar a categoria, tente novamente</p>";
		}
	  }

		$categoria = new Categoria();
	  $action = "adiciona-categoria.php";

		if(array_key_exists("id", $_GET)) {
			$id           = $_GET['id'];
			$categoria    = buscaCategoria($conexao, $id);
			$action       = "altera-categoria.php";
			$ehAlteracao  = true;
		}

		if(array_key_exists("alterado", $_GET)) {
			if($_GET['alterado']) {
				echo "Categoria alterada com sucesso";
			} else {
				echo "Erro ao alterar categoria, tente novamente";
			}
		}
?>

<h1>Cadastro de Categoria</h1>
<form action=<?=$action?> method="post">
	<div class="form-group">
		<label>Categoria: </label>
		<input type="text" name="nome" class="form-control" value="<?=$categoria->getNome()?>">
	</div>
	<div class="form-group">
		<?php $botao = ($ehAlteracao) ? "value='Alterar'" : "value='Cadastrar'";  ?>
		<input type="submit" name="cadastrar" class="btn btn-primary" <?=$botao?>>

		<?php if($ehAlteracao) : ?>
			<input type="hidden" name="id" value="<?=$categoria->getId()?>">
		<?php endif ?>
	</div>
</form>
<br>
<table class="table table-striped table-bordered">
	<tr>
		<th>Nome Categoria</th>
		<th></th>
		<th></th>
	</tr>
	<?php foreach ($categorias as $categoria) : ?>
	<tr>
		<td><?= $categoria->getNome() ?></td>
		<td><a href="categoria-formulario-listagem.php?id=<?= $categoria->getId() ?>" class="btn btn-primary">Altera</a></td>
		<td>
			<form action="remove-categoria.php" method="post">
				<input type="hidden" name="id" value="<?= $categoria->getId() ?>">
				<button class="btn btn-danger">Remove</button>
			</form>
		</td>
	</tr>
	<?php endforeach ?>
</table>
