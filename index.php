<?php get_header(); ?>
			<section class="hero" id="hero">
				<header class="header hero_header">
					<div class="header_inner container">
						<div class="header_logo"><a href="<?php bloginfo('url') ?>"><img src="<?php bloginfo('template_directory') ?>/imgs/hero_logo.png" alt="Logo CBCR"></a></div>
						<nav class="header_menu --desktop">
							<ul class="site_nav">
								<li><a href="#noticias">NOTÍCIAS</a></li>
								<li><a href="#agenda">AGENDA</a></li>
								<li><a href="#ranking">CLASSIFICAÇÃO</a></li>
								<li><a href="#stats">ESTATÍSTICAS</a></li>
								<li><a href="#sobre">A COPA</a></li>
							</ul>
						</nav>
						<button class="menu_burguer --mobile">
							<span></span>
							<span></span>
							<span></span>
						</button>
					</div>
				</header>
				<div class="hero_call_wrap container">
					<div class="hero_call">
						<p class="hero_call_minor">Boas-vindas à</p>
						<p class="hero_call_major">Copa Brasileira</p>
						<p class="hero_call_major">de Clash Royale!</p>
						<div class="hero_arrow_down">
							<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 43.58 18.05" xml:space="preserve">
							<polyline points="1.79,3.58 21.79,13.58 41.79,3.58 "/>
							</svg>
						</div>
					</div>
				</div>
			</section>
			<section class="noticias" id="noticias">
				<div class="container">
					<h2 class="noticias_main_title">Últimas Notícias</h2>
					<span class="noticias_seeall"><a href="<?php bloginfo('url'); ?>/noticias">VER TODAS</a></span>
					<div class="noticias_inner">
						<?php 
						$args = array(
							'post_type'			=> 'post',
							'posts_per_page'	=> 3
						);

						$the_query = new WP_Query($args);

						if ( $the_query->have_posts() ) :
						
						while ( $the_query->have_posts() ) : $the_query->the_post();

						?>

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
										<p class="noticias_box_date">
											<?php if(get_field('is_externa') == 1) {
													the_field('data_da_noticia');
												} else {
													the_date();
												}
											?>
										</p>
										<h3 class="noticias_box_title"><?php the_title(); ?></h3>
									</div>
								</div>
							</div>
						</article>

						<?php endwhile; ?>

						<?php wp_reset_postdata(); ?>

						<?php else : echo "Não há notícias disponíveis."; ?>

						<?php endif; ?>

					</div>
				</div>
			</section>
			<section class="agenda" id="agenda">
				<div class="container">
					<h2 class="agenda_title">Agenda</h2>
					<nav class="agenda_controllers --desktop">
						<ul>
							<li><a href="#">SEMANA 1</a></li>
							<li><a href="#">SEMANA 2</a></li>
							<li><a href="#">SEMANA 3</a></li>
							<li><a href="#">SEMANA 4</a></li>
							<li><a href="#">PLAYOFFS</a></li>
						</ul>
					</nav>
					<nav class="agenda_controllers --mobile">
						<ul>
							<li><a href="#">SEMANA 1</a></li>
							<li><a href="#">SEMANA 2</a></li>
							<li><a href="#">SEMANA 3</a></li>
							<li><a href="#">SEMANA 4</a></li>
							<li><a href="#">PLAYOFFS</a></li>
						</ul>
					</nav>
					<div class="agenda_slider_wrap">
						<!-- SEMANA 1 SLIDER -->
						<div class="agenda_slider_container">

							<?php 
							$s1 = array(
								'post_type'			=> 'partidas',
								'posts_per_page'	=> -1,
								'meta_query' 		=> array(
									'relation'		=> 'AND',
									'semana_clause'	=> array(
										'key' 		=> 'semana',
										'value'		=> 's1'
									),
									'dia_clause'	=> array(
										'key' 		=> 'dia',
										'compare'	=> 'EXISTS'
									),
									'hora_clause'	=> array(
										'key' 		=> 'hora',
										'compare'	=> 'EXISTS'
									)
								),
								'orderby'			=> array(
									'semana_clause'	=> 'ASC',
									'dia_clause'	=> 'ASC',
									'hora_clause'	=> 'ASC'
								)
							);

							$partidas1 = new WP_Query( $s1 );

							if ( $partidas1->have_posts() ):
							?>	

							<div class="agenda_slider">

								<?php while ( $partidas1->have_posts() ) : $partidas1->the_post();

									$hasresults		= get_field('hasresults') == 1;
									$isSerieA 		= get_field('serie') == 'A';
									$isSerieB 		= get_field('serie') == 'B';
									$serie 			= get_field('serie');
									$didTeam1Lost 	= get_field('resultado2') > get_field('resultado1');
									$didTeam2Lost 	= get_field('resultado1') > get_field('resultado2');
									$results1		= get_field('resultado1');
									$results2		= get_field('resultado2');
									$A1				= get_field('time_1_serie_a');
									$A2				= get_field('time_2_serie_a');
									$B1				= get_field('time_1_serie_b');
									$B2				= get_field('time_2_serie_b');
									
								?>

								<div class="agenda_partida_box">
									<div class="agenda_partida <?php if($hasresults) { echo "hasresults"; } ?>">
										<p class="agenda_partida_serie">SÉRIE <span class="<?php if($isSerieA){ echo "seriea"; } elseif($isSerieB){ echo "serieb"; } ?>"><?php echo $serie; ?></span></p>
										<p class="agenda_partida_day"><?php the_field('dia'); ?></p>
										<p class="agenda_partida_hour"><?php the_field('hora'); ?></p>
										
										<div class="agenda_partida_team1 <?php if($didTeam1Lost) { echo "loser"; } ?>">
											<div class="agenda_partida_teamlogo">
												<?php if(($isSerieA && !$A1) || ($isSerieB && !$B1)): ?>
													<p class="agenda_partida_nodefined">N/D</p>
												<?php else: ?>
													<img src="<?php bloginfo('template_directory') ?>/imgs/teams/<?php if($isSerieA) { if($A1 == "ttp"){echo "csc";} elseif($A1 == "ttpa"){ echo "cta";} else{echo $A1;} } elseif($isSerieB) { if($B1 == "ttp"){echo "csc";} elseif($B1 == "ttpa"){ echo "cta";} else{echo $B1;} } ?>.png" alt="<?php if($isSerieA) { echo $A1; } elseif($isSerieB) { echo $B1; } ?>">
												<?php endif; ?>
											</div>
											<?php if($hasresults): ?>
											<p class="agenda_partida_results"><?php echo $results1; ?></p>
											<?php endif; ?>
										</div>

										<div class="agenda_partida_team2 <?php if($didTeam2Lost) { echo "loser"; } ?>">
											<div class="agenda_partida_teamlogo">
												<?php if(($isSerieA && !$A2) || ($isSerieB && !$B2)): ?>
													<p class="agenda_partida_nodefined">N/D</p>
												<?php else: ?>
													<img src="<?php bloginfo('template_directory') ?>/imgs/teams/<?php if($isSerieA) { if($A2 == "ttp"){echo "csc";} elseif($A2 == "ttpa"){ echo "cta";} else{echo $A2;} } elseif($isSerieB) { if($B2 == "ttp"){echo "csc";} elseif($B2 == "ttpa"){ echo "cta";} else{echo $B2;} } ?>.png" alt="<?php if($isSerieA) { echo $A2; } elseif($isSerieB) { echo $B2; } ?>">
												<?php endif; ?>
											</div>
											<?php if($hasresults): ?>
											<p class="agenda_partida_results"><?php echo $results2; ?></p>
											<?php endif; ?>
										</div>
										<p class="agenda_partida_playoffs"><?php if(get_field('playoffs')){ the_field('playoffs'); } ?></p>
										<span class="agenda_partida_vs">VS</span>
									</div>
								</div>

								<?php endwhile; ?>

								<?php wp_reset_postdata(); ?>
							</div>
							<?php endif; ?>
						</div>
						<!-- SEMANA 2 SLIDER -->
						<div class="agenda_slider_container">

							<?php 
							$s2 = array(
								'post_type'			=> 'partidas',
								'posts_per_page'	=> -1,
								'meta_query' 		=> array(
									'relation'		=> 'AND',
									'semana_clause'	=> array(
										'key' 		=> 'semana',
										'value'		=> 's2'
									),
									'dia_clause'	=> array(
										'key' 		=> 'dia',
										'compare'	=> 'EXISTS'
									),
									'hora_clause'	=> array(
										'key' 		=> 'hora',
										'compare'	=> 'EXISTS'
									)
								),
								'orderby'			=> array(
									'semana_clause'	=> 'ASC',
									'dia_clause'	=> 'ASC',
									'hora_clause'	=> 'ASC'
								)
							);

							$partidas2 = new WP_Query( $s2 );

							if ( $partidas2->have_posts() ):
							?>	

							<div class="agenda_slider">

								<?php while ( $partidas2->have_posts() ) : $partidas2->the_post();

									$hasresults		= get_field('hasresults') == 1;
									$isSerieA 		= get_field('serie') == 'A';
									$isSerieB 		= get_field('serie') == 'B';
									$serie 			= get_field('serie');
									$didTeam1Lost 	= get_field('resultado2') > get_field('resultado1');
									$didTeam2Lost 	= get_field('resultado1') > get_field('resultado2');
									$results1		= get_field('resultado1');
									$results2		= get_field('resultado2');
									$A1				= get_field('time_1_serie_a');
									$A2				= get_field('time_2_serie_a');
									$B1				= get_field('time_1_serie_b');
									$B2				= get_field('time_2_serie_b');
									
								?>

								<div class="agenda_partida_box">
									<div class="agenda_partida <?php if($hasresults) { echo "hasresults"; } ?>">
										<p class="agenda_partida_serie">SÉRIE <span class="<?php if($isSerieA){ echo "seriea"; } elseif($isSerieB){ echo "serieb"; } ?>"><?php echo $serie; ?></span></p>
										<p class="agenda_partida_day"><?php the_field('dia'); ?></p>
										<p class="agenda_partida_hour"><?php the_field('hora'); ?></p>
										
										<div class="agenda_partida_team1 <?php if($didTeam1Lost) { echo "loser"; } ?>">
											<div class="agenda_partida_teamlogo">
												<?php if(($isSerieA && !$A1) || ($isSerieB && !$B1)): ?>
													<p class="agenda_partida_nodefined">N/D</p>
												<?php else: ?>
													<img src="<?php bloginfo('template_directory') ?>/imgs/teams/<?php if($isSerieA) { if($A1 == "ttp"){echo "csc";} elseif($A1 == "ttpa"){ echo "cta";} else{echo $A1;} } elseif($isSerieB) { if($B1 == "ttp"){echo "csc";} elseif($B1 == "ttpa"){ echo "cta";} else{echo $B1;} } ?>.png" alt="<?php if($isSerieA) { echo $A1; } elseif($isSerieB) { echo $B1; } ?>">
												<?php endif; ?>
											</div>
											<?php if($hasresults): ?>
											<p class="agenda_partida_results"><?php echo $results1; ?></p>
											<?php endif; ?>
										</div>

										<div class="agenda_partida_team2 <?php if($didTeam2Lost) { echo "loser"; } ?>">
											<div class="agenda_partida_teamlogo">
												<?php if(($isSerieA && !$A2) || ($isSerieB && !$B2)): ?>
													<p class="agenda_partida_nodefined">N/D</p>
												<?php else: ?>
													<img src="<?php bloginfo('template_directory') ?>/imgs/teams/<?php if($isSerieA) { if($A2 == "ttp"){echo "csc";} elseif($A2 == "ttpa"){ echo "cta";} else{echo $A2;} } elseif($isSerieB) { if($B2 == "ttp"){echo "csc";} elseif($B2 == "ttpa"){ echo "cta";} else{echo $B2;} } ?>.png" alt="<?php if($isSerieA) { echo $A2; } elseif($isSerieB) { echo $B2; } ?>">
												<?php endif; ?>
											</div>
											<?php if($hasresults): ?>
											<p class="agenda_partida_results"><?php echo $results2; ?></p>
											<?php endif; ?>
										</div>
										<p class="agenda_partida_playoffs"><?php if(get_field('playoffs')){ the_field('playoffs'); } ?></p>
										<span class="agenda_partida_vs">VS</span>
									</div>
								</div>

								<?php endwhile; ?>

								<?php wp_reset_postdata(); ?>
							</div>
							<?php endif; ?>
						</div>
						<!-- SEMANA 3 SLIDER -->
						<div class="agenda_slider_container">

							<?php 
							$s3 = array(
								'post_type'			=> 'partidas',
								'posts_per_page'	=> -1,
								'meta_query' 		=> array(
									'relation'		=> 'AND',
									'semana_clause'	=> array(
										'key' 		=> 'semana',
										'value'		=> 's3'
									),
									'dia_clause'	=> array(
										'key' 		=> 'dia',
										'compare'	=> 'EXISTS'
									),
									'hora_clause'	=> array(
										'key' 		=> 'hora',
										'compare'	=> 'EXISTS'
									)
								),
								'orderby'			=> array(
									'semana_clause'	=> 'ASC',
									'dia_clause'	=> 'ASC',
									'hora_clause'	=> 'ASC'
								)
							);

							$partidas3 = new WP_Query( $s3 );

							if ( $partidas3->have_posts() ):
							?>	

							<div class="agenda_slider">

								<?php while ( $partidas3->have_posts() ) : $partidas3->the_post();

									$hasresults		= get_field('hasresults') == 1;
									$isSerieA 		= get_field('serie') == 'A';
									$isSerieB 		= get_field('serie') == 'B';
									$serie 			= get_field('serie');
									$didTeam1Lost 	= get_field('resultado2') > get_field('resultado1');
									$didTeam2Lost 	= get_field('resultado1') > get_field('resultado2');
									$results1		= get_field('resultado1');
									$results2		= get_field('resultado2');
									$A1				= get_field('time_1_serie_a');
									$A2				= get_field('time_2_serie_a');
									$B1				= get_field('time_1_serie_b');
									$B2				= get_field('time_2_serie_b');
									
								?>

								<div class="agenda_partida_box">
									<div class="agenda_partida <?php if($hasresults) { echo "hasresults"; } ?>">
										<p class="agenda_partida_serie">SÉRIE <span class="<?php if($isSerieA){ echo "seriea"; } elseif($isSerieB){ echo "serieb"; } ?>"><?php echo $serie; ?></span></p>
										<p class="agenda_partida_day"><?php the_field('dia'); ?></p>
										<p class="agenda_partida_hour"><?php the_field('hora'); ?></p>
										
										<div class="agenda_partida_team1 <?php if($didTeam1Lost) { echo "loser"; } ?>">
											<div class="agenda_partida_teamlogo">
												<?php if(($isSerieA && !$A1) || ($isSerieB && !$B1)): ?>
													<p class="agenda_partida_nodefined">N/D</p>
												<?php else: ?>
													<img src="<?php bloginfo('template_directory') ?>/imgs/teams/<?php if($isSerieA) { if($A1 == "ttp"){echo "csc";} elseif($A1 == "ttpa"){ echo "cta";} else{echo $A1;} } elseif($isSerieB) { if($B1 == "ttp"){echo "csc";} elseif($B1 == "ttpa"){ echo "cta";} else{echo $B1;} } ?>.png" alt="<?php if($isSerieA) { echo $A1; } elseif($isSerieB) { echo $B1; } ?>">
												<?php endif; ?>
											</div>
											<?php if($hasresults): ?>
											<p class="agenda_partida_results"><?php echo $results1; ?></p>
											<?php endif; ?>
										</div>

										<div class="agenda_partida_team2 <?php if($didTeam2Lost) { echo "loser"; } ?>">
											<div class="agenda_partida_teamlogo">
												<?php if(($isSerieA && !$A2) || ($isSerieB && !$B2)): ?>
													<p class="agenda_partida_nodefined">N/D</p>
												<?php else: ?>
													<img src="<?php bloginfo('template_directory') ?>/imgs/teams/<?php if($isSerieA) { if($A2 == "ttp"){echo "csc";} elseif($A2 == "ttpa"){ echo "cta";} else{echo $A2;} } elseif($isSerieB) { if($B2 == "ttp"){echo "csc";} elseif($B2 == "ttpa"){ echo "cta";} else{echo $B2;} } ?>.png" alt="<?php if($isSerieA) { echo $A2; } elseif($isSerieB) { echo $B2; } ?>">
												<?php endif; ?>
											</div>
											<?php if($hasresults): ?>
											<p class="agenda_partida_results"><?php echo $results2; ?></p>
											<?php endif; ?>
										</div>
										<p class="agenda_partida_playoffs"><?php if(get_field('playoffs')){ the_field('playoffs'); } ?></p>
										<span class="agenda_partida_vs">VS</span>
									</div>
								</div>

								<?php endwhile; ?>

								<?php wp_reset_postdata(); ?>
							</div>
							<?php endif; ?>
						</div>
						<!-- SEMANA 4 SLIDER -->
						<div class="agenda_slider_container">

							<?php 
							$s4 = array(
								'post_type'			=> 'partidas',
								'posts_per_page'	=> -1,
								'meta_query' 		=> array(
									'relation'		=> 'AND',
									'semana_clause'	=> array(
										'key' 		=> 'semana',
										'value'		=> 's4'
									),
									'dia_clause'	=> array(
										'key' 		=> 'dia',
										'compare'	=> 'EXISTS'
									),
									'hora_clause'	=> array(
										'key' 		=> 'hora',
										'compare'	=> 'EXISTS'
									)
								),
								'orderby'			=> array(
									'semana_clause'	=> 'ASC',
									'dia_clause'	=> 'ASC',
									'hora_clause'	=> 'ASC'
								)
							);

							$partidas4 = new WP_Query( $s4 );

							if ( $partidas4->have_posts() ):
							?>	

							<div class="agenda_slider">

								<?php while ( $partidas4->have_posts() ) : $partidas4->the_post();

									$hasresults		= get_field('hasresults') == 1;
									$isSerieA 		= get_field('serie') == 'A';
									$isSerieB 		= get_field('serie') == 'B';
									$serie 			= get_field('serie');
									$didTeam1Lost 	= get_field('resultado2') > get_field('resultado1');
									$didTeam2Lost 	= get_field('resultado1') > get_field('resultado2');
									$results1		= get_field('resultado1');
									$results2		= get_field('resultado2');
									$A1				= get_field('time_1_serie_a');
									$A2				= get_field('time_2_serie_a');
									$B1				= get_field('time_1_serie_b');
									$B2				= get_field('time_2_serie_b');
									
								?>

								<div class="agenda_partida_box">
									<div class="agenda_partida <?php if($hasresults) { echo "hasresults"; } ?>">
										<p class="agenda_partida_serie">SÉRIE <span class="<?php if($isSerieA){ echo "seriea"; } elseif($isSerieB){ echo "serieb"; } ?>"><?php echo $serie; ?></span></p>
										<p class="agenda_partida_day"><?php the_field('dia'); ?></p>
										<p class="agenda_partida_hour"><?php the_field('hora'); ?></p>
										
										<div class="agenda_partida_team1 <?php if($didTeam1Lost) { echo "loser"; } ?>">
											<div class="agenda_partida_teamlogo">
												<?php if(($isSerieA && !$A1) || ($isSerieB && !$B1)): ?>
													<p class="agenda_partida_nodefined">N/D</p>
												<?php else: ?>
													<img src="<?php bloginfo('template_directory') ?>/imgs/teams/<?php if($isSerieA) { if($A1 == "ttp"){echo "csc";} elseif($A1 == "ttpa"){ echo "cta";} else{echo $A1;} } elseif($isSerieB) { if($B1 == "ttp"){echo "csc";} elseif($B1 == "ttpa"){ echo "cta";} else{echo $B1;} } ?>.png" alt="<?php if($isSerieA) { echo $A1; } elseif($isSerieB) { echo $B1; } ?>">
												<?php endif; ?>
											</div>
											<?php if($hasresults): ?>
											<p class="agenda_partida_results"><?php echo $results1; ?></p>
											<?php endif; ?>
										</div>

										<div class="agenda_partida_team2 <?php if($didTeam2Lost) { echo "loser"; } ?>">
											<div class="agenda_partida_teamlogo">
												<?php if(($isSerieA && !$A2) || ($isSerieB && !$B2)): ?>
													<p class="agenda_partida_nodefined">N/D</p>
												<?php else: ?>
													<img src="<?php bloginfo('template_directory') ?>/imgs/teams/<?php if($isSerieA) { if($A2 == "ttp"){echo "csc";} elseif($A2 == "ttpa"){ echo "cta";} else{echo $A2;} } elseif($isSerieB) { if($B2 == "ttp"){echo "csc";} elseif($B2 == "ttpa"){ echo "cta";} else{echo $B2;} } ?>.png" alt="<?php if($isSerieA) { echo $A2; } elseif($isSerieB) { echo $B2; } ?>">
												<?php endif; ?>
											</div>
											<?php if($hasresults): ?>
											<p class="agenda_partida_results"><?php echo $results2; ?></p>
											<?php endif; ?>
										</div>
										<p class="agenda_partida_playoffs"><?php if(get_field('playoffs')){ the_field('playoffs'); } ?></p>
										<span class="agenda_partida_vs">VS</span>
									</div>
								</div>

								<?php endwhile; ?>

								<?php wp_reset_postdata(); ?>
							</div>
							<?php endif; ?>
						</div>
						<!-- PLAYOFFS SLIDER -->
						<div class="agenda_slider_container">

							<?php 
							$pl = array(
								'post_type'			=> 'partidas',
								'posts_per_page'	=> -1,
								'meta_query' 		=> array(
									'relation'		=> 'AND',
									'semana_clause'	=> array(
										'key' 		=> 'semana',
										'value'		=> 'pl'
									),
									'dia_clause'	=> array(
										'key' 		=> 'dia',
										'compare'	=> 'EXISTS'
									),
									'hora_clause'	=> array(
										'key' 		=> 'hora',
										'compare'	=> 'EXISTS'
									)
								),
								'orderby'			=> array(
									'semana_clause'	=> 'ASC',
									'dia_clause'	=> 'ASC',
									'hora_clause'	=> 'ASC'
								)
							);

							$partidapl = new WP_Query( $pl );

							if ( $partidapl->have_posts() ):
							?>	

							<div class="agenda_slider">

								<?php while ( $partidapl->have_posts() ) : $partidapl->the_post();

									$hasresults		= get_field('hasresults') == 1;
									$isSerieA 		= get_field('serie') == 'A';
									$isSerieB 		= get_field('serie') == 'B';
									$serie 			= get_field('serie');
									$didTeam1Lost 	= get_field('resultado2') > get_field('resultado1');
									$didTeam2Lost 	= get_field('resultado1') > get_field('resultado2');
									$results1		= get_field('resultado1');
									$results2		= get_field('resultado2');
									$A1				= get_field('time_1_serie_a');
									$A2				= get_field('time_2_serie_a');
									$B1				= get_field('time_1_serie_b');
									$B2				= get_field('time_2_serie_b');
									
								?>

								<div class="agenda_partida_box">
									<div class="agenda_partida <?php if($hasresults) { echo "hasresults"; } ?>">
										<p class="agenda_partida_serie">SÉRIE <span class="<?php if($isSerieA){ echo "seriea"; } elseif($isSerieB){ echo "serieb"; } ?>"><?php echo $serie; ?></span></p>
										<p class="agenda_partida_day"><?php the_field('dia'); ?></p>
										<p class="agenda_partida_hour"><?php the_field('hora'); ?></p>
										
										<div class="agenda_partida_team1 <?php if($didTeam1Lost) { echo "loser"; } ?>">
											<div class="agenda_partida_teamlogo">
												<?php if(($isSerieA && !$A1) || ($isSerieB && !$B1)): ?>
													<p class="agenda_partida_nodefined">N/D</p>
												<?php else: ?>
													<img src="<?php bloginfo('template_directory') ?>/imgs/teams/<?php if($isSerieA) { if($A1 == "ttp"){echo "csc";} elseif($A1 == "ttpa"){ echo "cta";} else{echo $A1;} } elseif($isSerieB) { if($B1 == "ttp"){echo "csc";} elseif($B1 == "ttpa"){ echo "cta";} else{echo $B1;} } ?>.png" alt="<?php if($isSerieA) { echo $A1; } elseif($isSerieB) { echo $B1; } ?>">
												<?php endif; ?>
											</div>
											<?php if($hasresults): ?>
											<p class="agenda_partida_results"><?php echo $results1; ?></p>
											<?php endif; ?>
										</div>

										<div class="agenda_partida_team2 <?php if($didTeam2Lost) { echo "loser"; } ?>">
											<div class="agenda_partida_teamlogo">
												<?php if(($isSerieA && !$A2) || ($isSerieB && !$B2)): ?>
													<p class="agenda_partida_nodefined">N/D</p>
												<?php else: ?>
													<img src="<?php bloginfo('template_directory') ?>/imgs/teams/<?php if($isSerieA) { if($A2 == "ttp"){echo "csc";} elseif($A2 == "ttpa"){ echo "cta";} else{echo $A2;} } elseif($isSerieB) { if($B2 == "ttp"){echo "csc";} elseif($B2 == "ttpa"){ echo "cta";} else{echo $B2;} } ?>.png" alt="<?php if($isSerieA) { echo $A2; } elseif($isSerieB) { echo $B2; } ?>">
												<?php endif; ?>
											</div>
											<?php if($hasresults): ?>
											<p class="agenda_partida_results"><?php echo $results2; ?></p>
											<?php endif; ?>
										</div>
										<p class="agenda_partida_playoffs"><?php if(get_field('playoffs')){ the_field('playoffs'); } ?></p>
										<span class="agenda_partida_vs">VS</span>
									</div>
								</div>

								<?php endwhile; ?>

								<?php wp_reset_postdata(); ?>
							</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</section>
			<section class="ranking" id="ranking">
				<div class="minor_container">
					<h2>Classificação</h2>
					<div class="ranking_panel">
						<a href="#" class="ranking_controller">SÉRIE <span class="seriea">A</span></a>
						<a href="#" class="ranking_controller disabled">SÉRIE <span class="serieb">B</span></a>
					</div>
					<div class="ranking_table table--seriea">
						<h3 class="ranking_table_title">GRUPO 1</h3>
						<?php echo do_shortcode("[serie id=a1 /]"); ?>
						<h3 class="ranking_table_title">GRUPO 2</h3>
						<?php echo do_shortcode("[serie id=a2 /]"); ?>
					</div>
					<div class="ranking_table table--serieb">
						<h3 class="ranking_table_title">GRUPO 1</h3>
						<?php echo do_shortcode("[serie id=b1 /]"); ?>
						<h3 class="ranking_table_title">GRUPO 2</h3>
						<?php echo do_shortcode("[serie id=b2 /]"); ?>
					</div>
					<h2 id="stats">Estatísticas</h2>
					<div class="stats_sub">
						<div class="stats_sub_row">
							<div class="stats_sub_item">
								<div class="stats_sub_item_inner">
									<div class="stats_sub_icon">
										<img src="<?php bloginfo('template_directory') ?>/imgs/badges/bd-icon.png" alt="Beatdown">
									</div>
									<p>BEATDOWN</p>
								</div>
							</div>
							<div class="stats_sub_item">
								<div class="stats_sub_item_inner">
									<div class="stats_sub_icon">
										<img src="<?php bloginfo('template_directory') ?>/imgs/badges/ct-icon.png" alt="Control">
									</div>
									<p>CONTROL</p>
								</div>
							</div>
							<div class="stats_sub_item">
								<div class="stats_sub_item_inner">
									<div class="stats_sub_icon">
										<img src="<?php bloginfo('template_directory') ?>/imgs/badges/cy-icon.png" alt="Cycle">
									</div>
									<p>CYCLE</p>
								</div>
							</div>
							<div class="stats_sub_item">
								<div class="stats_sub_item_inner">
									<div class="stats_sub_icon">
										<img src="<?php bloginfo('template_directory') ?>/imgs/badges/sg-icon.png" alt="Siege">
									</div>
									<p>SIEGE</p>
								</div>
							</div>
						</div>
						<div class="stats_sub_row stats_sub_tier">
							<div class="stats_sub_item">
								<div class="stats_sub_item_inner">
									<div class="stats_sub_icon">
										<span class="stats_sub_tier_gold"></span>
									</div>
									<p>OURO</p>
								</div>
							</div>
							<div class="stats_sub_item">
								<div class="stats_sub_item_inner">
									<div class="stats_sub_icon">
										<span class="stats_sub_tier_silver"></span>
									</div>
									<p>PRATA</p>
								</div>
							</div>
							<div class="stats_sub_item">
								<div class="stats_sub_item_inner">
									<div class="stats_sub_icon">
										<span class="stats_sub_tier_bronze"></span>
									</div>
									<p>BRONZE</p>
								</div>
							</div>
						</div>
					</div>
					<div class="stats_table table--seriea">
						<?php echo do_shortcode("[serie id=winrate-a /]"); ?>
						<div class="stats_table_showmore"><span>MOSTRAR MAIS</span></div>
						<div class="stats_table_showless"><span>MOSTRAR MENOS</span></div>
					</div>
					<div class="stats_table table--serieb">
						<?php echo do_shortcode("[serie id=winrate-b /]"); ?>
						<div class="stats_table_showmore"><span>MOSTRAR MAIS</span></div>
						<div class="stats_table_showless"><span>MOSTRAR MENOS</span></div>
					</div>
				</div>
				<div class="ranking_team_group">
					<div class="ranking_team --a">
						<div class="ranking_team_wrapper">
							<button class="ranking_team_close">
								<span></span>
								<span></span>
							</button>
							<div class="ranking_team_top">
								<div class="ranking_team_row">
									<div class="ranking_team_stats series_info">
										<div class="ranking_team_stats_content">
											<div class="ranking_team_stats_box">
												<span class="ranking_team_stats_header">SÉRIE</span>
												<span class="ranking_team_stats_number js--teaminfo_series"></span>
											</div>
											<div class="ranking_team_stats_box">
												<div class="ranking_team_stats_header">GRUPO</div>
												<span class="ranking_team_stats_number js--teaminfo_group"></span>
											</div>
											<div class="ranking_team_stats_box">
												<div class="ranking_team_stats_header">POSIÇÃO</div>
												<span class="ranking_team_stats_number js--teaminfo_pos"></span>
											</div>
										</div>
									</div>
									<div class="ranking_team_header">
										<div class="ranking_team_logo">
											<img class="js--teaminfo_logo" src="" alt="teamlogo">
										</div>
										<h3 class="ranking_team_name js--teaminfo_name"></h3>
										<div class="ranking_team_social js--teaminfo_social">
										</div>
									</div>
									<div class="ranking_team_stats series_matches">
										<div class="ranking_team_stats_content">
											<div class="ranking_team_stats_box">
												<div class="ranking_team_stats_header">VITÓRIAS</div>
												<span class="ranking_team_stats_number js--teaminfo_wins">0</span>
											</div>
											<div class="ranking_team_stats_box">
												<div class="ranking_team_stats_header">DERROTAS</div>
												<span class="ranking_team_stats_number js--teaminfo_loses">0</span>
											</div>
											<div class="ranking_team_stats_box">
												<div class="ranking_team_stats_header">SALDO</div>
												<span class="ranking_team_stats_number js--teaminfo_saldos">0</span>
											</div>
											<div class="ranking_team_stats_box">
												<div class="ranking_team_stats_header">JOGOS</div>
												<span class="ranking_team_stats_number js--teaminfo_jogos">0</span>
											</div>
										</div>
									</div>
								</div>
								<img class="ranking_team_watermark js--teaminfo_logo-bg" src="" alt="teamlogo">
							</div>
							<div class="ranking_team_title_row">
								<div class="ranking_team_title_wrapper">
									<h4 class="ranking_team_title">Staff</h4>
									<div class="ranking_team_title_separator">
										<span class="ranking_team_title_line"></span>
									</div>
								</div>
							</div>
							<div class="ranking_team_container">
								<div class="ranking_team_staff">
								</div>
							</div>
							<div class="ranking_team_title_row">
								<div class="ranking_team_title_wrapper">
									<h4 class="ranking_team_title">Roster</h4>
									<div class="ranking_team_title_separator">
										<span class="ranking_team_title_line"></span>
									</div>
								</div>
							</div>
							<div class="ranking_team_container">
								<div class="ranking_team_roster">
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
			<section class="sobre" id="sobre">
				<div class="minor_container sobre_content">
					<h3>SOBRE A COPA</h3>
					<div class="sobre_descricao">
						<p>A <strong>Copa Brasileira de Clash Royale</strong> surgiu com o intuito de revolucionar o cenário brasileiro nesta modalidade, e visa fomentar o mercado competitivo de Clash Royale.</p>
						<p>Com o apoio da Supercell, este se dando tanto na divulgação em redes sociais quanto divulgação in-game, o torneio busca estimular o investimento dos times de e-Sports nas lines do jogo, além de proporcionar o surgimento de novos atletas que poderão no futuro estar em uma competição mundial.</p>
					</div>
					<div class="sobre_coroa"><img src="<?php bloginfo('template_directory') ?>/imgs/coroa.png" alt="CBCR"></div>
					<div class="separator_container">
						<span class="separator"></span>
					</div>
				</div>
				<div class="minor_container sobre_casters">
					<div class="sobre_imgs">
						<div class="sobre_imgs_slider">
							<img src="<?php bloginfo('template_directory') ?>/imgs/casters/bruno.jpg" alt="BrunoClash">
							<img src="<?php bloginfo('template_directory') ?>/imgs/casters/decow.jpg" alt="Decow">
							<img src="<?php bloginfo('template_directory') ?>/imgs/casters/guzzo.jpg" alt="Guzzo">
							<img src="<?php bloginfo('template_directory') ?>/imgs/casters/luna.jpg" alt="Luna">
							<img src="<?php bloginfo('template_directory') ?>/imgs/casters/thay.jpg" alt="Thay">
						</div>
						<div class="sobre_imgs_name">
							<h4 class="active">BRUNO CLASH</h4>
							<h4>DECOW</h4>
							<h4>GUZZO</h4>
							<h4>LUNA</h4>
							<h4>THAY</h4>
						</div>
					</div>
					<div class="sobre_text">
						<div class="sobre_text_caster">
							<p>BrunoClash é narrador e hoje tem o maior canal de um narrador de eSports do Brasil no Youtube!</p>
							<p>Indicado ao Prêmio Jovem Brasileiro de 2018 e Melhor Caster do Ano de 2019 pelo Prêmio eSports Brasil, é uma das principais vozes do cenário de Clash Royale, Brawl Stars e Clash of Clans pela Supercell em Lingua Portuguesa. Empresa a qual é parceiro há mais de 4 anos.</p>
						</div>
						<div class="sobre_text_caster">
							<p>Decow está há 3 anos no cenário dos eSports, é narrador oficial da Supercell e é ex jogador profissional de Clash Royale, tendo nos seus títulos um bicampeonato universitário e o Desafio Internacional Brasil-Portugal.</p>
						</div>
						<div class="sobre_text_caster">
							<p>Guzzo Clash, criador de conteúdo sobre Clash Royale desde 2017, narrador e comentarista na CRL Latam 2018 sediada no México, criador de quadros exclusivos no cenário como #DicasDeUmTopBR e #DebateRoyale, atualmente parceiro oficial da Supercell.</p>
						</div>
						<div class="sobre_text_caster">
							<p>Michelle Murta (Luna), apaixonada pelo universo gamer e em especial os jogos da Supercell, por 3 anos foi manager Latam do Nova Esports, responsável por gerenciamento de clãs e times competitivos na região.</p>
						</div>
						<div class="sobre_text_caster">
							<p>Entrou no cenário competitivo de e-Sports em Janeiro de 2019, como Capitã de Times. Menos de 60 dias foi convidada para compor a Staff do Team Urban Esports do Peru, onde adquiriu muita experiência, títulos, conquistas e conhecimento no LATAM. Fim de 2019 voltou para o Cenário Brasileiro trazendo consigo a Liga GEMS, Liga bem aceita pela Comunidade e apoiada pela Supercell, uma liga que ultrapassou fronteiras e se estendeu em toda a América Latina.</p>
							<p>Em maio de 2020 juntamente com Luna, Bruno, Decow e Guzzo, idealizaram o projeto da Copa Brasileira, no mês de julho o sonho se torna realidade sendo a maior competição do Brasil. Atualmente também é Geral e-Sports do Team Solid, equipe que vem crescendo no cenário de e-Sports.</p>
						</div>
					</div>
				</div>
			</section>
			<section class="donate">
				<div class="minor_container">
					<h3>APOIE A COPA!</h3>
					<div class="donate_wrap">
						<p><strong>Seja um apoiador da CBCR</strong> e ajude-nos a expandir este projeto inovador, não só para o Clash Royale mas também em todo o cenário de esportes eletrônicos!</p>
						<div class="donate_button">
							<a href="https://www.patreon.com/cbcr" target="_blank"><img src="<?php bloginfo('template_directory') ?>/imgs/patreon.png" alt="Apoie-nos!"></a>
						</div>
					</div>
				</div>
			</section>

<?php get_footer(); ?>