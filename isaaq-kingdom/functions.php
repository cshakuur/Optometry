<?php
/**
 * Isaaq Kingdom Theme — functions.php
 *
 * Sets up theme supports, enqueues assets, registers custom post types,
 * meta boxes, navigation menus, and a lineage-banner settings page.
 */

// ============================================================
// 1. THEME SETUP
// ============================================================
function isaaq_theme_setup() {
    // Let WordPress manage the document title
    add_theme_support( 'title-tag' );

    // Featured images on posts and custom types
    add_theme_support( 'post-thumbnails' );

    // Custom logo
    add_theme_support( 'custom-logo', array(
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
    ) );

    // HTML5 markup
    add_theme_support( 'html5', array(
        'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'script', 'style',
    ) );

    // Register navigation menu location
    register_nav_menus( array(
        'main-menu' => esc_html__( 'Main Menu', 'isaaq-kingdom' ),
    ) );
}
add_action( 'after_setup_theme', 'isaaq_theme_setup' );

// ============================================================
// 2. ENQUEUE STYLES & SCRIPTS
// ============================================================
function isaaq_enqueue_assets() {
    // Main stylesheet
    wp_enqueue_style(
        'isaaq-style',
        get_stylesheet_uri(),
        array(),
        wp_get_theme()->get( 'Version' )
    );

    // Font Awesome 6
    wp_enqueue_style(
        'font-awesome',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css',
        array(),
        '6.0.0-beta3'
    );

    // Google Fonts
    wp_enqueue_style(
        'isaaq-google-fonts',
        'https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;800;900&family=Plus+Jakarta+Sans:wght@300;400;600;700;800&display=swap',
        array(),
        null
    );
}
add_action( 'wp_enqueue_scripts', 'isaaq_enqueue_assets' );

// ============================================================
// 3. CUSTOM POST TYPES
// ============================================================

/** Hero Slideshow Slides */
function isaaq_register_cpt_slide() {
    $labels = array(
        'name'               => _x( 'Slides', 'post type general name', 'isaaq-kingdom' ),
        'singular_name'      => _x( 'Slide', 'post type singular name', 'isaaq-kingdom' ),
        'add_new_item'       => __( 'Add New Slide', 'isaaq-kingdom' ),
        'edit_item'          => __( 'Edit Slide', 'isaaq-kingdom' ),
        'all_items'          => __( 'All Slides', 'isaaq-kingdom' ),
        'menu_name'          => __( 'Slides', 'isaaq-kingdom' ),
    );
    register_post_type( 'isaaq_slide', array(
        'labels'        => $labels,
        'public'        => false,
        'show_ui'       => true,
        'show_in_menu'  => true,
        'supports'      => array( 'title', 'excerpt', 'editor', 'thumbnail', 'page-attributes' ),
        'menu_icon'     => 'dashicons-images-alt2',
        'rewrite'       => false,
    ) );
}
add_action( 'init', 'isaaq_register_cpt_slide' );

/** News Articles */
function isaaq_register_cpt_news() {
    $labels = array(
        'name'               => _x( 'News', 'post type general name', 'isaaq-kingdom' ),
        'singular_name'      => _x( 'News Article', 'post type singular name', 'isaaq-kingdom' ),
        'add_new_item'       => __( 'Add News Article', 'isaaq-kingdom' ),
        'edit_item'          => __( 'Edit News Article', 'isaaq-kingdom' ),
        'all_items'          => __( 'All News', 'isaaq-kingdom' ),
        'menu_name'          => __( 'News', 'isaaq-kingdom' ),
    );
    register_post_type( 'isaaq_news', array(
        'labels'        => $labels,
        'public'        => true,
        'show_ui'       => true,
        'show_in_menu'  => true,
        'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
        'has_archive'   => true,
        'rewrite'       => array( 'slug' => 'news' ),
        'menu_icon'     => 'dashicons-megaphone',
    ) );
}
add_action( 'init', 'isaaq_register_cpt_news' );

/** Royal Events */
function isaaq_register_cpt_event() {
    $labels = array(
        'name'               => _x( 'Events', 'post type general name', 'isaaq-kingdom' ),
        'singular_name'      => _x( 'Event', 'post type singular name', 'isaaq-kingdom' ),
        'add_new_item'       => __( 'Add New Event', 'isaaq-kingdom' ),
        'edit_item'          => __( 'Edit Event', 'isaaq-kingdom' ),
        'all_items'          => __( 'All Events', 'isaaq-kingdom' ),
        'menu_name'          => __( 'Events', 'isaaq-kingdom' ),
    );
    register_post_type( 'isaaq_event', array(
        'labels'        => $labels,
        'public'        => true,
        'show_ui'       => true,
        'show_in_menu'  => true,
        'supports'      => array( 'title', 'editor', 'thumbnail' ),
        'has_archive'   => true,
        'rewrite'       => array( 'slug' => 'events' ),
        'menu_icon'     => 'dashicons-calendar-alt',
    ) );
}
add_action( 'init', 'isaaq_register_cpt_event' );

// ============================================================
// 4. META BOXES
// ============================================================

