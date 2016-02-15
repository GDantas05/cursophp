<?php

	require_once 'autoload.php';
	
	/**
	* Classe produto
	*/
	abstract class Produto
	{
		private $id;
		private $nome;
		private $preco;
		private $descricao;
		private $categoria;
		private $usado = false;
		private $tipoProduto;

		/*function __construct($nome, $preco)
		{
				$this->setNome($nome);
				$this->setPreco($preco);
		}

		function __destruct()
		{
			echo "Destruindo o produto ".$this->getNome();
		}*/

		function getId()
		{
			return $this->id;
		}

		function setId($id)
		{
			$this->id = $id;
		}

		function getNome()
		{
			return $this->nome;
		}

		function setNome($nome)
		{
			$this->nome = $nome;
		}

		function getPreco()
		{
			return $this->preco;
		}

		function setPreco($preco)
		{
			$this->preco = $preco;
		}

		function getDescricao()
		{
			return $this->descricao;
		}

		function setDescricao($descricao)
		{
			$this->descricao = $descricao;
		}

		function getCategoria()
		{
			return $this->categoria;
		}

		function setCategoria($categoria)
		{
			$this->categoria = $categoria;
		}

		function getUsado()
		{
			return $this->usado;
		}

		function setUsado($usado)
		{
			$this->usado = $usado;
		}
		
		function getTipoProduto()
		{
			return $this->tipoProduto;
		}
		
		function setTipoProduto($tipoProduto)
		{
			$this->tipoProduto = $tipoProduto;
		}

		function subtraiDesconto($valor)
		{
			if ($valor == null) {
				$valor = 0.05;
			}

			if ($valor > 0 && $valor < 1) {
				$this->preco -= $this->preco * $valor;
			}

			return $this->preco;
		}
		
		function temIsbn()
		{
			return ($this instanceof Ebook || $this instanceof LivroFisico);
		}
		
		function temWaterMark()
		{
			return $this instanceof Ebook;
		}
		
		function temTaxaImpressao()
		{
			return $this instanceof LivroFisico;
		}
		
		function calculaImposto()
		{
			return $this->preco - $this->preco * 0.195;
		}
		
		abstract function atualizaBaseadoEm($params);
	}
 ?>
