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
			
			$tipoProduto = $array['tipo_produto'];
			$factory     = new ProdutoFactory();
			$produto     = $factory->criaPor($tipoProduto);
			$produto->atualizaBaseadoEm($array);
			
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
		
		$isbn = "";
		if (method_exists($produto, "getIsbn")) {
			$isbn = mysqli_real_escape_string($this->conexao, $produto->getIsbn());
		}
		
		$waterMark = "";
		if (method_exists($produto, "getWaterMark")) {
			$waterMark = mysqli_real_escape_string($this->conexao, $produto->getWaterMark());
		}
		
		$taxaImpressao = "";
		if (method_exists($produto, "getTaxaImpressao")) {
			$taxaImpressao = mysqli_real_escape_string($this->conexao, $produto->getTaxaImpressao());
		}
				
		$nome        = mysqli_real_escape_string($this->conexao, $produto->getNome());
		$preco       = mysqli_real_escape_string($this->conexao, $produto->getPreco());
		$descricao   = mysqli_real_escape_string($this->conexao, $produto->getDescricao());
		$categoria   = mysqli_real_escape_string($this->conexao, $produto->getCategoria()->getId());
		$usado       = mysqli_real_escape_string($this->conexao, $produto->getUsado());
		$tipoProduto = mysqli_real_escape_string($this->conexao, $produto->getTipoProduto());

	 	$query      = "insert into produtos(nome, preco, descricao, categoria_id, usado, isbn, tipo_produto, watermark, taxa_impressao) values ('{$nome}', {$preco}, '{$descricao}', {$categoria}, {$usado}, '{$isbn}', '{$tipoProduto}', '{$waterMark}', '{$taxaImpressao}')";
	 	
	 	return mysqli_query($this->conexao, $query);
	}

	function alteraProduto($produto)
	{
		
		if (array_key_exists("usado", $_POST)) {
			$produto->setUsado("true");
		} else {
			$produto->setUsado("false");
		}
		
		$isbn = "";
		if (method_exists($produto, "getIsbn")) {
			$isbn = $produto->getIsbn();
		}
		
		$waterMark = "";
		if (method_exists($produto, "getWaterMark")) {
			$waterMark = $produto->getWaterMark();
		}
		
		$taxaImpressao = "";
		if (method_exists($produto, "getTaxaImpressao")) {
			$taxaImpressao = $produto->getTaxaImpressao();
		}
		
		$query = "update produtos set nome='{$produto->getNome()}',".
				 " preco={$produto->getPreco()},".
				 " descricao='{$produto->getDescricao()}',".
				 " categoria_id={$produto->getCategoria()->getId()},".
				 " usado={$produto->getusado()},".
				 " isbn='{$isbn}',".
				 " tipo_produto = '{$produto->getTipoProduto()}',".
				 " watermark = '{$waterMark}',".
				 " taxa_impressao = '{$taxaImpressao}'".
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
		
		$tipoProduto = $array['tipo_produto'];
		$factory     = new ProdutoFactory();
		$produto     = $factory->criaPor($tipoProduto);
		$produto->atualizaBaseadoEm($array);
		
		return $produto;
	}

	function removeProduto($id)
	{
		$query = "delete from produtos where id = {$id}";
		return mysqli_query($this->conexao, $query);
	}
}