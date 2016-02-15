<?php

require_once 'autoload.php';

class ProdutoFactory
{
    private $classes = array("Produto", "Ebook", "LivroFisico");
    
    function criaPor($tipoProduto)
    {
        
        if (in_array($tipoProduto, $this->classes)) {
            return new $tipoProduto;
        } 
        
        return new LivroFisico();
    }
    
}