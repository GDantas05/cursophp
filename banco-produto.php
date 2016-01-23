<?php
	function listaProdutos($conexao)
	{
		$produtos = array();
		$resultado = mysqli_query($conexao, "select p.*, 
												    c.nome as categoria_nome
												 from produtos as p,
												 	  categorias as c 
											  where p.categoria_id = c.id");

		while ($produto = mysqli_fetch_assoc($resultado)) {
			array_push($produtos, $produto);
		}

		return $produtos;
	}

	function insereProduto($conexao, $produto)
	{	
		if(array_key_exists("usado", $_POST)) {
		 	$produto->usado = "true";	
		} else {
		 	$produto->usado = "false";
		}

		$nome       = mysqli_real_escape_string($conexao, $produto->nome);
		$preco      = mysqli_real_escape_string($conexao, $produto->preco);
		$descricao  = mysqli_real_escape_string($conexao, $produto->descricao);
		$categoria  = mysqli_real_escape_string($conexao, $produto->categoria);
		$usado      = mysqli_real_escape_string($conexao, $produto->usado);

	 	$query      = "insert into produtos(nome, preco, descricao, categoria_id, usado) values ('{$nome}', {$preco}, '{$descricao}', {$categoria}, {$usado})";
	 	return mysqli_query($conexao, $query);
	}

	function removeProduto($conexao, $id)
	{
		$query = "delete from produtos where id = {$id}";
		return mysqli_query($conexao, $query);
	}