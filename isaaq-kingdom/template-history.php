<?php
/**
 * Template Name: History
 *
 * template-history.php — History of the Isaaq Kingdom
 */
get_header();
isaaq_floating_nav( true );
?>

<main class="container">
    <!-- Page Header -->
    <div class="page-header">
        <h1><?php esc_html_e( 'The History of Isaaq Kingdom', 'isaaq-kingdom' ); ?></h1>
        <p><?php esc_html_e( 'From the 14th century to the present · A legacy of eight kings', 'isaaq-kingdom' ); ?></p>
    </div>

    <!-- History Cards -->
    <section>
        <div class="history-mosaic">
            <div class="history-card">
                <i class="fas fa-calendar-alt history-icon"></i>
                <h3><?php esc_html_e( '14th Century', 'isaaq-kingdom' ); ?></h3>
                <p><?php esc_html_e( "Establishment of the Isaaq Kingdom after the fall of the Adal Sultanate. The Tolje'lo dynasty takes leadership.", 'isaaq-kingdom' ); ?></p>
            </div>
            <div class="history-card">
                <i class="fas fa-flag history-icon"></i>
                <h3><?php esc_html_e( "8 Tolje'lo Kings", 'isaaq-kingdom' ); ?></h3>
                <p><?php esc_html_e( "From King Harun (1300s) to King Dhuuh Baraar (1700s), centuries of rule shaped the identity of the Isaaq people.", 'isaaq-kingdom' ); ?></p>
            </div>
            <div class="history-card">
                <i class="fas fa-people-group history-icon"></i>
                <h3><?php esc_html_e( '8 Isaaq Clans', 'isaaq-kingdom' ); ?></h3>
                <p><?php esc_html_e( "Descended from Sheikh Ishaaq's eight sons, uniting under the Tolje'lo dynasty and forming the foundation of the kingdom.", 'isaaq-kingdom' ); ?></p>
            </div>
        </div>
    </section>

    <!-- The Founding -->
    <section style="margin:3rem 0;">
        <h2 class="section-title"><i class="fas fa-scroll title-icon"></i> <?php esc_html_e( 'The Founding', 'isaaq-kingdom' ); ?></h2>
        <div style="background:white;border-radius:60px;padding:2rem;box-shadow:var(--shadow-strong);">
            <p style="font-size:1.1rem;line-height:1.8;"><?php esc_html_e( 'Sheikh Ishaaq Bin Ahmed, a revered Islamic scholar, arrived in the Horn of Africa during the 12th century. He settled in the region of Maydh, where his message and leadership united the local clans. His eight sons became the progenitors of the eight major Isaaq clans:', 'isaaq-kingdom' ); ?></p>

            <?php
            $clans = array( 'Habr Awal', "Habr Je'lo", 'Habr Yunis', 'Arap', 'Ayub', 'Garhajis', 'Habar Magaadle', 'Muuse' );
            ?>
            <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:1rem;margin:2rem 0;">
                <?php foreach ( $clans as $clan ) : ?>
                <div style="background:var(--cream);padding:1rem;border-radius:30px;text-align:center;">
                    <strong><?php echo esc_html( $clan ); ?></strong>
                </div>
                <?php endforeach; ?>
            </div>

            <p style="font-size:1.1rem;line-height:1.8;"><?php esc_html_e( "The Tolje'lo dynasty emerged as the ruling house, with King Harun becoming the first king in the 14th century. The kingdom flourished through trade, Islamic scholarship, and a unique system of governance combining customary law (xeer) with Islamic principles.", 'isaaq-kingdom' ); ?></p>
        </div>
    </section>

    <?php
    // If editor has added extra content to this page, display it here
    while ( have_posts() ) : the_post();
        if ( get_the_content() ) :
    ?>
    <section style="margin:3rem 0;">
        <div style="background:white;border-radius:60px;padding:2rem;box-shadow:var(--shadow-strong);">
            <div class="entry-content">
                <?php the_content(); ?>
            </div>
        </div>
    </section>
    <?php
        endif;
    endwhile;
    ?>

    <!-- Legacy Section -->
    <section style="margin:3rem 0;background:linear-gradient(135deg,#0f4c5c,#1a6a7a);border-radius:60px;padding:3rem 2rem;color:white;text-align:center;">
        <h2 style="font-family:'Playfair Display',serif;font-size:2.5rem;margin-bottom:1.5rem;"><?php esc_html_e( 'The Guurti Council &amp; Xeer Law', 'isaaq-kingdom' ); ?></h2>
        <p style="font-size:1.2rem;max-width:800px;margin:0 auto;"><?php esc_html_e( 'The Isaaq Kingdom was renowned for its sophisticated governance system. The Guurti council of elders, combined with xeer customary law, created a framework for justice and conflict resolution that continues to influence Somali society today.', 'isaaq-kingdom' ); ?></p>
    </section>

    <div style="text-align:center;margin:3rem 0;">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="back-button">
            <i class="fas fa-arrow-left"></i> <?php esc_html_e( 'Back to Home', 'isaaq-kingdom' ); ?>
        </a>
    </div>
</main>

<?php get_footer(); ?>
