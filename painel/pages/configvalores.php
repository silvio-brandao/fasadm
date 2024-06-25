<?php



session_start();

$arrayPermission = array(1);	
if (!in_array($_SESSION['permissao'], $arrayPermission)) {
		echo "<META HTTP-EQUIV='REFRESH' CONTENT='0; URL=index.php?acess=denied'>"; 
		die();
}
/*
if($_SESSION['uid'] != 48){
	
	echo "<META HTTP-EQUIV='REFRESH' CONTENT='0; URL=index.php?acess=denied'>"; 
		die();
}*/
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
							
						
							<h1 class="page-header">Configuração de Valores Padrão</h1>
						</div>
						<!-- /.col-lg-12 -->
					</div>
					
					
					
					
					
					</br>
					<div class="row">
						<div class="col-lg-12">
							<div class="panel panel-default">
								<div class="panel-heading">
								   Valores Vigentes:
								</div>
								<!-- /.panel-heading -->
								<div class="panel-body">
									<div class="table-responsive">
										<table class="table table-hover" id="tableValoresPadrao" >
											<thead>
												<tr>
													
													<th>Valor da Hora Técnica:</th>
													<th >Valor da Hora Auxiliar:</th>
													<th >Valor do km Rodado:</th>
													<th >Valor da hora em Deslocamento:</th>
												</tr>
											</thead>
											<tbody>
																		 
											</tbody>
										</table>
										
									</div>
										<!-- /.table-responsive -->
										
								</div>									
									<!-- /.panel-body -->
							</div>	
							<!-- /.panel -->
						</div>
					
					</div>
					
					
					<hr>
					
					<div class="row" >					
						<div class="col-lg-12 " style="    text-align: center; cursor: pointer;">							
							<label style="font-weight: 200; "  >Para alterar os <b>Valores Padrão</b> preecha os campos abaixo e salve.</label> 
						</div>
					</div>
					<div class="row" >					
						<div class="col-lg-12 " style="    text-align: center; cursor: pointer;">							
							<label style="font-weight: 200; "  >A alteração só afetará novos relatórios!</label> 
						</div>
					</div>
						</br></br>				 
					<div class="row" >
					
					
									
						<div class="col-lg-3 " >
						   <div class="form-group">
								<label>Valor da Hora Técnica:</label>
								<input class="form-control valueinput" placeholder="Valor da Hora Técnica:"  id="valhoratecnica" name=""     autocomplete="off" />
							</div>
						</div> 
						
						<div class="col-lg-3 ">
						   <div class="form-group">
								<label>Valor da Hora Auxiliar:</label>
								<input class="form-control valueinput" placeholder="Valor da Hora Auxiliar:"  id="valhoraauxiliar" name=""     autocomplete="off" />
							</div>
						</div> 
					
						<div class="col-lg-3 ">
						   <div class="form-group">
								<label>Valor do km Rodado:</label>
								<input class="form-control valueinput" placeholder="Valor do km Rodado:"  id="valkmrodado" name=""    autocomplete="off"  />
							</div>
						</div> 
						
						<div class="col-lg-3 ">
						   <div class="form-group">
								<label>Valor da hora em Deslocamento:</label>
								<input class="form-control valueinput" placeholder="Valor da hora em Deslocamento:"  id="valhoradeslocamento" name=""     autocomplete="off" />
							</div>
						</div> 
					
						
					</div>	
					
					<div class="row">	
						<div class="col-lg-12" style="text-align:center;">   
							
							<button type="button" class="btn btn-success btn-circle btn-xl" id="btnOk" title="Confirmar Alteração" style="margin: 37px;"><i class="fa fa-check"></i></button>
																
						</div>
				</div>
					
				
				
            </div>
            <!-- /.container-fluid -->
        </div>


    </div>
	
	
	
		<!--Modal -->
				<div class="modal fade" id="reportOK" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									<h4 class="modal-title" id="myModalLabel">Sucesso</h4>
								</div>
								<div class="modal-body">
									Novos Valores Padrão Configurados!
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
								</div>
						</div>
						<!-- /.modal-content -->
					</div>
					<!-- /.modal-dialog -->
				</div>		
				<!--Modal -->
	
	
	
	
	
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

	<script src="../includes/jquery.mask.js"></script>
	
	
	
	
	<script>
	var typingTimer; //timer identifier
	var doneTypingInterval = 500; //time in ms, 5 second for example

	

	$('.valueinput').mask('00.000.000,00', {reverse: true}); 
	
	
	
	$(document).ready(function(){
			
		carregaValoresPadrao();
		trataBotaoOK();
		
		
	});
	
	function trataBotaoOK(){		
		$('#btnOk').on('click',function (){
			
			
			$('#btnOk').attr('disabled', 'disabled'); 
			if(!validaCampos()){$('#btnOk').removeAttr('disabled'); return;}
			
			
			var data = new Date();
			var dia = String(data.getDate()).padStart(2, '0');
			var mes = String(data.getMonth() + 1).padStart(2, '0');
			var ano = data.getFullYear();
			var dataAtual = ano+mes+dia;
			
			
			$.ajax({

				
				//pagina onde está o ajax
				url: 'ajax/ajaxProjeto.php',
				type: 'post',
				
				
				data: {
					funcao: "incluiValoresConfigurados", 
					data : dataAtual,					
					valhoratecnica : $("#valhoratecnica").val(), 
					valhoraauxiliar : $("#valhoraauxiliar").val(), 
					valkmrodado : $("#valkmrodado").val(), 
					valhoradeslocamento  : $("#valhoradeslocamento").val(), 
					
					},
					//retorno 
				success: function(response) {
					
					//alert("aqui");
					//$("#reportsolucao").val(response);
					//return;
					
					if($.trim(response) == "OK"){
							$('#reportOK').modal('show').on('hidden.bs.modal', function () {
								location.href='./configvalores.php';
							});
						}else{alert(response);}
						  
					}
					
				}); 
			
			
		});	
	}
	
	
	function validaCampos(){		
			
				var validado = true;
				
								
				$("#valhoratecnica").css('border-color', '');
				$("#valhoraauxiliar").css('border-color', '');	
				$("#valkmrodado").css('border-color', '');	
				$("#valhoradeslocamento").css('border-color', '');					
				
				
				if($.trim($("#valhoratecnica").val()) == ""){					
					$("#valhoratecnica").css('border-color', 'red');
					validado = false;					
				}
				if($.trim($("#valhoraauxiliar").val()) == ""){					
					$("#valhoraauxiliar").css('border-color', 'red');
					validado = false;					
				}
				if($.trim($("#valkmrodado").val()) == ""){					
					$("#valkmrodado").css('border-color', 'red');
					validado = false;					
				}
				if($.trim($("#valhoradeslocamento").val()) == ""){					
					$("#valhoradeslocamento").css('border-color', 'red');
					validado = false;					
				}			
				
				if(!validado){return false;}else{return true};		
	}
	
		 
		
	//função com os parametros do ajad
	function carregaValoresPadrao(){
		$.ajax({
			//pagina onde está o ajax
			url: 'ajax/ajaxProjeto.php',
			type: 'get',
			
			//dados do get
			data: {
				funcao: "getValoresPadrao"
				},
				//retorno 
			success: function(response) {
				
				 $("#tableValoresPadrao tbody").html(response);
				 
				 
				}
			}); 
	}
		
		
		
		
	</script>
</body>

</html>
