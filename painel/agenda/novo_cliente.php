<?php 
session_start(); 
?>
<html lang="en">
 <?php 
	include("includes/head.php"); 	

	if(isset($_GET['edit'])){
		
		$cabecalho = "Editar Cliente";
		$readonly = " readonly ";
	}else{
		
		$cabecalho = "Cadastrar Cliente";
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
	 // echo $_SESSION['logged_in']; die();
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
									<label class="col-sm-1 control-label">Pessoa</label>
									<div class="col-sm-3"> 
										<select class="form-control"  id="tipoPessoa"> 
											<option value="F">Física</option>
											<option value="J">Jurídica</option>														
										</select>
									</div> 
									
									<!--campo cpf-->
									<label class="col-sm-1 control-label classCpf">CPF</label>
									<div class="col-sm-3 classCpf">                                         
										<input type="text" id="cpf" class="form-control  " style="cursor: pointer;" maxlength="14" autocomplete="off">
									</div>
									<!--campo cnpj-->
									
									<!--campo cnpj-->
									<label class="col-sm-1 control-label classCnpj" style="display: none;" >CNPJ</label>
									<div class="col-sm-3 classCnpj" style="display: none;">                                         
										<input type="text" id="cnpj" class="form-control  " style="cursor: pointer;" maxlength="14" autocomplete="off">
									</div>
									<!--campo cnpj-->
									
									<!--campo cpf-->
									<label class="col-sm-1 control-label classCpf">RG</label>
									<div class="col-sm-3 classCpf">                                         
										<input type="text" id="registroGeral" class="form-control  " style="cursor: pointer;"  autocomplete="off">
									</div>
									<!--campo cnpj-->
									
									<!--campo cnpj-->
									<label class="col-sm-1 control-label classCnpj" style="display: none;" >Ins. Est</label>
									<div class="col-sm-3 classCnpj" style="display: none;">                                         
										<input type="text" id="inscricao" class="form-control  " style="cursor: pointer;" maxlength="14" autocomplete="off">
									</div>
									<!--campo cnpj-->
									
								</div>
								
								
								
								<div class="form-group">								  
									
									<label class="col-sm-1 control-label">Nome</label>
									<div class="col-sm-8">                                         
										<input  style="text-transform:uppercase"  type="text"  id="nome" class="form-control " style="   cursor: pointer;" maxlength="250" >
									</div>
									
									
									<label class="col-sm-1 control-label">Nascimento</label>
									<div class="col-sm-2">                                         
										<input  style="text-transform:uppercase"  type="text"  id="nascimento" class="form-control " style="   cursor: pointer;"  >
									</div>
									
									
								</div>
								  
								  

								<div class="form-group">
									<label class="col-sm-1 control-label">Endereço</label>
									<div class="col-sm-2">                                         
										<input  style="text-transform:uppercase"  type="text"  id="endereco" class="form-control " style="   cursor: pointer;" maxlength="1000" >
									</div>
									
									<label class="col-sm-1 control-label">Cidade</label> 
									<div class="col-sm-5">                                         
										<input  style="text-transform:uppercase" type="text" id="cidade" class="form-control  " style="    cursor: pointer;" maxlength="250" >
									</div>
									
									<label class="col-sm-1 control-label">UF</label>
									<div class="col-sm-2"> 

										<select class="form-control " id="uf"  style="   cursor: pointer;">
											<option selected value=""></option>
											<option  value="AC">Acre</option>
											<option value="AL">Alagoas</option>	
											<option value="AP">Amapá	</option>
											<option value="AM">Amazonas	</option>
											<option value="BA">Bahia	</option>
											<option value="CE">Ceará	</option>
											<option value="DF">Distrito Federal	</option>
											<option value="ES">Espírito Santo	</option>
											<option value="GO">Goiás	</option>
											<option value="MA">Maranhão	</option>
											<option value="MT">Mato Grosso	</option>
											<option value="MS">Mato Grosso do Sul	</option>
											<option value="MG">Minas Gerais	</option>
											<option value="PA">Pará	</option>
											<option value="PB">Paraíba	</option>
											<option value="PR">Paraná	</option>
											<option value="PE">Pernambuco	</option>
											<option value="PI">Piauí	</option>
											<option value="RJ">Rio de Janeiro	</option>
											<option value="RN">Rio Grande do Norte	</option>
											<option value="RS">Rio Grande do Sul	</option>
											<option value="RO">Rondônia	</option>
											<option value="RR">Roraima	</option>
											<option value="SC">Santa Catarina	</option>
											<option value="SP">São Paulo	</option>
											<option value="SE">Sergipe	</option>
											<option value="TO">Tocantins	</option>
											
										</select>	
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-1 control-label">Bairro</label> 
									<div class="col-sm-2">                                         
										<input  style="text-transform:uppercase" type="text" id="bairro" class="form-control  " style="    cursor: pointer;" maxlength="250" >
									</div>
										
									<label class="col-sm-1 control-label ">CEP</label>
									<div class="col-sm-2 ">                                         
										<input type="text" id="cep" class="form-control  " style="cursor: pointer;" maxlength="14" autocomplete="off">
									</div>
							
							
									<label class="col-sm-1 control-label">Telefone</label>
									<div class="col-sm-2">                                         
										<input type="text" id="telefone" class="form-control  "  style="    cursor: pointer;"  >
									</div>
									
									<label class="col-sm-1 control-label">E-mail</label> 
									<div class="col-sm-2">                                         
										<input  style="" type="text" id="email" class="form-control  " style="    cursor: pointer;" maxlength="250" >
										</div>
								</div>									
									
								  <div class="form-group">
									   
										
										<label class="col-sm-1 control-label">OBS</label> 
										<div class="col-sm-5">                                         
											<input  style="text-transform:uppercase" type="text" id="observacao" class="form-control  " style="    cursor: pointer;" maxlength="2000" >
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
				include("includes/footer.php"); 	
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
						 <h4 class="modal-title" id="myModalLabel">Cliente Incluido!  </h4>
						</div>
                        <div class="modal-footer">
							
							<a type="button" href="visitantes.php" class="btn btn-default" data-dismiss="modal">Fechar</a>	
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
                          <h4 class="modal-title" id="myModalLabel">Alerta</h4>
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

	<script> 
	
	var typingTimer; //timer identifier
	var doneTypingInterval = 500; //time in ms, 5 second for example	
	
	$(document).ready(function()
	{
		$('#nascimento').mask('00/00/0000');
		$('#cnpj').mask('00.000.000/0000-00');
		$('#cpf').mask('000.000.000-00');
		//$('#registroGeral').mask('0.000.000');
		$('#inscricao').mask('000.000.000.000');
		$('#nascimento').mask('00/00/0000');
		$('#telefone').mask('(00) 0000-00000');
		$('#cep').mask('00000-000');
		trataBotaoOK();
		trataBotaoOKEdicao();
		
		trataComnoTipoPessoa();
	});
	
	
	
	
	function trataComnoTipoPessoa(){
			
		$("#tipoPessoa").on('change',function(){				
					
				if($(this).val() == "J"){					
					$('.classCnpj').css('display', 'block');
					$('.classCpf').css('display', 'none');
					$("#cpf").val('');
					$("#registroGeral").val('');					
				}
				if($(this).val() == "F"){					
					$('.classCpf').css('display', 'block');
					$('.classCnpj').css('display', 'none');
					$("#cnpj").val('');					
					$("#inscricao").val('');					
				}
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
						funcao : "incluiCliente"	,
						tipo : $('#tipoPessoa').val(),
						cpf : $('#cpf').val(),
						cnpj : $('#cnpj').val(),
						rg : $('#registroGeral').val(),
						inscricao : $('#inscricao').val(),
						nome : $('#nome').val(),
						endereco : $('#endereco').val(),
						cidade : $('#cidade').val(),
						uf : $('#uf').val(),
						bairro : $('#bairro').val(),
						cep : $('#cep').val(),
						telefone : $('#telefone').val(),
						email : $('#email').val(),
						obs : $('#observacao').val(),
						nascimento : $('#nascimento').val(),
						},
						//retorno 
					success: function(response) {
						//
						
							
							if(response == "OK"){
								$('.visitanteOKModal').modal('show').on('hidden.bs.modal', function () {
									
									$('#tela').html("<img src='./images/gears.gif'>");
									location.href='./clientes.php';
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
	
	
	
	<?php 

	if(isset($_GET['edit'])){ ?>
		
		//$("#tipoPessoa").attr('disabled', 'disabled');
		//$("#cpf").attr('disabled', 'disabled');
		//$("#cnpj").attr('disabled', 'disabled');
		
		
		$.ajax({
			//pagina onde está o ajax
			url: 'ajax/ajaxProjeto.php',   
			async: true,
			type: 'get',
			dataType: "json",
			//dados do get
			data: {
				funcao : "getClienteByRednoJson",
				recno : '<?php echo isset($_GET['recno']) ?   $_GET['recno'] : ''; ?>'
				
				},
				//retorno 
				success: function(response) {
					//alert(response);
					
					
				if(response['cli_tipo'] == "J"){					
					$('.classCnpj').css('display', 'block');
					$('.classCpf').css('display', 'none');
									
				}
				if(response['cli_tipo'] == "F"){					
					$('.classCpf').css('display', 'block');
					$('.classCnpj').css('display', 'none');
									
				}
					
					
					$("#tipoPessoa").val(response['cli_tipo']);
					$("#cpf").val(response['cli_cpf']);
					$("#cnpj").val(response['cli_cnpj']);
					$("#registroGeral").val(response['cli_rg']);
					$("#inscricao").val(response['cli_inscricao']);
					$("#nome").val(response['cli_nome']);
					$("#endereco").val(response['cli_endereco']);
					$("#cidade").val(response['cli_cidade']);
					$("#uf").val(response['cli_uf']);
					$("#bairro").val(response['cli_bairro']);
					$("#cep").val(response['cli_cep']);
					$("#email").val(response['cli_email']);
					$("#observacao").val(response['cli_obs']);
					$("#telefone").val(response['cli_telefone']);
					$("#nascimento").val(response['cli_nascimento'] != "" ? dtoc(response['cli_nascimento']) : "");
				
				
					$('#cpf').keyup();
					$('#cnpj').keyup();
					$('#cep').keyup();
					$('#telefone').keyup();
				}
			}); 
		
	<?php }?>
	
	
	
	function validaCampos(){
			
				var validado = true;
				
				//$("#pessoa").css('border-color', '');
				//$("#cpf").css('border-color', '');
				//$("#cnpj").css('border-color', '');
				$("#nome").css('border-color', '');
				
				
				/*if($.trim($("#cpf").val()) == "" && $("#tipoPessoa").val() == "F"){
					
					$("#cpf").css('border-color', 'red');
					validado = false;			
					
				}
				if($.trim($("#cnpj").val()) == ""  && $("#tipoPessoa").val() == "J"){
					
					$("#cnpj").css('border-color', 'red');
					validado = false;			
					
				}*/
				if($.trim($("#nome").val()) == "" ){
					
					$("#nome").css('border-color', 'red');
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
						funcao : "editaCliente"	,
						tipo : $('#tipoPessoa').val(),
						cpf : $('#cpf').val(),
						cnpj : $('#cnpj').val(),
						rg : $('#registroGeral').val(),
						inscricao : $('#inscricao').val(),
						nome : $('#nome').val(),
						endereco : $('#endereco').val(),
						cidade : $('#cidade').val(),
						uf : $('#uf').val(),
						bairro : $('#bairro').val(),
						cep : $('#cep').val(),
						telefone : $('#telefone').val(),
						email : $('#email').val(),
						obs : $('#observacao').val(),
						nascimento : $('#nascimento').val(),
						recno : '<?php echo isset($_GET['recno']) ?   $_GET['recno'] : ''; ?>'
						},
						//retorno 
					success: function(response) {
						//
						//alert( response); return;
						
						if(response == "1"){
							
							
							$('.visitanteEditOKModal').modal('show').on('hidden.bs.modal', function () {
								
								$('#tela').html("<img src='./images/gears.gif'>");
								location.href='./clientes.php';
							});
						}else{
							
							alert(response);}
						
						}
					}); 
				});
		}
	
	
	function dtoc(data)
			{
			 
				datafmt = data.substring(6,8) + '/' + data.substring(4,6) + '/' + data.substring(0,4);
			 
				return datafmt;
			}
	</script>
	
	
  </body>
</html>
