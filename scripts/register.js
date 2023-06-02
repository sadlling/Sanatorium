
const form = document.querySelector('form');

form.addEventListener('submit', (event) => {
    event.preventDefault();

    const usernameInput = document.querySelector('#nameInput');
    const usersurnameInput = document.querySelector('#surnameInput');
    const birthdateInput = document.querySelector('#birthDateInput');
    const phoneInput = document.querySelector('#phoneInput');
    const emailInput = document.querySelector('#emailInput');
    const passwordInput = document.querySelector('#passwordInput');

    
    const checkUserName = ()=> /^[А-я]{4,10}$/.test(usernameInput.value);
    const checkUserSurname =()=>/^[А-я]{2,10}$/.test(usersurnameInput.value);

    const checkBirthDate = ()=>{
        const inputDate = new Date(birthdateInput.value);
        const currentDate = new Date();
        if (isNaN(inputDate) || inputDate > currentDate) {
           return false;
        }else
            return true;
    }
    const checkPhoneNumber = ()=> /^\+375(\s+)?\(?(17|29|33|44)\)?(\s+)?[0-9]{3}-[0-9]{2}-[0-9]{2}$/.test(phoneInput.value)
    
    const checkEmail = ()=>/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/.test(emailInput.value)
  
    const checkPassword = ()=>/^((?=\S*?[A-Z])(?=\S*?[a-z])(?=\S*?[0-9]).{6,})\S$/.test(passwordInput.value)


    !checkUserName()? usernameInput.style.borderColor = "red":usernameInput.style.borderColor = "LightGray";
    !checkUserSurname()? usersurnameInput.style.borderColor = "red":usersurnameInput.style.borderColor = "LightGray";
    !checkBirthDate()? birthdateInput.style.borderColor = "red":birthdateInput.style.borderColor = "LightGray";
    !checkPhoneNumber()? phoneInput.style.borderColor = "red":phoneInput.style.borderColor = "LightGray";
    !checkEmail()? emailInput.style.borderColor = "red":emailInput.style.borderColor = "LightGray";
    !checkPassword()? passwordInput.style.borderColor = "red":passwordInput.style.borderColor = "LightGray";

    
    if(checkUserName() && checkUserSurname() && checkBirthDate()&& checkPhoneNumber()&& checkEmail()&&checkPassword()) 
    {
        form.submit()
    }

  


});


