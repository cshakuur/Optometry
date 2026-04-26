<?php
// news.php - News page
$pageTitle = 'News';
require_once 'database.php';
require_once 'header.php';

$db = new Database();
$news = $db->getNews();
?>

<!-- FLOATING NAVIGATION -->
<div class="floating-nav">
    <a href="index.php">Home</a>
    <a href="king.php">His Majesty</a>
    <a href="history.php">History</a>
    <a href="heritage.php">Heritage</a>
    <a href="news.php" class="active">News</a>
    <a href="events.php">Events</a>
    <a href="admin.php" class="admin-link" target="_blank"><i class="fas fa-cog"></i> Admin</a>
</div>

<main class="container">
    <!-- Page Header -->
    <div class="page-header">
        <h1>Latest News & Updates</h1>
        <p>Stay informed about the Isaaq Kingdom and Tolje'lo heritage</p>
    </div>

    <!-- News Grid -->
    <section>
        <div class="news-grid-dynamic">
            <?php foreach ($news as $item): ?>
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
    </section>

    <!-- News Modal -->
    <div id="newsModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.8); z-index: 1000; justify-content: center; align-items: center;">
        <div style="background: white; border-radius: 60px; max-width: 600px; width: 90%; max-height: 80vh; overflow-y: auto; padding: 2rem; position: relative;">
            <button onclick="closeNewsModal()" style="position: absolute; top: 1rem; right: 1rem; background: var(--ruby); color: white; border: none; width: 40px; height: 40px; border-radius: 50%; cursor: pointer; font-size: 1.2rem;">×</button>
            <div id="modalContent"></div>
        </div>
    </div>

    <div style="text-align: center; margin: 3rem 0;">
        <a href="index.php" class="back-button"><i class="fas fa-arrow-left"></i> Back to Home</a>
    </div>
</main>

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

// Close modal when clicking outside
window.onclick = function(event) {
    const modal = document.getElementById('newsModal');
    if (event.target === modal) {
        modal.style.display = 'none';
    }
}
</script>

<?php require_once 'footer.php'; ?>