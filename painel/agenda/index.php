<?php

session_start(); 

 

 ?>
 

<!DOCTYPE html>
<html>
 <?php
    
	include("includes/head.php"); 	
?>

  <body>
  
  
   <style> 

.ui-datepicker .ui-datepicker-header{
	
	background-color: #0267d6;
    border-color: blue;
}

.ui-state-default, .ui-widget-content .ui-state-default, .ui-widget-header .ui-state-default {-webkit-border-radius: 22% !important;}

.ui-datepicker .ui-datepicker-prev span, .ui-datepicker .ui-datepicker-next span{cursor: pointer;}
.ui-datepicker .ui-datepicker-prev span, .ui-datepicker .ui-datepicker-next span {cursor:pointer;}

.form-control {margin-top: 5px;}

.btn-primary {margin-top: 5px;}

.calendario{cursor:pointer !important;}

</style>
  
  <!-- container section start -->
  <section id="container" class="">
     
      <?php 
		include("includes/navigation_up.php"); 
		//include("includes/navigation_left.php"); 
	  ?>
	  
      <!--main content start-->
	<section id="main-content" style=" ">
          <section class="wrapper" style="padding: 0px;">            
              <!--overview start-->
			   
          </section>
		  
			<div class="col-lg-12">
				<section class="panel">
                      
                      <div class="panel-body">
                        <div class="tab-pane">
							<div class="row" style="margin: -16px;padding: -7px;">
								
									<a href="rel_agenda.php" class="logo"><img src="./images/iconsearch.png" style="width: 35px;       margin-left: 26px;" /></a>
								
								
								
									<a href="../pages/index.php" ><button type="button" class="btn btn-info" style="    margin-top: 11px;     margin-left: 55px;">Voltar para o Sistema</button></a>
								
									
									
							</div>
							<div class="row">
								
								
								<div class="col-lg-12" style="        margin-top: 50px;">
									 <iframe src="./calendar/demos/selectable.php" width="100%" style=" margin-top: -30px;  height: 1160px;" frameborder="0" id="iframeagenda" scrolling="no"  ></iframe>
								
								</div>	
								
							</div>
						  </div>
					  </div>
                      
				</section>
			</div>
			
			 <?php
				include("includes/footer.php"); 	
			?>  
			
      </section>
      <!--main content end-->
 
  <!-- container section start -->

		 
			 <!----------------------------------MODAL------------------------------------------------------->
                  <div class="modal fade excluiCompilacaoModal" tabindex="-1" role="dialog" aria-hidden="true">
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
							<button type="button"  class="btn btn-primary confirmaExclusaobtn" style="margin-top: 5px;" codigo="" >Sim</button>	
							<button type="button"  class="btn btn-default" data-dismiss="modal">Cancelar</button>	
                        </div>
                      </div>
                    </div>
                  </div>
				   <!-----------------------------MODAL------------------------------------------------------------>	
				   
				   
				   		 
			 
				   
				   
				   
		    <div class="modal fade printEventsModal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel">Impressão de Agenda</h4>
                        </div>
                        <div class="modal-body" style="text-align: center;">
							 
						</div>
                        <div class="modal-footer">
							<button type="button"  class="btn btn-primary printEvents"  style="margin-top: 5px;" codigo="" >Print</button>	
							<button type="button"  class="btn btn-default " data-dismiss="modal">Cancelar</button>	
                        </div>
                      </div>
                    </div>
                  </div>
		
		 <!--------------------------------------modal------------------------------->
		 
		   <!-----------------------------MODAL------------------------------------------------------------>	
		    <div class="modal fade addDataEvent" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-sx">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel">Adicionar Agendamento</h4>
                        </div>
                        <div class="modal-body" style="text-align: center;">
							 <h4 class="modal-title" id="myModalLabelExcluir"></h4>
							 
							 <div class="row" >
								
								<div class="col-sm-12 " style="text-align: left">Horário início: <span class="horarioinicio" style="margin-left: 10px;" > </span></div>
								
									
							 </div>
							 <div class="row" >
								
								<div class="col-sm-12 " style="text-align: left">Horário fim: <span class="horariofim"  style="margin-left: 23px;" > </span></div>
								
									
							 </div>
							 
							 <div class="row" >
								
								<div class="col-sm-2 " style="text-align: left">Cliente: </div>
								<div class="col-sm-10 " style="text-align: left"><input type="text" class="form-control has-feedback-left" id="cliente" placeholder="Cliente" style="cursor:pointer;" readonly>									</div>	
									
							 </div>
							  <div class="row" >
								
								<div class="col-sm-2 " style="text-align: left">Tarefa: </div>
								<div class="col-sm-10 " style="text-align: left"><input type="text" class="form-control has-feedback-left" id="procedimento" placeholder="Tarefa"  autocomplete="off" >									</div>	
									
							 </div>
							 
							 
						</div>
                        <div class="modal-footer">
							<button type="button"  class="btn btn-primary confirmaEvento"  style="margin-top: 5px;" codigo="" >Sim</button>	
							<button type="button"  class="btn btn-default cancelaInclusaoEvento" data-dismiss="modal">Cancelar</button>	
                        </div>
                      </div>
                    </div>
                  </div>
		
		 <!--------------------------------------modal------------------------------->
		 
		 <!-----------------------------MODAL------------------------------------------------------------>	
		    <div class="modal fade editEvent" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-sx">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel">Editar Agendamento</h4>
                        </div>
                        <div class="modal-body" style="text-align: center;">
							 <h4 class="modal-title" id="myModalLabelExcluir"></h4>
							 
							 <div class="row" >
								
								<div class="col-sm-12 " style="text-align: left">Horário início: <span class="edithorarioinicio" style="margin-left: 10px;"> </span></div>
								
									
							 </div>
							 <div class="row" >
								
								<div class="col-sm-12 " style="text-align: left">Horário fim: <span class="edithorariofim" style="margin-left: 23px;" > </span></div>
									
									
							 </div>
							
							 
							 <div class="row" >
								
								<div class="col-sm-2 " style="text-align: left">Cliente: </div>
								<div class="col-sm-10 " style="text-align: left"><input type="text" class="form-control has-feedback-left" id="editcliente" placeholder="Cliente" style="cursor:pointer;" readonly>									</div>	
									
							 </div>
							  <div class="row" >
								
								<div class="col-sm-2 " style="text-align: left">Tarefa: </div>
								<div class="col-sm-10 " style="text-align: left"><input type="text" class="form-control has-feedback-left" id="editprocedimento" placeholder="Tarefa" style="cursor:pointer;" >									</div>	
									
							 </div>
							 
							  <div class="row" >
								
								<div class="col-sm-2 " style="text-align: left">Telefone: </div>
								<div class="col-sm-10 " style="text-align: left"><span class="edittelefone" > </span></div>	
									
							 </div>
							   <div class="row" >
								
								<div class="col-sm-2 " style="text-align: left">Email: </div>
								<div class="col-sm-10 " style="text-align: left"><span class="editemail" > </span></div>	
									
							 </div>
							 
						</div>
                        <div class="modal-footer">
							<div class="row" >
							<div class="col-sm-3 " style="text-align: left">
								<button type="button"  class="btn btn-danger excluiEvento"  style="margin-top: 5px; " codigo="" >Excluir</button>	
							</div>
							<div class="col-sm-9 " style="text-align: right">
								<button type="button"  class="btn btn-primary editaEvento" data-dismiss="modal" style="margin-top: 5px;" codigo="" >Sim</button>	
								<button type="button"  class="btn btn-default cancelaInclusaoEvento" data-dismiss="modal">Cancelar</button>	
							</div>
							</div>
						</div>
                      </div>
                    </div>
                  </div>
		
		 <!--------------------------------------modal------------------------------->
		 
		 
		 
		 <!----------------------------------MODAL------------------------------------------------------->
                  <div class="modal fade selecionarClientemodal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-sx">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel">Selecionar Cliente</h4>
                        </div>
                        <div class="modal-body" style="text-align: center;">
						 <div class="x_panel">	
							<div class="col-md-12 col-sm-12 col-xs-12">
								 <input type="text" class="form-control has-feedback-left" id="search-clientes" placeholder="Pesquisar...">
								 <span class="fa fa-search form-control-feedback left" id="searchBtn"  aria-hidden="true"></span>
							</div>					
						  <div class="x_content" style="overflow-x: hidden; overflow-y: scroll; max-height: 195px;">
							<table class="table table-hover" id="tabela_clientes">
							  <thead>
								<tr>		
									<th> </th>
									<th style="min-width: 150px;">Nome</th>									
									
									<th style="min-width: 150px;">Cidade - Uf</th>
											
								</tr>
							  </thead>
							  <tbody></tbody>
							</table>							
							<div style="    text-align: center; cursor: pointer;">
									<a id="exibir-mais-clientes" style="color:  #3C5E7B; display: block; height: 136px;" exibe="15" >Exibir mais resultados</a> 
							 </div>
						  </div>
						</div>
						</div>
                        <div class="modal-footer">
							
							<a type="button"  class="btn btn-default" data-dismiss="modal">Fechar</a>	
                        </div>
                      </div>
                    </div>
                  </div>
		   <!-----------------------------MODAL------------------------------------------------------------>
		
		
		
		 <!----------------------------------MODAL------------------------------------------------------->
                  <div class="modal fade selecionarDentistamodal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-sx">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel">Selecionar Dentista</h4>
                        </div>
                        <div class="modal-body" style="text-align: center;">
						 <div class="x_panel">	
							<div class="col-md-12 col-sm-12 col-xs-12">
								 <input type="text" class="form-control has-feedback-left" id="search-dentistas" placeholder="Pesquisar...">
								 <span class="fa fa-search form-control-feedback left" id="searchBtn"  aria-hidden="true"></span>
							</div>					
						  <div class="x_content" style="overflow-x: hidden; overflow-y: scroll; max-height: 195px;">
							<table class="table table-hover" id="tabela_dentistas">
							  <thead>
								<tr>									
									<th style="min-width: 150px;">Nome</th>									
									
									<th> </th>		
								</tr>
							  </thead>
							  <tbody></tbody>
							</table>							
							<div style="    text-align: center; cursor: pointer;">
									<a id="exibir-mais-dentistas" style="color:  #3C5E7B; display: block;" exibe="15" >Exibir mais resultados</a> 
							 </div>
						  </div>
						</div>
						</div>
                        <div class="modal-footer">
							
							<a type="button"  class="btn btn-default" data-dismiss="modal">Fechar</a>	
                        </div>
                      </div>
                    </div>
                  </div>
		   <!-----------------------------MODAL------------------------------------------------------------>
		
		
		
		  <!----------------------------------MODAL------------------------------------------------------->
                  <div class="modal fade selecionarProcedimentomodal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-sx">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel">Selecionar Procedimento</h4>
                        </div>
                        <div class="modal-body" style="text-align: center;">
						 <div class="x_panel">	
							<div class="col-md-12 col-sm-12 col-xs-12">
								 <input type="text" class="form-control has-feedback-left" id="search-procedimentos" placeholder="Pesquisar...">
								 <span class="fa fa-search form-control-feedback left" id="searchBtn"  aria-hidden="true"></span>
							</div>					
						  <div class="x_content" style="overflow-x: hidden; overflow-y: scroll; max-height: 195px;">
							<table class="table table-hover" id="tabela_procedimentos">
							  <thead>
								<tr>									
									<th style="min-width: 150px;">Descrição</th>									
									
									<th> </th>		
								</tr>
							  </thead>
							  <tbody></tbody>
							</table>							
							<div style="    text-align: center; cursor: pointer;">
									<a id="exibir-mais-procedimentos" style="color:  #3C5E7B; display: block;" exibe="15" >Exibir mais resultados</a> 
							 </div>
						  </div>
						</div>
						</div>
                        <div class="modal-footer">
							
							<a type="button"  class="btn btn-default" data-dismiss="modal">Fechar</a>	
                        </div>
                      </div>
                    </div>
                  </div>
		   <!-----------------------------MODAL------------------------------------------------------------>
		
		 
      </section>
     

 

  <?php
		include("includes/javascript.php"); 	
	?>  
