<? 
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
 
if(!empty($_POST['assinatura'])){	
	
echo "<img src='".$_POST['assinatura']."' width='100%' height='90%' id='imgAssinatura' />
			
			<script>parent.abreModalAssinatura();</script>
	";

$img = file_get_contents($_POST['assinatura'], 'bar'); 
$dataEhora = date("YmdH:i");

file_put_contents('./assinaturas/'.md5("OS_".$_POST['relatorio']."").'_OS_'.$_POST['relatorio'].'_'.str_replace(':', '',  $dataEhora).'.jpg',$img);



$sqlupdate = "UPDATE tb_report SET 
				
	REP_ASSINADO='".$dataEhora."' WHERE REP_CODIGO ='".$_POST['relatorio']."';";

$mysqli->query($sqlupdate);


die();
}
?>

<!doctype html>

<head>
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=0" />
	<script src="lib/jquery/jquery-1.8.2.min.js"></script>
    <style type="text/css">
body {
    margin:0px;
    width:100%;
    height:100%;
    overflow:hidden;
    font-family:Arial;
    /* prevent text selection on ui */
    user-select: none;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    /* prevent scrolling in windows phone */
    -ms-touch-action: none;
    /* prevent selection highlight */
    -webkit-tap-highlight-color: rgba(0,0,0,0);
}
        
.header, .footer{
    position: absolute;
    background-color: #222;
    text-align: center;
}
.header {
    top: 0px;
    left: 0px;
    right: 0px;
    height: 32px;
    padding:6px;
}
.footer {
    bottom: 0px;
    left: 0px;
    right: 0px;
    height: 42px;
    padding:2px;    
}
.title {
    width: auto;
    line-height: 32px;
    font-size: 20px;
    font-weight: bold;
    color: #eee;
    text-shadow: 0px -1px #000;
    padding:0 60px;
}
.navbtn {
    cursor: pointer;
    float:left;
    padding: 6px 10px;
    font-weight: bold;
    line-height: 18px;
    font-size: 14px;
    color: #eee;
    text-shadow: 0px -1px #000;
    border: solid 1px #111;
    border-radius: 4px;
    background-color: #404040;
    box-shadow: 0 0 1px 1px #555,inset 0 1px 0 0 #666;     
}
.navbtn-hover, .navbtn:active {
    color: #222;
    text-shadow: 0px 1px #aaa;
    background-color: #aaa;
    box-shadow: 0 0 1px 1px #444,inset 0 1px 0 0 #ccc;   
}

#content{
    position: absolute;
    top: 44px;
    left: 0px;
    right: 0px;
    bottom: 46px;
    overflow:hidden;
    background-color:#ddd;
}
#canvas{
    cursor:crosshair ;
    background-color:#fff;
}
.palette-case {
    width:260px;
    margin:auto;
    text-align:center;
}
.palette-box {
    float:left;
    padding:2px 6px 2px 6px;
}
.palette {
    border:1px solid #777;
    height:36px;
    width:36px;
}
.
.black{
    background-color:#000;
    border:1px dashed #fff;
}
    </style>
	<script type="text/javascript">
	
var ctx, color = "#000";	

$(document).ready(function () {
	
	// setup a new canvas for drawing wait for device init
    setTimeout(function(){
	   newCanvas();
    }, 1000);
		
	// reset palette selection (css) and select the clicked color for canvas strokeStyle
	$(".palette").click(function(){
		$(".palette").css("border-color", "#777");
		$(".palette").css("border-style", "solid");
		$(this).css("border-color", "#fff");
		$(this).css("border-style", "dashed");
		color = $(this).css("background-color");
		ctx.beginPath();
		ctx.strokeStyle = color;
	});
    
	// link the new button with newCanvas() function
	$("#new").click(function() {
	$("#downloadLnk").text("Confirmar Assinatura");
		newCanvas();
	});
});
var canvas;
// function to setup a new canvas for drawing
function newCanvas(){
	//define and resize canvas
    $("#content").height($(window).height()-10);
    canvas = '<canvas id="canvas" width="'+$(window).width()+'" height="'+($(window).height()-10)+'"></canvas>';
	$("#content").html(canvas);
    
    // setup canvas
	ctx=document.getElementById("canvas").getContext("2d");
	ctx.strokeStyle = color;
	ctx.lineWidth = 2;	
	
	// setup to trigger drawing on mouse or touch
	$("#canvas").drawTouch();
    $("#canvas").drawPointer();
	$("#canvas").drawMouse();
}

// prototype to	start drawing on touch using canvas moveTo and lineTo
$.fn.drawTouch = function() {
	var start = function(e) {
        e = e.originalEvent;
		ctx.beginPath();
		x = e.changedTouches[0].pageX;
		y = e.changedTouches[0].pageY-44;
		ctx.moveTo(x,y);
	};
	var move = function(e) {
		e.preventDefault();
        e = e.originalEvent;
		x = e.changedTouches[0].pageX;
		y = e.changedTouches[0].pageY-44;
		ctx.lineTo(x,y);
		ctx.stroke();
	};
	$(this).on("touchstart", start);
	$(this).on("touchmove", move);	
}; 
    
// prototype to	start drawing on pointer(microsoft ie) using canvas moveTo and lineTo
$.fn.drawPointer = function() {
	var start = function(e) {
        e = e.originalEvent;
		ctx.beginPath();
		x = e.pageX;
		y = e.pageY-44;
		
		ctx.moveTo(x,y);
		
	};
	var move = function(e) {
		e.preventDefault();
        e = e.originalEvent;
		x = e.pageX;
		y = e.pageY-44;
		ctx.lineTo(x,y);
		ctx.stroke();
    };
	$(this).on("MSPointerDown", start);
	$(this).on("MSPointerMove", move);
};        

// prototype to	start drawing on mouse using canvas moveTo and lineTo
$.fn.drawMouse = function() {
	var clicked = 0;
	var start = function(e) {
		clicked = 1;
		ctx.beginPath();
		x = e.pageX;
		y = e.pageY-44;
		ctx.fillRect(x-2 , y-2 , 3 , 3)
		
		ctx.moveTo(x,y);
	};
	var move = function(e) {
		if(clicked){
			x = e.pageX;
			y = e.pageY-44;
			ctx.lineTo(x,y);
			ctx.stroke();
		}
	};
	var stop = function(e) {
		clicked = 0;
	};
	$(this).on("mousedown", start);
	$(this).on("mousemove", move);
	$(window).on("mouseup", stop);
	
	function download() {
	var canvas = document.getElementById('canvas'),
    ctx = canvas.getContext('2d');

    var dt = canvas.toDataURL();
	
	$("#downloadLnk").text("Enviando...");
	$("#assinatura").attr("value", dt);
    //this.href = dt; //this may not work in the future..
}
document.getElementById('downloadLnk').addEventListener('click', download, false);

};
	</script>
</head>
<form method="POST" >
    <div class="header" width="100%" height="350px"> 
		<a id="new" class="navbtn">Apagar</a>
		<button id="downloadLnk"  class="navbtn" download="YourFileName.jpg">Confirmar Assinatura</button>
        <div class="title">Assinatura do Relatório: <?echo $_GET['edit']; ?></div>
    </div>
	
    <div id="content" class="contentCanvas"><p style="text-align:center">Carregando papel e caneta...</p></div>
	
		<!--img src="" class="image" name="ass" id="ass" /-->
		<input type="text" value="" name="assinatura" id="assinatura" />
		<input type="text" value="<?=$_GET['edit'] ?>" name="relatorio" id="relatorio"  />
	</form>

