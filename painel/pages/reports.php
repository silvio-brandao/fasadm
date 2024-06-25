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
							<h1 class="page-header">Relatórios</h1>
						</div>
						<!-- /.col-lg-12 -->
						
					</div>
					
					
					<div class="row">
						<div class="col-lg-5">
							<div class="form-group input-group">
								<input type="text" class="form-control" placeholder="Pesquisar..." id="search" >
								<span class="input-group-btn">
									<a ><button  class="btn btn-default" type="button" id="searchBtn" name="searchBtn"> <i class="fa fa-search"></i>
									</button></a><a href="addreports.php" style="    margin-left: 5px;"><button  type="button" class="btn btn-default">Novo</button></a>
								</span>
							</div>
						</div>
						
						<div class="col-lg-5"></div>
						
						<div class="col-lg-2" style="text-align: right;">
						
							
									<button  type="button" id="exibelegenda"  style="margin-bottom: 10px; " class="btn btn-default">Legenda</button>
								
						</div>
						
						
					</div>
					
					
					<div class="row">
						<div class="col-lg-12">
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
													<th style="min-width: 130px;"></th>
													<th>Código</th>
													<th >Cliente</th>
													<th style="min-width: 400px;">Problema</th>
													<th>Máquina</th>
													<th>Data</th>																
													<th>Responsável</th>																		
													<th style="min-width: 150px;">Relatório</th>
												<!-- ajax/ajaxProjeto searchClient-->
												</tr>
											</thead>
											<tbody>
																		 
											</tbody>
										</table>
										<div style="    text-align: center; cursor: pointer;">
							
												<a id="exibir-mais" style="color:  #337ab7; display: block;" exibe="5" >Exibir mais 50 relatórios</a> 
										 </div>
									</div>
										<!-- /.table-responsive -->
										
								</div>									
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
									Relatório Enviado!
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
				<div class="modal fade" id="modallegenda" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									<h4 class="modal-title" id="myModalLabel">Legenda</h4>
								</div>
								<div class="modal-body">
									
									<button type="button"  class="btn btn-primary btn-circle " style=""><i class="fa fa-edit"></i></button> Editar <br><br>
									<button type="button"  class="btn btn-success btn-circle " style="background-color: #AEAEAE !important;  border-color: #BEBEBE !important;"><i class="fa fa-file-o"></i></button> Gerar Relatório ainda não Assinado <br><br>
									<button type="button" class="btn btn-success btn-circle "><i class="fa fa-file-o"></i></button> Gerar Relatório já assinado <br><br>
									<button type="button"  class="btn btn-default btn-circle "  style="  background-color: #fff  !important;  border-color: #BEBEBE !important; "><i class="fa fa-unlock"></i></button> Ao clicar, o relatório será fechado para edição <br><br>
									<button type="button" class="btn btn-default btn-circle "  style="  background-color: #fff  !important;  border-color: #BEBEBE !important; "><i class="fa  fa-lock"></i></button> Ao clicar, o relatório será aberto para edição <br><br>
									<button type="button"  class="btn btn-warning btn-circle "><i class="fa fa-times"></i></button> Excluir Relatório <br><br>
									<button type="button" class="btn btn-warning btn-circle " style=" background-color: #000000  !important;  border-color: #BEBEBE !important; "><i class="fa fa-times"></i></button> Excluir assinatura <br><br>
									
									ULTIMAS ATUALIZAÇÕES: <br><br>Para melhorar o desempenho da página,  apenas 5 registros serão mostrados no primeiro carregamento da página. <br><br> Serão exibidos mais 50 relatórios ao clicar no link "Exibir mais 50 relatórios", ao final da página. <br>
									
								</div>
								<div class="modal-footer">
									<button  type="button" class="btn btn-default" data-dismiss="modal">OK</button>
								</div>
						</div>
						<!-- /.modal-content -->
					</div>
					<!-- /.modal-dialog -->
				</div>	
 

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



				<div class="modal fade abreFechaRelatorio " tabindex="-1" role="dialog" aria-hidden="false" >
                    <div class="modal-dialog modal-sx">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel">Alerta</h4>
                        </div>
                        <div class="modal-body" style="text-align: center;">
							 <h4 class="modal-title" id="myModalLabelAbreFechaRelatorio"></h4>
						</div> 
                        <div class="modal-footer">
							<button type="button" class="btn btn-primary confirmaabreFechaRelatorioBtn" style="margin-top: 5px; display: inline-block;" data-dismiss="modal" codigo="">Sim</button>	
							<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>	
                        </div>
                      </div>
                    </div>
                  </div>

				  
				<!--Modal -->
					<!--Modal -->
					
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
		
		carregaRelatorio(5);	
		trataBotaoSearchExibirMais();
		trataBotaoLegenda();
});



	function trataBotaoLegenda(){
		
		$("#exibelegenda").on('click',function(){
			
			$('#modallegenda').modal('show');	 
				
		});	
		
	}


	function trataBotaoSearchExibirMais() {
		
		$("#search").keyup(function(e){		
			
			
			$("#tableCli tbody").html("<tr><td colspan='7' style='text-align: center'></td></tr> ");
					
			 $("#tableCli tbody").html("<tr><td colspan='7' style='text-align: center'><img src='../images/loading.gif'></td></tr>");
			
			clearTimeout(typingTimer);
			 
			 $("#exibir-mais").attr("exibe", 50);
			 
			 typingTimer = setTimeout(function(){ carregaRelatorio(5); }, doneTypingInterval);
		});

		
			
		$("#exibir-mais").on('click',function(){
			 $("#tableCli tbody").append("<tr><td colspan='7' style='text-align: center'><img src='../images/loading.gif'></td></tr>");
			
			 clearTimeout(typingTimer);
			 
			 typingTimer = setTimeout(function(){ carregaRelatorio(parseInt($("#exibir-mais").attr("exibe"))+50); }, doneTypingInterval);		
			
			 $("#exibir-mais").attr("exibe", parseInt($("#exibir-mais").attr("exibe"))+50);
		});
		
	}
	
	//função com os parametros do ajad
	function carregaRelatorio(limite){
		$.ajax({
			//pagina onde está o ajax
			url: 'ajax/ajaxProjeto.php',
			type: 'get',
			
			//dados do get
			data: {
				funcao: "searchReport",
				search: $("#search").val(),
				limit: limite
				},
				//retorno 
			success: function(response) {
				
				 $("#tableCli tbody").html(response);
				 
				 //trataBotaoVisualizar();
				 
				 trataBotaoEditar();
				 
				 trataBotaoExcluir();
				 
				 trataBotaoExcluirAssinatura();
				 
				 
				 trataBotaoAbrirEfecharRelatorio();
				 //trataBotaoEnviar();
				 
				 
				 trataBotaoGerar();
				}
			}); 
	}
	
	/*function trataBotaoVisualizar(){
	
		$('.visualizarReport').on('click',function (){	
			window.location.assign("addreports.php?view="+$(this).attr("report"));				
		}); 
	}*/
	
	function trataBotaoEditar(){
	
		$('.editReport').on('click',function (){	
			window.location.assign("addreports.php?edit="+$(this).attr("report")+"&random="+Math.floor(Math.random() * 1000));				
		}); 
	}
	
	function trataBotaoExcluir(){
	
		$('.excluirReport').on('click',function (){	
		
			$(".confirmaExclusaobtn").css('display', 'inline-block');
			$('.excluiCompilacaoModal').modal('show');
			$("#myModalLabelExcluir").html("Excluir relatório "+$(this).attr("report")+" referente ao cliente "+$(this).attr("cliente")+"?");
			$(".confirmaExclusaobtn").attr("codigo", $(this).attr('report'));

			
			$('.confirmaExclusaobtn').on('click',function (){

				$("#tableCli tbody").html("<tr><td colspan='7' style='text-align: center'><img src='../images/loading.gif'></td></tr>");			
				//window.location.assign("?excluir="+$(this).attr("report"));
								
				$.ajax({
					//pagina onde está o ajax
					url: 'ajax/ajaxProjeto.php',
					type: 'get',
					
					//dados do get
					data: {
						funcao : "excluirRelatorio",						
						id   : $(this).attr("codigo"),

						},
						//retorno 
					success: function(response) {
						//alert(response); return;
						
						if(response == 1){
							//alert("aqui");
							carregaRelatorio(15); 						
						}
					}
				});
			});		
		}); 
	}
	
	function trataBotaoAbrirEfecharRelatorio(){
		
		$('.abreOufecharRelatorio').on('click',function (){
			 
			
			
			$(".confirmaabreFechaRelatorioBtn").css('display', 'inline-block');
			$('.abreFechaRelatorio').modal('show');
			
			if($(this).attr('acao') == "abrir"){$("#myModalLabelAbreFechaRelatorio").html("Reabrir relatório "+$(this).attr("report")+" ?");}
			if($(this).attr('acao') == "fechar"){$("#myModalLabelAbreFechaRelatorio").html("Fechar relatório "+$(this).attr("report")+" ? <br><br><h5>Obs: não será possível editar este relatório enquanto estiver com status Fechado.</h5>");}
			
			$(".confirmaabreFechaRelatorioBtn").attr("codigo", $(this).attr('report'));
			$(".confirmaabreFechaRelatorioBtn").attr("acao", $(this).attr('acao'));


			$('.confirmaabreFechaRelatorioBtn').on('click',function (){
				
				$("#tableCli tbody").html("<tr><td colspan='7' style='text-align: center'><img src='../images/loading.gif'></td></tr>");			
				//window.location.assign("?excluir="+$(this).attr("report"));
								
				$.ajax({
					//pagina onde está o ajax
					url: 'ajax/ajaxProjeto.php',
					type: 'get',
					
					//dados do get
					data: {
						funcao : "abreOufecharRelatorio",						
						id   : $(this).attr("codigo"),
						acao : $(this).attr("acao"),
						},
						//retorno 
					success: function(response) {
						//alert(response); return;
						
						if(response == 1){
							//alert("aqui");
							carregaRelatorio(15); 						
						}else{
							
							//alert(response); 
							carregaRelatorio(15); 
							return;
						}
					}
				});
				

			});
		
		}); 
		
	}	
	
	function trataBotaoExcluirAssinatura(){
	
		$('.excluirAssinatura').on('click',function (){	
		
			$(".confirmaExclusaobtn").css('display', 'inline-block');
			$('.excluiCompilacaoModal').modal('show');
			$("#myModalLabelExcluir").html("Excluir Assinatura do relatório "+$(this).attr("report")+" referente ao cliente "+$(this).attr("cliente")+"?");
			$(".confirmaExclusaobtn").attr("codigo", $(this).attr('report'));

			
			$('.confirmaExclusaobtn').on('click',function (){

				$("#tableCli tbody").html("<tr><td colspan='7' style='text-align: center'><img src='../images/loading.gif'></td></tr>");			
				//window.location.assign("?excluir="+$(this).attr("report"));
								
				$.ajax({
					//pagina onde está o ajax
					url: 'ajax/ajaxProjeto.php',
					type: 'get',
					
					//dados do get
					data: {
						funcao : "excluirAssinaturaRelatorio",						
						id   : $(this).attr("codigo"),

						},
						//retorno 
					success: function(response) {
						//alert(response); return;
						
						if(response == 1){
							//alert("aqui");
							carregaRelatorio(15); 						
						}else{
							
							//alert(response); 
							carregaRelatorio(15); 
							return;
						}
					}
				});
			});		
		}); 
	}
	
	/*function trataBotaoEnviar(){
	
		$('.sendReport').on('click',function (){	
			 
			var vcliente = $(this).attr("cliente");
			var vdata = $(this).attr("data");
			var vrelatorio = $(this).attr("report");
			var vemail = $(this).attr("email");
			
			if($(this).attr("email") == ""){
				
				alert("Cliente não tem email cadastrado!");
				return;
			}
			
			
			if(confirm("Enviar relatório "+vrelatorio+" referente ao cliente "+vcliente+"?")){			
				$.ajax({
					//pagina onde está o ajax
					url: 'generatereport.php',
					type: 'get',
					
					//dados do get
					data: {
						data : vdata,
						generate : vrelatorio,
						sending : "true"
						},
						//retorno 
					success: function(response) {
								$.ajax({
								//pagina onde está o ajax
									url: 'mail.php',
									type: 'get',
									
									//dados do get
									data: {
										mail : vemail,
										nome : vcliente,
										id   : vrelatorio
										},
										//retorno 
									success: function(response) {
											$('#sendedOK').modal('show');
										}
									}); 
						}
					}); 
			}
			
		}); 
	}
	*/
	
	function trataBotaoGerar(){
	
		$('.generateReport').on('click',function (){	
			
			window.open("generatereport.php?generate="+$(this).attr("report")+"&data="+$(this).attr("data"), '_blank');
			
		}); 
	}
	
	
</script>

</body>

</html>
