const  form = document.querySelector("form"),
        nextbtn = form.querySelector(".nextbtn"),
        backbtn  = form.querySelector(" .backbtn "),
        allinput  = form.querySelectorAll(" .first input");

        nextbtn.addEventListener("click",()=> { 
            allinput.forEach(input => {
                if(input.value != ""){
                    form.classList.add('secActive');
                } else {
                    form.classList.remove('secActive');
                  

                }
            })
        })

        


backbtn.addEventListener("click",()=> form.classList.remove('secActive'));








//this is for the program selection
const certificationOptions = {
    "1": ["Certificate", "Diploma", "Bachelor's Degree", "Master's Degree", "PhD"] // Computer Science
};

const intakeOptions = {
    "Certificate": ["January", "May", "September"]
};

function showCertifications() {
    const programSelect = document.getElementById('university_program');
    const certificationDiv = document.getElementById('certification_div');
    const certificationSelect = document.getElementById('certification_type');
    const intakeDiv = document.getElementById('intake_div');
    const intakeSelect = document.getElementById('intake_type');

    certificationSelect.innerHTML = '<option value="">Select Certification</option>';
    intakeSelect.innerHTML = '<option value="">Select Intake</option>';
    intakeDiv.style.display = 'none';

    if (programSelect.value) {
        const selectedProgram = programSelect.value;
        certificationDiv.style.display = 'block';
        const certifications = certificationOptions[selectedProgram] || [];
        certifications.forEach(cert => {
            const option = document.createElement('option');
            option.value = cert;
            option.textContent = cert;
            certificationSelect.appendChild(option);
        });
    } else {
        certificationDiv.style.display = 'none';
    }
}

function showIntakes() {
    const certificationSelect = document.getElementById('certification_type');
    const intakeDiv = document.getElementById('intake_div');
    const intakeSelect = document.getElementById('intake_type');

    intakeSelect.innerHTML = '<option value="">Select Intake</option>';

    if (certificationSelect.value) {
        const selectedCertification = certificationSelect.value;
        intakeDiv.style.display = 'block';
        const intakes = intakeOptions[selectedCertification] || [];
        intakes.forEach(intake => {
            const option = document.createElement('option');
            option.value = intake;
            option.textContent = intake;
            intakeSelect.appendChild(option);
        });
    } else {
        intakeDiv.style.display = 'none';
    }
}


