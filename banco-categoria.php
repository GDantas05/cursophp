<?php 
	function listaCategorias($conexao)
	{
		$categorias = array();
		$query = "select * from categorias";
		$resultado = mysqli_query($conexao, $query);

		while ($categoria = mysqli_fetch_assoc($resultado)) {
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