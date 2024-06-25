<?php 
					//		ini_set('display_errors',1);
//ini_set('display_startup_erros',1);
//error_reporting(E_ALL);


session_start();
$arrayPermission = array(1, 3);	
if (!in_array($_SESSION['permissao'], $arrayPermission)) {
		echo "<META HTTP-EQUIV='REFRESH' CONTENT='0; URL=index.php?acess=denied'>"; 
		die();
}      
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
 
		 //$db->onlyAdmin();
		 
	$flagcliExist = false;
	$flagcliOK = false;
	if(!empty($_GET['view'] ))
	{
		$query = "SELECT * FROM tb_clientes WHERE CLI_CODIGO = '".$_GET['view']."' ";
			
		$resultado = $mysqli->query($query); 
		$row = $resultado->fetch_array();
		
	}
    
	if($_GET['edit'] )
	{
		$query = "SELECT * FROM tb_clientes WHERE CLI_CODIGO = '".$_GET['edit']."' ";
		
		
		
		$resultado = $mysqli->query($query); 
		$row = $resultado->fetch_array();
		
		
		if($_SESSION['uid'] != $row['CLI_USUARIO'] && $_SESSION['permissao'] == '3' ){
			
			echo "<META HTTP-EQUIV='REFRESH' CONTENT='0; URL=index.php?acess=denied'>"; 
			die();
			
		}
		
		
		
	}
	
	
	if(!empty($_GET['update']))	{

				
				$sqlupdate = "UPDATE tb_clientes SET 
				
					CLI_COMPLEMENTO='". mb_strtoupper($_POST['newcomplemento'])."', 
                    CLI_NUMERO='". $_POST['newnumero']."', 
                    CLI_LOJA='". $_POST['newloja']."',                    
                    CLI_NOME='". mb_strtoupper($_POST['newnome'])."', 
                    CLI_ENDERECO='". mb_strtoupper($_POST['newend'])."', 
                    CLI_BAIRRO='". mb_strtoupper($_POST['newbairro'])."', 
                    CLI_ESTADO='". mb_strtoupper($_POST['newestado'])."', 
                    CLI_MUN='". mb_strtoupper($_POST['newmun'])."', 
                    CLI_OBS='". mb_strtoupper($_POST['newobs'])."', 
                    CLI_CONTATO='". mb_strtoupper($_POST['newcontato'])."', 
                    CLI_TELEFONE='". $_POST['newtel']."',                    
                    CLI_CEP='". $_POST['newcep']."', 
                    CLI_EMAIL='". $_POST['newmail']."', 
					
					CLI_CNPJRG='". $_POST['newcnpjrg']."', 
					CLI_INCRICAO ='". $_POST['newinsc']."', 
					CLI_PESSOAFJ ='". $_POST['newpessoa']."', 
					
					CLI_OBS='". mb_strtoupper($_POST['newobs'])."' WHERE CLI_CODIGO ='".$_GET['update']."';";

				if ($mysqli->query($sqlupdate) == true) {		   
					$updated = true;
				} /*else {
					echo "Error updating record: " . $mysqli->error;
				}*/
						
				
				
	}	
	
    if(!empty($_POST['newcnpjrg'])  && empty($_GET['update']))
    {       
			
            $parametro = array($_POST['newcnpjrg']);            
           
			//PRINT_R($verificacli);			
	
			$resultadoCli = $mysqli->query("SELECT * FROM tb_clientes where CLI_CNPJRG = '".$parametro."'"); 
	
	
			if(mysqli_num_rows($resultadoCli) == 0)
			{			

				
				$insc = TRIM($_POST['newinsc']) == "" ? "ISENTO" : $_POST['newinsc'];
			
				
					
				$insert = "INSERT INTO tb_clientes (
									CLI_COMPLEMENTO, 
									CLI_NUMERO,
									CLI_CNPJRG,
									CLI_INCRICAO, 
									CLI_LOJA,
									CLI_PESSOAFJ, 
									CLI_NOME, 
									CLI_ENDERECO, 
									CLI_BAIRRO, 
									CLI_ESTADO, 
									CLI_MUN, 
									CLI_OBS, 
									CLI_DATACADASTRO, 
									CLI_CONTATO, 
									CLI_TELEFONE,	
									CLI_ULTIMACOMPRA, 
									CLI_CEP, 
									CLI_EMAIL, 
									CLI_USUARIO, 
									CLI_USUARIO_NOME)									
								VALUES (
									'".$_POST['newcomplemento']."',
									'".$_POST['newnumero']."',
									'".$_POST['newcnpjrg']."',
									'".$insc."', 
									'".$_POST['newloja']."', 
									'".$_POST['newpessoa']."', 									
									'".str_replace(" - ", "-", mb_strtoupper($_POST['newnome']))."', 
									'".mb_strtoupper($_POST['newend'])."', 
									'".mb_strtoupper($_POST['newbairro'])."',
									'".mb_strtoupper($_POST['newestado'])."',
									'".mb_strtoupper($_POST['newmun'])."', 
									'".mb_strtoupper($_POST['newobs'])."', 
									'',
									'".mb_strtoupper($_POST['newcontato'])."', 
									'".$_POST['newtel']."',	 	
									'', 
									'".$_POST['newcep']."', 
									'".$_POST['newmail']."',
									'".$_SESSION['uid']."',
									'".$_SESSION['nome']."' )";
								
								
								//ECHO $insert; DIE();
//.date(Ymd).
						
						if ($mysqli->query($insert) == true) {
							
							$flagcliOK = true;
						} else {
							echo "Error: " . $insert . "<br>" . $mysqli->error;
						}
			}
			else{
				$flagcli = true;
			}	
    }
