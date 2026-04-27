<?php
// index.php - Home page (shows all content)
$pageTitle = 'Home';
require_once 'database.php';
require_once 'header.php';

$db      = new Database();
$slides  = $db->getSlides();
$news    = $db->getNews();
$events  = $db->getEvents();
$lineage = $db->getLineageBanner();

// Limit to 3 items for homepage
$homeNews   = array_slice($news, 0, 3);
$homeEvents = array_slice($events, 0, 3);
?>

<!-- HERO SLIDESHOW -->
<section class="hero-slideshow" id="home">
    <div class="slides-container">
        <?php foreach ($slides as $index => $slide): ?>
        <div class="slide <?php echo $index === 0 ? 'active-slide' : ''; ?>" 
             style="background-image: url('<?php echo htmlspecialchars($slide['image_path']); ?>');">
            <div class="slide-content">
                <h2><i class="fas fa-crown"></i> <?php echo htmlspecialchars($slide['headline']); ?></h2>
                <div class="slide-tagline"><?php echo htmlspecialchars($slide['tagline']); ?></div>
                <div class="slide-desc"><?php echo htmlspecialchars($slide['description']); ?></div>
            </div>
        </div>
        <?php endforeach; ?>
        
        <div class="slide-arrow prev" onclick="changeSlide(-1)"><i class="fas fa-chevron-left"></i></div>
        <div class="slide-arrow next" onclick="changeSlide(1)"><i class="fas fa-chevron-right"></i></div>
        
        <div class="slide-indicators">
            <?php foreach ($slides as $index => $slide): ?>
            <span class="dot <?php echo $index === 0 ? 'active-dot' : ''; ?>" 
                  onclick="currentSlide(<?php echo $index; ?>)"></span>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- FLOATING NAVIGATION -->
<div class="floating-nav">
    <a href="index.php" class="active">Home</a>
    <a href="king.php">His Majesty</a>
    <a href="history.php">History</a>
    <a href="heritage.php">Heritage</a>
    <a href="news.php">News</a>
    <a href="events.php">Events</a>
    <a href="admin.php" class="admin-link" target="_blank"><i class="fas fa-cog"></i> Admin</a>
</div>