function isaaq_register_meta_boxes() {
    // Slide: tagline field (post excerpt serves as tagline; slide_order uses Menu Order)
    add_meta_box(
        'isaaq_slide_meta',
        __( 'Slide Details', 'isaaq-kingdom' ),
        'isaaq_slide_meta_cb',
        'isaaq_slide',
        'normal',
        'high'
    );

    // News: category
    add_meta_box(
        'isaaq_news_meta',
        __( 'News Details', 'isaaq-kingdom' ),
        'isaaq_news_meta_cb',
        'isaaq_news',
        'normal',
        'high'
    );

    // Event: year + extra info
    add_meta_box(
        'isaaq_event_meta',
        __( 'Event Details', 'isaaq-kingdom' ),
        'isaaq_event_meta_cb',
        'isaaq_event',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'isaaq_register_meta_boxes' );

/** Slide meta box callback */
function isaaq_slide_meta_cb( $post ) {
    wp_nonce_field( 'isaaq_slide_save', 'isaaq_slide_nonce' );
    $tagline = get_post_meta( $post->ID, '_isaaq_slide_tagline', true );
    echo '<p><strong>' . esc_html__( 'Tagline', 'isaaq-kingdom' ) . '</strong><br>';
    echo '<input type="text" name="isaaq_slide_tagline" value="' . esc_attr( $tagline ) . '" style="width:100%" /></p>';
    echo '<p style="color:#666;font-size:0.85em;">' . esc_html__( 'Tip: Use the post Title as the headline, Excerpt as the description, Featured Image as the background. Use Menu Order (in Publish box) to control slide order.', 'isaaq-kingdom' ) . '</p>';
}

/** News meta box callback */
function isaaq_news_meta_cb( $post ) {
    wp_nonce_field( 'isaaq_news_save', 'isaaq_news_nonce' );
    $category = get_post_meta( $post->ID, '_isaaq_news_category', true );
    echo '<p><strong>' . esc_html__( 'Category', 'isaaq-kingdom' ) . '</strong><br>';
    echo '<input type="text" name="isaaq_news_category" value="' . esc_attr( $category ) . '" style="width:100%" placeholder="e.g. Royal Decree, Heritage, Diplomacy" /></p>';
}

/** Event meta box callback */
function isaaq_event_meta_cb( $post ) {
    wp_nonce_field( 'isaaq_event_save', 'isaaq_event_nonce' );
    $year  = get_post_meta( $post->ID, '_isaaq_event_year', true );
    $extra = get_post_meta( $post->ID, '_isaaq_event_extra', true );
    echo '<p><strong>' . esc_html__( 'Year / Date', 'isaaq-kingdom' ) . '</strong><br>';
    echo '<input type="text" name="isaaq_event_year" value="' . esc_attr( $year ) . '" style="width:100%" placeholder="e.g. 2026, Spring 2026" /></p>';
    echo '<p><strong>' . esc_html__( 'Additional Info', 'isaaq-kingdom' ) . '</strong><br>';
    echo '<input type="text" name="isaaq_event_extra" value="' . esc_attr( $extra ) . '" style="width:100%" /></p>';
}

/** Save meta box data */
function isaaq_save_meta_boxes( $post_id ) {
    // Slide
    if ( isset( $_POST['isaaq_slide_nonce'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['isaaq_slide_nonce'] ) ), 'isaaq_slide_save' ) ) {
        if ( ! wp_is_post_autosave( $post_id ) && ! wp_is_post_revision( $post_id ) ) {
            update_post_meta( $post_id, '_isaaq_slide_tagline', sanitize_text_field( wp_unslash( $_POST['isaaq_slide_tagline'] ?? '' ) ) );
        }
    }

    // News
    if ( isset( $_POST['isaaq_news_nonce'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['isaaq_news_nonce'] ) ), 'isaaq_news_save' ) ) {
        if ( ! wp_is_post_autosave( $post_id ) && ! wp_is_post_revision( $post_id ) ) {
            update_post_meta( $post_id, '_isaaq_news_category', sanitize_text_field( wp_unslash( $_POST['isaaq_news_category'] ?? '' ) ) );
        }
    }

    // Event
    if ( isset( $_POST['isaaq_event_nonce'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['isaaq_event_nonce'] ) ), 'isaaq_event_save' ) ) {
        if ( ! wp_is_post_autosave( $post_id ) && ! wp_is_post_revision( $post_id ) ) {
            update_post_meta( $post_id, '_isaaq_event_year',  sanitize_text_field( wp_unslash( $_POST['isaaq_event_year']  ?? '' ) ) );
            update_post_meta( $post_id, '_isaaq_event_extra', sanitize_text_field( wp_unslash( $_POST['isaaq_event_extra'] ?? '' ) ) );
        }
    }
}
add_action( 'save_post', 'isaaq_save_meta_boxes' );

// ============================================================
// 5. LINEAGE BANNER SETTINGS PAGE
// ============================================================

function isaaq_admin_menu() {
    add_options_page(
        __( 'Isaaq Kingdom Settings', 'isaaq-kingdom' ),
        __( 'Isaaq Kingdom', 'isaaq-kingdom' ),
        'manage_options',
        'isaaq-kingdom-settings',
        'isaaq_settings_page_cb'
    );
}
add_action( 'admin_menu', 'isaaq_admin_menu' );

