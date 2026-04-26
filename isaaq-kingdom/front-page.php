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
    <div class="history-mosaic">
        <?php
        $king_id    = isaaq_get_page_by_template( 'template-king.php' );
        $history_id = isaaq_get_page_by_template( 'template-history.php' );
        $heritage_id = isaaq_get_page_by_template( 'template-heritage.php' );
        ?>
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
