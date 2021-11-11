<?php include_once './php_page/funciones.php' ?>
<?php
	$head = obtener_tabla('head');
	$menu = obtener_tabla('menu_pagina', 'id', 'DESC');
	$header = obtener_tabla('header');
	$header_list = obtener_tabla('header_detail');
	$productos = obtener_tabla('productos');
	$preguntas = obtener_tabla('preguntas', 'id', 'ASC');
	$nosotros = obtener_tabla('nosotros');
	$contacto = obtener_tabla('contacto');
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>

    <meta name="description"
          content="<?= isset($head[0]->meta_description) ? $head[0]->meta_description : 'Name' ?>">
    <meta name="keywords"
          content="<?= isset($head[0]->meta_keywords) ? $head[0]->meta_keywords : 'Name' ?>">
    <link rel="shortcut icon" type="image/x-icon" href="<?= !empty($head[0]->icon) ? './public/assets/img/pag/icon/'.$head[0]->icon:'./public/assets/img/logo.png' ?>">
	<meta charset="utf-8">
	<meta name="author" content="IPlanet Colombia S.A.S">
	<title><?= !empty($head[0]->title) ? $head[0]->title : 'Iplanet' ?></title>

	<link rel="stylesheet" type="text/css" href="./public/mawii/css/lib/css/materialize.css">
	<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="./public/mawii/css/menu.css">
	<link rel="stylesheet" type="text/css" href="./public/mawii/css/body.css">
	<link rel="stylesheet" type="text/css" href="./public/mawii/slick/slick/slick.css">
	<link rel="stylesheet" type="text/css" href="./public/mawii/slick/slick/slick-theme.css">
	<link rel="stylesheet" type="text/css" href="./public/mawii/sweetAlert/dist/sweetalert2.min.css">
