document.addEventListener('DOMContentLoaded', function () {
    window.addEventListener('message', function (event) {
        if (event.data.course) {
            const assignmentSection = document.getElementById('assignmentSection');
            const courseTitle = document.getElementById('courseTitle');
            const assignmentsContainer = document.getElementById('assignmentsContainer');
            
            // Show the assignment section
            assignmentSection.style.display = 'block';

            // Update the title with the selected course
            courseTitle.innerText = event.data.course + " Assignments";

            // Dynamically populate assignments based on the selected course
            let assignmentsHTML = '';

            // Example assignments for each course (can be adjusted)
            if (event.data.course === 'Mathematics') {
                assignmentsHTML += generateAssignmentHTML(1, 'Submitted', 'fa-check-double', 'Submitted');
                assignmentsHTML += generateAssignmentHTML(2, 'Overdue', 'fa-xmark', 'Overdue');
                assignmentsHTML += generateAssignmentHTML(3, 'Pending', 'fa-spinner', 'Pending');
            } else if (event.data.course === 'Physics') {
                assignmentsHTML += generateAssignmentHTML(1, 'Pending', 'fa-spinner', 'Pending');
                assignmentsHTML += generateAssignmentHTML(2, 'Submitted', 'fa-check-double', 'Submitted');
            } else if (event.data.course === 'Chemistry') {
                assignmentsHTML += generateAssignmentHTML(1, 'Overdue', 'fa-xmark', 'Overdue');
            } else if (event.data.course === 'Biology') {
                assignmentsHTML += generateAssignmentHTML(1, 'Pending', 'fa-spinner', 'Pending');
                assignmentsHTML += generateAssignmentHTML(2, 'Overdue', 'fa-xmark', 'Overdue');
                assignmentsHTML += generateAssignmentHTML(3, 'Submitted', 'fa-check-double', 'Submitted');
            }

            // Insert the assignments into the container
            assignmentsContainer.innerHTML = assignmentsHTML;
        }
    });

    function generateAssignmentHTML(number, status, icon, statusText) {
        return `
            <div class="titles">
                <div class="assignment_name">
                    <p>Assignment ${number}</p>
                </div>
                <div class="assignment_file">
                    <a href="path/to/assignment${number}.pdf" download="Assignment${number}.pdf">
                        <button class="btntxt" type="button">Download <i class="fa-solid ${icon}"></i></button>
                    </a>
                </div>
                <div class="assignment_check"><i class="fa-solid ${icon}"></i></div>
                <div class="assignment_conf">${statusText}</div>
                <div class="opening">Opening: 12/04/24</div>
                <div class="closing">Closing: 12/04/24</div>
            </div>
        `;
    }
});
