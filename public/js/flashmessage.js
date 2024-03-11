document.addEventListener('DOMContentLoaded', function () {
    var flashMessage = document.querySelector('.flash-message');
    if (flashMessage) {
        flashMessage.style.display = 'block';
        setTimeout(function () {
            flashMessage.style.display = 'none';
        }, 4000);
    }
});

