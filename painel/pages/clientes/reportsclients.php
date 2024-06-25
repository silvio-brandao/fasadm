 <?php 	
       
session_start();

echo "<pre>";
print_r ($_SESSION);
echo "</pre>";


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
    <link href="../../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

	<link rel="shortcut icon" href="../../favicon.ico" >
	
</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <? include("../navigation.php"); ?>
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
					<div class="row">
						<div class="col-lg-12">
							<h1 class="page-header">Ordens de Serviço do Cliente</h1>
						</div>
						
					</div>
					<div class="row">
						<div class="col-lg-2 ">
						   <div class="form-group">
									<label>Quantidade:</label>
									<select class="form-control" name="quant" id="quant" > 
										<option value="5" selected>5</option>
										<option value="10" >10</option>
										<option value="20">20</option>						
										<option value="30">30</option>	
										<option value="40">40</option>	
										<option value="50">50</option>	
										<option value="100">100</option>	
									</select>
								</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-lg-5">
							<div class="form-group input-group">
								<input type="text" class="form-control" placeholder="Pesquisar..." id="search" >
								<span class="input-group-btn">
									<a ><button  class="btn btn-default" type="button" id="searchBtn" name="searchBtn"> <i class="fa fa-search"></i>
									</button></a>
								</span>
							</div>
						</div>
					</div>					
					
					<div class="row">
						<div class="col-lg-12">
							<div class="panel panel-default">
								<div class="panel-heading">
								   Pagamentos
								</div>
								<!-- /.panel-heading -->
								<div class="panel-body">
									<div class="table-responsive">
										<table class="table table-hover" id="tableCli" >
											<thead>
												<tr>
													<th style="min-width: 50px;"></th>
													<th>Código</th>													
													<th>Solicitante</th>
													<th>Data</th>
													<th>Municipio</th>																		
													<th>Valor R$</th>	
												<!-- ajax/ajaxProjeto searchClient-->
												</tr>
											</thead>
											<tbody>
																		 
											</tbody>
										</table>
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
					
				
            </div>
            <!-- /.container-fluid -->
        </div>

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../../bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../../bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../../dist/js/sb-admin-2.js"></script>

<script> 

$(window).load(function(){
	carregaRelatorio();
});

//ao digitar no campo search
$("#search").keydown(function(e){
		var key = e.keyCode || e.which;
		 if(key == 13) { //Enter keycode
		 //chama o botão (trigger)
		   $("#searchBtn").trigger("click");
		 }
    });

	//click do botão
  $("#searchBtn").click(function(){
		carregaRelatorio();
    });

	//função com os parametros do ajad
	function carregaRelatorio(){
		$.ajax({
			//pagina onde está o ajax
			url: '../ajax/ajaxProjeto.php',
			type: 'get',
			
			//dados do get
			data: {
				funcao: "searchReportByClient",
				search: $("#search").val(),
				limit: $("#quant").val()
				},
				//retorno 
			success: function(response) {
				 $("#tableCli tbody").html(response);
				}
			}); 
	}
	
	
	
	function generateReport(cli, data){
		 window.open("generatereport.php?generate="+cli+"&data="+data, '_blank');
	}
	
	
</script>

</body>

</html>
