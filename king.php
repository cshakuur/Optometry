<?php
// king.php - His Royal Majesty page
$pageTitle = 'His Royal Majesty';
require_once 'database.php';
require_once 'header.php';

$db = new Database();
?>

<!-- FLOATING NAVIGATION -->
<div class="floating-nav">
    <a href="index.php">Home</a>
    <a href="king.php" class="active">His Majesty</a>
    <a href="history.php">History</a>
    <a href="heritage.php">Heritage</a>
    <a href="news.php">News</a>
    <a href="events.php">Events</a>
    <a href="admin.php" class="admin-link" target="_blank"><i class="fas fa-cog"></i> Admin</a>
</div>

<main class="container">
    <!-- Page Header -->
    <div class="page-header">
        <h1>His Royal Majesty</h1>
        <p>King Dhuuh Baraar · The Last Sovereign of the Tolje'lo Dynasty</p>
    </div>

    <!-- King Section -->
    <section id="king">
        <div class="king-panel">
            <div class="king-left">
                <img src="images/king-dhuuh.jpg" alt="King Dhuuh Baraar" class="king-photo">
            </div>
            <div class="king-right">
                <div class="king-name">King Dhuuh Baraar</div>
                <div class="king-badge"><i class="fas fa-feather"></i> Tolje'lo dynasty · last sovereign (early 1700s)</div>
                <p>King Dhuuh Baraar stands as the final monarch of the historic Isaaq Kingdom. As a ruler of the Tolje'lo dynasty, he embodied the legacy tracing back to Sheikh Isaaq Bin Ahmed. His reign marks the culmination of eight Tolje'lo kings who guided the Isaaq clans from the 13th century — shaping identity, justice, and resilience in the Horn of Africa.</p>
                
                <h3 style="color: var(--gold); margin: 1.5rem 0 1rem;">The Tolje'lo Dynasty</h3>
                <p>The Tolje'lo dynasty ruled the Isaaq Kingdom for over 400 years, with eight kings leading the nation through prosperity, conflict, and cultural development. The lineage began with King Harun in the 14th century and ended with King Dhuuh Baraar in the early 1700s.</p>
                
                <div style="display: flex; gap: 1rem; margin-top: 2rem; flex-wrap: wrap;">
                    <button class="btn-king" onclick="alert('📜 The Tolje\'lo Legacy')"><i class="fas fa-scroll"></i> Read Lineage</button>
                    <button class="btn-king" onclick="alert('🎬 Royal Documentary')"><i class="fas fa-play"></i> Watch Documentary</button>
                </div>
            </div>
        </div>
    </section>

    <!-- Kings Timeline -->
    <section style="margin: 4rem 0;">
        <h2 class="section-title"><i class="fas fa-timeline title-icon"></i> The Eight Tolje'lo Kings</h2>
        <div class="event-timeline">
            <div class="event-item-distinct">
                <span class="event-year">1300s</span>
                <div>
                    <h3>King Harun</h3>
                    <p>Founder of the Tolje'lo dynasty · First ruler of the Isaaq Kingdom</p>
                </div>
            </div>
            <div class="event-item-distinct">
                <span class="event-year">1400s</span>
                <div>
                    <h3>King Ibrahim</h3>
                    <p>Expanded the kingdom and established trade routes</p>
                </div>
            </div>
            <div class="event-item-distinct">
                <span class="event-year">1500s</span>
                <div>
                    <h3>King Yaqut</h3>
                    <p>Strengthened the Guurti council and xeer customary law</p>
                </div>
            </div>
            <div class="event-item-distinct">
                <span class="event-year">1600s</span>
                <div>
                    <h3>King Mohammed</h3>
                    <p>Led the kingdom during the peak of its power</p>
                </div>
            </div>
            <div class="event-item-distinct">
                <span class="event-year">1700s</span>
                <div>
                    <h3>King Dhuuh Baraar</h3>
                    <p>The last sovereign · His reign marked the end of the Tolje'lo dynasty</p>
                </div>
            </div>
        </div>
    </section>

    <div style="text-align: center; margin: 3rem 0;">
        <a href="index.php" class="back-button"><i class="fas fa-arrow-left"></i> Back to Home</a>
    </div>
</main>

<?php require_once 'footer.php'; ?>