<?php
	require_once 'categoria.php';
	
	function listaCategorias($conexao)
	{
		$categorias = array();
		$query = "select * from categorias";
		$resultado = mysqli_query($conexao, $query);

		while ($array = mysqli_fetch_assoc($resultado)) {
			$categoria = new Categoria();
			$categoria->id   = $array['id'];
			$categoria->nome = $array['nome'];
			array_push($categorias, $categoria);
		}

		return $categorias;
	}

	function insereCategoria($conexao, $nome)
	{
		$query = "insert into categorias(nome) values('{$nome}')";

		return mysqli_query($conexao, $query);
	}

	function removeCategoria($conexao, $id)
	{
		$query = "delete from categorias where id = '{$id}'";

		return mysqli_query($conexao, $query);
	}
 ?>
