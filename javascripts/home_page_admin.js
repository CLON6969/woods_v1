
    function showEditFields() {
        var selectedValue = document.getElementById('headingSelect').value;
        var editFields = document.getElementById('editFields');
        var addFields = document.getElementById('addFields');
        var itemLists = document.getElementsByClassName('item-list');
        
        for (var i = 0; i < itemLists.length; i++) {
            itemLists[i].style.display = 'none';
        }
        
        if (selectedValue) {
            editFields.style.display = 'block';
            document.getElementById('items_' + selectedValue).style.display = 'block';
            document.getElementById('add_' + selectedValue).style.display = 'block';
        } else {
            editFields.style.display = 'none';
            addFields.style.display = 'none';
        }
    }

    function populateNavFields() {
        var navSelect = document.getElementById('navSelect');
        var selectedOption = navSelect.options[navSelect.selectedIndex];
        document.getElementById('update_nav_name').value = selectedOption.getAttribute('data-nav-name');
        document.getElementById('update_nav_url').value = selectedOption.getAttribute('data-nav-url');
    }

    function populatePage2Fields() {
        var page2Select = document.getElementById('page2Select');
        var selectedOption = page2Select.options[page2Select.selectedIndex];
        document.getElementById('update_page2_button').value = selectedOption.getAttribute('data-button');
        document.getElementById('update_page2_button_url').value = selectedOption.getAttribute('data-button-url');
    }

    function populatePage3Fields() {
        var page3Select = document.getElementById('page3Select');
        var selectedOption = page3Select.options[page3Select.selectedIndex];
        document.getElementById('update_page3_button').value = selectedOption.getAttribute('data-button');
        document.getElementById('update_page3_button_url').value = selectedOption.getAttribute('data-button-url');
        document.getElementById('update_page3_picture').value = selectedOption.getAttribute('data-picture');
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
