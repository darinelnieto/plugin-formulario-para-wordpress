<?php 
function NASA_seguimientos_init(){
	global $wpdb;
	$table_NASA = $wpdb->prefix . 'nasa_seguimientos';
	$charset_collate = $wpdb->get_charset_collate(); //ordenamiento de la tabla

	$query = "CREATE TABLE IF NOT EXISTS $table_NASA (
		id BIGINT(10) NOT NULL AUTO_INCREMENT,
		nombre VARCHAR(255) NOT NULL,
		correo VARCHAR(255) NOT NULL,
		telefono BIGINT(13) NOT NULL,
		edad INT(2) NOT NULL,
		paisOrigen VARCHAR(255) NOT NULL,
		departamento VARCHAR(255) NOT NULL,
		ciudad VARCHAR(255) NOT NULL,
		paisDestino VARCHAR(40) NOT NULL,
		estudio VARCHAR(255) NOT NULL,
		fechaViaje VARCHAR(255) NOT NULL,
		politicas VARCHAR(255) NOT NULL,
		UNIQUE (id)
	) $charset_collate";
	include_once ABSPATH . 'wp-admin/includes/upgrade.php';
	dbDelta($query);
}

add_shortcode( 'NASA_astronautas', 'plugin_NASA_astro' );

function plugin_NASA_astro(){
	global $wpdb;
	$table_NASA = $wpdb->prefix . 'nasa_seguimientos';
	if ( $_POST['nombre'] != ""
		AND $_POST['correo'] != ""
		AND $_POST['telefono'] != ""
		AND $_POST['edad'] != ""
		AND $_POST['paisOrigen'] != ""
		AND $_POST['departamento'] != ""
		AND $_POST['ciudad'] != ""
		AND $_POST['paisDestino'] != ""
	    AND $_POST['estudio'] != ""
	    AND $_POST['fechaViaje'] != ""
	    AND $_POST['politicas'] != ""   
	   ){ $sql= $wpdb->insert($table_NASA, array(
			'nombre' => $_POST['nombre'],
			'correo' => $_POST['correo'],
			'telefono' =>$_POST['telefono'],
			'edad'=> $_POST['edad'],
			'paisOrigen'=> $_POST['paisOrigen'],
			'departamento'=> $_POST['departamento'],
			'ciudad'=> $_POST['ciudad'],
			'paisDestino' => $_POST['paisDestino'],
			'estudio' => $_POST['estudio'],
			'fechaViaje' => $_POST['fechaViaje'],
			'politicas' => $_POST['politicas'],
		));

		global $wpdb;
		$table_NASA = $wpdb->prefix . 'nasa_seguimientos';
		$reportes = $wpdb->get_results("SELECT  * FROM 
			`wp_nasa_seguimientos` WHERE  id IN (    SELECT   DISTINCT MAX(id) FROM `wp_nasa_seguimientos`
				) 
	ORDER BY
		id ASC");
	
	//API URL pendiente cambirla cuand se active el plugin en homeword
	$url = 'https://hook.integromat.com/pmt2ydlek2lgp8jy4lmtxrwax399u48k';
	
	//create a new cURL resource
	$ch = curl_init($url);
	
	//setup request to send json via POST
	
	$payload = json_encode($reportes);
	
	//attach encoded JSON string to the POST fields
	curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
	
	//set the content type to application/json
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
	
	//return response instead of outputting
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	
	//execute the POST request
	$result = curl_exec($ch);
	
	
	//close cURL resource
	curl_close($ch);
	}
    ob_start();
    ?>

        <div class="form" id="edita">
		<?php 
					global $wpdb;
					$table_NASA_confi = $wpdb->prefix . 'nasa_configure';
					$reportes = $wpdb->get_results("SELECT * FROM $table_NASA_confi");
					foreach ($reportes as $reportes) {
						$preguntaUno = esc_textarea($reportes->preguntaUno);
						$preguntaDos = esc_textarea($reportes->preguntaDos);
						$preguntaTres = esc_textarea($reportes->preguntaTres);
						$preguntaCuatro = esc_textarea($reportes->preguntaCuatro);
						$preguntaCinco = esc_textarea($reportes->preguntaCinco);
						$preguntaSeis = esc_textarea($reportes->preguntaSeis);
						$preguntaSiete = esc_textarea($reportes->preguntaSiete);
						$preguntaOcho = esc_textarea($reportes->preguntaOcho);
						$preguntaNueve = esc_textarea($reportes->preguntaNueve);
						$preguntaDies = esc_textarea($reportes->preguntaDies);
						$preguntaOnce = esc_textarea($reportes->preguntaOnce);
					}
				?>
			<form  action="<?php get_the_permalink();?>" method="post" id="formulario">
				<div class="col-12 col-md-6 offset-md-3">
					<div class="informeProgreso">
						<p>preogreso</p>
					</div>
					<div class="barraProgreso">
						<div class="text-right" id="htmlProgreso"><p class="porcentaje">0%</p></div>
					</div>
				</div>
				<!-- informacion planes -->
				<div class="col-12 col-md-6 offset-md-3" id="paisDestino">
					<div class="label">
						<label class="preguntasSelect"><?php echo $preguntaOcho ?></label>
					</div>
					<label class="select">
						<input type="radio" name="paisDestino" id="DestinoUno" value="Australia">Australia
					</label>
					<label class="select">
						<input type="radio" name="paisDestino" id="DestinoDos" value="Canadá">Canadá
					</label>
					<label class="select">
						<input type="radio" name="paisDestino" id="DestinoTres" value="Dubai">Dubai
					</label>
					<label class="select">
						<input type="radio" name="paisDestino" id="DestinoCuatro" value="EEUU">EEUU
					</label>
					<label class="select">
						<input type="radio" name="paisDestino" id="DestinoCinco" value="Malta">Malta
					</label>
					<label class="select">
						<input type="radio" name="paisDestino" id="DestinoSeis" value="Nueva Zelanda">Nueva Zelanda
					</label>
					<label class="select">
						<input type="radio" name="paisDestino" id="DestinoSiete" value="Reino Unido">Reino Unido
					</label>
					<div style="text-align: right !important; margin-top: 2em;">
						<input type="button" style="cursor: no-drop;" class="botonContinua" id="botonConUno" value="Continuar">
					</div>
				</div>
				<div class="col-12 col-md-6 offset-md-3" id="interesEstudio">
					<div class="label">
						<label class="preguntasSelect"><?php echo $preguntaNueve ?></label>
					</div>
					<label class="select">
						<input type="radio" name="estudio" value="Cursos_de_Inglés">Cursos de Inglés
					</label>
					<label class="select">
						<input type="radio" name="estudio" value="Certificado">Certificado
					</label>
					<label class="select">
						<input type="radio" name="estudio" value="Diploma">Diploma
					</label>
					<label class="select">
						<input type="radio" name="estudio" value="Pregrado">Pregrado
					</label>
					<label class="select">
						<input type="radio" name="estudio" value="Postgrado">Postgrado
					</label>
					<div class="botones">
						<a class="Regresa" id="botonAtrasUno"><i class="fas fa-angle-left"></i> Atras</a>

						<input class="botonContinua" style="cursor: no-drop;" type="button" id="botonDestinoDos" value="Continuar">
					</div>
				</div>
				<div class="col-12 col-md-6 offset-md-3" id="fechaViaje">
					<label class="label">
						<label class="preguntasSelect"><?php echo $preguntaDies ?></label>
					</label>
					<label class="select">
						<input type="radio" name="fechaViaje" value="Dentro de 6 meses o menos">Dentro de 6 meses o menos
					</label>
					<label class="select">
						<input type="radio" name="fechaViaje" value="De 6 meses a 12 meses">De 6 meses a 12 meses
					</label>
					<label class="select">
						<input type="radio" name="fechaViaje" value="Más de 12 meses">Más de 12 meses
					</label>
					<label class="select">
						<input type="radio" name="fechaViaje" value="Aún no tengo una fecha definida">Aún no tengo una fecha definida
					</label>
					<div class="botones">
						<a class="Regresa" id="botonAtrasDos"><i class="fas fa-angle-left"></i> Atras</a>

						<button class="botonContinua" style="cursor: no-drop;" id="botonDestinoTres">Continuar</button>
					</div>
				</div>
				<!-- informacion planes -->
				<div class="col-12 col-md-6 offset-md-3" id="datosPersonales">
					<div class="formu">
						<div class="label">
							<label><?php echo $preguntaUno ?></label>
						</div>
						<input type="text" name="nombre" placeholder="Nombre" required>
					</div>
					<div class="formu">
						<div class="label">
							<label><?php echo $preguntaDos ?></label>
						</div>
						<input type="email" name="correo" placeholder="Email" required>
					</div>
					<div class="formu">
						<div class="label">
							<label><?php echo $preguntaTres ?></label>
						</div>
						<input type="number" name="telefono" placeholder="3216879809" required>
					</div>
					<div class="formu">
						<div class="label">
							<label><?php echo $preguntaCuatro ?></label>
						</div>
						<input type="number" name="edad" required>
					</div>
					<div class="botones">
						<a class="Regresa" value="Atras" id="botonAtrasTres"><i class="fas fa-angle-left"></i> Atras</a>

						<input type="button" style="cursor: no-drop;" class="botonContinua" value="Contiuar" id="botonDestinoCuatro">
					</div>
				</div>
				<div class="col-12 col-md-6 offset-md-3" id="ubicacion">
					<!-- informacion pais -->
					<div class="formu">
						<div class="label">
							<label><?php echo $preguntaCinco ?></label>
						</div>
						<select name="paisOrigen" required>
							<option value="Colombia">Colombia</option>
							<option value="Otro">Otro</option>
						</select>
					</div>
					<div class="formu">
							<div class="label">
								<label><?php echo $preguntaSeis ?></label>
							</div>
						<select name="departamento" placeholder="Mensaje" required>
							<option value="Amazonas">Amazonas</option>
							<option value="Antioquía">Antioquía</option>
							<option value="Arauca">Arauca</option>
							<option value="Atlántico">Atlántico</option>
							<option value="Bogotá">Bogotá</option>
							<option value="Bolívar">Bolívar</option>
							<option value="Boyacá">Boyacá</option>
							<option value="Caldas">Caldas</option>
							<option value="Caquetá">Caquetá</option>
							<option value="Casanare">Casanare</option>
							<option value="auca">auca</option>
							<option value="Cesar">Cesar</option>
							<option value="Chocó">Chocó</option>
							<option value="Córdoba">Córdoba</option>
							<option value="Cundinamarca">Cundinamarca</option>
							<option value="Guainía">Guainía</option>
							<option value="Guaviare">Guaviare</option>
							<option value="Huila">Huila</option>
							<option value="La Guajira">La Guajira</option>
							<option value="Magdalena">Magdalena</option>
							<option value="Meta">Meta</option>
							<option value="Nariño">Nariño</option>
							<option value="Norte de Santander">Norte de Santander</option>
							<option value="Putumayo">Putumayo</option>
							<option value="Quindío">Quindío</option>
							<option value="Risaralda">Risaralda</option>
							<option value="San Andrés y Providencia">San Andrés y Providencia</option>
							<option value="Santander">Santander</option>
							<option value="Sucre">Sucre</option>
							<option value="Tolima">Tolima</option>
							<option value="Valle del Cauca">Valle del Cauca</option>
							<option value="Vaupés">Vaupés</option>
							<option value="Vichada">Vichada</option>
						</select>
					</div>
					<div class="formu">
						<label><?php echo $preguntaSiete ?></label>
						<input type="text" name="ciudad" placeholder="Ciudad" required>
					</div>
					<div class="formu">
						<input type="checkbox" class="cuadrado" name="politicas" value="Aceptó" required>
						<label>Estoy de acuerdo con las <span><a href="<?php echo $preguntaOnce ?>">Políticas de privacidad.</a></span></label>
					</div>
					<!-- enviar -->
					<div class="botones">
						<a class="Regresar" id="botonAtrasCuatro"><i class="fas fa-angle-left"></i> Atras</a>
						<input class="botonContinua" style="cursor: no-drop;" class="botonContinua" type="submit" id="envia" value="Enviar">
					</div>
				</div>
			</form>
			
    <?php
   return ob_get_clean();
}
?>