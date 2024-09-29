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


