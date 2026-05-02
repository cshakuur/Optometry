<?php
/**
 * single-isaaq_event.php — Single Event Template
 */
get_header();
isaaq_floating_nav( true );
?>

<main class="container">
    <?php while ( have_posts() ) : the_post();
        $year  = get_post_meta( get_the_ID(), '_isaaq_event_year', true );
        $extra = get_post_meta( get_the_ID(), '_isaaq_event_extra', true );
    ?>

    <!-- Page Header -->
    <div class="page-header">
        <h1><?php the_title(); ?></h1>
        <?php if ( $year ) : ?>
        <p><i class="fas fa-calendar-alt"></i> <?php echo esc_html( $year ); ?></p>
        <?php endif; ?>
    </div>

    <div class="single-content-wrap">
        <?php if ( has_post_thumbnail() ) : ?>
        <img src="<?php the_post_thumbnail_url( 'large' ); ?>"
             alt="<?php the_title_attribute(); ?>"
             class="single-featured-img">
        <?php endif; ?>

        <div style="background:rgba(201,168,76,0.07);border-radius:30px;padding:1.5rem;margin-bottom:1.5rem;border:1px solid var(--glass-border);">
            <?php if ( $year ) : ?>
            <p style="color:var(--text-primary);"><strong style="color:var(--gold);"><?php esc_html_e( 'Year:', 'isaaq-kingdom' ); ?></strong> <?php echo esc_html( $year ); ?></p>
            <?php endif; ?>
            <?php if ( $extra ) : ?>
            <p style="margin-top:0.5rem;color:var(--text-primary);">
                <strong style="color:var(--gold);"><?php esc_html_e( 'Additional Info:', 'isaaq-kingdom' ); ?></strong> <?php echo esc_html( $extra ); ?>
            </p>
            <?php endif; ?>
        </div>

        <div class="entry-content" style="line-height:1.8;">
            <?php the_content(); ?>
        </div>
    </div>

    <?php endwhile; ?>

    <div style="text-align:center;margin:3rem 0;">
        <a href="<?php echo esc_url( get_post_type_archive_link( 'isaaq_event' ) ); ?>" class="back-button">
            <i class="fas fa-arrow-left"></i> <?php esc_html_e( 'Back to Events', 'isaaq-kingdom' ); ?>
        </a>
    </div>
</main>

<?php get_footer(); ?>
