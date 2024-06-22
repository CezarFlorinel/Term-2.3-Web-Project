import { handleApiResponse, checkText } from '../Utilities/handle_data_checks.js';
import ErrorHandler from '../Utilities/error_handler_class.js';
const errorHandler = new ErrorHandler();

document.addEventListener('DOMContentLoaded', function () {
  const editUserForm = document.getElementById('editUserForm');

  if (editUserForm) {
    const userId = getUserIdFromUrl();

    fetch(`/api/user?id=${userId}`)

      .then(handleApiResponse)
      .then(data => {
        console.log(data);
        document.getElementById('editName').value = data.data.name;
        document.getElementById('editEmail').value = data.data.email;
        document.getElementById('editRole').value = data.data.role;
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
        .then(handleApiResponse)
        .then(data => {
          if (data.success) {
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
