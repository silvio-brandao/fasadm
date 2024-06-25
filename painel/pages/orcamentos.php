<?php 	
session_start();
$arrayPermission = array(1, 3);	
if (!in_array($_SESSION['permissao'], $arrayPermission)) {
		echo "<META HTTP-EQUIV='REFRESH' CONTENT='0; URL=index.php?acess=denied'>"; 
		die();
}    


?>

<!DOCTYPE html>
<html lang="en">

<? include("head.php"); ?>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <? include("navigation.php"); ?>
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
					<div class="row">
						<div class="col-lg-12">
							<h1 class="page-header">Orçamentos</h1>
						</div>
						<!-- /.col-lg-12 -->
						
					</div>
					<div class="row">
						<div class="col-lg-5">
							<div class="form-group input-group">
								<input type="text" class="form-control" placeholder="Pesquisar..." id="search" >
								<span class="input-group-btn">
									<a ><button  class="btn btn-default" type="button" id="searchBtn" name="searchBtn"> <i class="fa fa-search"></i>
									</button></a><a href="addOrcamento.php" style="    margin-left: 5px;"><button  type="button" class="btn btn-default">Novo</button></a>
								</span>
							</div>
						</div>
					</div>
					
					
					
					<div class="row">
						<div class="col-lg-12">
							<div class="panel panel-default">
								<div class="panel-heading">
								   Orçamentos 
								</div>
								<!-- /.panel-heading -->
								<div class="panel-body">
									<div class="table-responsive">
										<table class="table table-hover" id="tableCli" >
											<thead>
												<tr>
													<th style="min-width: 85px;"></th>
													<th>Código</th>
													<th style="min-width: 200px;">Cliente</th>
													<th>Máquina</th>
													<th style="min-width: 400px;">Defeito</th>
													<th>Data</th>
													<th>Municipio</th>																		
													<th style=""></th>
												<!-- ajax/ajaxProjeto searchClient-->
												</tr>
											</thead>
											<tbody>
																		 
											</tbody>
										</table>
										<div style="    text-align: center; cursor: pointer;">
							
												<a id="exibir-mais" style="color:  #337ab7; display: block;" exibe="5" >Exibir mais resultados</a> 
										 </div>
									</div>
										<!-- /.table-responsive -->
										
								</div>
									
									<!-- /.panel-body -->
									<!-- /.panel-body -->
							</div>
							
							
							<!-- /.panel -->
						</div>
					
					</div>
					
							<!--Modal -->
				<div class="modal fade" id="sendedOK" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									<h4 class="modal-title" id="myModalLabel">Alerta</h4>
								</div>
								<div class="modal-body">
									Orçamento Enviado!
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
					<div class="modal fade excluiCompilacaoModal " tabindex="-1" role="dialog" aria-hidden="false" >
                    <div class="modal-dialog modal-sx">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel">Alerta</h4>
                        </div>
                        <div class="modal-body" style="text-align: center;">
							 <h4 class="modal-title" id="myModalLabelExcluir"></h4>
						</div> 
                        <div class="modal-footer">
							<button type="button" class="btn btn-primary confirmaExclusaobtn" style="margin-top: 5px; display: inline-block;" data-dismiss="modal" codigo="">Sim</button>	
							<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>	
                        </div>
                      </div>
                    </div>
                  </div>	
				<!--Modal -->
				
	
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

<script> 

var typingTimer; //timer identifier
var doneTypingInterval = 500; //time in ms, 5 second for example
	

$(document).ready(function(){
		
		carregaOrcamento(15);	
		trataBotaoSearchExibirMais();
});


