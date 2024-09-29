
// Script to display edit fields
function showEditFields() {
    var selectedValue = document.getElementById('headingSelect').value;
    var editFields = document.getElementById('editFields');
    var itemLists = document.getElementsByClassName('item-list');
    
    for (var i = 0; i < itemLists.length; i++) {
        itemLists[i].style.display = 'none';
    }
    
    editFields.style.display = 'block';
    document.getElementById('headingName').value = selectedValue;
    
    if (selectedValue) {
        document.getElementById('items_' + selectedValue).style.display = 'block';
    }
}




// Script to toggle Add Item form
function toggleAddItemForm() {
    var selectedValue = document.getElementById('addHeadingSelect').value;
    var addItemsContainer = document.getElementById('addItemsContainer');
    
    if (selectedValue) {
        addItemsContainer.style.display = 'block';
    } else {
        addItemsContainer.style.display = 'none';
    }
}


//JavaScript Validation for Add Item Form
document.addEventListener('DOMContentLoaded', function() {
    var deleteOverlay = document.getElementById('deleteOverlay');
    var confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
    var cancelDeleteBtn = document.getElementById('cancelDeleteBtn');
    var deleteItemId = null; // To store the ID of the item to delete

    // Function to show the overlay
    function showDeleteOverlay(itemId) {
        deleteItemId = itemId;
        deleteOverlay.style.display = 'flex';
    }

    // Function to hide the overlay
    function hideDeleteOverlay() {
        deleteOverlay.style.display = 'none';
    }

    // Event listener for the confirm button
    confirmDeleteBtn.addEventListener('click', function() {
        if (deleteItemId) {
            // Use AJAX to send the deletion request
            var xhr = new XMLHttpRequest();
            xhr.open('POST', '', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (xhr.status === 200) {
                    // Refresh the page or update the UI based on response
                    location.reload(); // Reload the page to reflect changes
                }
            };
            xhr.send('deleteItem=' + encodeURIComponent(deleteItemId));
        }
        hideDeleteOverlay();
    });

    // Event listener for the cancel button
    cancelDeleteBtn.addEventListener('click', function() {
        hideDeleteOverlay();
    });

    // Attach event listener to delete buttons
    document.querySelectorAll('.delete-btn').forEach(function(button) {
        button.addEventListener('click', function(event) {
            event.preventDefault(); // Prevent default behavior
            var itemId = this.getAttribute('data-id'); // Get item ID from data attribute
            showDeleteOverlay(itemId);
        });
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
