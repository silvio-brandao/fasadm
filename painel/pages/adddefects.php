<?php       
	// ESTA PAGINA FOI DESATIVADA NO SISTEMA, NÃO HÁ MAIS FUNCIONALIDADE
	
	
	
	
	
	
	
	
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
 
		// $db->onlyAdmin();
		 
	$flagcliExist = false;
	$flagcliOK = false;
	
    
	if(!empty($_GET['view'] ))
	{
		$query = "SELECT * FROM tb_defects WHERE DEF_CODIGO  = '".$_GET['view']."' ";
			
		$resultado = $mysqli->query($query); 
		$row = $resultado->fetch_array();
		
	}
    
	if(!empty($_GET['edit']))
	{
		$query = "SELECT * FROM tb_defects WHERE DEF_CODIGO = '".$_GET['edit']."' ";
			
		$resultado = $mysqli->query($query); 
		$row = $resultado->fetch_array();
		
	}	
	
	if(!empty($_GET['update']))
	{
		$sqlupdate = "UPDATE tb_defects SET  DEF_DESC='".$_POST['newdesc']."' WHERE DEF_CODIGO ='".$_GET['update']."';";
		
		if ($mysqli->query($sqlupdate) == true) {		   
			$updated = true;
		} else {
			echo "Error updating record: " . $mysqli->error;
		}
	}	
	
    if(!empty($_POST['newdesc'])  && empty($_GET['update']))
    {	
		$insert = "INSERT INTO tb_defects (DEF_DESC)							
							VALUES ('".$_POST['newdesc']."'	)";
					
		if ($mysqli->query($insert) == true) {
			$flagdefOK = true;
		} else {
			echo "Error: " . $insert . "<br>" . $mysqli->error;
		}
    }
?> 
<html lang="en">
<? include("head.php"); ?>

<body>
    <div id="wrapper"><?$action = !empty($_GET['edit'])  ? 'action="?update='.$_GET['edit'].'"' : ''; ?>		
        <!-- Navigation --><? include("navigation.php"); ?>
		<form method="POST" <? echo $action ?> />
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
					<div class="row">
						<div class="col-lg-12">
						<? 
						
						if(!empty($_GET['view']))
						{
							$pageHeader = "Visualizar Defeito";
						}else{
							$pageHeader = "Adicionar Defeito";
						}
						if(!empty($_GET['edit']))
						{
							$pageHeader = "Alterar Defeito";
						}
						?>
						
							<h1 class="page-header"><?echo $pageHeader; ?></h1>
						</div>
						<!-- /.col-lg-12 -->
					</div>
						
					<div class="row">
								
						<div class="col-lg-2 ">
						   <div class="form-group">
								<label>Código:</label>
								<input class="form-control" placeholder="Código"  id="newcodigo" name="newcodigo"  value="<?=$row['DEF_CODIGO']?>" readonly/>
							</div>
						</div>
						
						<?
						if(!empty($_GET['view']))
						{
							$readonly = "readonly";
						}
						?>
						
						
						<div class="col-lg-10 ">
						   <div class="form-group">
								<label>Descrição:</label>
								<input class="form-control" placeholder="Descrição" id="newdesc" name="newdesc" maxlength="249" value="<?=$row['DEF_DESC']?>" <?echo $readonly  ?> />
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
								
								<button type="submit"   class="btn btn-default btn-circle btn-xl" title="Confirmar" <?echo $disabled?> >
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
					
					
					
					
						<!--Modal -->
					<div class="modal fade" id="defOK" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
					<div class="modal fade" id="defeitoUpdateOK" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
										<button onClick="window.location='defects.php'"  type="button" class="btn btn-default" data-dismiss="modal">OK</button>
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
	$(window).load(function(){
		<?	
		
			if($flagdefOK)
			{	
				echo "
						$('#defOK').modal('show').on('hidden.bs.modal', function () {
							location.href='defects.php';
						});				
				";	
			}
			if($updated)
			{	
				echo "
						$('#defeitoUpdateOK').modal('show').on('hidden.bs.modal', function () {
							location.href='defects.php';
						});				
				";	
			}
			
		?>
	});
	</script>
	
	
	
	
	
</body>

</html>


