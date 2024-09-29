
 // this is for the adding of the items 


document.getElementById('headingSelect').addEventListener('change', function() {
    var selectedValue = this.value;
    var editFields = document.getElementById('editFields');
    
    // Hide all item lists
    var itemLists = document.getElementsByClassName('item-list');
    for (var i = 0; i < itemLists.length; i++) {
        itemLists[i].style.display = 'none';
    }

    // Show edit fields
    editFields.style.display = 'block';

    // Set the heading name input to the selected value
    var headingNameInput = document.getElementById('headingName');
    headingNameInput.value = selectedValue;

    // Show the selected heading's item list
    if (selectedValue) {
        var selectedItemList = document.getElementById('items_' + selectedValue);
        if (selectedItemList) {
            selectedItemList.style.display = 'grid';
        }
    }

    // Scroll to the edit fields smoothly
    editFields.scrollIntoView({ behavior: 'smooth' });
});

document.getElementById('addHeadingSelect').addEventListener('change', function() {
    var selectedValue = this.value;
    var addItemsContainer = document.getElementById('addItemsContainer');
    
    if (selectedValue) {
        addItemsContainer.style.display = 'block';

        // Scroll to the add items container smoothly
        addItemsContainer.scrollIntoView({ behavior: 'smooth' });
    } else {
        addItemsContainer.style.display = 'none';
    }
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





