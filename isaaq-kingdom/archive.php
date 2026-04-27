<?php
/**
 * archive.php — Generic Archive Template
 */
get_header();
isaaq_floating_nav( true );
?>

<main class="container">
    <div class="page-header">
        <h1><?php the_archive_title(); ?></h1>
        <?php the_archive_description( '<p>', '</p>' ); ?>
    </div>

    <?php if ( have_posts() ) : ?>
    <div class="news-grid-dynamic">
        <?php while ( have_posts() ) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class( 'news-super' ); ?>>
            <?php if ( has_post_thumbnail() ) : ?>
            <div class="news-img-super" style="background-image: url('<?php the_post_thumbnail_url( 'medium_large' ); ?>');">
            </div>
            <?php endif; ?>
            <div class="news-content-super">
                <h3><a href="<?php the_permalink(); ?>" style="text-decoration:none;color:inherit;"><?php the_title(); ?></a></h3>
                <p><?php the_excerpt(); ?></p>
            </div>
        </article>
        <?php endwhile; ?>
    </div>

    <div style="text-align:center;margin:2rem 0;">
        <?php the_posts_pagination( array( 'mid_size' => 2 ) ); ?>
    </div>

    <?php else : ?>
    <p style="text-align:center;padding:3rem 0;"><?php esc_html_e( 'No items found.', 'isaaq-kingdom' ); ?></p>
    <?php endif; ?>

    <div style="text-align:center;margin:3rem 0;">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="back-button">
            <i class="fas fa-arrow-left"></i> <?php esc_html_e( 'Back to Home', 'isaaq-kingdom' ); ?>
        </a>
    </div>
</main>

<?php get_footer(); ?>