<script> 

var typingTimer; //timer identifier
	var doneTypingInterval = 500; //time in ms, 5 second for example	
$(document).ready(function(){  
$("#btnMenu").trigger('click');	
	
	$("#main-content").css('margin-left', '0px');

	
	
	
		$("#cliente").on('click', function(){
			
			
			
			$(".selecionarClientemodal").modal("show").on('shown.bs.modal', function(){
				
					$("#search-clientes").focus();
				
				});
 
		});
	
	
	$("#editcliente").on('click', function(){
			
			
			
			$(".selecionarClientemodal").modal("show").on('shown.bs.modal', function(){
				
					$("#search-clientes").focus();
				
				});
 
		});
	
	
	
	$("#procedimento").on('click', function(){
		
		//$(".selecionarProcedimentomodal").modal('show');
		
	});
	$("#editprocedimento").on('click', function(){
		
		//$(".selecionarProcedimentomodal").modal('show');
		
	});
	
	//carregaClientes(15);
	
	
	
	//carregaProcedimentos(15);
	
	
});

function carregaClientes(limite){
		
		 $("#tabela_clientes tbody").html("<tr><td colspan='4' style='text-align: center'><img src='./img/loading.gif'></td></tr>");

		$.ajax({
			//pagina onde está o ajax
			url: 'ajax/ajaxProjeto.php',
			async: true,
			type: 'get',
			
			//dados do get
			data: {
				funcao : "getClientesModal",
				search : $("#search-clientes").val(),
				limit : limite,
				
				},
				//retorno 
			success: function(response) {
				 $("#tabela_clientes tbody").html(response);
				 
				
				 $(".selectCliente").on('click',function(){
					
					
					$("#cliente").val($(this).attr("nome"));
					
					$("#cliente").attr('codCli', $(this).attr('cliente'));
					$("#editcliente").val($(this).attr("nome"));
					$("#editcliente").attr('codCli', $(this).attr('cliente'));
				 }); 
				 
				
				}
			}); 

////////////////////////////////////Clientes///////////////////////////////////////////////////////
	
	
	$("#exibir-mais-clientes").on('click',function(){
		 $("#tabela_clientes tbody").html("<tr><td colspan='4' style='text-align: center'><img src='./img/loading.gif'></td></tr>");
		
		 clearTimeout(typingTimer);
		 
		 typingTimer = setTimeout(function(){ carregaClientes(parseInt($("#exibir-mais-clientes").attr("exibe"))+15); }, doneTypingInterval);		
		
		 $("#exibir-mais-clientes").attr("exibe", parseInt($("#exibir-mais-clientes").attr("exibe"))+15);
    });		

	}

	
	$("#search-clientes").keyup(function(e){
		
		 $("#tabela_clientes tbody").html("<tr><td colspan='4' style='text-align: center'><img src='./img/loading.gif'></td></tr>");
		 clearTimeout(typingTimer);
		 $("#exibir-mais-clientes").attr("exibe", 15);
		 typingTimer = setTimeout(function(){ carregaClientes(15); }, doneTypingInterval);
   
   });
	
	
	
	
	/*function carregaProcedimentos(limite){
		
		 $("#tabela_procedimentos tbody").html("<tr><td colspan='4' style='text-align: center'><img src='./img/loading.gif'></td></tr>");

		$.ajax({
			//pagina onde está o ajax
			url: 'ajax/ajaxProjeto.php',
			async: true,
			type: 'get',
			
			//dados do get
			data: {
				funcao : "getProcedimentosModal",
				search : $("#search-procedimentos").val(),
				limit : limite,
				
				},
				//retorno 
			success: function(response) {
				 $("#tabela_procedimentos tbody").html(response);
				 
				
				 $(".selectProcedimento").on('click',function(){
					
					$("#procedimento").val($(this).attr("nome"));
					$("#editprocedimento").val($(this).attr("nome"));
					
					
					$("#procedimento").attr('codProcedimento', $(this).attr("id"));
					$("#editprocedimento").attr('codProcedimento', $(this).attr("id"));
				 }); 
				 
				
				}
			}); 

////////////////////////////////////Procedimentos///////////////////////////////////////////////////////
	$("#search-procedimentos").keyup(function(e){
		
		 $("#tabela_procedimentos tbody").html("<tr><td colspan='4' style='text-align: center'><img src='./img/loading.gif'></td></tr>");
		 clearTimeout(typingTimer);
		 $("#exibir-mais-procedimentos").attr("exibe", 15);
		 typingTimer = setTimeout(function(){ carregaProcedimentos(15); }, doneTypingInterval);
   
   });
	
	$("#exibir-mais-procedimentos").on('click',function(){
		 $("#tabela_procedimentos tbody").html("<tr><td colspan='4' style='text-align: center'><img src='./img/loading.gif'></td></tr>");
		
		 clearTimeout(typingTimer);
		 
		 typingTimer = setTimeout(function(){ carregaProcedimentos(parseInt($("#exibir-mais-procedimentos").attr("exibe"))+15); }, doneTypingInterval);		
		
		 $("#exibir-mais-procedimentos").attr("exibe", parseInt($("#exibir-mais-procedimentos").attr("exibe"))+15);
    });			
	}
*/
	
  function resizeIframe(obj) {
    obj.style.height = obj.contentWindow.document.body.scrollHeight + 'px';
  }

		$(".calendario").datepicker({
			dateFormat: 'dd/mm/yy',
			dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'],
			dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
			dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
			monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
			monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez']
		});
	</script>
  </body>
</html>
