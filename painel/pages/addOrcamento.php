<?php
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
	<link href="../includes/jquery.timepicker.css" rel="stylesheet" type="text/css">	
	
    <!-- MetisMenu CSS -->
    <link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">
	
    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link href="../includes/jquery-ui.css" rel="stylesheet"/>
	
	

	<link rel="shortcut icon" href="../favicon.ico" >
</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <? include("navigation.php"); ?>
	<form method="POST" <? echo $action ?> >
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
					<div class="row">
						<div class="col-lg-12">
						<? 
						
						if(!empty($_GET['view']))
						{
							$pageHeader = "Visualizar Orçamento";
							
						}else{
							$pageHeader = "Adicionar Orçamento";
						}
						if(!empty($_GET['edit']))
						{
							$pageHeader = "Alterar Orçamento";
							
						}
					
						
						?>
							<h1 class="page-header"><?echo $pageHeader; ?></h1>
						</div>
						<!-- /.col-lg-12 -->
					</div>
						<? 
							//$disabled = !empty($_GET['edit']) ? "disabled" : "";
						?>	
						<? 
							//$readonly = !empty($_GET['edit']) ? "readonly" : "";
						?>						
					<div class="row">
									
						
						<div class="col-lg-3 ">
						   <div class="form-group">
								<label>Cliente:</label>
								<input class="form-control" placeholder="Empresa"  id="orcempresa" name="orcempresa"    readonly  />
							</div>
						</div> 
						
						<div class="col-lg-2 ">
						   <div class="form-group">
								<label>Cod:</label>
								<input class="form-control" placeholder="Código Cliente"  id="codCli" name="codCli"    readonly  />
							</div>
						</div> 
					
						<div class="col-lg-3 ">
						   <div class="form-group">
								<label>Solicitante:</label>
								<input class="form-control" placeholder="Solicitante" maxlength="100" id="orcsolicitante" name="orcsolicitante"  />
							</div>
						</div>
						<div class="col-lg-2 ">
						   <div class="form-group">
								<label>Data:</label>								
								<input  type="text" value="<?echo dtoc(Date('Ymd')); ?>" class="form-control" placeholder="Data"  id="orcdata" name="orcdata"    readonly />
							</div>
						</div>
						<div class="col-lg-2 ">
						   <div class="form-group">
								<label>Código:</label>
								<input class="form-control" placeholder="Cód"  id="orccod" name="orccod"   readonly/>
							</div>
						</div>
					</div>	
					<div class="row rowInfoCli">								
						<div class="col-lg-2 ">
						   <div class="form-group">
								<label>CNPJ/RG:</label>
								<input class="form-control" placeholder="CNPJ/RG"  id="orccnpjcpf" name="orccnpjcpf" maxlength="14" readonly/>
							</div>
						</div>
						
						<div class="col-lg-3 ">
						   <div class="form-group">
								<label>Município:</label>
								<input class="form-control" placeholder="Município" id="orcmun" name="orcmun" maxlength="100"  readonly/>
							</div>
						</div>
						
						<div class="col-lg-3 ">
						   <div class="form-group">
								<label>Endereço:</label>
								<input class="form-control" placeholder="Endereço" id="orcend" name="orcend" maxlength="60"   readonly/>
							</div>
						</div>
						<div class="col-lg-1 ">
						   <div class="form-group">
								<label>Número:</label>
								<input class="form-control" placeholder="Núm"  id="orcnumero" name="orcnumero"  readonly/>
							</div>
						</div>
						<div class="col-lg-1 ">
						   <div class="form-group">
								<label>Estado:</label>
								<input class="form-control" placeholder="UF" id="orcestado" name="orcestado" maxlength="2"  readonly/>
							</div>
						</div>
						
						<div class="col-lg-2 ">
							<div class="form-group">
								<label>Cep:</label>
								<input class="form-control" placeholder="Cep" id="orccep" name="orccep" maxlength="9"  readonly/>
							</div>
						</div>	
						
					</div>					
					
					<div class="row">
									
						<div class="col-lg-3 ">
						   <div class="form-group">
								<label>Máquina:</label>
								<input class="form-control" placeholder="Máquina"  id="orcmaquina" name="orcmaquina" maxlength="100" />
							</div>
						</div>
						<div class="col-lg-3 ">
						   <div class="form-group">
								<label>Nº Máquina:</label>
								<input class="form-control" placeholder="Número da máquina"  id="orcnummaquina" maxlength="30" name="orcnummaquina"  />
							</div>
						</div>
						
						<div class="col-lg-4 ">
						   <div class="form-group">
								<label>Modelo:</label>
								<input class="form-control" placeholder="Modelo" maxlength="100" id="orcmodelomaquina" name="orcmodelomaquina"  />
							</div>
						</div>
						
						<div class="col-lg-2 ">
						   <div class="form-group">
								<label>Pedido Cliente:</label>
								<input class="form-control" placeholder="Pedido Cliente"  maxlength="30" id="orcpedidocliente" name="orcpedidocliente"    />
							</div>
						</div>
					</div>	
					
					
					<div class="row">									
						<div class="row">									
							<div class="col-lg-12 ">
							   <div class="form-group">
								<label>Descrição do Problema:</label>
									<textarea class="form-control" rows="6" placeholder="Descrição do Problema" maxlength="5000" id="orcdefectdesc" name="orcdefectdesc"  /></textarea>
								</div>
							</div>
						</div>
					
					
					
						<div class="row">									
						<div class="col-lg-12 ">
						   <div class="form-group">
							<label>Descrição do Orçamento:</label>
								<textarea class="form-control" rows="5" placeholder="Descrição do Orçamento" maxlength="5000" id="orcdescricao" name="orcdescricao"  /><?=$row['ORC_DESCRICAO']?></textarea>
							</div>
						</div>
					</div>
					
					<!--div class="row">									
						<div class="col-lg-12 ">
						   <div class="form-group">
							<label>Descrição do Trabalho a ser Executado:</label>
								<textarea class="form-control" rows="5" maxlength="5000" placeholder="Descriçãio do Trabalho a ser Executado"  id="orcsolucao" name="orcsolucao"  /><?=$row['ORC_SOLUCAO']?></textarea>
							</div>
						</div>
					</div-->
					
					<div class="row">									
						<div class="col-lg-12 ">
						   <div class="form-group">
							<label>Lista de Materiais que deverão ser adquididos pelo cliente:</label>
								<textarea class="form-control" rows="5" placeholder="Lista de Materiais"  id="orcmateriais" name="orcmateriais"  /><?=$row['ORC_MATERIAIS']?></textarea>
							</div>
						</div>
					</div>
					
					<div class="row">									
						<div class="col-lg-12 ">
						   <div class="form-group">
							<label>Total de Dias:</label>
								<textarea class="form-control" rows="5" placeholder="Total de Dias" maxlength="1000"  id="orcdias" name="orcdias"  /><?=$row['ORC_DIAS']?></textarea>
							</div>
						</div>
					</div>
										
					<div class="row ">									
						<div class="col-lg-3 " id="reportvalor_div">
						   <div class="form-group">
							<label>Total do Orçamento R$:</label>
							
							<input  type="text"  class="form-control"   placeholder="Total do Serviço"   id="orcvalor" name="orcvalor"   />
							 
							</div>
						</div>
						<div class="col-lg-3 ">
						   <div class="form-group">
							<label>Condição de Pagamento:</label>
							
							<input  type="text"  class="form-control"   placeholder="Condição de Pagamento"   id="prazoPagamento" name="prazoPagamento"   />
							 
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
				<?

						if(!empty($_GET['view'])){
							?> 
							
								<div class="col-lg-12" style="text-align:center;" >
								   <div class="form-group">
										
										<a href="javascript:window.history.go(-1)"><button  type="button" class="btn btn-warning btn-circle btn-xl" title="Voltar"  >
											<i class="fa fa-step-backward"></i>
										</button></a>
									</div>
									<br><br>
								</div>
							
							<?
						}else{
					?>
						
							<div class="col-sm-12" style="text-align:center;">   
							<? if(!empty($_GET['edit'])){ ?>						
				
								<button type="button" class="btn btn-primary btn-circle btn-xl" title="Confirmar Edição" id="btnEdit" style="margin: 37px;"><i class="fa fa-pencil"></i></button>
								
							<?}else{?>
								<button type="button" class="btn btn-success btn-circle btn-xl" id="btnOk" title="Confirmar Inclusão" style="margin: 37px;"><i class="fa fa-check"></i></button>
							<?}?>										
							</div>
						
						<? } ?>
				
				<br><br>
				<!--Modal -->
					<!--Modal -->
				<div class="modal fade" id="orcOK" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
				
				<div class="modal fade" id="selectClienteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									<h4 class="modal-title" id="myModalLabel">Selecionar Cliente</h4>
								</div>
								
								<div class="modal-body" style="text-align: center;">
									
									<div class="col-md-12 col-sm-12 col-xs-12">
										 <input type="text" class="form-control has-feedback-left" id="search-clientes" placeholder="Pesquisar...">
										 
									</div>
									<div class="col-md-12 col-sm-12 col-xs-12">									  
										<div class="table-responsive" style="overflow-x: hidden; overflow-y: scroll; max-height: 250px;">
											<table class="table table-hover" id="tableCli" >
												<thead>
													<tr>
														<th ></th>														
														<th style="    min-width: 406px;">Nome</th>														
														<th>CNPJ/CPF</th>														
														<th style="    min-width: 250px;">Minicípio - UF</th>
													</tr>
												</thead>
												<tbody>
																			 
												</tbody>
											</table>
											<div style="    text-align: center; cursor: pointer;">
												<a id="exibir-mais" style="color:  #337ab7; display: block;" exibe="15" >Exibir mais resultados</a> 
											 </div>
										</div>
									</div>
								
								</div>
								
								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
								</div>
						</div>
						<!-- /.modal-content -->
					</div>
					<!-- /.modal-dialog -->
				</div>
				
						<!--Modal -->
					<div class="modal fade" id="orcUpdateOK" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
	
	<script src="../includes/jquery-ui.js"></script>
	<script src="../includes/jquery.timepicker.js"></script>	
	<script src="../includes/jquery.timepicker.min.js"></script>
	<script src="../includes/jquery.mask.js"></script>
	
