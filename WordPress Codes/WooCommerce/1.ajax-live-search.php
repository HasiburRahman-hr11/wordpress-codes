<?php 


/*
*** header Section ***
 */
// Ajax Live Search Result
add_shortcode('wide_search', 'live_search_function');
function live_search_function()
{ ?>

    <form action="<?php echo esc_url(home_url('/')) ?>" role="search" method="get" class="searchform" id="searchform">
        <input type="search" value="<?php echo get_search_query(); ?>" name="s" id="keyword" onkeyup="fetch()" placeholder="Search"></input>
        <button type="submit" value="" id="searchsubmit">
            <?php 
            global $theme_options;
            $srchIcon = $theme_options['search-icon'];
            if($srchIcon){
                echo '<img src="'.$srchIcon.'" alt="Search">';
            }else{
                echo '<img src="'.get_template_directory_uri().'/img/search.png" alt="Search">';
            }
            ?>
        </button>
        <input type="hidden" name="post_type" value="product" />
        <div id="productfetch"></div>
    </form>

<?php
}
// Ajax Calling
add_action('wp_footer', 'ajax_fetch');
function ajax_fetch()
{ ?>
    <script type="text/javascript">
        function fetch() {
            if (document.getElementById('keyword').value.trim().length == 0) {
                jQuery('#productfetch').html('');
            } else {
                jQuery.ajax({
                    url: '<?php echo admin_url('admin-ajax.php'); ?>',
                    type: 'post',
                    data: {
                        action: 'data_fetch',
                        keyword: jQuery('#keyword').val()
                    },
                    success: function(data) {
                        jQuery('#productfetch').html(data);
                    }
                });
            }
        }
    </script>
    <?php
}
add_action('wp_ajax_data_fetch', 'product_fetch');
add_action('wp_ajax_nopriv_data_fetch', 'product_fetch');
function product_fetch()
{
    $the_query = new WP_Query(
        array(
            'posts_per_page' => -1,
            's' => esc_attr($_POST['keyword']), 'post_type' => 'product',
            'taxonomy' => 'product_cat',
            'orderby'                => 'title',
            'order'                  => 'ASC',
            'hide_empty'             => true,
        ),

    );

    if ($the_query->have_posts()) : ?>

        <div class="product_fetch-box">
            <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
                <a href="<?php echo esc_url(post_permalink()); ?>">
                    <div class="live-search-suggetion">
                        <span class="search-image"><?php the_post_thumbnail(); ?></span>
                        <span class="live-search-name"><?php the_title(); ?></span>
                        <?php $product = wc_get_product(get_the_ID()); /* get the WC_Product Object */ ?>
                        <span class="live-search-price"><?php echo $product->get_price_html(); ?></span>
                    </div>
                </a>

            <?php endwhile; ?>
        </div>

    <?php wp_reset_postdata();
    endif;
    die();
}

