
    // Multi-step form navigation
    document.querySelectorAll('.next-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            let currentSection = this.closest('.form-section');
            currentSection.classList.remove('active');
            currentSection.nextElementSibling.classList.add('active');
            updateProgressBar();
        });
    });

    document.querySelectorAll('.previous-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            let currentSection = this.closest('.form-section');
            currentSection.classList.remove('active');
            currentSection.previousElementSibling.classList.add('active');
            updateProgressBar();
        });
    });

    function updateProgressBar() {
        let totalSections = document.querySelectorAll('.form-section').length;
        let activeSectionIndex = Array.from(document.querySelectorAll('.form-section')).findIndex(section => section.classList.contains('active'));
        let progress = ((activeSectionIndex + 1) / totalSections) * 100;
        document.getElementById('progress-bar').style.width = progress + '%';
    }

    // Form validation
    (function () {
        'use strict';
        var forms = document.querySelectorAll('.needs-validation');
        Array.prototype.slice.call(forms).forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    })();
