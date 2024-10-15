
let currentSection = 1;

function showSection(sectionNumber) {
    document.querySelectorAll('.form-section').forEach((section) => {
        section.style.display = 'none';
    });
    document.getElementById(`section-${sectionNumber}`).style.display = 'block';
    updateProgressBar(sectionNumber);
}

function updateProgressBar(sectionNumber) {
    const progressBar = document.getElementById('progress-bar');
    const percentage = (sectionNumber / 3) * 100;
    progressBar.style.width = `${percentage}%`;
}

function validateSection() {
    const currentForm = document.querySelector(`#section-${currentSection}`);
    const inputs = currentForm.querySelectorAll("input, select");
    let isValid = true;

    inputs.forEach(input => {
        if (!input.checkValidity()) {
            input.classList.add("is-invalid");
            isValid = false;
        } else {
            input.classList.remove("is-invalid");
        }
    });

    return isValid;
}

function nextSection() {
    if (validateSection()) {
        if (currentSection < 3) {
            currentSection++;
            showSection(currentSection);
        }
    }
}

function previousSection() {
    if (currentSection > 1) {
        currentSection--;
        showSection(currentSection);
    }
}

window.onload = () => {
    showSection(currentSection);
};



//this is for the certification or choosing of programs
        function showCertifications() {
            const programSelect = document.getElementById('university_program');
            const certificationDiv = document.getElementById('certification_div');
            const certificationSelect = document.getElementById('certification_type');

            if (programSelect.value) {
                certificationDiv.style.display = 'block'; // Show certifications
            } else {
                certificationDiv.style.display = 'none'; // Hide certifications
                document.getElementById('intake_div').style.display = 'none'; // Hide intakes if no program is selected
                certificationSelect.value = ''; // Reset certification value
            }
        }

        function showIntakes() {
            const certificationSelect = document.getElementById('certification_type');
            const intakeDiv = document.getElementById('intake_div');

            if (certificationSelect.value) {
                intakeDiv.style.display = 'block'; // Show intakes
            } else {
                intakeDiv.style.display = 'none'; // Hide intakes
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
