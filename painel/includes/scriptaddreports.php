<script>

//alert("teste2");
	$('#reportvalor').mask('00.000.000,00', {reverse: true}); 
	$('#reportcustorefeicao').mask('00.000.000,00', {reverse: true}); 
	$('#reportcustohospedagem').mask('00.000.000,00', {reverse: true}); 
	$('#reportcustopecas').mask('00.000.000,00', {reverse: true}); 
	$('#reportcustoextra').mask('00.000.000,00', {reverse: true}); 
	$('#reportdesconto').mask('00.000.000,00', {reverse: true}); 
	
	
	$('#reporthoratecnicatotal').mask('00.000.000,00', {reverse: true}); 
	$('#reportcustodeslocamento').mask('00.000.000,00', {reverse: true}); 
	$('#reportcustotempodedeslocamento').mask('00.000.000,00', {reverse: true}); 
	$('#reportkm').mask('00.000.000', {reverse: true}); 

	var typingTimer; //timer identifier
	var doneTypingInterval = 200; //time in ms, 5 second for example
	
	var relatorioFechado = "";


	var horaTecnicaTotalGlobal = 0;
	var valorKmRodadoTotalGlobal = 0;
	var custoTempoDeDeslocamentoGlobal = 0;
	var reportcustorefeicaoGlobal = 0;
	var reportcustohospedagemGlobal = 0;
	var reportcustopecasGlobal = 0;
	var reportcustoextraGlobal = 0;
	var reportdescontoGlobal = 0;
	
	trataKeyUpCustosSimples(); 		
	trataDigitacaoDeKmRodado(); 
	
	$(document).ready(function(){
		

		<? if(empty($_GET['edit'])){ ?> //incluindo novo relatório
			carregaClientes(15);
			trataClickCliente();
			trataSearchExibirMaisModalcliente();
			trataBotaoOK();
			
			carregaVariaveisDeValor(1); //inclusão
			//trataDigitacaoDeKmRodado(1);
			
		<? }else{ //editando o relatório
			?>
			//trataHideAssinatura();
			trataBotaoOKEdicao();
			carregaVariaveisDeValor(2); //edição
			//trataDigitacaoDeKmRodado(2);
			<?
		} ?>
		
		
		<? if(!empty($_GET['view'])){ ?> //view está desabilitado.... nunca passará aqui
			$(".form-control").attr('disabled', 'disabled');
		<? }?>
		
		//carregaDefeitos(5);
		//trataClickDefeitos();
		//trataSearchExibirMaisModaldefeito();
		trataBotaoApagarDataDePagamento();	//não comentar esta linha
		trataSelectEquipe();
		hideCamposValorFuncionario();
		
		
		$("#msgcarregando").hide();
		//calculaValorTotal();
		
		var navegador = GetBrowserInfo(); //funcaono js getbrowser.js
		if(navegador != "Opera" && navegador != "Chrome"){
			
			$("#alertaNavegador").html("<label style='color: red;'>Este Sistema não é compatível com o navegador "+navegador+".</label> <br><br>Recomendamos os navegadores Opera ou Chrome");
		
		}
		
	});
	
	function trataKeyUpCustosSimples(){
		
		$("#reportcustorefeicao").keyup(function(e){			
				var reportcustorefeicao = $(this).val();						
				reportcustorefeicaoGlobal = reportcustorefeicao || '0'; 
				reportcustorefeicaoGlobal = parseFloat(reportcustorefeicaoGlobal.replace('.', '').replace(',', '.'));
				simula(); //atualiza o campo valor total simulando uma alteração de equipe
		});
		
		$("#reportcustohospedagem").keyup(function(e){			
				var reportcustohospedagem = $(this).val();						
				reportcustohospedagemGlobal = reportcustohospedagem || '0'; 
				reportcustohospedagemGlobal = parseFloat(reportcustohospedagemGlobal.replace('.', '').replace(',', '.'));
				simula(); //atualiza o campo valor total simulando uma alteração de equipe
		});
		
		$("#reportcustopecas").keyup(function(e){			
				var reportcustopecas = $(this).val();						
				reportcustopecasGlobal = reportcustopecas || '0'; 
				reportcustopecasGlobal = parseFloat(reportcustopecasGlobal.replace('.', '').replace(',', '.'));
				simula(); //atualiza o campo valor total simulando uma alteração de equipe
		});
		
		$("#reportcustoextra").keyup(function(e){
			
				var reportcustoextra = $(this).val();						
				reportcustoextraGlobal = reportcustoextra || '0'; 
				reportcustoextraGlobal = parseFloat(reportcustoextraGlobal.replace('.', '').replace(',', '.'));
				
				
				simula(); //atualiza o campo valor total simulando uma alteração de equipe
		});
		
		
		$("#reportdesconto").keyup(function(e){
			
				var reportdesconto = $(this).val();						
				reportdescontoGlobal = reportdesconto || '0'; 
				reportdescontoGlobal = parseFloat(reportdescontoGlobal.replace('.', '').replace(',', '.'));
				
				
				simula(); //atualiza o campo valor total simulando uma alteração de equipe
		});
		
		
	}
	
	function calculaValorTotal(){
		//alert("calculaValorTotal");
			//alert(reportcustorefeicaoGlobal);
			var valortotal = horaTecnicaTotalGlobal + valorKmRodadoTotalGlobal + custoTempoDeDeslocamentoGlobal + reportcustorefeicaoGlobal + reportcustohospedagemGlobal + reportcustopecasGlobal + reportcustoextraGlobal - reportdescontoGlobal;
		
			if(valortotal < 0){
				alert("O desconto não pode ser maior que o valor total!");
				valortotal = 0;
			}
			$("#reportvalor").val(valortotal.toFixed(2));
			$("#reportvalor").trigger('keyup'); //para manter a formatação
		
		
	}
	
	
	function trataRelatorioFechado(){
		
		if(relatorioFechado == "1"){
			$(".rowAssinatura").css('display', 'none');
			$("#btnEdit").css('display', 'none');
			
			<? 					
				if($_SESSION['permissao'] != '1'){
			?>
				$(".page-header").html("<h4 style='color: red; '>ATENÇÃO! RELATÓRIO BLOQUEADO PARA EDIÇÃO!</h4>"); 
			<? 					
				}
			?>
			
		}else{
			
			$(".botaovoltar").css("display", "none");
		}
	}
	

	function trataDigitacaoDeKmRodado(){
		
		var valorKmRodado;
		
		$.ajax({
					//pagina onde está o ajax
					url: 'ajax/ajaxProjeto.php',   
					async: false,
					type: 'get',
					dataType: "json",
					data: {
						funcao: "getValorKmRodado", 
							
						codigo : '<? echo $_GET['edit'];?>'
						},
						//retorno 
					success: function(response) {
						
							
								valorKmRodado = response['VALORKMRODADO'];	
												
							
						}
					});
		
		
		$("#reportkm").keyup(function(e){
			
			
			var quantoskm = parseInt($("#reportkm").val().replace('.', ''));
			var valorKmRodadoTotal = quantoskm * valorKmRodado;
			
			valorKmRodadoTotalGlobal = valorKmRodadoTotal || 0;
			
			
			$("#reportcustodeslocamento").val(valorKmRodadoTotal.toFixed(2) || 0);
			$("#reportcustodeslocamento").trigger('keyup'); //para manter a formatação
			
			
			simula();
			
			
		});
		
		
	} 

	function simula()
	{
		//alert("simulou");
		//para triggar o calculo do valor total
				$("#equipe1").trigger('change');
	}

	function hideCamposValorFuncionario(){
			<? 					
				if($_SESSION['permissao'] != '1'){
			?>
				$("#reportvalor_div").hide();	
				$("#reporthoratecnicatotal_div").hide();
				$("#reportcustodeslocamento_div").hide();				
				$("#prazoPagamento_div").hide();
				
				$("#reportdesccustoextra_div").hide();	
				
				
				//$("#reporttempodeslocamentototal_div").hide();
				$("#reportcustotempodedeslocamento_div").hide();


				$("#reportcustorefeicao_div").hide();	
				$("#reportcustohospedagem_div").hide();	
				$("#reportcustopecas_div").hide();	
				$("#reportcustoextra_div").hide();	
				$("#reportdesconto_div").hide();					
			
			<? 					
				}
			?>
		
	}

	//carrega variaveis de valor R$ para o campo hidden dadosTabelaConfigValues na inclusão de um novo relatório
	function carregaVariaveisDeValor(inclusaoOuEdicao){
		
		
			
			$.ajax({
					//pagina onde está o ajax
					url: 'ajax/ajaxProjeto.php',   
					async: false,
					type: 'get',
					dataType: "json",
					data: {
						funcao: "getValoresPadraoJson", 
						edicaoOuInclusao : 	inclusaoOuEdicao,	
						codigo : '<? echo $_GET['edit'];?>'
						},
						//retorno 
					success: function(response) {
						//console.log(response)
						//alert(inclusaoOuEdicao);
							if(inclusaoOuEdicao == 1){
								$("#dadosTabelaConfigValues").attr("rep_valhoratecnica", response['VAL_HORATECNICA']);	
								$("#dadosTabelaConfigValues").attr("rep_valhoraaux", response['VAL_HORAAUX']);
								$("#dadosTabelaConfigValues").attr("rep_valkmrodado", response['VAL_KMRODADO']);	
								$("#dadosTabelaConfigValues").attr("rep_valhoradeslocamento", response['VAL_HORADESLOCAMENTO']);
							}
							if(inclusaoOuEdicao == 2){
								$("#dadosTabelaConfigValues").attr("rep_valhoratecnica", response['REP_VALHORATECNICA']);	
								$("#dadosTabelaConfigValues").attr("rep_valhoraaux", response['REP_VALHORAAUX']);
								$("#dadosTabelaConfigValues").attr("rep_valkmrodado", response['REP_VALKMRODADO']);	
								$("#dadosTabelaConfigValues").attr("rep_valhoradeslocamento", response['REP_VALHORADESLOCAMENTO']);
							}
						}
					});
		}
		
		
		
	 
	
	
	function trataSelectEquipe(){	
	

		$(".selectEquipe").on('change', function() { 
			//alert("aqui");
			
				var equipe = $(this).val();
				var dia = $(this).attr("name").substr(-1); //pega qual dos 6 dias possíveis				
				var minutosDoDia = $("#dadosDia"+dia).attr("minutos"); //pega os minutos trabalhados neste dia
				var valorDaHora; 
				
				if($(this).val() != 0 && !!$(this).val()){ 
				
				
					if(equipe == "1"){ valorDaHora = $("#dadosTabelaConfigValues").attr("rep_valhoratecnica");}
					if(equipe == "2"){ valorDaHora = parseFloat($("#dadosTabelaConfigValues").attr("rep_valhoratecnica"))+parseFloat($("#dadosTabelaConfigValues").attr("rep_valhoraaux"));}
					if(equipe == "3"){ valorDaHora = $("#dadosTabelaConfigValues").attr("rep_valhoraaux");}
					if(equipe == "4"){ valorDaHora = $("#dadosTabelaConfigValues").attr("rep_valhoratecnica")*2; }//2 técnicos = valor hora 1 técnico * 2 
				//alert(valorDaHora+"aqui");
				//alert(equipe);
			
			
			
			/*	$.ajax({
					//pagina onde está o ajax
					url: 'ajax/ajaxProjeto.php',   
					async: false,
					type: 'get',
					dataType: "json",
					data: {
						funcao: "getValorDaHora", 
						equipe: equipe,						
						},
						//retorno 
					success: function(response) {
						//console.log(response)
						  valorDaHora = response['VALOR'];
						  
						}
					});
				*/
				
					var valorDoDia = (valorDaHora*minutosDoDia)/60;
					
					//finaliza o preenchimento do campo hidden dadosDiax
					$("#dadosDia"+dia).attr("equipe", equipe);
					$("#dadosDia"+dia).attr("valorDaHora", valorDaHora);
					$("#dadosDia"+dia).attr("valorDoDia", valorDoDia);
					//finaliza o preenchimento do campo hidden dadosDiax
					
				}else if($(this).val() == 0){
					
					//finaliza o preenchimento do campo hidden dadosDiax
					$("#dadosDia"+dia).attr("equipe", "");
					$("#dadosDia"+dia).attr("valorDaHora", "");
					$("#dadosDia"+dia).attr("valorDoDia", "");
					//finaliza o preenchimento do campo hidden dadosDiax
					
				}
			
			
				//preenche o campo reporthoratecnicatotal
				var valordodia1 = parseFloat($("#dadosDia1").attr('valordodia'))  || 0;
				var valordodia2 = parseFloat($("#dadosDia2").attr('valordodia'))  || 0;
				var valordodia3 = parseFloat($("#dadosDia3").attr('valordodia'))  || 0;
				var valordodia4 = parseFloat($("#dadosDia4").attr('valordodia'))  || 0;
				var valordodia5 = parseFloat($("#dadosDia5").attr('valordodia'))  || 0;
				var valordodia6 = parseFloat($("#dadosDia6").attr('valordodia'))  || 0;
				
				horaTecnicaTotalGlobal = valordodia1+valordodia2+valordodia3+valordodia4+valordodia5+valordodia6; 
				
				$("#reporthoratecnicatotal").val((valordodia1+valordodia2+valordodia3+valordodia4+valordodia5+valordodia6).toFixed(2));
				$("#reporthoratecnicatotal").trigger('keyup');
				//preenche o campo reporthoratecnicatotal
				
				//as alterações de custos chamam um trigger para equipe, que entao calcula o valor total na INCLUSÃO
				calculaValorTotal();
				

		});
		
		
	}


	function trataHideAssinatura(){
		
		$(".form-control").on('change', function(){
			
			
				if($(this).hasClass('selectEquipe') || $(this).hasClass('classreporttempodeslocamentototal')){
					
					return; //correção de bug envolvendo o campo selectEquipe
					
				}
					
					$(".rowAssinatura").html('<center>Para assinar o relatório, não altere nenhum campo!</center>');});
					
				
		
	}
	
	
	
	
	function trataBotaoOK(){		
		$('#btnOk').on('click',function (){
			$('#btnOk').attr('disabled', 'disabled');
			if(!validaCampos()){$('#btnOk').removeAttr('disabled'); return;}

			
			var infodetalhada = $("#mostrarDetalhado").is(':checked') == true ? "1" : "0";
			var infocustoextra = $("#mostrarCustoExtra").is(':checked') == true ? "1" : "0";
			
			
				
			/*var quantidade_de_pagamentos = 0;
			$( ".pagamento" ).each(function(  ) {
				if($( this ).val() != ""){
					
					quantidade_de_pagamentos++;
				}
			});*/
			
			//alert(quantidade_de_pagamentos);return;
			//alert($("#reportvalor").val());
			//return;
			$.ajax({
				//pagina onde está o ajax
				url: 'ajax/ajaxProjeto.php',
				type: 'post',
				
				//dados do ge t
				data: {
					funcao: "incluirRelatorio", 
					descCli : $("#reportempresa").val(),
					codCli : $("#codCli").val(),
					reportdata : $("#reportdata").val(), 
					reportmaquina : $("#reportmaquina").val(), 
					reportnummaquina : $("#reportnummaquina").val(), 
					reportmodelomaquina  : $("#reportmodelomaquina").val(), 
					reportpedidocliente : $("#reportpedidocliente").val(), 
					reportselecteddefects  : $("#reportselecteddefects").val(), 
					reportvalor : $("#reportvalor").val(), 
					reportsolucao : $("#reportsolucao").val(),
					
					reportdesccustoextra : $("#reportdesccustoextra").val(),
					
					reportsolicitante : $("#reportsolicitante").val(),
					reportgarantia : $("#reportgarantia").val(),
					reportkm : $("#reportkm").val(),
					
					reportdata1 : $("#reportdata1").val(),
					reportdata2 : $("#reportdata2").val(),
					reportdata3 : $("#reportdata3").val(), 
					reportdata4 : $("#reportdata4").val(),					
					reportdata5 : $("#reportdata5").val(),
					reportdata6 : $("#reportdata6").val(),
					
					hourin1 : $("#hourin1").val(),
					hourin2 : $("#hourin2").val(),
					hourin3 : $("#hourin3").val(),
					hourin4 : $("#hourin4").val(),					
					hourin5 : $("#hourin5").val(),
					hourin6 : $("#hourin6").val(),

					hourout1 : $("#hourout1").val(),
					hourout2 : $("#hourout2").val(),
					hourout3 : $("#hourout3").val(),
					hourout4 : $("#hourout4").val(),					
					hourout5 : $("#hourout5").val(),
					hourout6 : $("#hourout6").val(),
					
					intervalo1 : $("#intervalo1").val(),
					intervalo2 : $("#intervalo2").val(),
					intervalo3 : $("#intervalo3").val(),
					intervalo4 : $("#intervalo4").val(),
					intervalo5 : $("#intervalo5").val(),
					intervalo6 : $("#intervalo6").val(),
					
					tempodeslocamento : $("#reporttempodeslocamentototal").val(),
					
					equipe1 : $("#equipe1").val(),
					equipe2 : $("#equipe2").val(),
					equipe3 : $("#equipe3").val(),
					equipe4 : $("#equipe4").val(),
					equipe5 : $("#equipe5").val(),
					equipe6 : $("#equipe6").val(),
					
					
					valhoratecnica : $("#dadosTabelaConfigValues").attr("rep_valhoratecnica"),	
					valhoraaux : $("#dadosTabelaConfigValues").attr("rep_valhoraaux"),	
					valkmrodado	: $("#dadosTabelaConfigValues").attr("rep_valkmrodado"),	
					valhoradeslocamento	: $("#dadosTabelaConfigValues").attr("rep_valhoradeslocamento"),	
					
					reporthoratecnicatotal : $("#reporthoratecnicatotal").val(), 
					reportcustodeslocamento : $("#reportcustodeslocamento").val(), 
					reportcustotempodedeslocamento : $("#reportcustotempodedeslocamento").val(), 
					
					reportcustorefeicao : $("#reportcustorefeicao").val(), 
					reportcustohospedagem : $("#reportcustohospedagem").val(), 
					reportcustopecas : $("#reportcustopecas").val(), 
					reportcustoextra : $("#reportcustoextra").val(), 
					
					reportdesconto : $("#reportdesconto").val(), 
					
					informacoesDetalhadas : infodetalhada,
					informacoesCustoExtra : infocustoextra,
					
					
					reportobsprivada : $("#reportobsprivada").val(),
					
					
					prazoPagamento : $("#prazoPagamento").val(),
					
					//quantidadeDePagamentos : quantidade_de_pagamentos,
					},
					//retorno 
				success: function(response) {
					//$("#reportsolucao").val(response);
					//return;
					
					if($.trim(response) == "OK"){
						$('#reportOK').modal('show').on('hidden.bs.modal', function () {
							location.href='./reports.php';
						});
					}else{alert(response);
						$("#reportsolucao").val(response);
					}
						  
					}
					
				}); 					
								
			
		});		

	}		


	function trataClickCliente(){
		
		$("#reportempresa").on('click', function(){
			
			
			
			$("#selectClienteModal").modal("show").on('shown.bs.modal', function(){
				
					$("#search-clientes").focus();
				
				});

		});
		
	}

	function trataClickDefeitos(){
		//Essa função era utilizada na forma antiga de selecionar defeitos
		//A partir de 13/03/2018 o campo defeitos foi alterado para "texto livre"
		/*$("#reportselecteddefects").on('click', function(){
			
			
			
			$("#reportselecteddefectsModal").modal("show").on('shown.bs.modal', function(){
				
					$("#search-defeitos").focus();
				
				});

		});*/
		
	}


	function trataSelectCliente(){
		
		$(".selectCliente").on('click', function(){
			
			$("#reportempresa").val($(this).attr('nome'));
			$("#reportsolicitante").val($(this).attr('solicitante'));
			$("#reportnumero").val($(this).attr('numero'));
			$("#reportcnpjcpf").val($(this).attr('documento'));
			$("#reportmun").val($(this).attr('municipio'));
			$("#reportend").val($(this).attr('endereco'));
			$("#reportestado").val($(this).attr('estado'));
			$("#reportcep").val($(this).attr('cep'));
			$("#codCli").val($(this).attr('cliente'));
			
			
				$("#selectClienteModal").modal("hide");
				
				
				
				/*Ocultar os campos que são preenchidos automaticamente a partir do momento que é colocado o nome do cliente: 
				Cod
				Solicitante
				Data
				Cod
				CNPJ
				Município
				Endereço
				Número
				Estado
				CEP
				 
				E ocultar os campos que não são usados pelo técnico: 
				Garantia
				Pedido do Cliente
				Total do Serviço
				Condição de Pagamento*/
				
				<? 					
					if($_SESSION['permissao'] == '3'){
						
					//oculta alguns campos para o usuario funcionário
				?>	
				$("#clientinforow1").hide();
				$("#clientinforow2").hide();
				$("#camposParaOcultar").hide();
				
				
				<? 
					} 
				?>
				

		});	
		
	}

	function trataSearchExibirMaisModalcliente(){
		
		
		$("#search-clientes").keyup(function(e){		
			
			
			$("#tableCli tbody").html("<tr><td colspan='10' style='text-align: center'></td></tr> ");
					
			 $("#tableCli tbody").html("<tr><td colspan='10' style='text-align: center'><img src='../images/loading.gif'></td></tr>");
			
			clearTimeout(typingTimer);
			 
			 $("#exibir-mais").attr("exibe", 15);
			 
			 typingTimer = setTimeout(function(){ carregaClientes(15); }, doneTypingInterval);
		});

		
			
		$("#exibir-mais").on('click',function(){
			 $("#tableCli tbody").append("<tr><td colspan='10' style='text-align: center'><img src='../images/loading.gif'></td></tr>");
			
			 clearTimeout(typingTimer);
			 
			 typingTimer = setTimeout(function(){ carregaClientes(parseInt($("#exibir-mais").attr("exibe"))+15); }, doneTypingInterval);		
			
			 $("#exibir-mais").attr("exibe", parseInt($("#exibir-mais").attr("exibe"))+15);
		});
		
	}

	//função com os parametros do ajad
	function carregaClientes(limite){
		$.ajax({
			//pagina onde está o ajax
			url: 'ajax/ajaxProjeto.php',
			type: 'get',
			
			//dados do get
			data: {
				funcao: "searchClientModal", 
				search: $("#search-clientes").val(),
				limit: limite
				},
				//retorno 
			success: function(response) {
				 $("#tableCli tbody").html(response);
				 
				 trataSelectCliente();
				}
			}); 
	}

	/*
	function addDefeito(novoDefeito){
		
		var defeitos_ja_selecionados = $("#reportselecteddefects").val();
	
		var exist = defeitos_ja_selecionados.search(novoDefeito);
		
		if(exist != -1){
			alert("Defeito já adicionado.");
			
			return;
		}
		else{
			
			$("#reportselecteddefects").val($("#reportselecteddefects").val() + novoDefeito+";");
			
		}
			$("#addDefectModal").val('');
			//$("#reportselecteddefectsModal").modal("hide");
	}
	
	
	function trataSelectDefeito(){
		
		$(".selectDefeito").on('click', function(){
			
			addDefeito($(this).attr('descricao'));
		
		});	
		
		$("#btnAddDefectModal").on('click', function(){
			
			addDefeito($("#addDefectModal").val());
			
		});	
		
		
	}

	function trataSearchExibirMaisModaldefeito(){
	
	
		$("#search-defeitos").keyup(function(e){		
		
		
			$("#tableDefeitos tbody").html("<tr><td colspan='2' style='text-align: center'></td></tr> ");
					
			 $("#tableDefeitos tbody").html("<tr><td colspan='2' style='text-align: center'><img src='../images/loading.gif'></td></tr>");
			
			clearTimeout(typingTimer);
			 
			 $("#exibir-mais-defeitos").attr("exibe", 5);
			 
			 typingTimer = setTimeout(function(){ carregaDefeitos(5); }, doneTypingInterval);
		});

	
		
		$("#exibir-mais-defeitos").on('click',function(){
			 $("#tableDefeitos tbody").append("<tr><td colspan='2' style='text-align: center'><img src='../images/loading.gif'></td></tr>");
			
			 clearTimeout(typingTimer);
			 
			 typingTimer = setTimeout(function(){ carregaDefeitos(parseInt($("#exibir-mais-defeitos").attr("exibe"))+5); }, doneTypingInterval);		
			
			 $("#exibir-mais-defeitos").attr("exibe", parseInt($("#exibir-mais-defeitos").attr("exibe"))+5);
		});
	
	}

	//função com os parametros do ajad
	function carregaDefeitos(limite){
		
		
		$.ajax({
			//pagina onde está o ajax
			url: 'ajax/ajaxProjeto.php',
			type: 'get',
			
			//dados do get
			data: {
				funcao: "searchDefeitoModal", 
				search: $("#search-defeitos").val(),
				limit: limite
				},
				//retorno 
			success: function(response) {
				 $("#tableDefeitos tbody").html(response);
				 
				 trataSelectDefeito();
				}
			}); 
	}

	*/
	function validaCampos(){
		
			
				var validado = true;
				
								
				$("#reportempresa").css('border-color', '');			
				
				
				if($.trim($("#reportempresa").val()) == ""){
					
					$("#reportempresa").css('border-color', 'red');
					validado = false;
					$("#selectClienteModal").modal('show');
				}
				
				
				if(($("#reporttempodeslocamentototal").val().length > 0 && $("#reportcustotempodedeslocamento").val().length == 0 ) || ($("#reporttempodeslocamentototal").val().length > 0 && $("#reportcustotempodedeslocamento").val() == '0,00' ) ){
					
					alert("Uma instabilidade na sua conexão pode ter causado uma falha no cálculo do campo \n\n'Custo Tempo de Deslocamento R$:'. \n\n Favor revisar o tempo de deslocamento para que o campo seja corretamente preenchido.");
					validado = false;
				}
				
				
				
				if(!validado){return false;}else{return true};
		
	}
	
	function dtoc(data)	{	

		if(data != ""){	
			datafmt = data.substring(6,8) + '/' + data.substring(4,6) + '/' + data.substring(0,4);
		 
			return datafmt;
		}else{return data;}
	}

	
