<?php 
function NASA_configure_init(){
	global $wpdb;
	$table_NASA_confi = $wpdb->prefix . 'nasa_configure';
	$charset_collate = $wpdb->get_charset_collate(); //ordenamiento de la tabla

	$query = "CREATE TABLE IF NOT EXISTS $table_NASA_confi (
		id INT(1) NOT NULL,
		preguntaUno VARCHAR(255) NOT NULL,
		preguntaDos VARCHAR(255) NOT NULL,
		preguntaTres VARCHAR(255) NOT NULL,
		preguntaCuatro VARCHAR(255) NOT NULL,
		preguntaCinco VARCHAR(255) NOT NULL,
		preguntaSeis VARCHAR(255) NOT NULL,
		preguntaSiete VARCHAR(255) NOT NULL,
		preguntaOcho VARCHAR(255) NOT NULL,
		preguntaNueve VARCHAR(255) NOT NULL,
		preguntaDies VARCHAR(255) NOT NULL,
		preguntaOnce VARCHAR(255) NOT NULL
	) $charset_collate";
	include_once ABSPATH . 'wp-admin/includes/upgrade.php';
	dbDelta($query);

	$sql= $wpdb->insert($table_NASA_confi, array(
		'id'=> 1,
				
	));
	ob_start();

}

add_shortcode( 'NASA_configura', 'plugin_NASA_configur' );
function plugin_NASA_configur(){
	global $wpdb;
	$table_NASA_confi = $wpdb->prefix . 'nasa_configure';
	if ($_POST['preguntaUno'] != ""
	   AND $_POST['preguntaDos'] != ""
	   AND $_POST['preguntaTres'] != ""
	   AND $_POST['preguntaCuatro'] != ""
	   AND $_POST['preguntaCinco'] != ""
	   AND $_POST['preguntaSeis'] != ""
	   AND $_POST['preguntaSiete'] != ""
	   AND $_POST['preguntaOcho'] != ""
	   AND $_POST['preguntaNueve'] != ""
	   AND $_POST['preguntaDies'] != ""
	   AND $_POST['preguntaOnce'] != ""
	   ){ $sql= $wpdb->update($table_NASA_confi, array(
			'preguntaUno'=> $_POST['preguntaUno'],
			'preguntaDos'=> $_POST['preguntaDos'],
			'preguntaTres'=> $_POST['preguntaTres'],
			'preguntaCuatro'=> $_POST['preguntaCuatro'],
			'preguntaCinco'=> $_POST['preguntaCinco'],
			'preguntaSeis'=> $_POST['preguntaSeis'],
			'preguntaSiete'=> $_POST['preguntaSiete'],
			'preguntaOcho'=> $_POST['preguntaOcho'],
			'preguntaNueve'=> $_POST['preguntaNueve'],
			'preguntaDies'=> $_POST['preguntaDies'],
			'preguntaOnce'=> $_POST['preguntaOnce'],
	   ),array( 'id' => 1 ));
	}
	ob_start();
	 ?>
	 <div class="formu">
		<form action="<?php get_the_permalink(); ?>" method="post" id="config">
			<div class="uno">
				<input type="text" name="preguntaUno" placeholder="Nombres y apellidos:" value="">
			</div>
			<div class="uno">
				<input type="text" name="preguntaDos" placeholder="Email" value="">
			</div>
			<div class="uno">
				<input type="text" name="preguntaTres" placeholder="Teléfono" value="">
			</div>
			<div class="uno">
				<input type="text" name="preguntaCuatro" placeholder="Edad" value="">
			</div>
			<div class="uno">
				<input type="text" name="preguntaCinco" placeholder="Pais" value="">
			</div>
			<div class="uno">
				<input type="text" name="preguntaSeis" placeholder="Departamento" value="">
			</div>
			<div class="uno">
				<input type="text" name="preguntaSiete" placeholder="Ciudad" value="">
			</div>
			<div class="uno">
				<input type="text" name="preguntaOcho" placeholder="Destino" value="">
			</div>
			<div class="uno">
				<input type="text" name="preguntaNueve" placeholder="Estudio" value="">
			</div>
			<div class="uno">
				<input type="text" name="preguntaDies" placeholder="Fecha viaje" value="">
			</div>
			<div class="uno">
				<input type="text" name="preguntaOnce" placeholder="url" value="">
			</div>
			<div class="uno">
				<input type="submit" class="dos">
			</div>
		</form>
	</div>
	 <?php
	 return ob_get_clean();
}
?>