<main class="container">
    <!-- Welcome Section -->
    <div class="page-header">
        <h1>Welcome to the Isaaq Kingdom</h1>
        <p>Discover the rich heritage of the Tolje'lo dynasty and the legacy of eight kings</p>
    </div>

    <!-- Quick Links -->
    <div class="history-mosaic">
        <a href="king.php" style="text-decoration: none;">
            <div class="history-card">
                <i class="fas fa-crown history-icon"></i>
                <h3>His Majesty</h3>
                <p>Learn about King Dhuuh Baraar, the last sovereign of the Tolje'lo dynasty</p>
            </div>
        </a>
        <a href="history.php" style="text-decoration: none;">
            <div class="history-card">
                <i class="fas fa-timeline history-icon"></i>
                <h3>History</h3>
                <p>Explore the rich history of the Isaaq Kingdom from the 14th century</p>
            </div>
        </a>
        <a href="heritage.php" style="text-decoration: none;">
            <div class="history-card">
                <i class="fas fa-images history-icon"></i>
                <h3>Heritage</h3>
                <p>View royal imagery and cultural artifacts</p>
            </div>
        </a>
    </div>

    <!-- ===================== HIS MAJESTY PREVIEW ===================== -->
    <section style="margin: 3rem 0;">
        <h2 class="section-title"><i class="fas fa-crown title-icon"></i> His Royal Majesty</h2>
        <div class="king-panel">
            <div class="king-left">
                <div class="king-photo" style="background: var(--charcoal); display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-crown" style="font-size: 5rem; color: var(--gold-leaf);"></i>
                </div>
            </div>
            <div class="king-right">
                <div class="king-name">King Dhuuh Baraar</div>
                <div class="king-badge"><i class="fas fa-feather"></i> Tolje'lo Dynasty · Last Sovereign (early 1700s)</div>
                <p>King Dhuuh Baraar stands as the final monarch of the historic Isaaq Kingdom. As a ruler of the Tolje'lo dynasty, he embodied the legacy tracing back to Sheikh Isaaq Bin Ahmed. His reign marks the culmination of eight Tolje'lo kings who guided the Isaaq clans from the 13th century — shaping identity, justice, and resilience in the Horn of Africa.</p>
                <h3 style="color: var(--sapphire); margin: 1.5rem 0 1rem; font-size: 1.4rem;">The Tolje'lo Dynasty</h3>
                <p>The Tolje'lo dynasty ruled the Isaaq Kingdom for over 400 years. The lineage began with King Harun in the 14th century and ended with King Dhuuh Baraar in the early 1700s — eight kings who built a legacy of governance, scholarship, and unity.</p>
                <div style="margin-top: 1.5rem;">
                    <a href="king.php" class="back-button">Full Royal Profile <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </section>

    <!-- ===================== HISTORY HIGHLIGHTS ===================== -->
    <section style="margin: 3rem 0;">
        <h2 class="section-title"><i class="fas fa-scroll title-icon"></i> History of the Kingdom</h2>
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
        <div style="text-align: center; margin-top: 1.5rem;">
            <a href="history.php" class="back-button">Full History <i class="fas fa-arrow-right"></i></a>
        </div>
    </section>

    <!-- ===================== HERITAGE PREVIEW ===================== -->
    <section style="margin: 3rem 0;">
        <h2 class="section-title"><i class="fas fa-images title-icon"></i> Royal Heritage</h2>

        <!-- Lineage Banner -->
        <div class="lineage-banner-modern" style="margin-bottom: 2rem;">
            <?php echo htmlspecialchars($lineage); ?>
        </div>

        <!-- Cultural Treasures -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.5rem;">
            <div style="background: white; border-radius: 40px; padding: 2rem; text-align: center; box-shadow: var(--shadow-strong);">
                <i class="fas fa-scroll" style="font-size: 2.8rem; color: var(--ruby); margin-bottom: 1rem; display: block;"></i>
                <h3 style="color: var(--sapphire); font-size: 1.3rem;">Ancient Manuscripts</h3>
                <p style="font-size: 0.95rem;">Islamic texts and historical records preserved for centuries</p>
            </div>
            <div style="background: white; border-radius: 40px; padding: 2rem; text-align: center; box-shadow: var(--shadow-strong);">
                <i class="fas fa-music" style="font-size: 2.8rem; color: var(--ruby); margin-bottom: 1rem; display: block;"></i>
                <h3 style="color: var(--sapphire); font-size: 1.3rem;">Royal Gabay</h3>
                <p style="font-size: 0.95rem;">Traditional poetry and oral traditions passed through generations</p>
            </div>
            <div style="background: white; border-radius: 40px; padding: 2rem; text-align: center; box-shadow: var(--shadow-strong);">
                <i class="fas fa-gem" style="font-size: 2.8rem; color: var(--ruby); margin-bottom: 1rem; display: block;"></i>
                <h3 style="color: var(--sapphire); font-size: 1.3rem;">Royal Artifacts</h3>
                <p style="font-size: 0.95rem;">Ceremonial items and symbols of kingship</p>
            </div>
            <div style="background: white; border-radius: 40px; padding: 2rem; text-align: center; box-shadow: var(--shadow-strong);">
                <i class="fas fa-mosque" style="font-size: 2.8rem; color: var(--ruby); margin-bottom: 1rem; display: block;"></i>
                <h3 style="color: var(--sapphire); font-size: 1.3rem;">Sacred Sites</h3>
                <p style="font-size: 0.95rem;">Shrines, mosques, and holy places of the Isaaq Kingdom</p>
            </div>
        </div>

        <div style="text-align: center; margin-top: 1.5rem;">
            <a href="heritage.php" class="back-button">Full Heritage Gallery <i class="fas fa-arrow-right"></i></a>
        </div>
    </section>

    <!-- ===================== LATEST NEWS ===================== -->
    <?php if (!empty($homeNews)): ?>
    <section style="margin: 3rem 0;">
        <h2 class="section-title"><i class="fas fa-newspaper title-icon"></i> Latest News</h2>
        <div class="news-grid-dynamic">
            <?php foreach ($homeNews as $item): ?>
            <div class="news-super" onclick="openNewsModal(<?php echo htmlspecialchars(json_encode($item)); ?>)">
                <div class="news-img-super" style="background-image: url('<?php echo htmlspecialchars($item['image_path']); ?>');">
                    <span class="news-category"><?php echo htmlspecialchars($item['category']); ?></span>
                </div>
                <div class="news-content-super">
                    <h3><?php echo htmlspecialchars($item['title']); ?></h3>
                    <p><?php echo htmlspecialchars(substr($item['description'], 0, 100)) . '…'; ?></p>
                    <small style="color: var(--ruby); display: block; margin-top: 0.8rem;">
                        <i class="fas fa-clock"></i> <?php echo date('F j, Y', strtotime($item['created_at'] ?? 'now')); ?>
                    </small>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <div style="text-align: center; margin-top: 1.5rem;">
            <a href="news.php" class="back-button">All News <i class="fas fa-arrow-right"></i></a>
        </div>
    </section>

    <!-- News Modal -->
    <div id="newsModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.8); z-index: 1000; justify-content: center; align-items: center;">
        <div style="background: white; border-radius: 60px; max-width: 600px; width: 90%; max-height: 80vh; overflow-y: auto; padding: 2rem; position: relative;">
            <button onclick="closeNewsModal()" style="position: absolute; top: 1rem; right: 1rem; background: var(--ruby); color: white; border: none; width: 40px; height: 40px; border-radius: 50%; cursor: pointer; font-size: 1.2rem;">×</button>
            <div id="modalContent"></div>
        </div>
    </div>
    <?php endif; ?>

    <!-- ===================== ROYAL EVENTS ===================== -->
    <?php if (!empty($homeEvents)): ?>
    <section style="margin: 3rem 0;">
        <h2 class="section-title"><i class="fas fa-calendar-alt title-icon"></i> Royal Events</h2>
        <div class="event-timeline">
            <?php foreach ($homeEvents as $event): ?>
            <div class="event-item-distinct" onclick="openEventModal(<?php echo htmlspecialchars(json_encode($event)); ?>)">
                <span class="event-year"><?php echo htmlspecialchars($event['event_year']); ?></span>
                <div>
                    <h3><?php echo htmlspecialchars($event['event_name']); ?></h3>
                    <p><?php echo htmlspecialchars(substr($event['description'], 0, 120)) . (strlen($event['description']) > 120 ? '…' : ''); ?></p>
                    <?php if (!empty($event['extra_info'])): ?>
                    <small style="color: var(--ruby);"><i class="fas fa-info-circle"></i> <?php echo htmlspecialchars($event['extra_info']); ?></small>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <div style="text-align: center; margin-top: 1.5rem;">
            <a href="events.php" class="back-button">All Events <i class="fas fa-arrow-right"></i></a>
        </div>
    </section>

    <!-- Event Modal -->
    <div id="eventModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.8); z-index: 1000; justify-content: center; align-items: center;">
        <div style="background: white; border-radius: 60px; max-width: 500px; width: 90%; padding: 2rem; position: relative;">
            <button onclick="closeEventModal()" style="position: absolute; top: 1rem; right: 1rem; background: var(--ruby); color: white; border: none; width: 40px; height: 40px; border-radius: 50%; cursor: pointer; font-size: 1.2rem;">×</button>
            <div id="eventModalContent"></div>
        </div>
    </div>
    <?php endif; ?>

