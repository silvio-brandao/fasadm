<?php 	
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
 
       // $db->onlyAdmin();


if($_GET['excluir'])
{	
	$sql = "DELETE FROM tb_defects WHERE DEF_CODIGO='".$_GET['excluir']."';";

	if ($mysqli->query($sql) == true) {		   
		echo "<META HTTP-EQUIV='REFRESH' CONTENT='0; URL=defects.php'>";
		die();
	} else {
		echo "Error updating record: " . $mysqli->error;
	}
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="Windows-1252">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>FAS Manutenção | Portal</title>

    <!-- Bootstrap Core CSS -->
    <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

	<link rel="shortcut icon" href="../favicon.ico" >
	
</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <? include("navigation.php"); ?>
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
					<div class="row">
						<div class="col-lg-12">
							<h1 class="page-header">Defeitos/Problemas</h1>
						</div>
						<!-- /.col-lg-12 -->
					</div>
					
					<div class="row">
						<div class="col-lg-5">
							<div class="form-group input-group">
								<input type="text" class="form-control" placeholder="Pesquisar..." id="search" >
								<span class="input-group-btn">
									<a ><button  class="btn btn-default" type="button" id="searchBtn" name="searchBtn"> <i class="fa fa-search"></i>
									</button></a><a href="adddefects.php" style="    margin-left: 5px;"><button  type="button" class="btn btn-default">Novo</button></a>
							</span>
							</div>
						</div>
					</div>
					
					
					<div class="row">
					<div class="col-lg-10">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           Defeitos/Problemas
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-hover" id="tableDef" >
                                    <thead>
                                        <tr>
											<th style="min-width: 120px;"></th>
                                            <th>Código</th>
                                            <th style="min-width: 300px;">Nome</th>											
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
                    </div>
					
					
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-6 -->
                
                <!-- /.col-lg-6 -->
            </div>
				
	
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


$("#search").keyup(function(e){		
		
		
		$("#tableDef tbody").html("<tr><td colspan='10' style='text-align: center'></td></tr> ");
				
		 $("#tableDef tbody").html("<tr><td colspan='10' style='text-align: center'><img src='../images/loading.gif'></td></tr>");
		
		clearTimeout(typingTimer);
		 
		 $("#exibir-mais").attr("exibe", 5);
		 
		 typingTimer = setTimeout(function(){ carregaDefeitos(5); }, doneTypingInterval);
    });

	
		
	$("#exibir-mais").on('click',function(){
		 $("#tableDef tbody").append("<tr><td colspan='10' style='text-align: center'><img src='../images/loading.gif'></td></tr>");
		
		 clearTimeout(typingTimer);
		 
		 typingTimer = setTimeout(function(){ carregaDefeitos(parseInt($("#exibir-mais").attr("exibe"))+5); }, doneTypingInterval);		
		
		 $("#exibir-mais").attr("exibe", parseInt($("#exibir-mais").attr("exibe"))+5);
    });


$(window).load(function(){
	carregaDefeitos(5);
});



	//função com os parametros do ajad
	function carregaDefeitos(limite){
		$.ajax({
			//pagina onde está o ajax
			url: 'ajax/ajaxProjeto.php',
			type: 'get',
			
			//dados do get
			data: {
				funcao: "searchDefects",
				search: $("#search").val(),
				limit: limite
				},
				//retorno 
			success: function(response) {
				 $("#tableDef tbody").html(response);
				}
			}); 
	}
	
	function visualizarDefeito(def){
		window.location.assign("adddefects.php?view="+def);
	}
	
	function editDefeito(def){
		window.location.assign("adddefects.php?edit="+def);
	}
	
	
	function excluirDefeito(def, name){

		if(confirm("Excluir o defeito "+name+"?")){			
			window.location.assign("?excluir="+def);
		}
	}
</script>	

</body>

</html>
