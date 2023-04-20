<?php
function array_recibe($url_array) {
    $tmp = stripslashes($url_array);
    $tmp = urldecode($tmp);
    $tmp = unserialize($tmp);
    return $tmp;
}
$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
$tipo = $_GET['tipo'];
$efecto = $_GET['fx'];
$color = $_GET['color'];
$widgettapas = array_recibe($_GET['widgettapas']);
$anchura = $_GET['width'];
$anchuraclass2 = $_GET['widthclass2'];
$altura = $_GET['height'];
$alturaclass = $_GET['heightclass'];

echo '
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<script src="https://malsup.github.io/jquery.cycle2.js"></script>
	<script src="https://malsup.github.io/jquery.cycle2.tile.js"></script>
	<script src="https://malsup.github.io/jquery.cycle2.shuffle.js"></script>
	<style>
@media(max-width:768px){

.imgnav a {
    width: 100px;
    display: block !important;
}
}
#widgetbordertapa {
    border-radius: 4px;
}
	.widget-container {
  padding: 0 !important;
}
.grad {
  background: #396886;
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr="#fff", endColorstr="#fff");
  background: -webkit-gradient(linear, left top, left bottom, from(#fff), to(#fff));
  background: -moz-linear-gradient(top, #fff, #fff);
}
.widget { margin: auto; font-size:10px; border-radius:0px; -moz-border-radius:0px;font-family: "Open Sans", sans-serif;overflow: hidden;}
.widget a {color: #333; text-decoration: none;}
.widget a:hover {color: #333; text-decoration: underline;}

.imgnav {text-align:center;vertical-align:middle;}
.imgnav a {position: absolute; text-indent: -5000px; display: block; z-index:203;}
.imgnav	a.text {background:#fff;color:#111;text-indent: 0px; width:100%;bottom:1px; left: 0px; cursor:pointer;text-align:center; z-index:202;}
.imgnav div.bar {opacity:0.98;position:absolute;color:#fff;text-indent:0px;height:24px;width:100%;bottom:0px; left: 0px; cursor:pointer;text-align:center;z-index:202; }
.imgnav a.previous 	{width: 50px;cursor:pointer;}
.imgnav a.next 	   	{width: 50px;cursor:pointer;}
.imgnav a.pause		{background: url(css/img/pause.png) no-repeat center 50%; height: 22px; width: 16px; bottom: 0px; left:142px;cursor:pointer;}
.imgnav a.next:hover, a.previous:hover, a.pause:hover {transform: scale(1.25);}

.paperdate{opacity:0.8;-moz-transform:translate(-5px,10px) rotate(-45deg);-webkit-transform:translate(-5px,10px) rotate(-45deg);background:#E00;color:#FFF;padding:1px 10px;position:absolute;text-decoration:none;transform:translate(-5px,10px) rotate(-45deg);z-index:20;}
	</style>
<script>
jQuery(document).ready(function() {
	var type = '.$tipo.';
	var effect ="'.$efecto.'";

        jQuery(".slideshow").cycle({
    		fx: effect,
    		log: false,
    		timeout: 3800,
    		delay: -1000,
    		swipe: false,
    		slides: "#myslide"
    	});
    	
        jQuery(".slideshow").css({
            overflow: "hidden"
        });

        	var pause = false;
        jQuery("#prevButton").click(function() {
            jQuery(".slideshow").cycle("prev");
        });
        jQuery("#nextButton").click(function() {
            jQuery(".slideshow").cycle("next");
        });
        jQuery("#pauseButton").click(function() {
        	pause = !pause;
        	if (!pause) {
        		jQuery("#pauseButton").css("background-image", "url('.$actual_link.'/wp-content/plugins/Widget_TP_Diarios/css/img/pause.png)");
        		jQuery(".slideshow").cycle("resume");
        	}
        	else {
        		jQuery("#pauseButton").css("background-image", "url('.$actual_link.'/wp-content/plugins/Widget_TP_Diarios/css/img/Play.png)");
        		jQuery(".slideshow").cycle("pause");
        	}
        });
    
	
	
	jQuery(".widget").bind("mouseenter",{self:this},function(e){
    		if (type === 0) {
    			jQuery("#prevButton").fadeIn("fast");
    			jQuery("#nextButton").fadeIn("fast");
    		}
    		
    		    if (!pause)
    			    jQuery(".slideshow").cycle("pause");
    	});
    	jQuery(".widget").bind("mouseleave",{self:this},function(e){
    		if (type === 0) {
    			jQuery("#prevButton").fadeOut("fast");
    			jQuery("#nextButton").fadeOut("fast");
    		}
    		
        		if (!pause)
        			jQuery(".slideshow").cycle("resume");
    	});
    	
    if (type === 0) {
        jQuery("#widgetbordertapa").css("border-radius", "4px");
        jQuery(".widget").css("border-radius", "4px");
        jQuery("#prevButton").css("background", "url('.$actual_link.'/wp-content/plugins/Widget_TP_Diarios/css/img/prev.png) no-repeat left 50%");
        jQuery("#prevButton").css("height","50px");
        jQuery("#prevButton").css("bottom","12px");
        jQuery("#prevButton").css("left","0px");
        
        jQuery("#nextButton").css("background", "url('.$actual_link.'/wp-content/plugins/Widget_TP_Diarios/css/img/next.png) no-repeat right 50%");
        jQuery("#nextButton").css("height","50px");
        jQuery("#nextButton").css("bottom","12px");
        jQuery("#nextButton").css("right","0px");
        jQuery("#pauseButton").attr("style","display:none!important");
        jQuery(".bar").css("display","none");
    
    }else{
        jQuery("#widgetbordertapa").css("border-radius", "4px");
		jQuery(".bar").css("background-color","'.$color.'");
        jQuery("#prevButton").css("background", "url('.$actual_link.'/wp-content/plugins/Widget_TP_Diarios/css/img/larrow.png) no-repeat left 50%");
        jQuery("#prevButton").css("height","22px");
        jQuery("#prevButton").css("bottom","0px");
        jQuery("#prevButton").css("left","10px");
        
        jQuery("#nextButton").css("background", "url('.$actual_link.'/wp-content/plugins/Widget_TP_Diarios/css/img/rarrow.png) no-repeat right 50%");
        jQuery("#nextButton").css("height","22px");
        jQuery("#nextButton").css("bottom","0px");
        jQuery("#nextButton").css("right","10px");
        jQuery("#myslide img").css("height","calc('.$altura.'px - 11px)");
    }
    

    if (type === 0) {
		jQuery("#nextButton").hide();
		jQuery("#prevButton").hide();
	}
  });
  </script>

</head>
<body>
    <div class="widget grad">
        <div class="imgnav" style="width:'.$anchura.'px;">
            <a class="previous" id="prevButton"></a>
            <a class="next" id="nextButton"></a>
            <a class="pause" id="pauseButton"></a>
            <div class="bar"></div>
        </div>
        <div class="slideshow" style="width:100%;height:auto;">';
            
            $FECHA      = date("Y/m/d-H:00");
        	$Author = "Evolucion Streaming - Sericios Informáticos";
          	foreach ($widgettapas as $key => $tptapa){
                echo '<div id="myslide">
                    <a href="'.$tptapa["href"].'" target="_top">
                        <img src="'.$tptapa["url"].'?'.$FECHA.' '.$Author.'" style="width:350px;height: '.$altura.'px;max-width: 100%;"/>
                    </a>
                </div>';
        	}
        	
        echo '</div>
            </div>
</body>
</html>';
?>