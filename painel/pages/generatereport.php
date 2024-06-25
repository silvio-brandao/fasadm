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
	

	$query = "SELECT * FROM tb_report INNER JOIN tb_clientes ON REP_CLIENTE = CLI_CODIGO WHERE REP_CODIGO = '".$_GET['generate']."' ";

	$resultado = $mysqli->query($query); 
	$row = $resultado->fetch_array();
		
	//if(!empty($_GET['sending']))
	//{
		//if($_GET['sending'] != "true"){
		//	if(trim($row["REP_ASSINADO"]) == ""){
		//		echo "<script> alert('Esse relatório ainda não está assinado e não pode ser gerado.'); window.close(); /*window.location.assign('reports.php?')*/</script>";
			//}
			
			
		//}
	//} 
}
$mostraCustoExtra = $row['REP_MOSTRACUSTOEXTRA'] == '1' ? true : false;
$mostraDetalhado = $row['REP_DETALHADO'] == '1' ? true : false;
$name = './arquivos/'.md5("OS_".$_GET['generate']."").'_OS_'.$_GET['generate'].'.html';


$equipe1 = '';
$equipe2 = ''; 
$equipe3 = '';
$equipe4 = '';
$equipe5 = '';
$equipe6 = '';


if($row["REP_EQUIPE1"] == "1"){ $equipe1 = "1 Técnico"; }
if($row["REP_EQUIPE1"] == "2"){ $equipe1 = "1 Técnico + 1 Técnico Auxiliar"; }
if($row["REP_EQUIPE1"] == "3"){ $equipe1 = "1 Técnico Auxiliar"; }
if($row["REP_EQUIPE1"] == "4"){ $equipe1 = "2 Técnicos"; }

if($row["REP_EQUIPE2"] == "1"){ $equipe2 = "1 Técnico"; }
if($row["REP_EQUIPE2"] == "2"){ $equipe2 = "1 Técnico + 1 Técnico Auxiliar"; }
if($row["REP_EQUIPE2"] == "3"){ $equipe2 = "1 Técnico Auxiliar"; }
if($row["REP_EQUIPE2"] == "4"){ $equipe2 = "2 Técnicos"; }

if($row["REP_EQUIPE3"] == "1"){ $equipe3 = "1 Técnico"; }
if($row["REP_EQUIPE3"] == "2"){ $equipe3 = "1 Técnico + 1 Técnico Auxiliar"; }
if($row["REP_EQUIPE3"] == "3"){ $equipe3 = "1 Técnico Auxiliar"; }
if($row["REP_EQUIPE3"] == "4"){ $equipe3 = "2 Técnicos"; }

if($row["REP_EQUIPE4"] == "1"){ $equipe4 = "1 Técnico"; }
if($row["REP_EQUIPE4"] == "2"){ $equipe4 = "1 Técnico + 1 Técnico Auxiliar"; }
if($row["REP_EQUIPE4"] == "3"){ $equipe4 = "1 Técnico Auxiliar"; }
if($row["REP_EQUIPE4"] == "4"){ $equipe4 = "2 Técnicos"; }
 
if($row["REP_EQUIPE5"] == "1"){ $equipe5 = "1 Técnico"; }
if($row["REP_EQUIPE5"] == "2"){ $equipe5 = "1 Técnico + 1 Técnico Auxiliar"; }
if($row["REP_EQUIPE5"] == "3"){ $equipe5 = "1 Técnico Auxiliar"; }
if($row["REP_EQUIPE5"] == "4"){ $equipe5 = "2 Técnicos"; }

if($row["REP_EQUIPE6"] == "1"){ $equipe6 = "1 Técnico"; }
if($row["REP_EQUIPE6"] == "2"){ $equipe6 = "1 Técnico + 1 Técnico Auxiliar"; }
if($row["REP_EQUIPE6"] == "3"){ $equipe6 = "1 Técnico Auxiliar"; }
if($row["REP_EQUIPE6"] == "4"){ $equipe6 = "2 Técnicos"; }







