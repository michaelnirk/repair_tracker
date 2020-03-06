LoginForm = (function() {
  let _this = {};

  /************************Variables************************/
  const errors = [];

  /************************end Variables********************/

  /************************Functions************************/
  function init() {
    initializeStandardTooltip();
  }

  async function processLogin() {
    const isValid = await validateLogin();
    if (isValid) {
      document.getElementById('loginForm').submit();
    }
  }

  function validateLogin() {
    let isValid = true;
    const userName = document.getElementById('userName');
    const pwd = document.getElementById('password');
    if (userName.value.trim()) {
      userName.classList.remove('invalid');
    } else {
      userName.classList.add('invalid');
      isValid = false;
      errors.push('Please enter your Email address.');
    }

    if (pwd.value.trim()) {
      pwd.classList.remove('invalid');
    } else {
      pwd.classList.add('invalid');
      isValid = false;
      errors.push('Please enter your password.');
    }
    if (!isValid) {
      let message = "";
      for (const error of errors) {
        message += `${error}<br>`;
      }
      showMessage('There are errors', message).then(() => {
        errors.length = 0;
      });
    }
    return isValid;
  }

  async function processCreateNewAccount() {
    const isValid = await validateNewAccount();
    if (isValid) {
      document.getElementById('createAccountForm').submit();
    }
  }

  function validateNewAccount() {
    let isValid = true;
    const firstName = document.getElementById('firstName');
    const lastName = document.getElementById('lastName');
    const newUserName = document.getElementById('newUserName');
    const newPassword1 = document.getElementById('newPassword1');
    const newPassword2 = document.getElementById('newPassword2');

    //Make sure first name has a value
    if(firstName.value.trim()){
      firstName.classList.remove('invalid');
    } else {
      isValid = false;
      firstName.classList.add('invalid');
      errors.push('Please enter your first name.');
    }

    //Make sure last name has a value
    if(lastName.value.trim()){
      lastName.classList.remove('invalid');
    } else {
      isValid = false;
      lastName.classList.add('invalid');
      errors.push('Please enter your last name.');
    }

    //Make sure email has a value
    if(newUserName.value.trim()){
      newUserName.classList.remove('invalid');
    } else {
      isValid = false;
      newUserName.classList.add('invalid');
      errors.push('Please enter your email address.');
    }

    //Make sure password1 has a value
    if(newPassword1.value.trim()){
      newPassword1.classList.remove('invalid');
    } else {
      isValid = false;
      newPassword1.classList.add('invalid');
      errors.push('Please enter a password.');
    }

    //Make sure confirm password2 has a value
    if(newPassword2.value.trim()){
      newPassword2.classList.remove('invalid');
    } else {
      isValid = false;
      newPassword2.classList.add('invalid');
      errors.push('Please enter your password again.');
    }

    //Make sure password1 and password2 are the same
    if (newPassword1.value.trim() && newPassword2.value.trim() && (newPassword1.value.trim() === newPassword2.value.trim())) {
      newPassword1.classList.remove('invalid');
      newPassword2.classList.remove('invalid');
    } else {
      isValid = false;
      newPassword1.classList.add('invalid');
      newPassword2.classList.add('invalid');
      errors.push('Your passwords do not match. Please try again.');
    }

    if (!isValid) {
      let message = "";
      for (const error of errors) {
        message += `${error}<br>`;
      }
      showMessage('There are errors', message).then(() => {
        errors.length = 0;
      });
    }

    return isValid;
  }
  /************************end Functions********************/

  /************************Exports**************************/
  _this.init = init;
  _this.processLogin = processLogin;
  _this.processCreateNewAccount = processCreateNewAccount;
  /************************end Exports**********************/

  return _this;
})();