<?php
/**
 * archive-isaaq_event.php — Events Archive Template
 *
 * Lists all published isaaq_event posts in a timeline layout.
 */
get_header();
isaaq_floating_nav( true );
?>

<main class="container">
    <!-- Page Header -->
    <div class="page-header">
        <h1><?php esc_html_e( 'Royal Events &amp; Ceremonies', 'isaaq-kingdom' ); ?></h1>
        <p><?php esc_html_e( "Commemorations, festivals, and gatherings honoring Isaaq heritage", 'isaaq-kingdom' ); ?></p>
    </div>

    <!-- Events Timeline -->
    <section>
        <h2 class="section-title">
            <i class="fas fa-clock title-icon"></i> <?php esc_html_e( 'Upcoming &amp; Recent Events', 'isaaq-kingdom' ); ?>
        </h2>

        <?php if ( have_posts() ) : ?>
        <div class="event-timeline">
            <?php while ( have_posts() ) : the_post();
                $year  = get_post_meta( get_the_ID(), '_isaaq_event_year', true );
                $extra = get_post_meta( get_the_ID(), '_isaaq_event_extra', true );
            ?>
            <a href="<?php the_permalink(); ?>" class="event-item-distinct">
                <span class="event-year"><?php echo esc_html( $year ?: get_the_date( 'Y' ) ); ?></span>
                <div>
                    <h3><?php the_title(); ?></h3>
                    <p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 25 ) ); ?></p>
                    <?php if ( $extra ) : ?>
                    <small style="color:var(--ruby);">
                        <i class="fas fa-info-circle"></i> <?php echo esc_html( $extra ); ?>
                    </small>
                    <?php endif; ?>
                </div>
            </a>
            <?php endwhile; ?>
        </div>

        <div style="text-align:center;margin:2rem 0;">
            <?php the_posts_pagination( array( 'mid_size' => 2 ) ); ?>
        </div>

        <?php else : ?>
        <p style="text-align:center;padding:3rem 0;"><?php esc_html_e( 'No events found.', 'isaaq-kingdom' ); ?></p>
        <?php endif; ?>
    </section>

    <div style="text-align:center;margin:3rem 0;">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="back-button">
            <i class="fas fa-arrow-left"></i> <?php esc_html_e( 'Back to Home', 'isaaq-kingdom' ); ?>
        </a>
    </div>
</main>

<?php get_footer(); ?>
