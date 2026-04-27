<?php
/**
 * single-isaaq_news.php — Single News Article Template
 */
get_header();
isaaq_floating_nav( true );
?>

<main class="container">
    <?php while ( have_posts() ) : the_post();
        $category = get_post_meta( get_the_ID(), '_isaaq_news_category', true );
    ?>

    <!-- Page Header -->
    <div class="page-header">
        <h1><?php the_title(); ?></h1>
        <p>
            <?php if ( $category ) : ?>
            <span style="background:rgba(255,255,255,0.2);padding:0.2rem 1rem;border-radius:40px;margin-right:1rem;">
                <?php echo esc_html( $category ); ?>
            </span>
            <?php endif; ?>
            <i class="fas fa-clock"></i> <?php echo esc_html( get_the_date() ); ?>
        </p>
    </div>

    <div class="single-content-wrap">
        <?php if ( has_post_thumbnail() ) : ?>
        <img src="<?php the_post_thumbnail_url( 'large' ); ?>"
             alt="<?php the_title_attribute(); ?>"
             class="single-featured-img">
        <?php endif; ?>

        <?php if ( $category ) : ?>
        <span style="background:var(--ruby);color:white;padding:0.3rem 1.5rem;border-radius:40px;font-size:0.9rem;display:inline-block;margin-bottom:1.5rem;">
            <?php echo esc_html( $category ); ?>
        </span>
        <?php endif; ?>

        <div class="entry-content" style="line-height:1.8;">
            <?php the_content(); ?>
        </div>

        <small style="color:#666;display:block;margin-top:2rem;">
            <i class="fas fa-calendar"></i> <?php echo esc_html( get_the_date() ); ?>
        </small>
    </div>

    <?php endwhile; ?>

    <div style="text-align:center;margin:3rem 0;">
        <a href="<?php echo esc_url( get_post_type_archive_link( 'isaaq_news' ) ); ?>" class="back-button">
            <i class="fas fa-arrow-left"></i> <?php esc_html_e( 'Back to News', 'isaaq-kingdom' ); ?>
        </a>
    </div>
</main>

<?php get_footer(); ?>
