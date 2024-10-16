
//this is for the progress bar

function showProgressBar() {
    document.getElementById('progresss-bar-container').style.display = 'block';
    let progressBar = document.getElementById('progresss-bar');
    let width = 0;
    let interval = setInterval(function() {
        if (width >= 100) {
            clearInterval(interval);
            document.getElementById('progresss-bar-container').style.display = 'none';
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