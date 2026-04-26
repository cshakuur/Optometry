<?php
// admin.php - Admin panel with database and full edit functionality
require_once 'database.php';
$db = new Database();

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // SLIDES
    if (isset($_POST['add_slide'])) {
        $db->addSlide(
            $_POST['headline'],
            $_POST['tagline'],
            $_POST['description'],
            $_POST['image_path']
        );
        header('Location: admin.php?msg=Slide added successfully');
        exit;
    }
    
    if (isset($_POST['update_slide'])) {
        $db->updateSlide(
            $_POST['id'],
            $_POST['headline'],
            $_POST['tagline'],
            $_POST['description'],
            $_POST['image_path']
        );
        header('Location: admin.php?msg=Slide updated successfully');
        exit;
    }
    
    // NEWS
    if (isset($_POST['add_news'])) {
        $db->addNews(
            $_POST['title'],
            $_POST['category'],
            $_POST['description'],
            $_POST['image_path']
        );
        header('Location: admin.php?msg=News added successfully');
        exit;
    }
    
    if (isset($_POST['update_news'])) {
        $db->updateNews(
            $_POST['id'],
            $_POST['title'],
            $_POST['category'],
            $_POST['description'],
            $_POST['image_path']
        );
        header('Location: admin.php?msg=News updated successfully');
        exit;
    }
    
    // EVENTS
    if (isset($_POST['add_event'])) {
        $db->addEvent(
            $_POST['event_name'],
            $_POST['event_year'],
            $_POST['description'],
            $_POST['extra'] ?? ''
        );
        header('Location: admin.php?msg=Event added successfully');
        exit;
    }
    
    if (isset($_POST['update_event'])) {
        $db->updateEvent(
            $_POST['id'],
            $_POST['event_name'],
            $_POST['event_year'],
            $_POST['description'],
            $_POST['extra'] ?? ''
        );
        header('Location: admin.php?msg=Event updated successfully');
        exit;
    }
    
    // LINEAGE
    if (isset($_POST['update_lineage'])) {
        $db->updateLineageBanner($_POST['lineage_text']);
        header('Location: admin.php?msg=Lineage updated successfully');
        exit;
    }
}

// Handle deletions
if (isset($_GET['delete'])) {
    $type = $_GET['type'];
    $id = $_GET['id'];
    
    switch($type) {
        case 'slide': $db->deleteSlide($id); break;
        case 'news': $db->deleteNews($id); break;
        case 'event': $db->deleteEvent($id); break;
    }
    header('Location: admin.php?msg=Item deleted successfully');
    exit;
}

// Handle edit - get single item for editing
$editSlide = null;
$editNews = null;
$editEvent = null;

if (isset($_GET['edit'])) {
    $type = $_GET['type'];
    $id = $_GET['id'];
    
    switch($type) {
        case 'slide':
            $editSlide = $db->getSlideById($id);
            break;
        case 'news':
            $editNews = $db->getNewsById($id);
            break;
        case 'event':
            $editEvent = $db->getEventById($id);
            break;
    }
}

