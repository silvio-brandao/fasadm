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
	<section id="main-content">
          <section class="wrapper">            
              <!--overview start-->
			   
          </section>
         
			<div class="col-lg-12">
				<section class="panel">
                      <header class="panel-heading" style="text-align:center;">
                          <h3>Relatório de Vendas  
                      </h3></header>
                      <div class="panel-body">
                        <div class="tab-pane">
						
						<div class="row" style="margin-left: -54px; margin-bottom: 5px;">
								
								
								
									<a href="../pages/index.php"><button type="button" class="btn btn-info" style="    margin-top: 11px;     margin-left: 55px;">Voltar para o Sistema</button></a>
								
									
									
							</div>
						
						
							<div class="row">
								<div class="col-sm-2 ">
									<input type="text" class="form-control has-feedback-left" id="search" placeholder="Pesquisar...">									
								</div>
								<!--div class="col-sm-1 " style="">
									<button class="btn btn-primary" style="margin-right: 5px;" id="btn_tudo" title="Tudo (Não considera data, somente o filtro pesquisar.)" >Tudo</button>									
								</div-->
								<div class="col-sm-2 ">
									<input class=" calendario  form-control has-feedback-left"  style=""  value="01/01/<?php echo DATE('Y'); ?>" title="Data Inicial" placeholder="Data Inicial" id="dtini" readonly="" >
								</div> 
								<div class="col-sm-2 ">
									<input class=" calendario  form-control has-feedback-left"  style="" value="31/12/<?php echo DATE('Y'); ?>"  title="Data Final" placeholder="Data Final" id="dtfin" readonly="" >
								</div>								  
							
								<div class="col-sm-3"> 
									
								</div>
						
								<div class="col-sm-3 ">
									<i  title="Limpar" class="btn btn-primary" id="btnlimpar">Limpar Datas</i>
									<button  title="Exportar"  class="btn btn-primary" id="export">Exportar</button>
									
								</div>
								
							</div>
							
							<br><br> 
							<div class="row" style="overflow-x: scroll; overflow-y: hidden;">
							   <table class="table table-hover" id="table_vendas">
									  <thead>
									  <tr>  
										  										 
										  <th style="min-width: 140px;">Início</th> 	
										  <th style="min-width: 140px;">Fim</th> 										  
										  <th style="min-width: 300px;">Cliente </th>
										  <th style="min-width: 130px;">Procedimento </th>
										  <th style="min-width: 130px;">Telefone</th>
										  <th style="min-width: 130px;">Email</th>
										  <th style="min-width: 130px;">Endereço</th>
										  
										  
									  </tr> 
									  </thead>
									  <tbody></tbody>
								  </table>
								  
								 
								  
								 
								</div>
						  </div>
					  </div>
                      
				</section>
			</div>
			
			
			
			<!----------------------------------MODAL------------------------------------------------------->
                  <div class="modal fade exibeEnderecoModal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-sx">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" >Endereço</h4>
                        </div>
                        <div class="modal-body" style="text-align: center;">
							 <h4 class="modal-title" id="enderecoModal"></h4>
						</div>
                        <div class="modal-footer">
							
							<button type="button"  class="btn btn-default" data-dismiss="modal">Fechar</button>	
                        </div>
                      </div>
                    </div>
                  </div>
				   <!-----------------------------MODAL------------------------------------------------------------>	
			
			
			
          <?php
				include("includes/footer.php"); 	
			?>  
      </section>
      <!--main content end-->
 
  <!-- container section start -->
 
      </section>

  <?php
		include("includes/javascript.php"); 	
	?>  
<script> 

$(document).ready(function(){  
	$("#table_vendas tbody").html("<tr><td colspan='6' style='text-align: center'><img src='./img/loading.gif'></td></tr>");
		carregaRelatorioVendas();
		trataCalendarios();
		trataBotaoExport();
		
	});
	
	
	
	var typingTimer; //timer identifier
	var doneTypingInterval = 500; //time in ms, 5 second for example	 
	
	$("#search").keyup(function(e){
				
		 $("#table_vendas tbody").html("<tr><td colspan='6' style='text-align: center'><img src='./img/loading.gif'></td></tr>");
		 $("#table_vendas_produto tbody").html("<tr><td colspan='6' style='text-align: center'><img src='./img/loading.gif'></td></tr>");
		 clearTimeout(typingTimer);
		
		 typingTimer = setTimeout(function(){ carregaRelatorioVendas(); }, doneTypingInterval);
    });
	
	

	function trataCalendarios(){
		$("#dtfin").on('change',function(){
			if($("#dtini").val() != "" && $("#dtfin").val() != ""){
				
						
			 $("#table_vendas tbody").html("<tr><td colspan='6' style='text-align: center'><img src='./img/loading.gif'></td></tr>");
			 $("#table_vendas_produto tbody").html("<tr><td colspan='6' style='text-align: center'><img src='./img/loading.gif'></td></tr>");
			 clearTimeout(typingTimer);
			
			 typingTimer = setTimeout(function(){ carregaRelatorioVendas(); }, doneTypingInterval);
			}
			
			
		});	
		
		$("#dtini").on('change',function(){
			if($("#dtini").val() != "" && $("#dtfin").val() != ""){
				
						
			 $("#table_vendas tbody").html("<tr><td colspan='6' style='text-align: center'><img src='./img/loading.gif'></td></tr>");
			 $("#table_vendas_produto tbody").html("<tr><td colspan='6' style='text-align: center'><img src='./img/loading.gif'></td></tr>");
			 clearTimeout(typingTimer);
			
			 typingTimer = setTimeout(function(){ carregaRelatorioVendas(); }, doneTypingInterval);
			}
		});	
		
		$("#btnlimpar").on('click',function(){
			if($("#dtini").val() != "" || $("#dtfin").val() != ""){
				$("#dtini").val('') ; $("#dtfin").val('') ;
			//carregaVendas(0);
			}
		});	
	}
	function carregaRelatorioVendas(){

	
		$.ajax({
			//pagina onde está o ajax
			url: 'ajax/ajaxProjeto.php',
			async: true,
			type: 'get',
			
			//dados do get
			data: {
				funcao : "relatorioVendas", 
				search : $("#search").val(),
				
				dataInicial : $("#dtini").val(),
				dataFinal :$("#dtfin").val(),
				},
				//retorno 
			success: function(response) {
				 $("#table_vendas tbody").html(response);
				 trataBotaoExibeEndereco();
					
				}
			}); 

			
	}
	
	function trataBotaoExport(){

		$("#export").on('click', function(){
			
			$.ajax({
			//pagina onde está o ajax
			url: 'ajax/pdf.php',
			async: true,
			type: 'get',
			
			//dados do get
			data: {
				funcao : "exportRelatorioVendas", 
				search : $("#search").val(),
				
				dataInicial : $("#dtini").val(),
				dataFinal :$("#dtfin").val(),
				},
				//retorno 
			success: function(response) {
					
					window.location.assign('ajax/download.php');
					
				}
			}); 

			
		});
		
	}
	
	function trataBotaoExibeEndereco(){
		
		  $(".exibeEndereco").on('click', function(){
										  $('#enderecoModal').html('<a href="https://www.google.com.br/maps/place/'+$(this).attr("endereco")+'" target="_blank"> '+$(this).attr("endereco")+ ' </a>');
										  $('.exibeEnderecoModal').modal('show').on("hidden.bs.modal", function () {									
											
											 
											
											
											});
										});
		
		
		
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
