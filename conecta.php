<?php
	
	//COMANDO PARA EXPORTAR A BASE DE DADOS: mysqldump -u root loja > dump.sql
	//COMANDO PARA IMPORTAR A BASE DE DADOS: mysqldump -u root loja < dump.sql
	$conexao = mysqli_connect('localhost', 'root', '', 'loja');
