<!DOCTYPE html>
<html lang="pt-br" dir="ltr">
	<head>
		<meta charset="UTF=8">
		<!--[if IE ]><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> <![endif]-->
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no">
		<title><?php bloginfo('name') ?></title>
		<link rel="apple-touch-icon" sizes="180x180" href="<?php bloginfo('template_directory') ?>/imgs/icons/apple-touch-icon.png">
		<link rel="icon" type="image/png" sizes="32x32" href="<?php bloginfo('template_directory') ?>/imgs/icons/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="16x16" href="<?php bloginfo('template_directory') ?>/imgs/icons/favicon-16x16.png">
		<link rel="manifest" href="<?php bloginfo('template_directory') ?>/imgs/icons/site.webmanifest">
		<link rel="mask-icon" href="<?php bloginfo('template_directory') ?>/imgs/icons/safari-pinned-tab.svg" color="#006ac6">
		<link rel="shortcut icon" href="<?php bloginfo('template_directory') ?>/imgs/icons/favicon.ico">
		<meta name="msapplication-TileColor" content="#006ac6">
		<meta name="msapplication-config" content="<?php bloginfo('template_directory') ?>/imgs/icons/browserconfig.xml">
		<meta name="theme-color" content="#000c11">
		<link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,500;1,500&family=Montserrat:ital,wght@0,400;0,500;0,700;1,400;1,500;1,700&display=swap" rel="stylesheet">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
		<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory') ?>/css/styles.css">
		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-173229722-1"></script>
		<script>
			window.dataLayer = window.dataLayer || [];
			function gtag(){dataLayer.push(arguments);}
			gtag('js', new Date());

			gtag('config', 'UA-173229722-1');
		</script>

	</head>
	<body <?php body_class(); ?>>
		<div class="page_container">
			<header class="header fixed_header">
				<div class="header_inner container">
					<div class="header_logo"><a href="<?php bloginfo('url') ?>"><img src="<?php bloginfo('template_directory') ?>/imgs/fixed_logo.png" alt="Logo CBCR"></a></div>
					<nav class="header_menu --desktop">
						<ul class="site_nav">
							<li><a href="#noticias">NOTÍCIAS</a></li>
							<li><a href="#agenda">AGENDA</a></li>
							<li><a href="#ranking">CLASSIFICAÇÃO</a></li>
							<li><a href="#stats">ESTATÍSTICAS</a></li>
							<li><a href="#sobre">A COPA</a></li>
						</ul>
					</nav>
				</div>
			</header>
			<div class="menu_burguer_fixed --mobile">
				<button class="menu_burguer">
					<span></span>
					<span></span>
					<span></span>
				</button>
			</div>
			<div class="menu_mobile_wrap">
				<nav class="menu_mobile">
					<ul class="site_nav">
						<li><a href="#noticias">NOTÍCIAS</a></li>
						<li><a href="#agenda">AGENDA</a></li>
						<li><a href="#ranking">CLASSIFICAÇÃO</a></li>
						<li><a href="#stats">ESTATÍSTICAS</a></li>
						<li><a href="#sobre">A COPA</a></li>
					</ul>
					<div class="menu_mobile_bg">
						<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 1071.42 1100.64" xml:space="preserve">
							<path d="M3.52,375.88c-1.16,32.73-1.66,66.58-1.49,101.5c163.19-16.87,327.3-25.96,491.5-27.29V338.08
								c-107.1,0.87-186.04,5.04-292.84,12.53c3.14-76.38,9.46-150.61,18.91-216.04c101.74-12.1,178.63-18.96,273.93-20.53V2.03
								C343.95,4.5,194.11,19.99,46.86,48.31C22.58,137.68,8.04,248.18,3.52,375.88z"/>
							<path d="M1024.56,48.31C877.3,19.99,727.45,4.49,577.87,2.03v224.03l-0.46,28.11c0.15,0,0.31,0.01,0.46,0.01v195.91
								c164.2,1.33,328.32,10.42,491.51,27.29c0.24-51.6-0.51-100.91-3.6-147.62c-2.59-39.12-68.98-68.02-118.38-82.02
								c48.19-8.03,110.07-18.43,105.67-54.19C1046.54,140.34,1036.39,91.86,1024.56,48.31z M851.34,131.32
								c3.73,25.48,6.99,52.34,9.76,80.15c-28.23-2.27-57.3-4.3-86.87-6.06c0-28.21,0-55.96,0-81.46
								C799.93,126.07,825.7,128.53,851.34,131.32z M774.24,343.39c0-10.05,0-20.52,0-31.3c0-16.23,0-33.16,0-50.35
								c31.31,1.88,62.06,4.07,91.78,6.54c1.94,26.34,3.49,53.25,4.63,80.45C838.53,346.63,806.39,344.86,774.24,343.39z"/>
							<path d="M493.53,1094.8c-104.79-38.43-278.99-117.34-470.97-266.68c-6.4-60.87-11.38-120.71-14.81-178.35
								c-1.78-29.86-3.13-59.11-4.09-87.76c162.63-17.04,326.21-26.22,489.86-27.57v106.39c-97.98,0.81-195.92,4.42-293.66,10.85
								c0.94,53.11,3.51,102.95,9.71,170.64c0,0,113.65,86.25,283.95,160.46V1094.8z"/>
							<path d="M577.87,537.26v560.21c25.74-12.29,56.4-24.47,90.65-39.72c29.11-12.96,62.86-29.07,100.14-48.69
								c1.81-43.31,3.06-90.81,3.92-138.48c0.25-13.8,18.17-19.03,25.77-7.51c13.57,20.57,32.8,51.58,58.11,96.6
								c39.99-23.92,101.23-66.69,145.16-97.9l-46.11-72.04c81.05-11.1,103.35-57.19,104.19-82.31c0.65-19.47,2.82-38.65,3.95-57.64
								c1.78-29.86,3.13-59.11,4.09-87.76C905.12,544.98,741.53,535.79,577.87,537.26z M774.14,729.34c0.14-28.56,0.18-55.44,0.17-79.55
								c31.61,1.28,63.21,2.91,94.78,4.88c-0.57,23.53-1.35,49.86-2.4,77.86C835.85,731.14,774.14,729.34,774.14,729.34z"/>
						</svg>
					</div>
					<div class="menu_mobile_logo"><img src="<?php bloginfo('template_directory') ?>/imgs/menu_mobile_logo.png" alt=""></div>
				</nav>
			</div>