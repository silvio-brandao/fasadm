
<?
session_start();
$usuario =	$_SESSION['nome'];

if(!$_SESSION['uid']){
	echo "<META HTTP-EQUIV='REFRESH' CONTENT='0; URL=../../'>";
	die();
}

if($_GET["sair"] == "sair"){
	session_destroy();
	
	echo "<META HTTP-EQUIV='REFRESH' CONTENT='0; URL=../../'>";
	die();
}
?>
 <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="index.php">FAS Manutenção</a>
		</div>
			
		<!-- /.navbar-header -->

		<ul class="nav navbar-top-links navbar-right">
			
			<li class="dropdown" style="    margin-right: 150px;">
			
			</li>			
			<!-- /.dropdown -->
			<li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" href="#" title="Cadastrar">
					<i class="fa fa-paste fa-fw"></i>  <i class="fa fa-caret-down"></i>
				</a>
				
				
				<ul class="dropdown-menu dropdown-user">
					
					<li title="Novo Relatório"><a href="addreports.php"><i class="fa fa-copy fa-fw"  ></i> Novo Relatório</a>
					</li>
					<li title="Novo Orçamento"><a href="addOrcamento.php"><i class="fa fa-copy fa-fw"  ></i> Novo Orçamento</a>
					</li>
					<li title="Novo Cliente"><a href="addclient.php"><i class="fa fa-group fa-fw"  ></i> Novo Cliente</a>
					</li>
					<li title="Novo Defeito/Problema"><a href="adddefects.php"><i class="fa fa-chain-broken fa-fw"  ></i> Novo Defeito/Problema</a>
					</li>					
					
				</ul>
				<!-- /.dropdown-user -->
			</li>
			<!-- /.dropdown -->
			
			
			<!-- /.dropdown -->
			<li class="dropdown">
				<a class="dropdown-toggle" data-toggle="dropdown" href="#">
					<i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
				</a>
				<ul class="dropdown-menu dropdown-user">
					<li>
						<div class="alert alert-success">
							<? echo $usuario; ?>
						</div>
					</li>
					<li><a href="users.php"><i class="fa fa-user fa-fw"></i> Perfis de Usuário</a>
					</li>
						<ul class="nav nav-second-level">
							<li>
								<a href="adduser.php"  style="margin-left: 44px;"  ><i class="fa fa-user fa-fw"></i> Adicionar </a>
							</li>
						</ul>					
					
					<li class="divider"></li>
					<li><a href="?sair=sair"><i class="fa fa-sign-out fa-fw"></i> Sair</a>
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
					
					<li>
						<a href="reportscçoemts.php"><i class="fa fa-dashboard fa-fw"></i> Pagamentos</a>
					</li>
									
				</ul>
			</div>
			<!-- /.sidebar-collapse -->
		</div>
		<!-- /.navbar-static-side -->
	</nav>
