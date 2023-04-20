<?php
/*
Plugin Name: Widget Tapas de Diarios
Plugin URI: https://github.com/jafr0691
Description: Feed de Tapas de Diarios en WordPress
Author: Jesus Farias
Version: 2.0.1
Author URI: https://github.com/jafr0691
*/

defined('ABSPATH') or die('No script please!');

global $wpdb;
define('DocTPDiarios', plugin_dir_path(__FILE__));
define('ARCTPDiarios', plugin_dir_url(__FILE__));
define('postTitle', 'WIDGET TAPAS DE DIARIOS');

require_once  DocTPDiarios.'plugin-update-checker/plugin-update-checker.php';

$myUpdateChecker = Puc_v4_Factory :: buildUpdateChecker (
	 'https://hosteTRepositorio/repository/plugins/Widget_TPDiarios/details.json' ,
	__FILE__,'Widget_TPDiarios' 
);


function db_widget_tapa_page(){

        global $wpdb;

        $query = $wpdb->prepare(
            'SELECT ID FROM ' . $wpdb->posts . '
                WHERE post_title = %s
                AND post_type = \'page\'',
            postTitle
        );
        $wpdb->query( $query );
        if ( $wpdb->num_rows ) {
            $wpdb->update($wpdb->posts,
            array('post_status'=> 'publish'),
            array('post_title' => postTitle,'post_type'=>'page'));
        } else {
        $new_page_id = wp_insert_post( array(
                'post_title'     => postTitle ,
                'post_type'      => 'page',
                'post_name'      => 'widget tapas de diarios',
                'post_status'    => 'publish',
                'post_author'    => 1,
                'menu_order'     => 7,
                'page_template'  => 'widgetdiarios.php'
            ) );
        $post_id = wp_insert_post($new_page_id);
    }
    require_once DocTPDiarios . 'db_widget_tapaPage.php';
}

add_filter( 'page_template', 'wpa33967_widget_page_template' );
function wpa33967_widget_page_template( $page_template ){

    if ( get_page_template_slug() == 'widgetdiarios.php' ) {
        $page_template = dirname( __FILE__ ) . '/widgetdiarios.php';
    }
    return $page_template;
}

add_filter( 'theme_page_templates', 'widget_tapa_diario_add_template_to_select', 10, 5 );
function widget_tapa_diario_add_template_to_select( $post_templates, $wp_theme, $post, $post_type ) {

    // Add custom template named template-custom.php to select dropdown
    $post_templates['widgetdiarios.php'] = __('widget-tapas-de-diarios');

    return $post_templates;
}

class Widget_TP_Diarios extends WP_Widget
{

	 public function __construct(){
	  // initialize widget name, id or other attributes
	  parent::__construct("Widget_TP_Diarios", "Tapas de Diarios", array(
	  	 'description' => 'Tapas de Diarios en Wordpress'
	  ));
	  add_action("widgets_init", function(){
	    register_widget("Widget_TP_Diarios");
	  });

	}
	
 
 	public function form( $instance ) {
    	$defaults = array( 'title' => __( 'TAPAS DE DIARIOS', 'wptheme' ), 'avatar' => 'on', 'tipo' => '0', 'efecto' => 'scrollHorz', 'anchura' => '300', 'altura' => '400' );
    	$instance = wp_parse_args( ( array ) $instance, $defaults );
		?>
    	<p>
        	<label for="<?php echo $this->get_field_id( 'title' ); ?>">Titulo:</label>
        	<input class="widefat"  id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $instance[ 'title' ] ); ?>" />
    	</p>
		<p>
		    <table border="0"> 
  	<tbody>

		<tr>
      <td>Tipo:</td> 
      <td style="padding-left:5px;">
	  <select name="<?php echo $this->get_field_name( 'tipo' ); ?>" style="font-size:14px;" onchange="calcWidth();" id="<?php echo $this->get_field_id( 'tipo' ); ?>">
	    
		  <option  value="0" <?php if(esc_attr( $instance[ 'tipo' ]) == '0'){ echo 'selected="selected"'; } ?>>Border</option>
		  <option  value="1" <?php if(esc_attr( $instance[ 'tipo' ]) == '1'){ echo 'selected="selected"'; } ?>>Simple</option>

