document.addEventListener("DOMContentLoaded", function () {
  // FORM
  const emailInput = document.getElementById("email");
  const usernameInput = document.getElementById("username");
  const passwordInput = document.getElementById("password");
  const registerBtn = document.getElementById("register-btn");

  // ERRORS
  const emailErrorMessage = document.getElementById("email-error");
  const usernameErrorMessage = document.getElementById("username-error");
  const passwordErrorMessage = document.getElementById("password-error");

  registerBtn.disabled = true;

  usernameInput.addEventListener("blur", (e) => {
    const enteredUsername = e.target.value;

    if (enteredUsername.trim() === "") {
      usernameErrorMessage.textContent = "Username can't be empty";
      e.target.classList.remove("valid-border");
      e.target.classList.add("error-border");
      registerBtn.disabled = true;
      return;
    } else {
      usernameErrorMessage.textContent = "";
      e.target.classList.remove("error-border");
      e.target.classList.add("valid-border");
      enableRegisterBtn();
    }
  });

  emailInput.addEventListener("blur", (e) => {
    const enteredEmail = e.target.value;

    if (enteredEmail.trim() === "" || !enteredEmail.includes("@")) {
      emailErrorMessage.textContent = "Enter a valid email";
      emailInput.classList.remove("valid-border");
      emailInput.classList.add("error-border");
      registerBtn.disabled = true;
      return;
    }

    emailErrorMessage.textContent = "";
    emailInput.classList.remove("error-border");
    emailInput.classList.add("valid-border");
    enableRegisterBtn();
  });

  passwordInput.addEventListener("keyup", () => {
    const enteredPassword = passwordInput.value;

    if (
      enteredPassword.length < 8 ||
      !/\d/.test(enteredPassword) ||
      !/[A-Z]/.test(enteredPassword) ||
      !/[!@#$%^&*]/.test(enteredPassword)
    ) {
      passwordErrorMessage.textContent =
        "Password must contain at least 8 characters, one number, uppercase letter and one special sign.";
      emailInput.classList.remove("valid-border");
      passwordInput.classList.add("error-border");
      registerBtn.disabled = true;
    } else {
      passwordErrorMessage.textContent = "";
      passwordInput.classList.remove("error-border");
      passwordInput.classList.add("valid-border");
      enableRegisterBtn();
    }
  });

  function enableRegisterBtn() {
    if (
      emailErrorMessage.textContent === "" &&
      usernameErrorMessage.textContent === "" &&
      passwordErrorMessage.textContent === ""
    ) {
      registerBtn.disabled = false;
    } else {
      registerBtn.disabled = true;
    }
  }
});
