//Registration form

document.addEventListener("DOMContentLoaded", function () {
    const registrationForm = document.getElementById("registrationForm");
    console.log("this is working");
    if (registrationForm) {
      registrationForm.addEventListener("registerButton", function (event) {
        event.preventDefault();
  
        const name = document.getElementById("name").value;
        const email = document.getElementById("email").value;
        const password = document.getElementById("password").value;
        const passwordConfirm = document.getElementById("confirmPassword").value;
  
        if (!name || !email || !password || !passwordConfirm) {
          alert("Please fill in all fields.");
          return;
        }
  
        if (password !== passwordConfirm) {
          alert("Passwords do not match.");
          return;
        }
  
        const formData = {
          name: name,
          email: email,
          password: password,
          passwordConfirm: passwordConfirm,
          userRole: "Member",
        };
        console.log(formData);
  
        fetch("http://localhost/api/user", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify(formData),
        })
          .then((response) => response.json())
          .then((data) => {
            //window.location.href = "/login/index";
          })
          .catch((error) => {
            console.error("Error:", error);
          });
      });
    }
  });