import { handleApiResponse, checkText } from '../Utilities/handle_data_checks.js';
import ErrorHandler from '../Utilities/error_handler_class.js';
const errorHandler = new ErrorHandler();

//Filling the table with users

document.addEventListener("DOMContentLoaded", function () {
  fetch("/api/user")
    .then(handleApiResponse)
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

        const row = tableBody.insertRow();
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
      //why this error is thrown for edit user??
      errorHandler.showAlert("An error occurred while trying to fetch the data.");
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
          errorHandler.showAlert("User deleted successfully", { title: 'Success', icon: 'success' });
        }
      })
      .catch((error) => {
        errorHandler.logError(error, "button[delete-userid]", "user.js");
        errorHandler.showAlert("An error occurred while trying to delete the user. Please try again later.");
      });
  }
});
