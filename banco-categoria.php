<?php
	require_once 'categoria.php';
	
	function listaCategorias($conexao)
	{
		$categorias = array();
		$query = "select * from categorias";
		$resultado = mysqli_query($conexao, $query);

		while ($array = mysqli_fetch_assoc($resultado)) {
			$categoria = new Categoria();
			$categoria->setId($array['id']);
			$categoria->setNome($array['nome']);

			array_push($categorias, $categoria);
		}

		return $categorias;
	}

	function insereCategoria($conexao, $categoria)
	{
		$query = "insert into categorias(nome) values('{$categoria->getNome()}')";

		return mysqli_query($conexao, $query);
	}

	function removeCategoria($conexao, $id)
	{
		$query = "delete from categorias where id = '{$id}'";

		return mysqli_query($conexao, $query);
	}
 ?>
