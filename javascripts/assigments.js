document.addEventListener('DOMContentLoaded', () => {
    // Part 1: Assignment Boxes - Check if assignments are open or closed
    const assignmentBoxes = document.querySelectorAll('.assignment_box2_child1');

    assignmentBoxes.forEach(box => {
        const fileInput = box.querySelector('input[type="file"]');
        const submitBtn = box.querySelector('button[type="submit"]');

        // Check if the assignment is open
        const isOpen = !fileInput.disabled; // Enabled if the assignment is open

        // Disable upload options if the assignment is closed
        if (!isOpen) {
            submitBtn.disabled = true;
            fileInput.disabled = true;
            submitBtn.classList.add('disabled-btn');
        }
    });

    // Part 2: Active Course Selection - Highlight selected course
    const links = document.querySelectorAll('.listcourses');
    const selectedCourse = localStorage.getItem('selectedCourse');

    // Check if there was a previously selected course in localStorage
    if (selectedCourse) {
        const selectedLink = document.querySelector(`.listcourses[href='${selectedCourse}']`);
        if (selectedLink) {
            selectedLink.classList.add('selected');
        }
    }

    // Add click event to each link for course selection
    links.forEach(link => {
        link.addEventListener('click', function() {
            // Remove 'selected' class from previously selected link
            links.forEach(link => link.classList.remove('selected'));

            // Add 'selected' class to the clicked link
            this.classList.add('selected');

            // Store the selected course in localStorage
            localStorage.setItem('selectedCourse', this.getAttribute('href'));
        });
    });
});
