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
					<li><a href="<?php get_permalink(); ?>">NOTÍCIAS</a></li>
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

	<h1 class="page_title">Notícias</h1>
 
	<div class="container">

		<?php

		$noticias = new WP_Query('post_type=post&nopaging=1');

		if($noticias->have_posts()) :

		?>

		<div class="noticias_inner" role="main">
		 
			<?php while ( $noticias->have_posts() ) : $noticias->the_post(); ?>
			                 
				<article class="noticias_control">
					<div class="noticias_wrap">
						<div class="noticias_box">
							<?php if(get_field('is_externa') == 1) : ?>
								
								<a href="<?php the_field('link_externo'); ?>" target="_blank" class="noticias_url"></a>
								<i class="noticias_external fas fa-external-link-alt"></i>

							<?php else : ?>

								<a href="<?php the_permalink(); ?>" class="noticias_url"></a>

							<?php endif; ?>
							<img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
							<div class="noticias_box_text">
								<p class="noticias_box_date"><?php if(get_field('is_externa') == 1){ the_field('data_da_noticia'); } else { the_date(); } ?></p>
								<h3 class="noticias_box_title"><?php the_title(); ?></h3>
							</div>
						</div>
					</div>
				</article>
			 
			<?php endwhile; // end of the loop. ?>		 

		 <?php wp_reset_postdata();

		 endif;

		 ?>
		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>