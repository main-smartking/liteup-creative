document.addEventListener('DOMContentLoaded', () => {
    const modal = document.getElementById('contactModal');
    const closeBtn = document.getElementById('closeModal');
    const contactBtns = document.querySelectorAll('.contact-trigger');
    const form = document.getElementById('contactForm');

    if (!modal || !closeBtn || !contactBtns.length || !form) {
        console.error('Modal elements not found');
        return;
    }

    // Open modal
    contactBtns.forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            modal.classList.add('active');
            document.body.style.overflow = 'hidden';
        });
    });

    // Close modal
    closeBtn.addEventListener('click', () => {
        modal.classList.remove('active');
        document.body.style.overflow = '';
    });

    // Close on outside click
    modal.addEventListener('click', (e) => {
        if (e.target === modal) {
            modal.classList.remove('active');
            document.body.style.overflow = '';
        }
    });

    // Debug form fields
    console.log('Form fields:', form?.elements);

    // Form submission
    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        const formData = new FormData(form);
        
        // Log form data
        console.log('Form Data:');
        for (let [key, value] of formData.entries()) {
            console.log(`${key}: ${value}`);
        }

        // Validate required fields
        const name = formData.get('name').trim();
        const email = formData.get('email').trim();
        const subject = formData.get('subject').trim();
        const message = formData.get('message').trim();

        if (!name || !email || !subject || !message) {
            showMessage('error', 'Please fill in all required fields');
            return;
        }
        
        try {
            // Update path to process_contact.php
            const response = await fetch('/liteup-creative/includes/process_contact.php', {
                method: 'POST',
                body: formData
            });
            
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            
            const data = await response.json();
            console.log('Server response:', data); // Debug log
            
            if (data.status === 'success') {
                showMessage('success', 'Thank you! Your message has been sent successfully.');
                form.reset();
                setTimeout(() => {
                    document.getElementById('contactModal').classList.remove('active');
                }, 2000);
            } else {
                showMessage('error', data.message || 'Failed to send message');
            }
        } catch (error) {
            console.error('Submission error:', error);
            showMessage('error', 'Failed to send message. Please try again.');
        }
    });

    function showMessage(type, message) {
        const messageDiv = document.createElement('div');
        messageDiv.className = `form-message ${type}`;
        messageDiv.textContent = message;
        
        // Remove existing messages
        const existingMessages = form.querySelectorAll('.form-message');
        existingMessages.forEach(msg => msg.remove());
        
        form.insertBefore(messageDiv, form.firstChild);
        
        setTimeout(() => {
            messageDiv.remove();
        }, 5000);
    }
});