?> 

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="Windows-1252">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>FAS Manutenção | Portal</title>

    <!-- Bootstrap Core CSS -->
    <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">


	<link rel="shortcut icon" href="../favicon.ico" >
	

	
</head>


<body>

    <div id="wrapper">

	<? 
		$action = !empty($_GET['edit'])  ? 'action="?update='.$_GET['edit'].'"' : '';  
	?>
	
	
        <!-- Navigation -->
        <? include("navigation.php"); ?>
	<form method="POST" id="formCliente" <? echo $action ?> >
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
					<div class="row">
						<div class="col-lg-12">
						<? 
						
						if(!empty($_GET['view']))
						{
							$pageHeader = "Visualizar Cliente";
						}else{
							$pageHeader = "Adicionar Cliente";
						}
						if(!empty($_GET['edit']))
						{
							$pageHeader = "Alterar Cliente";
						}
						?>
						
							<h1 class="page-header"><?echo $pageHeader; ?></h1>
						</div>
						<!-- /.col-lg-12 -->
					</div>
						<? 
							//$disabled = !empty($_GET['edit']) ? "disabled" : "";
						?>
					<div class="row">
						<div class="col-lg-4">
						   <div class="form-group">
								<label>Nome:</label>
								<input class="form-control" placeholder="Nome" id="newnome" name="newnome" maxlength="100" value="<?=$row['CLI_NOME']?>" required/>
							</div>
						</div>	
						<div class="col-lg-2 ">
						   <div class="form-group">
								<label>CNPJ/RG:</label>
								<input class="form-control" placeholder="CNPJ/RG"  id="newcnpjrg" name="newcnpjrg" maxlength="14" value="<?=$row['CLI_CNPJRG']?>"  <? echo $disabled?> required/>
							</div>
						</div>
						
						<div class="col-lg-2 ">
						   <div class="form-group">
								<label>Inscrição Est:</label>
								<input class="form-control" placeholder="Inscrição Est" id="newinsc" name="newinsc" maxlength="22" value="<?=$row['CLI_INCRICAO']?>" <? echo $disabled?> />
							</div>
						</div>
						<?
							$loja = !$row['CLI_LOJA'] ? "1" : $row['CLI_LOJA'];
						?>
						<div class="col-lg-1 ">
						   <div class="form-group">
								<label>Loja:</label>
								<input class="form-control" placeholder="Loja" id="newloja" name="newloja"  type="number" maxlength="2" value="<? echo $loja; ?>" />
							</div>
						</div>
						
						
						
						<div class="col-lg-2 ">
						   <div class="form-group">
									<label>Pessoa:</label>
									<select class="form-control" name="newpessoa" id="newpessoa"  <? echo $disabled?>  /> 
																				
										<?
											if($row['CLI_PESSOAFJ'] == 'J'){
											?>	
												<option value="F" >Física</option>
												<option value="J" selected>Jurídica</option>		
											<?
											}
											if($row['CLI_PESSOAFJ'] == 'F'){
											?>	
												<option value="F" selected>Física</option>
												<option value="J" >Jurídica</option>		
											<?
											}
										?>
											<? 
										if($pageHeader == "Adicionar Cliente"){
											?>
												<option value="F" >Física</option>
												<option value="J" >Jurídica</option>	
										<?}?>			
									</select>
								</div>
						</div>
						
					</div>
					<div class="row">
						<div class="col-lg-6 ">
						   <div class="form-group">
								<label>Endereço:</label>
								<input class="form-control" placeholder="Endereço" id="newend" name="newend" maxlength="60"  value="<?=$row['CLI_ENDERECO']?>" />
							</div>
						</div>
						
						<div class="col-lg-2 ">
						   <div class="form-group">
								<label>Numero:</label>
								<input class="form-control" placeholderNumero" id="newnumero"  name="newnumero" maxlength="6"  value="<?=$row['CLI_NUMERO']?>" />
							</div>
						</div>
						
						<div class="col-lg-3 ">
						   <div class="form-group">
								<label>Bairro:</label>
								<input class="form-control" placeholder="Bairro" id="newbairro" name="newbairro" maxlength="30" value="<?=$row['CLI_BAIRRO']?>" />
							</div>
						</div>
						
					</div>
					
					<div class="row">
						
						<div class="col-lg-6 ">
						   <div class="form-group">
								<label>Município:</label>
								<input class="form-control" placeholder="Município" id="newmun" name="newmun" maxlength="100" value="<?=$row['CLI_MUN']?>" />
							</div>
						</div>
						
						
						<div class="col-lg-1 ">
						   <div class="form-group">
								<label>Estado:</label>
								<input class="form-control" placeholder="UF" id="newestado" name="newestado" maxlength="2" value="<?=$row['CLI_ESTADO']?>" />
							</div>
						</div>
						
						<div class="col-lg-2 ">
						   <div class="form-group">
								<label>Cep:</label>
								<input class="form-control" placeholder="Cep" id="newcep" name="newcep" maxlength="9" value="<?=$row['CLI_CEP']?>" />
							</div>
						</div>
						
						<div class="col-lg-2 ">
						   <div class="form-group">
								<label>Complemento:</label>
								<input class="form-control" placeholder="Complemento" id="newcomplemento"  name="newcomplemento" maxlength="60"value="<?=$row['CLI_COMPLEMENTO']?>" />
							</div>
						</div>
						
					</div>
					
					<div class="row">
						
						<div class="col-lg-3 ">
						   <div class="form-group">
								<label>Contato:</label>
								<input class="form-control" placeholder="Contato" id="newcontato" name="newcontato" maxlength="25" value="<?=$row['CLI_CONTATO']?>" required/>
							</div>
						</div>
						<div class="col-lg-3 ">
						   <div class="form-group">
								<label>Telefone:</label>
								<input class="form-control" placeholder="Telefone" id="newtel" name="newtel" maxlength="18" value="<?=$row['CLI_TELEFONE']?>" />
							</div>
						</div>
						<div class="col-lg-5">
							<div class="form-group">
								<label>Email:</label>
								<input class="form-control" placeholder="Email" id="newmail" name="newmail" maxlength="100" value="<?=$row['CLI_EMAIL']?>" />
							</div>
						</div>
						
						 						
					</div>					
					
					<div class="row">
						
						<div class="col-lg-11">
							<div class="form-group">
								<label>OBS:</label>
								<input class="form-control" placeholder="OBS" id="newobs" name="newobs" maxlength="100" value="<?=$row['CLI_OBS']?>" />
							</div>
						</div>						
					</div>
					<?
						$disabled = "";
						if(!empty($_GET['view']))
						{
							$disabled = "disabled";
						}
								
					?>
					<?if(empty($_GET['view'])){ ?>
					<div class="row">	
						<div class="col-lg-1 ">
						   <div class="form-group">
								
								<button type="submit"   class="btn btn-default btn-circle btn-xl btnConfirma" title="Confirmar" <?echo $disabled?> >
									<i class="fa fa-check"></i>
								</button>
							</div>
						</div>
					</div>
					
					<? }
						if(!empty($_GET['view'])){
							?> 
							
								<div class="col-lg-1 ">
								   <div class="form-group">
										
										<a href="javascript:window.history.go(-1)"><button  type="button" class="btn btn-default btn-circle btn-xl" title="Voltar"  >
											<i class="fa fa-step-backward"></i>
										</button></a>
									</div>
								</div>
							
							<?
						}
					?>
					<div class="row">	
						<div class="col-lg-3">
						   <div class="form-group">
						 
						 </div>
					</div>
				
				
					
				<div class="row">	
						<div class="col-lg-5">
						   <div class="form-group">
						  
						 </div>
					</div>
				</div>
				
											
					<!--Modal -->
					<div class="modal fade" id="ClientValidation" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
										<h4 class="modal-title" id="myModalLabel">Alerta</h4>
									</div>
									<div class="modal-body">
										Cliente com este CPF/CNPJ já Existe
									</div>
								<div class="modal-footer">
									<button  type="button" class="btn btn-default" data-dismiss="modal">OK</button>
									
								</div>
							</div>
							<!-- /.modal-content -->
						</div>
						<!-- /.modal-dialog -->
					</div>		
					<!--Modal -->
						<!--Modal -->
					<div class="modal fade" id="clientOK" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
										<h4 class="modal-title" id="myModalLabel">Alerta</h4>
									</div>
									<div class="modal-body">
										Cadastro Efetuado!
									</div>
									<div class="modal-footer">
										<button  type="button" class="btn btn-default" data-dismiss="modal">OK</button>
									</div>
							</div>
							<!-- /.modal-content -->
						</div>
						<!-- /.modal-dialog -->
					</div>		
					<!--Modal -->		
							<!--Modal -->
					<div class="modal fade" id="clientUpdateOK" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
										<h4 class="modal-title" id="myModalLabel">Alerta</h4>
									</div>
									<div class="modal-body">
										Cadastro Alterado!
									</div>
									<div class="modal-footer">
										<button   type="button" class="btn btn-default" data-dismiss="modal">OK</button>
									</div>
							</div>
							<!-- /.modal-content -->
						</div>
						<!-- /.modal-dialog -->
					</div>		
					<!--Modal -->		

					
				
            </div>
            <!-- /.container-fluid -->
        </div>
	</form>  <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>
	<script>
	
	
	$("#formCliente").on("submit", function(){
   
		
		$(".btnConfirma").attr('disabled', 'disabled');
		
	});
	
	$(window).load(function(){
		<?	
			if($flagcli)
			{	
				echo "$('#ClientValidation').modal('show');";	
			}
			if($flagcliOK)
			{	
				echo "
						$('#clientOK').modal('show').on('hidden.bs.modal', function () {
							location.href='clients.php';
						});				
				";	
			}
			if($updated)
			{	
				echo "
						$('#clientUpdateOK').modal('show').on('hidden.bs.modal', function () {
							location.href='clients.php';
						});				
				";	
			}
			
		?>
	});
	</script>
	
</body>

</html>