$valorTotal = '0'; 
$custoExtra = '0';
$horaTecnicaTotal = '0';
$custoDeslocamento = '0';
$custoTempoDeslocamento = '0';
$custoRefeicao = '0';
$custoHospedagem = '0';
$custoPeças = '0';
$desconto = '0'; 


				
							if($_SESSION['permissao'] == '1'){
								//echo "tesestestestsetsetsetse";
								$valorTotal = !empty($row["REP_TOTAL"]) ? $row["REP_TOTAL"] : "0.00"; 
								$custoExtra = !empty($row["REP_CUSTOEXTRA"]) ? $row["REP_CUSTOEXTRA"] : "0.00";
								$horaTecnicaTotal = !empty($row["REP_VALHORATECNICATOTAL"]) ? $row["REP_VALHORATECNICATOTAL"] : "0.00";
								$custoDeslocamento = !empty($row["REP_CUSTODESLOCAMENTO"]) ? $row["REP_CUSTODESLOCAMENTO"] : "0.00";
								$custoTempoDeslocamento = !empty($row["REP_CUSTOTEMPODESLOCAMENTO"]) ? $row["REP_CUSTOTEMPODESLOCAMENTO"] : "0.00";
								$custoRefeicao = !empty($row["REP_CUSTOREFEICAO"]) ? $row["REP_CUSTOREFEICAO"] : "0.00";
								$custoHospedagem = !empty($row["REP_CUSTOHOSPEDAGEM"]) ? $row["REP_CUSTOHOSPEDAGEM"] : "0.00";
								$custoPeças = !empty($row["REP_CUSTOPECAS"]) ? $row["REP_CUSTOPECAS"] : "0.00";
								$desconto = !empty($row["REP_DESCONTO"]) ? $row["REP_DESCONTO"] : "0.00";
								
							} 
							
							
							/*
							function trataValorTotal(){
								
									$valorFormatado = "<script>document.write(dinheiroValorTotal)</script>";
									
									return $valorFormatado;
								
							}
							function trataCustoExtra(){
								
									$valorFormatado = "<script>document.write(dinheiroCustoExtra)</script>";
									return $valorFormatado;
								
							}
							
							function tratahoraTecnicaTotal(){
								
									$valorFormatado = "<script>document.write(dinheirohoraTecnicaTotal)</script>";
									return $valorFormatado;
								
							}
							function tratacustoDeslocamento(){
								
									$valorFormatado = "<script>document.write(dinheirocustoDeslocamento)</script>";
									return $valorFormatado;
								
							}
							function tratacustoTempoDeslocamento(){
								
									$valorFormatado = "<script>document.write(dinheirocustoTempoDeslocamento)</script>";
									return $valorFormatado;
								
							}
							function tratacustoRefeicao(){
								
									$valorFormatado = "<script>document.write(dinheirocustoRefeicao)</script>";
									return $valorFormatado;
								
							}
							function tratacustoHospedagem(){
								
									$valorFormatado = "<script>document.write(dinheirocustoHospedagem)</script>";
									return $valorFormatado;
								
							}
							function tratacustoPecas(){
								
									$valorFormatado = "<script>document.write(dinheirocustoPecas)</script>";
									return $valorFormatado;
								
							}
							*/
							
							
						
							
//$lines = substr_count( nl2br($row['REP_SOLUCAO']), '<br />');	

//$lines = $lines + substr_count( nl2br($row['REP_DEFEITOS']), '<br />');	

//echo $lines; die(); 			