<? if(!empty($_GET['edit']) || !empty($_GET['view'])){ ?>
		
		
		$.ajax({
			//pagina onde está o ajax
			url: 'ajax/ajaxProjeto.php',   
			async: false,
			type: 'get',
			dataType: "json",
			//dados do get
			data: {
				funcao : "getRelatorioJson",
				codigo : '<? echo $_GET['edit'].$_GET['view'];?>'
				
				},
				//retorno 
				success: function(response) {					
					
					$("#codCli").val(response['REP_CLIENTE']); 	
					$("#reportdata").val(dtoc(response['REP_DATA'])); 	
					$("#reportcod").val(response['REP_CODIGO']);
					$("#reportsolicitante").val(response['REP_SOLICITANTE']);
					$("#reportmaquina").val(response['REP_MAQUINA']);
					$("#reportnummaquina").val(response['REP_NUMMAQUINA']);
					$("#reportmodelomaquina").val(response['REP_MODMAQUINA']);
					$("#reportpedidocliente").val(response['REP_PEDIDOCLI']);
					$("#reportselecteddefects").val(response['REP_DEFEITOS']);
					$("#reportvalor").val(response['REP_TOTAL']);
					$("#reportsolucao").val(response['REP_SOLUCAO']);
					$("#reportdesccustoextra").val(response['REP_DESCCUSTOEXTRA']);
					
					$("#reportgarantia").val(response['REP_GARANTIA']);
					$("#reportkm").val(response['REP_KM']);
					$("#reportdata1").val(dtoc(response['REP_DATA1']));
					$("#reportdata2").val(dtoc(response['REP_DATA2']));
					$("#reportdata3").val(dtoc(response['REP_DATA3']));
					$("#reportdata4").val(dtoc(response['REP_DATA4']));
					
					$("#reportdata5").val(dtoc(response['REP_DATA5']));
					$("#reportdata6").val(dtoc(response['REP_DATA6']));
					
					$("#hourin1").val(response['REP_HORAENTRADA1']);
					$("#hourin2").val(response['REP_HORAENTRADA2']);
					$("#hourin3").val(response['REP_HORAENTRADA3']);
					$("#hourin4").val(response['REP_HORAENTRADA4']);
					
					$("#hourin5").val(response['REP_HORAENTRADA5']);
					$("#hourin6").val(response['REP_HORAENTRADA6']);
					
					
					$("#hourout1").val(response['REP_HORASAIDA1']);
					$("#hourout2").val(response['REP_HORASAIDA2']);
					$("#hourout3").val(response['REP_HORASAIDA3']);
					$("#hourout4").val(response['REP_HORASAIDA4']);
					
					$("#hourout5").val(response['REP_HORASAIDA5']);
					$("#hourout6").val(response['REP_HORASAIDA6']);
					
					
					$("#intervalo1").val(response['REP_ITERVALO1']);
					$("#intervalo2").val(response['REP_ITERVALO2']);
					$("#intervalo3").val(response['REP_ITERVALO3']);
					$("#intervalo4").val(response['REP_ITERVALO4']);
					$("#intervalo5").val(response['REP_ITERVALO5']);
					$("#intervalo6").val(response['REP_ITERVALO6']);
					
					$("#reporttempodeslocamentototal").val(response['REP_TEMPODESLOCAMENTO']);
					
					
					$("#equipe1").val(response['REP_EQUIPE1']);
					$("#equipe2").val(response['REP_EQUIPE2']);
					$("#equipe3").val(response['REP_EQUIPE3']);
					$("#equipe4").val(response['REP_EQUIPE4']);
					$("#equipe5").val(response['REP_EQUIPE5']);
					$("#equipe6").val(response['REP_EQUIPE6']); 
					
					$("#prazoPagamento").val(response['REP_PRAZOPAGAMENTO']);
					$("#reporthoratecnicatotal").val(response['REP_VALHORATECNICATOTAL']);
					$("#reportcustodeslocamento").val(response['REP_CUSTODESLOCAMENTO']);
					
					$("#reportcustotempodedeslocamento").val(response['REP_CUSTOTEMPODESLOCAMENTO']);
					//alert(response['REP_CUSTOTEMPODESLOCAMENTO']);
					
					$("#reportcustorefeicao").val(response['REP_CUSTOREFEICAO']);
					$("#reportcustohospedagem").val(response['REP_CUSTOHOSPEDAGEM']);
					$("#reportcustopecas").val(response['REP_CUSTOPECAS']);
					$("#reportcustoextra").val(response['REP_CUSTOEXTRA']);
					$("#reportdesconto").val(response['REP_DESCONTO']);
					
					relatorioFechado = response['REP_LOCKED'];						
					
					
					if(response['REP_DETALHADO'] == '1'){
						$("#mostrarDetalhado").attr('checked', 'checked');
					}
					
					if(response['REP_MOSTRACUSTOEXTRA'] == '1'){
						$("#mostrarCustoExtra").attr('checked', 'checked');
					}
					
					
					$("#reportobsprivada").val(response['REP_OBSPRIVADA']);
					
					
					<? 					
						if($_SESSION['permissao'] != '1'){
					?>
							trataRelatorioFechado();	
					<? 					
						}
					?>


					//$("#pagamento1").val(dtoc(response['REP_PAGAMENTO1']));
					//$("#pagamento2").val(dtoc(response['REP_PAGAMENTO2']));
					//$("#pagamento3").val(dtoc(response['REP_PAGAMENTO3']));
					//$("#pagamento4").val(dtoc(response['REP_PAGAMENTO4']));
					//$("#pagamento5").val(dtoc(response['REP_PAGAMENTO5']));
					//$("#pagamento6").val(dtoc(response['REP_PAGAMENTO6']));
					//$("#pagamento7").val(dtoc(response['REP_PAGAMENTO7']));
					//$("#pagamento8").val(dtoc(response['REP_PAGAMENTO8']));
					
					
					//para manter a formatação
					$("#reportvalor").trigger('keyup');
					$("#reportkm").trigger('keyup');
					$("#reporthoratecnicatotal").trigger('keyup');
					$("#reportcustodeslocamento").trigger('keyup');
					$("#reportcustotempodedeslocamento").trigger('keyup');
					
					$("#reportcustorefeicao").trigger('keyup');
					$("#reportcustohospedagem").trigger('keyup');
					$("#reportcustopecas").trigger('keyup');
					$("#reportcustoextra").trigger('keyup');
					$("#reportdesconto").trigger('keyup');
					
					
					
					
					
						$.ajax({
							//pagina onde está o ajax
							url: 'ajax/ajaxProjeto.php',   
							async: true,
							type: 'get',
							dataType: "json",
							//dados do get
							data: {
								funcao : "getClienteJson",
								codigo : response['REP_CLIENTE']
								
								},
								//retorno 
								success: function(response) {
									
									$("#reportempresa").val(response['CLI_NOME']); 	
									$(".rowInfoCli").css('display', 'none');
									
									<? 					
										if($_SESSION['permissao'] == '3'){
											
										//oculta alguns campos para o usuario funcionário
									?>	
									$("#clientinforow1").hide();
									$("#clientinforow2").hide();
									$("#camposParaOcultar").hide();
									<? 
										} 
									?>
									trataCampoHorasDeServico();
									//trataCampoTempoDeDeslocamento();
									$('#reporttempodeslocamentototal').trigger('change');
									//simula uma alteração de tempo de deslocamente para recalcular o valor na edição
									//#xunxo
									
									
								}
						}); 
				}
		}); 
		
<?}?>



