<?php 

	use PDO;	
	
	try {
		$connection = new PDO('mysql:host=fasmanutencao.com.br.mysql;dbname=fasmanutencao_com_br', "fasmanutencao_com_br", "nazadeyse") or print (mysql_error());
		$connection->query("INSERT INTO tb_log(query) VALUES ('teste')"); 
	} catch (PDOException $e) {
		echo 'Erro do Banco de Dados: ',  $e->getMessage(), "\n";
	}catch (Exception $e) { 
		echo 'Erro capturado: ',  $e->getMessage(), "\n";
	}
	 
		
		//teste insert
		
		
		
?>