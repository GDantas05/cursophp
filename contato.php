<?php require_once 'cabecalho.php'; ?>

<?php if (array_key_exists('sucesso', $_GET)) : ?>
	  	<p class="alert-success"><?php $_GET['sucesso']; ?></p>
<?php endif ?>
<?php if (array_key_exists('falha', $_GET)) : ?>
	  	<p class="alert-danger"><?php $_GET['falha']; ?></p>
<?php endif ?>

<form action="envia-contato.php" method="post">
	<div class="form-group">
		<label>Nome: </label>
		<input type="text" name="nome" class="form-control">
	</div>
	<div class="form-group">
		<label>Email: </label>
		<input type="email" name="email" class="form-control">
	</div>
	<div class="form-group">
		<label>Mensagem: </label>
		<textarea class="form-control" name="mensagem" cols="30" rows="10"></textarea>
	</div>
	<button type="submit" class="btn btn-primary">Enviar</button>
</form>

<?php require_once 'rodape.php'; ?>