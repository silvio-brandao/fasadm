<?php
session_start();

$arrayPermission = array(1);	
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
 
	
	/*echo "<pre>";
		print_r($row); 
	echo "</pre>";
	*/
	?> 

<!DOCTYPE html>
<html lang="en">

<? include("head.php"); ?>

<body>

    <div id="wrapper">
	
	<!-- Navigation -->
	<? include("navigation.php"); ?>
	<!-- Navigation -->
	

	
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
					<div class="row">
						<div class="col-lg-12">
							<? 
						
						if(!empty($_GET['edit']))
						{
							$pageHeader = "Alterar Usuário";
						}else{
							$pageHeader = "Adicionar Usuário";
						}						
						?>
						
							<h1 class="page-header"><?echo $pageHeader; ?></h1>
						</div>
						<!-- /.col-lg-12 -->
					</div>
					<? 
							$disabled = !empty($_GET['edit']) ? "disabled" : "";
					?>	
					
				
				<div class="row">	
					<div class="col-lg-3 ">
					   <div class="form-group">
								
							<div class="form-group">
								<label>Permissões:</label>
								<select class="form-control" name="newpermissao" id="newpermissao" <? echo $disabled?> /> 
									<option value="1" selected>Administrador</option>
									<option value="2" >Cliente</option>		
									<option value="3" >Funcionário/Parceiro</option>	 										
								</select>
							</div>
						</div>
					</div>
					<div class="col-lg-4 "> 
					<label class="alertNaoEnviaRelatorio" style="display:none;">OBS:</label>
					<span class="alertNaoEnviaRelatorio" style="display:none; color: gray;">Este usuário não poderá enviar Relatórios! </span><span style="display:none; color: gray;">Este usuário não poderá visualizar VALORES!</span>
					</div>
				</div>
				
					
					
				<div class="row">					
					<div class="col-lg-4 ">
					   <div class="form-group">
							<label>Login:</label>
							<input class="form-control" placeholder="Login" id="newlogin" name="newlogin"  <? echo $disabled?> autocomplete="off"  />
						</div>
					</div>
				</div>
				
				<div class="row">	
					<div class="col-lg-6 ">
					   <div class="form-group">
							<label id="lblSenha">Senha:</label>
							<input class="form-control" placeholder="Senha" id="newsenha" value="" name="newsenha" type="password" autocomplete="off"  >
						</div>
					</div>
				</div>
				
				<div class="row">
					<div class="col-lg-6 ">
					   <div class="form-group">
							<label>Nome:</label>
							<input class="form-control" placeholder="Nome" id="newnome" name="newnome" autocomplete="off" >
						</div>
					</div>
				</div>
				
				
			
				
				<div class="row">	
					<div class="col-lg-6 ">
					   <div class="form-group" id="clientAssociation">
							<label id='lblCli'>Associar usuario ao Cliente:</label><input class='form-control' placeholder='Empresa'  id='userCliente' name='userCliente'    readonly/>
						</div>
					</div>
				</div>
				
				<div class="row">	
					<div class="col-sm-12" style="text-align:center;">   
							<? if(!empty($_GET['edit'])){ ?>						
				
								<button type="button" class="btn btn-primary btn-circle btn-xl" title="Confirmar Edição" id="btnEdit" style="margin: 37px;"><i class="fa fa-pencil"></i></button>
								
							<?}else{?>
								<button type="button" class="btn btn-success btn-circle btn-xl" id="btnOk" title="Confirmar Inclusão" style="margin: 37px;"><i class="fa fa-check"></i></button>
							<?}?>										
							</div>
				</div>
				
		 
				<!--Modal -->
				<div class="modal fade" id="UserValidation" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									<h4 class="modal-title" id="myModalLabel">Alerta</h4>
								</div>
								<div class="modal-body">
									<span id="spanAlert">AQUI VAI O TEXTO VIA JQUERY</span>
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
				<div class="modal fade" id="UserOK" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
					<div class="modal fade" id="userUpdateOK" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
				
				
				
				
				
				
            </div>
            <!-- /.container-fluid -->
        </div>


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
	<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	
	<script>
	var typingTimer; //timer identifier
	var doneTypingInterval = 500; //time in ms, 5 second for example

	$("#userCliente").css('background-color', '#d0ff9a');
	
	$(window).load(function(){
		
		
			tratamentosDiversos();
			trataClickCliente();
			trataBotaoOK();
			trataSearchExibirMaisModalcliente();
			trataSelectCliente();
			carregaClientes(15);
			
		<? if(!empty($_GET['edit'])){ ?>
			carregaJsonUsuario();
			
			trataBotaoOKEdicao();
			<?
		} ?>
		
		
		function trataBotaoOKEdicao(){		
			$('#btnEdit').on('click',function (){	
			
				
			if(!validaCampos()){	return;	}
		
			$.ajax({
				//pagina onde está o ajax
				url: 'ajax/ajaxProjeto.php',
				type: 'post',
				
				//dados do ge t
				data: {
					funcao: "editaUsuario", 
					codigo : '<?echo $_GET['edit']; ?>',
					//permissao : $("#newpermissao").val(),
					//usuario :  $("#newlogin").val(),
					senha :  $("#newsenha").val(),
					nome :  $("#newnome").val(),
					codCli : $("#userCliente").attr('cliente'),
					descCli : $("#userCliente").val(),
					
					},
					//retorno 
				success: function(response) {
					//$("#reportsolucao").val(response);
					//return;
					
					if($.trim(response) == "OK"){
						$('#userUpdateOK').modal('show').on('hidden.bs.modal', function () {
							location.href='./users.php';
						}); 
					}else{
					
						$("#spanAlert").html(response);
						$('#UserValidation').modal('show').on('hidden.bs.modal', function () {
							
						}); 
					}
						  
					}
					
				}); 
			
			});
		}
		
		function carregaJsonUsuario(){
				
			$.ajax({
				//pagina onde está o ajax
				url: 'ajax/ajaxProjeto.php',   
				async: true,
				type: 'get',
				dataType: "json",
				//dados do get
				data: {
					funcao : "getUsuarioJson",
					codigo : '<? echo $_GET['edit'];?>'
					
					},
					//retorno 
					success: function(response) {					
						
						//se for login de cliente, apresenta o campo de nome de cliente 
						if(response['USU_PERMISSAO'] == '2'){
							$( "#lblCli" ).show();
							$( "#userCliente" ).show();
							$("#newnome").attr("readonly","readonly");
						}
						
						
						
						$("#lblSenha").html("Senha: </br><span style='color: blue'>Digite para alterar a senha ou deixe em branco para manter a atual.</span>");
						
						$("#newpermissao").val(response['USU_PERMISSAO']); 	
						$("#newlogin").val(response['USU_USUARIO']); 	
						$("#newnome").val(response['USU_NOME']); 	
						
						
							$.ajax({
								//pagina onde está o ajax
								url: 'ajax/ajaxProjeto.php',   
								async: true,
								type: 'get',
								dataType: "json",
								//dados do get
								data: {
									funcao : "getClienteJson",
									codigo : response['USU_CLIENTE']
									
									},
									//retorno 
									success: function(response) {
										
										$("#userCliente").val(response['CLI_NOME']); 
										$("#userCliente").attr('cliente', response['CLI_CODIGO']);
										
									}
							}); 
					}
			});
			
		}
		
		function trataClickCliente(){	
		
			$("#userCliente").on('click', function(){
				
				$("#selectClienteModal").modal("show").on('shown.bs.modal', function(){	
				
						$("#search-clientes").focus();	
						
					});
			});			
		}
		
		
		function trataSelectCliente(){
		
			$(".selectCliente").on('click', function(){
				
				$("#userCliente").val($(this).attr('nome'));
				$("#userCliente").attr('cliente',($(this).attr('cliente')));					
				
				$("#selectClienteModal").modal("hide");
			});				
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
		
		
		function trataBotaoOK(){	
		
			$('#btnOk').on('click',function (){
			
			if(!validaCampos()){	return;	}
		
			$.ajax({
				//pagina onde está o ajax
				url: 'ajax/ajaxProjeto.php',
				type: 'post',
				
				//dados do ge t
				data: {
					funcao: "incluirUsuario", 
					permissao : $("#newpermissao").val(),
					usuario :  $("#newlogin").val(),
					senha :  $("#newsenha").val(),
					nome :  $("#newnome").val(),
					codCli : $("#userCliente").attr('cliente'),
					descCli : $("#userCliente").val(),
					
					},
					//retorno 
				success: function(response) {
					//$("#reportsolucao").val(response);
					//return;
					
					if($.trim(response) == "OK"){
						$('#UserOK').modal('show').on('hidden.bs.modal', function () {
							location.href='./users.php';
						}); 
					}else{
					
						$("#spanAlert").html(response);
						$('#UserValidation').modal('show').on('hidden.bs.modal', function () {
							
						}); 
					}
						  
					}
					
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
	
	});
	
		function tratamentosDiversos(){
				$( "#lblCli" ).hide();
				$( "#userCliente" ).hide(); 
				$("#newpermissao").on('change',function(){
					
					$("#newlogin").css('border-color', '');	
					$("#newsenha").css('border-color', '');	
					$("#newnome").css('border-color', '');		
					$("#userCliente").css('border-color', '');
								
					if($("#newpermissao option:selected").val() == "2"){				
						$( "#lblCli" ).show();
						$( "#userCliente" ).show();
						$( "#userCliente" ).val("");
						$( "#newnome").val("CLIENTE");
						$("#newnome").attr("readonly","readonly");
					}else{
						$( "#lblCli" ).hide();
						$( "#userCliente" ).hide();
						$( "#userCliente" ).val("");
						$( "#newnome").val("");
						$("#newnome").removeAttr("readonly");		
							
					}
					
					
					if($("#newpermissao option:selected").val() == "3"){	
					
						$(".alertNaoEnviaRelatorio").css('display', 'block');
					
					}else {
						
						$(".alertNaoEnviaRelatorio").css('display', 'none');
						
					}
		});	
			
			
			
		}
			
		function validaCampos(){		
			
				var validado = true;
				
								
				$("#newlogin").css('border-color', '');					
				if($.trim($("#newlogin").val()) == ""){					
					$("#newlogin").css('border-color', 'red');
					validado = false;					
				}	

				<?if(empty($_GET['edit'])){  ?>
				$("#newsenha").css('border-color', '');					
				if($.trim($("#newsenha").val()) == ""){					
					$("#newsenha").css('border-color', 'red');
					validado = false;					
				}
				<?}?> 
				
				
				//este campo valida somente se NÃO FOR do tipo cliente
				$("#newnome").css('border-color', '');		
				if($("#newpermissao option:selected").val() != "2"){								
				if($.trim($("#newnome").val()) == ""){					
					$("#newnome").css('border-color', 'red');
					validado = false;					
				}
				}
				
				//este campo valida somente se FOR do tipo cliente
				$("#userCliente").css('border-color', '');	
				if($("#newpermissao option:selected").val() == "2"){								
				if($.trim($("#userCliente").val()) == ""){					
					$("#userCliente").css('border-color', 'red');
					validado = false;					
				}
				}
				
				return validado;
		
	}
		
		
	</script>
</body>

</html>
