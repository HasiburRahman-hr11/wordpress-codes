<?php get_header(); ?>

<main>
    <section class="blog-area">
		<div class="blog-main">
			<?php
			if (have_posts()) :
				while (have_posts()) : the_post();
			?>
			<article class="blog-itme">
				<!-- Thumbnail -->
				<?php the_post_thumbnail();?>
				<!-- Date and Time -->
				<?php the_time('j') ?>
				<!-- Title -->
				<a href="<?php the_permalink(); ?>">
					<h2><?php the_title(); ?></h2>
				</a>
				<!-- Excerpt -->
				<?php the_excerpt(); ?>
				<!-- Author With Link to (author.php) -->
				<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' )); ?>"><?php the_author(); ?></a>
				<!-- Post Categories -->
				<?php the_category(); ?>              
			</article>
			<?php
				endwhile;
			endif;
			?>
			<!-- Post Pagination -->
			<?php the_posts_pagination(array(
				'prev_text' => '<i class="fas fa-chevron-left"></i>',
				'next_text' => '<i class="fas fa-chevron-right"></i>',
				'end_size' => 1,
				'mid_size' => 2,
				'screen_reader_text' => ' ',
				//'show_all' => true, // to hide ...
				'before_page_number' => '',
				'after_page_number' => ''
			)); ?>
		</div>
	
		<!-- Sidebar -->
		<div class="blog-sidebar">
			<?php dynamic_sidebar(''); ?>
		</div>
	</section>
</main>
<?php get_footer(); ?>