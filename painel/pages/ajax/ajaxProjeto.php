<?php 	
if(empty($_SESSION)){
	session_start();
}
		require_once '../functions.php';  

//echo isLoggedIn(); die();
if (isLoggedIn() == 'false')      
{  
    echo '<meta http-equiv="refresh" content="0; url=../index.php">'; die();
}

$uid =	$_SESSION['uid'];


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
	
		if($_GET['funcao'] == "confirmaPagamento"){
			
			$sql = "UPDATE tb_pagamentos SET PAG_PAGO='S', PAG_STATUS_DESC='Paga', PAG_STATUS='' WHERE PAG_CODIGO='".$_GET['pagamento']."';";
			
			if ($mysqli->query($sql) == true) {		   
				echo "OK";
			} else {
				echo "Error updating record: " . $mysqli->error;
			}
		
		}
		
		
		if($_POST['funcao'] == "voltarPagamento"){
			
			$sql = "UPDATE tb_pagamentos SET PAG_PAGO='N', PAG_STATUS_DESC='', PAG_NOTIFICATION_CODE='',  PAG_TRANSACTION_CODE='' WHERE PAG_CODIGO='".$_POST['pagamento']."';";

			if ($mysqli->query($sql) === true) {		   
				echo "OK";
			} else {
				echo "Error updating record: " . $conn->error;
			}
		
		}
		
			
		
				
		if($_GET['funcao'] == "searchPagamentos"){
			
				
				if($_SESSION['permissao'] == '1'){
				
				$query = ("SELECT * FROM tb_pagamentos 
					WHERE (PAG_CLIENTE LIKE '%".$_GET['search']."%' OR PAG_REPORT LIKE '%".$_GET['search']."%' )
					order by  PAG_PAGO, PAG_DATA DESC  LIMIT ".$_GET['limit']." ");
				
				}
				/*else{
				
					$query = ("SELECT * FROM tb_pagamentos 
					WHERE PAG_CLIENTE_COD = '".$_SESSION['clientecod']."' 
					order by  PAG_PAGO , PAG_DATA DESC LIMIT ".$_GET['limit']." ");
					
					
				//}*/
				//echo $query ;

			/*print_r($resultado->fetch_array());
			die();*/
			$resultado = $mysqli->query($query); 
			
			if(mysqli_num_rows($resultado) > 0)
			{  	
				while($row = $resultado->fetch_array())
				{
					echo " <tr>";
					
					if($_SESSION['permissao'] == '1'){						
							
						if($row['PAG_PAGO'] == 'N' ){
							$btntype = $row['PAG_DATA'] <date('Ymd') ? "btn-danger": "btn-success";
							echo " <td >						
							
							<button type='button' pagamento='".$row['PAG_CODIGO']."' title='Confirmar Pagamento'   class='btn ". $btntype." btn-circle confirmaPagamento'><i class='fa fa-thumbs-up'></i></button>
							</td>";	
						}else{
							echo " <td >						
							<meta charset='Windows-1252'>
							<button type='button'  title='Pagamento Confirmado!'  class='btn btn-success btn-circle' style='background-color: #AEAEAE !important;  border-color: #BEBEBE !important;';><i class='fa fa-thumbs-up'></i></button>
							</td>";	
							
						} 
					}
					/*else{
													
							$queryNaoAssinado = "SELECT * FROM tb_report where REP_CODIGO = '".$row['PAG_REPORT']."' AND REP_ASSINADO = '' ";
							
							$resultadoNaoAssinadoCon = $mysqli->query($queryNaoAssinado); 
							$resultadoNaoAssinado = $resultadoNaoAssinadoCon->fetch_array();
						
							if($row['PAG_PAGO'] == 'N' && (count($resultadoNaoAssinado[0]) == 0 )){
								
								$btntype = $row['PAG_DATA'] <date('Ymd') ? "btn-danger": "btn-success";
								echo " <td >						
								<meta charset='Windows-1252'>
								<button type='button' onclick=\"pagarOnline(".$row['PAG_CODIGO'].")\" title='Pagamento on-line'   class='btn ". $btntype."  btn-circle'><i class='fa fa-dollar'></i></button>
								</td>";	
							}else{
							if(count($resultadoNaoAssinado[0]) != 0 ){
								$onclick = "onclick='alert(\"Impossivel efetuar pagamento. Relatorio ainda nao assinado.\")'";
							}
								echo " <td >						
								<meta charset='Windows-1252'>
								<button type='button'  title='Pagamento on-line' ".$onclick."  class='faltaass btn btn-success btn-circle' style='background-color: #AEAEAE !important;  border-color: #BEBEBE !important;';><i class='fa fa-dollar'></i></button>
								</td>";								
						} 						
					}*/
					$queryCli = "SELECT REP_DATA FROM tb_report where REP_CODIGO = '".$row['PAG_REPORT']."'";
						//$resultadoCli = $db->select2($queryCli,'','fasmanutencao_com_br');	
						
						$resultadoCliCon = $mysqli->query($queryCli); 
						
						$resultadoCli = $resultadoCliCon->fetch_array();
						echo " <td >	
							<button type='button' onclick=\"generateReport(".$row['PAG_REPORT'].", ".$resultadoCli[0]['REP_DATA'].")\" title='Gerar Relatorio'  class='btn btn-success btn-circle'><i class='fa fa-file-o'></i></button>
							</td>";
							if($row['PAG_STATUS_DESC'] == "Aguardando pagamento"){
								
								$style = " style='    color: red;    font-size: 20px;    padding-top: 5px;    font-family: sans-serif; '";
								
							}if($row['PAG_STATUS_DESC'] == "Paga PagSeguro" || $row['PAG_STATUS_DESC'] == "Paga"){
								
								$style = " style='    color: green;    font-size: 20px;    padding-top: 5px;    font-family: sans-serif; '";
							
							}
							$valor = $row['PAG_VALOR'];
							$virgula   = ',';

							$valorPag = strripos($valor, $virgula) === false ? moeda($row['PAG_VALOR']) : $row['PAG_VALOR'];
						
							
							echo " <td ".$style." >".$row['PAG_STATUS_DESC']."</td>";	
							echo " <td>".$row['PAG_REPORT']."</td>";
							echo " <td>".$valorPag."</td>";
							echo " <td>".dtoc($row['PAG_DATA'])."</td>";
							echo " <td>".$row['PAG_PAGO']."</td>"; 
							echo " <td>".$row['PAG_CLIENTE']."</td>";	
						
					if($_SESSION['permissao'] == '1'){						
							//
						if($row['PAG_PAGO'] == 'S' && $row['PAG_STATUS'] == ''){
						
							echo " <td >						
							<meta charset='Windows-1252'>
							<button type='button' pagamento='".$row['PAG_CODIGO']."' title='Pendente'  class='voltarPagamento btn btn-success btn-circle'><i class='fa fa-thumbs-down'></i></button>
							</td>";	
						}else{
							
							echo " <td >						
							<meta charset='Windows-1252'>
							<button type='button'  title='Pendente' id='btnCancPag' class='btn btn-success btn-circle' style='background-color: #AEAEAE !important;  border-color: #BEBEBE !important;';><i class='fa fa-thumbs-down'></i></button>
							</td>";	
						}
					}
					
					echo " </tr> ";												
				}
			}
		
		}
 
   if($_POST['funcao'] == "incluirOrcamento"){

		$queryInsert = "INSERT INTO  tb_orcamentos ( 
						
						ORC_CLIENTE ,
						ORC_DATA ,
						ORC_MAQUINA ,
						ORC_NUMMAQUINA ,
						ORC_MODMAQUINA ,
						ORC_PEDIDOCLI ,
						ORC_DEFEITOS ,
						ORC_TOTAL ,
						ORC_DESCRICAO ,
						ORC_SOLUCAO ,
						ORC_MATERIAIS ,
						ORC_DIAS ,
						ORC_SOLICITANTE,
						ORC_PRAZOPAGAMENTO
						)
						VALUES (
								'".$_POST['ORC_CLIENTE']."', 
								'".dtos($_POST['ORC_DATA'])."',
								'".$_POST['ORC_MAQUINA']."', 
								'".$_POST['ORC_NUMMAQUINA']."', 
								'".$_POST['ORC_MODMAQUINA']."', 
								'".$_POST['ORC_PEDIDOCLI']."', 
								'".$_POST['ORC_DEFEITOS']."', 
								'".$_POST['ORC_TOTAL']."', 
								'".$_POST['ORC_DESCRICAO']."', 
								'".$_POST['ORC_SOLUCAO']."', 
								'".$_POST['ORC_MATERIAIS']."', 
								'".$_POST['ORC_DIAS']."', 
								'".$_POST['ORC_SOLICITANTE']."',
								'".$_POST['ORC_PRAZOPAGAMENTO']."' 
								
						)";
						//echo $queryInsert; die();
					if ($mysqli->query($queryInsert) == true) {						
						echo "OK"; die();
					} else {
						echo "Error: " . $queryInsert . "<br>" . $mysqli->error;
					}
  }
 
 
  if($_POST['funcao'] == "incluirUsuario"){
	  
		$query = ("SELECT * FROM tb_usuario 
			WHERE USU_USUARIO = '".trim($_POST['usuario'])."'");
			//UF	Minic�pio	N�mero	Bairro	CEP	TELEFONE
			$resultado = $mysqli->query($query); 
			
			if(mysqli_num_rows($resultado) > 0)
			{
				echo "Já existe um usuário com esse login!";
				
				die();
			}
	  
  
		$queryInsert = "INSERT INTO tb_usuario (USU_PERMISSAO,USU_USUARIO,USU_SENHA, USU_NOME, USU_CLIENTE, USU_DESC_CLI)
										VALUES ('".$_POST['permissao']."','".trim($_POST['usuario'])."','".$_POST['senha']."', '".mb_strtoupper($_POST['nome'])."', '".$_POST['codCli']."', '".$_POST['descCli']."' )";
						

		if ($mysqli->query($queryInsert) == true) {	
			
		echo "OK"; die();
			//include('./mailnewReport.php');
		} else {
			echo "Error: " . $queryInsert . "<br>" . $mysqli->error;
		}
	
  }
  
  
  
  
  if($_POST['funcao'] == "incluiValoresConfigurados"){
	  
	  
	  //echo "OK"; die();	
	  
	$queryInsert = "INSERT INTO  tb_configvalues  
	  
	(
		VAL_DATA, 
		VAL_USER, 
		VAL_HORATECNICA, 
		VAL_HORAAUX, 
		VAL_KMRODADO, 
		VAL_HORADESLOCAMENTO
	) 
	  
		VALUES
		
	(
		'".$_POST['data']."', 
		'".$_SESSION['nome']."',
		'".str_replace(',', '.', str_replace('.', '', $_POST['valhoratecnica']))."',
		'".str_replace(',', '.', str_replace('.', '', $_POST['valhoraauxiliar']))."',
		'".str_replace(',', '.', str_replace('.', '', $_POST['valkmrodado']))."',
		'".str_replace(',', '.', str_replace('.', '', $_POST['valhoradeslocamento']))."'
		);";
		
		if ($mysqli->query($queryInsert) == true) {							
			echo "OK"; die();						
		} else {
			echo "Error: " . $queryInsert . "<br>" . $mysqli->error;
		}
	  
  }
  
  
  
  if($_POST['funcao'] == "incluirRelatorio"){

		$queryInsert = "INSERT INTO  tb_report (  
					REP_CLIENTE, REP_DATA,REP_MAQUINA,REP_NUMMAQUINA, REP_MODMAQUINA,REP_PEDIDOCLI, REP_DEFEITOS, REP_TOTAL, REP_SOLUCAO, REP_DESCCUSTOEXTRA, REP_SOLICITANTE, REP_GARANTIA, REP_KM, 
					REP_DATA1, REP_HORAENTRADA1, REP_HORASAIDA1, 
					REP_DATA2, REP_HORAENTRADA2, REP_HORASAIDA2, 
					REP_DATA3, REP_HORAENTRADA3, REP_HORASAIDA3, 
					REP_DATA4, REP_HORAENTRADA4, REP_HORASAIDA4,
					REP_DATA5, REP_HORAENTRADA5, REP_HORASAIDA5,
					REP_DATA6, REP_HORAENTRADA6, REP_HORASAIDA6,
					REP_ITERVALO1, REP_ITERVALO2, REP_ITERVALO3, REP_ITERVALO4,REP_ITERVALO5,REP_ITERVALO6,
					REP_TEMPODESLOCAMENTO,
					REP_EQUIPE1, REP_EQUIPE2, REP_EQUIPE3, REP_EQUIPE4, REP_EQUIPE5, REP_EQUIPE6, 
					REP_PRAZOPAGAMENTO,  REP_USUARIO, REP_USUARIO_NOME, REP_ASSINADO, 
					
					REP_VALHORATECNICA,	
					REP_VALHORAAUX,	
					REP_VALKMRODADO,
					REP_VALHORADESLOCAMENTO,
						
					REP_VALHORATECNICATOTAL, 
					REP_CUSTODESLOCAMENTO,
					REP_CUSTOTEMPODESLOCAMENTO,
					
					REP_CUSTOREFEICAO,
					REP_CUSTOHOSPEDAGEM,
					REP_CUSTOPECAS,
					REP_CUSTOEXTRA,
					REP_DESCONTO,
					
					
					REP_LOCKED,

					REP_DETALHADO,
					REP_MOSTRACUSTOEXTRA, 
					
					REP_OBSPRIVADA
					
					
					
					) 
					VALUES (
						'".$_POST['codCli']."', '".dtos($_POST['reportdata'])."', '".$_POST['reportmaquina']."', '".$_POST['reportnummaquina']."', '".$_POST['reportmodelomaquina']."', 
						'".$_POST['reportpedidocliente']."', '".addslashes($_POST['reportselecteddefects'])."', '".str_replace(',', '.', str_replace('.', '', $_POST['reportvalor']))."', '".addslashes($_POST['reportsolucao'])."', '".addslashes($_POST['reportdesccustoextra'])."', '".$_POST['reportsolicitante']."', '".$_POST['reportgarantia']."', '".str_replace('.', '', $_POST['reportkm'])."',
						'".dtos($_POST['reportdata1'])."', '".$_POST['hourin1']."', '".$_POST['hourout1']."', 
						'".dtos($_POST['reportdata2'])."', '".$_POST['hourin2']."', '".$_POST['hourout2']."', 
						'".dtos($_POST['reportdata3'])."', '".$_POST['hourin3']."', '".$_POST['hourout3']."',  
						'".dtos($_POST['reportdata4'])."', '".$_POST['hourin4']."', '".$_POST['hourout4']."',	
						'".dtos($_POST['reportdata5'])."', '".$_POST['hourin5']."', '".$_POST['hourout5']."',  
						'".dtos($_POST['reportdata6'])."', '".$_POST['hourin6']."', '".$_POST['hourout6']."',							
						'".$_POST['intervalo1']."', '".$_POST['intervalo2']."', '".$_POST['intervalo3']."', '".$_POST['intervalo4']."', '".$_POST['intervalo5']."',  '".$_POST['intervalo6']."',
						'".$_POST['tempodeslocamento']."',
						'".$_POST['equipe1']."', '".$_POST['equipe2']."', '".$_POST['equipe3']."', '".$_POST['equipe4']."', '".$_POST['equipe5']."',  '".$_POST['equipe5']."',
						'".$_POST['prazoPagamento']."',
						'".$_SESSION['uid']."', '".$_SESSION['nome']."', '', 
						
						'".$_POST['valhoratecnica']."',
						'".$_POST['valhoraaux']."',
						'".$_POST['valkmrodado']."',
						'".$_POST['valhoradeslocamento']."',
						'".str_replace(',', '.', str_replace('.', '', $_POST['reporthoratecnicatotal']))."',
						'".str_replace(',', '.', str_replace('.', '', $_POST['reportcustodeslocamento']))."',
						'".str_replace(',', '.', str_replace('.', '', $_POST['reportcustotempodedeslocamento']))."',
						
						
						
						'".str_replace(',', '.', str_replace('.', '', $_POST['reportcustorefeicao']))."',
						'".str_replace(',', '.', str_replace('.', '', $_POST['reportcustohospedagem']))."',
						'".str_replace(',', '.', str_replace('.', '', $_POST['reportcustopecas']))."',
						'".str_replace(',', '.', str_replace('.', '', $_POST['reportcustoextra']))."',
						'".str_replace(',', '.', str_replace('.', '', $_POST['reportdesconto']))."',
						
						'',
						
						'".$_POST['informacoesDetalhadas']."',
						'".$_POST['informacoesCustoExtra']."',
						'".addslashes($_POST['reportobsprivada'])."'

							);";
						//echo $queryInsert; die();
					if ($mysqli->query($queryInsert) == true) {	
						
						echo "OK"; die();
						//include('./mailnewReport.php');
					} else {
						echo "Error: " . $queryInsert . "<br>" . $mysqli->error;
					}
  }
  
  
  
  
  
  if($_POST['funcao'] == "editaOrcamento"){
	  
		$sqlupdate = "
			UPDATE tb_orcamentos SET 
			ORC_DATA ='".dtos($_POST['ORC_DATA'])."',
			ORC_MAQUINA ='".$_POST['ORC_MAQUINA']."',
			ORC_NUMMAQUINA ='".$_POST['ORC_NUMMAQUINA']."',
			ORC_MODMAQUINA ='".$_POST['ORC_MODMAQUINA']."',
			ORC_PEDIDOCLI ='".$_POST['ORC_PEDIDOCLI']."',
			ORC_DEFEITOS ='".$_POST['ORC_DEFEITOS']."',
			ORC_TOTAL ='".$_POST['ORC_TOTAL']."',
			ORC_DESCRICAO ='".$_POST['ORC_DESCRICAO']."',
			ORC_SOLUCAO ='".$_POST['ORC_SOLUCAO']."',
			ORC_MATERIAIS ='".$_POST['ORC_MATERIAIS']."',
			ORC_DIAS ='".$_POST['ORC_DIAS']."',
			ORC_SOLICITANTE ='".$_POST['ORC_SOLICITANTE']."',
			ORC_PRAZOPAGAMENTO ='".$_POST['ORC_PRAZOPAGAMENTO']."'
			WHERE ORC_CODIGO ='".$_POST['codigo']."';";	  
			//echo $sqlupdate; die();
			if ($mysqli->query($sqlupdate) == true) {
				echo "OK";
				die();
			}
			else{
				echo  "ERROR";
				die();
			}
			
			
	  
  }
  
  if($_POST['funcao'] == "editaUsuario"){
	  
	  /*
					codCli : $("#userCliente").attr('cliente'),
					descCli : $("#userCliente").val(),*/
					
	$querySenha = !empty(trim($_POST['senha'])) ? " USU_SENHA='".md5($_POST['senha'])."', " : "";

	  $sqlupdate = "UPDATE tb_usuario SET 
	  USU_NOME='".mb_strtoupper($_POST['nome'])."', 
	  ".$querySenha."	  
	  USU_CLIENTE= '".$_POST['codCli']."',
	  USU_DESC_CLI ='".$_POST['descCli']."' 	  
	  WHERE USU_ID ='".$_POST['codigo']."';";

		if ($mysqli->query($sqlupdate) == true) {		   
			echo "OK";
		} else {
			echo "Error updating record: " . $mysqli->error;
		}
	  
  }
  
  
  if($_POST['funcao'] == "editarelatorio"){
		
		$sqlupdate = "UPDATE tb_report SET 
				
					REP_MAQUINA ='".$_POST['reportmaquina']."',                   
                    REP_NUMMAQUINA ='".$_POST['reportnummaquina']."',
                    REP_MODMAQUINA ='".$_POST['reportmodelomaquina']."',
                    REP_PEDIDOCLI ='".$_POST['reportpedidocliente']."',
                    REP_DEFEITOS ='".addslashes($_POST['reportselecteddefects'])."',
                    REP_TOTAL ='".str_replace(',', '.', str_replace('.', '', $_POST['reportvalor']))."',
                    REP_SOLUCAO ='".addslashes($_POST['reportsolucao'])."',
					REP_DESCCUSTOEXTRA ='".addslashes($_POST['reportdesccustoextra'])."',
                    REP_SOLICITANTE ='".$_POST['reportsolicitante']."',
					REP_GARANTIA ='".$_POST['reportgarantia']."',
					REP_KM ='".str_replace('.', '', $_POST['reportkm'])."', 
					
					REP_DATA1 ='".dtos($_POST['reportdata1'])."',
					REP_DATA2 ='".dtos($_POST['reportdata2'])."',
					REP_DATA3 ='".dtos($_POST['reportdata3'])."',
					REP_DATA4 ='".dtos($_POST['reportdata4'])."',
					REP_DATA5 ='".dtos($_POST['reportdata5'])."',
					REP_DATA6 ='".dtos($_POST['reportdata6'])."',
					
					REP_HORAENTRADA1 ='".$_POST['hourin1']."',
					REP_HORAENTRADA2 ='".$_POST['hourin2']."',
					REP_HORAENTRADA3 ='".$_POST['hourin3']."',					
					REP_HORAENTRADA4 ='".$_POST['hourin4'] ."',
					REP_HORAENTRADA5 ='".$_POST['hourin5']."',					
					REP_HORAENTRADA6 ='".$_POST['hourin6'] ."',
					
					REP_HORASAIDA1 ='".$_POST['hourout1']."',
					REP_HORASAIDA2 ='".$_POST['hourout2']."',
					REP_HORASAIDA3 ='".$_POST['hourout3']."',
					REP_HORASAIDA4 ='".$_POST['hourout4']."',
					REP_HORASAIDA5 ='".$_POST['hourout5']."',
					REP_HORASAIDA6 ='".$_POST['hourout6']."',
					
					REP_ITERVALO1 ='".$_POST['intervalo1']."',
					REP_ITERVALO2 ='".$_POST['intervalo2']."',
					REP_ITERVALO3 ='".$_POST['intervalo3']."',
					REP_ITERVALO4 ='".$_POST['intervalo4']."',	
					REP_ITERVALO5 ='".$_POST['intervalo5']."',	
					REP_ITERVALO6 ='".$_POST['intervalo6']."',	
					
					REP_TEMPODESLOCAMENTO ='".$_POST['tempodeslocamento']."',	
					
					REP_EQUIPE1 ='".$_POST['equipe1']."',
					REP_EQUIPE2 ='".$_POST['equipe2']."',
					REP_EQUIPE3 ='".$_POST['equipe3']."',
					REP_EQUIPE4 ='".$_POST['equipe4']."',	
					REP_EQUIPE5 ='".$_POST['equipe5']."',	
					REP_EQUIPE6 ='".$_POST['equipe6']."',	
					
					
					REP_VALHORATECNICATOTAL = '".str_replace(',', '.', str_replace('.', '', $_POST['reporthoratecnicatotal']))."',
					REP_CUSTODESLOCAMENTO = '".str_replace(',', '.', str_replace('.', '', $_POST['reportcustodeslocamento']))."',
					
					REP_CUSTOREFEICAO = '".str_replace(',', '.', str_replace('.', '', $_POST['reportcustorefeicao']))."',
					REP_CUSTOHOSPEDAGEM = '".str_replace(',', '.', str_replace('.', '', $_POST['reportcustohospedagem']))."',
					REP_CUSTOPECAS = '".str_replace(',', '.', str_replace('.', '', $_POST['reportcustopecas']))."',
					REP_CUSTOEXTRA = '".str_replace(',', '.', str_replace('.', '', $_POST['reportcustoextra']))."',
					REP_DESCONTO = '".str_replace(',', '.', str_replace('.', '', $_POST['reportdesconto']))."',
					REP_CUSTOTEMPODESLOCAMENTO = '".str_replace(',', '.', str_replace('.', '', $_POST['reportcustotempodedeslocamento']))."',
					
					REP_DETALHADO ='".$_POST['informacoesDetalhadas']."',
					REP_MOSTRACUSTOEXTRA ='".$_POST['informacoesCustoExtra']."',
 
					REP_OBSPRIVADA  ='".addslashes($_POST['reportobsprivada'])."',
					
					REP_PRAZOPAGAMENTO ='".$_POST['prazoPagamento']."'
					
		

					WHERE REP_CODIGO ='".$_POST['codigo']."';";
					//echo $sqlupdate."teste"; die();
					//echo $sqlupdate; die();	
					
					if ($mysqli->query($sqlupdate) == true) {
						
						echo "OK"; die();
					} else{
							
							echo "Error updating record: " . $mysqli->error;
							
						}
						
					
					
					
  }
		
  
  
 if($_GET['funcao'] == "searchDefeitoModal"){
					
			$query = ("SELECT * FROM tb_defects 
			WHERE DEF_DESC LIKE '%".$_GET['search']."%' 
			ORDER BY DEF_DESC DESC
			LIMIT ".$_GET['limit']." ");
			//UF	Minic�pio	N�mero	Bairro	CEP	TELEFONE
			$resultado = $mysqli->query($query); 
			
			if(mysqli_num_rows($resultado) > 0)
			{  	
				while($row = $resultado->fetch_array())
				{			
					
					echo "<tr>";
						echo "<td >						
							
							<button type='button' 
							style='padding: 4px 7px;    margin-bottom: 0;    font-size: 9px;'
							
							descricao='".$row['DEF_DESC']."' 
							
							title='Selecionar'  class='btn btn-success selectDefeito'><i class='fa fa-check'></i></button>
						</td>";							
						echo " <td style='text-align:left;' >".$row['DEF_DESC']."</td>";						
						
					echo " </tr> ";												
				}
			}
			else{
				
						echo "<tr><td colspan=2>	Nenhum Resultado</td> </tr>";
			}
		
		}

		
        if($_GET['funcao'] == "searchClientModal"){
					
			$query = ("SELECT * FROM tb_clientes 
			where (CLI_NOME LIKE '%".$_GET['search']."%' 
			OR CLI_CNPJRG LIKE '%".$_GET['search']."%'
			OR CLI_ESTADO LIKE '%".$_GET['search']."%'
			OR CLI_CODIGO LIKE '%".$_GET['search']."%'
			OR CLI_MUN LIKE '%".$_GET['search']."%')
			ORDER BY CLI_CODIGO DESC LIMIT ".$_GET['limit']." "); 
			//UF	Minic�pio	N�mero	Bairro	CEP	TELEFONE
			$resultado = $mysqli->query($query); 
			
			if(mysqli_num_rows($resultado) > 0)
			{  	
				while($row = $resultado->fetch_array())
				{			
					
					echo "<tr>";
						echo "<td >						
							
							<button type='button' 
							style='padding: 4px 7px;    margin-bottom: 0;    font-size: 9px;'
							
							cliente='".$row['CLI_CODIGO']."' 
							nome='".$row['CLI_NOME']."' 
							solicitante='".$row['CLI_CONTATO']."' 
							documento='".$row['CLI_CNPJRG']."' 
							endereco='".$row['CLI_ENDERECO']."'
							numero='".$row['CLI_NUMERO']."'
							estado='".$row['CLI_ESTADO']."'
							cep='".$row['CLI_CEP']."'
							municipio='".$row['CLI_MUN']."'
							title='Selecionar'  class='btn btn-success selectCliente'><i class='fa fa-check'></i></button>
						</td>";							
						echo " <td style='text-align:left;' >".$row['CLI_NOME']."</td>";						
						echo " <td>".$row['CLI_CNPJRG']."</td>";
						echo " <td style='text-align:left;'>".$row['CLI_MUN'].' - '.$row['CLI_ESTADO']."</td>";
					echo " </tr> ";												
				}
			}else{
				
						echo "<tr><td colspan=2>	Nenhum Resultado</td> </tr>";
			}
		
		}
 
 
 
 
 
		
  if($_GET['funcao'] == "getValoresPadrao"){
	  
	  $query = ("SELECT * FROM tb_configvalues ORDER BY VAL_ID DESC LIMIT 1"); 
	  
	  $resultado = $mysqli->query($query); 
			
			if(mysqli_num_rows($resultado) > 0)
			{  	
				while($row = $resultado->fetch_array())
				{
					echo "<tr>";
						echo " <td>R$ ".moeda($row['VAL_HORATECNICA'])."</td>";
						echo " <td>R$ ".moeda($row['VAL_HORAAUX'])."</td>";
						echo " <td>R$ ".moeda($row['VAL_KMRODADO'])."</td>";
						echo " <td>R$ ".moeda($row['VAL_HORADESLOCAMENTO'])."</td>";
					echo "</tr>";

					
				}
			}
	  
  }
  
  
  
  if($_GET['funcao'] == "getValorKmRodado"){
		 
		
		if(strlen($_GET['codigo']) > 0){ //se for edição 
		
			$query = "SELECT REP_VALKMRODADO AS VALORKMRODADO FROM tb_report where REP_CODIGO = '".$_GET['codigo']."'  ";
		//echo $query; die();
				$resultado = $mysqli->query($query); 
				
				if(mysqli_num_rows($resultado) > 0)
				{				
					$consulta = $resultado->fetch_array();
					$retorno = $consulta; // irá retornar todos os campos 
				}
			//echo $query;
			//return;
			//echo $query;
			echo  json_encode($retorno);	
		
		}else{
			$query = ("SELECT VAL_KMRODADO as VALORKMRODADO FROM tb_configvalues ORDER BY VAL_ID DESC LIMIT 1"); 

			$resultado = $mysqli->query($query); 

			if(mysqli_num_rows($resultado) > 0)
			{				
				$consulta = $resultado->fetch_array();
				$retorno = $consulta; // irá retornar todos os campos 
			}

			echo  json_encode($retorno);
			
		}
	  
  }
  
  
  
  
    if($_GET['funcao'] == "getValoresPadraoJson"){
		
		if($_GET['edicaoOuInclusao'] == 1){ //se for inclusão 
			$query = ("SELECT * FROM tb_configvalues ORDER BY VAL_ID DESC LIMIT 1"); 

			$resultado = $mysqli->query($query); 

			if(mysqli_num_rows($resultado) > 0)
			{				
				$consulta = $resultado->fetch_array();
				$retorno = $consulta; // irá retornar todos os campos 
			}

			echo  json_encode($retorno);

		}
		if($_GET['edicaoOuInclusao']  == 2){ //se for edição 
		
			$query = "SELECT * FROM tb_report where REP_CODIGO = '".$_GET['codigo']."'  ";
		//echo $query; die();
				$resultado = $mysqli->query($query); 
				
				if(mysqli_num_rows($resultado) > 0)
				{				
					$consulta = $resultado->fetch_array();
					$retorno = $consulta; // irá retornar todos os campos 
				}
			//echo $query;
			//return;
			//echo $query;
			echo  json_encode($retorno);	
		
		}
	  
  }
 
 
	/*  if($_GET['funcao'] == "getValorDaHora"){
	  
	
	  
	  if($_GET['equipe'] == "1"){ $campo = " VAL_HORATECNICA as VALOR";}
	  if($_GET['equipe'] == "2"){ $campo = " VAL_HORATECNICA+VAL_HORAAUX  as VALOR";}
	  if($_GET['equipe'] == "3"){ $campo = " VAL_HORAAUX  as VALOR";}
	  
	  $query = ("SELECT ".$campo." FROM tb_configvalues ORDER BY VAL_ID DESC LIMIT 1"); 
	  
	  $resultado = $mysqli->query($query); 
	  
			
			if(mysqli_num_rows($resultado) > 0)
				{				
					$consulta = $resultado->fetch_array();
					$retorno = $consulta; // irá retornar todos os campos 
				}
			
			echo  json_encode($retorno);
	 // echo  $query;
  }
 */
 
 
 
        if($_GET['funcao'] == "searchClient"){
					
		
		
			$query = ("SELECT * FROM tb_clientes 
			where (CLI_NOME LIKE '%".$_GET['search']."%' 
			OR CLI_CODIGO LIKE '%".$_GET['search']."%'
			OR CLI_CNPJRG LIKE '%".$_GET['search']."%'
			OR CLI_ESTADO LIKE '%".$_GET['search']."%'
			OR CLI_MUN LIKE '%".$_GET['search']."%'
			OR CLI_NUMERO LIKE '%".$_GET['search']."%'
			OR CLI_BAIRRO LIKE '%".$_GET['search']."%'
			OR CLI_CEP LIKE '%".$_GET['search']."%'
			OR CLI_TELEFONE LIKE '%".$_GET['search']."%')
			ORDER BY CLI_CODIGO DESC LIMIT ".$_GET['limit']." ");
			//UF	Minic�pio	N�mero	Bairro	CEP	TELEFONE
			$resultado = $mysqli->query($query); 
			
			if(mysqli_num_rows($resultado) > 0)
			{  	
				while($row = $resultado->fetch_array())
				{
					
					$edicaoExclusaoClientes = "";
					
					
						
						
						if($row['CLI_USUARIO'] == $_SESSION['uid'] ){							
							
							$edicaoExclusaoClientes = " 
								<button type='button' onclick=\"editCliente(".$row['CLI_CODIGO'].")\" title='Editar'  class='btn btn-primary btn-circle'><i class='fa fa-edit'></i></button>
								<button type='button' onclick=\"excluirCliente(".$row['CLI_CODIGO'].", '".$row['CLI_NOME']."' )\" title='Excluir'  class='btn btn-warning btn-circle'><i class='fa fa-times'></i></button>
							";						
								
						}else{
							
							$edicaoExclusaoClientes = " 
								<button type='button'  title='Impossível Editar'  class='btn btn-warning btn-circle' style='background-color: #AEAEAE !important;  border-color: #BEBEBE !important;';><i class='fa fa-edit'></i></button>
								<button type='button'  title='Impossível Excluir'  class='btn btn-warning btn-circle' style='background-color: #AEAEAE !important;  border-color: #BEBEBE !important;';><i class='fa fa-times'></i></button>
							";	
							
						}
						
						if($_SESSION['permissao'] == '1'){							
							
							$edicaoExclusaoClientes = " 
								<button type='button' onclick=\"editCliente(".$row['CLI_CODIGO'].")\" title='Editar'  class='btn btn-primary btn-circle'><i class='fa fa-edit'></i></button>
								<button type='button' onclick=\"excluirCliente(".$row['CLI_CODIGO'].", '".$row['CLI_NOME']."' )\" title='Excluir'  class='btn btn-warning btn-circle'><i class='fa fa-times'></i></button>
							";						
								
						}

								
					//<button type='button' onclick=\"visualizarCliente(".$row['CLI_CODIGO'].")\" title='Visualizar'  class='btn btn-success btn-circle'><i class='fa fa-list'></i></button>
					echo "<tr>";
						echo "<td >						
							<meta charset='Windows-1252'>
							<!--visualização retirada-->
							".$edicaoExclusaoClientes."
                            </button>
						</td>";	
						echo " <td>".$row['CLI_CODIGO']."</td>";
						echo " <td >".$row['CLI_NOME']."</td>";
						echo " <td>".$row['CLI_LOJA']."</td>";
						echo " <td>".$row['CLI_CNPJRG']."</td>";
						echo " <td>".$row['CLI_ESTADO']."</td>";
						echo " <td >".$row['CLI_MUN']."</td>";
						echo " <td>".$row['CLI_NUMERO']."</td>";
						echo " <td>".$row['CLI_BAIRRO']."</td>";
						echo " <td>".$row['CLI_CEP']."</td>";
						echo " <td>".$row['CLI_TELEFONE']."</td>";
						echo " <td>".$row['CLI_USUARIO_NOME']."</td>"; 
						//echo " <td>".substr($row['CLI_DATACADASTRO'], 6, 2)."/".substr($row['CLI_DATACADASTRO'], 4, 2)."/".substr($row['CLI_DATACADASTRO'], 0, 4)."</td>";
						/*echo " <td>
								<a href='?excluir=".$row['CLI_CODIGO']."'><button type='button' title='Excluir'  class='btn btn-warning btn-circle'><i class='fa fa-times'></i></button></a>
								</td>";	
								*/								
					
					echo " </tr> ";												
				}
			}
		
		}	
		
		
		//continuar da correção da edição e exclusão de usuários
		//par aposterior desativar toda a parte de "pagamentos " e
		//continuar o desenvolvimento
		//o objetivo é criar logins para cliente poderem assinar os
		//relatórios
		
		 if($_GET['funcao'] == "searchUsuarios"){
			$tratasomenteCliente = $_GET['somenteCliente'] == "somenteCliente" ? " AND USU_PERMISSAO = '2'" : " AND USU_PERMISSAO != '2'";
				
			$query = "SELECT USU_ID, USU_USUARIO, USU_PERMISSAO, USU_NOME , USU_DESC_CLI FROM tb_usuario 
			where (USU_USUARIO LIKE '%".$_GET['search']."%' 
			OR USU_NOME LIKE '%".$_GET['search']."%' 
			OR USU_DESC_CLI LIKE '%".$_GET['search']."%')
			".$tratasomenteCliente;
				
					$resultado = $mysqli->query($query); 
			if(mysqli_num_rows($resultado) > 0)
			{  	
				while($row = $resultado->fetch_array()){
					
				echo " <tr>";
					echo " <td>".$row['USU_ID']."</td>";
					if($row['USU_PERMISSAO'] == '1' || $row['USU_PERMISSAO'] == '3'){
							echo " <td>".$row['USU_NOME']."</td>";
					}else{
						echo " <td>".$row['USU_DESC_CLI']."</td>";
					}
					
					echo " <td>".$row['USU_USUARIO']."</td>";
					
					if($row['USU_PERMISSAO'] == '1' ){
						echo " <td>Administrador</td>";
					}
					if($row['USU_PERMISSAO'] == '2' ){
						echo " <td>Cliente</td>";
					}
					if($row['USU_PERMISSAO'] == '3' ){
						echo " <td>Funcionário/Parceiro</td>"; 
					}
					
					echo " <td>";
					echo "<button type='button' usuario='".$row['USU_ID']."' title='Editar'  class='btn btn-primary btn-circle editUsuario'><i class='fa fa-edit'></i></button>";
					//echo "<button type='button' onclick=\"editUsuario(".$row['USU_ID'].")\" title='Editar'  class='btn btn-primary btn-circle'><i class='fa fa-edit'></i></button>";
					
					if($row['USU_ID'] == $uid){
						
							//echo " <button type='button'  title='Não é possível excluir seu próprio usuário.'  class='btn btn-warning btn-circle' style='background-color: #AEAEAE !important;  border-color: #BEBEBE !important;';><i class='fa fa-times'></i></button>";
							
					}else{	
						echo "<button type='button' '".$uid."' nomeUser='".$row['USU_NOME']." - ".$row['USU_DESC_CLI']."' user='".$row['USU_ID']."' cliente='".$row['CLI_NOME']."'  title='Excluir'  class='btn btn-warning btn-circle excluirUser'><i class='fa fa-times'></i></button>	";
					}	
						echo "</td>"; 											
					echo " </tr> ";												
				}
			}
			 
			 
		 }
			 
		  
		  
		 if($_GET['funcao'] == "searchReport"){
			 
					
			 
			/*$status = explode('  ', mysql_stat($conexao_fas));
			print_r($status);
			 return;
			 */
			 
			//include('../../includes/dbconfig.php');		
				
			//$db = new DbConfig();
			//fazer inner com a tabela de clientes para pegar as informa��es
			
			$filtroUsuario = " ";
			//filtro de usuario excluido por solicitação da SUELEN EM 22/02/2022
			//if($_SESSION['permissao'] != '1'){					 
				//$filtroUsuario = " AND REP_USUARIO = '".$_SESSION['uid']."' ";
			//}
			
			
			$query = ("SELECT * FROM tb_report
			INNER JOIN tb_clientes ON CLI_CODIGO = REP_CLIENTE
			where (CLI_NOME LIKE '%".$_GET['search']."%' 
			OR REP_CODIGO LIKE '%".$_GET['search']."%' 
			OR REP_DEFEITOS LIKE '%".$_GET['search']."%'
			OR REP_USUARIO_NOME LIKE '%".$_GET['search']."%'
			)	
			".$filtroUsuario."
			ORDER BY REP_CODIGO DESC LIMIT ".$_GET['limit']." ");
			//UF	Minic�pio	N�mero	Bairro	CEP	TELEFONE
			
			
			$resultado = $mysqli->query($query); 
			
			if(mysqli_num_rows($resultado) > 0)
			{  	
				while($row = $resultado->fetch_array())
				{
						
					echo " <tr>";
						echo " <td >						
						<meta charset='Windows-1252'>";
						//<button type='button'  report='".$row['REP_CODIGO']."' title='Visualizar'  class='btn btn-success btn-circle visualizarReport'><i class='fa fa-list'></i></button>";
						
						
						//$queryReport = ("SELECT * FROM tb_pagamentos 
						//WHERE PAG_REPORT = '".$row['REP_CODIGO']."'  AND PAG_PAGO = 'S'");
						/*AND (PAG_STATUS <> '' 
								OR PAG_NOTIFICATION_CODE <> '' 
								OR PAG_TRANSACTION_CODE <> '' OR PAG_STATUS_DESC <> '') ");
					*/
						
						//$resultadopag = $mysqli->query($queryReport); 
			
						//if(mysqli_num_rows($resultadopag) > 0)
						//{  	
							//echo "<button type='button'  title='Impossivel alterar. Ha pagamentos ja efetuados ou em andamento'  class='btn btn-primary btn-circle' style='background-color: #AEAEAE !important;  border-color: #BEBEBE !important;';><i class='fa fa-edit' ></i></button>";
							//echo "<button type='button' title='Impossivel excluir. Ha pagamentos ja efetuados ou em andamento'  class='btn btn-primary btn-circle' style='background-color: #AEAEAE !important;  border-color: #BEBEBE !important;';><i class='fa fa-times'></i></button>
								//</td>";	
						//}else//{
							$corBotaoEditar = "";
							if($row['REP_LOCKED'] == "1" && $_SESSION['permissao'] != '1'){	
								$corBotaoEditar = "color: #383838; border-color: #afafaf;  background-color: #d3d3d3  !important; ";
							}
								echo "<button type='button' report='".$row['REP_CODIGO']."' title='Editar'  class='btn btn-primary btn-circle editReport' style='".$corBotaoEditar."'><i class='fa fa-edit'></i></button>";
							
							
							if($row['REP_ASSINADO'] != "" ){
							echo "<button type='button'  report='".$row['REP_CODIGO']."' data='".$row['REP_DATA']."'  title='Gerar Relatorio'  class='btn btn-success btn-circle generateReport'><i class='fa fa-file-o'></i></button> ";
						
							}else{
								echo "<button type='button'  report='".$row['REP_CODIGO']."' data='".$row['REP_DATA']."'  title='Gerar Relatorio'  class='btn btn-success btn-circle generateReport' style='background-color: #AEAEAE !important;  border-color: #BEBEBE !important;'><i class='fa fa-file-o'></i></button> ";
								
							}
							
							
		
							
							if($row['REP_LOCKED'] == "" ){								
								echo "<button type='button' report='".$row['REP_CODIGO']."' cliente='".$row['CLI_NOME']."' title='Fechar Relatório'  class='btn btn-default btn-circle abreOufecharRelatorio' acao='fechar' style='margin-left: 15px;  background-color: #fff  !important;  border-color: #BEBEBE !important; '><i class='fa fa-unlock'></i></button>";	
							}
							if($row['REP_LOCKED'] == "1" && $_SESSION['permissao'] == '1'){							
								echo "<button type='button' report='".$row['REP_CODIGO']."' cliente='".$row['CLI_NOME']."' title='Reabrir Relatório'  class='btn btn-default btn-circle abreOufecharRelatorio'  acao='abrir' style='margin-left: 15px;  background-color: #fff  !important;  border-color: #BEBEBE !important; '><i class='fa  fa-lock'></i></button>";	
							}
									
									
									echo "</td>";	
						//}
						
						echo " <td>".$row['REP_CODIGO']."</td>";
						echo " <td style='white-space: nowrap;'>".explode(" ", $row['CLI_NOME'])[0]." ".explode(" ", $row['CLI_NOME'])[1]."</td>";
						echo " <td >".$row['REP_DEFEITOS']."</td>";
						echo " <td style='white-space: nowrap;'>".$row['REP_MAQUINA']."</td>";
						echo " <td>".dtoc($row['REP_DATA'])."</td>";
						//echo " <td>".$row['CLI_MUN']."</td>";
						echo " <td style='white-space: nowrap;'>".$row['REP_USUARIO_NOME']."</td>";						
						echo "<td >	";
						
						if($row['REP_LOCKED'] == "" ||  $_SESSION['permissao'] == '1'){
							echo "<button type='button' report='".$row['REP_CODIGO']."' cliente='".$row['CLI_NOME']."'  title='Excluir Relatório'  class='btn btn-warning btn-circle excluirReport' ><i class='fa fa-times'></i></button>	";
						}
						
						if($_SESSION['permissao'] != '3'){
							if($row['REP_ASSINADO'] != "" ){
								
								//echo "	<button type='button'  report='".$row['REP_CODIGO']."'  cliente='".$row['CLI_NOME']."'  data='".$row['REP_DATA']."'  email='".$row['CLI_EMAIL']."'   title='Enviar Relatorio'  class='btn btn-primary btn-circle sendReport'><i class='fa fa-send'></i></button>  ";
								echo "<button type='button' report='".$row['REP_CODIGO']."' cliente='".$row['CLI_NOME']."' title='Excluir Assinatura'  class='btn btn-warning btn-circle excluirAssinatura' style='margin-left: 15px;  background-color: #000000  !important;  border-color: #BEBEBE !important; '><i class='fa fa-times'></i></button>";	
							}else{
								
								//echo "	<button type='button'    title='Impossível enviar relatório não assinado'  style='background-color: #AEAEAE !important;  border-color: #BEBEBE !important;' class='btn btn-primary btn-circle'><i class='fa fa-send'></i></button>  ";
								
							}
						}
						
						
						
						
						
						
						echo "	</td>";	
						
					echo " </tr> ";												
				}
			}
		
		}
		
		
		if($_GET['funcao'] == "searchReportClientes"){
			 
			
			$query = ("SELECT * FROM tb_report
			INNER JOIN tb_clientes ON CLI_CODIGO = REP_CLIENTE
			where (CLI_NOME LIKE '%".$_GET['search']."%' 
			OR REP_CODIGO LIKE '%".$_GET['search']."%' 
			OR REP_DEFEITOS LIKE '%".$_GET['search']."%'
			OR REP_USUARIO_NOME LIKE '%".$_GET['search']."%'
			)
			AND REP_CLIENTE = '".$_SESSION['clientecod']."'
			
			ORDER BY REP_CODIGO DESC LIMIT ".$_GET['limit']." ");
			//UF	Minic�pio	N�mero	Bairro	CEP	TELEFONE
			
			
			$resultado = $mysqli->query($query); 
			
			if(mysqli_num_rows($resultado) > 0)
			{  	
				while($row = $resultado->fetch_array())
				{
						
					echo " <tr>";
						echo " <td >";
						if($row['REP_ASSINADO'] == "" ){
							
							echo "<button type='button'  report='".$row['REP_CODIGO']."' data='".$row['REP_DATA']."'  title='Gerar Relatorio'  class='btn btn-success btn-circle generateReport' style='background-color: #AEAEAE !important;  border-color: #BEBEBE !important;'><i class='fa fa-file-o'></i></button> ";
							echo "<button type='button' report='".$row['REP_CODIGO']."' title='Editar'  class='btn btn-primary btn-circle editReport'><i class='fa fa-edit'></i></button>";
							
						}else{
							
							echo "<button type='button'  report='".$row['REP_CODIGO']."' data='".$row['REP_DATA']."'  title='Gerar Relatorio'  class='btn btn-success btn-circle generateReport'><i class='fa fa-file-o'></i></button> ";
							echo "<button type='button' title='Esse relatório já foi assinado...entre em contato com o Administrador'  class='btn btn-primary btn-circle ' style='background-color: #AEAEAE !important;  border-color: #BEBEBE !important;'><i class='fa fa-edit'></i></button>";
						
						
						}
						
						
							
						echo "</td>";	
						
						
						echo " <td>".$row['REP_CODIGO']."</td>";
						
						
						echo " <td>".$row['REP_MAQUINA']."</td>";
						echo " <td>".dtoc($row['REP_DATA'])."</td>";
						
					
						
					echo " </tr> ";												
				}
			}
		
		}
		
		
		if($_GET['funcao'] == "excluirAssinaturaRelatorio"){
			 
			 $relatorio = $_GET['id'];			 
					
			
			$sql = "UPDATE tb_report SET REP_ASSINADO='' WHERE REP_CODIGO='".$relatorio."';";
			
			if ($mysqli->query($sql) == true) {		   
				echo "1";
			} else {
				echo "Error updating record: " . $mysqli->error;
			}
		 }
		 
		 
		 if($_GET['funcao'] == "abreOufecharRelatorio"){
			 
			 $relatorio = $_GET['id'];			 
			 $status;
			 
			 if($_GET['acao'] == "abrir"){
				 $status = "";
			 }
			
			if($_GET['acao'] == "fechar"){ 
				 $status = "1";
			 }
			$sql = "UPDATE tb_report SET REP_LOCKED='".$status."' WHERE REP_CODIGO='".$relatorio."';";
			
			if ($mysqli->query($sql) == true) {		   
				echo "1";
			} else {
				echo "Error updating record: " . $mysqli->error;
			}
		 }
		 
		 
		 
		
		
		 if($_GET['funcao'] == "excluirRelatorio"){
			 
			 $relatorio = $_GET['id'];			 
			 //echo $relatorio; die();
			  /* $where = array ('REP_CODIGO' => $_GET['excluir']);
				$db->delete('tb_report',$where);
				 $where = array ('PAG_REPORT' => $_GET['excluir']);
				$db->delete('tb_pagamentos',$where);
				echo "<META HTTP-EQUIV='REFRESH' CONTENT='0; URL=reports.php'>";
				die();*/
			
			
			$sql = ("DELETE FROM tb_report  WHERE REP_CODIGO = '".$relatorio."' ; ");

			$mysqli->query($sql);
			$sql = ("DELETE FROM tb_pagamentos  WHERE PAG_REPORT = '".$relatorio."' ; ");

			$mysqli->query($sql);
			
			ECHO "1";
		 }
		 
		 
		 
		 
		if($_GET['funcao'] == "excluirUsuario"){
			 
			$usuario = $_GET['id'];	
			
			$sql = ("DELETE FROM tb_usuario  WHERE USU_ID = '".$usuario."' ; ");

			$mysqli->query($sql);			
			
			ECHO "1";
		}
		
		 
		 
		if($_GET['funcao'] == "excluirOrcamento"){
			 
			$orcamento = $_GET['id'];	
			
			$sql = ("DELETE FROM tb_orcamentos  WHERE ORC_CODIGO = '".$orcamento."' ; ");

			$mysqli->query($sql);			
			
			ECHO "1";
		}
		
		
		
		 
		/* if($_GET['funcao'] == "searchReportByClient"){
			include('../../includes/dbconfig.php');		
				
			$db = new DbConfig();
			//fazer inner com a tabela de clientes para pegar as informa��es
				   
			$query = ("SELECT * FROM tb_report
			INNER JOIN tb_clientes ON CLI_CODIGO = REP_CLIENTE
			where  REP_TOTAL <> 0	AND (CLI_NOME LIKE '%".$_GET['search']."%' 
			OR REP_DEFEITOS LIKE '%".$_GET['search']."%') 		
			ORDER BY REP_CODIGO DESC LIMIT ".$_GET['limit']." ");
			//UF	Minic�pio	N�mero	Bairro	CEP	TELEFONE
			$resultado = $db->select2($query,'','fasmanutencao_com_br');
			
			if(count($resultado[0]) > 0)
			{  
				//include('mail.php?mail=daniel.daanna@gmail.com&nome=DanielDanna&id=9');
				foreach ($resultado as $row) {
					echo " <tr>";
						echo " <td >						
						<meta charset='Windows-1252'>
						<button type='button' onclick=\"visualizarReport(".$row['REP_CODIGO'].")\" title='Visualizar'  class='btn btn-success btn-circle'><i class='fa fa-usd'></i></button>
												
						</td>";	
						echo " <td>".$row['REP_CODIGO']."</td>";
						
						echo " <td>".$row['REP_SOLICITANTE']."</td>";
						echo " <td>".dtoc($row['REP_DATA'])."</td>";
						echo " <td>".$row['CLI_MUN']."</td>";	
						echo " <td>".$row['REP_TOTAL']."</td>";						
					
						
					echo " </tr> ";												
				}
			}
		
		}*/	
		
		 if($_GET['funcao'] == "searchOrcamento"){
			
			//fazer inner com a tabela de clientes para pegar as informa��es
				   
			$query = ("SELECT * FROM tb_orcamentos
			INNER JOIN tb_clientes ON CLI_CODIGO = ORC_CLIENTE
			where CLI_NOME LIKE '%".$_GET['search']."%' or
			ORC_DESCRICAO LIKE '%".$_GET['search']."%' OR
			ORC_MAQUINA LIKE '%".$_GET['search']."%' OR	
			ORC_CODIGO LIKE '%".$_GET['search']."%' 			
			ORDER BY ORC_CODIGO DESC LIMIT ".$_GET['limit']." ");
			//UF	Minic�pio	N�mero	Bairro	CEP	TELEFONE
			//$resultado = $db->select2($query,'','fasmanutencao_com_br');
			
			//echo $query; die();
			
			$resultado = $mysqli->query($query); 
			
			if(mysqli_num_rows($resultado) > 0)
			{  	
				while($row = $resultado->fetch_array())
				{
					//mostra as primeiras 11 palavras da descrição do defeito... e reticencias caso tenha mais que 11 palavras
					$orc_descricao_defeito = explode(" ", $row['ORC_DESCRICAO'])[0]." "; 
					$orc_descricao_defeito .= explode(" ", $row['ORC_DESCRICAO'])[2]." "; 
					$orc_descricao_defeito .= explode(" ", $row['ORC_DESCRICAO'])[3]." "; 
					$orc_descricao_defeito .= explode(" ", $row['ORC_DESCRICAO'])[4]." "; 
					$orc_descricao_defeito .= explode(" ", $row['ORC_DESCRICAO'])[5]." "; 
					$orc_descricao_defeito .= explode(" ", $row['ORC_DESCRICAO'])[6]." "; 
					$orc_descricao_defeito .= explode(" ", $row['ORC_DESCRICAO'])[7]." "; 
					$orc_descricao_defeito .= explode(" ", $row['ORC_DESCRICAO'])[8]." "; 
					$orc_descricao_defeito .= explode(" ", $row['ORC_DESCRICAO'])[9]." "; 
					$orc_descricao_defeito .= explode(" ", $row['ORC_DESCRICAO'])[10]." "; 
					$orc_descricao_defeito .= explode(" ", $row['ORC_DESCRICAO'])[11].""; 
					
					if(explode(" ", $row['ORC_DESCRICAO'])[11] != ""){
						$orc_descricao_defeito .= "..."; 
						
					}
					
					echo " <tr>";
						echo " <td >						
						<meta charset='Windows-1252'>						
						<button type='button' orcamento='".$row['ORC_CODIGO']."' title='Editar'  class='btn btn-primary btn-circle editOrcamento'><i class='fa fa-edit'></i></button>";
						echo "<button type='button' orcamento='".$row['ORC_CODIGO']."' data='".$row['ORC_DATA']."'   title='Gerar Orcamento'  class='btn btn-success btn-circle generateOrcamento'><i class='fa fa-file-o'></i></button></td>";	
						
						echo " <td>".$row['ORC_CODIGO']."</td>";
						echo " <td >".$row['CLI_NOME']."</td>";
						echo " <td>".$row['ORC_MAQUINA']."</td>";
						echo " <td>".$orc_descricao_defeito."</td>";
						echo " <td>".dtoc($row['ORC_DATA'])."</td>";
						echo " <td>".$row['CLI_MUN']."</td>";						
						
						echo "<td><button type='button' orcamento='".$row['ORC_CODIGO']."' cliente='".$row['CLI_NOME']."'  title='Excluir'  class='btn btn-warning btn-circle excluirOrcamento'><i class='fa fa-times'></i></button></td>";	
						
					echo " </tr> ";
//código do botão enviar orçamento fica abaixo do botao Gerar orçamento, mas foi retirado por solicitação do cliente <button type='button' orcamento='".$row['ORC_CODIGO']."'  cliente='".$row['CLI_NOME']."'  data='".$row['ORC_DATA']."'  email='".$row['CLI_EMAIL']."' title='Enviar Orcamento'  class='btn btn-primary btn-circle sendReport'><i class='fa fa-send'></i></button>
					
				}
			}		
		}
		
		if($_GET['funcao'] == "searchDefects"){
	
			$query = "SELECT * FROM tb_defects where DEF_DESC LIKE '%".$_GET['search']."%' ORDER BY DEF_CODIGO DESC LIMIT ".$_GET['limit']." ";
		
			$resultado = $mysqli->query($query); 
			
			if(mysqli_num_rows($resultado) > 0)
			{  	
				while($row = $resultado->fetch_array())
				{
					echo " <tr>";
						echo " <td >
						<meta charset='Windows-1252'>
						
						<button type='button' onclick=\"visualizarDefeito(".$row['DEF_CODIGO'].")\" title='Visualizar'  class='btn btn-success btn-circle'><i class='fa fa-list'></i></button>
						<button type='button' onclick=\"editDefeito(".$row['DEF_CODIGO'].")\" title='Editar'  class='btn btn-primary btn-circle'><i class='fa fa-edit'></i></button>
						<button type='button' onclick=\"excluirDefeito(".$row['DEF_CODIGO'].", '".$row['DEF_DESC']."' )\" title='Excluir'  class='btn btn-warning btn-circle'><i class='fa fa-times'></i></button>
						
                        
						</td>";	
						echo " <td>".$row['DEF_CODIGO']."</td>";
						echo " <td >".$row['DEF_DESC']."</td>";
					
					echo " </tr> ";												
				}
			}		
		}
		
		if($_GET['funcao'] == "searchFieldById"){
			//include('../../includes/dbconfig.php');		
				
			//$db = new DbConfig();	
			//mysql_set_charset('utf8');			
			//$retorno = array(); 
			$query = "SELECT * FROM tb_clientes where CLI_CODIGO = '".$_GET['id']."'  ";
		
				$resultado = $mysqli->query($query); 
				
				if(mysqli_num_rows($resultado) > 0)
				{				
					$consulta = $resultado->fetch_array();
					$retorno = $consulta; // irá retornar todos os campos 
				}
			//echo $query;
			//return;
			//echo $query;
			echo  json_encode($retorno);
				
			
				/*if(count($resultado[0]) > 0)
				{  
					foreach ($resultado as $row) {
						echo iconv("WINDOWS-1252//IGNORE", "UTF-8//IGNORE", $row[0]);												
					}
				}*/
		}

		
		
		if($_GET['funcao'] == "getUsuarioJson"){
			
			$query = "SELECT * FROM tb_usuario where USU_ID = '".$_GET['codigo']."'  ";
		
				$resultado = $mysqli->query($query); 
				
				if(mysqli_num_rows($resultado) > 0)
				{				
					$consulta = $resultado->fetch_array();
					$retorno = $consulta; // irá retornar todos os campos 
				}
			
			echo  json_encode($retorno);
		}
		
	if($_GET['funcao'] == "getClienteJson"){
			
			$query = "SELECT * FROM tb_clientes where CLI_CODIGO = '".$_GET['codigo']."'  ";
		
				$resultado = $mysqli->query($query); 
				
				if(mysqli_num_rows($resultado) > 0)
				{				
					$consulta = $resultado->fetch_array();
					$retorno = $consulta; // irá retornar todos os campos 
				}
			
			echo  json_encode($retorno);
		}

	
		
		
		
		if($_GET['funcao'] == "getRelatorioJson"){
			//include('../../includes/dbconfig.php');		
				
			//$db = new DbConfig();	
			//mysql_set_charset('utf8');			
			//$retorno = array(); 
			$query = "SELECT * FROM tb_report where REP_CODIGO = '".$_GET['codigo']."'  ";
		
				$resultado = $mysqli->query($query); 
				
				if(mysqli_num_rows($resultado) > 0)
				{				
					$consulta = $resultado->fetch_array();
					$retorno = $consulta; // irá retornar todos os campos 
				}
			//echo $query;
			//return;
			//echo $query;
			echo  json_encode($retorno);
				
			
				/*if(count($resultado[0]) > 0)
				{  
					foreach ($resultado as $row) {
						echo iconv("WINDOWS-1252//IGNORE", "UTF-8//IGNORE", $row[0]);												
					}
				}*/
		}	
		
		
		if($_GET['funcao'] == "getOrcamentoJson"){
			//include('../../includes/dbconfig.php');		
				
			//$db = new DbConfig();	
			//mysql_set_charset('utf8');			
			//$retorno = array(); 
			$query = "SELECT * FROM tb_orcamentos where ORC_CODIGO = '".$_GET['codigo']."'  ";
		
				$resultado = $mysqli->query($query); 
				
				if(mysqli_num_rows($resultado) > 0)
				{				
					$consulta = $resultado->fetch_array();
					$retorno = $consulta; // irá retornar todos os campos 
				}
			//echo $query;
			//return;
			//echo $query;
			echo  json_encode($retorno);
				
			
				
		}
		
		
		
		function moeda($valor)
		{
		  return number_format($valor, 2, ',', '.');
			
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

function dtos($data)
	{
	 $datafmt = substr($data, 6,4) . substr($data, 3,2) . substr($data, 0,2);
	 return $datafmt;
	}
/*$resultado->close(); 
unset($obj); 
unset($sql); 
unset($query); 
	*/	
?> 



