<?php
// events.php - Events page
$pageTitle = 'Events';
require_once 'database.php';
require_once 'header.php';

$db = new Database();
$events = $db->getEvents();
?>

<!-- FLOATING NAVIGATION -->
<div class="floating-nav">
    <a href="index.php">Home</a>
    <a href="king.php">His Majesty</a>
    <a href="history.php">History</a>
    <a href="heritage.php">Heritage</a>
    <a href="news.php">News</a>
    <a href="events.php" class="active">Events</a>
    <a href="admin.php" class="admin-link" target="_blank"><i class="fas fa-cog"></i> Admin</a>
</div>

<main class="container">
    <!-- Page Header -->
    <div class="page-header">
        <h1>Royal Events & Ceremonies</h1>
        <p>Commemorations, festivals, and gatherings honoring Isaaq heritage</p>
    </div>

    <!-- Events Timeline -->
    <section>
        <h2 class="section-title"><i class="fas fa-clock title-icon"></i> Upcoming & Recent Events</h2>
        <div class="event-timeline">
            <?php foreach ($events as $event): ?>
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
    </section>

    <!-- Event Modal -->
    <div id="eventModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.8); z-index: 1000; justify-content: center; align-items: center;">
        <div style="background: white; border-radius: 60px; max-width: 500px; width: 90%; padding: 2rem; position: relative;">
            <button onclick="closeEventModal()" style="position: absolute; top: 1rem; right: 1rem; background: var(--ruby); color: white; border: none; width: 40px; height: 40px; border-radius: 50%; cursor: pointer; font-size: 1.2rem;">×</button>
            <div id="eventModalContent"></div>
        </div>
    </div>

    <!-- Calendar Section -->
    <section style="margin: 4rem 0;">
        <h2 class="section-title"><i class="fas fa-calendar-alt title-icon"></i> Event Calendar</h2>
        <div style="background: white; border-radius: 60px; padding: 2rem; text-align: center;">
            <div style="display: grid; grid-template-columns: repeat(7, 1fr); gap: 0.5rem; margin-bottom: 1rem;">
                <?php 
                $days = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
                foreach ($days as $day) {
                    echo "<div style='font-weight: 800; color: var(--sapphire);'>$day</div>";
                }
                
                // Simple calendar grid
                for ($i = 1; $i <= 30; $i++) {
                    $hasEvent = ($i == 15 || $i == 22) ? true : false;
                    $style = $hasEvent ? "background: var(--ruby); color: white; border-radius: 50%; width: 35px; height: 35px; display: flex; align-items: center; justify-content: center; margin: 0 auto; cursor: pointer;" : "width: 35px; height: 35px; display: flex; align-items: center; justify-content: center; margin: 0 auto;";
                    echo "<div style='$style' onclick=\"alert('Event on day $i')\">$i</div>";
                }
                ?>
            </div>
            <p style="margin-top: 1rem; color: var(--sapphire);"><i class="fas fa-circle" style="color: var(--ruby);"></i> Red dots indicate event days</p>
        </div>
    </section>

    <div style="text-align: center; margin: 3rem 0;">
        <a href="index.php" class="back-button"><i class="fas fa-arrow-left"></i> Back to Home</a>
    </div>
</main>

<script>
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

// Close modal when clicking outside
window.onclick = function(event) {
    const modal = document.getElementById('eventModal');
    if (event.target === modal) {
        modal.style.display = 'none';
    }
}
</script>

<?php require_once 'footer.php'; ?>