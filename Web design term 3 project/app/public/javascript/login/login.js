async function logIn() {
  const response = await fetch("http://localhost/api/user");
  const users = await response.json();
  let emailInput = document.getElementById("email").value;
  let passwordInput = document.getElementById("password").value;
  let combinationError = document.getElementById("error-combination");
  let userName = "";

  if (!emailInput.trim() || !passwordInput.trim()) {
    combinationError.innerText = "Please fill in all fields";
    return;
  }
  combinationError.innerText = "";

  const user = users.filters((user) => user.Email === emailInput);
  console.log(user);

  // if (user) {
  //     const response = await fetch('http://localhost/api/login', {
  //         method: 'POST',
  //         body: JSON.stringify({
  //             fullName: user.fullName,
  //             email: emailInput,
  //             password: passwordInput,
  //             role: user.role,
  //         }),
  //         headers: {
  //             'Content-Type': 'application/json'
  //         }
  //     });

  //     if (response.ok) {

  //         const responseData = await response.json();

  //         if (responseData.success) {
  //             window.location.href = '/';
  //         } else {
  //             combinationError.innerText = 'Password Incorrect';
  //         }
  //     } else {
  //         combinationError.innerText = "An error occurred during login";
  //     }
  // } else {
  //     combinationError.innerText = 'User not found';
  // }
}
