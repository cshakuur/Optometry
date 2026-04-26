<?php
// footer.php - Common footer for all pages
?>
<!-- FOOTER -->
<footer class="footer-attractive">
    <div class="footer-flex-attractive">
        <div><i class="fas fa-crown"></i> Isaaq Kingdom</div>
        <div class="social-icons">
            <i class="fab fa-twitter"></i>
            <i class="fab fa-instagram"></i>
            <i class="fab fa-youtube"></i>
            <i class="fas fa-envelope"></i>
        </div>
        <div>© 2026 · Tolje'lo Heritage</div>
    </div>
</footer>

<script>
// ========== SMOOTH SCROLL ==========
document.querySelectorAll('.floating-nav a:not([target="_blank"])').forEach(link => {
    link.addEventListener('click', (e) => {
        e.preventDefault();
        const hash = link.getAttribute('href');
        if (hash === '#') {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        } else if (hash) { 
            const target = document.querySelector(hash); 
            if (target) {
                target.scrollIntoView({ behavior: 'smooth' }); 
            }
        }
    });
});
</script>
</body>
</html>