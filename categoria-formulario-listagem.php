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
?>

<h1>Cadastro de Categoria</h1>
<form action="adiciona-categoria.php" method="post">
	<div class="form-group">
		<label>Categoria: </label>
		<input type="text" name="nome" class="form-control">
	</div>
	<div class="form-group">
		<input type="submit" name="cadastrar" class="btn btn-primary" value="Cadastrar">
	</div>
</form>
<br>
<table class="table table-striped table-bordered">
	<tr>
		<th>Nome Categoria</th>
		<th></th>
	</tr>
	<?php foreach ($categorias as $categoria) : ?>
	<tr>
		<td><?= $categoria['nome'] ?></td>	
		<td>
			<form action="remove-categoria.php" method="post">
				<input type="hidden" name="id" value="<?= $categoria['id'] ?>">
				<button class="btn btn-danger">Remove</button>
			</form>
		</td>
	</tr>	
	<?php endforeach ?>
</table>