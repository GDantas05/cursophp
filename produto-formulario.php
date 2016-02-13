<?php require_once("cabecalho.php"); ?>
<?php
	  require_once("conecta.php");
	  require_once("banco-categoria.php");
	  require_once("logica-usuario.php");
	  //require_once("banco-produto.php");
	  require_once("autoload.php");
	  verificaUsuario();

	  $categorias = listaCategorias($conexao);
	  $produto = new Produto();
	  $produto->setCategoria(new Categoria());
	  $action = "adiciona-produto.php";
	  $ehAlteracao = false;

	  if (array_key_exists('id', $_GET)) {
	  		$id          = $_GET['id'];
	  		$dao         = new ProdutoDAO($conexao);
	  		$produto     = $dao->buscaProduto($id);
	  		$ehAlteracao = true;
	  		$action      = "altera-produto.php";
	  }
 ?>

<h1>Formulário de Cadastro</h1>
<form action=<?= $action ?> method="post">
	<div class="form-group">
		<label>Nome: </label>
		<input type="text" name="nome" class="form-control" value="<?= $produto->getNome() ?>">
	</div>
	<div class="form-group">
		<label>Preço: </label>
		<input type="number" name="preco" class="form-control" value="<?= $produto->getPreco() ?>">
	</div>
	<div class="form-group">
		<label>Categoria: </label>
		<select name="categoria_id" class="form-control">
			<?php foreach ($categorias as $categoria) : ?>
			<?php $essaEhACategoria = $produto->getCategoria()->getId() == $categoria->getId();
				  $select = $essaEhACategoria ? "selected='selected'" : "";
			?>
					<option value="<?= $categoria->getId() ?>" <?= $select ?> >
						<?= $categoria->getNome() ?>
					</option>
		    <?php endforeach ?>
		</select>
	</div>
	<div class="form-group">
		<label>Descrição </label>
		<textarea name="descricao" cols="30" rows="10" class="form-control"><?= $produto->getDescricao() ?></textarea>
	</div>
	<div class="form-group">
		<label>Usado? </label>
		<?php $usado = $produto->getUsado() ? "checked='checked'" : ""; ?>
		<input type="checkbox" name="usado" value="true" <?= $usado ?>>
	</div>
	<div class="form-group">
		<?php $botao = $ehAlteracao ? "value='Alterar'" : "value='Cadastrar'"; ?>

		<?php if ($ehAlteracao) : ?>
			<input type="hidden" name="id" value="<?= $produto->getId() ?>">
		<?php endif ?>

		<input type="submit" name="cadastrar" class="btn btn-primary" <?= $botao ?>>
	</div>
</form>
<?php require_once("rodape.php"); ?>
