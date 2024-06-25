<?php 
session_start(); 
?>
<html lang="en">
 <?php 
	include("includes/head.php"); 	

	if(isset($_GET['edit'])){
		
		$cabecalho = "Editar Procedimento";
		$readonly = " readonly ";
	}else{
		
		$cabecalho = "Cadastrar Procedimento";
	}
	?>
	
  <body>
  <style>
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
					<h3 class="page-header"><i class="fa fa-laptop"></i> <?php ECHO $cabecalho; ?></h3>
					
				</div>
			</div>
              
						
			<div class="row">
                  <div class="col-lg-12"  id="tela">
                      <section class="panel">
                          <header class="panel-heading">
                            <?php ECHO $cabecalho; ?>
                          </header>
                          <div class="panel-body">
                             
							  
							 <label class="col-sm-12 control-label" style="text-align:center;font-size: 22px; ">Dados Cadastrais</label> </br></br>
							 
							  <form class="form-horizontal " method="get">
							  
								<div class="form-group">								  
									
									
									<label class="col-sm-1 control-label">Descrição</label>
									<div class="col-sm-3">                                         
										<input  style="text-transform:uppercase"  type="text"  id="descricao" class="form-control " style="   cursor: pointer;" maxlength="250" >
									</div>
									
									
									<label class="col-sm-1 control-label">Cor</label>
									<div class="col-sm-2">   
										
										<input class="form-control " type="text" maxlength="6" size="6" id="cor" value="">
									</div>
									 
									
									
								</div>
								  
								  
						
									
								 
									
									
									</br>
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
						  
							  <hr>
							  
						
							  
                          </div>

                      </section>
                  </div>
              </div>

              <!-- project team & activity start -->
			<br><br>
		
		
          </section>
          <?php 
				//include("includes/footer.php"); 	
			?>  
      </section>
      <!--main content end-->
  </section>
  <!-- container section start -->

			<!----------------------------------MODAL------------------------------------------------------->
                  <div class="modal fade visitanteOKModal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-sx">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel">Sucesso</h4>
                        </div>
                        <div class="modal-body" style="text-align: center;">
						 <h4 class="modal-title" id="myModalLabel">Procedimento Incluido! </br></br> </h4>
						</div>
                        <div class="modal-footer">
							
							<a type="button"  class="btn btn-default" data-dismiss="modal">Fechar</a>	
                        </div>
                      </div>
                    </div>
                  </div>
		   <!-----------------------------MODAL------------------------------------------------------------>
		   
			<!----------------------------------MODAL------------------------------------------------------->
                  <div class="modal fade visitanteJaCadastradoModal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-sx">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel">Sucesso</h4>
                        </div>
                        <div class="modal-body" style="text-align: center;">
						 <h4 class="modal-title" id="labelModalVisitanteJaCadastrado"></h4>
						</div>
                        <div class="modal-footer">
							
							<a type="button" href="visitantes.php" class="btn btn-default" data-dismiss="modal">Fechar</a>	
                        </div>
                      </div>
                    </div>
                  </div>
		   <!-----------------------------MODAL------------------------------------------------------------>
		   
		   
		   <!----------------------------------MODAL------------------------------------------------------->
                  <div class="modal fade visitanteEditOKModal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-sx">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel">Sucesso</h4>
                        </div>
                        <div class="modal-body" style="text-align: center;">
						 <h4 class="modal-title" id="myModalLabel">Cadastro Editado!</h4>
						</div>
                        <div class="modal-footer">
							
							<a type="button" href="pessoas.php" class="btn btn-default" data-dismiss="modal">Fechar</a>	
                        </div>
                      </div>
                    </div>
                  </div>
		   <!-----------------------------MODAL------------------------------------------------------------>
		   

		  
  
  <?php 
		include("includes/javascript.php"); 	
	?>  
	<link rel="stylesheet" media="screen" type="text/css" href="./colorpicker/css/colorpicker.css" />
	<script type="text/javascript" src="./colorpicker/js/colorpicker.js"></script>
	
	<script> 
	
	var typingTimer; //timer identifier
	var doneTypingInterval = 500; //time in ms, 5 second for example	
	
	$(document).ready(function()
	{
			
		
		
		trataBotaoOK();
		trataBotaoOKEdicao();
		trataColorPicker();
		
		
	});
	
	function trataColorPicker(){
		
		$('#cor').ColorPicker({
			onSubmit: function(hsb, hex, rgb, el) {
				$(el).val(hex);
				$(el).ColorPickerHide();
				$('#cor').css('border-color', '#'+$('#cor').val());
				$('#cor').css('border-style', 'solid');
				$('#cor').css('border-width', '3px');
			},
			onBeforeShow: function () {
				$(this).ColorPickerSetColor(this.value);
			}
			})
			.bind('keyup', function(){
				$(this).ColorPickerSetColor(this.value);
		});
		
	}
	
	
	function trataBotaoOK(){		
			$('#btnOK').on('click',function (){
			
			if(!validaCampos()){return;}		
				
				
				$("#btnOK").attr('disabled', 'disabled');
				
				$.ajax({
					//pagina onde está o ajax
					url: 'ajax/ajaxProjeto.php',
					async: true,
					type: 'post',
					
					//dados do get
					data: {
						funcao : "incluiProcedimento"	,
						descricao : $('#descricao').val(),
						cor : $('#cor').val(),
						
						
						},
						//retorno 
					success: function(response) {
						//
						
							
							if(response == "OK"){
								$('.visitanteOKModal').modal('show').on('hidden.bs.modal', function () {
									
									$('#tela').html("<img src='./images/gears.gif'>");
									location.href='./procedimentos.php';
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
	
	
	
	<?php  if(isset($_GET['edit'])){ ?>
		
		
		
		$.ajax({
			//pagina onde está o ajax
			url: 'ajax/ajaxProjeto.php',   
			async: true,
			type: 'get',
			dataType: "json",
			//dados do get
			data: {
				funcao : "getProcedimentosByRednoJson",
				recno : '<?php  echo @$_GET['recno'];?>'
				
				},
				//retorno 
				success: function(response) {
					//alert(response);
					
					$("#descricao").val(response['procedimentos_descricao']);
					$("#cor").val(response['procedimentos_cor']);
					$("#descricao").focus();
					
						
					$('#cor').css('border-color', '#'+$('#cor').val());
					$('#cor').css('border-style', 'solid');
					$('#cor').css('border-width', '3px');
				}
			}); 
		
	<?php }?>
	
	
	
	function validaCampos(){
			
				var validado = true;
				
				
				$("#descricao").css('border-color', '');
				
				
				if($.trim($("#descricao").val()) == "" ){
					
					$("#descricao").css('border-color', 'red');
					validado = false;			
					
				}
				if(!validado){return false;}else{return true};
	}
			
	
		
		function trataBotaoOKEdicao(){		
			$('#btnEdit').on('click',function (){
			
				
				if(!validaCampos()){return;}		
			
				$.ajax({
					//pagina onde está o ajax
					url: 'ajax/ajaxProjeto.php',
					async: true,
					type: 'POST', 
					
					//dados do get
					data: {
						funcao : "editaProduto"	,
						descricao : $('#descricao').val(),
						cor : $('#cor').val(),
						recno : '<?php echo @$_GET['recno'];?>',
						},
						//retorno 
					success: function(response) {
						//
						//alert( response); return;
						
						if(response == "1"){
							
							
							$('.visitanteEditOKModal').modal('show').on('hidden.bs.modal', function () {
								
								$('#tela').html("<img src='./images/gears.gif'>");
								location.href='./procedimentos.php';
							});
						}else{
							
							alert(response);}
						
						}
					}); 
				});
		}
	</script>
	
	
  </body>
</html>
