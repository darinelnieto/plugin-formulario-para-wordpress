<?php
/*
*Plugin name: NASA_astronautas
*Autor: Darinel Nieto
*Description: Este es un plugin de eventos convencionales shortcode [NASA_astronautas]
*shortcode [NASA_configura]
*/ 

register_activation_hook(__FILE__, 'nasa_configure_init');
require_once('configuracion.php');
?>

<?php

register_activation_hook(__FILE__, 'nasa_seguimientos_init');
require_once('formulario.php');



add_action("admin_menu", "NASA_menu");

function NASA_menu(){
	add_menu_page("NASA astronautas", "NASA clientes", "manage_options", "NASA_menu", "NASA_admin","nasa_show_message", "dashicons-welcome-write-blog", 75 );

	add_submenu_page("NASA_menu", "NASA configuracion", "configuracion", "manage_options", "NASA_configuracion", "config_submenu", "configuracion_option" );
	add_submenu_page("NASA_menu", "NASA reportes", "reportes", "manage_options", "NASA_reportes", "report_submenu", "reportes" );
}

function NASA_admin(){
	global $wpdb;
	$table_NASA = $wpdb->prefix . 'nasa_seguimientos';
	$reportes = $wpdb->get_results("SELECT * FROM $table_NASA");
	echo '<div class="wrap"><h1>Seguimientos</h1>';
	echo '<table class="wp-list-table widefat fixed striped">';
	echo '<thead><tr><th>Nombre Completo</th><th>Email</th><th>Tel</th><th>Edad</th><th>País</th><td>Departamento</td>';
	echo '<td>Ciudad</td><td>Destino</td><td>Estudio</td><td>echaViaje</td><td>Politicas</td>';
	echo '</tr></thead>';
	echo '<tbody id="registros">';
	foreach ($reportes as $reportes) {
		$nombre = esc_textarea($reportes->nombre);
		$email = esc_textarea($reportes->correo);
		$tel = esc_textarea($reportes->telefono);
		$edad = esc_textarea($reportes->edad);
		$paisOrigen = esc_textarea($reportes->paisOrigen);
		$departamento = esc_textarea($reportes->departamento);
		$ciudad = esc_textarea($reportes->ciudad);
		$paisDestino = esc_textarea($reportes->paisDestino);
		$estudio = esc_textarea($reportes->estudio);
		$fechaViaje = esc_textarea($reportes->fechaViaje);
		$politicas = esc_textarea($reportes->politicas);
		echo "<tr><td>$nombre</td>";
		echo "<td>$email</td><td>$tel</td><td>$edad</td>";
		echo "<td>$paisOrigen</td><td>$departamento</td><td>$ciudad</td>";
		echo "<td>$paisDestino</td><td>$estudio</td><td>$fechaViaje</td><td>$politicas</td></tr>";
	}
	echo '</tbody></div>';
}

function config_submenu(){
	echo do_shortcode('[NASA_configura]');
	echo "<p>agrega este shortcut donde decees integrar el formularo [NASA_astronautas]</p>";
}

function report_submenu(){
	global $wpdb;
	$table_NASA = $wpdb->prefix . 'nasa_seguimientos';
	$reportes = $wpdb->get_results("SELECT  * FROM 
	 `wp_nasa_seguimientos` WHERE  id IN (    SELECT   DISTINCT MAX(id) FROM `wp_nasa_seguimientos`
           ) 
ORDER BY
	id ASC");
	

	echo '<div class="wrap"><h1>Seguimientos</h1>';
	echo '<table class="wp-list-table widefat fixed striped">';
	echo '<thead><tr><th>Nombre Completo</th><th>Email</th><th>Tel</th><th>Edad</th><th>País</th><td>Departamento</td>';
	echo '<td>Ciudad</td><td>Destino</td><td>Estudio</td><td>echaViaje</td><td>Politicas</td>';
	echo '</tr></thead>';
	echo '<tbody id="registros">';
	foreach ($reportes as $reportes) {
		$nombre = esc_textarea($reportes->nombre);
		$email = esc_textarea($reportes->correo);
		$tel = esc_textarea($reportes->telefono);
		$edad = esc_textarea($reportes->edad);
		$paisOrigen = esc_textarea($reportes->paisOrigen);
		$departamento = esc_textarea($reportes->departamento);
		$ciudad = esc_textarea($reportes->ciudad);
		$paisDestino = esc_textarea($reportes->paisDestino);
		$estudio = esc_textarea($reportes->estudio);
		$fechaViaje = esc_textarea($reportes->fechaViaje);
		$politicas = esc_textarea($reportes->politicas);
		echo "<tr><td>$nombre</td>";
		echo "<td>$email</td><td>$tel</td><td>$edad</td>";
		echo "<td>$paisOrigen</td><td>$departamento</td><td>$ciudad</td>";
		echo "<td>$paisDestino</td><td>$estudio</td><td>$fechaViaje</td><td>$politicas</td></tr>";
	}
	echo '</tbody></div>';
}


		




// agregando archivos js
function NASA_scripts() {
	wp_enqueue_style( 'NASA_astronautas.css', plugins_url('/css/NASA_astronautas.css', __FILE__));
	wp_enqueue_style( 'font-awesome.css', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css', true );

	wp_enqueue_script( 'jquery.js', 'https://code.jquery.com/jquery-3.5.1.js', true );
	wp_enqueue_script( 'font-awesome.js', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/js/all.min.js', true );
	wp_register_script( 'NASA_astronautas.js', plugins_url('/js/NASA_astronautas.js', __FILE__ ), array('jquery'), '1.0', true);
	wp_enqueue_script('NASA_astronautas.js');

}

add_action( 'wp_enqueue_scripts', 'NASA_scripts' );
?>