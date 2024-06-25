<?
session_start();
$arrayPermission = array(1);	
if (!in_array($_SESSION['permissao'], $arrayPermission)) {
		echo "<META HTTP-EQUIV='REFRESH' CONTENT='0; URL=index.php?acess=denied'>"; 
		die();
}
	$uid =	$_SESSION['uid'];
	
	
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
	

        
		
		

			/*print_r($resultado->fetch_array());
			die();*/
			
			


if(!empty($_GET['excluir']))
{	
		$sql = "DELETE FROM tb_usuario WHERE USU_ID='".$_GET['excluir']."';";

		if ($mysqli->query($sql) == true) {		   
			echo "<META HTTP-EQUIV='REFRESH' CONTENT='0; URL=users.php'>";
			die();
		} else {
			echo "Error updating record: " . $mysqli->error;
		}
	
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
						<h1 class="page-header" >Usuários 	
					</div>
					<!-- /.col-lg-12 -->
				</div>
				<div class="row">
					<div class="col-lg-5">
						<div class="form-group input-group">
							<label>Tipo:</label>
							<select class="form-control" name="selectTipoUser" id="selectTipoUser" > 
								<option value="somenteEmpresa" selected>Somente da Empresa</option>
								<option value="somenteCliente">Somente Clientes</option>						
							</select>
						</div>
					</div>
				</div>
				
				<div class="row">				

					<div class="col-lg-5">
						<div class="form-group input-group">
							<input type="text" class="form-control" placeholder="Pesquisar..." id="search" >
							<span class="input-group-btn">
								<a ><button  class="btn btn-default" type="button" id="searchBtn" name="searchBtn"> <i class="fa fa-search"></i></button></a>
								<a href="adduser.php" style="    margin-left: 5px;"><button  type="button" class="btn btn-default">Novo</button></a>
							
							</span>
							
						</div>
					</div>
					
				</div>					
					
				<div class="row">
					<div class="col-lg-8">
						<div class="panel panel-default">
							<div class="panel-heading">
							   Perfis
							</div>
							<!-- /.panel-heading -->
							<div class="panel-body">
								<div class="table-responsive">
									<table class="table table-hover" id="tableCli">
										<thead>
											<tr>
												<th>ID</th>
												<th style="min-width: 200px;">Nome</th>
												<th>Login</th>
												<th>Tipo</th>

												<th style="min-width: 125px;"></th>
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
						</div>
						<!-- /.panel -->
					</div>
				</div>
				
				
            </div>
            <!-- /.container-fluid -->
        </div>
	

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
		
		carregaUsuarios(15);	
		trataBotaoSearchExibirMais();
		trataSelectTipoCliente();
});

	function trataSelectTipoCliente(){
		
		$("#selectTipoUser").on('change', function(){
			$("#tableCli tbody").html("<tr><td colspan='7' style='text-align: center'></td></tr> ");
					
			 $("#tableCli tbody").html("<tr><td colspan='7' style='text-align: center'><img src='../images/loading.gif'></td></tr>");
			
			carregaUsuarios(15);
			
		});
	}

	function trataBotaoSearchExibirMais() {
		
		$("#search").keyup(function(e){		
			
			
			$("#tableCli tbody").html("<tr><td colspan='7' style='text-align: center'></td></tr> ");
					
			 $("#tableCli tbody").html("<tr><td colspan='7' style='text-align: center'><img src='../images/loading.gif'></td></tr>");
			
			clearTimeout(typingTimer);
			 
			 $("#exibir-mais").attr("exibe", 15);
			 
			 typingTimer = setTimeout(function(){ carregaUsuarios(15); }, doneTypingInterval);
		});
		
		
		$("#exibir-mais").on('click',function(){
			 $("#tableCli tbody").append("<tr><td colspan='7' style='text-align: center'><img src='../images/loading.gif'></td></tr>");
			
			 clearTimeout(typingTimer);
			 
			 typingTimer = setTimeout(function(){ carregaUsuarios(parseInt($("#exibir-mais").attr("exibe"))+15); }, doneTypingInterval);		
			
			 $("#exibir-mais").attr("exibe", parseInt($("#exibir-mais").attr("exibe"))+15);
		});
		
	}
	
	//função com os parametros do ajad
	function carregaUsuarios(limite){
		$.ajax({ 
			//pagina onde está o ajax
			url: 'ajax/ajaxProjeto.php',
			type: 'get',
			
			//dados do get
			data: {
				funcao: "searchUsuarios",
				somenteCliente: $("#selectTipoUser").val(),
				search: $("#search").val(),
				limit: limite
				},
				//retorno 
			success: function(response) {
				
				 $("#tableCli tbody").html(response);
				 
				trataBotaoEditar();
				 
				 trataBotaoExcluir();
				 
				}
			}); 
	}
	
	function trataBotaoEditar(){
	
		$('.editUsuario').on('click',function (){	
			window.location.assign("adduser.php?edit="+$(this).attr("usuario"));				
		}); 
	}
	
	
	function trataBotaoExcluir(){
	
		$('.excluirUser').on('click',function (){	
		
			$(".confirmaExclusaobtn").css('display', 'inline-block');
			$('.excluiCompilacaoModal').modal('show');
			$("#myModalLabelExcluir").html("Excluir usuário "+$(this).attr("user")+": "+$(this).attr("nomeUser")+"?");
			$(".confirmaExclusaobtn").attr("codigo", $(this).attr('user'));

			
			$('.confirmaExclusaobtn').on('click',function (){

				$("#tableCli tbody").html("<tr><td colspan='7' style='text-align: center'><img src='../images/loading.gif'></td></tr>");			
				//window.location.assign("?excluir="+$(this).attr("report"));
								
				$.ajax({
					//pagina onde está o ajax
					url: 'ajax/ajaxProjeto.php',
					type: 'get',
					
					//dados do get
					data: {
						funcao : "excluirUsuario",						
						id   : $(this).attr("codigo"),

						},
						//retorno 
					success: function(response) {
						//alert(response); return;
						
						if(response == 1){
							//alert("aqui");
							carregaUsuarios(15); 						
						}
					}
				});
			});		
		}); 
	}
	
	
</script>
	
</body>

</html>
