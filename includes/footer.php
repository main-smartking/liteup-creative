<?php require_once __DIR__ . '/path_helper.php'; ?>

<footer class="footer">
    <ul>
        <li>&copy; 2024 LiteUp Creative Concept. All rights reserved.</li>
        <li><a href="">Terms & Conditions</a></li>
        <li><a href="">Privacy Policy</a></li>
        <li><a href="">Compliances</a></li>
    </ul>
</footer>

<!-- Scripts -->
<script src="<?php echo getAssetPath('assets/js/main.js'); ?>"></script>
<script src="<?php echo getAssetPath('assets/js/particles.js'); ?>"></script>
<script src="assets/js/particles.min.js"></script>
<script>
    particlesJS.load('particles-js', 'assets/js/particles.json', function() {
        console.log('particles.js loaded');
    });
</script>