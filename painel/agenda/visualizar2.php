<? 
//-------------------banco de dados---------------------//
	$servername = "larfilhosdemariadenazare.one.mysql";
	$username = "larfilhosdemariadenazare_one";
	$password = "haroldocedrorosa";
	$dbname = "larfilhosdemariadenazare_one";
       
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
	
		function dtoc($data)
	{
	  if(trim($data) <> ''){
		$datafmt = substr($data,6,2) . '/' . substr($data,4,2) . '/' . substr($data,0,4);
	  }else{
		$datafmt = '';
	  }
	  return $datafmt;
	}

	//-------------------banco de dados---------------------//	

	$query = ("SELECT * from tb_atendimentos  WHERE id = '".$_GET['recno']."' ");
	
	
	$resultado = $mysqli->query($query); 
			
			if(mysqli_num_rows($resultado) > 0)
			{  	
				while($row = $resultado->fetch_array())
				{
					
				?>
<style> 
.cabec {
   font-size: 15px;
}
</style>
<table border=0 cellpadding=0 cellspacing=0 width=664 style='border-collapse:
 collapse;table-layout:fixed;width:500pt;     font-family: monospace;'>

 <tr class="cabec">
 
  <td colspan=10   style='border:.5pt solid black; text-align:center; padding:10px;'>FOLHA DE ATENDIMENTO FRATERNO</td>
 </tr>

 <tr class="cabec">  
  <td  colspan=4 style='border-left:.5pt solid black; text-align:left; padding-left:5px;'>Data:  <?echo dtoc($row['atendimentos_data']); ?></td>
 
  <td colspan=6  style='border-right:.5pt solid black;'>Atendente:<?echo ' '.$row['atendimentos_atendente']; ?></td>
 
 </tr>
 
 <tr class="cabec">
   
  <td colspan=7 style='border-left:.5pt solid black; text-align:left; padding-left:5px;'>Nome: <?echo $row['atendimentos_nome']; ?></td>
  <td colspan=3 style='border-right:.5pt solid black; '>Estado Civíl: <?echo $row['atendimentos_estado_civil']; ?></td>
 </tr>
 
 <tr class="cabec">  
  <td colspan=4 style='border-left:.5pt solid black; text-align:left; padding-left:5px;'>Sexo: <?echo $row['atendimentos_sexo']; ?></td>  
  
  
  <td colspan=3 style='padding-right:50px;'>CPF: <?echo $row['atendimentos_cpf']; ?> </td>
  
  <td colspan=3 style="border-right:.5pt solid black;">Nascimento: <?echo dtoc($row['atendimentos_nascimento']); ?></td>
  
 
 </tr>
 
  <tr class="cabec">  
  <td colspan=10 style='border-left:.5pt solid black; border-right:.5pt solid black;   text-align:left; padding-left:5px;'>Endereço: <?echo $row['atendimentos_endereco']; ?></td>  
 
 </tr>
 
  <tr class="cabec">  
  <td colspan=10 style='border-left:.5pt solid black;    border-right:.5pt solid black; text-align:left; padding-left:5px;'>Cidade - UF: <?echo $row['atendimentos_cidade'].' - '.$row['atendimentos_uf']; ?></td>  
  

 </tr> 
  
 <tr >
  
  <td colspan=10 style='border:.5pt solid black; text-align:center; padding:10px;' >SESSÕES</td>
 
 </tr>
 
 
 
 <tr >  
	<td colspan=5 style='border-left:.5pt solid black; border-right:.5pt solid black; text-align:center; padding:5px;'>PASSES:  <?echo $row['atendimentos_quant_passes']; ?></td>
	<td colspan=5 style='border-left:.5pt solid black; border-right:.5pt solid black; text-align:center; padding:5px;'>BIOENERGIAS: <?echo $row['atendimentos_quant_bioenergias']; ?> </td> 
	
 </tr>
 
 
 
<tr > 
	<td colspan=5 style='border-bottom:.5pt solid black;border-left:.5pt solid black; border-right:.5pt solid black; text-align:center; padding:5px;'>
		<table border=0 cellpadding=0 cellspacing=0  style='border-collapse:collapse;   width: 100%;  font-family: monospace;'> 
			<tr> 
				<td style='padding: 2px; '> 
				___/___/___
				</td>
				<td style='padding: 2px; '>
				___/___/___
				</td>
				<td style='padding: 2px; '>
				___/___/___
				</td>
			</tr>
			<tr> 
				<td style='padding: 2px; '>
				___/___/___
				</td>
				<td style='padding: 2px; '>
				___/___/___
				</td>
				<td style='padding: 2px; '>
				___/___/___
				</td>
			</tr>
			<tr> 
				<td style='padding: 2px; '>
				___/___/___
				</td>
				<td style='padding: 2px; '>
				___/___/___
				</td>
				<td style='padding: 2px; '>
				___/___/___
				</td>
			</tr>
		</table>
	</td>
	<td colspan=5 style='border-bottom:.5pt solid black;border-left:.5pt solid black; border-right:.5pt solid black; text-align:center; padding:5px;'>
		<table border=0 cellpadding=0 cellspacing=0  style='border-collapse:collapse;   width: 100%;  font-family: monospace;'> 
			<tr> 
				<td style='padding: 2px; '>
				___/___/___
				</td>
				<td style='padding: 2px; '>
				___/___/___
				</td>
				<td style='padding: 2px; '>
				___/___/___
				</td>
			</tr>
			<tr> 
				<td style='padding: 2px; '>
				___/___/___
				</td>
				<td style='padding: 2px; '>
				___/___/___
				</td>
				<td style='padding: 2px; '>
				___/___/___
				</td>
			</tr>
			<tr> 
				<td style='padding: 2px; '>
				___/___/___
				</td>
				<td style='padding: 2px; '>
				___/___/___
				</td>
				<td style='padding: 2px; '>
				___/___/___
				</td>
			</tr>
		</table>
	</td> 
</tr>
<tr > 
	<td colspan=5 style='border-bottom:.5pt solid black;border-left:.5pt solid black; border-right:.5pt solid black; text-align:center; padding:5px;'>
		<table border=0 cellpadding=0 cellspacing=0  style='border-collapse:collapse;   width: 100%;  font-family: monospace;'> 
			<tr> 
				<td style='padding: 2px; '> 
				___/___/___
				</td>
				<td style='padding: 2px; '>
				___/___/___
				</td>
				<td style='padding: 2px; '>
				___/___/___
				</td>
			</tr>
			<tr> 
				<td style='padding: 2px; '>
				___/___/___
				</td>
				<td style='padding: 2px; '>
				___/___/___
				</td>
				<td style='padding: 2px; '>
				___/___/___
				</td>
			</tr>
			<tr> 
				<td style='padding: 2px; '>
				___/___/___
				</td>
				<td style='padding: 2px; '>
				___/___/___
				</td>
				<td style='padding: 2px; '>
				___/___/___
				</td>
			</tr>
		</table>
	</td>
	<td colspan=5 style='border-bottom:.5pt solid black;border-left:.5pt solid black; border-right:.5pt solid black; text-align:center; padding:5px;'>
		<table border=0 cellpadding=0 cellspacing=0  style='border-collapse:collapse;   width: 100%;  font-family: monospace;'> 
			<tr> 
				<td style='padding: 2px; '>
				___/___/___
				</td>
				<td style='padding: 2px; '>
				___/___/___
				</td>
				<td style='padding: 2px; '>
				___/___/___
				</td>
			</tr>
			<tr> 
				<td style='padding: 2px; '>
				___/___/___
				</td>
				<td style='padding: 2px; '>
				___/___/___
				</td>
				<td style='padding: 2px; '>
				___/___/___
				</td>
			</tr>
			<tr> 
				<td style='padding: 2px; '>
				___/___/___
				</td>
				<td style='padding: 2px; '>
				___/___/___
				</td>
				<td style='padding: 2px; '>
				___/___/___
				</td>
			</tr>
		</table>
	</td> 
</tr>
<tr > 
	<td colspan=5 style='border-bottom:.5pt solid black;border-left:.5pt solid black; border-right:.5pt solid black; text-align:center; padding:5px;'>
		<table border=0 cellpadding=0 cellspacing=0  style='border-collapse:collapse;   width: 100%;  font-family: monospace;'> 
			<tr> 
				<td style='padding: 2px; '> 
				___/___/___
				</td>
				<td style='padding: 2px; '>
				___/___/___
				</td>
				<td style='padding: 2px; '>
				___/___/___
				</td>
			</tr>
			<tr> 
				<td style='padding: 2px; '>
				___/___/___
				</td>
				<td style='padding: 2px; '>
				___/___/___
				</td>
				<td style='padding: 2px; '>
				___/___/___
				</td>
			</tr>
			<tr> 
				<td style='padding: 2px; '>
				___/___/___
				</td>
				<td style='padding: 2px; '>
				___/___/___
				</td>
				<td style='padding: 2px; '>
				___/___/___
				</td>
			</tr>
		</table>
	</td>
	<td colspan=5 style='border-bottom:.5pt solid black;border-left:.5pt solid black; border-right:.5pt solid black; text-align:center; padding:5px;'>
		<table border=0 cellpadding=0 cellspacing=0  style='border-collapse:collapse;   width: 100%;  font-family: monospace;'> 
			<tr> 
				<td style='padding: 2px; '>
				___/___/___
				</td>
				<td style='padding: 2px; '>
				___/___/___
				</td>
				<td style='padding: 2px; '>
				___/___/___
				</td>
			</tr>
			<tr> 
				<td style='padding: 2px; '>
				___/___/___
				</td>
				<td style='padding: 2px; '>
				___/___/___
				</td>
				<td style='padding: 2px; '>
				___/___/___
				</td>
			</tr>
			<tr> 
				<td style='padding: 2px; '>
				___/___/___
				</td>
				<td style='padding: 2px; '>
				___/___/___
				</td>
				<td style='padding: 2px; '>
				___/___/___
				</td>
			</tr>
		</table>
	</td> 
</tr>
<tr > 
	<td colspan=5 style='border-bottom:.5pt solid black;border-left:.5pt solid black; border-right:.5pt solid black; text-align:center; padding:5px;'>
		<table border=0 cellpadding=0 cellspacing=0  style='border-collapse:collapse;   width: 100%;  font-family: monospace;'> 
			<tr> 
				<td style='padding: 2px; '> 
				___/___/___
				</td>
				<td style='padding: 2px; '>
				___/___/___
				</td>
				<td style='padding: 2px; '>
				___/___/___
				</td>
			</tr>
			<tr> 
				<td style='padding: 2px; '>
				___/___/___
				</td>
				<td style='padding: 2px; '>
				___/___/___
				</td>
				<td style='padding: 2px; '>
				___/___/___
				</td>
			</tr>
			<tr> 
				<td style='padding: 2px; '>
				___/___/___
				</td>
				<td style='padding: 2px; '>
				___/___/___
				</td>
				<td style='padding: 2px; '>
				___/___/___
				</td>
			</tr>
		</table>
	</td>
	<td colspan=5 style='border-bottom:.5pt solid black;border-left:.5pt solid black; border-right:.5pt solid black; text-align:center; padding:5px;'>
		<table border=0 cellpadding=0 cellspacing=0  style='border-collapse:collapse;   width: 100%;  font-family: monospace;'> 
			<tr> 
				<td style='padding: 2px; '>
				___/___/___
				</td>
				<td style='padding: 2px; '>
				___/___/___
				</td>
				<td style='padding: 2px; '>
				___/___/___
				</td>
			</tr>
			<tr> 
				<td style='padding: 2px; '>
				___/___/___
				</td>
				<td style='padding: 2px; '>
				___/___/___
				</td>
				<td style='padding: 2px; '>
				___/___/___
				</td>
			</tr>
			<tr> 
				<td style='padding: 2px; '>
				___/___/___
				</td>
				<td style='padding: 2px; '>
				___/___/___
				</td>
				<td style='padding: 2px; '>
				___/___/___
				</td>
			</tr>
		</table>
	</td> 
</tr>
 <tr > 
	<td colspan=5 style='border-bottom:.5pt solid black;border-left:.5pt solid black; border-right:.5pt solid black; text-align:center; padding:5px;'>
		<table border=0 cellpadding=0 cellspacing=0  style='border-collapse:collapse;   width: 100%;  font-family: monospace;'> 
			<tr> 
				<td style='padding: 2px; '> 
				___/___/___
				</td>
				<td style='padding: 2px; '>
				___/___/___
				</td>
				<td style='padding: 2px; '>
				___/___/___
				</td>
			</tr>
			<tr> 
				<td style='padding: 2px; '>
				___/___/___
				</td>
				<td style='padding: 2px; '>
				___/___/___
				</td>
				<td style='padding: 2px; '>
				___/___/___
				</td>
			</tr>
			<tr> 
				<td style='padding: 2px; '>
				___/___/___
				</td>
				<td style='padding: 2px; '>
				___/___/___
				</td>
				<td style='padding: 2px; '>
				___/___/___
				</td>
			</tr>
		</table>
	</td>
	<td colspan=5 style='border-bottom:.5pt solid black;border-left:.5pt solid black; border-right:.5pt solid black; text-align:center; padding:5px;'>
		<table border=0 cellpadding=0 cellspacing=0  style='border-collapse:collapse;   width: 100%;  font-family: monospace;'> 
			<tr> 
				<td style='padding: 2px; '>
				___/___/___
				</td>
				<td style='padding: 2px; '>
				___/___/___
				</td>
				<td style='padding: 2px; '>
				___/___/___
				</td>
			</tr>
			<tr> 
				<td style='padding: 2px; '>
				___/___/___
				</td>
				<td style='padding: 2px; '>
				___/___/___
				</td>
				<td style='padding: 2px; '>
				___/___/___
				</td>
			</tr>
			<tr> 
				<td style='padding: 2px; '>
				___/___/___
				</td>
				<td style='padding: 2px; '>
				___/___/___
				</td>
				<td style='padding: 2px; '>
				___/___/___
				</td>
			</tr>
		</table>
	</td> 
</tr>
<tr > 
	<td colspan=5 style='border-bottom:.5pt solid black;border-left:.5pt solid black; border-right:.5pt solid black; text-align:center; padding:5px;'>
		<table border=0 cellpadding=0 cellspacing=0  style='border-collapse:collapse;   width: 100%;  font-family: monospace;'> 
			<tr> 
				<td style='padding: 2px; '> 
				___/___/___
				</td>
				<td style='padding: 2px; '>
				___/___/___
				</td>
				<td style='padding: 2px; '>
				___/___/___
				</td>
			</tr>
			<tr> 
				<td style='padding: 2px; '>
				___/___/___
				</td>
				<td style='padding: 2px; '>
				___/___/___
				</td>
				<td style='padding: 2px; '>
				___/___/___
				</td>
			</tr>
			<tr> 
				<td style='padding: 2px; '>
				___/___/___
				</td>
				<td style='padding: 2px; '>
				___/___/___
				</td>
				<td style='padding: 2px; '>
				___/___/___
				</td>
			</tr>
		</table>
	</td>
	<td colspan=5 style='border-bottom:.5pt solid black;border-left:.5pt solid black; border-right:.5pt solid black; text-align:center; padding:5px;'>
		<table border=0 cellpadding=0 cellspacing=0  style='border-collapse:collapse;   width: 100%;  font-family: monospace;'> 
			<tr> 
				<td style='padding: 2px; '>
				___/___/___
				</td>
				<td style='padding: 2px; '>
				___/___/___
				</td>
				<td style='padding: 2px; '>
				___/___/___
				</td>
			</tr>
			<tr> 
				<td style='padding: 2px; '>
				___/___/___
				</td>
				<td style='padding: 2px; '>
				___/___/___
				</td>
				<td style='padding: 2px; '>
				___/___/___
				</td>
			</tr>
			<tr> 
				<td style='padding: 2px; '>
				___/___/___
				</td>
				<td style='padding: 2px; '>
				___/___/___
				</td>
				<td style='padding: 2px; '>
				___/___/___
				</td>
			</tr>
		</table>
	</td> 
</tr>
<tr > 
	<td colspan=5 style='border-bottom:.5pt solid black;border-left:.5pt solid black; border-right:.5pt solid black; text-align:center; padding:5px;'>
		<table border=0 cellpadding=0 cellspacing=0  style='border-collapse:collapse;   width: 100%;  font-family: monospace;'> 
			<tr> 
				<td style='padding: 2px; '> 
				___/___/___
				</td>
				<td style='padding: 2px; '>
				___/___/___
				</td>
				<td style='padding: 2px; '>
				___/___/___
				</td>
			</tr>
			<tr> 
				<td style='padding: 2px; '>
				___/___/___
				</td>
				<td style='padding: 2px; '>
				___/___/___
				</td>
				<td style='padding: 2px; '>
				___/___/___
				</td>
			</tr>
			<tr> 
				<td style='padding: 2px; '>
				___/___/___
				</td>
				<td style='padding: 2px; '>
				___/___/___
				</td>
				<td style='padding: 2px; '>
				___/___/___
				</td>
			</tr>
		</table>
	</td>
	<td colspan=5 style='border-bottom:.5pt solid black;border-left:.5pt solid black; border-right:.5pt solid black; text-align:center; padding:5px;'>
		<table border=0 cellpadding=0 cellspacing=0  style='border-collapse:collapse;   width: 100%;  font-family: monospace;'> 
			<tr> 
				<td style='padding: 2px; '>
				___/___/___
				</td>
				<td style='padding: 2px; '>
				___/___/___
				</td>
				<td style='padding: 2px; '>
				___/___/___
				</td>
			</tr>
			<tr> 
				<td style='padding: 2px; '>
				___/___/___
				</td>
				<td style='padding: 2px; '>
				___/___/___
				</td>
				<td style='padding: 2px; '>
				___/___/___
				</td>
			</tr>
			<tr> 
				<td style='padding: 2px; '>
				___/___/___
				</td>
				<td style='padding: 2px; '>
				___/___/___
				</td>
				<td style='padding: 2px; '>
				___/___/___
				</td>
			</tr>
		</table>
	</td> 
</tr>
<tr > 
	<td colspan=5 style='border-bottom:.5pt solid black;border-left:.5pt solid black; border-right:.5pt solid black; text-align:center; padding:5px;'>
		<table border=0 cellpadding=0 cellspacing=0  style='border-collapse:collapse;   width: 100%;  font-family: monospace;'> 
			<tr> 
				<td style='padding: 2px; '> 
				___/___/___
				</td>
				<td style='padding: 2px; '>
				___/___/___
				</td>
				<td style='padding: 2px; '>
				___/___/___
				</td>
			</tr>
			<tr> 
				<td style='padding: 2px; '>
				___/___/___
				</td>
				<td style='padding: 2px; '>
				___/___/___
				</td>
				<td style='padding: 2px; '>
				___/___/___
				</td>
			</tr>
			<tr> 
				<td style='padding: 2px; '>
				___/___/___
				</td>
				<td style='padding: 2px; '>
				___/___/___
				</td>
				<td style='padding: 2px; '>
				___/___/___
				</td>
			</tr>
		</table>
	</td>
	<td colspan=5 style='border-bottom:.5pt solid black;border-left:.5pt solid black; border-right:.5pt solid black; text-align:center; padding:5px;'>
		<table border=0 cellpadding=0 cellspacing=0  style='border-collapse:collapse;   width: 100%;  font-family: monospace;'> 
			<tr> 
				<td style='padding: 2px; '>
				___/___/___
				</td>
				<td style='padding: 2px; '>
				___/___/___
				</td>
				<td style='padding: 2px; '>
				___/___/___
				</td>
			</tr>
			<tr> 
				<td style='padding: 2px; '>
				___/___/___
				</td>
				<td style='padding: 2px; '>
				___/___/___
				</td>
				<td style='padding: 2px; '>
				___/___/___
				</td>
			</tr>
			<tr> 
				<td style='padding: 2px; '>
				___/___/___
				</td>
				<td style='padding: 2px; '>
				___/___/___
				</td>
				<td style='padding: 2px; '>
				___/___/___
				</td>
			</tr>
		</table>
	</td> 
</tr>
<tr > 
	<td colspan=5 style='border-bottom:.5pt solid black;border-left:.5pt solid black; border-right:.5pt solid black; text-align:center; padding:5px;'>
		<table border=0 cellpadding=0 cellspacing=0  style='border-collapse:collapse;   width: 100%;  font-family: monospace;'> 
			<tr> 
				<td style='padding: 2px; '> 
				___/___/___
				</td>
				<td style='padding: 2px; '>
				___/___/___
				</td>
				<td style='padding: 2px; '>
				___/___/___
				</td>
			</tr>
			<tr> 
				<td style='padding: 2px; '>
				___/___/___
				</td>
				<td style='padding: 2px; '>
				___/___/___
				</td>
				<td style='padding: 2px; '>
				___/___/___
				</td>
			</tr>
			<tr> 
				<td style='padding: 2px; '>
				___/___/___
				</td>
				<td style='padding: 2px; '>
				___/___/___
				</td>
				<td style='padding: 2px; '>
				___/___/___
				</td>
			</tr>
		</table>
	</td>
	<td colspan=5 style='border-bottom:.5pt solid black;border-left:.5pt solid black; border-right:.5pt solid black; text-align:center; padding:5px;'>
		<table border=0 cellpadding=0 cellspacing=0  style='border-collapse:collapse;   width: 100%;  font-family: monospace;'> 
			<tr> 
				<td style='padding: 2px; '>
				___/___/___
				</td>
				<td style='padding: 2px; '>
				___/___/___
				</td>
				<td style='padding: 2px; '>
				___/___/___
				</td>
			</tr>
			<tr> 
				<td style='padding: 2px; '>
				___/___/___
				</td>
				<td style='padding: 2px; '>
				___/___/___
				</td>
				<td style='padding: 2px; '>
				___/___/___
				</td>
			</tr>
			<tr> 
				<td style='padding: 2px; '>
				___/___/___
				</td>
				<td style='padding: 2px; '>
				___/___/___
				</td>
				<td style='padding: 2px; '>
				___/___/___
				</td>
			</tr>
		</table>
	</td> 
</tr> 
<tr > 
	<td colspan=5 style='border-bottom:.5pt solid black;border-left:.5pt solid black; border-right:.5pt solid black; text-align:center; padding:5px;'>
		<table border=0 cellpadding=0 cellspacing=0  style='border-collapse:collapse;   width: 100%;  font-family: monospace;'> 
			<tr> 
				<td style='padding: 2px; '> 
				___/___/___
				</td>
				<td style='padding: 2px; '>
				___/___/___
				</td>
				<td style='padding: 2px; '>
				___/___/___
				</td>
			</tr>
			<tr> 
				<td style='padding: 2px; '>
				___/___/___
				</td>
				<td style='padding: 2px; '>
				___/___/___
				</td>
				<td style='padding: 2px; '>
				___/___/___
				</td>
			</tr>
			<tr> 
				<td style='padding: 2px; '>
				___/___/___
				</td>
				<td style='padding: 2px; '>
				___/___/___
				</td>
				<td style='padding: 2px; '>
				___/___/___
				</td>
			</tr>
		</table>
	</td>
	<td colspan=5 style='border-bottom:.5pt solid black;border-left:.5pt solid black; border-right:.5pt solid black; text-align:center; padding:5px;'>
		<table border=0 cellpadding=0 cellspacing=0  style='border-collapse:collapse;   width: 100%;  font-family: monospace;'> 
			<tr> 
				<td style='padding: 2px; '>
				___/___/___
				</td>
				<td style='padding: 2px; '>
				___/___/___
				</td>
				<td style='padding: 2px; '>
				___/___/___
				</td>
			</tr>
			<tr> 
				<td style='padding: 2px; '>
				___/___/___
				</td>
				<td style='padding: 2px; '>
				___/___/___
				</td>
				<td style='padding: 2px; '>
				___/___/___
				</td>
			</tr>
			<tr> 
				<td style='padding: 2px; '>
				___/___/___
				</td>
				<td style='padding: 2px; '>
				___/___/___
				</td>
				<td style='padding: 2px; '>
				___/___/___
				</td>
			</tr>
		</table>
	</td> 
</tr>
</table>

			
			
			
				<?
					break;
				}
			}
			
	
?>