$text = ('

<script>
/*
var numeroValorTotal = "'.$valorTotal.'";
var dinheiroValorTotal = numeroValorTotal.toLocaleString("pt-br",{style: "currency", currency: "BRL"});

var numeroCustoExtra = "'.$custoExtra.'";
var dinheiroCustoExtra = numeroCustoExtra.toLocaleString("pt-br",{style: "currency", currency: "BRL"});


var numerohoraTecnicaTotal = "'.$horaTecnicaTotal.'";
var dinheirohoraTecnicaTotal = numerohoraTecnicaTotal.toLocaleString("pt-br",{style: "currency", currency: "BRL"});

var numerocustoDeslocamento = "'.$custoDeslocamento.'";
var dinheirocustoDeslocamento = numerocustoDeslocamento.toLocaleString("pt-br",{style: "currency", currency: "BRL"});

var numerocustoTempoDeslocamento = "'.$custoTempoDeslocamento.'";
var dinheirocustoTempoDeslocamento = numerocustoTempoDeslocamento.toLocaleString("pt-br",{style: "currency", currency: "BRL"});

var numerocustoRefeicao = "'.$custoRefeicao.'";
var dinheirocustoRefeicao = numerocustoRefeicao.toLocaleString("pt-br",{style: "currency", currency: "BRL"});

var numerocustoHospedagem = "'.$custoHospedagem.'";
var dinheirocustoHospedagem = numerocustoHospedagem.toLocaleString("pt-br",{style: "currency", currency: "BRL"});

var numerocustoPeças = "'.$custoPeças.'";
var dinheirocustoPecas = numerocustoPeças.toLocaleString("pt-br",{style: "currency", currency: "BRL"});


*/

 </script>

<html moznomarginboxes mozdisallowselectionprint>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Portal | FAS</title>

</head>
<style type="text/css">

td {
	font-size: 13px;
	font-family: Arial;
}
.pequeno {
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
		<b>  FAS MANUTENÇÃO DE MÁQUINAS INJETORAS </b></br>
		<b>CNPJ:</b> 23.112.594/0001-28 </br>
		<b>IE:</b> 90702288-98 </br></br>
		Rua Alcebíades Plaisant N° 612, Água Verde, Curitiba/PR 80620-270</br></br>
		<b>Contato: </br></b>(41) 9 9635-3853  - adm@fasmanutencao.com.br
	</td>	
	<td class="pequeno" style="TEXT-ALIGN: center;  border-top: 1px solid #000;  border-bottom: 1px solid #000; border-right: 1px solid #000; " >
		<b class="medio">RELATÓRIO DE ASSISTÊNCIA TÉCNICA </b>
		<br><br>
		<span  style="  margin-bottom: 10px;"><b>Nº</b><b><span style="    margin-left: 10px;  ">'.$row["REP_CODIGO"].'</span></b></span>
		<br>
		<div style="padding-top: 5px;">'.dtoc($_GET['data']).'	</div>
	</td>
</tr>

</table>

<br>
<table  style="width: 800px;  border-bottom: 1px solid #000; border-top: 1px solid #000;  border-left: 1px solid #000; border-right: 1px solid #000; "  cellspacing="0" > 
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
	<td>'.$row["REP_MAQUINA"].'</td>	
	<td class="medio"><b>Modelo:</b></td>
	<td>'.$row["REP_MODMAQUINA"].'</td>
	<td></td>
</tr>
<tr>
	<td class="medio"><b>Garantia:</b></td>
	<td>'.$row["REP_GARANTIA"].'</td>	
	<td class="medio"><b>Nº Máquina:</b></td>
	<td>'.$row["REP_NUMMAQUINA"].'</td>
	<td></td>	
</tr>
</table>

<br>

<table  style="width: 800px;  border-bottom: 1px solid #000; border-top: 1px solid #000; border-left: 1px solid #000; border-right: 1px solid #000; "  cellspacing="0" > 
<tr style="height: 100px;" >
	<td style="width: 110px;" class="medio" ><b>Problemas:</b></td>
	<td>
		'.nl2br($row["REP_DEFEITOS"]).'
	</td>
	
</tr>
</table>

<table  style="  width: 800px;  border-bottom: 1px solid #000; border-left: 1px solid #000; border-right: 1px solid #000; "  cellspacing="0" > 
<tr >
	<td style="width: 110px;" class="medio" ><b>Solução:</b></td>
	<td>
		'.nl2br($row["REP_SOLUCAO"]).'
	</td>
	
</tr>
</table>

<br> 
<table  style="width: 800px; border-top: 1px solid #000; border-bottom: 1px solid #000; border-left: 1px solid #000; border-right: 1px solid #000; "  cellspacing="0" > 
<tr >
	<td  align=center class="medio" style="height: 35px;"><b>Horários do Serviço</b></td>	
</tr>
</table>
<table  style="width: 800px;  border-bottom: 1px solid #000; border-left: 1px solid #000; border-right: 1px solid #000; "  cellspacing="0" > 
<tr >
	<td style="  border-bottom: 1px solid #000; border-right: 1px solid #000; " class="medio" ><b>Data</b></td>
	<td style="  border-bottom: 1px solid #000; border-right: 1px solid #000; " class="medio" ><b>Entrada</b></td>
	<td style="  border-bottom: 1px solid #000; border-right: 1px solid #000; " class="medio" ><b>Saída</b></td>
	<td style="  border-bottom: 1px solid #000; border-right: 1px solid #000; " class="medio" ><b>Intervalo</b></td>
	<td style="  border-bottom: 1px solid #000; " class="medio" ><b>Equipe</b></td>
	
	
</tr>
<tr >
	<td style="  border-bottom: 1px solid #000; border-right: 1px solid #000; ">&nbsp;'.dtoc($row["REP_DATA1"]).' </td>
	<td style="  border-bottom: 1px solid #000; border-right: 1px solid #000; ">&nbsp;'.$row["REP_HORAENTRADA1"].'</td>
	<td style="  border-bottom: 1px solid #000; border-right: 1px solid #000; ">&nbsp;'.$row["REP_HORASAIDA1"].'</td>
	<td style="  border-bottom: 1px solid #000; border-right: 1px solid #000; ">&nbsp;'.$row["REP_ITERVALO1"].'</td>
	<td style="  border-bottom: 1px solid #000; ">&nbsp;'.$equipe1.'</td>
	
</tr>
<tr >
	<td style="  border-bottom: 1px solid #000; border-right: 1px solid #000; ">&nbsp;'.dtoc($row["REP_DATA2"]).'</td>
	<td style="  border-bottom: 1px solid #000; border-right: 1px solid #000; ">&nbsp;'.$row["REP_HORAENTRADA2"].'</td>
	<td style="  border-bottom: 1px solid #000; border-right: 1px solid #000; ">&nbsp;'.$row["REP_HORASAIDA2"].'</td>
	<td style="  border-bottom: 1px solid #000; border-right: 1px solid #000; ">&nbsp;'.$row["REP_ITERVALO2"].'</td>
	<td style="  border-bottom: 1px solid #000; ">&nbsp;'.$equipe2.'</td>
	
</tr>
<tr >
	<td style="  border-bottom: 1px solid #000; border-right: 1px solid #000; ">&nbsp;'.dtoc($row["REP_DATA3"]).'</td>
	<td style="  border-bottom: 1px solid #000; border-right: 1px solid #000; ">&nbsp;'.$row["REP_HORAENTRADA3"].'</td>
	<td style="  border-bottom: 1px solid #000; border-right: 1px solid #000; ">&nbsp;'.$row["REP_HORASAIDA3"].'</td>
	<td style="  border-bottom: 1px solid #000; border-right: 1px solid #000; ">&nbsp;'.$row["REP_ITERVALO3"].'</td>
	<td style="  border-bottom: 1px solid #000; ">&nbsp;'.$equipe3.'</td>
	
</tr>

<tr >
	<td style="  border-bottom: 1px solid #000; border-right: 1px solid #000; ">&nbsp;'.dtoc($row["REP_DATA4"]).'</td>
	<td style="  border-bottom: 1px solid #000; border-right: 1px solid #000; ">&nbsp;'.$row["REP_HORAENTRADA4"].'</td>
	<td style="  border-bottom: 1px solid #000; border-right: 1px solid #000; ">&nbsp;'.$row["REP_HORASAIDA4"].'</td>
	<td style="  border-bottom: 1px solid #000; border-right: 1px solid #000; ">&nbsp;'.$row["REP_ITERVALO4"].'</td>
	<td style="  border-bottom: 1px solid #000; ">&nbsp;'.$equipe4.'</td>
	
	
</tr>
<tr >
	<td style="  border-bottom: 1px solid #000; border-right: 1px solid #000; ">&nbsp;'.dtoc($row["REP_DATA5"]).'</td>
	<td style="  border-bottom: 1px solid #000; border-right: 1px solid #000; ">&nbsp;'.$row["REP_HORAENTRADA5"].'</td>
	<td style="  border-bottom: 1px solid #000; border-right: 1px solid #000; ">&nbsp;'.$row["REP_HORASAIDA5"].'</td>
	<td style="  border-bottom: 1px solid #000; border-right: 1px solid #000; ">&nbsp;'.$row["REP_ITERVALO5"].'</td>
	<td style="  border-bottom: 1px solid #000; ">&nbsp;'.$equipe5.'</td>
	
</tr>


<tr >
	<td style="  border-right: 1px solid #000; ">&nbsp;'.dtoc($row["REP_DATA6"]).'</td>
	<td style="  border-right: 1px solid #000; ">&nbsp;'.$row["REP_HORAENTRADA6"].'</td>
	<td style="  border-right: 1px solid #000; ">&nbsp;'.$row["REP_HORASAIDA6"].'</td>
	<td style="  border-right: 1px solid #000; ">&nbsp;'.$row["REP_ITERVALO6"].'</td>
	<td  ">&nbsp;'.$equipe6.'</td>
	
</tr>

	
</tr>
</table>

<br>');

if($mostraCustoExtra && $_SESSION['permissao'] == '1'){
$text = $text .= ('
<table  style="width: 800px;  border-top: 1px solid #000; border-left: 1px solid #000; border-right: 1px solid #000; "  cellspacing="0" > 
<tr >
	<td  align=center class="medio" style="height: 35px;"> <b>Custos Extras</b></td>	
</tr>
</table>


<table  style="width: 800px;  border-top: 1px solid #000; border-left: 1px solid #000; border-right: 1px solid #000; "  cellspacing="0" > 
<tr >
	<td align=center style="  border-bottom: 1px solid #000; border-right: 1px solid #000; " class="medio" ><b>Custo Extra</b></td>	
	<td align=center style="  border-bottom: 1px solid #000;  " class="medio" > <p> R$&emsp;'.number_format($custoExtra, 2, ',', '.').' </td>  
</tr>


</table> 

<table  style="width: 800px;  border-bottom: 1px solid #000; border-left: 1px solid #000; border-right: 1px solid #000; "  cellspacing="0" > 
<tr style="height: 30px;" >
	
	<td>
		'.nl2br($row["REP_DESCCUSTOEXTRA"]).'
	</td>
	
</tr>
</table>

</br style="line-height: 4px;">
');

}
$text = $text .= ('

<table  style="width: 800px;  border-bottom: 1px solid #000; border-top: 1px solid #000;  border-left: 1px solid #000; border-right: 1px solid #000; "  cellspacing="0" > 
<tr >
	<td  align=center class="medio" style="height: 35px;"> <b>Valor Total</b></td>	
</tr>
</table>
<table  style="width: 800px;  border-bottom: 1px solid #000; border-left: 1px solid #000; border-right: 1px solid #000; "  cellspacing="0" > 
<tr >
	<td align=center style="   border-right: 1px solid #000; " class="medio" ><b>Total do Serviço</b></td>	
	<td align=center style="  " class="medio" > <p> R$&emsp;'.number_format($valorTotal, 2, ',', '.').' </td>
</tr>

<tr >
	<td align=center style="  border-top: 1px solid #000; border-right: 1px solid #000; " class="medio" ><b>Km Rodado</b></td>	
	<td align=center style="  border-top: 1px solid #000;  " class="medio" > <p>'.$row["REP_KM"].' </td>  
</tr> 

</table>
<br>
<table  style="width: 800px; border-top: 1px solid #000; border-bottom: 1px solid #000; border-left: 1px solid #000; border-right: 1px solid #000; "  cellspacing="0" > 
<tr >
	<td  align=center class="medio" style="height: 35px;" ><b>Condição de Pagamento</b></td>	
</tr>
</table>
<table  style="width: 800px;  border-bottom: 1px solid #000; border-left: 1px solid #000; border-right: 1px solid #000; "  cellspacing="0" > 

<tr >
	<td align=center style="  ">&nbsp;'.$row["REP_PRAZOPAGAMENTO"].'</td>
</tr>

</table>


</br style="line-height: 4px;">





</br style="line-height: 4px;">

');





if($mostraDetalhado && $_SESSION['permissao'] == '1'){
$text = $text .= ('
<table  style="width: 800px;  border-top: 1px solid #000; border-left: 1px solid #000; border-right: 1px solid #000; "  cellspacing="0" > 
<tr >
	<td  align=center class="medio" style="height: 35px;"> <b>Detalhamento de Custos</b></td>	
</tr>
</table>
								
								
								
								
								
<table  style="width: 800px;  border-top: 1px solid #000; border-left: 1px solid #000; border-right: 1px solid #000; "  cellspacing="0" > 
<tr >
	<td align=center style="  border-bottom: 1px solid #000; border-right: 1px solid #000; " class="medio" ><b>Total da Hora Técnica</b></td>	
	<td align=center style="  border-bottom: 1px solid #000;  " class="medio" > <p> R$&emsp;'.number_format($horaTecnicaTotal, 2, ',', '.').' </td>  
</tr>
<tr >
	<td align=center style="  border-bottom: 1px solid #000; border-right: 1px solid #000; " class="medio" ><b>Total Deslocamento</b></td>	
	<td align=center style="  border-bottom: 1px solid #000;  " class="medio" > <p> R$&emsp;'.number_format($custoDeslocamento, 2, ',', '.').' </td>  
</tr>
<tr >
	<td align=center style="  border-bottom: 1px solid #000; border-right: 1px solid #000; " class="medio" ><b>Tempo de Deslocamento</b></td>	
	<td align=center style="  border-bottom: 1px solid #000;  " class="medio" > <p> '.$row["REP_TEMPODESLOCAMENTO"].'  </td>  
</tr>
<tr >
	<td align=center style="  border-bottom: 1px solid #000; border-right: 1px solid #000; " class="medio" ><b>Total Tempo de Deslocamento</b></td>	
	<td align=center style="  border-bottom: 1px solid #000;  " class="medio" > <p> R$&emsp;'.number_format($custoTempoDeslocamento, 2, ',', '.').' </td>  
</tr>
<tr >
	<td align=center style="  border-bottom: 1px solid #000; border-right: 1px solid #000; " class="medio" ><b>Refeição</b></td>	
	<td align=center style="  border-bottom: 1px solid #000;  " class="medio" > <p> R$&emsp;'.number_format($custoRefeicao, 2, ',', '.').' </td>  
</tr>
<tr >
	<td align=center style="  border-bottom: 1px solid #000; border-right: 1px solid #000; " class="medio" ><b>Hospedagem</b></td>	
	<td align=center style="  border-bottom: 1px solid #000;  " class="medio" > <p> R$&emsp;'.number_format($custoHospedagem, 2, ',', '.').' </td>  
</tr>
<tr >
	<td align=center style="  border-bottom: 1px solid #000; border-right: 1px solid #000; " class="medio" ><b>Peças</b></td>	
	<td align=center style="  border-bottom: 1px solid #000;  " class="medio" > <p> R$&emsp;'.number_format($custoPeças, 2, ',', '.').' </td>  
</tr>
<tr >
	<td align=center style="  border-bottom: 1px solid #000; border-right: 1px solid #000; " class="medio" ><b>Desconto</b></td>	
	<td align=center style="  border-bottom: 1px solid #000;  " class="medio" > <p> R$&emsp;'.number_format($desconto, 2, ',', '.').' </td>  
</tr>





</table> 



</br style="line-height: 4px;">
');
} 


if ($row['REP_ASSINADO']){
 $assinadoEm = "Assinado em: ".date('d/m/y H:i',   strtotime('-3 hours', strtotime($row['REP_ASSINADO'])));
}else{
	
	$assinadoEm = "Assinado em: ";
}

$assinaturaPath = 'http://'.$_SERVER['HTTP_HOST'].'/painel/pages/assinaturas/'.md5("OS_".$row["REP_CODIGO"]."").'_OS_'.$row["REP_CODIGO"].'_'.str_replace(':', '', $row["REP_ASSINADO"]).'.jpg';



 

$text = $text .= ('
<tr><td></td></tr>
</table>
<table  style="width: 800px;  border-bottom: 1px solid #000; border-top: 1px solid #000; border-left: 1px solid #000; border-right: 1px solid #000; "  cellspacing="0" > 
<tr> 
	<td></br><p> </br> </td>
	<td style="  border-bottom: 1px solid #000; "> <p> </td>
	<td style="  border-bottom: 1px solid #000; " align=center> FERNANDO ALVES DOS SANTOS </td>
	<td style="  border-bottom: 1px solid #000; "> <p> </td>
	<td><p> </td>
	<td style="  border-bottom: 1px solid #000; "> <p> </td>
	<td style="  border-bottom: 1px solid #000; " align=center> '.$row["CLI_NOME"].' / '.$row["REP_SOLICITANTE"].'</td>
	<td style="  border-bottom: 1px solid #000; "> <p> </td>
	<td><p> </td>
</tr>
<tr> 
	<td></br><p> </br></td>
	<td > <p> </td>
	<td align=center class="medio"> Técnico </td>
	<td> <p> </td>

	<td></br><p> </br></td>
	<td > <p> </td>
	<td align=center class="medio"> Cliente / Contato</td>
	<td> <p> </td>
	<td><p> </td>
</tr>
<tr style="height: 200px;"> 
	<td>  <p> </td>
	<td colspan="3" align=center>  <img src="http://'.$_SERVER['HTTP_HOST'].'/painel/images/ass1.jpg" style="width:200px;" />  </td>
	
	<td>  <p> </td>
	<td colspan="3" align=center> <img alt="Sem Assinatura" src="'.$assinaturaPath.'" style="width:200px;" /> </td>
</tr> 

<tr> 
	<td></br><p> </br> </td>
	<td style="   "> <p> </td>
	<td style="  " align=center>  </td>
	<td style="   "> <p> </td>
	<td><p> </td>
	<td style="   "> <p>   </td>
	<td style="   " align=center>'.$assinadoEm.' </td>
	<td style="  "> <p> </td>
	<td><p> </td>
</tr>
<tr> 
	<td></br><p> </br> </td>
	<td style="  border-top: 1px solid #000; "> <p> </td>
	<td style="  border-top: 1px solid #000; " align=center> Assinatura </td>
	<td style="  border-top: 1px solid #000; "> <p> </td>
	<td><p> </td>
	<td style="  border-top: 1px solid #000; "> <p>   </td>
	<td style="  border-top: 1px solid #000; " align=center> Assinatura</td>
	<td style="  border-top: 1px solid #000; "> <p> </td>
	<td><p> </td>
</tr>

</table>

</br></br>
		<div class="divprint">
			<input type="button" id="btnprint" name="btnprint" value="Imprimir/Salvar em PDF" onclick="window.print();"; /></br>
			<span>Caso queira salvar em pdf, escolha a impressora PDF. </span></br>
		</div>


</body >




</html> 


<script>



</script>
');
$file = fopen($name, 'w');
fwrite($file, $text);
fclose($file);
if(!empty($_GET['send'])){
	//header("Location: reports.php?send=".$_GET['generate']."");	
	echo '<meta http-equiv="Refresh" content="0; url=reports.php?send='.$_GET['generate'].'\>';
}else{
//header("Location: ".$name);
	//exit(header("Location: ".$name)); 
	echo '<meta http-equiv="Refresh" content="0; url='.$name.'">';
	//echo "<META HTTP-EQUIV='REFRESH' CONTENT='0; URL=".$name.">";
	//die();
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