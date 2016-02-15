<?php

require_once 'autoload.php';

class Ebook extends Livro
{
    private $waterMark;
    
    function getWaterMark()
    {
        return $this->waterMark;
    }
    
    function setWaterMark($waterMark)
    {
        $this->waterMark = $waterMark;
    }
    
    function atualizaBaseadoEm($params)
    {   
        
        $this->setIsbn($params['isbn']);
        $this->setWaterMark($params['watermark']);
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