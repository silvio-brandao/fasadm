<?php 
//ivanbnisti@gmail.com
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
  	
	
	
	
	if(@$_GET['funcao'] == "exportRelatorioVendas"){

	//TÍTULO DO RELATÓRIO 
		
			$imagem = "../img/faviconpng.jpg"; 
		
			//TIPO DO PDF GERADO 
			//F-> SALVA NO ENDEREÇO ESPECIFICADO
			//NA VAR END_FINAL 
			$tipo_pdf = "F";
		
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
			
			
			ORDER BY agenda_data_inicio asc, agenda_hora_inicio asc  ");
	
			$resultado = $mysqli->query($query); 
			$row = mysqli_num_rows($resultado);

			//VERIFICA
			//SE RETORNOU ALGUMA LINHA
			if($row == 0) { echo "Não retornou nenhum registro";
			die; }
	
		
			//PREPARA
			//PARA GERAR O PDF
			define("FPDF_FONTPATH", "../fpdf/font/");
			include ("../fpdf/fpdf.php"); 
			$pdf = new FPDF();

			//INICIALIZA
			//AS VARIÁVEIS
			$linha_atual = 0;
			$inicio = 0;
			$linha = 0;	
			$pag = 0;
			if(mysqli_num_rows($resultado) > 0)
			{ 		
				
				
				while($row = $resultado->fetch_array())
				{
					
					if($linha === 0){
						
						//MONTA O
					//CABEÇALHO 			
			
					$pdf->AddPage(); 
					$pag++;
					$pdf->SetFont("Arial", "", 7);

					$pdf->Image($imagem, 10, 12);
					$pdf->Cell(190, 6, "Período: ".$_GET['dataInicial'].' até '.$_GET['dataFinal'], 'T', 0, 'C'); 
					$pdf->Ln(4);
					$pdf->Cell(190, 6, "Filtro: ".$_GET['search'], 0, 0, 'C'); 
					$pdf->Ln(4);
					$pdf->Cell(190, 6, "Página: ".$pag, 0, 0, 'R'); 
					
					$pdf->Ln(5);
					//$pdf->Cell(165, 6, "Pag $x de $paginas",
					//0, 0, 'R');

					//QUEBRA
					//DE LINHA
					
					$pdf->Ln(20);

					$pdf->Cell(25, 6, "Início", 'B', 0, 'L'); 
					$pdf->Cell(45, 6, "Cliente", 'B', 0, 'L');				
					$pdf->Cell(20, 6, "Fone", 'B', 0, 'L');
					$pdf->Cell(100, 6, "Tarefa", 'B', 0, 'L');    
					
					$pdf->Ln(3);
					
					
						
					}
					//$linha++;
					$linha++;
					if($linha >= 70){
						
						$linha = 0;
						
					}				
					
					$pdf->Ln(3);
				
					$reticencias = strlen($row['agenda_cliente']) > 26 ? "..." : "";
				
				
					$pdf->Cell(25, 6, dtoc($row['agenda_data_inicio']). ' '. $row['agenda_hora_inicio'] , 0, 0, 'L'); 
					$pdf->Cell(45, 6, substr($row['agenda_cliente'], 0, 25).$reticencias, 0, 0, 'L');
					
					$pdf->Cell(20, 6, $row['CLI_TELEFONE'], 0, 0, 'L');
					
					$tarefa = $row['agenda_procedimento'];
					
					if(strlen($tarefa) > 85){
						$pdf->Cell(40, 6, utf8_decode(substr($tarefa, 0, 85)), 0, 0, 'L');
						$pdf->Ln(3);
						$pdf->Cell(90, 6, "", 0, 0, 'L'); //espaço em branco para a continuação ficar abaixo do campo correto XUNXO						
						$pdf->Cell(40, 6, utf8_decode(substr($tarefa, 85)), 0, 0, 'L');
						$pdf->Ln(3); //MAIS UMA LINHA PARA FICAR MAIS FACIL DE LER
						
					}else{
						
						$pdf->Cell(40, 6, utf8_decode($tarefa), 0, 0, 'L');
						
					}
					
					
					
					
					
				
				}
			}
	
	
				$pdf->Output("relatorio.pdf", "$tipo_pdf");
			
		
	
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
		   $dias = floor($diferenca / 66400);
		   $horas = floor($diferenca / 3600);
		   $minutos = floor(($diferenca / 60) % 60);
		   //$segundos = floor($diferenca % 60);
		   $resultado = "{$horas}";
		   return $resultado;
	}
	
	
	
	?>