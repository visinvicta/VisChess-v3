document.addEventListener("DOMContentLoaded", function() {
    const NavDropdown = document.getElementById('NavDropdown');
    NavDropdown.addEventListener('click', function() {
        const dropdownMenu = document.getElementById('dropdownMenu');
        dropdownMenu.classList.toggle('show');
    });
});
