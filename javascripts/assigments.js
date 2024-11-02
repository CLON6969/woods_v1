// Highlight selected course and assignment
document.addEventListener('DOMContentLoaded', () => {
    const links = document.querySelectorAll('.listcourses');
    links.forEach(link => {
        link.classList.remove('selected');
        if (link.href === window.location.href) {
            link.classList.add('selected');
        }
    });
});


//this is for the progress bar

function showProgressBar() {
    document.getElementById('progress-bar-container').style.display = 'block';
    let progressBar = document.getElementById('progress-bar');
    let width = 0;
    let interval = setInterval(function() {
        if (width >= 100) {
            clearInterval(interval);
            document.getElementById('progress-bar-container').style.display = 'none';
        } else {
            width++;
            progressBar.style.width = width + '%';
        }
    }, 10); // Adjust the interval as needed
}

// Show progress bar when the page starts loading
window.onload = function() {
    showProgressBar();
};
