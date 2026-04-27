<?php
// index.php - Home page (shows all content with slideshow)
$pageTitle = 'Home';
require_once 'database.php';
require_once 'header.php';

$db = new Database();
$slides = $db->getSlides();
$news = $db->getNews();
$events = $db->getEvents();
$lineage = $db->getLineageBanner();

// Limit to 3 items for homepage
$homeNews = array_slice($news, 0, 3);
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

    <!-- Lineage Banner -->
    <?php if (!empty($lineage)): ?>
    <div class="lineage-banner-modern">
        <i class="fas fa-star"></i> <?php echo htmlspecialchars($lineage); ?> <i class="fas fa-star"></i>
    </div>
    <?php endif; ?>

    <!-- Latest News -->
    <?php if (!empty($homeNews)): ?>
    <section>
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
                    <small style="color: var(--ruby); display: block; margin-top: 1rem;">
                        <i class="fas fa-clock"></i> <?php echo date('F j, Y', strtotime($item['created_at'] ?? 'now')); ?>
                    </small>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <div style="text-align: center; margin: 1.5rem 0 2rem;">
            <a href="news.php" class="back-button"><i class="fas fa-newspaper"></i> View All News</a>
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

    <!-- Recent Events -->
    <?php if (!empty($homeEvents)): ?>
    <section>
        <h2 class="section-title"><i class="fas fa-calendar-alt title-icon"></i> Recent Events</h2>
        <div class="event-timeline">
            <?php foreach ($homeEvents as $event): ?>
            <div class="event-item-distinct" onclick="openEventModal(<?php echo htmlspecialchars(json_encode($event)); ?>)">
                <span class="event-year"><?php echo htmlspecialchars($event['event_year']); ?></span>
                <div>
                    <h3><?php echo htmlspecialchars($event['event_name']); ?></h3>
                    <p><?php echo htmlspecialchars($event['description']); ?></p>
                    <?php if (!empty($event['extra_info'])): ?>
                    <small style="color: var(--ruby);"><i class="fas fa-info-circle"></i> <?php echo htmlspecialchars($event['extra_info']); ?></small>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <div style="text-align: center; margin: 1.5rem 0 2rem;">
            <a href="events.php" class="back-button"><i class="fas fa-calendar-alt"></i> View All Events</a>
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

setInterval(() => changeSlide(1), 6000);
</script>

<script>
function openNewsModal(item) {
    const modal = document.getElementById('newsModal');
    const content = document.getElementById('modalContent');
    content.innerHTML = `
        <img src="${item.image_path}" alt="${item.title}" style="width: 100%; height: 250px; object-fit: cover; border-radius: 30px; margin-bottom: 1.5rem;">
        <span style="background: var(--ruby); color: white; padding: 0.3rem 1.5rem; border-radius: 40px; font-size: 0.9rem; display: inline-block; margin-bottom: 1rem;">${item.category}</span>
        <h2 style="color: var(--sapphire); margin-bottom: 1rem;">${item.title}</h2>
        <p style="line-height: 1.8; margin-bottom: 1rem;">${item.description}</p>
        <small style="color: #666;"><i class="fas fa-calendar"></i> ${new Date().toLocaleDateString()}</small>
    `;
    modal.style.display = 'flex';
}

function closeNewsModal() {
    document.getElementById('newsModal').style.display = 'none';
}

function openEventModal(event) {
    const modal = document.getElementById('eventModal');
    const content = document.getElementById('eventModalContent');
    content.innerHTML = `
        <h2 style="color: var(--ruby); margin-bottom: 1rem;">${event.event_name}</h2>
        <div style="background: var(--cream); border-radius: 30px; padding: 1rem; margin-bottom: 1rem;">
            <p><strong>Year:</strong> ${event.event_year}</p>
            <p><strong>Description:</strong> ${event.description}</p>
            ${event.extra_info ? `<p><strong>Additional Info:</strong> ${event.extra_info}</p>` : ''}
        </div>
        <button onclick="closeEventModal()" class="btn-king" style="width: 100%;">Close</button>
    `;
    modal.style.display = 'flex';
}

function closeEventModal() {
    document.getElementById('eventModal').style.display = 'none';
}

// Close modals when clicking outside
window.addEventListener('click', function(e) {
    const newsModal = document.getElementById('newsModal');
    const eventModal = document.getElementById('eventModal');
    if (newsModal && e.target === newsModal) newsModal.style.display = 'none';
    if (eventModal && e.target === eventModal) eventModal.style.display = 'none';
});
</script>

<?php require_once 'footer.php'; ?>