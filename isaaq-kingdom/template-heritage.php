<?php
/**
 * Template Name: Heritage
 *
 * template-heritage.php — Royal Heritage & Imagery
 */
get_header();
isaaq_floating_nav( true );

$lineage = get_option( 'isaaq_lineage_banner', "Sheikh Ishaaq → Tolje'lo Dynasty → 8 Isaaq Clans → Harun · Ibrahim · Yaqut · Mohammed · Dhuuh Baraar" );
?>

<main class="container">
    <!-- Page Header -->
    <div class="page-header">
        <h1><?php esc_html_e( 'Royal Heritage &amp; Imagery', 'isaaq-kingdom' ); ?></h1>
        <p><?php esc_html_e( 'Artifacts, symbols, and cultural treasures of the Isaaq Kingdom', 'isaaq-kingdom' ); ?></p>
    </div>

    <!-- Heritage Showcase -->
    <section>
        <h2 class="section-title"><i class="fas fa-images title-icon"></i> <?php esc_html_e( 'Royal Imagery', 'isaaq-kingdom' ); ?></h2>
        <div class="heritage-showcase">
            <?php
            /*
             * Heritage pieces can be managed as pages/posts with "Heritage Item" category,
             * or editors can attach media via the page editor. Here we show static defaults
             * that match the original design, plus any featured image on this page.
             */
            $pieces = array(
                array(
                    'img'   => get_template_directory_uri() . '/images/adal-banner.jpg',
                    'alt'   => 'Adal Banner',
                    'title' => 'Adal Banner',
                    'desc'  => 'Used by the Adal Sultanate and Isaaq Kingdom on ceremonial occasions',
                ),
                array(
                    'img'   => get_template_directory_uri() . '/images/sheikh-ishaaq.jpg',
                    'alt'   => 'Sheikh Ishaaq',
                    'title' => 'Sheikh Ishaaq',
                    'desc'  => '12th century scholar whose eight sons founded the Isaaq clans',
                ),
                array(
                    'img'   => get_template_directory_uri() . '/images/king-harun.jpg',
                    'alt'   => 'King Harun',
                    'title' => 'King Harun',
                    'desc'  => "First Tolje'lo ruler (1300s) - Founder of the dynasty",
                ),
            );

            foreach ( $pieces as $piece ) :
            ?>
            <div class="heritage-piece">
                <img src="<?php echo esc_url( $piece['img'] ); ?>"
                     alt="<?php echo esc_attr( $piece['alt'] ); ?>"
                     class="heritage-image"
                     onerror="this.style.display='none';this.nextElementSibling.style.display='block';">
                <i class="fas fa-crown" style="display:none;"></i>
                <h3><?php echo esc_html( $piece['title'] ); ?></h3>
                <p style="margin-top:0.5rem;"><?php echo esc_html( $piece['desc'] ); ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- Lineage Banner -->
    <section>
        <div class="lineage-banner-modern">
            <?php echo esc_html( $lineage ); ?>
        </div>
    </section>

    <?php
    // Show any extra content the editor has added to this page
    while ( have_posts() ) : the_post();
        if ( get_the_content() ) :
    ?>
    <section style="margin:3rem 0;">
        <div style="background:var(--glass-bg);backdrop-filter:blur(20px);-webkit-backdrop-filter:blur(20px);border-radius:40px;padding:2rem;box-shadow:var(--shadow-deep);border:1px solid var(--glass-border);">
            <div class="entry-content" style="color:rgba(244,237,216,0.85);line-height:1.8;">
                <?php the_content(); ?>
            </div>
        </div>
    </section>
    <?php
        endif;
    endwhile;
    ?>

    <!-- Cultural Treasures -->
    <section style="margin:3rem 0;">
        <h2 class="section-title"><i class="fas fa-landmark title-icon"></i> <?php esc_html_e( 'Cultural Treasures', 'isaaq-kingdom' ); ?></h2>
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(250px,1fr));gap:2rem;">
            <div style="background:var(--glass-bg);backdrop-filter:blur(20px);-webkit-backdrop-filter:blur(20px);border-radius:40px;padding:2rem;text-align:center;box-shadow:var(--shadow-deep);border:1px solid var(--glass-border);">
                <i class="fas fa-scroll" style="font-size:3rem;color:var(--gold);margin-bottom:1rem;display:block;filter:drop-shadow(0 0 10px rgba(201,168,76,0.5));"></i>
                <h3 style="color:var(--text-primary);"><?php esc_html_e( 'Ancient Manuscripts', 'isaaq-kingdom' ); ?></h3>
                <p style="color:var(--text-secondary);"><?php esc_html_e( 'Islamic texts and historical records preserved for centuries', 'isaaq-kingdom' ); ?></p>
            </div>
            <div style="background:var(--glass-bg);backdrop-filter:blur(20px);-webkit-backdrop-filter:blur(20px);border-radius:40px;padding:2rem;text-align:center;box-shadow:var(--shadow-deep);border:1px solid var(--glass-border);">
                <i class="fas fa-music" style="font-size:3rem;color:var(--gold);margin-bottom:1rem;display:block;filter:drop-shadow(0 0 10px rgba(201,168,76,0.5));"></i>
                <h3 style="color:var(--text-primary);"><?php esc_html_e( 'Royal Gabay', 'isaaq-kingdom' ); ?></h3>
                <p style="color:var(--text-secondary);"><?php esc_html_e( 'Traditional poetry and oral traditions passed through generations', 'isaaq-kingdom' ); ?></p>
            </div>
            <div style="background:var(--glass-bg);backdrop-filter:blur(20px);-webkit-backdrop-filter:blur(20px);border-radius:40px;padding:2rem;text-align:center;box-shadow:var(--shadow-deep);border:1px solid var(--glass-border);">
                <i class="fas fa-gem" style="font-size:3rem;color:var(--gold);margin-bottom:1rem;display:block;filter:drop-shadow(0 0 10px rgba(201,168,76,0.5));"></i>
                <h3 style="color:var(--text-primary);"><?php esc_html_e( 'Royal Artifacts', 'isaaq-kingdom' ); ?></h3>
                <p style="color:var(--text-secondary);"><?php esc_html_e( 'Ceremonial items and symbols of kingship', 'isaaq-kingdom' ); ?></p>
            </div>
        </div>
    </section>

    <div style="text-align:center;margin:3rem 0;">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="back-button">
            <i class="fas fa-arrow-left"></i> <?php esc_html_e( 'Back to Home', 'isaaq-kingdom' ); ?>
        </a>
    </div>
</main>

<?php get_footer(); ?>
