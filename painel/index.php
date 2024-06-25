<?php

if(empty($_SESSION)){
	session_start();
}
require_once './pages/functions.php';
if (isLoggedIn() == 'true')      
{  
    echo '<meta http-equiv="refresh" content="0; url=./pages/index.php">'; die();
}


?>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<title>Portal | FAS</title>

<style type="text/css">

.botao {
	background: url(./images/botao_entrar.png) no-repeat;
	border: 0;
	width: 120px;
	font-family: 'Tahoma';
	color: #fff;
	font-size: 30px;
	line-height: 42px;
	cursor: pointer;
	background-size: 100%;
}
.botaoEyes {
	background: url(./images/eyes.png) no-repeat;
	border: 0;
	width: 20px;
	font-family: 'Tahoma';
	color: #fff;
	font-size: 30px;
	line-height: 20px;
	cursor: pointer;
	background-size: 100%;
}

.logologin{
	width: 100%;
}

body {
	padding: 0px;
	margin: 0px;
   	background: url(./images/background.jpg) ;
	min-height:100%; 
	min-width:100%;
}

</style>


<link rel="shortcut icon" href="favicon.ico" />


</head>

<body >

<center>

<table width="100%" height="100%" border="0">
	<tr>
		<td align="center" width="100%" valign="center">

		<!--font style="font-family: Lato, Calibri!important; font-size: 27pt; color: #573C4A">
			Acesso ao Portal FAS Manutenção
		</font>
		<br--><br>
		
		<form name="form" id="form" method="post" action="logar.php" onSubmit="document.getElementById('btnEntrar').setAttribute('disabled','disabled'); ">
		
		<table bgcolor="#FFFFFF" style="border-radius: 5px; border-collapse: collapse; border: 3px solid #E0E0E0" bordercolor="#E0E0E0" cellpadding="15" align="center" border="1" height="400px" width="600px">
		
		<tr bgcolor="#EFEFEF">
		  <td align="center">
		  
		   <table border="0" cellpadding="15" width="80%">
		   <tr>
		   <td > 
			<img  src="./images/logonovo.jpg" class="logologin">
		   </td>
		   <td align="left" width="50%">
			<font face="Arial" style="font-size: 8pt">
				Seja Bem Vindo! 
				<br><br>Qualquer dúvida entre em contato: </br></br> Telefone: <font color="#573C4A"><b> (41) 9 9635-3853</b></font> 
				</br><br>ou pelo e-mail: 
				<a href="mailto:adm@fasmanutencao.com.br?Subject=Duvida Portal FAS" style="text-decoration: none" target="_blank">
				<font color="#573C4A">
				<b>adm@fasmanutencao.com.br</b>
				</font>
				</a>
				
				</br></br>
				<br>
				<!--a href="http://servicos.fasmanutencao.one/" style="text-decoration: none" target="_blank">
				<font color="#573C4A">
				<b>Acesso ao Álbum de Fotos</b>
				</font>
				</a-->
			</font>
		   </td>
		   </table>
		  
		  </td>
		</tr>
		
		<tr>
		  <td align="center">
		  
		   <table border="0" cellpadding="10">
		   <tr>
		   <td valign="center"><img src="./images/icones/usuario_1.png"></td>
		   <td>
			<input class="form_login" placeholder="Usuário" id="frmlogin" name="frmlogin" type="text" class="input" style="border-radius: 5px; text-align: center; font-family: Calibri; font-size: 15pt; border: 1px solid #E6E6E6; width: 300px; height: 40px" >
		   </td>
		   </tr>
			<tr>
			
		   <tr>
		   <td valign="center"><img src="./images/icones/senha_1.png"></td>
		   <td>
			<input class="form_login" placeholder="Senha" id="frmsenha" name="frmsenha" type="password" class="input" style="border-radius: 5px; text-align: center; font-family: Calibri; font-size: 15pt; border: 1px solid #E6E6E6; width: 300px; height: 40px" >
		   </td>
		   <td>
			<input class="botaoEyes" name="btnLookPasswd" id="btnLookPasswd" type="button" value=" " onclick="showHidePasswd()" title="Mostrar senha"/>
		   </td>
		    </tr>
		   <? 
		   
		   if(!empty($_GET['err'])){
			?>
			<tr>
				<td colspan="2" style="    text-align: center; font-family: monospace; padding-left: 75px;" >
					Login ou Senha incorreto...
			   </td>
			 </tr>	
			
		   <?
		   }
		   
		   ?>
		   
		   </table>
		  
		  </td>
		</tr>
		<?php
		$erro = "";
		$bgcolor = "";
		if($erro == 'invalido'){
			$bgcolor = "#FFD5D5";
		}
		?>
		<tr bgcolor="<?php echo $bgcolor; ?>">
		  <td align="center">
		  
		   <?php
		   if($erro == 'invalido'){
				echo '<font color="#FF0000" face="Arial" style="font-size: 8pt">';
				echo '<br><b>Ocorreu um erro na sua autenticação, gentileza verificar!</b><br><br>';
				echo '</font>';
		   }
		   ?>
		  
		   <input class="botao" name="btnEntrar" id="btnEntrar" type="submit" value=" " >
		  </td>
		</tr>
		
		<tr bgcolor="#EFEFEF">
			
		  <td align="center">
			<img src="./images/responsivo.png" align="center" style="    width: 80px; margin-right: 70px;" title="Este Sistema Web é Responsivo!">
			<!--img src="./images/logo_pagseguro.png" align="center" style="    width: 130px; margin-right: 70px;" title="Integrado com o PagSeguro"--> 
			<img src="./images/danna.png"  align="center"  style="width: 60px; " title="Danna Sistemas - (47) 992 297 331"/><span style="font-size:14px;"><span> 
  </td>
		  
		 
		</tr>
		
		
		</table>
		</form>

		</td>
	</tr>
</table>

</center>
	
</body>
	
<?php
   if($erro == 'invalido'){
     echo "<script>alert('Erro ao efetuar o login!');</script>";
   }
?>
<script>
document.getElementById("frmlogin").focus();

function showHidePasswd() {
if(document.getElementById('frmsenha').type == "password"){
    document.getElementById('frmsenha').type = 'text';}
	else{document.getElementById('frmsenha').type = 'password';}
}


</script>

</html>