function isaaq_settings_page_cb() {
    if ( ! current_user_can( 'manage_options' ) ) {
        return;
    }

    if ( isset( $_POST['isaaq_settings_nonce'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['isaaq_settings_nonce'] ) ), 'isaaq_settings_save' ) ) {
        update_option( 'isaaq_lineage_banner', sanitize_textarea_field( wp_unslash( $_POST['isaaq_lineage_banner'] ?? '' ) ) );
        echo '<div class="updated"><p>' . esc_html__( 'Settings saved.', 'isaaq-kingdom' ) . '</p></div>';
    }

    $lineage = get_option( 'isaaq_lineage_banner', "Sheikh Ishaaq → Tolje'lo Dynasty → 8 Isaaq Clans → Harun · Ibrahim · Yaqut · Mohammed · Dhuuh Baraar" );
    ?>
    <div class="wrap">
        <h1><?php esc_html_e( 'Isaaq Kingdom Settings', 'isaaq-kingdom' ); ?></h1>
        <form method="post">
            <?php wp_nonce_field( 'isaaq_settings_save', 'isaaq_settings_nonce' ); ?>
            <table class="form-table">
                <tr>
                    <th scope="row">
                        <label for="isaaq_lineage_banner"><?php esc_html_e( 'Heritage Page Lineage Banner Text', 'isaaq-kingdom' ); ?></label>
                    </th>
                    <td>
                        <textarea id="isaaq_lineage_banner" name="isaaq_lineage_banner" rows="3" cols="70" class="large-text"><?php echo esc_textarea( $lineage ); ?></textarea>
                        <p class="description"><?php esc_html_e( 'Text displayed in the gradient banner on the Heritage page.', 'isaaq-kingdom' ); ?></p>
                    </td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

// ============================================================
// 6. CUSTOM NAV WALKER (outputs <a> tags directly in floating-nav)
// ============================================================

class Isaaq_Nav_Walker extends Walker_Nav_Menu {

    public function start_lvl( &$output, $depth = 0, $args = null ) {
        // Suppress sub-menus
    }

    public function end_lvl( &$output, $depth = 0, $args = null ) {
        // Suppress sub-menus
    }

    public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
        $is_current = in_array( 'current-menu-item', $item->classes, true )
                   || in_array( 'current_page_item', $item->classes, true )
                   || in_array( 'current-page-ancestor', $item->classes, true );

        $class = $is_current ? ' class="active"' : '';
        $target = ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) . '"' : '';
        $output .= '<a href="' . esc_url( $item->url ) . '"' . $class . $target . '>'
                 . esc_html( $item->title )
                 . '</a>';
    }

    public function end_el( &$output, $item, $depth = 0, $args = null ) {
        // No closing tag needed
    }
}

// ============================================================
// 7. HELPER: OUTPUT FLOATING NAV
// ============================================================

/**
 * Outputs the floating navigation bar.
 * Falls back to a hardcoded menu if no WordPress menu is assigned.
 *
 * @param bool $no_hero  When true, adds the no-hero margin modifier class.
 */
function isaaq_floating_nav( $no_hero = false ) {
    $class = 'floating-nav' . ( $no_hero ? ' no-hero' : '' );
    echo '<nav class="' . esc_attr( $class ) . '" aria-label="' . esc_attr__( 'Main navigation', 'isaaq-kingdom' ) . '">';

    if ( has_nav_menu( 'main-menu' ) ) {
        wp_nav_menu( array(
            'theme_location' => 'main-menu',
            'container'      => false,
            'items_wrap'     => '%3$s',
            'walker'         => new Isaaq_Nav_Walker(),
            'fallback_cb'    => false,
        ) );
    } else {
        // Fallback hardcoded links
        $pages = array(
            'Home'        => home_url( '/' ),
            'His Majesty' => get_permalink( isaaq_get_page_by_template( 'template-king.php' ) ),
            'History'     => get_permalink( isaaq_get_page_by_template( 'template-history.php' ) ),
            'Heritage'    => get_permalink( isaaq_get_page_by_template( 'template-heritage.php' ) ),
            'News'        => get_post_type_archive_link( 'isaaq_news' ),
            'Events'      => get_post_type_archive_link( 'isaaq_event' ),
        );
        foreach ( $pages as $label => $url ) {
            if ( $url ) {
                echo '<a href="' . esc_url( $url ) . '">' . esc_html( $label ) . '</a>';
            }
        }
    }

    echo '</nav>';
}

/**
 * Helper: find a page using a specific page template.
 *
 * @param  string $template  Template file name, e.g. 'template-king.php'.
 * @return int|null  Post ID or null if not found.
 */
function isaaq_get_page_by_template( $template ) {
    $pages = get_posts( array(
        'post_type'      => 'page',
        'posts_per_page' => 1,
        'meta_key'       => '_wp_page_template',
        'meta_value'     => $template,
        'fields'         => 'ids',
    ) );
    return ! empty( $pages ) ? $pages[0] : null;
}
