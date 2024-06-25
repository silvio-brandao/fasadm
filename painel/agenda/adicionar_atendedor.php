<?php 
session_start(); 
?>
<html lang="en">
 <?php 
	include("includes/head.php"); 
	$readonly = "";
	if(isset($_GET['edit'])){
		$readonly = ' readonly ';
		$cabecalho = "Editar Atendedor";
		
	}else{
		
		$cabecalho = "Cadastrar Atendedor";
	}
	?>
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

 
	.btn-success {
		color: #ffffff;background-color: #369747;border-color: #1c6929;		
	}
	.btn-info {
		color: #ffffff;
		background-color: #1c6989;
		border-color: #0f3342;
	}
	.btn-success:hover, .btn-success:focus, .btn-success:active, .btn-success.active, .open .dropdown-toggle.btn-success {
		color: #21782f;
		background: transparent;
		border-color: #326e3c;
	}
  </style>
							
  <body>
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
				<div class="col-lg-12">
					<h3 class="page-header"><i class="fa fa-laptop"></i><?echo $cabecalho; ?></h3>
					
					
				</div>
			</div>
              
						
			<div class="row">
                  <div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                            Adicionar | Novo Atendedor
                          </header>
                          <div class="panel-body">
                              
							  
							 <label class="col-sm-12 control-label" style="text-align:center;font-size: 22px; ">Dados de Login</label> </br></br>
							 
							  <form class="form-horizontal " method="get">
							  
									
								  <div class="form-group">
									<label class="col-sm-2 control-label">Nome</label>
									<div class="col-sm-10">                                         
										<input  type="text"  id="nome" class="form-control " style="text-transform:uppercase; cursor: pointer;" maxlength="250" >
									</div>
									
									
									
								</div> 
								
								<div class="form-group">
									<label class="col-sm-2 control-label">Dentista</label>
									<div class="col-sm-2"> 
									
										<select id="dentista" class="form-control " >
										
										  <option value="N" selected>NÃO</option>
										  <option value="S">SIM</option>										  
										</select>										
									</div>
									<label class="col-sm-1 control-label">Login</label>
									<div class="col-sm-3">                                         
										<input type="text" id="login" class="form-control " style="    cursor: pointer;" maxlength="11" <?php echo $readonly; ?> >
									</div>
									<label class="col-sm-1 control-label">Senha</label>
									<div class="col-sm-3">                                         
										<input type="password" id="senha" class="form-control " style="    cursor: pointer;" maxlength="11" >
									</div>
																
									
								</div> 
								<div class="form-group">
								<label class="col-sm-2 control-label classCpf">CPF</label>
									<div class="col-sm-2 classCpf">                                         
										<input type="text" id="cpf" class="form-control  " style="cursor: pointer;" maxlength="14" autocomplete="off">
									</div>
									
									<label class="col-sm-1 control-label classCpf">RG</label>
									<div class="col-sm-2 classCpf">                                         
										<input type="text" id="registroGeral" class="form-control  " style="cursor: pointer;"  autocomplete="off">
									</div>
									
									<label class="col-sm-2 control-label">Nascimento</label>
									<div class="col-sm-3">                                         
										<input  style="text-transform:uppercase"  type="text"  id="nascimento" class="form-control " style="   cursor: pointer;"  >
									</div>		
								</div> 
								
								<div class="form-group">
								<label class="col-sm-2 control-label classCpf">Identificação</label>
									<div class="col-sm-2 classCpf">                                         
										<input type="text" id="cro" class="form-control  " style="cursor: pointer;" maxlength="8" autocomplete="off">
									</div>
								</div> 	
									
							<div class="form-group"> 	
										<div class="col-sm-12" style="text-align:center;">  
										<?php  if(isset($_GET['edit'])){ ?>						
							
											<button type="button" class="btn btn-success" id="btnEdit" style="">Confirmar Edição</button>
											
										<?php }else{?>
											<button type="button" class="btn btn-success" id="btnOK" style="">Confirmar</button>
										<?php }?>										
										</div>
									</div> 	
								
                              </form>
						  
                          </div>

                      </section>
					  
                  </div>
              </div>
              <!-- project team & activity start -->
			<br><br>
		
		 
		
		
		
							
			<!----------------------------------MODAL------------------------------------------------------->
                  <div class="modal fade visitaEmAbertoModal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-sx">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">x</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel">Sucesso</h4>
                        </div>
                        <div class="modal-body" style="text-align: center;">
						 <h4 class="modal-title" id="labelModalVisitaEmAberto"></h4>
						</div>
                        <div class="modal-footer">
							
							<a type="button" href="visitantes.php" class="btn btn-default" data-dismiss="modal">Fechar</a>	
                        </div>
                      </div>
                    </div>
                  </div>
		   <!-----------------------------MODAL------------------------------------------------------------>
			
			<!----------------------------------MODAL------------------------------------------------------->
                  <div class="modal fade visitanteOKModal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-sx">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">x</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel">Sucesso</h4>
                        </div>
                        <div class="modal-body" style="text-align: center;">
						 <h4 class="modal-title" id="myModalLabel">Atendedor Incluido! </br></br> </h4>
						</div>
                        <div class="modal-footer">
							
							<a type="button" href="index.php" class="btn btn-default" data-dismiss="modal">Fechar</a>	
                        </div>
                      </div>
                    </div>
                  </div>
		   <!-----------------------------MODAL------------------------------------------------------------>
		      <!----------------------------------MODAL------------------------------------------------------->
                  <div class="modal fade visitaEditOKModal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-sx">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">x</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel">Sucesso</h4>
                        </div>
                        <div class="modal-body" style="text-align: center;">
						 <h4 class="modal-title" id="myModalLabel">Atendedor Editado!</h4>
						</div>
                        <div class="modal-footer">
							
							<a type="button"  class="btn btn-default" data-dismiss="modal">Fechar</a>	
                        </div>
                      </div>
                    </div>
                  </div>
		   <!-----------------------------MODAL------------------------------------------------------------>
		   
		   <!----------------------------------MODAL------------------------------------------------------->
                  <div class="modal fade modalAlerta" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-sx">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">x</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel" style="color: red;font-size: 23px;">Alerta!</h4>
                        </div>
                        <div class="modal-body" style="text-align: center;">
						 <h4 class="modal-title" id="labelModalAlerta"></h4>
						</div>
                        <div class="modal-footer">
							
							<a type="button" class="btn btn-default" data-dismiss="modal">Fechar</a>	
                        </div>
                      </div>
                    </div>
                  </div>
		   <!-----------------------------MODAL------------------------------------------------------------>
		   
          </section>
          <div class="text-right">
          <!--div class="credits">
              
                <a href="https://bootstrapmade.com/free-business-bootstrap-themes-website-templates/">Business Bootstrap Themes</a> by <a href="https://bootstrapmade.com/">BootstrapMade</a>
            </div-->
        </div>
      </section>
      <!--main content end-->
  </section>
  <!-- container section start -->

  <?php
		include("includes/javascript.php"); 	
	?>  
			
