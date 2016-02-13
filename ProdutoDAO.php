<?php 

require_once 'autoload.php';

class ProdutoDAO
{

	private $conexao;

	function __construct($conexao)
	{
		$this->conexao = $conexao;
	}

	function listaProdutos()
	{
		$produtos = array();
		$resultado = mysqli_query($this->conexao, "select p.*,
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

	function insereProduto($produto)
	{
		if(array_key_exists("usado", $_POST)) {
		 	$produto->setUsado("true");
		} else {
		 	$produto->setUsado("false");
		}

		$nome       = mysqli_real_escape_string($this->conexao, $produto->getNome());
		$preco      = mysqli_real_escape_string($this->conexao, $produto->getPreco());
		$descricao  = mysqli_real_escape_string($this->conexao, $produto->getDescricao());
		$categoria  = mysqli_real_escape_string($this->conexao, $produto->getCategoria());
		$usado      = mysqli_real_escape_string($this->conexao, $produto->getUsado());

	 	$query      = "insert into produtos(nome, preco, descricao, categoria_id, usado) values ('{$nome}', {$preco}, '{$descricao}', {$categoria}, {$usado})";
	 	return mysqli_query($this->conexao, $query);
	}

	function alteraProduto($produto)
	{
		$query = "update produtos set nome='{$produto->getNome()}',".
				 " preco={$produto->getPreco()},".
				 " descricao='{$produto->getDescricao()}',".
				 " categoria_id={$produto->getCategoria()->getId()},".
				 " usado={$produto->getusado()}".
				 " where id={$produto->getId()}";
		 
		return mysqli_query($this->conexao, $query);				 
	}

	function buscaProduto($id)
	{
		
		$query = "select p.*,
					     c.nome as categoria_nome
					  from produtos as p,
					       categorias as c
				   where p.categoria_id = c.id
			         and p.id = {$id}";
        
		$resultado = mysqli_query($this->conexao, $query);

		$array = mysqli_fetch_assoc($resultado);
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
		
		return $produto;
	}

	function removeProduto($id)
	{
		$query = "delete from produtos where id = {$id}";
		return mysqli_query($this->conexao, $query);
	}
}