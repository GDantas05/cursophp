<?php require_once("cabecalho.php"); ?>	
<?php 
	  require_once("conecta.php");
	  require_once("banco-categoria.php");

	  $categorias = listaCategorias($conexao);
 ?>		
<h1>Formulário de Cadastro</h1>
<form action="adiciona-produto.php" method="post">
	<div class="form-group">
		<label>Nome: </label>
		<input type="text" name="nome" class="form-control">
	</div>
	<div class="form-group">
		<label>Preço: </label>
		<input type="number" name="preco" class="form-control">
	</div>
	<div class="form-group">
		<label>Categoria: </label>
		<select name="categoria_id" class="form-control">
			<?php foreach ($categorias as $categoria) : ?>
					<option value="<?= $categoria['id'] ?>">
						<?= $categoria['nome'] ?>
					</option>
		    <?php endforeach ?>
		</select>
	</div>
	<div class="form-group">
		<label>Descrição </label>
		<textarea name="descricao" cols="30" rows="10" class="form-control"></textarea>
	</div>
	<div class="form-group">
		<label>Usado? </label>
		<input type="checkbox" name="usado" value="true">
	</div>
	<div class="form-group">
		<input type="submit" name="cadastrar" class="btn btn-primary" value="Cadastrar">
	</div>
</form>
<?php require_once("rodape.php"); ?>			