	  </select>
	 </td>  
    </tr>
	<tr>
      <td>Efecto:</td> 
      <td style="padding-left:5px;">
      <select name="<?php echo $this->get_field_name( 'efecto' ); ?>" style="font-size:14px;" id="<?php echo $this->get_field_id( 'efecto' ); ?>">
		<option value="fade" <?php if(esc_attr( $instance[ 'efecto' ]) == 'fade'){ echo 'selected="selected"'; } ?>>Descol&#243;rese</option>
		
		<option value="scrollHorz" <?php if(esc_attr( $instance[ 'efecto' ]) == 'scrollHorz'){ echo 'selected="selected"'; } ?>>Horizontal</option>
		
		<option value="tileSlide" <?php if(esc_attr( $instance[ 'efecto' ]) == 'tileSlide'){ echo 'selected="selected"'; } ?>>Strips</option>
		
		<option value="tileBlind" <?php if(esc_attr( $instance[ 'efecto' ]) == 'tileBlind'){ echo 'selected="selected"'; } ?>>Blinds</option>
		
		<option value="shuffle" <?php if(esc_attr( $instance[ 'efecto' ]) == 'shuffle'){ echo 'selected="selected"'; } ?>>Baraja</option>
	  </select>
	  </td>  
    </tr>
	<tr>
      <td>Color:</td> 
      <td><input type="color" class="color" name="<?php echo $this->get_field_name( 'color' ); ?>" value="<?php echo esc_attr( $instance[ 'color' ] ); ?>" style="background-color: rgb(242, 242, 242); color: rgb(0, 0, 0);" id="<?php echo $this->get_field_id( 'color' ); ?>"></td>  
    </tr>
	<tr>
      <td>Anchura:</td> 
      <td style="padding-left:5px;"><input name="<?php echo $this->get_field_name( 'anchura' ); ?>" type="number" value="<?php echo esc_attr( $instance[ 'anchura' ] ); ?>" onchange="calcWidth();" id="<?php echo $this->get_field_id( 'anchura' ); ?>"></td>  
    </tr>
	<tr>
      <td>Altura:</td> 
      <td style="padding-left:5px;"><input name="<?php echo $this->get_field_name( 'altura' ); ?>" type="number" value="<?php echo esc_attr( $instance[ 'altura' ] ); ?>" id="<?php echo $this->get_field_id( 'altura' ); ?>"></td>  
    </tr>
  </tbody></table>
		</p>
  
		<?php
	}


 
	public function update( $new_instance, $old_instance ) {
	    parent::update($new_instance, $old_instance);
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['tipo'] = $new_instance['tipo'];
        $instance['efecto'] = $new_instance['efecto'];
        $instance['color'] = $new_instance['color'];
        $instance['anchura'] = $new_instance['anchura'];
        $instance['altura'] = $new_instance['altura'];
        return $instance;
	}
 
	public function widget( $args, $instance )
	{
		extract( $args, EXTR_SKIP );
	 	echo $before_widget;
	 	global $wpdb;
		$title = empty( $instance['title'] ) ? ' ' : apply_filters( 'widget_title', $instance['title'] );
		$regions = empty( $instance['regions'] ) ? 7 : esc_attr($instance['regions']);
		$efecto = empty( $instance['efecto'] ) ? 'none' : esc_attr($instance['efecto']);
		$tipo = empty( $instance['tipo'] ) ? '0' : esc_attr($instance['tipo']);
		$color = empty( $instance['color'] ) ? '#fff' : esc_attr($instance['color']);
		$altura = empty( $instance['altura'] ) ? '360' : esc_attr($instance['altura']);
		$alturaclass = $tipo==0? $altura - 16:$altura;
		$alturaclass2 = $tipo==0? $altura - 8:$altura;
		$anchura = empty( $instance['anchura'] ) ? '310' : esc_attr($instance['anchura']);
		$anchuraclass = $tipo==0? $anchura -16:$anchura;
		$anchuraclass2 = $tipo==0? $anchura -8:$anchura;
		
		if ( ! empty($title) ) {
            function widget_diario_url_existe($url){
               $handle = @fopen($url, "r");
               if ($handle == false)
                      return false;
               fclose($handle);
               return true;
            }
		    function CargarWidgetTapasDeDiariosMTI(){
                global $wpdb;
                $listwidgettapa = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "TPTapa");
                $urls = [];
                $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
                foreach ($listwidgettapa as $widgettapadb) {
                    if (widget_diario_url_existe($widgettapadb->enlaceimg)){
                        $urls[] = array(
                            'url' => $widgettapadb->enlaceimg,
                            'href'=> $actual_link.'/widget-tapas-de-diarios/?t='.$widgettapadb->url
                        );
                     }
                }
                return $urls;
            }
            
            function enviar_array($array){
                $tmp = serialize($array);
                $tmp = urlencode($tmp); 
                return $tmp;
            } 
            
            $widgettapas = CargarWidgetTapasDeDiariosMTI();
            
			echo $before_title . $title . $after_title;
			
  				    echo '<div style="width:100%;height:'.$alturaclass2.'px;"><iframe id="widgetbordertapa" src="'.plugin_dir_url(__FILE__) . '/titlestripe.php?widgettapas='.enviar_array($widgettapas).'&fx='.$efecto.'&tipo='.$tipo.'&width='.$anchura.'&widthclass2='.$anchuraclass.'&height='.$altura.'&heightclass='.$alturaclass.'&color='.urlencode($color).'" width="350" max-width="100%" height="'.$alturaclass.'" scrolling=no marginwidth=0 marginheight=0 frameborder=0 border=0 style="border:0;margin:0;padding:0;"></iframe></div>';
                
		echo $after_widget;
	}
  }
 
}