/*function validaCamposHora(){		
			
				var validado = true;				
								
				

				
				if($.trim($("#reportempresa").val()) == ""){
					
					$("#reportempresa").css('border-color', 'red');
					validado = false;
					$("#selectClienteModal").modal('show');
				}
				
				if(!validado){return false;}else{return true};
		
	}
*/
 

function trataCampoTempoDeDeslocamento(){
	//alert("aqui");
	
	var var_tempoDeslocamento = $("#reporttempodeslocamentototal").val();	
	var msd = moment(var_tempoDeslocamento,"HH:mm").diff(moment("00:00","HH:mm"));
	var momentDeslocamento = moment.duration(msd);			
	var resultDeslocamentoEmMinutos = Math.floor(momentDeslocamento.asMinutes());	
	//alert("tempo de deslocamento em minutos: " + resultDeslocamentoEmMinutos);	
	$("#dadosreporttempodeslocamentototal").attr("minutos", resultDeslocamentoEmMinutos);
	
	var custoPorHoraDeDeslocamento = $("#dadosTabelaConfigValues").attr("rep_valhoradeslocamento");	
	var custoTempoDeDeslocamento = (custoPorHoraDeDeslocamento*resultDeslocamentoEmMinutos)/60;
	
	//alert("valor do tempo de deslocamento: "+custoTempoDeDeslocamento);
	//alert($("#reportcustotempodedeslocamento").val());
	$("#reportcustotempodedeslocamento").val(custoTempoDeDeslocamento.toFixed(2) || 0);
	//alert($("#reportcustotempodedeslocamento").val()); 
	$("#reportcustotempodedeslocamento").trigger('keyup'); //para manter a formatação
	
	custoTempoDeDeslocamentoGlobal = custoTempoDeDeslocamento || 0;
	
	simula();
	
}


