<?php
// inicia a sess�o
session_start();
 
// muda o valor de logged_in para false
$_SESSION['logged_in'] = false;
 
// finaliza a sess�o
session_destroy();
 
// retorna para a index.php
header('Location: index.php');

?>