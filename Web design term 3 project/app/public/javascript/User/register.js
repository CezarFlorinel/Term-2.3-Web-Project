//Registration form

document.addEventListener("DOMContentLoaded", function () {
  const registrationForm = document.getElementById("registrationForm");
  console.log("this is working");

  if (registrationForm) {
    registrationForm.addEventListener("submit", function (event) {
      event.preventDefault();
      console.log("this is working --2")
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
        role: "Member",
      };
      console.log(formData);

      fetch('api/user/create', {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify(formData),
      })
        .then((response) => response.json())
        .then((data) => {
          if (data.success) {
            window.location.href = "/login";
          }
          else {
            alert("Registration failed. Please try again.");
          }

        })
        .catch((error) => {
          console.error("Error:", error);
        });
    });
  }
});