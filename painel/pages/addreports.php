<?php
session_start();


$arrayPermission = array(1, 3);	
if (!in_array($_SESSION['permissao'], $arrayPermission)) {
		echo "<META HTTP-EQUIV='REFRESH' CONTENT='0; URL=index.php?acess=denied'>"; 
		die();
}

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
	
?> 

<!DOCTYPE html>
<html lang="en">

 <meta charset="Windows-1252">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>FAS Manutenção | Portal</title>

    <!-- Bootstrap Core CSS -->
    <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="../includes/jquery.timepicker.css" rel="stylesheet" type="text/css">	
	
    <!-- MetisMenu CSS -->
    <link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">
	
    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link href="../includes/jquery-ui.css" rel="stylesheet"/>
	<script src="../includes/getBrowser.js"></script>
<body>

    <div id="wrapper">
	
        <!-- Navigation -->
        <? include("navigation.php"); ?>
	
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
					<div class="row">
						<div class="col-lg-12">
						<? 
						
						if(!empty($_GET['view']))
						{
							$pageHeader = "Visualizar Relatório";
							
						}else{
							$pageHeader = "Adicionar Relatório";
						}
						if(!empty($_GET['edit']))
						{
							$pageHeader = "Alterar Relatório";
							
						}
						
						
						?>
							<h2 id='msgcarregando'> Carregando... Aguarde! </h2><h1 class="page-header"> <?echo $pageHeader; ?></h1>
							<h4 class="page-header" id="alertaNavegador"></h4>
						</div>
						<!-- /.col-lg-12 -->
					</div>
						<? 
							//$disabled = !empty($_GET['edit']) ? "disabled" : "";
						?>	
						<? 
							//$readonly = !empty($_GET['edit']) ? "readonly" : "";
						?>			

							
					<div class="row" >
									
						<div class="col-lg-3 " >
						   <div class="form-group">
								<label>Cliente:</label>
								<input class="form-control" placeholder="Empresa"  id="reportempresa" name="reportempresa"    readonly  />
							
							</div>
						</div> 
						<div id="clientinforow1"> 
							<div class="col-lg-2 ">
							   <div class="form-group">
									<label>Cod:</label>
									<input class="form-control" placeholder="Código Cliente"  id="codCli" name="codCli"    readonly  />
								</div>
							</div> 
						
							<div class="col-lg-3 ">
							   <div class="form-group">
									<label>Solicitante:</label>
									<input class="form-control" placeholder="Solicitante" maxlength="100" id="reportsolicitante" name="reportsolicitante"  />
								</div>
							</div>
							<div class="col-lg-2 ">
							   <div class="form-group">
									<label>Data:</label>								
									<input  type="text" value="<?echo dtoc(Date('Ymd')); ?>" class="form-control" placeholder="Data"  id="reportdata" name="reportdata"    readonly />
								</div>
							</div>
							<div class="col-lg-2 ">
							   <div class="form-group">
									<label>Código:</label>
									<input class="form-control" placeholder="Cód"  id="reportcod" name="reportcod"   readonly/>
								</div>
							</div>
						</div>
					</div>	
					<div class="row rowInfoCli" id="clientinforow2">								
						<div class="col-lg-2 ">
						   <div class="form-group">
								<label>CNPJ/RG:</label>
								<input class="form-control" placeholder="CNPJ/RG"  id="reportcnpjcpf" name="reportcnpjcpf" maxlength="14" readonly/>
							</div>
						</div>
						
						<div class="col-lg-3 ">
						   <div class="form-group">
								<label>Município:</label>
								<input class="form-control" placeholder="Município" id="reportmun" name="reportmun" maxlength="100"  readonly/>
							</div>
						</div>
						
						<div class="col-lg-3 ">
						   <div class="form-group">
								<label>Endereço:</label>
								<input class="form-control" placeholder="Endereço" id="reportend" name="reportend" maxlength="60"   readonly/>
							</div>
						</div>
						<div class="col-lg-1 ">
						   <div class="form-group">
								<label>Número:</label>
								<input class="form-control" placeholder="Núm"  id="reportnumero" name="reportnumero"  readonly/>
							</div>
						</div>
						<div class="col-lg-1 ">
						   <div class="form-group">
								<label>Estado:</label>
								<input class="form-control" placeholder="UF" id="reportestado" name="reportestado" maxlength="2"  readonly/>
							</div>
						</div>
						
						<div class="col-lg-2 ">
							<div class="form-group">
								<label>Cep:</label>
								<input class="form-control" placeholder="Cep" id="reportcep" name="reportcep" maxlength="9"  readonly/>
							</div>
						</div>	
						
					</div>					
					
					<div class="row">
									
						<div class="col-lg-3 ">
						   <div class="form-group">
								<label>Máquina:</label>
								<input class="form-control" placeholder="Máquina"  id="reportmaquina" name="reportmaquina" maxlength="100" />
							</div>
						</div>
						<div class="col-lg-3 ">
						   <div class="form-group">
								<label>Nº Máquina:</label>
								<input class="form-control" placeholder="Número da máquina"  id="reportnummaquina" maxlength="30" name="reportnummaquina"  />
							</div>
						</div>
						
						<div class="col-lg-2 ">
						   <div class="form-group">
								<label>Modelo:</label>
								<input class="form-control" placeholder="Modelo" maxlength="100" id="reportmodelomaquina" name="reportmodelomaquina"  />
							</div>
						</div>
						<div id="camposParaOcultar"> 
							<div class="col-lg-2 ">
							   <div class="form-group">
								<label>Garantia:</label>
								<select class="form-control" name="reportgarantia" id="reportgarantia"   /> 
									<option value="N" selected>Não</option>
									<option value="S">Sim</option>						
								</select>							
									
								</div>
							</div>
							<div class="col-lg-2 ">
							   <div class="form-group">
									<label>Pedido Cliente:</label>
									<input class="form-control" placeholder="Pedido Cliente"  maxlength="30" id="reportpedidocliente" name="reportpedidocliente"    />
								</div>
							</div>
						</div>
					</div>	
					
					
					<div class="row">									
						<div class="row">									
							<div class="col-lg-12 ">
							   <div class="form-group">
								<label>Descrição do Defeito:</label>
									<textarea class="form-control" rows="6" placeholder="Descrição do Serviço" maxlength="5000" id="reportselecteddefects" name="reportselecteddefects"  /></textarea>
								</div>
							</div>
						</div>
						
				
						
					</div>
				
					<div class="row">	
						
													
						<div class="col-lg-2 " id="reportvalor_div">
						   <div class="form-group">
							<label>Total R$:</label>
							
							<input  type="text"class="form-control"   placeholder="Total do Serviço"   id="reportvalor" name="reportvalor" readonly />
							 
							</div>
						</div> 
						
						<div class="col-lg-3 " id="reporthoratecnicatotal_div">
						   <div class="form-group">
							<label>Hora Técnica Total R$:</label>
							
							<input  type="text"class="form-control"   placeholder="Hora Técnica Total R$:"   id="reporthoratecnicatotal" name="reporthoratecnicatotal" readonly />
							 
							</div>
						</div>
						
						<div class="col-lg-3 " id="reportcustodeslocamento_div"> 
						   <div class="form-group">
							<label>Custo do Deslocamento R$:</label>
							
							<input  type="text"class="form-control"   placeholder="Custo do Deslocamento R$:"   id="reportcustodeslocamento" name="reportcustodeslocamento" readonly />
							 
							</div>
						</div> 						
						
						<div class="col-lg-4 " id="reportcustotempodedeslocamento_div">
						   <div class="form-group">
							<label>Custo Tempo de Deslocamento R$:</label>
							
							<input  type="text"class="form-control"   placeholder="Custo Tempo de Deslocamento R$:"   id="reportcustotempodedeslocamento" name="reportcustotempodedeslocamento" readonly />
							 
							</div>
						</div> 
						
						
						
					</div>
						<hr style="border-color: black;">


					<div class="row">
		 
				
					<div class="col-lg-3 " id="reportcustorefeicao_div"> 
						   <div class="form-group">
							<label>Custo Refeição R$:</label>
							
							<input  type="text"class="form-control"   placeholder="Custo Refeição R$:"   id="reportcustorefeicao" name="reportcustorefeicao"  />
							 
							</div>
						</div> 
						<div class="col-lg-3 " id="reportcustohospedagem_div"> 
						   <div class="form-group">
							<label>Custo Hospedagem R$:</label>
							
							<input  type="text"class="form-control"   placeholder="Custo Hospedagem R$:"   id="reportcustohospedagem" name="reportcustohospedagem"  />
							 
							</div>
						</div> 
						<div class="col-lg-3 " id="reportcustopecas_div"> 
						   <div class="form-group">
							<label>Custo Peças R$:</label>
							
							<input  type="text"class="form-control"   placeholder="Custo Peças R$:"   id="reportcustopecas" name="reportcustopecas"  />
							 
							</div>
						</div> 
						<div class="col-lg-3 " id="reportcustoextra_div"> 
						   <div class="form-group">
							<label>Custo Extra R$:</label>
							
							<input  type="text"class="form-control"   placeholder="Custo Extra R$:"   id="reportcustoextra" name="reportcustoextra"  />
							 
							</div>
						</div> 
					
					
					
					
					
					</div>
						
					<div class="row">
					
						<div class="col-lg-3 ">
							   <div class="form-group">								
									<div class="form-group">
										<label>Km Rodados:</label>
										<input  type="text" class="form-control" placeholder="Km Rodados:"  id="reportkm"  />									
									</div>								
								</div>
							</div>
						
						
						<div class="col-lg-3 " id="reporttempodeslocamentototal_div">
						   <div class="form-group">
							<label>Tempo Deslocamento:</label>
							<img src="../images/botaosetaesquerda.png" class="btnSetaClean" id="cleanreporttempodeslocamentototal" style="width: 20px; cursor:pointer;" title="Apagar" />
							
							<input type="hidden" class="classreporttempodeslocamentototal" id="dadosreporttempodeslocamentototal" minutos="" valorDoDeslocamento=""  />
							<input id="reporttempodeslocamentototal" name="reporttempodeslocamentototal" type="text" class="time ui-timepicker-input form-control" style="background-color: white;" autocomplete="off"  readonly />						
						
							</div> 
						</div>
						
					
						<div class="col-lg-3 " id="prazoPagamento_div" >
						   <div class="form-group">
								<label>Condição de Pagamento:</label>
								<input class="form-control"   type="text" placeholder="Condição de Pagamento"  id="prazoPagamento" name="prazoPagamento" maxlength="200" />
							</div>
						</div>
						
						<div class="col-lg-3 " id="reportdesconto_div"> 
						   <div class="form-group">
							<label>Desconto R$:</label>
							
							<input  type="text" class="form-control"   placeholder="Desconto R$:"   id="reportdesconto" name="reportdesconto" style="color: #e10000;"   />
							 
							</div>
						</div> 
							
					</div>
					
					
					
					
				<div class="row">				
					                   
                </div>
				
				
				<div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Horários do Serviço
                        </div>
                        <!-- .panel-heading -->
                        <div class="panel-body">
                            <div class="panel-group" id="accordion">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseTWO" aria-expanded="false" class="collapsed">&nbsp;&nbsp;&nbsp;Abrir&nbsp;&nbsp;&nbsp;</a ><a   class="collapsed" id="zerardatas">&nbsp;&nbsp;&nbsp;Zerar&nbsp;&nbsp;&nbsp;</a>
                                        </h4>
                                    </div>
                                    <div id="collapseTWO" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                        <div class="panel-body">
										<div class="row">
										
											<center id="labelHorasTrabalhadas"><br><br></center>
											
										
										</div>
										
											<!-- os valores dos atributos do campo dadosTabelaConfigValues são carregados ao abrir um novo relatório -->
											<input type="hidden" id="dadosTabelaConfigValues" rep_valhoratecnica=""	rep_valhoraaux="" rep_valkmrodado="" rep_valhoradeslocamento=""	 />
										
										
											<div class="row">
											  <div class="col-lg-3 ">
												   <div class="form-group">
														<label>Data 1 :</label>
														<input type="hidden" id="dadosDia1" minutos="" equipe="" valorDaHora="" valorDoDia=""  />														
														<img src="../images/botaosetaesquerda.png" class="btnSetaClean" id="cleandata1" style="width: 20px;  cursor:pointer;" title="Apagar Data"/>
														<input  type="text"  class="form-control" placeholder="Data"  id="reportdata1" name="reportdata1"  readonly/>
													
													</div>
												</div>
											   <div class="col-lg-2 ">
												   <div class="form-group">
													<label>Entrada:</label>
													<img src="../images/botaosetaesquerda.png" class="btnSetaClean" id="cleanhourin1" style="width: 20px; cursor:pointer;" title="Apagar Data" />
													<input id="hourin1" name="hourin1" type="text" class="time ui-timepicker-input form-control" autocomplete="off"  readonly />						
												
													</div>
												</div>
												<div class="col-lg-2 ">
												   <div class="form-group">
													<label>Saída:</label> 
													<img src="../images/botaosetaesquerda.png" class="btnSetaClean" id="cleanhourout1" style="width: 20px;  cursor:pointer;" title="Apagar Data" />
													<input id="hourout1" name="hourout1" type="text" class="time ui-timepicker-input form-control" autocomplete="off"  readonly />						
														
													</div>
												</div>
												<div class="col-lg-2 ">
												   <div class="form-group">
													<label>Intervalo:</label>
													<img src="../images/botaosetaesquerda.png"  class="btnSetaClean" id="cleanintervalo1" style="width: 20px;  cursor:pointer;" title="Apagar Data" />
													<input id="intervalo1" name="intervalo1" type="text" class="time ui-timepicker-input form-control" readonly />						
													</div>
												</div>
												<div class="col-lg-3 ">
												   <div class="form-group">
													<label>Equipe:</label>
													<select class="form-control selectEquipe" name="equipe1" id="equipe1"   /> 
														<option value="0" selected></option>
														<option value="1" >1 Técnico</option>
														<option value="2" >1 Técnico + 1 Técnico Auxiliar</option>						
														<option value="3" >1 Técnico Auxiliar</option>
														<option value="4" >2 Técnicos</option>
													</select>					
													</div>
												</div>
											</div>
											<hr style="border-color: black;">
											<div class="row">
												<div class="col-lg-3 ">
												   <div class="form-group">
														<label>Data 2:</label>
														<input type="hidden" id="dadosDia2" minutos="" equipe="" valorDaHora="" valorDoDia=""  />
														<img src="../images/botaosetaesquerda.png" class="btnSetaClean" id="cleandata2" style="width: 20px;  cursor:pointer;" title="Apagar Data"/>
														<input  type="text"  class="form-control" placeholder="Data"  id="reportdata2" name="reportdata2"   readonly />
													
													</div>
												</div>
											   <div class="col-lg-2 ">
												   <div class="form-group">
													<label>Entrada:</label>
													<img src="../images/botaosetaesquerda.png" class="btnSetaClean" id="cleanhourin2" style="width: 20px; cursor:pointer;" title="Apagar Data" />
													<input id="hourin2" name="hourin2" type="text" class="time ui-timepicker-input form-control" autocomplete="off"  readonly />						
														
													</div>
												</div>
												<div class="col-lg-2 ">
												   <div class="form-group">
													<label>Saída:</label>
													<img src="../images/botaosetaesquerda.png" class="btnSetaClean" id="cleanhourout2" style="width: 20px;  cursor:pointer;" title="Apagar Data" />
													<input id="hourout2" name="hourout2" type="text" class="time ui-timepicker-input form-control" autocomplete="off" readonly />						
														
													</div>
												</div>
												<div class="col-lg-2 ">
												   <div class="form-group">
													<label>Intervalo:</label>
													<img src="../images/botaosetaesquerda.png" class="btnSetaClean" id="cleanintervalo2" style="width: 20px; cursor:pointer;" title="Apagar Data" />
													<input id="intervalo2" name="intervalo2" type="text" class="time ui-timepicker-input form-control"  readonly />						
													</div>
												</div>
												<div class="col-lg-3 ">
												   <div class="form-group">
													<label>Equipe:</label>
													<select class="form-control selectEquipe" name="equipe2" id="equipe2"   /> 
														<option value="0" selected></option>
														<option value="1" >1 Técnico</option>
														<option value="2">1 Técnico + 1 Técnico Auxiliar</option>						
														<option value="3">1 Técnico Auxiliar</option>
														<option value="4" >2 Técnicos</option>
													</select>					
													</div>
												</div>
											</div>
											<hr style="border-color: black;">
											<div class="row">
											  <div class="col-lg-3 ">
												   <div class="form-group">
														<label>Data 3 :</label>
														<input type="hidden" id="dadosDia3" minutos="" equipe="" valorDaHora="" valorDoDia=""  />
														<img src="../images/botaosetaesquerda.png" class="btnSetaClean" id="cleandata3" style="width: 20px;  cursor:pointer;" title="Apagar Data"/>
														<input  type="text"  class="form-control" placeholder="Data"  id="reportdata3" name="reportdata3"  readonly />
													
													</div>
												</div>
											   <div class="col-lg-2 ">
												   <div class="form-group">
													<label>Entrada:</label>
													<img src="../images/botaosetaesquerda.png" class="btnSetaClean" id="cleanhourin3" style="width: 20px;  cursor:pointer;" title="Apagar Data" />
													<input id="hourin3" name="hourin3" type="text" class="time ui-timepicker-input form-control" autocomplete="off"  readonly />						
														
													</div>
												</div>
												<div class="col-lg-2 ">
												   <div class="form-group">
													<label>Saída:</label>
													<img src="../images/botaosetaesquerda.png" class="btnSetaClean" id="cleanhourout3" style="width: 20px;  cursor:pointer;" title="Apagar Data" />
													<input id="hourout3" name="hourout3" type="text" class="time ui-timepicker-input form-control" autocomplete="off"  readonly />						
														
													</div>
												</div>
												<div class="col-lg-2 ">
												   <div class="form-group">
													<label>Intervalo:</label>
													<img src="../images/botaosetaesquerda.png" class="btnSetaClean" id="cleanintervalo3" style="width: 20px;  cursor:pointer;" title="Apagar Data" />
													<input id="intervalo3" name="intervalo3" type="text" class="time ui-timepicker-input form-control" readonly />						
													</div>
												</div>
												<div class="col-lg-3 ">
												   <div class="form-group">
													<label>Equipe:</label>
													<select class="form-control selectEquipe" name="equipe3" id="equipe3"   /> 
														<option value="0" selected></option>
														<option value="1" >1 Técnico</option>
														<option value="2">1 Técnico + 1 Técnico Auxiliar</option>						
														<option value="3">1 Técnico Auxiliar</option>
														<option value="4" >2 Técnicos</option>
													</select>					
													</div>
												</div>
											</div>
											<hr style="border-color: black;">
											<div class="row">
												<div class="col-lg-3 ">
												   <div class="form-group">
														<label>Data 4:</label>
														<input type="hidden" id="dadosDia4" minutos="" equipe="" valorDaHora="" valorDoDia=""  />
														<img src="../images/botaosetaesquerda.png" class="btnSetaClean" id="cleandata4" style="width: 20px;  cursor:pointer;" title="Apagar Data"/>
														<input  type="text"  class="form-control" placeholder="Data"  id="reportdata4" name="reportdata4"    readonly />
													
													</div>
												</div>
											   <div class="col-lg-2 ">
												   <div class="form-group">
													<label>Entrada:</label>
													<img src="../images/botaosetaesquerda.png" class="btnSetaClean" id="cleanhourin4" style="width: 20px;  cursor:pointer;" title="Apagar Data" />
													<input id="hourin4" name="hourin4" type="text" class="time ui-timepicker-input form-control" autocomplete="off"  readonly />						
														
													</div>
												</div>
												<div class="col-lg-2 ">
												   <div class="form-group">
													<label>Saída:</label>
													<img src="../images/botaosetaesquerda.png" class="btnSetaClean" id="cleanhourout4" style="width: 20px;  cursor:pointer;" title="Apagar Data" />
													<input id="hourout4" name="hourout4" type="text" class="time ui-timepicker-input form-control" autocomplete="off" readonly />						
														
													</div>
												</div>
												<div class="col-lg-2 ">
												   <div class="form-group">
													<label>Intervalo:</label>
													<img src="../images/botaosetaesquerda.png" class="btnSetaClean" id="cleanintervalo4" style="width: 20px;  cursor:pointer;" title="Apagar Data" />
													<input id="intervalo4" name="intervalo4" type="text" class="time ui-timepicker-input form-control"  readonly />						
													</div>
												</div>
												<div class="col-lg-3 ">
												   <div class="form-group">
													<label>Equipe:</label>
													<select class="form-control selectEquipe" name="equipe4" id="equipe4"   /> 
														<option value="0" selected></option>
														<option value="1" >1 Técnico</option>
														<option value="2">1 Técnico + 1 Técnico Auxiliar</option>						
														<option value="3">1 Técnico Auxiliar</option>
														<option value="4" >2 Técnicos</option>
													</select>					
													</div>
												</div>
											</div>
											<hr style="border-color: black;">
											<div class="row">
												<div class="col-lg-3 ">
												   <div class="form-group">
														<label>Data 5:</label>
														<input type="hidden" id="dadosDia5" minutos="" equipe="" valorDaHora="" valorDoDia=""  />
														<img src="../images/botaosetaesquerda.png" class="btnSetaClean" id="cleandata5" style="width: 20px;  cursor:pointer;" title="Apagar Data"/>
														<input  type="text"  class="form-control" placeholder="Data"  id="reportdata5" name="reportdata5"    readonly />
													
													</div>
												</div>
											   <div class="col-lg-2 ">
												   <div class="form-group">
													<label>Entrada:</label>
													<img src="../images/botaosetaesquerda.png" class="btnSetaClean" id="cleanhourin5" style="width: 20px;  cursor:pointer;" title="Apagar Data" />
													<input id="hourin5" name="hourin5" type="text" class="time ui-timepicker-input form-control" autocomplete="off"  readonly />						
														
													</div>
												</div>
												<div class="col-lg-2 ">
												   <div class="form-group">
													<label>Saída:</label>
													<img src="../images/botaosetaesquerda.png" class="btnSetaClean" id="cleanhourout5" style="width: 20px;  cursor:pointer;" title="Apagar Data" />
													<input id="hourout5" name="hourout5" type="text" class="time ui-timepicker-input form-control" autocomplete="off" readonly />						
														
													</div>
												</div>
												<div class="col-lg-2 ">
												   <div class="form-group">
													<label>Intervalo:</label>
													<img src="../images/botaosetaesquerda.png" class="btnSetaClean" id="cleanintervalo5" style="width: 20px;  cursor:pointer;" title="Apagar Data" />
													<input id="intervalo5" name="intervalo5" type="text" class="time ui-timepicker-input form-control"  readonly />						
													</div>
												</div>
												<div class="col-lg-3 ">
												   <div class="form-group">
													<label>Equipe:</label>
													<select class="form-control selectEquipe" name="equipe5" id="equipe5"   /> 
														<option value="0" selected></option>
														<option value="1" >1 Técnico</option>
														<option value="2">1 Técnico + 1 Técnico Auxiliar</option>						
														<option value="3">1 Técnico Auxiliar</option>
														<option value="4" >2 Técnicos</option>
													</select>					
													</div>
												</div>
											</div>
											<hr style="border-color: black;">
											<div class="row">
												<div class="col-lg-3 ">
												   <div class="form-group"> 
														<label>Data 6:</label>
														<input type="hidden" id="dadosDia6" minutos="" equipe="" valorDaHora="" valorDoDia=""  />
														<img src="../images/botaosetaesquerda.png" class="btnSetaClean" id="cleandata6" style="width: 20px;  cursor:pointer;" title="Apagar Data"/>
														<input  type="text"  class="form-control" placeholder="Data"  id="reportdata6" name="reportdata6"    readonly />
													
													</div>
												</div>
											   <div class="col-lg-2 ">
												   <div class="form-group">
													<label>Entrada:</label>
													<img src="../images/botaosetaesquerda.png" class="btnSetaClean" id="cleanhourin6" style="width: 20px;  cursor:pointer;" title="Apagar Data" />
													<input id="hourin6" name="hourin6" type="text" class="time ui-timepicker-input form-control" autocomplete="off"  readonly />						
														
													</div>
												</div>
												<div class="col-lg-2 ">
												   <div class="form-group">
													<label>Saída:</label>
													<img src="../images/botaosetaesquerda.png" class="btnSetaClean" id="cleanhourout6" style="width: 20px;  cursor:pointer;" title="Apagar Data" />
													<input id="hourout6" name="hourout6" type="text" class="time ui-timepicker-input form-control" autocomplete="off" readonly />						
														
													</div>
												</div>
												<div class="col-lg-2 ">
												   <div class="form-group">
													<label>Intervalo:</label>
													<img src="../images/botaosetaesquerda.png" class="btnSetaClean" id="cleanintervalo6" style="width: 20px;  cursor:pointer;" title="Apagar Data" />
													<input id="intervalo6" name="intervalo6" type="text" class="time ui-timepicker-input form-control"  readonly />						
													</div>
												</div>
												<div class="col-lg-3 ">
												   <div class="form-group">
													<label>Equipe:</label>
													<select class="form-control selectEquipe" name="equipe6" id="equipe6"   /> 
														<option value="0" selected></option>
														<option value="1" >1 Técnico</option>
														<option value="2">1 Técnico + 1 Técnico Auxiliar</option>						
														<option value="3">1 Técnico Auxiliar</option>
														<option value="4" >2 Técnicos</option>  
													</select>					
													</div>
												</div>
											</div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        <!-- .panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
					
					<div class="row">									
						<div class="col-lg-12 ">
						   <div class="form-group">
							<label>Descrição do Serviço:</label>
								<textarea class="form-control" rows="15" placeholder="Descrição do Serviço" maxlength="50000" id="reportsolucao" name="reportsolucao"  /></textarea>
							</div>
						</div>
					</div>
					
					
					<div class="row" id="reportdesccustoextra_div">									
						<div class="col-lg-12 ">
						   <div class="form-group">
							<label>Descrição dos Custos Extras:</label>
								<textarea class="form-control" rows="7" placeholder="Descrição dos Custos Extras:" maxlength="50000" id="reportdesccustoextra" name="reportdesccustoextra"  /></textarea>
							</div>
						</div>
						<div class="col-lg-12 ">
						   <div class="form-group">
								<input type="checkbox" class="" id="mostrarDetalhado" name="mostrarDetalhado"/>
							  <label for="scales">Gerar arquivo com Informações Detalhadas</label>
							</div>
						</div>
						<div class="col-lg-12 ">
						   <div class="form-group">
								<input type="checkbox" id="mostrarCustoExtra" name="mostrarCustoExtra"/>
							  <label for="scales">Gerar arquivo com Custo Extra</label> 
							</div>
						</div>						
					</div>
					<hr> 
					<div class="row" >
						<div class="col-lg-12 ">
							 <div class="form-group">
								<label>Observação Privada:</label>
								<textarea class="form-control" rows="7" placeholder="Observação Privada:" maxlength="50000" id="reportobsprivada" name="reportobsprivada"  /></textarea>
							</div>
						</div>
					</div>
					<? 
						if($_GET['edit']){
							?> 
					<div class="row rowAssinatura">
						<div class="col-lg-12">						
						   <iframe src="assinatura.php?edit=<?=$_GET['edit']?>" width="100%" height="350px"></iframe>
						</div>
						<!-- /.col-lg-12 -->
					</div>  
					<?
						}
					?>	
					
					<?
						$disabled = "";
						if($_GET['view'])
						{ 
							$disabled = "disabled";
						}
								
					?>
					
							
								<div class="col-lg-12 botaovoltar"  style="text-align:center; display:none;" >
								   <div class="form-group">
										
										<a href="javascript:window.history.go(-1)"><button  type="button" class="btn btn-warning btn-circle btn-xl" title="Voltar"  >
											<i class="fa fa-step-backward"></i>
										</button></a>
									</div>
									<br><br>
								</div>
							
					
							<div class="col-sm-12" style="text-align:center;">   
							<? if(!empty($_GET['edit'])){ ?>						
				
								<button type="button" class="btn btn-primary btn-circle btn-xl" title="Confirmar Edição" id="btnEdit" style="margin: 37px;"><i class="fa fa-pencil"></i></button>
								
							<?}else{?>
								<button type="button" class="btn btn-success btn-circle btn-xl" id="btnOk" title="Confirmar Inclusão" style="margin: 37px;"><i class="fa fa-check"></i></button>
							<?}?>										
							</div>
						
						
				
				<br><br>
				<!--Modal -->
				
				 
				<div class="modal fade" id="AssOKModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									<h4 class="modal-title" id="myModalLabel">Sucesso</h4>
								</div>
								<div class="modal-body">
									Assinatura Confirmada! 
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
								</div>
						</div>
						<!-- /.modal-content -->
					</div>
					<!-- /.modal-dialog -->
				</div>
				
					<!--Modal -->
				<div class="modal fade" id="reportOK" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									<h4 class="modal-title" id="myModalLabel">Sucesso</h4>
								</div>
								<div class="modal-body">
									Cadastro Efetuado! 
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
								</div>
						</div>
						<!-- /.modal-content -->
					</div>
					<!-- /.modal-dialog -->
				</div>	


		<div class="modal fade" id="alertaHoraSaida" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									<h4 class="modal-title" id="myModalLabel">Alerta!</h4>
								</div>
								<div class="modal-body">
									A hora de saída não pode ser menor ou igual a hora de entrada.
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
								</div>
						</div>
						<!-- /.modal-content -->
					</div>
					<!-- /.modal-dialog -->
				</div>
				
				<!--Modal -->
					<!--Modal -->
				<div class="modal fade" id="selectClienteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									<h4 class="modal-title" id="myModalLabel">Selecionar Cliente</h4>
								</div>
								
								<div class="modal-body" style="text-align: center;">
									
									<div class="col-md-12 col-sm-12 col-xs-12">
										 <input type="text" class="form-control has-feedback-left" id="search-clientes" placeholder="Pesquisar...">
										 
									</div>
									<div class="col-md-12 col-sm-12 col-xs-12">									  
										<div class="table-responsive" style="overflow-x: hidden; overflow-y: scroll; max-height: 250px;">
											<table class="table table-hover" id="tableCli" >
												<thead>
													<tr>
														<th ></th>														
														<th style="    min-width: 406px;">Nome</th>														
														<th>CNPJ/CPF</th>														
														<th style="    min-width: 250px;">Minicípio - UF</th>
													</tr>
												</thead>
												<tbody>
																			 
												</tbody>
											</table>
											<div style="    text-align: center; cursor: pointer;">
												<a id="exibir-mais" style="color:  #337ab7; display: block;" exibe="15" >Exibir mais resultados</a> 
											 </div>
										</div>
									</div>
								
								</div>
								
								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
								</div>
						</div>
						<!-- /.modal-content -->
					</div>
					<!-- /.modal-dialog -->
				</div>
				
				
				
				
				
				
				
				<!--Modal -->
				<div class="modal fade" id="itemPago" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									<h4 class="modal-title" id="myModalLabel">Alerta</h4>
								</div>
								<div class="modal-body">
									Há itens já pagos neste relatório, não é possível alterar as datas de pagamento ou valor!
								</div>
								<div class="modal-footer">
									<button   type="button" class="btn btn-default" data-dismiss="modal">OK</button>
								</div>
						</div>
						<!-- /.modal-content -->
					</div>
					<!-- /.modal-dialog -->
				</div>		
				<!--Modal -->
						<!--Modal -->
					<div class="modal fade" id="reportUpdateOK" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
										<h4 class="modal-title" id="myModalLabel">Alerta</h4>
									</div>
									<div class="modal-body">
										Cadastro Alterado!
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
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
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>
	
    <!-- Bootstrap Core JavaScript -->
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>	
	
	<script src="../includes/jquery-ui.js"></script>
	<script src="../includes/jquery.timepicker.js"></script>	
	<script src="../includes/jquery.timepicker.min.js"></script>
	<script src="../includes/jquery.mask.js"></script>
	
	<script type="text/javascript" src="../includes/moment.min.js"></script>
	<? require "../includes/scriptaddreports.php"; ?>
</body> 

		

</html>

<?

function dtoc($data)
{
  if(trim($data) <> ''){
    $datafmt = substr($data,6,2) . '/' . substr($data,4,2) . '/' . substr($data,0,4);
  }else{
    $datafmt = '';
  }
  return $datafmt;
}

function dtos($data)
{
 $datafmt = substr($data, 6,4) . substr($data, 3,2) . substr($data, 0,2);
 return $datafmt;
}

function ctod($data)
{
  if(trim($data) <> ''){
    $datafmt = substr($data,0,4) . '-' . substr($data,4,2) . '-' . substr($data,6,2);
  }else{
    $datafmt = '';
  }
  return $datafmt;
}


function moeda($valor)
{
  return number_format($valor, 2, ',', '.');
    
}

mysql_close($conexao_fas);

?>
