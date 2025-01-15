import './bootstrap';

// Game timer functionality
window.startGameTimer = function(duration, display) {
    let timer = duration;
    const countdown = setInterval(function () {
        display.textContent = parseInt(timer);

        if (--timer < 0) {
            clearInterval(countdown);
            if (typeof window.handleTimeout === 'function') {
                window.handleTimeout();
            }
        }
    }, 1000);

    return countdown;
};

// Answer submission functionality
window.submitAnswer = async function(questionId, answer, token) {
    try {
        const response = await fetch('/answer', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token
            },
            body: JSON.stringify({ question_id: questionId, answer: answer })
        });
        return await response.json();
    } catch (error) {
        console.error('Error submitting answer:', error);
        return null;
    }
};
