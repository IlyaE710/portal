const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
const tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl);
});

function togglePopup(popupId) {
    const popup = document.getElementById(popupId);
    const overlay = document.querySelector('.overlay');
    if (popup.classList.contains('active')) {
        popup.classList.remove('active');
        overlay.classList.remove('active');
    } else {
        closeAllPopups();
        popup.classList.add('active');
        overlay.classList.add('active');
    }
}

function closeAllPopups() {
    const popups = document.querySelectorAll('.popup.active');
    const overlay = document.querySelector('.overlay');
    for (var i = 0; i < popups.length; i++) {
        popups[i].classList.remove('active');
    }
    overlay.classList.remove('active');
}

window.addEventListener('hashchange', function(event) {
    closeAllPopups();
});

