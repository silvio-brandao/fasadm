<? 
session_start();
		require_once 'functions.php';  

//echo isLoggedIn(); die();
if (isLoggedIn() == 'false')      
{     
    echo '<meta http-equiv="refresh" content="0; url=login.php">'; die();
} 

	//-------------------banco de dados---------------------//
	$servername = "feiraskativa.com.br.mysql";
	$username = "feiraskativa_com_br";
	$password = "kativastoredb";
	$dbname = "feiraskativa_com_br";
       
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
	
	
		function dtoc($data)
	{
	  if(trim($data) <> ''){
		$datafmt = substr($data,6,2) . '/' . substr($data,4,2) . '/' . substr($data,0,4);
	  }else{
		$datafmt = '';
	  }
	  return $datafmt;
	}


					
				?>
<style>
 
</style>
<body style="font-family: sans-serif;"> 

<? 
$query = ("SELECT * FROM tb_cab_pedido
	INNER JOIN tb_clientes ON tb_clientes.id = pedido_codcli
	WHERE tb_cab_pedido.id <> '' AND  pedido_numero = '".$_GET['pedido']."'");			
						
			$resultado = $mysqli->query($query); 
			
			if(mysqli_num_rows($resultado) > 0)
			{  
				
				while($row = $resultado->fetch_array())
				{ 
			
					echo " 
	<table style='width: 800px; font-size: 14px'  cellspacing='0'> 	  
	<tbody>
		<tr>
			<td colspan='3' style='      border-bottom-left-radius: 8px;  border-top-left-radius: 8px; border-bottom:1px solid #000;  border-top: 1px solid #000; border-left: 1px solid #000; '>
				<img src='./img/favicon.ico' style='    width: 69px;    margin-left: 16px;    margin-right: -22px;'> 
			</td>
			<td colspan='3'  style='border-bottom: 1px solid #000;  border-top: 1px solid #000; border-right: 1px solid #000; '>
				  Kativa Store <br><br>Rua Jorge Zipperer Neto, 23 - Centro<br>Rio Negrinho - SC - 89295-000<br>(47) 3644-9168 
			</td>	
			<td class='pequeno' style='padding-left: 10px;   border-bottom-right-radius: 8px;    border-top-right-radius: 8px;  border-top: 1px solid #000;  border-bottom: 1px solid #000; border-right: 1px solid #000; '>
				Pedido de Venda 	
				<br><br>
				<span style='  margin-bottom: 10px;'>Nº<span style='    margin-left: 10px;  '>".$_GET['pedido']."</span></span>
				<br><br> 
				<div style='padding-top: 5px;'>".dtoc($row['pedido_data'])."</div>
			</td>
		</tr>
	</tbody>
</table>

<table style='width: 800px;margin-top: 7px; font-size: 14px' cellspacing='0'> 
	<tbody>
		<tr>
			<td ><b>Cliente:</b></td>
			<td>".$row['cli_nome']."</td>
			<td ><b>CNPJ/CPF:</b></td>
			<td colspan=3>".$row['cli_cpf'].$row['cli_cnpj']."</td> 
		</tr>
		<tr>
			<td ><b>Endereço:</b></td>
			<td colspan=5>".$row['cli_endereco']."</td> 
			
		</tr>
		<tr>
			<td ><b></b></td>
			<td>".$row['cli_cidade']." - ".$row['cli_uf']."</td>	
			<td ><b>Bairro:</b></td>
			<td colspan=3>".$row['cli_bairro']."</td>	
		</tr>
		<tr>
			<td ><b>CEP:</b></td>
			<td>".$row['cli_cep']."</td>	
			<td ><b>Telefone:</b></td>
			<td>".$row['cli_telefone']."</td>	
			<td ><b>E-mail:</b></td>
			<td>".$row['cli_email']."</td> 
			
		</tr>
	</tbody>
</table>";
?>

<table style='width: 800px; margin-top: 5px; font-size: 14px'  cellspacing='0'> 	  
	<tbody>
		<tr style='font-weight: 600;'>
			<td  style='      border-bottom-left-radius: 8px;  border-top-left-radius: 8px; border-bottom:1px solid #000;  border-top: 1px solid #000; border-left: 1px solid #000; '>
				Código
			</td>
			<td  style='border-bottom: 1px solid #000;  border-top: 1px solid #000;  '>
				Descrição do Produto 
			</td>
			<td  style='border-bottom: 1px solid #000;  border-top: 1px solid #000;  '>
				Quantidade
			</td>
			<td  style='border-bottom: 1px solid #000;  border-top: 1px solid #000; text-align:right;'>
				Valor Unit.
			</td>			
			<td  style='padding-left: 10px;   border-bottom-right-radius: 8px;  text-align:right;  border-top-right-radius: 8px;  border-top: 1px solid #000;  border-bottom: 1px solid #000; border-right: 1px solid #000; '>
				Total
			</td>
		</tr>
	</tbody>
</table>
<table style='width: 800px; margin-top: 5px; font-size: 14px'  > 	   
	<tbody>	
		<? 
		$query2 = ("SELECT * FROM  tb_itens_pedido where itemped_pedido = '".$_GET['pedido']."' order by itemped_item ASC ");
						
			$resultado2 = $mysqli->query($query2); 
			
			if(mysqli_num_rows($resultado2) > 0)
			{  
				
				while($row2 = $resultado2->fetch_array())
				{
					 
					echo "<tr>
							<td  >
								".$row2['itemped_produto']."
							</td>
							<td >
								".$row2['itemped_descricao']."
							</td>
							<td style='text-align: center;' >
								".$row2['itemped_quantidade']."
							</td>
							<td style='text-align: right;'>
								R$ ".number_format($row2['itemped_valor'], 2, ',', '.')."
							</td>			 
							<td  style='text-align: right;'  >
								R$ ".number_format($row2['itemped_total'], 2, ',', '.')."
							</td>
						</tr>";
						
					if($_GET['obs'] == "obs"){
						
						echo "<tr >  
							<td  >
								
							</td>
							<td style='padding: 16px;     color: #28a7a3;' > 
								<span>".str_replace("\n", "</br>",str_replace("\n\n", " ", $row2['itemped_observacao']))."</span>
							</td>
							
							<td  colspan=3>
								
							</td>
						</tr>";
						
					}	
					
				}
			}
		
		?>
		<table style='width: 800px; margin-top: 5px; font-size: 14px'  cellspacing='0'> 	  
	<tbody>
		<tr> 
			<td  colspan=5  style='font-weight: 600; text-align:center; border-bottom-right-radius: 8px;    border-top-right-radius: 8px; border-bottom-left-radius: 8px;  border-top-left-radius: 8px; border-bottom:1px solid #000; border-right:1px solid #000;  border-top: 1px solid #000; border-left: 1px solid #000; '>
				Totais
			</td>
		</tr>
		
		<tr> 
			<td colspan=4 style='font-weight: 600;text-align:right; '>
				Total Geral:
			</td>
			<td  style='text-align:right; width:200px;'>
				R$ <?echo number_format($row['pedido_valor_total'], 2, ',', '.'); ?>
			</td>
		</tr>
		<? if($row['pedido_perc_desconto'] != 0){
			?>
				<tr> 
					<td colspan=4 style='text-align:right; font-weight: 600;'>
						Percentual de Desconto:
					</td>
					<td  style='text-align:right; width:200px;'>
						<?echo $row['pedido_perc_desconto'];  ?> %
					</td>
				</tr>
				
				<tr> 
					<td colspan=4 style='text-align:right;font-weight: 600; '>
						Total Final:
					</td>
					<td  style='text-align:right; width:200px;'>
						R$ <?echo number_format($row['pedido_valor_final'], 2, ',', '.');  ?>
					</td>
				</tr>
				
				
				</table>
				
				
				
			
			<?
		}?>
			
		
	<table style='width: 800px; font-size: 14px; margin-top: 10px;' cellspacing='0'> 	  
	<tbody> 
		<tr>
			<td  style=' font-weight: 600;  text-align:center;   border-top-left-radius: 8px; border-top: 1px solid #000; border-left: 1px solid #000; '>
				Observação
			</td>
				
			<td  style='font-weight: 600;padding-left: 10px; text-align:center;     border-top-right-radius: 8px;  border-top: 1px solid #000;  border-right: 1px solid #000; '>
				Vendedor
			</td>
		</tr> 
		
		<tr style="height: 40px;">
			<td  style='   text-align:center;   border-bottom-left-radius: 8px; border-bottom:1px solid #000;  border-top: 1px solid #000; border-left: 1px solid #000; '>
				<?ECHO str_replace("\n", "</br>",str_replace("\n\n", " ", $row['pedido_obs'])); ?>
			</td>
				
			<td  style='padding-left: 10px; text-align:center;  border-bottom-right-radius: 8px;    border-top: 1px solid #000;  border-bottom: 1px solid #000; border-right: 1px solid #000; '>
				<? ECHO $row['pedido_vendedor']; ?>
			</td>
		</tr>
	</tbody>
</table>
		 
		
		<?


			break; 
			
				}
				
			}
?>



 
 
		
		
	</tbody>
</table>


			
			
			
				
</body>