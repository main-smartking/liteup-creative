<?php require_once __DIR__ . '/path_helper.php'; ?>

<footer class="footer">
    <ul>
        <li>&copy; 2024 LiteUp Creative Concept. All rights reserved.</li>
        <li><a href="../docs/terms-of-service.pdf" download="terms-of-service" >Terms & Conditions</a></li>
        <li><a href="../docs/privacy-policy.pdf" download="privacy-policy">Privacy Policy</a></li>
        <li><a href="">Compliances</a></li>
    </ul>

    <!-- Contact Modal -->
    <div class="contact-modal" id="contactModal">
        <div class="modal-content">
            <button class="close-modal" id="closeModal">
                <i class='bx bx-x'></i>
            </button>
            <div class="modal-header" id="modalHeader">
                <h2>We've been Waiting For You!</h2>
                <p>We'd love to hear from you!</p>
            </div>
            <div class="response-message" style="display: none;">
                <div class="success-icon"></div>
                <h3>Thank You!</h3>
                <p>Your message has been sent successfully.</p>
                <p>We'll get back to you soon!</p>
            </div>
            <form class="contact-form" id="contactForm">
                <div class="form-group">
                    <input type="text" name="name" required placeholder="Your Name">
                </div>
                <div class="form-group">
                    <input type="email" name="email" required placeholder="Your Email">
                </div>
                <div class="form-group">
                    <input type="text" name="subject" required placeholder="Subject">
                </div>
                <div class="form-group">
                    <textarea name="message" required placeholder="Your Message" rows="5"></textarea>
                </div>
                <button type="submit" class="submit-btn">Send Message</button>
            </form>
        </div>
    </div>
</footer>

<!-- Scripts -->
<script src="<?php echo getAssetPath('./assets/js/main.js'); ?>"></script>
<!-- Add before closing body tag -->
<script src="<?php echo getAssetPath('assets/js/modal.js'); ?>"></script>
