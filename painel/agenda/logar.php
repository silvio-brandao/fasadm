<?php 
session_start();
require_once 'functions.php';

$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "odontologica";



// Create connection
$mysqli  = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($mysqli ->connect_error) {
    header("Location: login.php?err=db");
}
		
/* change character set to utf8 */
if (!$mysqli->set_charset("utf8")) {
    printf("Error loading character set utf8: %s\n", $mysqli->error);
    exit();
}
	  
	
 //resgata variáveis do formulário
$login = isset($_POST['usuario']) ? $_POST['usuario'] : '';
$senha = isset($_POST['senha']) ? $_POST['senha'] : '';

//echo $login; die();

$query = "SELECT USU_ID, USU_USUARIO, USU_SENHA,  USU_NOME  FROM tb_usuario WHERE USU_USUARIO = '".$login."' AND (USU_SENHA = '".$senha."' OR USU_SENHA = '".md5($senha)."')"; 
//echo $query; die();
$resultado = $mysqli->query($query); 
 
if(mysqli_num_rows($resultado) > 0) 
{  	

	while($row = $resultado->fetch_array())
	{	
		
		$_SESSION['logged_in'] = true;
		$_SESSION['user_id'] = $row['USU_ID'];
		$_SESSION['user_name'] = $row['USU_NOME']; 
			
		header('Location: index.php');
		break;
	}	
	
	$resultado->close(); 

}else{
	header("Location: login.php?err=err");
}	
		
$resultado->close(); 


?>
