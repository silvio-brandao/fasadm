<?php

session_start();
//echo $_GET['id'];
//-------------------banco de dados---------------------//
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
	//-------------------banco de dados---------------------//	
$ultimoRelatorio = "vazio";
	
	$query = ("SELECT REP_CODIGO FROM tb_report			
				ORDER BY REP_CODIGO DESC LIMIT 1");
			//UF	Minic�pio	N�mero	Bairro	CEP	TELEFONE
			
			
			$resultado = $mysqli->query($query); 
			
			if(mysqli_num_rows($resultado) > 0)
			{  	
				while($row = $resultado->fetch_array())
				{
					$ultimoRelatorio = $row['REP_CODIGO'];
				}
			}
			
			
	
	



echo " <meta charset='Windows-1252'>";	
 
 //echo $_GET['mail'];
 
 
  
 


// Use este require se você usou o Git
require 'PHPMailer/PHPMailerAutoload.php';
 



/* #########################
 * # CONFIGURAÇÕES BÁSICAS # 
 * #########################
 */
$assunto = 'Novo Relatório Criado | FAS Manutenção';


$text = '<div id=":zr" class="a3s" style="overflow: hidden;"><u></u>
        
        <div marginwidth="0" marginheight="0">
<table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%">
<tbody><tr>
<td align="center" valign="top">
<table border="0" cellpadding="0" cellspacing="0" width="698">
<tbody><tr>
<td align="center" valign="top" style="border:1px solid #c7c7c7;border-top:none;border-bottom:none">
<table border="0" cellpadding="0" cellspacing="0" width="698">
<tbody><tr>
<td>
<img src="http://fasmanutencao.com.br/painel/images/logo.jpg" style="width:130px;" /> 
</td>
</tr>
</tbody></table>
</td>
</tr>
<tr>
<td valign="top" style="border:1px solid #c7c7c7;border-top:none">
<table border="0" cellpadding="0" cellspacing="0" width="698">
<tbody><tr>
<td valign="top" width="75%">
<table border="0" cellpadding="0" cellspacing="0" width="100%">
<tbody><tr>
<td valign="top">
<table border="0" cellpadding="30" cellspacing="0" width="100%">
<tbody><tr>
<td valign="top">
<table border="0" cellpadding="0" cellspacing="0" width="100%">
<tbody><tr>
<td valign="top" style="line-height:150%;color:#5e5e5e;font-size:14px;font-family:Arial;text-align:left">
<div>
O usuário '.$_SESSION['nome'].', <br>
<br>

acaba de gerar um novo relatório com o nº '.$ultimoRelatorio .'<br>
<br>

<br>
<br>
 
Favor acesse <a href="www.fasmanutencao.com.br"> www.fasmanutencao.com.br </a> para mais informações.<br>
<br>


Atenciosamente<br>
FAS MANUTENÇÃO
<br>
</div>
</td>
</tr>
</tbody></table>
</td>
</tr>
</tbody></table>
</td>
</tr>
</tbody></table>
</td>
</tr>
</tbody></table>
</td>
</tr>
<tr>
<td colspan="2" valign="middle" style="text-align:center;font-family:Arial">
<br>
<text style="color:#b1b1b1;font-weight:normal;text-decoration:none;font-size:14px" >&nbsp;&nbsp;&nbsp;&nbsp;FAS Manutenção</text>


<a style="color:#b1b1b1;font-weight:normal;text-decoration:none;font-size:14px">&nbsp;&nbsp;&nbsp;&nbsp;</a>
<br><br>
</td>
</tr>
</tbody></table>
</td>
</tr>
</tbody></table><div class="yj6qo"></div><div class="adL">
</div></div><div class="adL">

</div></div>';

// echo "teste".$_SESSION['nome']; die(); 
$mensagem = $text;

$Mailer = new PHPMailer();
 //$mail->SmtpClose();
// define que será usado SMTP
$Mailer->IsSMTP();
 
// envia email HTML
$Mailer->isHTML(true);

$Mailer->SMTPAuth = true;
$Mailer->SMTPSecure = false;
$Mailer->Host = 'send.one.com';
$Mailer->Port = 25;
$Mailer->Username = 'fernando@fasmanutencao.com.br';
$Mailer->Password = 'nazadeyse';
 
// E-Mail do remetente (deve ser o mesmo de quem fez a autenticação
// nesse caso seu_login@gmail.com)
$Mailer->From = 'fernando@fasmanutencao.com.br';
// Nome do remetente
$Mailer->FromName = 'FAS Manutenção - Fernando';

/* Configura os destinatários (pra quem vai o email) */
$Mailer->AddAddress('fernando@fasmanutencao.com.br', 'Fernando');  
$Mailer->AddCC('fernando@fasmanutencao.com.br', 'FAS MANUTENÇÃO');

$Mailer->AddAddress('adm@fasmanutencao.com.br', 'Deyse');  
$Mailer->AddCC('adm@fasmanutencao.com.br', 'DEYSE');
 

$Mailer->CharSet = 'UTF-8'; // Charset da mensagem (opcional)
 
/* Configura o texto e assunto */
$Mailer->Subject  = $assunto; // Assunto da mensagem
$Mailer->Body = $mensagem; // A mensagem em HTML
$Mailer->AltBody = trim(strip_tags($mensagem)); // A mesma mensagem em texto puro
//$Mailer->AddAttachment('./arquivos/'.md5("OS_".$_GET['id']."").'_OS_'.$_GET['id'].'.html');
  
   
/* Configura o anexo a ser enviado (se tiver um) */
//$Mailer->AddAttachment("foto.jpg", "foto.jpg");  // Insere um anexo
 
// verifica se enviou corretamente
if ($Mailer->Send())
{
	//echo "Enviado com sucesso";
}
else
{
	//echo 'Erro do PHPMailer: ' . $Mailer->ErrorInfo;
}
 

	//echo "<META HTTP-EQUIV='REFRESH' CONTENT='0; URL=reports.php?sended=sended'>";
	//die(); 
?>