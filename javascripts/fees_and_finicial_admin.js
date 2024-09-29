function populateFieldsAndScroll() {
    var selectElement = document.getElementById("recordSelect");
    var selectedValue = selectElement.value;

    if (selectedValue) {
        // Retrieve the selected option's data attributes
        var selectedOption = selectElement.options[selectElement.selectedIndex];
        var heading3 = selectedOption.getAttribute('data-heading3');
        var heading3_content = selectedOption.getAttribute('data-heading3_content');
        var buttun2 = selectedOption.getAttribute('data-buttun2');
        var buttun2_url = selectedOption.getAttribute('data-buttun2_url');

        // Populate the form fields with the selected record's data
        document.getElementById("heading3").value = heading3;
        document.getElementById("heading3_content").value = heading3_content;
        document.getElementById("buttun2").value = buttun2;
        document.getElementById("buttun2_url").value = buttun2_url;

        // Show the edit fields
        document.getElementById("editFields").style.display = "block";

        // Scroll to the edit fields
        document.getElementById("editFields").scrollIntoView({ behavior: 'smooth' });
    } else {
        // Hide the edit fields if no record is selected
        document.getElementById("editFields").style.display = "none";
    }
}


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
