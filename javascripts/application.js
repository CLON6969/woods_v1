// First JavaScript: Multi-Step Form Handling 

(function() {
    let currentFormSection = 0;
    const formSections = document.querySelectorAll('.form-section');
    const progressBar = document.getElementById('progress-bar');

    function showSection(index) {
        formSections.forEach((section, idx) => {
            section.classList.toggle('active', idx === index);
        });
        progressBar.style.width = `${(index + 1) / formSections.length * 100}%`;
    }

    window.validateSection = function() {
        let inputs = formSections[currentFormSection].querySelectorAll('input, select');
        let valid = true;

        inputs.forEach((input) => {
            if (!input.checkValidity()) {
                input.classList.add('is-invalid');
                valid = false;
            } else {
                input.classList.remove('is-invalid');
            }
        });

        if (valid) {
            currentFormSection++;
            showSection(currentFormSection);
        }
    };

    window.previousSection = function() {
        if (currentFormSection > 0) {
            currentFormSection--;
            showSection(currentFormSection);
        }
    };

    document.getElementById('multi-step-form').addEventListener('submit', function(event) {
        let form = this;
        let valid = true;

        formSections.forEach((section) => {
            let inputs = section.querySelectorAll('input, select');
            inputs.forEach((input) => {
                if (!input.checkValidity()) {
                    input.classList.add('is-invalid');
                    valid = false;
                } else {
                    input.classList.remove('is-invalid');
                }
            });
        });

        if (!valid) {
            event.preventDefault();
            event.stopPropagation();
        }
    });
})();


// Second JavaScript: Program and Certification Handling 

(function() {
    window.showCertifications = function() {
        const programSelect = document.getElementById('university_program');
        const certificationDiv = document.getElementById('certification_div');
        const certificationSelect = document.getElementById('certification_type');

        if (programSelect.value) {
            certificationDiv.style.display = 'block';
        } else {
            certificationDiv.style.display = 'none';
            document.getElementById('intake_div').style.display = 'none';
            certificationSelect.value = '';
        }
    };

    window.showIntakes = function() {
        const certificationSelect = document.getElementById('certification_type');
        const intakeDiv = document.getElementById('intake_div');

        if (certificationSelect.value) {
            intakeDiv.style.display = 'block';
        } else {
            intakeDiv.style.display = 'none';
        }
    };
})();
