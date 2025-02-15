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
                
                // Get base URL from meta tag or default to /liteup-creative/
                const baseUrl = document.querySelector('base')?.href || '/liteup-creative/';
                const response = await fetch(`${baseUrl}includes/process_contact.php`, {
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
                    contactForm.reset();
                } else {
                    throw new Error(data.message || 'Failed to send message');
                }
            } catch (error) {
                console.error('Error:', error);
                // Show error in a more user-friendly way
                const errorMessage = error.message || 'An error occurred. Please try again.';
                alert(errorMessage);
            } finally {
                submitBtn.disabled = false;
            }
        });
    }
});