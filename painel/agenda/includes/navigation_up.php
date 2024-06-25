<?php 
//echo "<pre>".print_r($_SESSION)."</pre>";
require_once 'functions.php';  

//echo isLoggedIn(); die();
if (isLoggedIn() == 'false') 
{  
    echo '<meta http-equiv="refresh" content="0; url=../index.php">'; die();
}


?>
 
  <header class="header dark-bg">
            <!--div class="toggle-nav">
                <div class="icon-reorder tooltips" id="btnMenu" data-original-title="Menu" data-placement="bottom"><i class="icon_menu"></i></div>
            </div-->

            <a href="index.php" class="logo"><img src="./img/favicon.ico" style="width: 30px;     margin-right: 8px;" />Agenda</a>
			
			
            <!--logo start-->
            <!--logo end-->

         

            <div class="top-nav notification-row">                
                <!-- notificatoin dropdown start-->
                <ul class="nav pull-right top-menu">
                    
                    <!-- task notificatoin start -->
                    
                    <!-- alert notification end-->
                    <!-- user login dropdown start-->
                    
					
					  
					
                    <!-- user login dropdown end -->
                </ul>
                <!-- notificatoin dropdown end-->
            </div>
      </header>      
      <!--header end-->