<?php
get_header();
?>

<!--------------Content--------------->

		<?php
			$zboomGallery = new WP_Query(array(
				'post_type' => 'zboomgallery',
				'posts_per_page' => -1,
				'orderby' => 'menu_order',
				'order' => 'ASC'
			));
		?>

		<?php while( $zboomGallery-> have_posts(  ) ) : $zboomGallery-> the_post(); ?>

			<div class="col-1-4">
				<div class="wrap-col">
					<article>
						<?php the_post_thumbnail(); ?>
						<h2>
							<a href="<?php the_permalink(); ?>">
								<?php the_title(); ?>
							</a>
						</h2>
					</article>
				</div>
			</div>
			
		<?php endwhile; ?>


<?php get_footer(); ?>