<?php
/**
 * Template Name: His Majesty
 *
 * template-king.php — His Royal Majesty page
 */
get_header();
isaaq_floating_nav( true );
?>

<main class="container">
    <!-- Page Header -->
    <div class="page-header">
        <h1><?php esc_html_e( 'His Royal Majesty', 'isaaq-kingdom' ); ?></h1>
        <p><?php esc_html_e( "King Dhuuh Baraar · The Last Sovereign of the Tolje'lo Dynasty", 'isaaq-kingdom' ); ?></p>
    </div>

    <!-- King Section -->
    <?php while ( have_posts() ) : the_post(); ?>
    <section id="king">
        <div class="king-panel">
            <div class="king-left">
                <?php if ( has_post_thumbnail() ) : ?>
                <img src="<?php the_post_thumbnail_url( 'large' ); ?>"
                     alt="<?php esc_attr_e( 'King Dhuuh Baraar', 'isaaq-kingdom' ); ?>"
                     class="king-photo">
                <?php else : ?>
                <div class="king-photo" style="display:flex;align-items:center;justify-content:center;">
                    <i class="fas fa-crown" style="font-size:5rem;color:var(--gold-leaf);"></i>
                </div>
                <?php endif; ?>
            </div>
            <div class="king-right">
                <div class="king-name"><?php esc_html_e( 'King Dhuuh Baraar', 'isaaq-kingdom' ); ?></div>
                <div class="king-badge"><i class="fas fa-feather"></i> <?php esc_html_e( "Tolje'lo dynasty · last sovereign (early 1700s)", 'isaaq-kingdom' ); ?></div>
                <p><?php esc_html_e( 'King Dhuuh Baraar stands as the final monarch of the historic Isaaq Kingdom. As a ruler of the Tolje\'lo dynasty, he embodied the legacy tracing back to Sheikh Ishaaq Bin Ahmed. His reign marks the culmination of eight Tolje\'lo kings who guided the Isaaq clans from the 13th century — shaping identity, justice, and resilience in the Horn of Africa.', 'isaaq-kingdom' ); ?></p>

                <h3 style="color:var(--gold);margin:1.5rem 0 1rem;"><?php esc_html_e( "The Tolje'lo Dynasty", 'isaaq-kingdom' ); ?></h3>
                <p><?php esc_html_e( "The Tolje'lo dynasty ruled the Isaaq Kingdom for over 400 years, with eight kings leading the nation through prosperity, conflict, and cultural development. The lineage began with King Harun in the 14th century and ended with King Dhuuh Baraar in the early 1700s.", 'isaaq-kingdom' ); ?></p>

                <?php if ( get_the_content() ) : ?>
                <div class="entry-content" style="margin-top:1.5rem;">
                    <?php the_content(); ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
    <?php endwhile; ?>

    <!-- Kings Timeline -->
    <section style="margin:4rem 0;">
        <h2 class="section-title"><i class="fas fa-timeline title-icon"></i> <?php esc_html_e( 'The Eight Tolje\'lo Kings', 'isaaq-kingdom' ); ?></h2>
        <div class="event-timeline">
            <?php
            $kings = array(
                array( 'year' => '1300s', 'name' => 'King Harun',      'desc' => "Founder of the Tolje'lo dynasty · First ruler of the Isaaq Kingdom" ),
                array( 'year' => '1400s', 'name' => 'King Ibrahim',    'desc' => 'Expanded the kingdom and established trade routes' ),
                array( 'year' => '1500s', 'name' => 'King Yaqut',      'desc' => 'Strengthened the Guurti council and xeer customary law' ),
                array( 'year' => '1500s', 'name' => 'King Muuse',      'desc' => 'Presided over Islamic scholarship and inter-clan relations' ),
                array( 'year' => '1600s', 'name' => 'King Mohammed',   'desc' => 'Led the kingdom during the peak of its power' ),
                array( 'year' => '1600s', 'name' => 'King Yusuf',      'desc' => 'Maintained the kingdom through regional challenges' ),
                array( 'year' => '1600s', 'name' => 'King Farah',      'desc' => 'Extended the kingdom\'s influence across the Horn of Africa' ),
                array( 'year' => '1700s', 'name' => 'King Dhuuh Baraar', 'desc' => "The last sovereign · His reign marked the end of the Tolje'lo dynasty" ),
            );
            foreach ( $kings as $king ) :
            ?>
            <div class="event-item-distinct">
                <span class="event-year"><?php echo esc_html( $king['year'] ); ?></span>
                <div>
                    <h3><?php echo esc_html( $king['name'] ); ?></h3>
                    <p><?php echo esc_html( $king['desc'] ); ?></p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </section>

    <div style="text-align:center;margin:3rem 0;">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="back-button">
            <i class="fas fa-arrow-left"></i> <?php esc_html_e( 'Back to Home', 'isaaq-kingdom' ); ?>
        </a>
    </div>
</main>

<?php get_footer(); ?>
