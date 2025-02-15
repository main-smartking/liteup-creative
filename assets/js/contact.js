document.addEventListener('DOMContentLoaded', function() {
    const contactForm = document.getElementById('contactForm');
    const responseMessage = document.querySelector('.response-message');
    const modalHeader = document.querySelector('.modal-header');

    if (contactForm) {
        contactForm.addEventListener('submit', async function(e) {
            e.preventDefault();
            
            try {
                const formData = new FormData(this);
                const submitBtn = this.querySelector('.submit-btn');
                submitBtn.disabled = true;
                
                // Use the correct path to process_contact.php
                const response = await fetch('includes/process_contact.php', {
                    method: 'POST',
                    body: formData
                });

                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }

                const data = await response.json();
                
                if (data.success) {
                    contactForm.style.display = 'none';
                    modalHeader.style.display = 'none';
                    responseMessage.style.display = 'block';
                } else {
                    throw new Error(data.message || 'Failed to send message');
                }
            } catch (error) {
                console.error('Error:', error);
                alert('An error occurred. Please try again.');
            } finally {
                submitBtn.disabled = false;
            }
        });
    }
});