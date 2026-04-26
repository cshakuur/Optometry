<?php
/**
 * index.php — Fallback Template
 *
 * Used by WordPress when a more specific template is not found.
 */
get_header();
isaaq_floating_nav( true );
?>

<main class="container">
    <div class="page-header">
        <h1><?php bloginfo( 'name' ); ?></h1>
        <p><?php bloginfo( 'description' ); ?></p>
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
        <p style="text-align:center;padding:3rem 0;"><?php esc_html_e( 'No content found.', 'isaaq-kingdom' ); ?></p>
    <?php endif; ?>
</main>

<?php get_footer(); ?>