function widget_tp_diarios_page_js()
{
    wp_enqueue_script('tapa_widget_jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js');
}

add_action('wp_enqueue_scripts', 'widget_tp_diarios_page_js');
function sqltpdiarios()
{
    require_once DocTPDiarios . 'action/function.php';
    require_once DocTPDiarios . 'action/sqltpdiarios.php';
}

function control_jquery_tpdiarios_page()
{ 
    wp_enqueue_script('bootstrap.3.4.1.min_file', plugins_url('js/bootstrap.3.4.1.min.js', __FILE__));
    wp_register_script('script_sql', plugin_dir_url(__FILE__) . 'js/sqltpdiariosp.js', array('jquery'), '8', true);
    wp_enqueue_script('script_sql');
    wp_localize_script('script_sql', 'sqltpdiarios', ['sqlajaxpage' => admin_url('admin-ajax.php')]);
}
add_action('admin_enqueue_scripts', 'control_jquery_tpdiarios_page');
add_action('wp_ajax_sqltpdiarios', 'sqltpdiarios');
add_action('wp_ajax_nopriv_sqltpdiarios', 'sqltpdiarios');

function TPTapa_panel_turnos()
{
    add_menu_page('widget Tapas de Diarios', 'widget Tapas de Diarios', 'manage_options', DocTPDiarios . 'action/controlTPDiariosPage.php');
}
add_action('admin_menu', 'TPTapa_panel_turnos');

add_filter('plugin_action_links_' . plugin_basename(__FILE__), 'TPTapa_action_links');
add_filter('network_admin_plugin_action_links_' . plugin_basename(__FILE__), 'TPTapa_action_links');

function TPTapa_action_links($links) {
	$url = get_admin_url() . "admin.php?page=Widget_TP_Diarios/action/controlTPDiariosPage.php";
    $links[] = '<a href="' . $url . '">' . __('Ajustes', 'textdomain') . '</a>';
    $links[] = '<a style="color:black">' . __('Support') . ':</a>';
    $links[] = '<br><center style="width:275px;color:white;background-color:#02a0d2;border-radius:0px 30px">info@evolucionstreaming.com</center>';
    return $links;
}

register_activation_hook(__FILE__, 'db_widget_tapa_page');

$wp_plugin_widget_object = new Widget_TP_Diarios();

function widget_tapa_page_deactivate() {
    global $wpdb;
    $wpdb->update($wpdb->posts,
        array('post_status'=> 'draft'),
        array('post_title' => postTitle,'post_type'=>'page'));
}

register_deactivation_hook( __FILE__, 'widget_tapa_page_deactivate' );

function widget_tapa_page_uninstall(){
    require_once DocTPDiarios . 'uninstall.php';
}
register_uninstall_hook( __FILE__, 'widget_tapa_page_uninstall' );

?>