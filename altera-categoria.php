<?php
  require_once("cabecalho.php");
  require_once("conecta.php"); //ARQUIVO QUE FAZ A CONEXÃO COM O BANCO
  require_once("banco-categoria.php");
  require_once("logica-usuario.php");
  require_once("categoria.php");
  verificaUsuario();

  $categoria = new Categoria();

  $categoria->setId($_POST['id']);
  $categoria->setNome($_POST['nome']);

  $alterouCategoria = alteraCategoria($conexao, $categoria);

  if ($alterouCategoria) {
    header("Location:categoria-formulario-listagem.php?alterado=true");
  } else {
    header("Location:categoria-formulario-listagem.php?alterado=false");
  }
