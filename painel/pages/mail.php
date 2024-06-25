<?php
//echo $_GET['id'];

echo " <meta charset='Windows-1252'>";	
 
 //echo $_GET['mail'];
 $destinatario = $_GET['mail'];
 
  if(!$destinatario){
	 echo "<META HTTP-EQUIV='REFRESH' CONTENT='0; URL=reports.php?mailnot=mailnot'>";
	die();
	 
 }
 
$nomeDestinatario = $_GET['nome'];  

// Use este require se você usou o Git
require 'PHPMailer/PHPMailerAutoload.php';
 



/* #########################
 * # CONFIGURAÇÕES BÁSICAS # 
 * #########################
 */
$assunto = 'Ordem de Serviço '.$_GET['id'].' | FAS Manutenção';


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
<img src="http://fasmanutencao.com.br/painel/images/logonovo.jpg" style="width:200px;" /> 
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
Caro(a) cliente '.$_GET["nome"].', <br>
<br>

você está recebendo, em anexo, o relatório da Ordem de Serviço nº '.$_GET["id"].'<br>
<br>

<br>
<br>

Observe que é possível salvar o anexo como pdf utilizando o seu navegador de internet.<br>
<br>

Em caso de dúvidas, por gentileza entre em contato pelo email adm@fasmanutencao.com.br <br>
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
$Mailer->AddAddress($destinatario, $nomeDestinatario);
$Mailer->AddCC('fernando@fasmanutencao.com.br', 'FAS MANUTENÇÃO');
$Mailer->AddCC('adm@fasmanutencao.com.br', 'Administrador');
 

$Mailer->CharSet = 'UTF-8'; // Charset da mensagem (opcional)
 
/* Configura o texto e assunto */
$Mailer->Subject  = $assunto; // Assunto da mensagem
$Mailer->Body = $mensagem; // A mensagem em HTML
$Mailer->AltBody = trim(strip_tags($mensagem)); // A mesma mensagem em texto puro
$Mailer->AddAttachment('./arquivos/'.md5("OS_".$_GET['id']."").'_OS_'.$_GET['id'].'.html');
  
   
/* Configura o anexo a ser enviado (se tiver um) */
//$Mailer->AddAttachment("foto.jpg", "foto.jpg");  // Insere um anexo
 
// verifica se enviou corretamente
if ($Mailer->Send())
{
	echo "Enviado com sucesso";
}
else
{
	echo 'Erro do PHPMailer: ' . $Mailer->ErrorInfo;
}
 

	//echo "<META HTTP-EQUIV='REFRESH' CONTENT='0; URL=reports.php?sended=sended'>";
	die(); 
?>