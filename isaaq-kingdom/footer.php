<!-- FOOTER -->
<footer class="footer-attractive">
    <div class="footer-flex-attractive">
        <div><i class="fas fa-crown"></i> <?php bloginfo( 'name' ); ?></div>
        <div class="social-icons">
            <i class="fab fa-twitter"></i>
            <i class="fab fa-instagram"></i>
            <i class="fab fa-youtube"></i>
            <i class="fas fa-envelope"></i>
        </div>
        <div>&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> &middot; Tolje&#8217;lo Heritage</div>
    </div>
</footer>

<script>
document.querySelectorAll('.floating-nav a').forEach(function(link) {
    link.addEventListener('click', function(e) {
        var href = link.getAttribute('href');
        if (href && href.startsWith('#')) {
            e.preventDefault();
            var target = document.querySelector(href);
            if (target) {
                target.scrollIntoView({ behavior: 'smooth' });
            } else {
                window.scrollTo({ top: 0, behavior: 'smooth' });
            }
        }
    });
});
</script>

<?php wp_footer(); ?>
</body>
</html>
