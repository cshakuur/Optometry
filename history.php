<?php
// history.php - History page
$pageTitle = 'History';
require_once 'database.php';
require_once 'header.php';

$db = new Database();
?>

<!-- FLOATING NAVIGATION -->
<div class="floating-nav">
    <a href="index.php">Home</a>
    <a href="king.php">His Majesty</a>
    <a href="history.php" class="active">History</a>
    <a href="heritage.php">Heritage</a>
    <a href="news.php">News</a>
    <a href="events.php">Events</a>
    <a href="admin.php" class="admin-link" target="_blank"><i class="fas fa-cog"></i> Admin</a>
</div>

<main class="container">
    <!-- Page Header -->
    <div class="page-header">
        <h1>The History of Isaaq Kingdom</h1>
        <p>From the 14th century to the present · A legacy of eight kings</p>
    </div>

    <!-- History Content -->
    <section>
        <div class="history-mosaic">
            <div class="history-card">
                <i class="fas fa-calendar-alt history-icon"></i>
                <h3>14th Century</h3>
                <p>Establishment of the Isaaq Kingdom after the fall of the Adal Sultanate. The Tolje'lo dynasty takes leadership.</p>
            </div>
            <div class="history-card">
                <i class="fas fa-flag history-icon"></i>
                <h3>8 Tolje'lo Kings</h3>
                <p>From King Harun (1300s) to King Dhuuh Baraar (1700s), centuries of rule shaped the identity of the Isaaq people.</p>
            </div>
            <div class="history-card">
                <i class="fas fa-people-group history-icon"></i>
                <h3>8 Isaaq Clans</h3>
                <p>Descended from Sheikh Ishaaq's eight sons, uniting under the Tolje'lo dynasty and forming the foundation of the kingdom.</p>
            </div>
        </div>
    </section>

    <!-- Detailed History -->
    <section style="margin: 3rem 0;">
        <h2 class="section-title"><i class="fas fa-scroll title-icon"></i> The Founding</h2>
        <div style="background: var(--glass-bg); backdrop-filter: blur(20px); border-radius: 40px; padding: 2rem; box-shadow: var(--shadow-deep); border: 1px solid var(--glass-border);">
            <p style="font-size: 1.1rem; line-height: 1.8; color: rgba(244, 237, 216, 0.85);">Sheikh Ishaaq Bin Ahmed, a revered Islamic scholar, arrived in the Horn of Africa during the 12th century. He settled in the region of Maydh, where his message and leadership united the local clans. His eight sons became the progenitors of the eight major Isaaq clans:</p>
            
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem; margin: 2rem 0;">
                <div style="background: rgba(201, 168, 76, 0.08); padding: 1rem; border-radius: 30px; text-align: center; border: 1px solid var(--glass-border);">
                    <strong style="color: var(--text-primary);">Habr Awal</strong>
                </div>
                <div style="background: rgba(201, 168, 76, 0.08); padding: 1rem; border-radius: 30px; text-align: center; border: 1px solid var(--glass-border);">
                    <strong style="color: var(--text-primary);">Habr Je'lo</strong>
                </div>
                <div style="background: rgba(201, 168, 76, 0.08); padding: 1rem; border-radius: 30px; text-align: center; border: 1px solid var(--glass-border);">
                    <strong style="color: var(--text-primary);">Habr Yunis</strong>
                </div>
                <div style="background: rgba(201, 168, 76, 0.08); padding: 1rem; border-radius: 30px; text-align: center; border: 1px solid var(--glass-border);">
                    <strong style="color: var(--text-primary);">Arap</strong>
                </div>
                <div style="background: rgba(201, 168, 76, 0.08); padding: 1rem; border-radius: 30px; text-align: center; border: 1px solid var(--glass-border);">
                    <strong style="color: var(--text-primary);">Ayub</strong>
                </div>
                <div style="background: rgba(201, 168, 76, 0.08); padding: 1rem; border-radius: 30px; text-align: center; border: 1px solid var(--glass-border);">
                    <strong style="color: var(--text-primary);">Garhajis</strong>
                </div>
                <div style="background: rgba(201, 168, 76, 0.08); padding: 1rem; border-radius: 30px; text-align: center; border: 1px solid var(--glass-border);">
                    <strong style="color: var(--text-primary);">Habar Magaadle</strong>
                </div>
                <div style="background: rgba(201, 168, 76, 0.08); padding: 1rem; border-radius: 30px; text-align: center; border: 1px solid var(--glass-border);">
                    <strong style="color: var(--text-primary);">Muuse</strong>
                </div>
            </div>
            
            <p style="font-size: 1.1rem; line-height: 1.8; color: rgba(244, 237, 216, 0.85);">The Tolje'lo dynasty emerged as the ruling house, with King Harun becoming the first king in the 14th century. The kingdom flourished through trade, Islamic scholarship, and a unique system of governance combining customary law (xeer) with Islamic principles.</p>
        </div>
    </section>

    <!-- Legacy Section -->
    <section style="margin: 3rem 0; background: linear-gradient(135deg, rgba(5,8,16,0.95), rgba(10,15,30,0.98)); border-radius: 60px; padding: 3rem 2rem; color: white; text-align: center; border: 1px solid var(--glass-border);">
        <h2 style="font-family: 'Playfair Display', serif; font-size: 2.5rem; margin-bottom: 1.5rem; color: var(--text-primary);">The Guurti Council & Xeer Law</h2>
        <p style="font-size: 1.2rem; max-width: 800px; margin: 0 auto; color: var(--text-secondary);">The Isaaq Kingdom was renowned for its sophisticated governance system. The Guurti council of elders, combined with xeer customary law, created a framework for justice and conflict resolution that continues to influence Somali society today.</p>
    </section>

    <div style="text-align: center; margin: 3rem 0;">
        <a href="index.php" class="back-button"><i class="fas fa-arrow-left"></i> Back to Home</a>
    </div>
</main>

<?php require_once 'footer.php'; ?>