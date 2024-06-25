<? 
session_start(); 

 

 ?>
 

<!DOCTYPE html>
<html>
 <?php
    
	include("includes/head.php"); 	
?>

  <body>
  
  
   <style> 

.ui-datepicker .ui-datepicker-header{
	
	background-color: #0267d6;
    border-color: blue;
}

.ui-state-default, .ui-widget-content .ui-state-default, .ui-widget-header .ui-state-default {-webkit-border-radius: 22% !important;}

.ui-datepicker .ui-datepicker-prev span, .ui-datepicker .ui-datepicker-next span{cursor: pointer;}
.ui-datepicker .ui-datepicker-prev span, .ui-datepicker .ui-datepicker-next span {cursor:pointer;}

.form-control {margin-top: 5px;}

.btn-primary {margin-top: 5px;}

.calendario{cursor:pointer !important;}

</style>

  
  
  <!-- container section start -->
  <section id="container" class="">
     
      <?php 
		include("includes/navigation_up.php"); 
		include("includes/navigation_left.php"); 
	  ?>
    
      
      <!--main content start-->
	<section id="main-content">
          <section class="wrapper">            
              <!--overview start-->
			  <div class="row">
				
			</div>
          </section>
         
		 	<div class="col-lg-12">
				<section class="panel">
                      <header class="panel-heading" style="text-align:center;">
                          <h3>Pedido <?echo $_GET['pedido'] ?> 
                      </h3></header>
                      <div class="panel-body">
                        <div class="tab-pane">	
							 
							<br><br>
							  
							<button type="button" onclick="window.frames['ficha'].print();"  class="btn btn-success" id="btnEdit" style="margin-left: 8px;">Imprimir Ficha</button>
							<a type="button" href="./visualizar.php?pedido=<?echo $_GET['pedido']; ?>&obs=<?echo $_GET['obs']; ?>"  target="_blank" class="btn btn-success"  style="margin-left: 8px;">Abrir em Nova Aba</a>
							</br></br> 
							<iframe border="0" frameborder="0" scrolling="yes" framespacing="0" name="ficha" src="visualizar.php?pedido=<?echo $_GET['pedido']; ?>&obs=<?echo $_GET['obs']; ?>" width="90%" height="450px" ></iframe> 		
				
						 </div>
					  </div>
                      
				</section>
			</div>
          <?php
				include("includes/footer.php"); 	
			?>  
      </section>
      <!--main content end-->
 
  <!-- container section start -->

		 
		 
      </section>
     

 

  <?php
		include("includes/javascript.php"); 	
	?>  
<script> 

  </body>
</html>
