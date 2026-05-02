<?php
/**
 * front-page.php — Home / Front Page Template
 *
 * Displays the hero slideshow (isaaq_slide CPT), floating nav, and
 * the welcome / quick-links section.
 */
get_header();

// Query hero slides ordered by Menu Order (slide_order equivalent)
$slides_query = new WP_Query( array(
    'post_type'      => 'isaaq_slide',
    'posts_per_page' => -1,
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
    'post_status'    => 'publish',
) );

$slides = array();
if ( $slides_query->have_posts() ) {
    while ( $slides_query->have_posts() ) {
        $slides_query->the_post();
        $slides[] = array(
            'headline'    => get_the_title(),
            'tagline'     => get_post_meta( get_the_ID(), '_isaaq_slide_tagline', true ),
            'description' => get_the_excerpt(),
            'image_url'   => get_the_post_thumbnail_url( get_the_ID(), 'full' ),
        );
    }
    wp_reset_postdata();
}
?>

<!-- HERO SLIDESHOW -->
<?php if ( ! empty( $slides ) ) : ?>
<section class="hero-slideshow" id="home">
    <div class="slides-container">
        <?php foreach ( $slides as $index => $slide ) : ?>
        <div class="slide <?php echo $index === 0 ? 'active-slide' : ''; ?>"
             <?php if ( $slide['image_url'] ) : ?>style="background-image: url('<?php echo esc_url( $slide['image_url'] ); ?>');"<?php endif; ?>>
            <div class="slide-content">
                <h2><i class="fas fa-crown"></i> <?php echo esc_html( $slide['headline'] ); ?></h2>
                <?php if ( $slide['tagline'] ) : ?>
                <div class="slide-tagline"><?php echo esc_html( $slide['tagline'] ); ?></div>
                <?php endif; ?>
                <?php if ( $slide['description'] ) : ?>
                <div class="slide-desc"><?php echo esc_html( $slide['description'] ); ?></div>
                <?php endif; ?>
            </div>
        </div>
        <?php endforeach; ?>

        <div class="slide-arrow prev" onclick="changeSlide(-1)"><i class="fas fa-chevron-left"></i></div>
        <div class="slide-arrow next" onclick="changeSlide(1)"><i class="fas fa-chevron-right"></i></div>

        <div class="slide-indicators">
            <?php foreach ( $slides as $index => $slide ) : ?>
            <span class="dot <?php echo $index === 0 ? 'active-dot' : ''; ?>"
                  onclick="currentSlide(<?php echo esc_attr( $index ); ?>)"></span>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<?php isaaq_floating_nav(); ?>

