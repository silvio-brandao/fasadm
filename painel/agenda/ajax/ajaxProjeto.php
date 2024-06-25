<?php 
session_start();
		require_once '../functions.php';  

//echo isLoggedIn(); die();
if (isLoggedIn() == 'false')      
{  
    echo '<meta http-equiv="refresh" content="0; url=../index.php">'; die();
}

	 
	//-------------------banco de dados---------------------//
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
  	
	//-------------------banco de dados---------------------//	
	
	
	
	/*$resultado = $mysqli->query($query); 
			
			if(mysqli_num_rows($resultado) > 0)
			{  	
				while($row = $resultado->fetch_array())
				{
	*/
	
	
	if(isset($_POST['funcao']) && $_POST['funcao'] == "alteraDentistaSelecionado"){
		//echo $_POST['dataInicio']; die();
		
		$sqlinsert = ("UPDATE tb_usuario SET
			USU_SELECIONADO = 'N' 			
		 "); 

		echo $mysqli->query($sqlinsert);	
		
		$sqlinsert = ("UPDATE tb_usuario SET
		USU_SELECIONADO = 'S' 			
		WHERE  USU_ID = '".$_POST['codigo']."'; "); 			
		//echo $sqlinsert; die();
		echo $mysqli->query($sqlinsert);	 die(); 
		
	}
	
	if(isset($_POST['funcao']) && $_POST['funcao'] == "dragDropEvent"){
		//echo $_POST['dataInicio']; die();
		
		$sqlinsert = ("UPDATE tb_agenda SET
		agenda_data_inicio= '".dtos($_POST['dataInicio'])."',
		agenda_hora_inicio = '".$_POST['horaInicio']."' ,
		agenda_data_fim = '".dtos($_POST['dataFim'])."',
		agenda_hora_fim = '".$_POST['horaFim']."' 				
		WHERE  id = '".$_POST['id']."'; "); 	
		//echo $sqlinsert; die();
		echo $mysqli->query($sqlinsert);	 die(); 
		
	}
	
	if(isset($_POST['funcao']) && $_POST['funcao'] == "resizeAgendamento"){
		//echo $_POST['dataInicio']; die();
		
		$sqlinsert = ("UPDATE tb_agenda SET
		agenda_data_fim = '".dtos($_POST['dataFim'])."',
		agenda_hora_fim = '".$_POST['horaFim']."' 		
		WHERE  id = '".$_POST['id']."'; "); 	
		//echo $sqlinsert; die();
		echo $mysqli->query($sqlinsert);	 die(); 
		
	}
	
	if(isset($_POST['funcao']) && $_POST['funcao'] == "editaAgendamento"){
		//echo $_POST['dataInicio']; die();
		
		$sqlinsert = ("UPDATE tb_agenda SET
		agenda_procedimento = '".@$_POST['procedimento']."',
		agenda_cliente = '".@$_POST['cliente']."',		
		agenda_cliente_id = '".@$_POST['codCli']."'
		WHERE  id = '".@$_POST['recno']."'; "); 	
		//echo $sqlinsert; die();
		echo $mysqli->query($sqlinsert);	 die(); 
		
	}
	
	function getIDDentistaSelecionado(){

	
		$query = "SELECT USU_ID from tb_usuario WHERE USU_SELECIONADO = 'S' ";
		
		$resultado = $mysqli->query($query); 
			
			if(mysqli_num_rows($resultado) > 0)
			{  	
				while($row = $resultado->fetch_array())
				{
					return $row['USU_ID'];
				}
			}
		
	}
	function getNomeDentistaSelecionado(){

	
		$query = "SELECT USU_NOME from tb_usuario WHERE USU_SELECIONADO = 'S' ";
		
		$resultado = $mysqli->query($query); 
			
			if(mysqli_num_rows($resultado) > 0)
			{  	
				while($row = $resultado->fetch_array())
				{
					return $row['USU_NOME'];
				}
			}
		
	}
	
	
	if(isset($_POST['funcao']) && $_POST['funcao'] == "carregaNomeDentistaSelecionado"){
	
		echo getNomeDentistaSelecionado();die();
	
	}
	
	
	if(isset($_POST['funcao']) && $_POST['funcao'] == "carregaIDDentistaSelecionado"){
	
		echo getIDDentistaSelecionado();die();
	
	}
	
	if(isset($_POST['funcao']) && $_POST['funcao'] == "incluiAgendamento"){
		
		
		//echo $_POST['dataInicio']; die();
			//codCli
			//codProcedimento
					$sqlinsert = ("INSERT INTO  tb_agenda (id, 
											agenda_procedimento, 
											agenda_data_inicio, 
											agenda_data_fim, 
											agenda_hora_inicio, 
											agenda_hora_fim, 
											agenda_cliente, 					
											
											agenda_cliente_id
										
											) 
								VALUES (NULL, 
										'".$_POST['procedimento']."', 
										'".dtos($_POST['dataInicio'])."', 
										'".dtos($_POST['dataFim'])."', 
										'".$_POST['horaInicio']."', 
										'".$_POST['horaFim']."', 
										'".$_POST['cliente']."', 
										
										
										'".$_POST['codCli']."'
										
										
										);");		
					
					echo $mysqli->query($sqlinsert);	 die(); 
		
	}
	
		
		
		
		
		if(@$_POST['funcao'] == "incluiProcedimento"){
					
			$sqlinsert = ("INSERT INTO tb_procedimentos
				(procedimentos_descricao, procedimentos_cor) VALUES 
				('".mb_strtoupper(addslashes(@$_POST['descricao']))."',  '".@$_POST['cor']."' );");		
			
			$mysqli->query($sqlinsert);	 
			echo "OK";	
			return;
				
		}
		
		
	
	
	
		if(@$_POST['funcao'] == "incluiAtendedor"){
		
					
						$sqlinsert = ("INSERT INTO  tb_usuario (
									USU_NOME,
									USU_USUARIO ,
									USU_SENHA,
									USU_DENTISTA,
									USU_CPF, 
									USU_RG, 
									USU_NASCIMENTO, 
									USU_CRO
									
									)
									VALUES (
									 '".mb_strtoupper(addslashes(@$_POST['nome']), 'UTF-8')."', 
									 '".addslashes($_POST['login'])."', 
									 '".MD5($_POST['senha'])."',
									 '".$_POST['dentista']."',
									 '".$_POST['cpf']."',
									 '".$_POST['rg']."',
									 '".dtos(@$_POST['nascimento'])."',
									'".$_POST['cro']."'
									 
									);
									");		
						//echo $sqlinsert; die();
						$mysqli->query($sqlinsert);	 
						echo "OK";	
						return;
				
		}	
	
	if(isset($_GET['funcao'] ) && $_GET['funcao'] == "getclientes"){
		 
		
			$query = ("SELECT id, cli_tipo, cli_nome, cli_cpf, cli_cnpj, cli_cidade, cli_uf, cli_email  FROM tb_clientes 
			where (cli_nome LIKE '%".$_GET['search']."%' 
			OR REPLACE(REPLACE(cli_cpf, '.', ''), '-', '') LIKE '%".str_replace('-', '', str_replace('.', '', $_GET['search']))."%'
			OR  REPLACE(REPLACE(REPLACE(cli_cnpj, '.', ''), '-', ''), '/', '') LIKE '%".str_replace('/', '', str_replace('-', '', str_replace('.', '', $_GET['search'])))."%')			
			ORDER BY cli_nome  LIMIT ".$_GET['limit']." ");
			//echo $query; die();
			$resultado = $mysqli->query($query); 
			$response = "";
			if(mysqli_num_rows($resultado) > 0)
			{  	
				while($row = $resultado->fetch_array())
				{
					$response .= '
					<tr>
						<td >  
							<a class="fa fa-pencil-square-o" style="margin-left: 11px;cursor:pointer;" title="Editar" href="novo_cliente.php?edit=edit&recno='.@$row['id'].'"/> 
							<i class="fa fa-times excluirCliente" style="margin-left: 11px; cursor:pointer; color: #ff6060;" title="Excluir"  nome="'.@$row['cli_nome'].'" cpf="'.@$row['cli_cpf'].'"  cpf="'.@$row['cli_cnpj'].'" recno="'.@$row['id'].'" /> 
						</td>
						<td>'.@$row['cli_nome'].'</td>
						<td>'.@$row['cli_cpf'].@$row['cli_cnpj'].'</td>
						<td>'.@$row['cli_cidade'].' - '.@$row['cli_uf'].'</td>
						<td>'.@$row['cli_email'].'</td>
						
					</tr> ';												
				}
			}else{
				
				$response .= '
					<tr>
						<td colspan="6" style="text-align:center;">Nenhum Resultado</td></tr>';
			}
		echo $response;
		 
	}
	
	
	
	if(@$_GET['funcao'] == "getprodutos"){
		 
		
			$query = ("SELECT *  FROM tb_procedimentos
			where procedimentos_descricao LIKE '%".@$_GET['search']."%' 						
			ORDER BY procedimentos_descricao LIMIT ".@$_GET['limit']." ");
			//echo $query; die();
			$resultado = $mysqli->query($query); 
			$response = "";
			if(mysqli_num_rows($resultado) > 0)
			{  	
				while($row = $resultado->fetch_array()) 
				{
					$response .= '
					<tr>
						<td >  
							<a class="fa fa-pencil-square-o" style="margin-left: 11px;cursor:pointer;" title="Editar" href="novo_procedimento.php?edit=edit&recno='.@$row['id'].'"/> 
							<i class="fa fa-times excluirProduto" style="margin-left: 11px; cursor:pointer; color: #ff6060;" title="Excluir"  nome="'.@$row['procedimentos_descricao'].'" recno="'.@$row['id'].'" /> 
						</td>
						<td>'.@$row['id'].'</td>
						<td>'.@$row['procedimentos_descricao'].'</td>						
						<td style="color: #'.@$row['procedimentos_cor'].'">'.@$row['procedimentos_cor'].'</td>
					</tr> ';												
				}
			}else{
				
				$response .= '
					<tr>
						<td colspan="6" style="text-align:center;">Nenhum Resultado</td></tr>';
			}
		echo $response;
		 
	}
	
	
	
	
	function getDiaSemanaBynum($dia){
		
		if($dia == 0) return 'Domingo';
		if($dia == 1) return 'Segunda-feira';
		if($dia == 2) return 'Terça-feira';
		if($dia == 3) return 'Quarta-feira';
		if($dia == 4) return 'Quinta-feira';
		if($dia == 5) return 'Sexta-feira';
		if($dia == 6) return 'Sabado';
	}
	
	if(@$_GET['funcao'] == "getAtendedores"){
		 
		
			$query = ("SELECT distinct  tb_agenda.agenda_cod_dentista,  tb_usuario.* from tb_usuario LEFT JOIN tb_agenda ON USU_ID = agenda_cod_dentista  order by USU_NOME ASC");
			//echo $query; die();
			$resultado = $mysqli->query($query); 
			$response = "";
			
			
			if(mysqli_num_rows($resultado) > 0)
			{  	
				while($row = $resultado->fetch_array())
				{
					if(@$row['agenda_cod_dentista']){
						
						$btnExcluir = '<i class="fa fa-times impossivelExcluir" style="margin-left: 11px; cursor:pointer; color: #gray;" title="Impossível Excluir"  /> ';
						
					}else{
						if(mysqli_num_rows($resultado) == 1){
							$btnExcluir = '<i class="fa fa-times " style="margin-left: 11px; cursor:pointer; color: #gray;" title="Impossível Excluir"  /> ';
							
						}else{
							$btnExcluir = '<i class="fa fa-times excluirAtendedor" style="margin-left: 11px; cursor:pointer; color: #ff6060;" title="Excluir" nome="'.@$row['USU_NOME'].'"   recno="'.@$row['USU_ID'].'" /> ';
						}
					}
					$response .= '
					<tr>
						<td > 
							<a class="fa fa-pencil-square-o" style="margin-left: 11px;cursor:pointer;" title="Editar" href="adicionar_atendedor.php?edit=edit&recno='.@$row['USU_ID'].'"/> 
							'.$btnExcluir.'
						</td>
						<td>'.@$row['USU_NOME'].'</td>
						<td>'.@$row['USU_USUARIO'].'</td>						 
						<td>'.@$row['USU_DENTISTA'] .'</td>	
						<td>'.@$row['USU_CPF'].'</td>	
						<td>'.@$row['USU_RG'].'</td>	
						<td>'.DTOC(@$row['USU_NASCIMENTO']).'</td>	
						<td>'.@$row['USU_CRO'] .'</td>	
					</tr> ';												
				}
			}
		echo $response;
		
	}
	
	
	
	if(@$_GET['funcao'] == "relatorioVendas"){
 		 
		if(@$_GET['dataInicial'] && @$_GET['dataFinal']){
			
			$datas = "AND agenda_data_inicio between '".dtos(@$_GET['dataInicial'])."' and '".dtos(@$_GET['dataFinal'])."' ";
		}else{
			$limit = "LIMIT ".@$_GET['limit']." ";
		}
			$query = (" 
			SELECT * FROM tb_agenda			
			INNER JOIN tb_clientes ON tb_clientes.CLI_CODIGO = agenda_cliente_id
			
			WHERE (agenda_procedimento LIKE '%".@$_GET['search']."%'  
			OR agenda_cliente LIKE '%".@$_GET['search']."%' )			
			ORDER BY agenda_data_inicio desc, agenda_hora_inicio desc  ");
		//echo $query; die(); 
			$resultado = $mysqli->query($query); 
			$response = "";
			if(mysqli_num_rows($resultado) > 0)
			{ 				
				while($row = $resultado->fetch_array())
				{	
$cssTd = "";

if(DATE('Ymd') ==  $row['agenda_data_inicio']) $cssTd = " background-color: #c9dcff; ";
if(DATE('Ymd') <  $row['agenda_data_inicio']) $cssTd = " background-color: #d0ffca; ";			
if(DATE('Ymd') >  $row['agenda_data_inicio']) $cssTd = " background-color: #ffd8d8; ";			
					$response .= '
					<tr style="'.$cssTd.'">
						
						<td>'.@dtoc($row['agenda_data_inicio']).' - '.$row['agenda_hora_inicio'].'</td>
						<td>'.@dtoc($row['agenda_data_fim']).' - '.$row['agenda_hora_fim'].'</td>
						<td>'.$row['agenda_cliente'].'</td>
						
						
						<td>'.$row['agenda_procedimento'].'</td>
						<td>'.$row['CLI_TELEFONE'].'</td>
						<td>'.$row['CLI_EMAIL'].'</td>
						<td><img src="./images/street.png" style="width: 20px; cursor: pointer;"  class="exibeEndereco" endereco="'.$row['CLI_ENDERECO'].', '.$row['CLI_NUMERO'].' - '.$row['CLI_BAIRRO'].', '.$row['CLI_MUN'].'" /></td>
						
					</tr> 
						
					';												
				}
			}else{
				
				$response .= '
					<tr>
						<td colspan="12" style="text-align:center;">Nenhum Resultado</td></tr>';
			}
	
		echo $response;
		
	}
	
	

	if(isset($_GET['funcao']) && $_GET['funcao'] == "getProcedimentosModal"){
		 
		
			$query = ("SELECT *  FROM tb_procedimentos
			where (procedimentos_descricao LIKE '%".@$_GET['search']."%'
			OR id LIKE '%".@$_GET['search']."%')			
			ORDER BY procedimentos_descricao  LIMIT ".$_GET['limit']." ");
			
			//echo $query; die();
			
			$resultado = $mysqli->query($query); 
			$response = "";
			if(mysqli_num_rows($resultado) > 0)
			{  	
				while($row = $resultado->fetch_array())
				{
					$response .= '
					<tr>
						
						<td style="text-align:left;">'.@$row['procedimentos_descricao'].'</td>
						
						<td class=" " style="text-align: left;">
								<button type="button" title="Selecionar" 
								nome="'.@$row['procedimentos_descricao'].'" 								
								id="'.@$row['id'].'" 
								class="btn btn-success btn-xs selectProcedimento " data-dismiss="modal"><i class="fa fa-check"> </i></button>
							</td>
					</tr> ';												
				}
			}else{       
				
				$response .= '
					<tr>
						<td colspan="4" style="text-align:center;">Nenhum Resultado</br></br>
						Cliente ainda não Cadastrado? <a href="novo_cliente.php" title="Adicionar Cliente">Clique Aqui</a>
						
						</td></tr>';
			}
		echo $response;
		
	}
	
	
	
	if(isset($_GET['funcao']) && $_GET['funcao'] == "getDentistasModal"){
		 
		
			$query = ("SELECT *  FROM tb_usuario 
			where ( USU_NOME LIKE '%".$_GET['search']."%' && USU_DENTISTA = 'S' )
			ORDER BY USU_NOME  LIMIT ".$_GET['limit']." ");
			//echo $query; die();
			$resultado = $mysqli->query($query); 
			$response = "";
			if(mysqli_num_rows($resultado) > 0)
			{  	
				while($row = $resultado->fetch_array())
				{
					$response .= '
					<tr>
						
						<td style="text-align:left;">'.@$row['USU_NOME'].'</td>
						
						<td class=" " style="text-align: left;">
								<button type="button" title="Selecionar" 
								nome="'.@$row['USU_NOME'].'" 								
								cod="'.@$row['USU_ID'].'" 
								class="btn btn-success btn-xs selectDentista " data-dismiss="modal"><i class="fa fa-check"> </i></button>
							</td>
					</tr> ';												
				}
			}else{       
				
				$response .= '
					<tr>
						<td colspan="4" style="text-align:center;">Nenhum Resultado</br></br>						
						
						</td></tr>';
			}
		echo $response;
		
	}
	
	
	if(isset($_GET['funcao']) && $_GET['funcao'] == "getClientesModal"){
	
					
			$query = ("SELECT * FROM tb_clientes 
			where (CLI_NOME LIKE '%".$_GET['search']."%' 
			OR CLI_CNPJRG LIKE '%".$_GET['search']."%'
			OR CLI_ESTADO LIKE '%".$_GET['search']."%'
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
							title='Selecionar'  class='btn btn-success selectCliente' data-dismiss='modal'><i class='fa fa-check'></i></button>
						</td>";					
						echo " <td style='text-align:left;' >".$row['CLI_NOME']."</td>";						
						
						echo " <td style='text-align:left;'>".$row['CLI_MUN'].' - '.$row['CLI_ESTADO']."</td>";
						
					echo " </tr> ";												
				}
			}else{
				
						echo "<tr><td colspan=2>	Nenhum Resultado</td> </tr>";
			}
		
		}
	
	
			if(@$_GET['funcao'] == "verificaSeTemVendaById"){
			
			
			
				$sql = ("SELECT id
				FROM tb_agenda	WHERE id <> '' AND  agenda_cliente_id = '".@$_GET['clienteId']."' ");
						 

				$resultado = $mysqli->query($sql); 
				
				if(mysqli_num_rows($resultado) == 0)
				{ 
						echo "false";die();
						 
				}
				
				echo "true";die();
				
			} 
	
	 
		
		
		if(@$_POST['funcao'] == "excluiAgenda"){
			
			$sql = "DELETE FROM tb_agenda  WHERE id = '".$_POST['codigo']."'  ";
			
			echo $mysqli->query($sql);
		} 
		
	
		if(@$_POST['funcao'] == "excluicliente"){
			
			$sql = "DELETE FROM tb_clientes  WHERE id = '".@$_POST['codigo']."'  ";
			//echo $sql."TESTE"; die();
			echo $mysqli->query($sql);
			
		} 
		
		if(@$_POST['funcao'] == "excluiproduto"){
			
			$sql = "DELETE FROM tb_procedimentos  WHERE id = '".@$_POST['codigo']."'  ";
			//echo $sql."TESTE"; die();
			echo $mysqli->query($sql);
			
		}
	
		if(@$_POST['funcao'] == "excluiAtendedor"){
			
			$sql = "DELETE FROM tb_usuario  WHERE USU_ID = '".$_POST['codigo']."'  ";
			//echo $sql."TESTE"; die();
			echo $mysqli->query($sql);
			
		}
	
	
	
	
		
	if(@$_POST['funcao'] == "getEventByidJson"){
		
			$query = "
			SELECT tb_clientes.CLI_TELEFONE, tb_clientes.CLI_EMAIL, tb_agenda. * 
FROM tb_agenda
INNER JOIN tb_clientes ON agenda_cliente_id = tb_clientes.CLI_CODIGO
WHERE tb_agenda.id = ".@$_POST['id']."  
			
			";
		
				$resultado = $mysqli->query($query); 
				
				if(mysqli_num_rows($resultado) > 0)
				{				
					$consulta = $resultado->fetch_array();
					$retorno = $consulta; // irá retornar todos os campos 
				}
		
			echo  json_encode($retorno);	
		}
	
	
	
	
		if(@$_GET['funcao'] == "getClienteByRednoJson"){
		
			$query = "SELECT * FROM tb_clientes where id = '".@$_GET['recno']."'  ";
		
				$resultado = $mysqli->query($query); 
				
				if(mysqli_num_rows($resultado) > 0)
				{				
					$consulta = $resultado->fetch_array();
					$retorno = $consulta; // irá retornar todos os campos 
				}
		
			echo  json_encode($retorno);	
		}
		
	
		
		
		if(@$_GET['funcao'] == "getProcedimentosByRednoJson"){
		
			$query = "SELECT * FROM tb_procedimentos where id = '".@$_GET['recno']."'  ";
		
				$resultado = $mysqli->query($query); 
				
				if(mysqli_num_rows($resultado) > 0)
				{				
					$consulta = $resultado->fetch_array();
					$retorno = $consulta; // irá retornar todos os campos 
				}
		
			echo  json_encode($retorno);	
		}
		
		
		
		if(@$_GET['funcao'] == "getAtendedoresByRednoJson"){
		
			$query = "SELECT * FROM tb_usuario where USU_ID = '".$_GET['recno']."'  ";
		
				$resultado = $mysqli->query($query); 
				
				if(mysqli_num_rows($resultado) > 0)
				{				
					$consulta = $resultado->fetch_array();
					$retorno = $consulta; // irá retornar todos os campos 
				}
		
			echo  json_encode($retorno);	
		}
		
	 
		
		
		
		
		
		if(@$_POST['funcao'] == "editaProduto"){
					
						
				$sqlupdate = ("UPDATE  tb_procedimentos SET  
							procedimentos_descricao =  '".mb_strtoupper(addslashes(@$_POST['descricao']))."',
							procedimentos_cor =  '".@$_POST['cor']."' 							
							WHERE  id = '".@$_POST['recno']."';
							"); 
							
							//echo $sqlupdate; die();
						echo $mysqli->query($sqlupdate);
	
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

	function ctod($data)
	{
	  if(trim($data) <> ''){
		$datafmt = substr($data,0,4) . '-' . substr($data,4,2) . '-' . substr($data,6,2);
	  }else{
		$datafmt = '';
	  }
	  return $datafmt;
	}


	function moeda($valor)
	{
	  return number_format($valor, 2, ',', '.');
		
	}


	function mask($val, $mask)
	{
	 $maskared = '';
	 $k = 0;
	 for($i = 0; $i<=strlen($mask)-1; $i++)
	 {
	 if($mask[$i] == '#')
	 {
	 if(isset($val[$k]))
	 $maskared .= $val[$k++];
	 }
	 else
	 {
	 if(isset($mask[$i]))
	 $maskared .= $mask[$i];
	 }
	 }
	 return $maskared;
	}

	
		
function strtoupper2($texto) {
  $palavra = "";
  $txt = strtoupper($texto);
  $trocar  ['á'] = 'Á';
  $trocar  ['à'] = 'À';
  $trocar  ['â'] = 'Â';
  $trocar  ['ã'] = 'Ã';
  $trocar  ['ä'] = 'Ä';
  $trocar  ['é'] = 'É';
  $trocar  ['è'] = 'È';
  $trocar  ['ê'] = 'Ê';
  $trocar  ['ë'] = 'Ë';
  $trocar  ['í'] = 'Í';
  $trocar  ['ì'] = 'Ì';
  $trocar  ['î'] = 'Î';
  $trocar  ['ï'] = 'Ï';
  $trocar  ['ó'] = 'Ó';
  $trocar  ['ò'] = 'Ò';
  $trocar  ['ô'] = 'Ô';
  $trocar  ['õ'] = 'Õ';
  $trocar  ['ö'] = 'Ö';
  $trocar  ['ú'] = 'Ú';
  $trocar  ['ù'] = 'Ù';
  $trocar  ['û'] = 'Û';
  $trocar  ['ü'] = 'Ü';
  $trocar  ['ç'] = 'Ç';
  $trocar  ['æ'] = 'Æ';
   for($i=0; $i<=strlen($txt); $i++) {
   $a = substr($txt, $i, 1);
     if(array_key_exists("$a",$trocar)){
       $palavra .= $trocar[$a];
     }else{
       $palavra .= substr($txt, $i, 1);
     }
   }
  return $palavra;
}

	function difhoras($data){
		   $hora_data_atual = date("YmdH:i");
		   $data = strtotime($data);
		   $hora_data_atual = strtotime($hora_data_atual);
		   $diferenca = $data-$hora_data_atual;
		   $dias = floor($diferenca / 86400);
		   $horas = floor($diferenca / 3600);
		   $minutos = floor(($diferenca / 60) % 60);
		   //$segundos = floor($diferenca % 60);
		   $resultado = "{$horas}";
		   return $resultado;
	}
	//mysql_close($conexao_lic);
	
	
	?>