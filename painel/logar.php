<?php
session_start();
$servername = "fasmanutencao.com.br.mysql";
$username = "fasmanutencao_com_br";
$password = "nazadeyse";
$dbname = "fasmanutencao_com_br";

// Create connection
$mysqli  = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($mysqli ->connect_error) {
    die("Connection failed: " . $mysqli ->connect_error);
}
		
/* change character set to utf8 */
if (!$mysqli->set_charset("utf8")) {
    printf("Error loading character set utf8: %s\n", $mysqli->error);
    exit();
}

$login = $_POST["frmlogin"];
$senha = $_POST["frmsenha"];

//echo $login; die();

$query = "SELECT USU_ID, USU_USUARIO, USU_SENHA, USU_PERMISSAO, USU_NOME, USU_DESC_CLI, USU_CLIENTE  FROM tb_usuario WHERE USU_USUARIO = '".$login."' AND (USU_SENHA = '".$senha."' OR USU_SENHA = '".md5($senha)."')"; 

$resultado = $mysqli->query($query); 

if(mysqli_num_rows($resultado) > 0)
{  	
	while($row = $resultado->fetch_array())
	{	
		$_SESSION['logged_in'] = true;
		$_SESSION['uid'] = $row['USU_ID'];
		$_SESSION['nome'] = $row['USU_NOME'];
		$_SESSION['usuario'] = $row['USU_USUARIO'];
		$_SESSION['senha'] = $row['USU_SENHA'];	
		$_SESSION['permissao'] = $row['USU_PERMISSAO'];
		$_SESSION['cliente'] = $row['USU_DESC_CLI'];
		$_SESSION['clientecod'] = $row['USU_CLIENTE'];
	}
	/*ECHO "<pre>";
		print_r ($_SESSION);
	echo "</pre>";	
	*/
	header("Location: start.php");
}else{
	header("Location: index.php?err=err");
}


$resultado->close(); 
unset($obj); 
unset($sql); 
unset($query); 
    

?>