<main class="container">
    <!-- Welcome Section -->
    <div class="page-header">
        <h1><?php bloginfo( 'name' ); ?></h1>
        <p><?php bloginfo( 'description' ); ?></p>
    </div>

    <!-- Quick Links -->
    <?php
    $king_id     = isaaq_get_page_by_template( 'template-king.php' );
    $history_id  = isaaq_get_page_by_template( 'template-history.php' );
    $heritage_id = isaaq_get_page_by_template( 'template-heritage.php' );
    ?>
    <div class="history-mosaic">
        <?php if ( $king_id ) : ?>
        <a href="<?php echo esc_url( get_permalink( $king_id ) ); ?>" style="text-decoration: none;">
            <div class="history-card">
                <i class="fas fa-crown history-icon"></i>
                <h3><?php esc_html_e( 'His Majesty', 'isaaq-kingdom' ); ?></h3>
                <p><?php esc_html_e( 'Learn about King Dhuuh Baraar, the last sovereign of the Tolje\'lo dynasty', 'isaaq-kingdom' ); ?></p>
            </div>
        </a>
        <?php endif; ?>

        <?php if ( $history_id ) : ?>
        <a href="<?php echo esc_url( get_permalink( $history_id ) ); ?>" style="text-decoration: none;">
            <div class="history-card">
                <i class="fas fa-timeline history-icon"></i>
                <h3><?php esc_html_e( 'History', 'isaaq-kingdom' ); ?></h3>
                <p><?php esc_html_e( 'Explore the rich history of the Isaaq Kingdom from the 14th century', 'isaaq-kingdom' ); ?></p>
            </div>
        </a>
        <?php endif; ?>

        <?php if ( $heritage_id ) : ?>
        <a href="<?php echo esc_url( get_permalink( $heritage_id ) ); ?>" style="text-decoration: none;">
            <div class="history-card">
                <i class="fas fa-images history-icon"></i>
                <h3><?php esc_html_e( 'Heritage', 'isaaq-kingdom' ); ?></h3>
                <p><?php esc_html_e( 'View royal imagery and cultural artifacts', 'isaaq-kingdom' ); ?></p>
            </div>
        </a>
        <?php endif; ?>
    </div>

    <!-- ===================== HIS MAJESTY PREVIEW ===================== -->
    <?php if ( $king_id ) : ?>
    <section style="margin:3rem 0;">
        <h2 class="section-title">
            <i class="fas fa-crown title-icon"></i><?php esc_html_e( 'His Royal Majesty', 'isaaq-kingdom' ); ?>
        </h2>
        <div class="king-panel">
            <div class="king-left">
                <div class="king-photo" style="display:flex;align-items:center;justify-content:center;">
                    <i class="fas fa-crown" style="font-size:5rem;color:var(--gold-leaf);"></i>
                </div>
            </div>
            <div class="king-right">
                <div class="king-name"><?php esc_html_e( 'King Dhuuh Baraar', 'isaaq-kingdom' ); ?></div>
                <div class="king-badge"><i class="fas fa-feather"></i> <?php esc_html_e( "Tolje'lo Dynasty · Last Sovereign (early 1700s)", 'isaaq-kingdom' ); ?></div>
                <p><?php esc_html_e( "King Dhuuh Baraar stands as the final monarch of the historic Isaaq Kingdom. As a ruler of the Tolje'lo dynasty, he embodied the legacy tracing back to Sheikh Ishaaq Bin Ahmed. His reign marks the culmination of eight Tolje'lo kings who guided the Isaaq clans from the 13th century — shaping identity, justice, and resilience in the Horn of Africa.", 'isaaq-kingdom' ); ?></p>
                <h3 style="color:var(--gold);margin:1.5rem 0 1rem;font-size:1.4rem;"><?php esc_html_e( "The Tolje'lo Dynasty", 'isaaq-kingdom' ); ?></h3>
                <p><?php esc_html_e( "The Tolje'lo dynasty ruled the Isaaq Kingdom for over 400 years. The lineage began with King Harun in the 14th century and ended with King Dhuuh Baraar in the early 1700s — eight kings who built a legacy of governance, scholarship, and unity.", 'isaaq-kingdom' ); ?></p>
                <div style="margin-top:1.5rem;">
                    <a href="<?php echo esc_url( get_permalink( $king_id ) ); ?>" class="back-button">
                        <?php esc_html_e( 'Full Royal Profile', 'isaaq-kingdom' ); ?> <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- ===================== HISTORY HIGHLIGHTS ===================== -->
    <?php if ( $history_id ) : ?>
    <section style="margin:3rem 0;">
        <h2 class="section-title">
            <i class="fas fa-scroll title-icon"></i><?php esc_html_e( 'History of the Kingdom', 'isaaq-kingdom' ); ?>
        </h2>
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
        <div style="text-align:center;margin-top:1.5rem;">
            <a href="<?php echo esc_url( get_permalink( $history_id ) ); ?>" class="back-button">
                <?php esc_html_e( 'Full History', 'isaaq-kingdom' ); ?> <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </section>
    <?php endif; ?>

    <!-- ===================== HERITAGE PREVIEW ===================== -->
    <?php if ( $heritage_id ) : ?>
    <section style="margin:3rem 0;">
        <h2 class="section-title">
            <i class="fas fa-images title-icon"></i><?php esc_html_e( 'Royal Heritage', 'isaaq-kingdom' ); ?>
        </h2>

        <!-- Lineage Banner -->
        <div class="lineage-banner-modern" style="margin-bottom:2rem;">
            <?php echo esc_html( get_option( 'isaaq_lineage_banner', "Sheikh Ishaaq → Tolje'lo Dynasty → 8 Isaaq Clans → Harun · Ibrahim · Yaqut · Mohammed · Dhuuh Baraar" ) ); ?>
        </div>

        <!-- Cultural Treasures -->
            <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:1.5rem;">
            <div style="background:var(--glass-bg);backdrop-filter:blur(20px);border-radius:40px;padding:2rem;text-align:center;box-shadow:var(--shadow-deep);border:1px solid var(--glass-border);">
                <i class="fas fa-scroll" style="font-size:2.8rem;color:var(--gold);margin-bottom:1rem;display:block;filter:drop-shadow(0 0 10px rgba(201,168,76,0.5));"></i>
                <h3 style="color:var(--text-primary);font-size:1.3rem;"><?php esc_html_e( 'Ancient Manuscripts', 'isaaq-kingdom' ); ?></h3>
                <p style="font-size:0.95rem;color:var(--text-secondary);"><?php esc_html_e( 'Islamic texts and historical records preserved for centuries', 'isaaq-kingdom' ); ?></p>
            </div>
            <div style="background:var(--glass-bg);backdrop-filter:blur(20px);border-radius:40px;padding:2rem;text-align:center;box-shadow:var(--shadow-deep);border:1px solid var(--glass-border);">
                <i class="fas fa-music" style="font-size:2.8rem;color:var(--gold);margin-bottom:1rem;display:block;filter:drop-shadow(0 0 10px rgba(201,168,76,0.5));"></i>
                <h3 style="color:var(--text-primary);font-size:1.3rem;"><?php esc_html_e( 'Royal Gabay', 'isaaq-kingdom' ); ?></h3>
                <p style="font-size:0.95rem;color:var(--text-secondary);"><?php esc_html_e( 'Traditional poetry and oral traditions passed through generations', 'isaaq-kingdom' ); ?></p>
            </div>
            <div style="background:var(--glass-bg);backdrop-filter:blur(20px);border-radius:40px;padding:2rem;text-align:center;box-shadow:var(--shadow-deep);border:1px solid var(--glass-border);">
                <i class="fas fa-gem" style="font-size:2.8rem;color:var(--gold);margin-bottom:1rem;display:block;filter:drop-shadow(0 0 10px rgba(201,168,76,0.5));"></i>
                <h3 style="color:var(--text-primary);font-size:1.3rem;"><?php esc_html_e( 'Royal Artifacts', 'isaaq-kingdom' ); ?></h3>
                <p style="font-size:0.95rem;color:var(--text-secondary);"><?php esc_html_e( 'Ceremonial items and symbols of kingship', 'isaaq-kingdom' ); ?></p>
            </div>
            <div style="background:var(--glass-bg);backdrop-filter:blur(20px);border-radius:40px;padding:2rem;text-align:center;box-shadow:var(--shadow-deep);border:1px solid var(--glass-border);">
                <i class="fas fa-mosque" style="font-size:2.8rem;color:var(--gold);margin-bottom:1rem;display:block;filter:drop-shadow(0 0 10px rgba(201,168,76,0.5));"></i>
                <h3 style="color:var(--text-primary);font-size:1.3rem;"><?php esc_html_e( 'Sacred Sites', 'isaaq-kingdom' ); ?></h3>
                <p style="font-size:0.95rem;color:var(--text-secondary);"><?php esc_html_e( 'Shrines, mosques, and holy places of the Isaaq Kingdom', 'isaaq-kingdom' ); ?></p>
            </div>
        </div>

        <div style="text-align:center;margin-top:1.5rem;">
            <a href="<?php echo esc_url( get_permalink( $heritage_id ) ); ?>" class="back-button">
                <?php esc_html_e( 'Full Heritage Gallery', 'isaaq-kingdom' ); ?> <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </section>
    <?php endif; ?>

    <!-- ===================== LATEST NEWS ===================== -->
    <?php
    $news_query = new WP_Query( array(
        'post_type'      => 'isaaq_news',
        'posts_per_page' => 3,
        'post_status'    => 'publish',
        'orderby'        => 'date',
        'order'          => 'DESC',
    ) );
    if ( $news_query->have_posts() ) :
    ?>
    <section style="margin:3rem 0;">
        <h2 class="section-title">
            <i class="fas fa-newspaper title-icon"></i><?php esc_html_e( 'Latest News', 'isaaq-kingdom' ); ?>
        </h2>
        <div class="news-grid-dynamic">
            <?php while ( $news_query->have_posts() ) : $news_query->the_post();
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
                    <p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 18 ) ); ?></p>
                    <small style="color:var(--gold);display:block;margin-top:0.8rem;">
                        <i class="fas fa-clock"></i> <?php echo esc_html( get_the_date() ); ?>
                    </small>
                </div>
            </a>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>
        <?php $news_archive = get_post_type_archive_link( 'isaaq_news' ); ?>
        <?php if ( $news_archive ) : ?>
        <div style="text-align:center;margin-top:1.5rem;">
            <a href="<?php echo esc_url( $news_archive ); ?>" class="back-button">
                <?php esc_html_e( 'All News', 'isaaq-kingdom' ); ?> <i class="fas fa-arrow-right"></i>
            </a>
        </div>
        <?php endif; ?>
    </section>
    <?php endif; ?>

    <!-- ===================== UPCOMING EVENTS ===================== -->
    <?php
    $events_query = new WP_Query( array(
        'post_type'      => 'isaaq_event',
        'posts_per_page' => 4,
        'post_status'    => 'publish',
        'orderby'        => 'date',
        'order'          => 'DESC',
    ) );
    if ( $events_query->have_posts() ) :
    ?>
    <section style="margin:3rem 0;">
        <h2 class="section-title">
            <i class="fas fa-calendar-alt title-icon"></i><?php esc_html_e( 'Royal Events', 'isaaq-kingdom' ); ?>
        </h2>
        <div class="event-timeline">
            <?php while ( $events_query->have_posts() ) : $events_query->the_post();
                $year  = get_post_meta( get_the_ID(), '_isaaq_event_year', true );
                $extra = get_post_meta( get_the_ID(), '_isaaq_event_extra', true );
            ?>
            <a href="<?php the_permalink(); ?>" class="event-item-distinct">
                <span class="event-year"><?php echo esc_html( $year ?: get_the_date( 'Y' ) ); ?></span>
                <div>
                    <h3><?php the_title(); ?></h3>
                    <p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 20 ) ); ?></p>
                    <?php if ( $extra ) : ?>
                    <small style="color:var(--ruby);">
                        <i class="fas fa-info-circle"></i> <?php echo esc_html( $extra ); ?>
                    </small>
                    <?php endif; ?>
                </div>
            </a>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>
        <?php $events_archive = get_post_type_archive_link( 'isaaq_event' ); ?>
        <?php if ( $events_archive ) : ?>
        <div style="text-align:center;margin-top:1.5rem;">
            <a href="<?php echo esc_url( $events_archive ); ?>" class="back-button">
                <?php esc_html_e( 'All Events', 'isaaq-kingdom' ); ?> <i class="fas fa-arrow-right"></i>
            </a>
        </div>
        <?php endif; ?>
    </section>
    <?php endif; ?>

</main>

<script>
var slideIndex = 0;
var slides = document.querySelectorAll('.slide');
var dots   = document.querySelectorAll('.dot');

function changeSlide(dir) {
    if (!slides.length) return;
    slideIndex = (slideIndex + dir + slides.length) % slides.length;
    updateSlideClasses();
}

function currentSlide(idx) {
    slideIndex = idx;
    updateSlideClasses();
}

function updateSlideClasses() {
    slides.forEach(function(s, i) {
        s.classList.toggle('active-slide', i === slideIndex);
    });
    dots.forEach(function(d, i) {
        d.classList.toggle('active-dot', i === slideIndex);
    });
}

if (slides.length > 1) {
    setInterval(function() { changeSlide(1); }, 6000);
}
</script>

<?php get_footer(); ?>