</body>
<script>

	$('#orcvalor').mask('00.000.000,00', {reverse: true}); 

	var typingTimer; //timer identifier
	var doneTypingInterval = 500; //time in ms, 5 second for example

	$(window).load(function(){
		
		
		<? if(empty($_GET['edit'])){ ?>
			carregaClientes(15);
			trataClickCliente();
			trataSearchExibirMaisModalcliente();
			trataBotaoOK(); 
			
		<? }else{
			?>
			
				trataBotaoOKEdicao();
			<?
		} ?>
		
		
		<? if(!empty($_GET['view'])){ ?>
			$(".form-control").attr('disabled', 'disabled');
		<? }?>
		
		//carregaDefeitos(5);
		//trataClickDefeitos();
		//trataSearchExibirMaisModaldefeito();
		//trataBotaoApagarDataDePagamento();
		
		hideCamposValorFuncionario();
	});
	
	
	
	
	function hideCamposValorFuncionario(){
		
			<? 					
				if($_SESSION['permissao'] != '1'){
			?>
				$("#reportvalor_div").hide();	
							
			
			<? 					
				}
			?>
		
	}
	
	
	
	//função com os parametros do ajad
	function carregaClientes(limite){
		$.ajax({
			//pagina onde está o ajax
			url: 'ajax/ajaxProjeto.php',
			type: 'get',
			
			//dados do get
			data: {
				funcao: "searchClientModal", 
				search: $("#search-clientes").val(),
				limit: limite
				},
				//retorno 
			success: function(response) {
				 $("#tableCli tbody").html(response);
				 
				 trataSelectCliente();
				}
			}); 
	}

	function trataSelectCliente(){
		
		$(".selectCliente").on('click', function(){
			
			$("#orcempresa").val($(this).attr('nome'));
			$("#orcsolicitante").val($(this).attr('solicitante'));
			$("#orcnumero").val($(this).attr('numero'));
			$("#orccnpjcpf").val($(this).attr('documento'));
			$("#orcmun").val($(this).attr('municipio'));
			$("#orcend").val($(this).attr('endereco'));
			$("#orcestado").val($(this).attr('estado'));
			$("#orccep").val($(this).attr('cep'));
			$("#codCli").val($(this).attr('cliente'));
			
			
				$("#selectClienteModal").modal("hide");
		});	
		
	}

	
	
	
	function trataClickCliente(){
		
		$("#orcempresa").on('click', function(){
			
			
			
			$("#selectClienteModal").modal("show").on('shown.bs.modal', function(){
				
					$("#search-clientes").focus();
				
				});

		});
		
	}
	
	
	
	function trataSearchExibirMaisModalcliente(){
		
		
		$("#search-clientes").keyup(function(e){		
			
			
			$("#tableCli tbody").html("<tr><td colspan='10' style='text-align: center'></td></tr> ");
					
			 $("#tableCli tbody").html("<tr><td colspan='10' style='text-align: center'><img src='../images/loading.gif'></td></tr>");
			
			clearTimeout(typingTimer);
			 
			 $("#exibir-mais").attr("exibe", 15);
			 
			 typingTimer = setTimeout(function(){ carregaClientes(15); }, doneTypingInterval);
		});

		
			
		$("#exibir-mais").on('click',function(){
			 $("#tableCli tbody").append("<tr><td colspan='10' style='text-align: center'><img src='../images/loading.gif'></td></tr>");
			
			 clearTimeout(typingTimer);
			 
			 typingTimer = setTimeout(function(){ carregaClientes(parseInt($("#exibir-mais").attr("exibe"))+15); }, doneTypingInterval);		
			
			 $("#exibir-mais").attr("exibe", parseInt($("#exibir-mais").attr("exibe"))+15);
		});
		
	}
	
	function validaCampos(){
		
			
				var validado = true;
				
								
				$("#orcempresa").css('border-color', '');			
				
				
				if($.trim($("#orcempresa").val()) == ""){
					
					$("#orcempresa").css('border-color', 'red');
					validado = false;
					$("#selectClienteModal").modal('show');
				}
				
			
				
				
				if(!validado){return false;}else{return true};
		
	}
	
		function trataBotaoOK(){		
		$('#btnOk').on('click',function (){
			$('#btnOk').attr('disabled', 'disabled');
			if(!validaCampos()){$('#btnOk').removeAttr('disabled'); return;}	
		
			
			$.ajax({
				//pagina onde está o ajax
				url: 'ajax/ajaxProjeto.php',
				type: 'post',
				
				//dados do ge t
				data: {
					funcao: "incluirOrcamento", 
					
					ORC_CLIENTE : $("#codCli").val(),
					ORC_DATA : $("#orcdata").val(), 
					ORC_MAQUINA : $("#orcmaquina").val(), 
					ORC_NUMMAQUINA : $("#orcnummaquina").val(), 
					ORC_MODMAQUINA  : $("#orcmodelomaquina").val(), 
					ORC_PEDIDOCLI : $("#orcpedidocliente").val(), 
					ORC_DEFEITOS  : $("#orcdefectdesc").val(), 
					ORC_TOTAL : $("#orcvalor").val(), 
					ORC_DESCRICAO : $("#orcdescricao").val(), 
					ORC_SOLUCAO : $("#orcsolucao").val(),
					ORC_MATERIAIS : $("#orcmateriais").val(),
					ORC_DIAS : $("#orcdias").val(),
					ORC_SOLICITANTE : $("#orcsolicitante").val(),
					ORC_PRAZOPAGAMENTO : $("#prazoPagamento").val()
					
						
					},
					//retorno 
				success: function(response) {
					//$("#reportsolucao").val(response);
					//return;
					
					if($.trim(response) == "OK"){
						$('#orcOK').modal('show').on('hidden.bs.modal', function () {
							location.href='./orcamentos.php';
						});
					}else{alert(response);
						$("#orcdias").val(response);
					}
						  
					}
					
				}); 					
								
			
		});		

	}	
	
	function trataBotaoOKEdicao(){		
			$('#btnEdit').on('click',function (){			
				
				$('#btnEdit').attr('disabled', 'disabled');
				if(!validaCampos()){$('#btnEdit').removeAttr('disabled'); return;}	
					
				$.ajax({
					//pagina onde está o ajax
					url: 'ajax/ajaxProjeto.php',
					async: true,
					type: 'post',
					
					//dados do get
					data: {
					funcao : "editaOrcamento"	,							
					
					codigo : '<?echo $_GET['edit']; ?>',
					
					//nao sera possivel alterar o cliente de um orçamento, pois o resgistro esta vinculado ao cnpj/cpf
					ORC_DATA : $("#orcdata").val(), 
					ORC_MAQUINA : $("#orcmaquina").val(), 
					ORC_NUMMAQUINA : $("#orcnummaquina").val(), 
					ORC_MODMAQUINA  : $("#orcmodelomaquina").val(), 
					ORC_PEDIDOCLI : $("#orcpedidocliente").val(), 
					ORC_DEFEITOS  : $("#orcdefectdesc").val(), 
					ORC_TOTAL : $("#orcvalor").val(), 
					ORC_DESCRICAO : $("#orcdescricao").val(), 
					ORC_SOLUCAO : $("#orcsolucao").val(),
					ORC_MATERIAIS : $("#orcmateriais").val(),
					ORC_DIAS : $("#orcdias").val(),
					ORC_SOLICITANTE : $("#orcsolicitante").val(),
					ORC_PRAZOPAGAMENTO : $("#prazoPagamento").val()
					
						},
						//retorno 
					success: function(response) {
					//$("#reportsolucao").val(response);
					//return;
					if($.trim(response) == "OK"){
						$('#orcUpdateOK').modal('show').on('hidden.bs.modal', function () {
							location.href='./orcamentos.php';
						});
					}else{alert(response);}
						
						
						
						}
					}); 
				});
		}
	
	
	