</main>

<script>
// Slideshow functions
let slideIndex = 0;
const slides = document.querySelectorAll('.slide');
const dots = document.querySelectorAll('.dot');

function changeSlide(dir) {
    slideIndex = (slideIndex + dir + slides.length) % slides.length;
    updateSlideClasses();
}

function currentSlide(idx) {
    slideIndex = idx;
    updateSlideClasses();
}

function updateSlideClasses() {
    slides.forEach((s, i) => {
        s.classList.toggle('active-slide', i === slideIndex);
    });
    dots.forEach((d, i) => {
        d.classList.toggle('active-dot', i === slideIndex);
    });
}

if (slides.length > 1) {
    setInterval(() => changeSlide(1), 6000);
}

// News modal
function openNewsModal(item) {
    const modal = document.getElementById('newsModal');
    if (!modal) return;
    document.getElementById('modalContent').innerHTML = `
        <img src="${item.image_path}" alt="${item.title}" style="width:100%;height:250px;object-fit:cover;border-radius:30px;margin-bottom:1.5rem;">
        <span style="background:var(--ruby);color:white;padding:0.3rem 1.5rem;border-radius:40px;font-size:0.9rem;display:inline-block;margin-bottom:1rem;">${item.category}</span>
        <h2 style="color:var(--sapphire);margin-bottom:1rem;">${item.title}</h2>
        <p style="line-height:1.8;margin-bottom:1rem;">${item.description}</p>
        <small style="color:#666;"><i class="fas fa-calendar"></i> ${new Date().toLocaleDateString()}</small>
    `;
    modal.style.display = 'flex';
}

function closeNewsModal() {
    const modal = document.getElementById('newsModal');
    if (modal) modal.style.display = 'none';
}

// Event modal
function openEventModal(event) {
    const modal = document.getElementById('eventModal');
    if (!modal) return;
    document.getElementById('eventModalContent').innerHTML = `
        <h2 style="color:var(--ruby);margin-bottom:1rem;">${event.event_name}</h2>
        <div style="background:var(--cream);border-radius:30px;padding:1rem;margin-bottom:1rem;">
            <p><strong>Year:</strong> ${event.event_year}</p>
            <p><strong>Description:</strong> ${event.description}</p>
            ${event.extra_info ? `<p><strong>Additional Info:</strong> ${event.extra_info}</p>` : ''}
        </div>
        <button onclick="closeEventModal()" class="btn-king" style="width:100%;">Close</button>
    `;
    modal.style.display = 'flex';
}

function closeEventModal() {
    const modal = document.getElementById('eventModal');
    if (modal) modal.style.display = 'none';
}

// Close modals when clicking outside
window.onclick = function(e) {
    const newsModal  = document.getElementById('newsModal');
    const eventModal = document.getElementById('eventModal');
    if (newsModal  && e.target === newsModal)  newsModal.style.display  = 'none';
    if (eventModal && e.target === eventModal) eventModal.style.display = 'none';
};
</script>

<?php require_once 'footer.php'; ?>