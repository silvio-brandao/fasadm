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
		include("includes/navigation_left.php"); 
	  ?>
    
      
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">            
              <!--overview start-->
			  <div class="row">
				
          </section>
         
			<div class="col-lg-12" id="tela">
				<section class="panel">
                      <header class="panel-heading" style="text-align:center;">
                          <h3>Clientes
                      </h3></header>
                      <div class="panel-body">
                        <div class="tab-pane" >
							<div class="row">
								<div class="col-sm-3 ">
									<input type="text" class="form-control has-feedback-left" id="search" placeholder="Pesquisar...">									
								</div>
								<!--div class="col-sm-1 " style="">
									<button class="btn btn-primary" style="margin-right: 5px;" id="btn_tudo" title="Tudo (Não considera data, somente o filtro pesquisar.)" >Tudo</button>									
								</div-->
								 
								
								<div class="col-sm-2 ">
									<a href="novo_cliente.php" onclick="mostraEngrenagem();" title="Novo Cadastro" class="btn btn-primary">Novo Cadastro</a>									
								</div>
								
							</div>
							</br></br>
							<div class="row" style="overflow-x: scroll; overflow-y: hidden;">
							   <table class="table table-hover" id="table_clientes">
									  <thead>
									  <tr>  
										  <th style="min-width: 70px;"></th>
										  <th style="min-width: 250px;">Nome</th>
										  <th style="min-width: 160px;">Documento</th>										  
										  <th style="min-width: 160px;">Cidade - UF</th>	
											<th style="min-width: 160px;"> E-mail</th>											  
									  </tr>
									  </thead>
									  <tbody> 
									  
									  </tbody>
								  </table>
								  <div style="text-align: center; cursor: pointer;">
											<a id="exibir-mais" style="color:  #3C5E7B; display: block;" exibe="15" >Exibir mais resultados</a> 
									 </div>
								</div>
						  </div>
					  </div>
                      
				</section>
			</div>
		 	
		 
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
 <?php
				include("includes/footer.php"); 	
			?>  
		 
      </section>
      <!--main content end-->
  </section>
  <!-- container section start -->

  <?php
		include("includes/javascript.php"); 	
	?>  
<script> 
	
	$(document).ready(function(){   
		$("#table_clientes tbody").html("<tr><td colspan='5' style='text-align: center'><img src='./img/loading.gif'></td></tr>");
		carregaclientes(15);
	});
	
	
	var typingTimer; //timer identifier
	var doneTypingInterval = 500; //time in ms, 5 second for example	 
	
	$("#search").keyup(function(e){
				
		 $("#table_clientes tbody").html("<tr><td colspan='5' style='text-align: center'><img src='./img/loading.gif'></td></tr>");
		 clearTimeout(typingTimer);
		 $("#exibir-mais").attr("exibe", 15);
		 typingTimer = setTimeout(function(){ carregaclientes(15); }, doneTypingInterval);
    });
	
	$("#exibir-mais").on('click',function(){
		 $("#table_clientes tbody").append("<tr><td colspan='5' style='text-align: center'><img src='./img/loading.gif'></td></tr>");
		
		 clearTimeout(typingTimer);
		 
		 typingTimer = setTimeout(function(){ carregaclientes(parseInt($("#exibir-mais").attr("exibe"))+15); }, doneTypingInterval);		
		
		 $("#exibir-mais").attr("exibe", parseInt($("#exibir-mais").attr("exibe"))+15);
    });
	
	function carregaclientes(limite){

	
		$.ajax({
			//pagina onde está o ajax
			url: 'ajax/ajaxProjeto.php',
			async: true,
			type: 'get',
			
			//dados do get
			data: {
				funcao : "getclientes", 
				search : $("#search").val(),
				limit : limite,
				
				},
				//retorno 
			success: function(response) {
				 $("#table_clientes tbody").html(response);
				 
					
					trataBotaoExcluir();
				}
			}); 		
	}
	
	
	function mostraEngrenagem(){
		
		$('#tela').html("<img src='./images/gears.gif'>");
		
	}
	function trataBotaoExcluir(){
		$(".excluirCliente").on('click',function(){
		var recno = $(this).attr('recno');
		var nome = $(this).attr('nome');
		
		
				$.ajax({
				//pagina onde está o ajax
				url: 'ajax/ajaxProjeto.php',
				async: true,
				type: 'get',
				
				//dados do get
				data: {
					funcao : "verificaSeTemVendaById",
					clienteId : $(this).attr("recno"),
					
					},
					//retorno 
				success: function(response) {
						
					if(response == "false"){
						$(".confirmaExclusaobtn").css('display', 'inline-block');
						$('.excluiCompilacaoModal').modal('show');
						$("#myModalLabelExcluir").html("Excluir o cadastro de do cliente "+nome+" ?");
						$(".confirmaExclusaobtn").attr("codigo", recno);
						
						
						$('.confirmaExclusaobtn').on('click',function (){
							$('.excluiCompilacaoModal').modal('hide');
							mostraEngrenagem();
							$.ajax({
							//pagina onde está o ajax
							url: 'ajax/ajaxProjeto.php',
							async: true,
							type: 'post',
							
							//dados do get
							data: {
								funcao : "excluicliente",
								codigo : $(this).attr("codigo"),
								
								},
								//retorno 
							success: function(response) {
								
								
								if(response == "1"){
								
									location.href='./clientes.php';
								
								}else{alert(response+"!");}
								
								}					
							}); 
						}); 
						
					}else{
						$('.excluiCompilacaoModal').modal('show');
						$("#myModalLabelExcluir").html("Impossível excluir pois já foi cadastrado uma ou mais atendimentos para este cliente.");
						$(".confirmaExclusaobtn").css('display', 'none');
					}
					}				
				}); 
			return;
			
			
		});
		
	}
	
	$("#search").focus();
	
	
	

	</script>
  </body>
</html>
