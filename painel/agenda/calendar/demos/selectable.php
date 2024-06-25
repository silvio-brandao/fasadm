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
  	

?>

<!DOCTYPE html>
<html>
<head>
<style>

.fc-day-header { color:dimgrey; }  
.fc-sun { color:#ff4d4d; } 
.fc-sat { color:#ff4d4d; }  
.fc-today { color:#3f4dff; } 



-- #calendar.agenda-week .fc-day[data-date="2017-04-09"] {background-color:black;} 
</style>


<link href='../fullcalendar.min.css' rel='stylesheet' />
<link href='../fullcalendar.print.min.css' rel='stylesheet' media='print' />
<script src='../lib/moment.min.js'></script>
<script src='../lib/jquery.min.js'></script>
<script src='../fullcalendar.min.js'></script>
<script src='../locale/pt-br.js'></script>





<script>

	$(document).ready(function() {
		
		$('#calendar').fullCalendar({
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay'
			},
			defaultDate: '<?php echo DATE('Y-m-d'); ?>',
			navLinks: true, // can click day/week names to navigate views
			selectable: true,
			ignoreTimezone : false,
			allDaySlot: false,
			selectHelper: true,
			slotMinutes: 30,
			defaultView: 'agendaWeek',	
			contentHeight: 1180,
			eventResize: function(event, delta, revertFunc) {

					var dateEnd = new Date(event.end.toString());
					dateEnd.setHours(dateEnd.getHours() + 3); // Adiciona 3horas
				
					$.ajax({
							//pagina onde está o ajax
								url: '../../ajax/ajaxProjeto.php',   
								async: true,
								type: 'post',
							
							//dados do get
							data: {
								funcao : "resizeAgendamento",								
								dataFim : getFormattedDate(dateEnd),								
								horaFim : getHour(dateEnd.getHours())+":"+ getMinutes(dateEnd.getMinutes()),
								id : event.id
							},
							//retorno 
							success: function(response) {
								//alert(response);
								//parent.location.reload();
							}
							}); 

				},
				
				eventDrop: function(event, delta, revertFunc) {

					var dateStart = new Date(event.start.toString());
					dateStart.setHours(dateStart.getHours() + 3); // Adiciona 3horas
				
					var dateEnd = new Date(event.end.toString());
					dateEnd.setHours(dateEnd.getHours() + 3); // Adiciona 3horas
				
					$.ajax({
							//pagina onde está o ajax
								url: '../../ajax/ajaxProjeto.php',   
								async: true,
								type: 'post',
							
							//dados do get
							data: {
								funcao : "dragDropEvent",								
								dataInicio : getFormattedDate(dateStart),								
								horaInicio: getHour(dateStart.getHours())+":"+ getMinutes(dateStart.getMinutes()),
								dataFim : getFormattedDate(dateEnd),								
								horaFim : getHour(dateEnd.getHours())+":"+ getMinutes(dateEnd.getMinutes()),
								
								id : event.id
							},
							//retorno 
							success: function(response) {
								//alert(response);
								//parent.location.reload();
							}
							}); 

				},
			
			 	select: function( start, end, id) {
					var contador = 0;
				 parent.$(".addDataEvent").modal('show').on("hidden.bs.modal", function () {
					 
					 parent.location.reload();
					
					 parent.$("#iframeagenda").remove();
					 //ao dar o hide na moral, retira o evento não cadastrado do calendario
					
					 //$('#calendar').fullCalendar('unselect');
					 
				 }).on('shown.bs.modal', function(){
					//parent.alert(start);
					$("#cliente").val('');
					$("#procedimento").val('');
					var dateStart = new Date(start.toString());
					dateStart.setHours(dateStart.getHours() + 3); // Adiciona 3 horas
					
					
					var dateEnd = new Date(end.toString());
					dateEnd.setHours(dateEnd.getHours() + 3); // Adiciona 3horas
					
					
					parent.$(".horarioinicio").html(getFormattedDate(dateStart)+"  às: "+getHour(dateStart.getHours())+":"+ getMinutes(dateStart.getMinutes()));
					parent.$(".horariofim").html(getFormattedDate(dateEnd)+"  às: "+getHour(dateEnd.getHours())+":"+ getMinutes(dateEnd.getMinutes()));
				 
					parent.$(".confirmaEvento").on('click', function(){
							if(!validaCampos('add')){return;}
							 parent.$(".confirmaEvento").hide(); //para evitar de clicar varias vezes seguidas em confirmar
							 
							$.ajax({
							//pagina onde está o ajax
								url: '../../ajax/ajaxProjeto.php',   
								async: true,
								type: 'post',
							
							//dados do get
							data: {
								funcao : "incluiAgendamento",
								procedimento : parent.$("#procedimento").val(),
								cliente : parent.$("#cliente").val(),
								dataInicio : getFormattedDate(dateStart),
								dataFim : getFormattedDate(dateEnd),
								horaInicio :getHour(dateStart.getHours())+":"+ getMinutes(dateStart.getMinutes()),
								horaFim : getHour(dateEnd.getHours())+":"+ getMinutes(dateEnd.getMinutes()),
								codCli : parent.$("#cliente").attr('codCli'),
								//codProcedimento : parent.$("#procedimento").attr('codProcedimento'),
								//convenio : parent.$("#convenio").val(),
								},
								//retorno 
								success: function(response) {
									
									 parent.location.reload();
									 
								}
							}); 
							
						 });
					 
					 
				});
				
			},
			editable: true,
			eventLimit: true, // allow "more" link when too many events
			
			viewRender: function(view, element){
				
              if(view.name == "agendaWeek"){
                $("#calendar").addClass('agenda-week');             
              }else{
                $("#calendar").removeClass('agenda-week');              
              }},
			  
			  
			  eventMouseover: function(event, jsEvent, view) {
				  
				if (view.name !== 'agendaDay') {
					$(jsEvent.target).attr('title', event.title);
				}
			},
		
			eventClick:  function(event, jsEvent, view) {
				
				
							$.ajax({
							//pagina onde está o ajax
								url: '../../ajax/ajaxProjeto.php',   
								async: true,
								type: 'post',
								dataType: "json",
							//dados do get
							data: {
								funcao : "getEventByidJson",
								id : event.id,
								},
								//retorno 
								success: function(response) {
									//alert(response);
									parent.$(".editEvent").modal('show');
									parent.$("#editcliente").val(response['agenda_cliente']);
									parent.$("#editconvenio").val(response['agenda_convenio']);
									
									parent.$("#editprocedimento").val(response['agenda_procedimento']);
									parent.$("#editcliente").attr('codCliente',response['agenda_cliente_id']);
									parent.$("#editprocedimento").attr('codProcedimento',response['agenda_procedimento_id']);
									
									parent.$(".edithorarioinicio").html(dtoc(response['agenda_data_inicio'])+"  às "+response['agenda_hora_inicio']);
									parent.$(".edithorariofim").html(dtoc(response['agenda_data_fim'])+"  às "+response['agenda_hora_fim']);
									parent.$(".editaEvento").attr('recno', response['id']);
									parent.$(".edittelefone").html(response['CLI_TELEFONE']);
									parent.$(".editemail").html(response['CLI_EMAIL']);
									parent.$(".excluiEvento").attr('recno', response['id']);
									parent.$(".excluiEvento").attr('cliente', response['agenda_cliente']);
									parent.$(".excluiEvento").attr('procedimento', response['agenda_procedimento']);
									
									 parent.$(".editEvent").modal('show').on("hidden.bs.modal", function () {
									 
									  parent.location.reload();
									   
									   parent.$("#iframeagenda").remove();
									
									 //ao dar o hide na moral, retira o evento não cadastrado do calendario
									
									 //$('#calendar').fullCalendar('unselect');
									 
								 }).on('shown.bs.modal', function(){
									 
									  parent.$(".editaEvento").on('click', function(){
										
											if(!validaCampos('edit')){return;}	
											$.ajax({
											//pagina onde está o ajax
												url: '../../ajax/ajaxProjeto.php',   
												async: true,
												type: 'post',
											
											//dados do get
											data: {
												funcao : "editaAgendamento",
												procedimento : parent.$("#editprocedimento").val(),
												cliente : parent.$("#editcliente").val(),
												codCli : parent.$("#editcliente").attr('codcliente'),
												recno : event.id
												},
												//retorno 
												success: function(response) {
													
													parent.location.reload(); 
													parent.$("#iframeagenda").remove();
													  
													
												}
											}); 
									 });
									 
									 
									 
									 
									 
									
										   
										   
										   
									 
									  parent.$(".excluiEvento").on('click', function(){
								
										parent.$(".confirmaExclusaobtn").css('display', 'inline-block');
										parent.$('.excluiCompilacaoModal').modal('show').on("hidden.bs.modal", function () {
											
											parent.location.reload();
											parent.$("#iframeagenda").remove();
													  
											 
											
										});
										parent.$("#myModalLabelExcluir").html("Excluir o agendamento de "+$(this).attr('procedimento')+" do cliente "+$(this).attr('cliente')+" ?");
										parent.$(".confirmaExclusaobtn").attr("codigo", $(this).attr('recno'));
										parent.$(".editEvent").css('display', 'none');
										
										parent.$('.confirmaExclusaobtn').on('click',function (){
											$.ajax({
											//pagina onde está o ajax
											url: '../../ajax/ajaxProjeto.php',
											async: true,
											type: 'post',
											
											//dados do get
											data: {
												funcao : "excluiAgenda",
												codigo : $(this).attr("codigo"),
												
												},
												//retorno 
											success: function(response) {
												
												
												if(response == "1"){
													 parent.location.reload();
													 parent.$("#iframeagenda").remove();
												
												}else{alert(response+"!");}
												
												}					
											}); 
										}); 
									 });
									 
								 });
								}
							}); 
				
			},
			events: [
			
			<?php

			

$query = "Select * from tb_agenda";

//echo $query; die();
$resultado = $mysqli->query($query); 
		
		if(mysqli_num_rows($resultado) > 0)
		{  	
			while($row = $resultado->fetch_array())
			{
				
				echo "{
					id: '".$row['id']."',
					title: '".$row['agenda_cliente']." - ".$row['agenda_procedimento']."',
					start: '".ctod($row['agenda_data_inicio'])."T".$row['agenda_hora_inicio']."',
					end: '".ctod($row['agenda_data_fim'])."T".$row['agenda_hora_fim']."',
					cliente: '".$row['agenda_cliente']."',
					color  : '#000',
					},";
				
			}
		}
				?>
				 
				
			],
			//eventColor: '#378006',
		});
		
	});

	

		
	function validaCampos(tipo){
			if(tipo == 'add'){
				var validado = true;
				
								
				parent.$("#cliente").css('border-color', '');			
				//parent.$("#procedimento").css('border-color', '');
				
				
				
				if($.trim(parent.$("#cliente").val()) == ""){
					
					parent.$("#cliente").css('border-color', 'red');
					validado = false;
				}
			    //if($.trim(parent.$("#procedimento").val()) == ""){
					
				//	parent.$("#procedimento").css('border-color', 'red');
				//	validado = false;
				//}
			
				
				
				if(!validado){return false;}else{return true};
		
				
				
			}
			
			if(tipo == 'edit'){
				
				var validado = true;
				
								
				parent.$("#editcliente").css('border-color', '');			
				parent.$("#editprocedimento").css('border-color', '');
				
				
				
				if($.trim(parent.$("#editcliente").val()) == ""){
					
					parent.$("#editcliente").css('border-color', 'red');
					validado = false;
				}
				if($.trim(parent.$("#editprocedimento").val()) == ""){
					
					parent.$("#editprocedimento").css('border-color', 'red');
					validado = false;
				}
			
				
				
				if(!validado){return false;}else{return true};
		
				
				
			}
				
	}
	
	
	function getHour(hour){
		
			
		
		if(hour < 10){
			
			return "0"+hour;
		
		}else{ 
			
			return hour;
		
		}
		
		
	}
	
	function  getMinutes(minutes){
		
		if(minutes == 0){
			
			return "00";
		}else{return minutes;}
		
	}
	
	function dtoc(data)
			{
			 
				datafmt = data.substring(6,8) + '/' + data.substring(4,6) + '/' + data.substring(0,4);
			 
				return datafmt;
			}
			
	function getFormattedDate(date) {
	  var year = date.getFullYear();
	  var month = (1 + date.getMonth()).toString();
	  month = month.length > 1 ? month : '0' + month;
	  var day = date.getDate().toString();
	  day = day.length > 1 ? day : '0' + day;
	  return day + '/' +  month+ '/' + year;
	}
	
	function getFormattedDate2(date) {
	  var year = date.getFullYear();
	  var month = (1 + date.getMonth()).toString();
	  month = month.length > 1 ? month : '0' + month;
	  var day = date.getDate().toString();
	  day = day.length > 1 ? day : '0' + day;
	  return year  + '-' +  month+ '-' + day;
	}
	
	
	//$('#calendar.agenda-week .fc-day[data-date="2017-04-09"]').css('background-color', 'black');
	
</script>
<style>

	body {
		//margin: 40px 10px;
		padding: 0;
		font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
		font-size: 14px;
	}

	#calendar {
		max-width: 100%;
		margin: 0 auto;
	}

</style>
</head>
<body>

	<div id='calendar'></div>

</body>
</html>
<?php 

function ctod($data)
	{
	  if(trim($data) <> ''){
		$datafmt = substr($data,0,4) . '-' . substr($data,4,2) . '-' . substr($data,6,2);
	  }else{
		$datafmt = '';
	  }
	  return $datafmt;
	}

?>