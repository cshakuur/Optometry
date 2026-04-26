<?php
// index.php - Home page
$pageTitle = 'Home';
require_once 'database.php';
require_once 'header.php';

$db = new Database();
$slides = $db->getSlides();
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

<?php require_once 'footer.php'; ?>