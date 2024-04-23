import { handleApiResponse, checkText } from '../Utilities/handle_data_checks.js';
import ErrorHandler from '../Utilities/error_handler_class.js';
const errorHandler = new ErrorHandler();

//Filling the table with users

document.addEventListener("DOMContentLoaded", function () {
  fetch("/api/user")
    .then((response) => response.json())
    .then((data) => {
      const tableBody = document.querySelector("#userTable tbody");

      data.data.forEach((user) => {
        // Parse the registration date string into a Date object
        const registrationDate = new Date(user.RegistrationDate);

        // Format the date
        const formattedRegistrationDate = `${registrationDate
          .getDate()
          .toString()
          .padStart(2, "0")}-${(registrationDate.getMonth() + 1)
            .toString()
            .padStart(2, "0")}-${registrationDate.getFullYear()}`;

        const row = tableBody.insertRow(); // schimba aici daca nu merge sanitarizeaza cu DOMPurify.sanitize
        row.innerHTML = `
                <tr data-userid="${DOMPurify.sanitize(user.UserID)}" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    ${DOMPurify.sanitize(user.UserID)}
                </th>
                <td class="px-6 py-4">
                    ${DOMPurify.sanitize(user.Email)}
                </td>
                <td class="px-6 py-4">
                    ${DOMPurify.sanitize(user.Role)}
                </td>
                <td class="px-6 py-4">
                    ${DOMPurify.sanitize(user.Name)}
                </td>
                <td class="px-6 py-4">
                    ${DOMPurify.sanitize(formattedRegistrationDate)}
                </td>
                <td class="px-6 py-4 d-flex justify-content-center">
                    <a href="/userEditAdmin/index?id=${user.UserID}"><button update-userid="${user.UserID}" type="button" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 border border-gray-400 rounded shadow">Edit</button></a>
                    <button delete-userid="${user.UserID}" type="button" class="bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 border border-gray-400 rounded shadow">Delete</button>
                </td>
            </tr>
        `;
      });

      const deleteButtons = document.querySelectorAll(
        "#userTable tbody button[delete-userid]"
      );
      deleteButtons.forEach((deleteButton) => {
        deleteButton.addEventListener("click", function () {
          const userId = this.getAttribute("delete-userid");
          deleteUser(userId);
        });
      });
    })
    .catch((error) => {
      errorHandler.logError(error, "button[delete-userid]", "user.js");
      errorHandler.showAlert("An error occurred while trying to delete the user. Please try again later.");
    });

  function deleteUser(userId) {
    const confirmDelete = confirm("Are you sure you want to delete this user?");
    if (!confirmDelete) {
      return;
    }

    fetch(`/api/user?id=${userId}`, {
      method: "DELETE",
    })
      .then((response) => {
        if (response.ok) {
          location.reload();
          console.log("User deleted successfully");
        } else {
          errorHandler.showAlert("An error occurred while trying to delete the user. Please try again later.");
        }
      })
      .catch((error) => {
        errorHandler.logError(error, "button[delete-userid]", "user.js");
      });
  }
});


//Edit users 


document.addEventListener('DOMContentLoaded', function () {
  const editUserForm = document.getElementById('editUserForm');

  if (editUserForm) {
    const userId = getUserIdFromUrl();
    console.log(userId);

    fetch(`/api/user?id=${userId}`)

      .then(response => response.json())
      .then(data => {
        document.getElementById('editName').value = data.data.Name;
        document.getElementById('editEmail').value = data.data.Email;
        document.getElementById('editRole').value = data.data.Role;
      })
      .catch(error => errorHandler.logError('Error fetching user data:', error));

    editUserForm.addEventListener('submit', function (event) {
      event.preventDefault();

      const name = document.getElementById('editName').value;
      const email = document.getElementById('editEmail').value;
      const role = document.getElementById('editRole').value;

      const formData = {
        name: name,
        email: email,
        role: role,
      };

      fetch(`/api/user?id=${userId}`, {
        method: 'PUT',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify(formData),
      })
        .then(response => response.json())
        .then(data => {
          if (data.status === 'success') {
            window.location.href = '/userAdmin';
          } else {
            errorHandler.logError('Error updating user:', data.message);
          }
        })
        .catch(error => {
          errorHandler.logError(error, "editUserForm", "user.js");
          errorHandler.showAlert("An error occurred while trying to edit the user. Please try again later!");
      });
    });
  }

  function getUserIdFromUrl() {
    const url = new URL(window.location.href);

    const userId = url.searchParams.get('id');

    return userId;
  }
});


//Add users

document.addEventListener('DOMContentLoaded', function () {
    const addUserForm = document.getElementById('addUserForm');

    if (addUserForm) {
        addUserForm.addEventListener('submit', function (event) {
            event.preventDefault();

            const name = document.getElementById('addName').value;
            const email = document.getElementById('addEmail').value;
            const role = document.getElementById('addRole').value;
            const pass = document.getElementById('addPassword').value;
            const repeatPass = document.getElementById('addRepeatPassword').value;

            if (pass.length < 8) {
                errorHandler.showAlert('Password must be at least 8 characters long.');
                return;
            }

            if (pass !== repeatPass) {
              errorHandler.showAlert('Passwords do not match.');
                return;
            }

            const formData = {
                name: name,
                email: email,
                role: role,
                password: pass,
            };

            fetch('/api/user', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(formData),
            })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        window.location.href = '/user';
                    } else {
                        errorHandler.logError('Error updating user:', data.message);
                    }
                })
                .catch(error => {
                  errorHandler.logError(error, "addUserForm", "user.js");
                  errorHandler.showAlert("An error occurred while trying to add a new user. Please try again later!");
                });
        });
    }
});

