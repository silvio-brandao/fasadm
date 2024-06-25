<?php
session_start();	
 
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
 
	
	
	if(!empty($_GET['generate']))
	{
		$query = "SELECT * FROM tb_orcamentos INNER JOIN tb_clientes ON ORC_CLIENTE = CLI_CODIGO WHERE ORC_CODIGO = '".$_GET['generate']."' ";
			
		$resultado = $mysqli->query($query); 
		$row = $resultado->fetch_array(); 
	}

$name = './arquivos/'.md5("ORC_".$_GET['generate']."").'_ORC_'.$_GET['generate'].'.html';
$text = ('

<html moznomarginboxes mozdisallowselectionprint>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Portal | FAS</title>
<style type="text/css">

td {
	font-size: 13px;
	font-family: Arial;
}

.medio {
	font-size: 14px;
	font-family: Arial;
}

.grande {
	font-size: 16px;
	font-family: Arial;
}
@media print{
    .divprint{
		display:none;
	}
    
}

</style>
<table style="width: 800px;" cellspacing="0"> 	
  
<tr> 
	<td colspan="3"  style="border-bottom:1px solid #000;   vertical-align: top; border-top: 1px solid #000; border-left: 1px solid #000; ">
		<img src="http://'.$_SERVER['HTTP_HOST'].'/painel/images/logoRelatorio.jpg" style="width:220px;" /> 
	</td>
	<td colspan="3"  class="medio" style="border-left: 1px solid #000; border-bottom: 1px solid #000;  border-top: 1px solid #000; border-right: 1px solid #000; ">
		<b>  FAS MANUTENÇÃO DE MÁQUINAS INJETORAS</b></br>
		<b>CNPJ:</b> 23.112.594/0001-28 </br>
		<b>IE:</b> 90702288-98 </br></br>
		Rua Alcebíades Plaisant N° 612, Água Verde, Curitiba/PR 80620-270</br></br>
		<b>Contato: </br></b>(41) 9 9635-3853  - adm@fasmanutencao.com.br
	</td>	
	<td class="pequeno" style="  border-top: 1px solid #000;  border-bottom: 1px solid #000; border-right: 1px solid #000; " >
		<b class="medio">RELATÓRIO DE ORÇAMENTO </b>
		<br><br>
		<span  style="  margin-bottom: 10px;"><b>Nº</b><b><span style="    margin-left: 10px;  ">'.$row["ORC_CODIGO"].'</span></b></span>
		<br>
		<div style="padding-top: 5px;">'.dtoc($_GET['data']).'	</div>
	</td>
</tr>

</table>

<table  style="width: 800px;  border-bottom: 1px solid #000; border-left: 1px solid #000; border-right: 1px solid #000; "  cellspacing="0" > 
<tr>
	<td class="medio"><b>Cliente:</b></td>
	<td>'.$row["CLI_NOME"].'</td>
	<td class="medio"><b>CNPJ/CPF:</b></td>
	<td>'.$row["CLI_CNPJRG"].'</td>
	<td></td>
</tr>
<tr >
	<td class="medio"><b>Cidade:</b></td>
	<td>'.$row["CLI_MUN"].'</td>
	<td class="medio" ><b>UF:</b></td>
	<td>'.$row["CLI_ESTADO"].'</td>
	<td></td>
</tr>
<tr >
	<td class="medio"><b>Máquina:</b></td>
	<td>'.$row["ORC_MAQUINA"].'</td>
	
	<td class="medio"><b>Modelo:</b></td>
	<td>'.$row["ORC_MODMAQUINA"].'</td>
</tr>
<tr>
	<td class="medio"></b></td>
	<td></td>	
	<td class="medio"><b>Nº Máquina:</b></td>
	<td>'.$row["ORC_NUMMAQUINA"].'</td>
	<td></td>	
</tr>

</table>

<table  style="width: 800px;  border-bottom: 1px solid #000; border-left: 1px solid #000; border-right: 1px solid #000; "  cellspacing="0" > 
<tr style="height: 100px;" >
	<td style="width: 250px;" class="medio" ><b>Defeitos:</b></td>
	<td>
			'.nl2br($row["ORC_DEFEITOS"]).'
	</td>
	
</tr>
</table>

<table  style="width: 800px;  border-bottom: 1px solid #000; border-left: 1px solid #000; border-right: 1px solid #000; "  cellspacing="0" > 
<tr style="height: 100px;" >
	<td style="width: 250px;" class="medio" ><b>Descrição do Orçamento:</b></td>
	<td>
			'.nl2br($row["ORC_DESCRICAO"]).'
	</td>
	
</tr>
</table>'.

/*<table  style="width: 800px;  border-bottom: 1px solid #000; border-left: 1px solid #000; border-right: 1px solid #000; "  cellspacing="0" > 
<tr style="height: 100px;" >
	<td style="width: 250px;" class="medio" ><b>Descrição do Trabalho a ser Executado:</b></td>
	<td>
			'.nl2br($row["ORC_SOLUCAO"]).'
	</td>
	
</tr>
</table>*/'
<table  style="width: 800px;  border-bottom: 1px solid #000; border-left: 1px solid #000; border-right: 1px solid #000; "  cellspacing="0" > 
<tr style="height: 100px;" >
	<td style="width: 250px;" class="medio" ><b>Lista de Materiais que deverão ser adquididos pelo cliente:</b></td>
	<td>
			'.nl2br($row["ORC_MATERIAIS"]).'
	</td>
	
</tr>
</table>
</table>
<table  style="width: 800px;  border-bottom: 1px solid #000; border-left: 1px solid #000; border-right: 1px solid #000; "  cellspacing="0" > 
<tr style="height: 100px;" >
	<td style="width: 250px;" class="medio" ><b>Total de Dias:</b></td>
	<td>
			'.nl2br($row["ORC_DIAS"]).'
	</td>
	
</tr>
</table>
<table  style="width: 800px;  border-bottom: 1px solid #000; border-left: 1px solid #000; border-right: 1px solid #000; "  cellspacing="0" > 
<tr style="height: 100px;" >
	<td style="width: 250px;" class="medio" ><b>Condição de Pagamento:</b></td>
	<td>
			'.nl2br($row["ORC_PRAZOPAGAMENTO"]).'
	</td>
	
</tr>
</table>

');

if($_SESSION['permissao'] == '1'){
$text = $text .= ('

<table  style="width: 800px;  border-bottom: 1px solid #000; border-left: 1px solid #000; border-right: 1px solid #000; "  cellspacing="0" > 
<tr >
	<td align=center style="  border-bottom: 1px solid #000;  " class="medio" ><b>Total do Serviço R$:</b></td>	
	
</tr>

<tr >
	<td align=center style="   "> <p> '.$row["ORC_TOTAL"].'</td>	
	
</tr>
</table>
');
}


$text = $text .= ('


</br></br>
		<div class="divprint">
			<input type="button" id="btnprint" name="btnprint" value="Imprimir/Salvar em PDF" onclick="print();"; /></br>
			<span>Caso queira salvar em pdf, escolha a impressora PDF. </span></br>
		</div>
</head>

</body >

<script>
 function(){ 
	
 window.print();
 }



</html>

');

$file = fopen($name, 'w');

fwrite($file, $text);
fclose($file);
if(!empty($_GET['send'])){
	echo '<meta http-equiv="Refresh" content="0; url=orcamentos.php?send='.$_GET['generate'].'\>';	
}else{
	echo '<meta http-equiv="Refresh" content="0; url='.$name.'">';
}
function dtoc($data)
{
  if(trim($data) <> ''){
    $datafmt = substr($data,6,2) . '/' . substr($data,4,2) . '/' . substr($data,0,4);
  }else{
    $datafmt = '';
  }
  return $datafmt;
}


 /*echo "<pre>";
 print_r($_SERVER);
echo "</pre>";*/
?>