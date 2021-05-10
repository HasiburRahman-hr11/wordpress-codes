<?php get_header(); ?>

<main>
    <div class="hero-area blog-banner">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="hero-caption">
                        <h2 class="search-keywords">Showing Results for "<?php echo get_search_query(); ?>"</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="blog-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="blog-main">

                        <?php
                        if (have_posts()) :
                            while (have_posts()) : the_post();
                        ?>
                                <article class="blog-itme">
                                    <div class="blog-item-img">
                                        <?php
                                        the_post_thumbnail();
                                        ?>
                                        <span class="blog-itme-date">
                                            <h3><?php the_time('j') ?></h3>
                                            <p><?php the_time('F') ?></p>
                                        </span>
                                    </div>
                                    <div class="blog-item-details">
                                        <div class="blog-item-title">
                                            <a href="<?php the_permalink(); ?>">
                                                <h2><?php the_title(); ?></h2>
                                            </a>
                                        </div>
                                        <div class="blog-item-content">
                                            <?php the_content(); ?>
                                        </div>
                                        <div class="blog-item-meta">
                                            <div class="blog-cat">
                                                <i class="fas fa-user"></i>
                                                <?php the_category(); ?>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                        <?php
                            endwhile;
                        endif;
                        ?>
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
                </div>
                <div class="col-lg-4">
                    <div class="blog-sidebar">
                        <?php dynamic_sidebar('blog-sidebar'); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<?php get_footer(); ?>