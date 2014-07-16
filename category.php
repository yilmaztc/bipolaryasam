<?php get_header(); ?>
<div class="container">
    <div class="col-lg-8 col-md-8 col-sm-12 col-sm-12" id="bp_content">
        <div class="col-lg-12 breadcrumb" id="breadcrump">
            <?php
            if (function_exists('bcn_display')) {
                bcn_display();
            }
            ?>
        </div>
        <div class="content-inner">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                    <div class="category_page">
                            <figure class="blog_post_image">
                                <a href="<?php the_permalink(); ?>">
                                    <?php
                                    if (function_exists("thimtumb_rev")) {
                                        thimtumb_rev(152, 155);
                                    }
                                    ?>
                                </a>
                            </figure>
                        <div class="category_article">
                            <article>
                                <a href="<?php the_permalink(); ?>">
                                    <h3 class="blog_post_title"><?php the_title(); ?></h3>
                                </a>
                                <?php echo wp_trim_words(get_the_excerpt(), 30); ?>
                            </article>

                            <a class="read_more_class" href="<?php the_permalink(); ?>">Devamını Oku</a>
                        </div> 
                    </div>
                    <?php
                endwhile;
            else:
                ?>
                <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
            <?php endif; ?>
            <?php
            if (function_exists("pagination")) {
//                pagination($additional_loop->max_num_pages);
            }
            ?>
        </div>
    </div>

    <?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>