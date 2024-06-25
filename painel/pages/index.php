<?
if(empty($_SESSION)){session_start();}

ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);


include('connectdb.php');	


require_once "../includes/PagSeguroLibrary/PagSeguroLibrary.php";

//include('../includes/dbconfig.php');	


	$usuario =	$_SESSION['usuario'];
	/*	
		
	if(!empty($_GET['pagar'])){
		
		
		$getReport = ("SELECT PAG_REPORT, PAG_VALOR ,  PAG_CLIENTE_COD FROM tb_pagamentos 
		WHERE PAG_CODIGO = '".$_GET['pagar']."' ");
		
		$reportarr = $mysqli->query($getReport); 
			
			if(mysqli_num_rows($reportarr) > 0)
			{   
				$ROW = $reportarr->fetch_array();
		
				$report = $ROW['PAG_REPORT'];
				$valor = $ROW['PAG_VALOR'];
				$cliente = $ROW['PAG_CLIENTE_COD'];
			}
		
		
		//echo $report;
		
		
		$getClientetInfo = ("SELECT CLI_NOME, CLI_EMAIL  FROM tb_clientes
		WHERE CLI_CODIGO = '".$cliente."'");
		
		
		$reportclienteinfoarr = $mysqli->query($getClientetInfo); 
			
			if(mysqli_num_rows($reportclienteinfoarr) > 0)
			{   
				$ROW = $reportclienteinfoarr->fetch_array();
		
				$nome = $ROW['CLI_NOME'];	
				$email = $ROW['CLI_EMAIL'];	
			}
		
		
		
				
		$paymentRequest = new PagSeguroPaymentRequest();
		$paymentRequest->addItem('1', 'O.C Fas Manutencao N. '.$report, 1, str_replace(",", ".", str_replace(".", "", $valor))); 
		$paymentRequest->setSender(  
			  $nome,  
			  $email
		); 
		$paymentRequest->setCurrency("BRL"); 
		$paymentRequest->setShippingType(1);		
		$paymentRequest->setReference($_GET['pagar']); 
		
		try {  
  
		  $credentials = new PagSeguroAccountCredentials('alves.santos.f@gmail.com', '352DDE1E0A23445595D5726CADF56DF5'); 
 
/*ECHO "<PRe>";
 PRINT_R($paymentRequest);	 
ECHO "</PRe>";

	$url = $paymentRequest->register($credentials);  
		
			$code = explode("code=", $url)[1];
			
			
			
				$sqlupdate = "UPDATE tb_pagamentos SET 
				
					PAG_NOTIFICATION_CODE ='".$code."'
					WHERE PAG_CODIGO ='".$_GET['pagar'] ."';";

				if ($mysqli->query($sqlupdate) == false) {		   
					
					echo "Error updating record: " . $mysqli->error;
				}
			
		 //ECHO $code; die();
		 //header ("Location: $url");
		  echo '<meta http-equiv="Refresh" content="0; url='.$url.'">';
		} catch (PagSeguroServiceException $e) {  
			die($e->getMessage());  
		}  
		
	}
	
	
*/
	
?>

<!DOCTYPE html>
<html lang="en">

<? include("head.php");


 ?>

