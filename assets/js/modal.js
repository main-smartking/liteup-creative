document.addEventListener('DOMContentLoaded', () => {
    const modal = document.getElementById('contactModal');
    const closeBtn = document.getElementById('closeModal');
    const contactBtns = document.querySelectorAll('.contact-trigger');
    const form = document.getElementById('contactForm');
    const modalHeader = document.getElementById('modalHeader');
    const responseMessage = modal.querySelector('.response-message');

    // Show contact form for all cases
    const showContactForm = (e) => {
        e.preventDefault();
        modal.classList.add('active');
        document.body.style.overflow = 'hidden';
        form.style.display = 'block';
        modalHeader.style.display = 'block';
        responseMessage.style.display = 'none';
    };

    // Add click event to all contact trigger buttons
    contactBtns.forEach(btn => {
        btn.addEventListener('click', showContactForm);
    });

    // Close modal handlers
    const closeModal = () => {
        modal.classList.remove('active');
        document.body.style.overflow = '';
        // Reset form
        if (form) {
            form.reset();
            form.style.display = 'block';
            modalHeader.style.display = 'block';
            responseMessage.style.display = 'none';
        }
    };

    closeBtn.addEventListener('click', closeModal);
    modal.addEventListener('click', (e) => {
        if (e.target === modal) closeModal();
    });

   
});