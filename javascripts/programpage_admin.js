function populateFieldsAndScroll() {
    var selectElement = document.getElementById("recordSelect");
    var selectedValue = selectElement.value;

    if (selectedValue) {
        // Retrieve the selected option's data attributes
        var selectedOption = selectElement.options[selectElement.selectedIndex];
        var heading = selectedOption.getAttribute('data-heading');
        var heading_content = selectedOption.getAttribute('data-heading_content');
        var buttun = selectedOption.getAttribute('data-buttun');
        var buttun_url = selectedOption.getAttribute('data-buttun_url');
        var picture = selectedOption.getAttribute('data-picture');

        // Populate the form fields with the selected record's data
        document.getElementById("heading").value = heading;
        document.getElementById("heading_content").value = heading_content;
        document.getElementById("buttun").value = buttun;
        document.getElementById("buttun_url").value = buttun_url;
        
        // We can't pre-populate the file input field for security reasons, so just leave it blank
        document.getElementById("picture").value = null;

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


//this is for the admision2 table 
function populateFieldsAndScroll2() {
    var selectElement = document.getElementById("recordSelect2");
    var selectedValue = selectElement.value;

    if (selectedValue) {
        // Retrieve the selected option's data attributes
        var selectedOption = selectElement.options[selectElement.selectedIndex];
        var icon = selectedOption.getAttribute('data-icon');
        var reading = selectedOption.getAttribute('data-reading');
        var content = selectedOption.getAttribute('data-content');
        var buttun = selectedOption.getAttribute('data-buttun');
        var buttun_url = selectedOption.getAttribute('data-buttun_url');

        // Populate the form fields with the selected record's data
        document.getElementById("icon").value = icon;
        document.getElementById("Reading").value = reading;
        document.getElementById("Content").value = content;
        document.getElementById("buttun").value = buttun;
        document.getElementById("buttun_url").value = buttun_url;

        // Show the edit fields
        document.getElementById("editFields2").style.display = "block";

        // Scroll to the edit fields
        document.getElementById("editFields2").scrollIntoView({ behavior: 'smooth' });
    } else {
        // Hide the edit fields if no record is selected
        document.getElementById("editFields2").style.display = "none";
    }
}


// JavaScript function to populate the fields and scroll to 
function populateFieldsAndScroll() {
    var selectElement = document.getElementById("recordSelect");
    var selectedValue = selectElement.value;

    if (selectedValue) {
        // Retrieve the selected option's data attributes
        var selectedOption = selectElement.options[selectElement.selectedIndex];
        var heading = selectedOption.getAttribute('data-heading');
        var content = selectedOption.getAttribute('data-content');
        var background_picture = selectedOption.getAttribute('data-background_picture');

        // Populate the form fields with the selected record's data
        document.getElementById("heading").value = heading;
        document.getElementById("content").value = content;

        // We can't pre-populate the file input field for security reasons, so just leave it blank
        document.getElementById("background_picture").value = null;

        // Show the edit fields
        document.getElementById("editFields").style.display = "block";

        // Scroll to the edit fields
        document.getElementById("editFields").scrollIntoView({ behavior: 'smooth' });
    } else {
        // Hide the edit fields if no record is selected
        document.getElementById("editFields").style.display = "none";
    }
}