<body>

  <div id="wrapper">

        <!-- Navigation -->
        <? include("navigation.php"); ?>
        <!-- Page Content -->
		
        <div id="page-wrapper" <?  if($_SESSION['permissao'] == '2') {echo 'style="margin: 0 0 0 0"'; } ?>>
            <div class="container-fluid">
					<div class="row">
						<div class="col-lg-12">
						<h3 class="page-header" id="alertaNavegador"></h3>
						<? 
						//echo $_SESSION['permissao'];
						//session_start();
						
						
						if($_SESSION['permissao'] == '1'){
						?>
							<h1 class="page-header">Painel</h1>
						<?
						}
						if($_SESSION['permissao'] == '2'){
						?>
							<h1 class="page-header">Painel do Cliente </h1>   <h6> <? echo  $_SESSION['cliente']; ?></h6>
							
							<h5> Aqui você pode visualizar e assinar todos os relatórios já feitos.</h5>
							<!--img src="https://stc.pagseguro.uol.com.br/public/img/banners/pagamento/avista_estatico_550_70.gif" alt="Logotipos de meios de pagamento do PagSeguro" title="Este site aceita pagamentos com Bradesco, Itaú, Banco do Brasil, Banrisul, Banco HSBC, saldo em conta PagSeguro e boleto."-->
						<?
							
						}
						if($_SESSION['permissao'] == '3'){
						?>
							<h1 class="page-header">Painel do Funcionário/Parceiro</h1>
						<?
						}
						?>
						
						</div>
						<!-- /.col-lg-12 -->
					</div>
					
					<div class="row" >
						<div class="col-lg-12 ">
						   <div class="form-group" id="alertprivileges">
								
							</div>
						</div>
					</div>
					<? 
					//session_start();
					if($_SESSION['permissao'] == '1'){
						//pagina do administrador
						?>
						
						
					<div class="row">
						
						
						<div class="col-lg-3">
							<a href="./addclient.php">
							<div class="panel panel-green">
								<div class="panel-heading">
									Novo Cliente
								</div>							
							</div>
							</a>
						</div>
						
						
						<div class="col-lg-3">
							<a href="./addreports.php">
							<div class="panel" style="    border-color: #100090;    background-color: #220596;">
								<div class="panel-heading" style="    color: white;">
									Novo Relatório
								</div>							
							</div>
							</a>
						</div>
						
						<div class="col-lg-3">
							<a href="./reports.php">
							<div class="panel" style="border-color: #6e5eec;background-color: #5e38f9;">
								<div class="panel-heading" style="    color: white;">
									Relatórios
								</div>							
							</div>
							</a>
						</div>
						
							
						<div class="col-lg-3">
							<a href="../agenda/index.php">
							<div class="panel" style="border-color: #ad8617;background-color: #f18931;">
								<div class="panel-heading" style="    color: white;">
									Agenda
								</div>							
							</div>
							</a>
						</div>
						
					
					</div>
					
					<div class="row">
					<div class="col-lg-3"></div>
					<div class="col-lg-3">
							<a href="./addOrcamento.php">
							<div class="panel" style="    border-color: #100090;    background-color: #220596;">
								<div class="panel-heading" style="    color: white;">
									Novo Orçamento
								</div>							
							</div>
							</a>
						</div>
						
						<div class="col-lg-3">
							<a href="./orcamentos.php">
							<div class="panel" style="border-color: #6e5eec;background-color: #5e38f9;">
								<div class="panel-heading" style="    color: white;">
									Orçamentos
								</div>							
							</div>
							</a>
						</div>
					
					</div>	
						
							
					<?
					}
					
					if($_SESSION['permissao'] == '2'){
						//pagina do cliente
					?>	
					
					
						
					<div class="row">
						<div class="col-lg-5">
							<div class="form-group input-group">
								<input type="text" class="form-control" placeholder="Pesquisar..." id="search" >
								<span class="input-group-btn">
									<a ><button  class="btn btn-default" type="button" id="searchBtn" name="searchBtn"> <i class="fa fa-search"></i>
									</a>
								</span>
							</div>
						</div>
					</div>
						<div class="row rowAssinatura" id="assinaturaId">
							
						<!-- /.col-lg-12 -->
						</div> 
						<div class="row">
							<div class="col-lg-8">
								<div class="panel panel-default">
									<div class="panel-heading">
									   Relatórios 
									</div>
									<!-- /.panel-heading -->
									<div class="panel-body">
										<div class="table-responsive">
											<table class="table table-hover" id="tableCli" >
												<thead>
													<tr>																											
														<th style="min-width: 85px;"></th>
														<th>Nº Relatório</th>
														<th>Máquina</th>
														<th>Data</th>
													<!-- ajax/ajaxProjeto searchClient-->
													</tr>
												</thead>
												<tbody>
												<tr><td colspan='9' style='text-align: center'><img src='../images/loading.gif'></td></tr>
												</tbody>
											</table>
											<div style="    text-align: center; cursor: pointer;">
							
												<a id="exibir-mais" style="color:  #337ab7; display: block;" exibe="5" >Exibir mais resultados</a> 
										 </div>
										</div>
											<!-- /.table-responsive -->
											
									</div>										
										<!-- /.panel-body -->
								</div>							
								
								<!-- /.panel -->
							</div>					
						</div>	
						
						
						
						
					<?	
					}
					
					if($_SESSION['permissao'] == '3'){
						?> 
						
						
						
						<div class="row">
						<div class="col-lg-3">
							<a href="./addclient.php">
							<div class="panel panel-green">
								<div class="panel-heading">
									Novo Cliente
								</div>							
							</div>
							</a>
						</div>
						
						
						<div class="col-lg-3">
							<a href="./addreports.php">
							<div class="panel" style="    border-color: #100090;    background-color: #220596;">
								<div class="panel-heading" style="    color: white;">
									Novo Relatório
								</div>							
							</div>
							</a>
						</div>
						
						<div class="col-lg-3">
							<a href="./reports.php">
							<div class="panel" style="border-color: #6e5eec;background-color: #5e38f9;">
								<div class="panel-heading" style="    color: white;">
									Relatórios
								</div>							
							</div>
							</a>
						</div>
						
						<div class="col-lg-3">
							<a href="../agenda/index.php">
							<div class="panel" style="border-color: #ad8617;background-color: #f18931;">
								<div class="panel-heading" style="    color: white;">
									Agenda
								</div>							
							</div>
							</a>
						</div>
						
						
					</div>
						
						
						
						
						
						
						
					
						<?
					}
					
					
					
					?>
					
					
            </div>
            <!-- /.container-fluid -->
        </div>

    </div>

	<!--Modal -->
		<div class="modal fade" id="pagamentoAlteradoModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
										<h4 class="modal-title" id="myModalLabel">Sucesso</h4>
									</div>
									<div class="modal-body">
										Pagamento Alterado!
									</div>
								<div class="modal-footer">
									<button  type="button" class="btn btn-default" data-dismiss="modal">OK</button>
									
								</div>
							</div>
							<!-- /.modal-content -->
						</div>
						<!-- /.modal-dialog -->
					</div>	
					
					
					
					<div class="modal fade" id="AssOKModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									<h4 class="modal-title" id="myModalLabel">Sucesso</h4>
								</div>
								<div class="modal-body">
									Assinatura Confirmada! 
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
								</div>
						</div>
						<!-- /.modal-content -->
					</div>
					<!-- /.modal-dialog -->
				</div>
    <!-- jQuery -->
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>
	<!--script src="../js/html2canvas.js"></script-->	

    <!-- Bootstrap Core JavaScript -->
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>
	
	<script> 
		
		
		
		
		<?			
		if(!empty($_GET['acess'])){
				if($_GET['acess'] == 'denied'){ 
			?>
				$("#alertprivileges").append('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Você não tem privilégios suficientes para acessar a página solicitada. <a href="#" class="alert-link">Alerta.</a>.</div>');
			<?
			
		}}	
		/*if(!empty($_GET['transaction_id'])){
			
			?>
				$("#alertprivileges").append('<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Obrigado por efetuar o pagamento pelo nosso sistema! Você receberá um e-mail assim que identificarmos o pagamento. <a href="index.php" class="alert-link">Fas Manutenção</a>.                            </div>');
			<?
			
		}*/		
		
		?>		
			
		var typingTimer; //timer identifier
		var doneTypingInterval = 500; //time in ms, 5 second for example
			
			
	$(document).ready(function(){
		 
			<?if($_SESSION['permissao'] == '1'){?>
				carregaPagamentos(15);				
				trataBotaoSearchExibirMais();
			<?}?>
			<?if($_SESSION['permissao'] == '2'){?>
				carregaRelatorios(15);				
				trataBotaoSearchExibirMaisRelatorios();
			<?}?>
			
		var navegador = GetBrowserInfo(); //funcaono js getbrowser.js
		if(navegador != "Opera" && navegador != "Chrome"){
			
			$("#alertaNavegador").html("<label style='color: red;'>Este Sistema não é compatível com o navegador "+navegador+".</label> <br><br>Recomendamos os navegadores Opera ou Chrome");
		
		}
			
	});

	function trataBotaoSearchExibirMais(){
		
			$("#search").keyup(function(e){		
				
				
				$("#tableCli tbody").html("<tr><td colspan='9' style='text-align: center'></td></tr> ");
						
				 $("#tableCli tbody").html("<tr><td colspan='9' style='text-align: center'><img src='../images/loading.gif'></td></tr>");
				
				clearTimeout(typingTimer);
				 
				 $("#exibir-mais").attr("exibe", 15);
				 
				 typingTimer = setTimeout(function(){ carregaPagamentos(15); }, doneTypingInterval);
			});

			
				
			$("#exibir-mais").on('click',function(){
				 $("#tableCli tbody").append("<tr><td colspan='9' style='text-align: center'><img src='../images/loading.gif'></td></tr>");
				
				 clearTimeout(typingTimer);
				 
				 typingTimer = setTimeout(function(){ carregaPagamentos(parseInt($("#exibir-mais").attr("exibe"))+15); }, doneTypingInterval);		
				
				 $("#exibir-mais").attr("exibe", parseInt($("#exibir-mais").attr("exibe"))+15);
			});
	
	}
	
		function trataBotaoSearchExibirMaisRelatorios(){
		
			$("#search").keyup(function(e){		
				
				
				$("#tableCli tbody").html("<tr><td colspan='9' style='text-align: center'></td></tr> ");
						
				 $("#tableCli tbody").html("<tr><td colspan='9' style='text-align: center'><img src='../images/loading.gif'></td></tr>");
				
				clearTimeout(typingTimer);
				 
				 $("#exibir-mais").attr("exibe", 15);
				 
				 typingTimer = setTimeout(function(){ carregaRelatorios(15); }, doneTypingInterval);
			});

			
				
			$("#exibir-mais").on('click',function(){
				 $("#tableCli tbody").append("<tr><td colspan='9' style='text-align: center'><img src='../images/loading.gif'></td></tr>");
				
				 clearTimeout(typingTimer);
				 
				 typingTimer = setTimeout(function(){ carregaRelatorios(parseInt($("#exibir-mais").attr("exibe"))+15); }, doneTypingInterval);		
				
				 $("#exibir-mais").attr("exibe", parseInt($("#exibir-mais").attr("exibe"))+15);
			});
	
	}
	
	
	function carregaPagamentos(limite){
		$.ajax({
			//pagina onde está o ajax
			url: 'ajax/ajaxProjeto.php',
			type: 'get',
			
			//dados do get
			data: {
				funcao: "searchPagamentos",
				search: $("#search").val(),
				limit: limite
					<?			
					if(!empty($_GET['acess'])){
						if($_GET['acess'] == 'client'){
							?>, isClient: true
							<?						
						}
					}
					?>
				}, 
				//retorno 
			success: function(response) {
					$("#tableCli tbody").html(response);
					trataBotaoConfirmaPagamento();
					trataBotaoVoltaPagamento();
				}
			}); 
	}
	
	
	//função com os parametros do ajad
	function carregaRelatorios(limite){
		$.ajax({
			//pagina onde está o ajax
			url: 'ajax/ajaxProjeto.php',
			type: 'get',
			
			//dados do get
			data: {
				funcao: "searchReportClientes",
				search: $("#search").val(),					
				limit: limite
				},
				//retorno 
			success: function(response) {
				
				 $("#tableCli tbody").html(response);
				 
				 //trataBotaoVisualizar();
				 
				 trataBotaoEditar();
				 
				// trataBotaoExcluir();
				 
				 //trataBotaoEnviar();
				 
				 trataBotaoGerar();
				}
			}); 
	}
	
		function trataBotaoEditar(){
			$('.editReport').on('click',function (){	
				$("#assinaturaId").html('<div class="col-lg-12"><iframe src="assinatura.php?edit='+$(this).attr("report")+'" width="100%" height="350px"></iframe></div>');
			});
		}
	
		function trataBotaoGerar(){
	
			$('.generateReport').on('click',function (){	
				
				window.open("generatereport.php?generate="+$(this).attr("report")+"&data="+$(this).attr("data"), '_blank');
				
			}); 
		}
			
	function trataBotaoConfirmaPagamento(){
				
		$('.confirmaPagamento').on('click', function(){  
			
			$.ajax({
				//pagina onde está o ajax
				url: 'ajax/ajaxProjeto.php',
				type: 'get',
				
				//dados do get
				data: {
					funcao: "confirmaPagamento",
					pagamento : $(this).attr('pagamento'),
						
					}, 
					//retorno 
				success: function(response) {
						carregaPagamentos(15);
						$("#pagamentoAlteradoModal").modal('show');
					}
				}); 
			
		});
				
	}
	
	function abreModalAssinatura(){
		
		$('#AssOKModal').modal('show').on('hidden.bs.modal', function () {
										parent.location.href='./index.php';
			});
	}
			
	function trataBotaoVoltaPagamento(){
		
		$(".voltarPagamento").on('click', function(){
			
			$.ajax({
				//pagina onde está o ajax
				url: 'ajax/ajaxProjeto.php',
				type: 'post',
				
				//dados do get
				data: {
					funcao: "voltarPagamento",
					pagamento : $(this).attr('pagamento')
						
					}, 
					//retorno 
				success: function(response) {
						carregaPagamentos(15);
						$("#pagamentoAlteradoModal").modal('show');
					}
				}); 
			
		});
		
	}
	/*function pagarOnline(pagamento){
		
		 window.open("index.php?pagar="+pagamento, '_blank');
	}
		*/	
	function generateReport(cli, data){
		 window.open("generatereport.php?generate="+cli+"&data="+data, '_blank');
	}
	
	
	
	
		</script> 
</body>
</html>