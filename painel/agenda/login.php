


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" 		content="width=device-width, initial-scale=1.0">
    <meta name="description" 	content="Sistema para Inclusão de Pedidos em Feiras Externas - KATIVA STORE">
    <meta name="author"    		content="Danna Sistemas - (47) 992 297 331">     
	<meta name="copyright" 		content="Kativa Store" />
	<meta name="Publisher" 		content="Danna Sistemas - (47) 992 297 331 " />
	<link rel="shortcut icon" href="img/favicon.ico">

    <title>Login | Agenda DannaDev</title>

    <!-- Bootstrap CSS -->    
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- bootstrap theme -->
    <link href="css/bootstrap-theme.css" rel="stylesheet">
    <!--external css-->
    <!-- font icon -->
    <link href="css/elegant-icons-style.css" rel="stylesheet" />
    <link href="css/font-awesome.css" rel="stylesheet" />
    <!-- Custom styles -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/style-responsive.css" rel="stylesheet" />

                    
</head>

  <body class="login-img3-body">

    <div class="container">

      <form class="login-form" method="post"  action="logar.php">        
        <div class="login-wrap">
			<div >
				<a href="login.php" style="    margin-left: 15px;" class="logo"><center>Agenda<span style="color: black;">DannaDev<span><span class="lite" style="font-size: 15px !important;"></span></center></a>
				  <p class="login-img"><i class="icon_lock_alt" style="color: #6a8cdc;"></i></p>
			</div>
			
			
          
            <div class="input-group">
              <span class="input-group-addon"><i class="icon_profile"></i></span>
              <input type="text" name="usuario" id="usuario" placeholder="Usuário"	class="form-control">
            </div>
            <div class="input-group">
                <span class="input-group-addon"><i class="icon_key_alt"></i></span>
                <input  type="password" name="senha" placeholder="Senha"  class="form-control" >
            </div>
           <div style="text-align:center;">
				<?php
					if(isset($_GET['err'] ) && $_GET['err'] == "err"){
						echo '<span style="color: #00716f; font-weight: 700;">Usuário ou senha incorreta!!! </span>';
					}
					if(isset($_GET['err'] ) && $_GET['err'] == "db"){
						echo '<span style="color: #00716f; font-weight: 700;">O Serviço de Banco de Dados não está ativo!<br>Favor Reiniciar os serviços! </span>';
					}
					
				?> 
				</div> 
				</br>
            <button class="btn btn-primary btn-lg btn-block" style="background-color: #425d9a; border-color: #000; " type="submit">Login</button>
			<br><a href="http://dannadev.com.br/" target="_blank" <div><img src="./img/danna.png"  style="width: 40px; " title="Danna Sistemas - (47) 992 297 331"/><span style="font-size:12px;">by Danna Dev<span> </div></a>
        </div>
      </form>
  
    </div>


  </body>
  
  
</html>

