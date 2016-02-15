<?php

require_once 'autoload.php';

class LivroFisico extends Livro
{
    private $taxaImpressao;
    
    function getTaxaImpressao()
    {
        return $this->taxaImpressao;
    }
    
    function setTaxaImpressao($taxaImpressao)
    {
        $this->taxaImpressao = $taxaImpressao;
    }
    
    function atualizaBaseadoEm($params)
    {
        $this->setIsbn($params['isbn']);
        $this->setTaxaImpressao($params['taxa_impressao']);
        $this->setId($params['id']);
		$this->setNome($params['nome']);
		$this->setPreco($params['preco']);
		$this->setDescricao($params['descricao']);
		$this->setCategoria(new Categoria());
		$this->getCategoria()->setId($params['categoria_id']);
		$this->getCategoria()->setNome($params['categoria_nome']);
		$this->setUsado($params['usado']);
		$this->setTipoProduto($params['tipo_produto']);
    }
}