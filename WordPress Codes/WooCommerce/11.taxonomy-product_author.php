<?php

/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined('ABSPATH') || exit;

get_header('shop');

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
do_action('woocommerce_before_main_content');

?>

<div class="content-wrap mt-4">
	<div class="container">
		<div class="row">
			<div class="col-lg-3 left-sidebar">
				<div class="sidebar-inner">
					<?php dynamic_sidebar('sidebar_widget-1'); ?>
				</div>
			</div>
			<div class="col-lg-9 col-md-12 col-12 content-area">



				<div class="content-author-meta mb-3">
					<div class="row">
						<div class="col-lg-2 col-md-2 col-sm-4 col-6">
							<div class="content-author-img">

							<?php
							$terms = get_the_terms($post->ID, 'product_author');
							if (!$terms == '') {
								foreach ($terms as $term) {
									$term_link = get_term_link($term, 'product_author');
									$t_id = $term->term_id;
									$term_meta = get_option( "product_author_$t_id" ); 
									$term_image = $term_meta['image'];
									if (is_wp_error($term_link))
										continue; if($term_image){ ?>
											<img src="<?php echo $term_image; ?>" />
									<?php	}else{
										echo '<img src="'.get_template_directory_uri().'/img/term-image.jpg" />';
									}
								}
							}
							?>




									
							</div>
						</div>
						<div class="col-lg-10 col-md-10 col-sm-8 col-6">

							<?php
							$terms = get_the_terms($post->ID, 'product_author');
							if (!$terms == '') {
								foreach ($terms as $term) {
									$term_link = get_term_link($term, 'product_author');
									if (is_wp_error($term_link))
										continue;

									echo '<h4 class="author-meta-title">' . $term->name . '</h4> ';
									echo '<p class="author-meta-descriptoin">' . $term->description . '</p>';
								}
							}
							?>
						</div>
					</div>
				</div>

				<?php
				if (woocommerce_product_loop()) { ?>
					<div class="content-sorting">
						<div class="res_info">
							<?php
							woocommerce_result_count();
							?>
						</div>
						<div class="sort_products">
							<form class="woocommerce-ordering">
								<label class="wdm_label">সর্ট করুন</label>
								<?php woocommerce_catalog_ordering(); ?>
							</form>
						</div>
					</div>
				<?php

					/**
					 * Hook: woocommerce_before_shop_loop.
					 *
					 * @hooked woocommerce_output_all_notices - 10
					 * @hooked woocommerce_result_count - 20
					 * @hooked woocommerce_catalog_ordering - 30
					 */
					do_action('woocommerce_before_shop_loop');

					woocommerce_product_loop_start();

					if (wc_get_loop_prop('total')) {
						while (have_posts()) {
							the_post();

							/**
							 * Hook: woocommerce_shop_loop.
							 */
							do_action('woocommerce_shop_loop');

							wc_get_template_part('content', 'product');
						}
					}

					woocommerce_product_loop_end();

					/**
					 * Hook: woocommerce_after_shop_loop.
					 *
					 * @hooked woocommerce_pagination - 10
					 */
					do_action('woocommerce_after_shop_loop');
				} else {
					/**
					 * Hook: woocommerce_no_products_found.
					 *
					 * @hooked wc_no_products_found - 10
					 */
					do_action('woocommerce_no_products_found');
				}
				?>
			</div>

			<?php
			/**
			 * Hook: woocommerce_after_main_content.
			 *
			 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
			 */
			do_action('woocommerce_after_main_content');
			?>
			<?php
			/**
			 * Hook: woocommerce_sidebar.
			 *
			 * @hooked woocommerce_get_sidebar - 10
			 */
			// do_action('woocommerce_sidebar');
			?>
		</div>
	</div>
</div>
<?php

get_footer('shop');
