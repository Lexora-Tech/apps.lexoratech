document.addEventListener('DOMContentLoaded', () => {

    const form = document.getElementById('feedbackForm');
    const submitBtn = document.querySelector('.btn-submit');
    const btnText = document.querySelector('.btn-text');
    const modal = document.getElementById('successModal');
    const closeModal = document.getElementById('closeModal');

    if (form) {
        form.addEventListener('submit', async (e) => {
            e.preventDefault();

            // 1. Visual Loading State
            const originalText = btnText.innerText;
            btnText.innerText = "Sending...";
            submitBtn.style.opacity = "0.7";
            submitBtn.disabled = true;

            // 2. Gather Data from Form
            const formData = {
                type: document.querySelector('input[name="type"]:checked').value,
                subject: document.getElementById('subject').value,
                description: document.getElementById('description').value,
                priority: document.getElementById('priorityRange') ? document.getElementById('priorityRange').value : 1
            };

            try {
                // 3. Send Data to PHP Backend
                // We use the relative path from suggestion.php to the admin folder
                const response = await fetch('admin/submit_suggestion.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(formData)
                });

                // 4. READ RESPONSE AS TEXT FIRST (Crucial for debugging)
                // This catches HTML errors (like 404 or PHP warnings) before they break JSON parsing
                const textResult = await response.text();

                try {
                    const jsonResult = JSON.parse(textResult); // Try to parse JSON

                    if (response.ok) {
                        // SUCCESS: Reset Form & Show Modal
                        form.reset();

                        modal.classList.remove('hidden');
                        requestAnimationFrame(() => {
                            modal.classList.add('visible');
                        });
                    } else {
                        // SERVER ERROR (Database failed, etc.)
                        alert("Error: " + (jsonResult.message || "Something went wrong."));
                    }

                } catch (jsonError) {
                    // IF WE GET HERE, IT MEANS THE SERVER SENT HTML INSTEAD OF JSON
                    // This is usually a 404 (Wrong Path) or a PHP Fatal Error
                    console.error("Server Raw Response:", textResult);
                    alert("Connection Failed!\n\nThe server returned HTML instead of JSON. Check the Console (F12) for the exact error message.\n\nLikely cause: 404 Not Found (Check file path) or PHP Syntax Error.");
                }

            } catch (error) {
                // NETWORK ERROR (Internet down, server unreachable)
                console.error('Network Error:', error);
                alert("Network Error: Could not reach the server. Check if 'admin/submit_suggestion.php' exists.");
            } finally {
                // 5. Reset Button
                btnText.innerText = originalText;
                submitBtn.style.opacity = "1";
                submitBtn.disabled = false;
            }
        });
    }

    if (closeModal) {
        closeModal.addEventListener('click', () => {
            modal.classList.remove('visible');
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300);
        });
    }

});