function trataBotaoSearchExibirMais() {
		
		$("#search").keyup(function(e){		
			
			
			$("#tableCli tbody").html("<tr><td colspan='7' style='text-align: center'></td></tr> ");
					
			 $("#tableCli tbody").html("<tr><td colspan='7' style='text-align: center'><img src='../images/loading.gif'></td></tr>");
			
			clearTimeout(typingTimer);
			 
			 $("#exibir-mais").attr("exibe", 15);
			 
			 typingTimer = setTimeout(function(){ carregaOrcamento(15); }, doneTypingInterval);
		});

		
			
		$("#exibir-mais").on('click',function(){
			 $("#tableCli tbody").append("<tr><td colspan='7' style='text-align: center'><img src='../images/loading.gif'></td></tr>");
			
			 clearTimeout(typingTimer);
			 
			 typingTimer = setTimeout(function(){ carregaOrcamento(parseInt($("#exibir-mais").attr("exibe"))+15); }, doneTypingInterval);		
			
			 $("#exibir-mais").attr("exibe", parseInt($("#exibir-mais").attr("exibe"))+15);
		});
		
	}
	
	

	//função com os parametros do ajad
	function carregaOrcamento(limite){
		$.ajax({
			//pagina onde está o ajax
			url: 'ajax/ajaxProjeto.php',
			type: 'get',
			
			//dados do get
			data: {
				funcao: "searchOrcamento",
				search: $("#search").val(),
				limit: limite
				},
				//retorno 
			success: function(response) {
				 $("#tableCli tbody").html(response);
				 
				 
				  trataBotaoVisualizar();
				 
				 trataBotaoEditar();
				 
				 trataBotaoExcluir();
				 
				 trataBotaoEnviar();
				 
				 trataBotaoGerar();
				 
				}
			}); 
	}
	
		function trataBotaoVisualizar(){
	
			$('.visualizarOrcamento').on('click',function (){	
				window.location.assign("addOrcamento.php?view="+$(this).attr("orcamento"));				
			}); 
		}
	
		function trataBotaoEditar(){
		
			$('.editOrcamento').on('click',function (){	
				window.location.assign("addOrcamento.php?edit="+$(this).attr("orcamento"));				
			}); 
		}
	
		function trataBotaoExcluir(){
	
			$('.excluirOrcamento').on('click',function (){	
				
				$(".confirmaExclusaobtn").css('display', 'inline-block');
				$('.excluiCompilacaoModal').modal('show');
				$("#myModalLabelExcluir").html("Excluir orçamento "+$(this).attr("orcamento")+" referente ao cliente "+$(this).attr("cliente")+"?");
				$(".confirmaExclusaobtn").attr("codigo", $(this).attr('orcamento'));

				
				$('.confirmaExclusaobtn').on('click',function (){

					$("#tableCli tbody").html("<tr><td colspan='7' style='text-align: center'><img src='../images/loading.gif'></td></tr>");			
					//window.location.assign("?excluir="+$(this).attr("report"));
											
					$.ajax({
						//pagina onde está o ajax
						url: 'ajax/ajaxProjeto.php',
						type: 'get',
						
						//dados do get
						data: {
							funcao : "excluirOrcamento",						
							id   : $(this).attr("codigo")
							},
							//retorno 
						success: function(response) {
							//alert(response);
							
							if(response == 1){
								//alert("aqui");
								carregaOrcamento(15); 						
							}
						}
					});
					
				});	
							
			
			});	
		}		
	
	
	
	
	function trataBotaoGerar(){
	
		$('.generateOrcamento').on('click',function (){	
			
			window.open("generateOrcamento.php?generate="+$(this).attr("orcamento")+"&data="+$(this).attr("data"), '_blank');
			
		}); 
	}
	
	
	function trataBotaoEnviar(){
	
		$('.sendReport').on('click',function (){	
			
			var vcliente = $(this).attr("cliente");
			var vdata = $(this).attr("data");
			var vorcamento = $(this).attr("orcamento");
			var vemail = $(this).attr("email");
			
			if($(this).attr("email") == ""){
				
				alert("Cliente não tem email cadastrado!");
				return;
			}
			
			
			if(confirm("Enviar orçamento "+vorcamento+" referente ao cliente "+vcliente+"?")){			
			
				$.ajax({
					//pagina onde está o ajax
					url: 'generateOrcamento.php',
					type: 'get',
					
					//dados do get
					data: {
						data : vdata,
						generate : vorcamento,
						sending : "true"
						},
						//retorno 
						success: function(response) {
							$.ajax({
							//pagina onde está o ajax
								url: 'mailOrcamento.php',
								type: 'get',
								
								//dados do get
								data: {
									mail : vemail,
									nome : vcliente,
									id   : vorcamento
									},
									//retorno 
								success: function(response) {
									//alert(response);
										$('#sendedOK').modal('show');
									}
								}); 
						}
					}); 
			}
			
		}); 
	}
	
	
	

	
</script>

</body>

</html>
