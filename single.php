<?php
/* 
Template Name: Notícias
*/
get_header(); ?>

	<header class="header page_header">
		<div class="header_inner container">
			<div class="header_logo"><a href="<?php bloginfo('url') ?>"><img src="<?php bloginfo('template_directory') ?>/imgs/hero_logo.png" alt="Logo CBCR"></a></div>
			<nav class="header_menu --desktop">
				<ul class="site_nav">
					<li><a href="<?php bloginfo('url') ?>#noticias">NOTÍCIAS</a></li>
					<li><a href="<?php bloginfo('url') ?>#ranking">CLASSIFICAÇÃO</a></li>
					<li><a href="<?php bloginfo('url') ?>#agenda">AGENDA</a></li>
					<li><a href="<?php bloginfo('url') ?>#sobre">A COPA</a></li>
				</ul>
			</nav>
			<button class="menu_burguer --mobile">
				<span></span>
				<span></span>
				<span></span>
			</button>
		</div>
	</header>
 
	<div class="container">

		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		
		<div class="post_header">
			<a class="post_return" href="<?php bloginfo('url') ?>/noticias">VOLTAR ÀS NOTÍCIAS</a>
			<h1 class="post_title"><?php the_title(); ?></h1>
			<p class="post_date"><?php the_date(); ?></p>
		</div>
		<div class="post_content">

		<?php 
		the_content();
		?>

		</div>

		<?php endwhile; ?>
		<?php endif; ?>
	
	</div>

<?php get_footer(); ?>