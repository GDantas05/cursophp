<?php
	require_once 'produto.php';
	require_once 'categoria.php';

	function listaProdutos($conexao)
	{
		$produtos = array();
		$resultado = mysqli_query($conexao, "select p.*,
												    c.nome as categoria_nome
												 from produtos as p,
												 	  categorias as c
											  where p.categoria_id = c.id");

		while ($array = mysqli_fetch_assoc($resultado)) {
			$produto = new Produto();
			$produto->setId($array['id']);
			$produto->setNome($array['nome']);
			$produto->setDescricao($array['descricao']);
			$produto->setPreco($array['preco']);

			$categoria = new Categoria();
			$categoria->setId($array['categoria_id']);
			$categoria->setNome($array['categoria_nome']);

			$produto->setCategoria($categoria);
			$produto->setUsado($array['usado']);

			array_push($produtos, $produto);
		}

		return $produtos;
	}

	function insereProduto($conexao, $produto)
	{
		if(array_key_exists("usado", $_POST)) {
		 	$produto->setUsado("true");
		} else {
		 	$produto->setUsado("false");
		}

		$nome       = mysqli_real_escape_string($conexao, $produto->getNome());
		$preco      = mysqli_real_escape_string($conexao, $produto->getPreco());
		$descricao  = mysqli_real_escape_string($conexao, $produto->getDescricao());
		$categoria  = mysqli_real_escape_string($conexao, $produto->getCategoria());
		$usado      = mysqli_real_escape_string($conexao, $produto->getUsado());

	 	$query      = "insert into produtos(nome, preco, descricao, categoria_id, usado) values ('{$nome}', {$preco}, '{$descricao}', {$categoria}, {$usado})";
	 	return mysqli_query($conexao, $query);
	}

	function removeProduto($conexao, $id)
	{
		$query = "delete from produtos where id = {$id}";
		return mysqli_query($conexao, $query);
	}
