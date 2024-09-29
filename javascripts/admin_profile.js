function loadPage(page) {
    const iframe = document.getElementById('contentFrame');
    iframe.src = page;
}

// Sidebar toggle and icon change
document.addEventListener('DOMContentLoaded', () => {
    const sidebar = document.querySelector('.sidebar');
    const menuToggle = document.getElementById('menuToggle');
    const menuIcon = menuToggle.querySelector('i');

    menuToggle.addEventListener('click', () => {
        sidebar.classList.toggle('collapsed');
        if (sidebar.classList.contains('collapsed')) {
            menuIcon.classList.replace('fa-times', 'fa-bars');
        } else {
            menuIcon.classList.replace('fa-bars', 'fa-times');
        }
    });
});