$("#orcdata").datepicker({
        dateFormat: 'dd/mm/yy',
        dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'],
        dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
        dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
        monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
        monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez']
    });
	
	function dtoc(data)	{	

		if(data != ""){	
			datafmt = data.substring(6,8) + '/' + data.substring(4,6) + '/' + data.substring(0,4);
		 
			return datafmt;
		}else{return data;}
	}
  
<? if(!empty($_GET['edit']) || !empty($_GET['view'])){ ?>
		
		
		$.ajax({
			//pagina onde está o ajax
			url: 'ajax/ajaxProjeto.php',   
			async: true,
			type: 'get',
			dataType: "json",
			//dados do get
			data: {
				funcao : "getOrcamentoJson",
				codigo : '<? echo $_GET['edit'].$_GET['view'];?>'
				
				},
				//retorno 
				success: function(response) {					
					
					$("#codCli").val(response['ORC_CLIENTE']); 	
					$("#orcsolicitante").val(response['ORC_SOLICITANTE']); 	
					$("#orcdata").val(dtoc(response['ORC_DATA'])); 	
					$("#orccod").val(response['ORC_CODIGO']);

					$("#orcmaquina").val(response['ORC_MAQUINA']);
					$("#orcnummaquina").val(response['ORC_NUMMAQUINA']);
					$("#orcmodelomaquina").val(response['ORC_MODMAQUINA']);
					$("#orcpedidocliente").val(response['ORC_PEDIDOCLI']);
					$("#orcdefectdesc").val(response['ORC_DEFEITOS']);
					$("#orcdescricao").val(response['ORC_DESCRICAO']);
					
					$("#orcsolucao").val(response['ORC_SOLUCAO']);
					$("#orcmateriais").val(response['ORC_MATERIAIS']);
					$("#orcdias").val(response['ORC_DIAS']);
					$("#orcvalor").val(response['ORC_TOTAL']);
					$("#prazoPagamento").val(response['ORC_PRAZOPAGAMENTO']);
					//para manter a formatação
					$("#orcvalor").trigger('keyup');
					
					
						$.ajax({
							//pagina onde está o ajax
							url: 'ajax/ajaxProjeto.php',   
							async: true,
							type: 'get',
							dataType: "json",
							//dados do get
							data: {
								funcao : "getClienteJson",
								codigo : response['ORC_CLIENTE']
								
								},
								//retorno 
								success: function(response) {
									
									$("#orcempresa").val(response['CLI_NOME']); 	
									$(".rowInfoCli").css('display', 'none');
								}
						}); 
				}
		}); 
		
<?}?>






 </script>

</html>






<?

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



?>