<?php 
	$abreModalPessoa = true; 
?>
<script type="text/javascript" src="dist/bootstrap-clockpicker.min.js"></script>

			
	<script> 
	$('.clockHoras').clockpicker();

	
	var typingTimer; //timer identifier
	var doneTypingInterval = 500; //time in ms, 5 second for example	
	
	$(document).ready(function(){
		$('#nascimento').mask('00/00/0000');
		$('#cpf').mask('000.000.000-00');
		$('#registroGeral').mask('0.000.000');
		trataBotaoOKEdicao();
		trataBotaoOK();
		
	});
	
	
	<?php if(isset($_GET['edit'])){ ?>
		
		$.ajax({ 
			//pagina onde estÃ¡ o ajax
			url: 'ajax/ajaxProjeto.php',   
			async: true,
			type: 'get',
			dataType: "json",
			//dados do get
			data: {
				funcao : "getAtendedoresByRednoJson",
				recno : '<?php echo $_GET['recno']; ?>'
				
				},
				//retorno 
				success: function(response) {
					//alert(response);
					
					$("#nome").val(response['USU_NOME']);
					$("#login").val(response['USU_USUARIO']);
					$("#dentista").val(response['USU_DENTISTA']);	
					$('#cpf').val(response['USU_CPF']);
					$('#registroGeral').val(response['USU_RG']);
					$("#nascimento").val(response['USU_NASCIMENTO'] != "" ? dtoc(response['USU_NASCIMENTO']) : "");
					$('#cro').val(response['USU_CRO']);
					
					$('#cpf').keyup();
					$('#registroGeral').keyup();
				}
			}); 
		
	<?php } ?>
	
	
	
	
	
	function trataBotaoOK(){		
			$('#btnOK').on('click',function (){
			
				if(!validaCampos(1)){return;}		
			
					
				$("#btnOK").attr('disabled', 'disabled');
				
				$.ajax({
					//pagina onde estÃ¡ o ajax
					url: 'ajax/ajaxProjeto.php',
					async: true,
					type: 'post',
					
					//dados do get
					data: {
						funcao : "incluiAtendedor",
						nome : $("#nome").val(),						
						login : $("#login").val(),
						senha : $("#senha").val(),
						dentista : $("#dentista").val(),
						cpf : $('#cpf').val(),
						rg : $('#registroGeral').val(),
						nascimento : $('#nascimento').val(),
						cro :  $('#cro').val(),
						},
						//retorno 
					success: function(response) {
						//alert(response); return;
							if(response == "OK"){
								$('.visitanteOKModal').modal('show').on('hidden.bs.modal', function () {
									location.href='./atendedores.php';
								});
							}else{
							
								$("#labelModalVisitanteJaCadastrado").html(response);
								$('.visitanteJaCadastradoModal').modal('show');
								
								$("#btnOK").removeAttr('disabled');
								}
							
						}
					}); 
				});
		} 
	
	
	
	function trataBotaoOKEdicao(){		
			$('#btnEdit').on('click',function (){
			
			
			if(!validaCampos(2)){return;}
			
				$.ajax({
					//pagina onde estÃ¡ o ajax
					url: 'ajax/ajaxProjeto.php',
					async: true,
					type: 'post',
					
					//dados do get
					data: {
						funcao : "editaAtendedor"	,
						nome : $("#nome").val(),
						senha : $("#senha").val(),		
						dentista : $("#dentista").val(),
						cpf : $('#cpf').val(),
						rg : $('#registroGeral').val(),
						nascimento : $('#nascimento').val(),
						cro :  $('#cro').val(),						
						recno : ' <?php echo @$_GET['recno']; ?>'
						},
						//retorno 
					success: function(response) {
						
						if(response == "1"){
							$('.visitaEditOKModal').modal('show').on('hidden.bs.modal', function () {
								location.href='./atendedores.php';
							});
						}else{alert(response);}
						
						
							
						}
					}); 
				});
		}
	
	function validaCampos(num){
			
				var validado = true;
				
				//$("#pessoa").css('border-color', '');
				$("#nome").css('border-color', '');
				$("#login").css('border-color', '');
				$("#senha").css('border-color', '');
				
					
				if($("#nome").val() == ""){
								
					$("#nome").css('border-color', 'red');
					validado = false;
				}
				
				if($("#login").val() == ""){
								
					$("#login").css('border-color', 'red');
					validado = false;
				}
				if(num == 1){
					if($("#senha").val() == ""){
									
						$("#senha").css('border-color', 'red');
						validado = false;
					}
				}
				
				if(!validado){return false;}else{return true};
		
	}
	
	
			
		function dtoc(data)
		{		 
			datafmt = data.substring(6,8) + '/' + data.substring(4,6) + '/' + data.substring(0,4);
		 
			return datafmt;
		}
		
	
		$(".calendario").datepicker({
			dateFormat: 'dd/mm/yy',
			dayNames: ['Domingo','Segunda','TerÃ§a','Quarta','Quinta','Sexta','SÃ¡bado','Domingo'],
			dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
			dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','SÃ¡b','Dom'],
			monthNames: ['Janeiro','Fevereiro','MarÃ§o','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
			monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez']
		});
	</script>
	

	
  </body>
</html>
