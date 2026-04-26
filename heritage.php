<?php
// heritage.php - Heritage page
$pageTitle = 'Heritage';
require_once 'database.php';
require_once 'header.php';

$db = new Database();
$lineage = $db->getLineageBanner();
?>

<!-- FLOATING NAVIGATION -->
<div class="floating-nav">
    <a href="index.php">Home</a>
    <a href="king.php">His Majesty</a>
    <a href="history.php">History</a>
    <a href="heritage.php" class="active">Heritage</a>
    <a href="news.php">News</a>
    <a href="events.php">Events</a>
    <a href="admin.php" class="admin-link" target="_blank"><i class="fas fa-cog"></i> Admin</a>
</div>

<main class="container">
    <!-- Page Header -->
    <div class="page-header">
        <h1>Royal Heritage & Imagery</h1>
        <p>Artifacts, symbols, and cultural treasures of the Isaaq Kingdom</p>
    </div>

    <!-- Heritage Showcase -->
    <section>
        <h2 class="section-title"><i class="fas fa-images title-icon"></i> Royal Imagery</h2>
        <div class="heritage-showcase">
            <div class="heritage-piece">
                <img src="images/adal-banner.jpg" alt="Adal Banner" class="heritage-image">
                <h3>Adal Banner</h3>
                <p style="margin-top: 0.5rem;">Used by the Adal Sultanate and Isaaq Kingdom on ceremonial occasions</p>
            </div>
            <div class="heritage-piece">
                <img src="images/sheikh-ishaaq.jpg" alt="Sheikh Ishaaq" class="heritage-image">
                <h3>Sheikh Ishaaq</h3>
                <p style="margin-top: 0.5rem;">12th century scholar whose eight sons founded the Isaaq clans</p>
            </div>
            <div class="heritage-piece">
                <img src="images/king-harun.jpg" alt="King Harun" class="heritage-image">
                <h3>King Harun</h3>
                <p style="margin-top: 0.5rem;">First Tolje'lo ruler (1300s) - Founder of the dynasty</p>
            </div>
        </div>
    </section>

    <!-- Lineage Banner -->
    <section>
        <div class="lineage-banner-modern">
            <?php echo htmlspecialchars($lineage); ?>
        </div>
    </section>

    <!-- Additional Heritage Items -->
    <section style="margin: 3rem 0;">
        <h2 class="section-title"><i class="fas fa-landmark title-icon"></i> Cultural Treasures</h2>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 2rem;">
            <div style="background: white; border-radius: 40px; padding: 2rem; text-align: center;">
                <i class="fas fa-scroll" style="font-size: 3rem; color: var(--ruby); margin-bottom: 1rem;"></i>
                <h3 style="color: var(--sapphire);">Ancient Manuscripts</h3>
                <p>Islamic texts and historical records preserved for centuries</p>
            </div>
            <div style="background: white; border-radius: 40px; padding: 2rem; text-align: center;">
                <i class="fas fa-music" style="font-size: 3rem; color: var(--ruby); margin-bottom: 1rem;"></i>
                <h3 style="color: var(--sapphire);">Royal Gabay</h3>
                <p>Traditional poetry and oral traditions passed through generations</p>
            </div>
            <div style="background: white; border-radius: 40px; padding: 2rem; text-align: center;">
                <i class="fas fa-gem" style="font-size: 3rem; color: var(--ruby); margin-bottom: 1rem;"></i>
                <h3 style="color: var(--sapphire);">Royal Artifacts</h3>
                <p>Ceremonial items and symbols of kingship</p>
            </div>
        </div>
    </section>

    <div style="text-align: center; margin: 3rem 0;">
        <a href="index.php" class="back-button"><i class="fas fa-arrow-left"></i> Back to Home</a>
    </div>
</main>

<?php require_once 'footer.php'; ?>