</head>
<body>
	<div class="navbar-fixed ">
			<nav class="nav-extended primario encabezado" id="encabezado">
				<div class="nav-wrapper">
					<div class="logo">
						<a href="#"><img src="<?= !empty($head[0]->logo) ? './public/assets/img/pag/logo/'.$head[0]->logo:'./public/assets/img/logo.png' ?>">
						</a>
					</div>
					<a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
					<ul id="nav-mobile" class="right hide-on-med-and-down">
						<?php foreach($menu as $detail): ?>
							<li><a href="sass.html"><?= $detail->title ?>ass</a></li>
						<?php endforeach ?>
					</ul>
				</div>
				<div class="nav-content">
					<ul class="tabs tabs-transparent">
						<li class="tab"><a href="#"><i class="fal fa-home-alt"></i> Inicio</a></li>
						<li class="tab"><a href="#clientes"><i class="far fa-users"></i> Clientes</a></li>
						<li class="tab"><a href="#preguntas"><i class="fal fa-question"></i> Preguntas frecuentes</a></li>
					</ul>
				</div>
			</nav>
	</div>
  <ul class="sidenav" id="mobile-demo">
    <li><a href="sass.html">Sass</a></li>
    <li><a href="badges.html">Components</a></li>
    <li><a href="collapsible.html">JavaScript</a></li>
  </ul>

	<!-- Información Principal -->
	<div class="primario principal" id="principal">
		<div class="row">
			<div class="col l5 s12 col_1">
				<p>
					<b><?= !empty($header[0]->titulo) ? $header[0]->titulo : 'Titulo' ?></b>
					<br>
					<?= !empty($header[0]->sub_titulo) ? $header[0]->sub_titulo : 'Sub titulo' ?>
				</p>
				<br>
				<ul>
					<?php foreach ($header_list as $key => $value): ?>
						<li><i class="fad fa-angle-right"></i> <b><?= $value->detalle ?></b></li>
					<?php endforeach ?>
				</ul>
				<a href="https://calendly.com/es" target="_blank">¡agenda tu reunión!</a>
			</div>
			<div class="col l7 s12 col_2 d-flex">
			    <div class="content_img">
                    <div class="img">
    					<img src="./public/mawii/img/gif2.gif">
    				</div>
			    </div>
			</div>
		</div>
	</div>

	<!-- Boton de whatsapp -->
	<section class="btn-float">
		<a href="#" id="btn-float"><i class="fab fa-whatsapp"></i> <span>agenda tu cita <i class="fad fa-arrow-circle-down"></i></span></a>
	</section>

	<!-- Preguntas y Productos-->

	<div class="preguntas">
		<div class="container">
			<ul class="my_slick" data-slick='{"slidesToShow": 4, "slidesToScroll": 4}' id="clientes">
				<?php foreach ($productos as $key => $value): ?>
					<li class="img_producto"><img src="./public/assets/img/pag/productos/<?= $value->img ?>"></li>
				<?php endforeach ?>
			</ul>
			<h4 class="card-title" id="preguntas">preguntas frecuentes</h4>
			<div class="row">
				<?php
					$total = count($preguntas);
					$total = round($total/2);
				?>
				<div class="col s12 l6 left_col">
					<?php foreach ($preguntas as $key => $value): ?>
						<?php if ($total >= ($key+1)): ?>
							<div class="row">
								<div class="col s12 l12">
									<section><i class="fal fa-chevron-down"></i></section>
									<div class="row">
										<div class="col s12 l9 texto">
											<p>
												<b><?= $value->titulo ?></b>
												<?= $value->texto ?>
											</p>
										</div>
										<div class="col s12 l3 icon">
											<span>
												<?php if (strpos($value->icon, '</i>')): ?>
													<?= $value->icon ?>
												<?php else: ?>
                           <i class="material-icons"><?= $value->icon ?></i>
												<?php endif ?>
											</span>
										</div>
									</div>
								</div>
							</div>
						<?php endif ?>
					<?php endforeach ?>
				</div>
				<div class="col s12 l6 right_col">
					<?php foreach ($preguntas as $key => $value): ?>
						<?php if ($total < ($key+1)): ?>
							<div class="row">
								<div class="col s12 l12">
									<section><i class="fal fa-chevron-down"></i></section>
									<div class="row">
										<div class="col s12 l3 icon">
											<span>
												<?php if (strpos($value->icon, '</i>')): ?>
													<?= $value->icon ?>
												<?php else: ?>
                            						<i class="material-icons"><?= $value->icon ?></i>
												<?php endif ?>
											</span>
										</div>
										<div class="col s12 l9 texto">
											<p>
												<b><?= $value->titulo ?></b>
												<?= $value->texto ?>
											</p>
										</div>
									</div>
								</div>
							</div>
						<?php endif ?>
					<?php endforeach ?>
				</div>
			</div>
			<div class="enlace">
				<a href="#">Ver más preguntas</a>
			</div>
		</div>
	</div>

	<!-- Resolver dudas -->

	<div class="dudas">
		<h1>resuelve tus dudas aquí</h1>
		<div class="form">
        	<div class="input-field">
          		<textarea id="icon_prefix2" class="materialize-textarea"></textarea>
          		<label for="icon_prefix2">Ingrese su pregunta</label>
        	</div>
          	<button class="btn-form"><i class="fad fa-paper-plane"></i> Enviar pregunta</button>
  		</div>
	</div>

	<!-- Nosotros -->

	<div class="nosotros">
		<div class="row">
			<div class="col s12 l6">
				<div class="content_video">
				    <div class="video_c">
    				    <?php if(!empty($nosotros[0]->video)): ?>
    				        <?php if(strpos($nosotros[0]->video, '.mp4')): ?>
    				            <video controls="true">
    				                <source src="./public/assets/img/pag/nosotros/<?= $nosotros[0]->video ?>" type="video/mp4">
    				            </video>
    				        <?php else: ?>
    				            <img src="./public/assets/img/pag/nosotros/<?= $nosotros[0]->video ?>">
    				        <?php endif ?>
    				    <?php else: ?>
    				        <img src="./public/assets/img/logo.png">
    				    <?php endif ?>
				    </div>
				</div>
			</div>
			<div class="col s12 l6">
				<h1 class="card-title">
					¿Quiénes Somos?
				</h1>
				<p>
					<?= $nosotros[0]->texto ?>
				</p>
			</div>
		</div>
	</div>

	<!-- Contacto -->

	<div class="contacto">
		<div class="row">
			<div class="col s12 m6 l3">
				<h2 class="card-title">
					Nuestros productos
				</h2>
				<ul class="my_slick_2">
					<?php foreach ($productos as $key => $value): ?>
						<li><img src="./public/assets/img/pag/productos/<?= $value->img ?>"></li>
					<?php endforeach ?>
				</ul>
			</div>
			<div class="col s12 m6 l4">
				<h2 class="card-title">
					Contáctanos
				</h2>
				<ul>
					<li>
						<b>Direccion: </b> <?= !empty($contacto[0]->direccion) ? $contacto[0]->direccion : '' ?>
					</li>
					<?php $phones = explode(',', !empty($contacto[0]->telefono) ? $contacto[0]->telefono : '' ) ?>
					<input type="hidden" id="number" value="<?= $phones[0] ?>">
					<?php foreach ($phones as $key => $value): ?>
						<li>
							<b>Telefono: </b> +57 <?= !empty($value) ? $value : '3131234567' ?>
						</li>
					<?php endforeach ?>
					<li>
						<b>Email: </b> <?= !empty($contacto[0]->email) ? $contacto[0]->email : '' ?>
					</li>
				</ul>
			</div>
			<div class="col s12 m6 l5">
				<h2 class="card-title">
					Siguenos
				</h2>
				<p>
					<?= !empty($contacto[0]->texto) ? $contacto[0]->texto : '' ?>
				</p>
				<div class="redes">
					<div class="iconos">
						<?php if (!empty($contacto[0]->facebook)): ?>
							<a href="<?= $contacto[0]->facebook ?>" target="_blank" class="tooltipped" data-position="bottom" data-tooltip="Facebook" href="#"><i class="fab fa-facebook"></i></a>
						<?php endif ?>
						<?php if (!empty($contacto[0]->twitter)): ?>
							<a href="<?= $contacto[0]->twitter ?>" target="_blank" class="tooltipped" data-position="bottom" data-tooltip="Twitter" href="#"><i class="fab fa-twitter"></i></a>
						<?php endif ?>
						<?php if (!empty($contacto[0]->instagram)): ?>
							<a href="<?= $contacto[0]->instagram ?>" target="_blank" class="tooltipped" data-position="bottom" data-tooltip="Instagram" href="#"><i class="fab fa-instagram"></i></a>
						<?php endif ?>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Footer -->

	<div class="footer">
		Copyright 2021 &#169; Mawii.co
	</div>

	<!-- Scrips -->
	<script src="./public/mawii/js/jquery.slim.min.js"></script>
	<script src="./public/mawii/sweetAlert/dist/sweetalert2.min.js"></script>
	<script src="./public/mawii/js/myJquery.js"></script>
	<script src="./public/mawii/js/materialize.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('.tooltipped').tooltip();
			$('.sidenav').sidenav();
		});
	</script>
	<script src="./public/mawii/slick/slick/slick.min.js"></script>
	<script type="text/javascript">
		$('.my_slick').slick({
		  	dots: false,
		  	autoplay: true,
		  	infinite: true,
		  	speed: 1000,
		  	slidesToScroll: 4,
		  	slidesToShow: 2,
		  	centerMode: true,
		  	variableWidth: true,
		  	adaptiveHeight: true,
		  	responsive: [
				{
					breakpoint: 768,
					settings: {
						arrows: false,
						centerMode: true,
						slidesToShow: 3
					}
				},
				{
					breakpoint: 480,
					settings: {
						arrows: false,
						centerMode: true,
						slidesToShow: 1
					}
				}
			]
		});
		$('.my_slick_2').slick({
			dots: false,
	  	    infinite: true,
	  	    speed: 500,
	  	    slidesToScroll: 1,
	  	    slidesToShow: 1,
	  	    centerMode: true,
	  	    arrows: false,
	  	    autoplay: true,
		})
	</script>
	<script src="./public/mawii/js/form.js"></script>
</body>
</html>