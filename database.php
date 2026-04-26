<?php
// database.php - Database operations class with getById methods
require_once 'config.php';

class Database {
    private $conn;
    
    public function __construct() {
        global $conn;
        $this->conn = $conn;
    }
    
    // Get all slides
    public function getSlides() {
        $sql = "SELECT * FROM slides WHERE is_active = 1 ORDER BY slide_order ASC";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    
    // Get single slide by ID
    public function getSlideById($id) {
        $sql = "SELECT * FROM slides WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
    
    // Get all news
    public function getNews() {
        $sql = "SELECT * FROM news WHERE is_active = 1 ORDER BY created_at DESC";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    
    // Get single news by ID
    public function getNewsById($id) {
        $sql = "SELECT * FROM news WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
    
    // Get all events
    public function getEvents() {
        $sql = "SELECT * FROM events WHERE is_active = 1 ORDER BY event_year DESC";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    
    // Get single event by ID
    public function getEventById($id) {
        $sql = "SELECT * FROM events WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
    
    // Get lineage banner
    public function getLineageBanner() {
        $sql = "SELECT banner_text FROM lineage_banner WHERE is_active = 1 ORDER BY id DESC LIMIT 1";
        $result = $this->conn->query($sql);
        $row = $result->fetch_assoc();
        return $row ? $row['banner_text'] : 'Default lineage text';
    }
    
    // ADMIN FUNCTIONS
    
    // Add slide
    public function addSlide($headline, $tagline, $description, $image_path) {
        $sql = "INSERT INTO slides (headline, tagline, description, image_path) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssss", $headline, $tagline, $description, $image_path);
        return $stmt->execute();
    }
    
    // Update slide
    public function updateSlide($id, $headline, $tagline, $description, $image_path) {
        $sql = "UPDATE slides SET headline=?, tagline=?, description=?, image_path=? WHERE id=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssssi", $headline, $tagline, $description, $image_path, $id);
        return $stmt->execute();
    }
    
    // Delete slide
    public function deleteSlide($id) {
        // Soft delete - just mark as inactive
        $sql = "UPDATE slides SET is_active = 0 WHERE id=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
    
    // Add news
    public function addNews($title, $category, $description, $image_path) {
        $sql = "INSERT INTO news (title, category, description, image_path) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssss", $title, $category, $description, $image_path);
        return $stmt->execute();
    }
    
    // Update news
    public function updateNews($id, $title, $category, $description, $image_path) {
        $sql = "UPDATE news SET title=?, category=?, description=?, image_path=? WHERE id=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssssi", $title, $category, $description, $image_path, $id);
        return $stmt->execute();
    }
    
    // Delete news
    public function deleteNews($id) {
        // Soft delete
        $sql = "UPDATE news SET is_active = 0 WHERE id=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
    
    // Add event
    public function addEvent($name, $year, $description, $extra) {
        $sql = "INSERT INTO events (event_name, event_year, description, extra_info) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssss", $name, $year, $description, $extra);
        return $stmt->execute();
    }
    
    // Update event
    public function updateEvent($id, $name, $year, $description, $extra) {
        $sql = "UPDATE events SET event_name=?, event_year=?, description=?, extra_info=? WHERE id=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssssi", $name, $year, $description, $extra, $id);
        return $stmt->execute();
    }
    
    // Delete event
    public function deleteEvent($id) {
        // Soft delete
        $sql = "UPDATE events SET is_active = 0 WHERE id=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
    
    // Update lineage banner
    public function updateLineageBanner($text) {
        $sql = "UPDATE lineage_banner SET banner_text=? WHERE is_active=1";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $text);
        return $stmt->execute();
    }
}
?>