// Fetch current data for display
$slides = $db->getSlides();
$news = $db->getNews();
$events = $db->getEvents();
$lineage = $db->getLineageBanner();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <title>Isaaq Kingdom · Admin Panel</title>
    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;800;900&family=Plus+Jakarta+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <style>
        /* ===== GLOBAL RESET ===== */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: #e0d9cb;
            color: #1e2c2a;
            padding: 1rem;
            overflow-x: hidden;
            width: 100%;
        }
        
        :root {
            --sapphire: #0f4c5c;
            --ruby: #c44536;
            --amber: #ed9a4a;
            --gold-leaf: #dba870;
            --success: #28a745;
            --warning: #ffc107;
            --danger: #dc3545;
        }
        
        /* ===== MOBILE FIRST ===== */
        html {
            font-size: 14px;
        }
        
        .admin-wrapper {
            max-width: 1300px;
            margin: 0 auto;
            width: 100%;
        }
        
        /* ===== SUCCESS MESSAGE ===== */
        .success-message {
            background: var(--success);
            color: white;
            padding: 1rem;
            border-radius: 40px;
            margin-bottom: 1.5rem;
            text-align: center;
            font-weight: 600;
            animation: slideDown 0.5s ease;
        }
        
        @keyframes slideDown {
            from {
                transform: translateY(-20px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }
        
        /* ===== HEADER ===== */
        .admin-header {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 1rem;
            background: white;
            padding: 1.5rem 1rem;
            border-radius: 40px;
            margin-bottom: 1.5rem;
            border: 3px solid var(--amber);
            box-shadow: 0 15px 25px -10px #0f4c5c;
            text-align: center;
        }
        
        @media (min-width: 480px) {
            .admin-header {
                flex-direction: row;
                justify-content: space-between;
                padding: 1.5rem 2rem;
                border-radius: 60px;
                text-align: left;
            }
        }
        
        @media (min-width: 768px) {
            .admin-header {
                border-radius: 100px;
                padding: 1.5rem 2.5rem;
            }
        }
        
        .admin-header h1 {
            font-family: 'Playfair Display', serif;
            font-size: 1.8rem;
            color: var(--sapphire);
        }
        
        @media (min-width: 480px) {
            .admin-header h1 {
                font-size: 2.2rem;
            }
        }
        
        @media (min-width: 768px) {
            .admin-header h1 {
                font-size: 2.8rem;
            }
        }
        
        .database-badge {
            background: var(--ruby);
            color: white;
            border-radius: 40px;
            padding: 0.5rem 1.2rem;
            font-weight: 700;
            font-size: 1rem;
            white-space: nowrap;
        }
        
        @media (min-width: 768px) {
            .database-badge {
                padding: 0.7rem 2rem;
                font-size: 1.2rem;
            }
        }
        
        /* ===== ADMIN GRID ===== */
        .admin-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1.5rem;
            margin-bottom: 2rem;
        }
        
        @media (min-width: 640px) {
            .admin-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        
        @media (min-width: 1024px) {
            .admin-grid {
                grid-template-columns: repeat(3, 1fr);
                gap: 2rem;
            }
        }
        
        .admin-card {
            background: white;
            border-radius: 40px 15px 40px 15px;
            padding: 1.5rem;
            border: 2px solid var(--gold-leaf);
            box-shadow: 0 12px 20px -8px #1a4b4b;
            width: 100%;
            transition: transform 0.2s;
        }
        
        .admin-card:hover {
            transform: translateY(-5px);
        }
        
        @media (min-width: 768px) {
            .admin-card {
                border-radius: 70px 20px 70px 20px;
                padding: 2rem 1.8rem;
                border-width: 3px;
            }
        }
        
        .card-title {
            font-size: 1.6rem;
            font-weight: 800;
            color: var(--sapphire);
            border-bottom: 3px solid var(--amber);
            display: inline-block;
            margin-bottom: 1.2rem;
        }
        
        @media (min-width: 768px) {
            .card-title {
                font-size: 2rem;
                border-bottom-width: 4px;
                margin-bottom: 1.5rem;
            }
        }
        
        .card-title i {
            color: var(--ruby);
            margin-right: 8px;
        }
        
        /* ===== EDIT MODE INDICATOR ===== */
        .edit-mode {
            background: var(--warning);
            color: #1e2c2a;
            padding: 0.5rem 1rem;
            border-radius: 40px;
            margin-bottom: 1rem;
            text-align: center;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }
        
        .edit-mode i {
            color: var(--sapphire);
        }
        
        .cancel-edit {
            background: var(--danger);
            color: white;
            padding: 0.3rem 1rem;
            border-radius: 40px;
            text-decoration: none;
            font-size: 0.9rem;
            margin-left: 0.5rem;
        }
        
        .cancel-edit:hover {
            background: #c82333;
        }
        
        /* ===== FORMS ===== */
        .form-group {
            margin-bottom: 1rem;
        }
        
        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e0cfb6;
            border-radius: 30px;
            font-size: 1rem;
            background: #fefcf6;
            font-family: 'Plus Jakarta Sans', sans-serif;
            transition: border-color 0.2s;
        }
        
        .form-group textarea {
            border-radius: 20px;
            min-height: 70px;
            resize: vertical;
        }
        
        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: var(--ruby);
        }
        
        /* Larger touch targets on mobile */
        @media (max-width: 768px) {
            .form-group input,
            .form-group textarea,
            .btn-admin,
            .btn-lineage {
                padding: 14px 18px;
            }
        }
        
        .btn-admin {
            background: var(--sapphire);
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 40px;
            font-weight: 700;
            font-size: 1rem;
            cursor: pointer;
            width: 100%;
            transition: all 0.15s;
            margin-bottom: 1rem;
        }
        
        .btn-admin:hover {
            background: var(--ruby);
            transform: scale(1.02);
        }
        
        .btn-admin:active {
            transform: scale(0.98);
        }
        
        .btn-update {
            background: var(--warning);
            color: #1e2c2a;
        }
        
        .btn-update:hover {
            background: #e0a800;
        }
        
        /* ===== LISTS ===== */
        .list-container {
            background: #f7efe2;
            border-radius: 30px;
            padding: 1rem;
            max-height: 300px;
            overflow-y: auto;
        }
        
        .list-item {
            background: white;
            border-radius: 30px;
            padding: 0.8rem 1rem;
            margin-bottom: 0.6rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-left: 6px solid var(--amber);
            word-break: break-word;
            gap: 0.5rem;
            transition: all 0.2s;
        }
        
        .list-item:hover {
            transform: translateX(5px);
            border-left-color: var(--ruby);
        }
        
        .list-item span:first-child {
            font-size: 0.9rem;
            flex: 1;
        }
        
        .item-actions {
            display: flex;
            gap: 0.5rem;
            flex-shrink: 0;
        }
        
        .item-actions a {
            text-decoration: none;
            color: inherit;
        }
        
        .item-actions i {
            font-size: 1.1rem;
            cursor: pointer;
            padding: 5px;
            transition: transform 0.2s;
        }
        
        .item-actions i.fa-edit {
            color: var(--warning);
        }
        
        .item-actions i.fa-trash {
            color: var(--danger);
        }
        
        .item-actions i:hover {
            transform: scale(1.2);
        }
        
        /* ===== LINEAGE SECTION ===== */
        .lineage-section {
            background: white;
            border-radius: 40px;
            padding: 1.5rem;
            border: 2px solid var(--sapphire);
            margin: 1.5rem 0;
        }
        
        @media (min-width: 640px) {
            .lineage-section {
                border-radius: 60px;
                padding: 1.5rem 2rem;
            }
        }
        
        .lineage-section form {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            width: 100%;
        }
        
        @media (min-width: 640px) {
            .lineage-section form {
                flex-direction: row;
                align-items: center;
            }
        }
        
        .lineage-section i {
            font-size: 2rem;
            color: var(--ruby);
            text-align: center;
            margin-bottom: 1rem;
        }
        
        @media (min-width: 640px) {
            .lineage-section i {
                font-size: 2.5rem;
                margin-bottom: 0;
                margin-right: 1rem;
            }
        }
        
        .lineage-section input {
            flex: 2;
            width: 100%;
            padding: 12px 18px;
            border-radius: 40px;
            border: 2px solid var(--gold-leaf);
            font-size: 1rem;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
        
        .lineage-section input:focus {
            outline: none;
            border-color: var(--ruby);
        }
        
        .btn-lineage {
            background: var(--amber);
            color: #1e2c2a;
            border: none;
            padding: 12px 20px;
            border-radius: 40px;
            font-weight: 700;
            cursor: pointer;
            width: 100%;
            white-space: nowrap;
            transition: all 0.15s;
        }
        
        @media (min-width: 640px) {
            .btn-lineage {
                width: auto;
                padding: 12px 25px;
            }
        }
        
        .btn-lineage:hover {
            background: #e09c4a;
            transform: scale(1.02);
        }
        
        /* ===== VIEW LINK ===== */
        .view-link {
            display: inline-block;
            background: var(--sapphire);
            color: white;
            padding: 0.8rem 1.8rem;
            border-radius: 40px;
            font-weight: 700;
            text-decoration: none;
            margin-top: 1rem;
            width: 100%;
            text-align: center;
            transition: all 0.15s;
        }
        
        @media (min-width: 480px) {
            .view-link {
                width: auto;
                padding: 0.8rem 2.5rem;
            }
        }
        
        .view-link:hover {
            background: var(--ruby);
            transform: scale(1.05);
        }
        
        /* ===== STATS SECTION ===== */
        .stats-section {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1rem;
            margin: 2rem 0;
        }
        
        .stat-card {
            background: white;
            border-radius: 30px;
            padding: 1rem;
            text-align: center;
            border: 2px solid var(--gold-leaf);
        }
        
        .stat-number {
            font-size: 2rem;
            font-weight: 800;
            color: var(--ruby);
        }
        
        .stat-label {
            font-size: 0.9rem;
            color: var(--sapphire);
            font-weight: 600;
        }
        
        /* ===== UTILITY ===== */
        .text-center {
            text-align: center;
        }
        
        hr {
            margin: 2rem 0;
            border: 2px solid var(--gold-leaf);
            border-radius: 10px;
        }
    </style>
</head>
<body>
<div class="admin-wrapper">
    <!-- HEADER -->
    <div class="admin-header">
        <h1><i class="fas fa-database" style="color:var(--ruby);"></i> Isaaq Kingdom · Admin</h1>
        <span class="database-badge"><i class="fas fa-check"></i> MySQL Connected</span>
    </div>

    <!-- SUCCESS MESSAGE -->
    <?php if (isset($_GET['msg'])): ?>
    <div class="success-message">
        <i class="fas fa-check-circle"></i> <?php echo htmlspecialchars($_GET['msg']); ?>
    </div>
    <?php endif; ?>

    <!-- STATS SECTION -->
    <div class="stats-section">
        <div class="stat-card">
            <div class="stat-number"><?php echo count($slides); ?></div>
            <div class="stat-label">Total Slides</div>
        </div>
        <div class="stat-card">
            <div class="stat-number"><?php echo count($news); ?></div>
            <div class="stat-label">Total News</div>
        </div>
        <div class="stat-card">
            <div class="stat-number"><?php echo count($events); ?></div>
            <div class="stat-label">Total Events</div>
        </div>
    </div>

    <!-- ADMIN GRID -->
    <div class="admin-grid">
        <!-- SLIDES MANAGEMENT -->
        <div class="admin-card">
            <div class="card-title"><i class="fas fa-images"></i> Slides</div>
            
            <?php if ($editSlide): ?>
            <!-- Edit Slide Form -->
            <div class="edit-mode">
                <i class="fas fa-edit"></i> Editing Slide: <?php echo htmlspecialchars($editSlide['headline']); ?>
                <a href="admin.php" class="cancel-edit"><i class="fas fa-times"></i> Cancel</a>
            </div>
            <form method="POST">
                <input type="hidden" name="update_slide" value="1">
                <input type="hidden" name="id" value="<?php echo $editSlide['id']; ?>">
                <div class="form-group">
                    <input type="text" name="headline" placeholder="Headline" value="<?php echo htmlspecialchars($editSlide['headline']); ?>" required>
                </div>
                <div class="form-group">
                    <input type="text" name="tagline" placeholder="Tagline" value="<?php echo htmlspecialchars($editSlide['tagline']); ?>" required>
                </div>
                <div class="form-group">
                    <input type="text" name="description" placeholder="Description" value="<?php echo htmlspecialchars($editSlide['description']); ?>" required>
                </div>
                <div class="form-group">
                    <input type="text" name="image_path" placeholder="Image path (e.g., images/slide.jpg)" value="<?php echo htmlspecialchars($editSlide['image_path']); ?>" required>
                </div>
                <button type="submit" class="btn-admin btn-update"><i class="fas fa-save"></i> Update Slide</button>
            </form>
            <?php else: ?>
            <!-- Add Slide Form -->
            <form method="POST">
                <input type="hidden" name="add_slide" value="1">
                <div class="form-group">
                    <input type="text" name="headline" placeholder="Headline" required>
                </div>
                <div class="form-group">
                    <input type="text" name="tagline" placeholder="Tagline" required>
                </div>
                <div class="form-group">
                    <input type="text" name="description" placeholder="Description" required>
                </div>
                <div class="form-group">
                    <input type="text" name="image_path" placeholder="Image path (e.g., images/slide.jpg)" required>
                </div>
                <button type="submit" class="btn-admin"><i class="fas fa-plus"></i> Add Slide</button>
            </form>
            <?php endif; ?>
            
            <!-- Slides List -->
            <div class="list-container">
                <?php foreach ($slides as $slide): ?>
                <div class="list-item">
                    <span><i class="fas fa-image"></i> <?php echo htmlspecialchars($slide['headline']); ?></span>
                    <span class="item-actions">
                        <a href="?edit&type=slide&id=<?php echo $slide['id']; ?>" title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="?delete&type=slide&id=<?php echo $slide['id']; ?>" onclick="return confirm('Are you sure you want to delete this slide?')" title="Delete">
                            <i class="fas fa-trash"></i>
                        </a>
                    </span>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- NEWS MANAGEMENT -->
        <div class="admin-card">
            <div class="card-title"><i class="fas fa-newspaper"></i> News</div>
            
            <?php if ($editNews): ?>
            <!-- Edit News Form -->
            <div class="edit-mode">
                <i class="fas fa-edit"></i> Editing: <?php echo htmlspecialchars($editNews['title']); ?>
                <a href="admin.php" class="cancel-edit"><i class="fas fa-times"></i> Cancel</a>
            </div>
            <form method="POST">
                <input type="hidden" name="update_news" value="1">
                <input type="hidden" name="id" value="<?php echo $editNews['id']; ?>">
                <div class="form-group">
                    <input type="text" name="title" placeholder="Title" value="<?php echo htmlspecialchars($editNews['title']); ?>" required>
                </div>
                <div class="form-group">
                    <input type="text" name="category" placeholder="Category" value="<?php echo htmlspecialchars($editNews['category']); ?>" required>
                </div>
                <div class="form-group">
                    <textarea name="description" placeholder="Description" required><?php echo htmlspecialchars($editNews['description']); ?></textarea>
                </div>
                <div class="form-group">
                    <input type="text" name="image_path" placeholder="Image path" value="<?php echo htmlspecialchars($editNews['image_path']); ?>" required>
                </div>
                <button type="submit" class="btn-admin btn-update"><i class="fas fa-save"></i> Update News</button>
            </form>
            <?php else: ?>
            <!-- Add News Form -->
            <form method="POST">
                <input type="hidden" name="add_news" value="1">
                <div class="form-group">
                    <input type="text" name="title" placeholder="Title" required>
                </div>
                <div class="form-group">
                    <input type="text" name="category" placeholder="Category" required>
                </div>
                <div class="form-group">
                    <textarea name="description" placeholder="Description" required></textarea>
                </div>
                <div class="form-group">
                    <input type="text" name="image_path" placeholder="Image path" required>
                </div>
                <button type="submit" class="btn-admin"><i class="fas fa-plus"></i> Add News</button>
            </form>
            <?php endif; ?>
            
            <!-- News List -->
            <div class="list-container">
                <?php foreach ($news as $item): ?>
                <div class="list-item">
                    <span><i class="fas fa-newspaper"></i> <?php echo htmlspecialchars($item['title']); ?></span>
                    <span class="item-actions">
                        <a href="?edit&type=news&id=<?php echo $item['id']; ?>" title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="?delete&type=news&id=<?php echo $item['id']; ?>" onclick="return confirm('Are you sure you want to delete this news item?')" title="Delete">
                            <i class="fas fa-trash"></i>
                        </a>
                    </span>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- EVENTS MANAGEMENT -->
        <div class="admin-card">
            <div class="card-title"><i class="fas fa-calendar-alt"></i> Events</div>
            
            <?php if ($editEvent): ?>
            <!-- Edit Event Form -->
            <div class="edit-mode">
                <i class="fas fa-edit"></i> Editing: <?php echo htmlspecialchars($editEvent['event_name']); ?>
                <a href="admin.php" class="cancel-edit"><i class="fas fa-times"></i> Cancel</a>
            </div>
            <form method="POST">
                <input type="hidden" name="update_event" value="1">
                <input type="hidden" name="id" value="<?php echo $editEvent['id']; ?>">
                <div class="form-group">
                    <input type="text" name="event_name" placeholder="Event name" value="<?php echo htmlspecialchars($editEvent['event_name']); ?>" required>
                </div>
                <div class="form-group">
                    <input type="text" name="event_year" placeholder="Year" value="<?php echo htmlspecialchars($editEvent['event_year']); ?>" required>
                </div>
                <div class="form-group">
                    <input type="text" name="description" placeholder="Description" value="<?php echo htmlspecialchars($editEvent['description']); ?>" required>
                </div>
                <div class="form-group">
                    <input type="text" name="extra" placeholder="Extra info (optional)" value="<?php echo htmlspecialchars($editEvent['extra_info'] ?? ''); ?>">
                </div>
                <button type="submit" class="btn-admin btn-update"><i class="fas fa-save"></i> Update Event</button>
            </form>
            <?php else: ?>
            <!-- Add Event Form -->
            <form method="POST">
                <input type="hidden" name="add_event" value="1">
                <div class="form-group">
                    <input type="text" name="event_name" placeholder="Event name" required>
                </div>
                <div class="form-group">
                    <input type="text" name="event_year" placeholder="Year" required>
                </div>
                <div class="form-group">
                    <input type="text" name="description" placeholder="Description" required>
                </div>
                <div class="form-group">
                    <input type="text" name="extra" placeholder="Extra info (optional)">
                </div>
                <button type="submit" class="btn-admin"><i class="fas fa-plus"></i> Add Event</button>
            </form>
            <?php endif; ?>
            
            <!-- Events List -->
            <div class="list-container">
                <?php foreach ($events as $event): ?>
                <div class="list-item">
                    <span><i class="fas fa-calendar"></i> <?php echo htmlspecialchars($event['event_name']); ?> (<?php echo htmlspecialchars($event['event_year']); ?>)</span>
                    <span class="item-actions">
                        <a href="?edit&type=event&id=<?php echo $event['id']; ?>" title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="?delete&type=event&id=<?php echo $event['id']; ?>" onclick="return confirm('Are you sure you want to delete this event?')" title="Delete">
                            <i class="fas fa-trash"></i>
                        </a>
                    </span>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <!-- LINEAGE BANNER -->
    <div class="lineage-section">
        <i class="fas fa-pen-fancy"></i>
        <form method="POST">
            <input type="hidden" name="update_lineage" value="1">
            <input type="text" name="lineage_text" value="<?php echo htmlspecialchars($lineage); ?>" required>
            <button type="submit" class="btn-lineage"><i class="fas fa-save"></i> Update Banner</button>
        </form>
    </div>

    <!-- QUICK ACTIONS -->
    <hr>
    <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
        <a href="admin.php" class="view-link" style="background: var(--amber); color: #1e2c2a;"><i class="fas fa-sync"></i> Refresh Page</a>
        <a href="index.php" class="view-link" target="_blank"><i class="fas fa-eye"></i> View Public Site</a>
    </div>
</div>
</body>
</html>