<?php require_once("cabecalho.php"); ?>
<?php
	  require_once("conecta.php");
	  require_once("banco-categoria.php");
	  require_once("logica-usuario.php");
	  //require_once("banco-produto.php");
	  require_once("autoload.php");
	  
	  verificaUsuario();

	  $categorias = listaCategorias($conexao);
	  $action = "adiciona-produto.php";
	  $ehAlteracao = false;
	  $produto = new LivroFisico();
	  $produto->setCategoria(new Categoria());

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
		<label>Tipo de Produto</label>
		<?php if ($produto->getTipoProduto()){ 
				if ($produto->getTipoProduto() == 'Ebook') {
					$value1 = 'Ebook';
					$label1 = 'Ebook';
					$value2 = 'LivroFisico';
					$label2 = 'Livro Físico';
				} else {
					$value1 = 'LivroFisico';
					$label1 = 'Livro Físico';
					$value2 = 'Ebook';
					$label2 = 'Ebook';
				}
		?>
				<select name="tipo_produto" class="form-control">
					<optgroup label="Livro">
						<option value="<?= $value1 ?>"><?= $label1 ?></option>
						<option value="<?= $value2 ?>"><?= $label2 ?></option>
					</optgroup>
				</select>
		<?php } else { ?>
				<select name="tipo_produto" class="form-control">
					<optgroup label="Livro">
						<option value="Ebook">Ebook</option>
						<option value="LivroFisico">Livro Físico</option>
					</optgroup>
				</select>
		<?php } ?>			
	</div>
	<div class="form-group">
		<label>ISBN</label>
		<?php if ($produto->temIsbn()){	
				$isbn = $produto->getIsbn();
			 } else {
			 	$isbn = "";
			 }
		?>
		<input type="text" name="isbn" class="form-control" value="<?= $isbn ?>">
	</div>
	<div class="form-group">
		<label>Watermark</label>
		<?php if ($produto->temWaterMark()) {
				$waterMark = $produto->getWaterMark();
			  } else {
			  	$waterMark = "";
			  }
		?>
		<input type="text" name="watermark" class="form-control" value="<?= $waterMark ?>">
	</div>
	<div class="form-group">
		<label>Taxa de Impressão</label>
		<?php if ($produto->temTaxaImpressao()) {
				$taxaImpressao = $produto->getTaxaImpressao();
			  } else {
			  	$taxaImpressao = "";
			  }
		?>
		<input type="text" name="taxa_impressao" class="form-control" value="<?= $taxaImpressao ?>">
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
