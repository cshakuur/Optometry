<?php
/**
 * page.php — Default Page Template
 */
get_header();
isaaq_floating_nav( true );
?>

<main class="container">
    <?php while ( have_posts() ) : the_post(); ?>

    <div class="page-header">
        <h1><?php the_title(); ?></h1>
    </div>

    <div class="single-content-wrap">
        <?php if ( has_post_thumbnail() ) : ?>
        <img src="<?php the_post_thumbnail_url( 'large' ); ?>"
             alt="<?php the_title_attribute(); ?>"
             class="single-featured-img">
        <?php endif; ?>

        <div class="entry-content">
            <?php the_content(); ?>
        </div>
    </div>

    <?php endwhile; ?>

    <div style="text-align:center;margin:3rem 0;">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="back-button">
            <i class="fas fa-arrow-left"></i> <?php esc_html_e( 'Back to Home', 'isaaq-kingdom' ); ?>
        </a>
    </div>
</main>

<?php get_footer(); ?>
