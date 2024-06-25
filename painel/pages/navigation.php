<?if(empty($_SESSION)){
	session_start();
}  
require_once 'functions.php';  

//echo isLoggedIn(); die();
if (isLoggedIn() == 'false') 
{  
    echo '<meta http-equiv="refresh" content="0; url=../index.php">'; die();
} 



$usuario =	$_SESSION['nome'];
//echo $_SESSION['uid']; die();


$cliente = $_SESSION['cliente'];


 
?><meta http-equiv="X-UA-Compatible" content="IE=edge">
	<nav class="navbar navbar-default navbar-static-top"  role="navigation" style="margin-bottom: 0; background: linear-gradient(to right, #e7e7e7 ,#F4F7FD) !important;">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only">Menu</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="index.php">FAS Manutenção 3.0 <span style="font-size:  11px; color:red"></span></a>
		</div>
			
		<!-- /.navbar-header -->

		<ul class="nav navbar-top-links navbar-right">
			
			<li class="dropdown" style="    margin-right: 150px;">
			
			</li>			
			<!-- /.dropdown -->
			
				
				<? 
				
				if($_SESSION['permissao'] == '1' || $_SESSION['permissao'] == '3'){
				?>
				<li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" href="#" title="Cadastrar">
					<i class="fa fa-paste fa-fw"></i>  <i class="fa fa-caret-down"></i>
				</a>
				
					<ul class="dropdown-menu dropdown-user">
						
						<li title="Relatórios"><a href="reports.php"><i class="fa fa-copy fa-fw"  ></i> Relatórios</a>
						</li>				
						<li title="Novo Relatório"><a href="addreports.php"><i class="fa fa-copy fa-fw"  ></i> Novo Relatório</a>
						</li>
						<li title="Novo Orçamento"><a href="addOrcamento.php"><i class="fa fa-copy fa-fw"  ></i> Novo Orçamento</a>
						</li>
						<li title="Novo Cliente"><a href="addclient.php"><i class="fa fa-group fa-fw"  ></i> Novo Cliente</a>
						</li>
							
						
					</ul>
					</li>
				<?
				}
				?>
				
			<!-- /.dropdown -->
			<li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" href="#">
					<i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
				</a>
				<ul class="dropdown-menu dropdown-user">
					<li>
						<div class="alert alert-success">
							<? 
							if($_SESSION['permissao'] == '1' || $_SESSION['permissao'] == '3'){
								echo $usuario; 
							}
							else{
								echo $cliente;
							}?>
						</div>
					</li>
					<? 
				//session_start();
				if($_SESSION['permissao'] == '1' || $_SESSION['permissao'] == '3' /*Pegadinha, o 3 não consegue entrar nesta pagina*/){
				?>
				<li><a href="users.php"><i class="fa fa-user fa-fw"></i> Perfis de Usuário</a>
				</li>
				<ul class="nav nav-second-level">
					<li>
						<a href="adduser.php"  style="margin-left: 44px;"  ><i class="fa fa-user fa-fw"></i> Adicionar </a>
					</li>
				</ul>					
					
				<?
				}
				?>
					
					<li class="divider"></li> 
					<li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Sair</a>
					</li>
				</ul>
				<!-- /.dropdown-user -->
			</li>
			<!-- /.dropdown -->
		</ul>
		<!-- /.navbar-top-links -->

		<div class="navbar-default sidebar" role="navigation">
			<div class="sidebar-nav navbar-collapse">
				<ul class="nav" id="side-menu">
					<? 
					
					if($_SESSION['permissao'] != '2' ){
					?>
					<li>
						<a href="index.php"><i class="fa fa-dashboard fa-fw"></i> Painel</a>
					</li>
					<? 
					}
					if($_SESSION['permissao'] == '1' || $_SESSION['permissao'] == '3'){
					?>
					<li>
						<a href="#"><i class="fa fa-list-alt fa-fw"></i> Menu<span class="fa arrow"></span></a>
						<ul class="nav nav-second-level">
							
							<li>
								<a href="reports.php">Relatórios</a>
							</li>
							<li>
								<a href="clients.php">Clientes</a>
							</li>
							
							<? 					
							if($_SESSION['permissao'] == '1' || $_SESSION['permissao'] == '3'){
							?>
							<li>
								<a href="orcamentos.php">Orçamentos</a>
							</li>
							<?}?>
							<? 					
							if($_SESSION['permissao'] == '1'){
							?>
							<li>
								<a href="users.php">Usuários</a>
							</li>
							<?}?>
							
							<? 					
							//if($_SESSION['permissao'] == '1'){
							?>
							<li>
								<a href="../agenda/index.php">Agenda Administrativa</a>
							</li>
							<?//}?>
							
														<? 					
							if($_SESSION['permissao'] == '1'){
							?>
							<li>
								<a href="configvalores.php">Configurar Valores Padrão</a>
							</li>
							<?}?>
							
							
							
							
							
							<!--li>
								<a href="defects.php">Defeitos/Problemas</a>
							</li-->
							
							 					
							
						
						</ul>
						<!-- /.nav-second-level -->
					</li>
					<?
					}else{
						?>
						
							
								<!--img src="https://stc.pagseguro.uol.com.br/public/img/banners/pagamento/todos_animado_125_150.gif" alt="Logotipos de meios de pagamento do PagSeguro" title="Este site aceita pagamentos com Visa, MasterCard, Diners, American Express, Hipercard, Aura, Elo, PLENOCard, PersonalCard, BrasilCard, FORTBRASIL, Cabal, Mais!, Avista, Grandcard, Sorocred, Bradesco, Itaú, Banco do Brasil, Banrisul, Banco HSBC, saldo em conta PagSeguro e boleto." style="    margin: 10px;"-->
							
						
						<?
						
					}
					?>	
						
				</ul>
			</div>
			<!-- /.sidebar-collapse -->
		</div>
		<!-- /.navbar-static-side -->
	</nav>
