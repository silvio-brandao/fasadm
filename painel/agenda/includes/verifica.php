<?ob_start(); //linha 2 

session_start(); 
 
$lar_login = $_SESSION['id'] ;	 
$lar_nome = $_SESSION['nome'];

if(!empty($_GET["sair"])){
	
 	unset ($_SESSION['id']);
	//ALTERADO
	echo "<META HTTP-EQUIV='REFRESH' CONTENT='0; URL=../index.php'>"; die(); 
}

?>