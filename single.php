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
            <?php
            if (have_posts()) :
                while (have_posts()) : the_post();
                    ?>
                    <h1 class="main_title"><?php the_title(); ?></h1>
                    <article class="pages_article">
        <?php the_content(); ?>
                    </article>

                <?php endwhile;
            else:
                ?>
                <p><?php _e('Üzgünüz yazı bulunamadı.'); ?></p>
            <?php endif; ?>
            <?php
            if (function_exists("other_article_link"))
                other_article_link()
                ?>
        </div>
    </div>
<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>