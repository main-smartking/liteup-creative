document.addEventListener('DOMContentLoaded', () => {
    const modal = document.getElementById('contactModal');
    const closeBtn = document.getElementById('closeModal');
    const contactBtns = document.querySelectorAll('.contact-trigger');
    const form = document.getElementById('contactForm');
    const modalHeader = document.getElementById('modalHeader');
    const responseMessage = modal.querySelector('.response-message');

    // For direct success message (non-blog pages)
    const showDirectSuccess = (e) => {
        e.preventDefault();
        modal.classList.add('active');
        document.body.style.overflow = 'hidden';
        form.style.display = 'none';
        modalHeader.style.display = 'none';
        responseMessage.style.display = 'block';
    };

    // For blog post contact form
    const showContactForm = (e) => {
        e.preventDefault();
        modal.classList.add('active');
        document.body.style.overflow = 'hidden';
        form.style.display = 'block';
        modalHeader.style.display = 'block';
        responseMessage.style.display = 'none';
    };

    // Assign different behaviors based on page
    contactBtns.forEach(btn => {
        if (window.location.pathname.includes('/blog/')) {
            btn.addEventListener('click', showContactForm);
        } else {
            btn.addEventListener('click', showDirectSuccess);
        }
    });

    // Close modal handlers
    const closeModal = () => {
        modal.classList.remove('active');
        document.body.style.overflow = '';
    };

    closeBtn.addEventListener('click', closeModal);
    modal.addEventListener('click', (e) => {
        if (e.target === modal) closeModal();
    });

    // Form submission handler for blog pages
    if (form) {
        form.addEventListener('submit', async (e) => {
            e.preventDefault();
            const formData = new FormData(form);

            try {
                const response = await fetch('includes/process_contact.php', {
                    method: 'POST',
                    body: formData
                });

                const data = await response.json();
                
                if (data.success) {
                    form.style.display = 'none';
                    modalHeader.style.display = 'none';
                    responseMessage.style.display = 'block';
                } else {
                    alert(data.message || 'Failed to send message');
                }
            } catch (error) {
                console.error('Error:', error);
                alert('An error occurred. Please try again.');
            }
        });
    }
});