<?php
/**
 * archive-isaaq_news.php — News Archive Template
 *
 * Lists all published isaaq_news posts in a card grid.
 */
get_header();
isaaq_floating_nav( true );
?>

<main class="container">
    <!-- Page Header -->
    <div class="page-header">
        <h1><?php esc_html_e( 'Latest News &amp; Updates', 'isaaq-kingdom' ); ?></h1>
        <p><?php esc_html_e( "Stay informed about the Isaaq Kingdom and Tolje'lo heritage", 'isaaq-kingdom' ); ?></p>
    </div>

    <!-- News Grid -->
    <section>
        <?php if ( have_posts() ) : ?>
        <div class="news-grid-dynamic">
            <?php while ( have_posts() ) : the_post();
                $category = get_post_meta( get_the_ID(), '_isaaq_news_category', true );
                $img_url  = get_the_post_thumbnail_url( get_the_ID(), 'medium_large' );
            ?>
            <a href="<?php the_permalink(); ?>" class="news-super">
                <div class="news-img-super"
                     <?php if ( $img_url ) : ?>style="background-image:url('<?php echo esc_url( $img_url ); ?>');"<?php endif; ?>>
                    <?php if ( $category ) : ?>
                    <span class="news-category"><?php echo esc_html( $category ); ?></span>
                    <?php endif; ?>
                </div>
                <div class="news-content-super">
                    <h3><?php the_title(); ?></h3>
                    <p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 20 ) ); ?></p>
                    <small style="color:var(--ruby);display:block;margin-top:1rem;">
                        <i class="fas fa-clock"></i> <?php echo esc_html( get_the_date() ); ?>
                    </small>
                </div>
            </a>
            <?php endwhile; ?>
        </div>

        <div style="text-align:center;margin:2rem 0;">
            <?php the_posts_pagination( array( 'mid_size' => 2 ) ); ?>
        </div>

        <?php else : ?>
        <p style="text-align:center;padding:3rem 0;"><?php esc_html_e( 'No news articles found.', 'isaaq-kingdom' ); ?></p>
        <?php endif; ?>
    </section>

    <div style="text-align:center;margin:3rem 0;">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="back-button">
            <i class="fas fa-arrow-left"></i> <?php esc_html_e( 'Back to Home', 'isaaq-kingdom' ); ?>
        </a>
    </div>
</main>

<?php get_footer(); ?>