function trataCampoHorasDeServico(){
	
	//A hora de saída não pode ser menor ou igual a hora de entrada.
	for (var i = 1; i <=6; i++) { //6 dias disponíveis
	   if(this != "[object Window]"){	//tratamento para desconsiderar o botão clean 	
			if(this.attr("id") == "hourout"+i ||  (this.attr("id") == "hourin"+i && $("#hourout"+i).val() !=  "")){
				if($("#hourout"+i).val() <= $("#hourin"+i).val() && $("#hourout"+i).val() != "00:00" ){
					$(this).val('');	
					$('#alertaHoraSaida').modal('show').on('hidden.bs.modal', function () {
							
						});
					break;
				}
			}		
		}
	}
		
		
	var var_hourin1 = $("#hourin1").val();
	var var_hourout1  = $("#hourout1").val() == "00:00" ? "24:00" : $("#hourout1").val();
	var var_hourin2 = $("#hourin2").val();
	var var_hourout2  = $("#hourout2").val() == "00:00" ? "24:00" : $("#hourout2").val();
	var var_hourin3 = $("#hourin3").val();
	var var_hourout3  = $("#hourout3").val() == "00:00" ? "24:00" : $("#hourout3").val();
	var var_hourin4 = $("#hourin4").val();
	var var_hourout4  = $("#hourout4").val() == "00:00" ? "24:00" : $("#hourout4").val();
	var var_hourin5 = $("#hourin5").val();
	var var_hourout5  = $("#hourout5").val() == "00:00" ? "24:00" : $("#hourout5").val();
	var var_hourin6 = $("#hourin6").val();
	var var_hourout6  = $("#hourout6").val() == "00:00" ? "24:00" : $("#hourout6").val();
	
	var var_intervalo1 = $("#intervalo1").val();
	var var_intervalo2 = $("#intervalo2").val();
	var var_intervalo3 = $("#intervalo3").val();
	var var_intervalo4 = $("#intervalo4").val();
	var var_intervalo5 = $("#intervalo5").val();
	var var_intervalo6 = $("#intervalo6").val(); 
	
	var ms1 = moment(var_hourout1,"HH:mm").diff(moment(var_hourin1,"HH:mm")); ms1 = ms1 <= 0 ? 0 : ms1; //desconsidera valores negativos caso a hora saida nao esteja preenchida ainda
	var ms2 = moment(var_hourout2,"HH:mm").diff(moment(var_hourin2,"HH:mm")); ms2 = ms2 <= 0 ? 0 : ms2; //desconsidera valores negativos caso a hora saida nao esteja preenchida ainda
	var ms3 = moment(var_hourout3,"HH:mm").diff(moment(var_hourin3,"HH:mm")); ms3 = ms3 <= 0 ? 0 : ms3; //desconsidera valores negativos caso a hora saida nao esteja preenchida ainda
	var ms4 = moment(var_hourout4,"HH:mm").diff(moment(var_hourin4,"HH:mm")); ms4 = ms4 <= 0 ? 0 : ms4; //desconsidera valores negativos caso a hora saida nao esteja preenchida ainda
	var ms5 = moment(var_hourout5,"HH:mm").diff(moment(var_hourin5,"HH:mm")); ms5 = ms5 <= 0 ? 0 : ms5; //desconsidera valores negativos caso a hora saida nao esteja preenchida ainda
	var ms6 = moment(var_hourout6,"HH:mm").diff(moment(var_hourin6,"HH:mm")); ms6 = ms6 <= 0 ? 0 : ms6; //desconsidera valores negativos caso a hora saida nao esteja preenchida ainda
	
	var msi1 = moment(var_intervalo1,"HH:mm").diff(moment("00:00","HH:mm")); 
	var msi2 = moment(var_intervalo2,"HH:mm").diff(moment("00:00","HH:mm")); 
	var msi3 = moment(var_intervalo3,"HH:mm").diff(moment("00:00","HH:mm")); 
	var msi4 = moment(var_intervalo4,"HH:mm").diff(moment("00:00","HH:mm")); 
	var msi5 = moment(var_intervalo5,"HH:mm").diff(moment("00:00","HH:mm")); 
	var msi6 = moment(var_intervalo6,"HH:mm").diff(moment("00:00","HH:mm")); 
	

	var ms_somaTrabalho = ms1+ms2+ms3+ms4+ms5+ms6;
	var ms_somaIntervalo = msi1+msi2+msi3+msi4+msi5+msi6;
	
	
	
	//só vai considerar o intervalo, se houver algum trabalho
	var ms_diffTrabalhoIntervalo = ms_somaTrabalho > 0 ? ms_somaTrabalho - ms_somaIntervalo : 0;	
	  
	var momentData = moment.duration(ms_diffTrabalhoIntervalo);	

	var resultGeral = Math.floor(momentData.asHours()) + ":" + moment.utc(ms_diffTrabalhoIntervalo).format("mm");	
	
	$("#labelHorasTrabalhadas").html(resultGeral + " Horas trabalhadas. <br><br>");


	//preenche os minutos trabalhados em cada dia no campo hidden dadosDia1x
	var momentDataDia1 = moment.duration(ms1-msi1);	
	var resultDia1 = Math.floor(momentDataDia1.asMinutes());		
	$("#dadosDia1").attr("minutos", resultDia1);
	
	var momentDataDia2 = moment.duration(ms2-msi2);	
	var resultDia2 = Math.floor(momentDataDia2.asMinutes());		
	$("#dadosDia2").attr("minutos", resultDia2);
	
	var momentDataDia3 = moment.duration(ms3-msi3);	
	var resultDia3 = Math.floor(momentDataDia3.asMinutes());		
	$("#dadosDia3").attr("minutos", resultDia3);
	
	var momentDataDia4 = moment.duration(ms4-msi4);	
	var resultDia4 = Math.floor(momentDataDia4.asMinutes());		
	$("#dadosDia4").attr("minutos", resultDia4);
	
	var momentDataDia5 = moment.duration(ms5-msi5);	
	var resultDia5 = Math.floor(momentDataDia5.asMinutes());		
	$("#dadosDia5").attr("minutos", resultDia5);
	
	var momentDataDia6 = moment.duration(ms6-msi6);	
	var resultDia6 = Math.floor(momentDataDia6.asMinutes());		
	$("#dadosDia6").attr("minutos", resultDia6);
	//preenche os minutos trabalhados em cada dia no campo hidden dadosDia1x
	
	
	$('.selectEquipe').trigger('change');
	
	
	
	
	
	}



	$('#hourin1').timepicker({ timeFormat: 'HH:mm' , change: trataCampoHorasDeServico });	
	$('#hourout1').timepicker({ timeFormat: 'HH:mm'  , change: trataCampoHorasDeServico });

	$('#hourin2').timepicker({ timeFormat: 'HH:mm'  , change: trataCampoHorasDeServico });
	$('#hourout2').timepicker({ timeFormat: 'HH:mm'  , change: trataCampoHorasDeServico });

	$('#hourin3').timepicker({ timeFormat: 'HH:mm'  , change: trataCampoHorasDeServico });
	$('#hourout3').timepicker({ timeFormat: 'HH:mm'  , change: trataCampoHorasDeServico });

	$('#hourin4').timepicker({ timeFormat: 'HH:mm'  , change: trataCampoHorasDeServico });
	$('#hourout4').timepicker({ timeFormat: 'HH:mm'  , change: trataCampoHorasDeServico });

	$('#hourin5').timepicker({ timeFormat: 'HH:mm'  , change: trataCampoHorasDeServico });
	$('#hourout5').timepicker({ timeFormat: 'HH:mm'  , change: trataCampoHorasDeServico });
	
	$('#hourin6').timepicker({ timeFormat: 'HH:mm'  , change: trataCampoHorasDeServico });
	$('#hourout6').timepicker({ timeFormat: 'HH:mm' , change: trataCampoHorasDeServico  });
	
	$('#intervalo1').timepicker({ timeFormat: 'HH:mm',minTime: '00:15',  maxHour: 05,  interval: 15  , change: trataCampoHorasDeServico });
	$('#intervalo2').timepicker({ timeFormat: 'HH:mm',minTime: '00:15',  maxHour: 05,  interval: 15  , change: trataCampoHorasDeServico });
	$('#intervalo3').timepicker({ timeFormat: 'HH:mm',minTime: '00:15',  maxHour: 05,  interval: 15  , change: trataCampoHorasDeServico });
	$('#intervalo4').timepicker({ timeFormat: 'HH:mm',minTime: '00:15',  maxHour: 05,  interval: 15  , change: trataCampoHorasDeServico });
	$('#intervalo5').timepicker({ timeFormat: 'HH:mm',minTime: '00:15',  maxHour: 05,  interval: 15  , change: trataCampoHorasDeServico });
	$('#intervalo6').timepicker({ timeFormat: 'HH:mm',minTime: '00:15',  maxHour: 05,  interval: 15  , change: trataCampoHorasDeServico });

	
	$('#reporttempodeslocamentototal').timepicker({ timeFormat: 'HH:mm'  , minTime: '00:30', change: trataCampoTempoDeDeslocamento   });





  $(function() {
   

	
	
	
	 $("#reportdata").datepicker({
        dateFormat: 'dd/mm/yy',
        dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'],
        dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
        dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
        monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
        monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez']
    });
	$("#reportdata1").datepicker({
        dateFormat: 'dd/mm/yy',
        dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'],
        dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
        dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
        monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
        monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez']
    });
	$("#reportdata2").datepicker({
        dateFormat: 'dd/mm/yy',
        dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'],
        dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
        dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
        monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
        monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez']
    });
	$("#reportdata3").datepicker({
        dateFormat: 'dd/mm/yy',
        dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'],
        dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
        dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
        monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
        monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez']
    });
	$("#reportdata4").datepicker({
        dateFormat: 'dd/mm/yy',
        dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'],
        dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
        dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
        monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
        monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez']
    });
	
	$("#reportdata5").datepicker({
        dateFormat: 'dd/mm/yy',
        dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'],
        dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
        dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
        monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
        monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez']
    });
	$("#reportdata6").datepicker({
        dateFormat: 'dd/mm/yy',
        dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'],
        dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
        dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
        monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
        monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez']
    });
	
	
	$("#pagamento1").datepicker({
        dateFormat: 'dd/mm/yy',
        dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'],
        dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
        dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
        monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
        monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez']
    });
	$("#pagamento2").datepicker({
        dateFormat: 'dd/mm/yy',
        dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'],
        dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
        dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
        monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
        monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez']
    });
	$("#pagamento3").datepicker({
        dateFormat: 'dd/mm/yy',
        dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'],
        dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
        dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
        monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
        monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez']
    });
	$("#pagamento4").datepicker({
        dateFormat: 'dd/mm/yy',
        dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'],
        dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
        dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
        monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
        monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez']
    });
	$("#pagamento5").datepicker({
        dateFormat: 'dd/mm/yy',
        dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'],
        dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
        dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
        monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
        monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez']
    });
	$("#pagamento6").datepicker({
        dateFormat: 'dd/mm/yy',
        dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'],
        dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
        dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
        monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
        monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez']
    });
	$("#pagamento7").datepicker({
        dateFormat: 'dd/mm/yy',
        dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'],
        dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
        dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
        monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
        monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez']
    });
	$("#pagamento8").datepicker({
        dateFormat: 'dd/mm/yy',
        dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'],
        dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
        dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
        monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
        monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez']
    });
	
  });
  

	  
	$( "#zerarpagamentos" ).click(function() {
	  $("#pagamento1").val("");
	  $("#pagamento2").val("");
	  $("#pagamento3").val("");
	  $("#pagamento4").val("");
	  $("#pagamento5").val("");
	  $("#pagamento6").val("");
	  $("#pagamento7").val("");
	  $("#pagamento8").val("");
	});
	  
	  $( "#zerardatas" ).click(function() {
	  $("#reportdata1").val("");
	  $("#reportdata2").val("");
	  $("#reportdata3").val("");
	  $("#reportdata4").val("");
	  $("#reportdata5").val("");
	  $("#reportdata5").val("");
	  $("#hourin1").val("");
	  $("#hourin2").val("");
	  $("#hourin3").val("");
	  $("#hourin4").val("");
	  $("#hourin5").val("");
	  $("#hourin6").val("");
	  $("#hourout1").val("");
	  $("#hourout2").val("");
	  $("#hourout3").val("");
	  $("#hourout4").val("");
	  $("#hourout5").val("");
	  $("#hourout6").val("");
	  $("#intervalo1").val("");
	  $("#intervalo2").val("");
	  $("#intervalo3").val("");
	  $("#intervalo4").val("");
	  $("#intervalo5").val("");
	  $("#intervalo6").val("");
	  
	  trataCampoHorasDeServico();
	  
	});
  
  
  
  //adicionar defeito
	$( "#reportadddefect" ).click(function() {
		
	});

	$("#reportcleardefects").click(function(){
		$("#reportselecteddefects").val("");

	});

	
		var editou_reportsolicitante = false;
		$("#reportsolicitante").on('change', function() { 
			editou_reportsolicitante = true;
		});
		
		var editou_reportdata1 = false;		
		$("#reportdata1").on('change', function() { 
			editou_reportdata1 = true;
		});
		
	
		function trataBotaoOKEdicao(){		
			$('#btnEdit').on('click',function (){

						//alert(editou_reportdata1);
						//alert(editou_reportsolicitante);
				$('#btnEdit').attr('disabled', 'disabled');
				if(!validaCampos()){$('#btnEdit').removeAttr('disabled'); return;}	
					var quantidade_de_pagamentos = 0;
					$( ".pagamento" ).each(function(  ) {
						if($( this ).val() != ""){
							
							quantidade_de_pagamentos++;
						}
					});
				
				//if(!validaCampos()){return;}		
			
				var infodetalhada = $("#mostrarDetalhado").is(':checked') == true ? "1" : "0";
				var infocustoextra = $("#mostrarCustoExtra").is(':checked') == true ? "1" : "0";
				$.ajax({
					//pagina onde está o ajax
					url: 'ajax/ajaxProjeto.php',
					async: true,
					type: 'post',
					
					//dados do get
					data: {
					funcao : "editarelatorio"	,							
					codigo : '<?echo $_GET['edit']; ?>',
					descCli : $("#reportempresa").val(),
					codCli : $("#codCli").val(),
					reportdata : $("#reportdata").val(), 
					reportmaquina : $("#reportmaquina").val(), 
					reportnummaquina : $("#reportnummaquina").val(), 
					reportmodelomaquina  : $("#reportmodelomaquina").val(), 
					reportpedidocliente : $("#reportpedidocliente").val(), 
					reportselecteddefects  : $("#reportselecteddefects").val(), 
					reportvalor : $("#reportvalor").val(), 
					reportsolucao : $("#reportsolucao").val(),
					reportdesccustoextra : $("#reportdesccustoextra").val(),
					
					reportsolicitante : $("#reportsolicitante").val(),
					reportgarantia : $("#reportgarantia").val(),
					reportkm : $("#reportkm").val(),
					reportdata1 : $("#reportdata1").val(),
					reportdata2 : $("#reportdata2").val(),
					reportdata3 : $("#reportdata3").val(),
					reportdata4 : $("#reportdata4").val(),
					reportdata5 : $("#reportdata5").val(),
					reportdata6 : $("#reportdata6").val(),
					hourin1 : $("#hourin1").val(),
					hourin2 : $("#hourin2").val(),
					hourin3 : $("#hourin3").val(),
					hourin4 : $("#hourin4").val(),
					hourin5 : $("#hourin5").val(),
					hourin6 : $("#hourin6").val(),
					hourout1 : $("#hourout1").val(),
					hourout2 : $("#hourout2").val(),
					hourout3 : $("#hourout3").val(),
					hourout4 : $("#hourout4").val(),
					hourout5 : $("#hourout5").val(),
					hourout6 : $("#hourout6").val(),
					intervalo1 : $("#intervalo1").val(),
					intervalo2 : $("#intervalo2").val(),
					intervalo3 : $("#intervalo3").val(),
					intervalo4 : $("#intervalo4").val(),
					intervalo5 : $("#intervalo5").val(),
					intervalo6 : $("#intervalo6").val(),
					
					tempodeslocamento : $("#reporttempodeslocamentototal").val(),
					 
					
					equipe1 : $("#equipe1").val(),
					equipe2 : $("#equipe2").val(),
					equipe3 : $("#equipe3").val(),
					equipe4 : $("#equipe4").val(),
					equipe5 : $("#equipe5").val(),
					equipe6 : $("#equipe6").val(),
					
					prazoPagamento : $("#prazoPagamento").val(),
					
					reporthoratecnicatotal : $("#reporthoratecnicatotal").val(), 
					reportcustodeslocamento : $("#reportcustodeslocamento").val(),

					reportcustotempodedeslocamento : $("#reportcustotempodedeslocamento").val(), 
					
					reportcustorefeicao : $("#reportcustorefeicao").val(), 
					reportcustohospedagem : $("#reportcustohospedagem").val(), 
					reportcustopecas : $("#reportcustopecas").val(), 
					reportcustoextra : $("#reportcustoextra").val(), 
					reportdesconto : $("#reportdesconto").val(), 
						
					
					informacoesDetalhadas : infodetalhada,
					informacoesCustoExtra : infocustoextra,
					
					
					reportobsprivada : $("#reportobsprivada").val(),
					
					//pagamento1 : $("#pagamento1").val(),
					//pagamento2 : $("#pagamento2").val(),
					//pagamento3 : $("#pagamento3").val(),
					//pagamento4 : $("#pagamento4").val(),
					//pagamento5 : $("#pagamento5").val(),
					//pagamento6 : $("#pagamento6").val(),
					//pagamento7 : $("#pagamento7").val(),
					//pagamento8 : $("#pagamento8").val(),
					//quantidadeDePagamentos : quantidade_de_pagamentos,
						},
						//retorno 
					success: function(response) {
					//$("#reportsolucao").val(response);
					//return;
					if($.trim(response) == "OK"){
						$('#reportUpdateOK').modal('show').on('hidden.bs.modal', function () {
							location.href='./reports.php';
						});
					}else{alert(response);}
						
						
						
						}
					}); 
				});
		}
	
	
	function abreModalAssinatura(){
		
		$('#AssOKModal').modal('show').on('hidden.bs.modal', function () {
										parent.location.href='./reports.php';
									});
	}
	
	
	function trataBotaoApagarDataDePagamento(){
		
		
		$('#cleanpagamento1').on('click', function(){
			
			$("#pagamento1").val('');
			
		});
		$('#cleanpagamento2').on('click', function(){
			
			$("#pagamento2").val('');
			
		});
		$('#cleanpagamento3').on('click', function(){
			
			$("#pagamento3").val('');
			
		});
		$('#cleanpagamento4').on('click', function(){
			
			$("#pagamento4").val('');
			
		});
		////////////////////////////////////////
		
		$('#cleandata1').on('click', function(){
			
			$("#reportdata1").val('');
			
		});
		
		
		
		
		$('#cleandata2').on('click', function(){
			
			$("#reportdata2").val('');
			
		});
		$('#cleandata3').on('click', function(){
			
			$("#reportdata3").val('');
			
		});
		$('#cleandata4').on('click', function(){
			
			$("#reportdata4").val('');
			
		});
		$('#cleandata5').on('click', function(){
			
			$("#reportdata5").val('');
			
		});
		$('#cleandata6').on('click', function(){
			
			$("#reportdata6").val('');
			
		});
		
		
		
		
		///////////
		$('#cleanhourin1').on('click', function(){
			
			$("#hourin1").val('');
			
		});
		$('#cleanhourout1').on('click', function(){
			
			$("#hourout1").val('');
			
		});
		$('#cleanintervalo1').on('click', function(){
			
			$("#intervalo1").val('');
			
		});
		
		
		$('#cleanhourin2').on('click', function(){
			
			$("#hourin2").val('');
			
		});
		$('#cleanhourout2').on('click', function(){
			
			$("#hourout2").val('');
			
		});
		$('#cleanintervalo2').on('click', function(){
			
			$("#intervalo2").val('');
			
		});
		
		$('#cleanhourin3').on('click', function(){
			
			$("#hourin3").val('');
			
		});
		$('#cleanhourout3').on('click', function(){
			
			$("#hourout3").val('');
			
		});
		$('#cleanintervalo3').on('click', function(){
			
			$("#intervalo3").val('');
			
		});
		
		$('#cleanhourin4').on('click', function(){
			
			$("#hourin4").val('');
			
		});
		$('#cleanhourout4').on('click', function(){
			
			$("#hourout4").val('');
			
		});
		$('#cleanintervalo4').on('click', function(){
			
			$("#intervalo4").val('');
			
		});
		
		$('#cleanhourin5').on('click', function(){
			
			$("#hourin5").val('');
			
		});
		$('#cleanhourout5').on('click', function(){
			
			$("#hourout5").val('');
			
		});
		$('#cleanintervalo5').on('click', function(){
			
			$("#intervalo5").val('');
			
		});
		
		$('#cleanhourin6').on('click', function(){
			
			$("#hourin6").val('');
			
		});
		$('#cleanhourout6').on('click', function(){
			
			$("#hourout6").val('');
			
		});
		$('#cleanintervalo6').on('click', function(){
			
			$("#intervalo6").val('');
			
		});
		
			$('#cleanreporttempodeslocamentototal').on('click', function(){
			
			$("#reporttempodeslocamentototal").val('');
			
		});
		
		
	$('#cleanreporttempodeslocamentototal').on('click', function(){
			
			trataCampoTempoDeDeslocamento();
			
		});
		
		
		$('.btnSetaClean').on('click', function(){
			
			trataCampoHorasDeServico();
			
		});
		
	}
	
	</script>