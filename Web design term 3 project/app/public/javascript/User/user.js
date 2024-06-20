import { handleApiResponse } from "../Utilities/handle_data_checks.js";
import ErrorHandler from "../Utilities/error_handler_class.js";
const errorHandler = new ErrorHandler();

function searchFunction() {
  var input, filter, table, tbody, tr, td, i, txtValue;
  input = document.getElementById("search");
  filter = input.value.toUpperCase();
  table = document.getElementById("userTable");
  tbody = table.querySelector("tbody");
  tr = tbody.getElementsByTagName("tr");

  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[3]; // Adjusted to column index for Name
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}

function sortTable(n) {
  const table = document.getElementById("userTable");
  const tbody = table.querySelector("tbody");
  const rowsArray = Array.from(tbody.rows);
  let dir = "asc";

  if (table.dataset.sortColumn == n && table.dataset.sortDirection == "asc") {
    dir = "desc";
  }

  rowsArray.sort((a, b) => {
    let x = a.cells[n].innerText || a.cells[n].textContent;
    let y = b.cells[n].innerText || b.cells[n].textContent;

    // Detect if the column being sorted is a date
    if (n === 4) { // Assuming the date column index is 4
      x = parseDate(x);
      y = parseDate(y);
    } else if (!isNaN(x) && !isNaN(y)) { // Number comparison
      x = parseFloat(x);
      y = parseFloat(y);
    } else { // String comparison
      x = x.toLowerCase();
      y = y.toLowerCase();
    }

    if (dir == "asc") {
      return x > y ? 1 : -1;
    } else {
      return x < y ? 1 : -1;
    }
  });

  // Append sorted rows back to the tbody
  rowsArray.forEach(row => tbody.appendChild(row));

  table.dataset.sortColumn = n;
  table.dataset.sortDirection = dir;

  updateSortIndicator(n, dir);
}

function parseDate(dateString) {
  const parts = dateString.split("-");
  const day = parseInt(parts[0], 10);
  const month = parseInt(parts[1], 10) - 1; // Months are zero-based in JavaScript Date
  const year = parseInt(parts[2], 10);
  return new Date(year, month, day);
}

function updateSortIndicator(n, dir) {
  const headers = document.querySelectorAll("#userTable th");
  headers.forEach((header, index) => {
    const indicator = header.querySelector(".sort-indicator");
    if (index === n) {
      indicator.innerHTML = dir === "asc" ? "&#9650;" : "&#9660;";
    } else {
      indicator.innerHTML = "&#9650;";
    }
  });
}

// Filling the table with users
document.addEventListener("DOMContentLoaded", function () {
  document.getElementById("search").addEventListener("keyup", searchFunction);

  const headers = document.querySelectorAll("#userTable th");
  headers.forEach((header, index) => {
    header.addEventListener("click", function() {
      sortTable(index);
    });
  });

  fetch("/api/user")
    .then(handleApiResponse)
    .then((data) => {
      const tableBody = document.querySelector("#userTable tbody");

      data.data.forEach((user) => {
        const registrationDate = new Date(user.RegistrationDate);
        const formattedRegistrationDate = `${registrationDate
          .getDate()
          .toString()
          .padStart(2, "0")}-${(registrationDate.getMonth() + 1)
          .toString()
          .padStart(2, "0")}-${registrationDate.getFullYear()}`;
        const row = tableBody.insertRow();

        row.innerHTML = `
                <tr data-userid="${DOMPurify.sanitize(
                  user.UserID
                )}" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
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
                    <a href="/userEditAdmin/index?id=${
                      user.UserID
                    }"><button update-userid="${
          user.UserID
        }" type="button" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 border border-gray-400 rounded shadow">Edit</button></a>
                    <button delete-userid="${
                      user.UserID
                    }" type="button" class="bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 border border-gray-400 rounded shadow">Delete</button>
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
      errorHandler.showAlert(
        "An error occurred while trying to fetch the data."
      );
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
          errorHandler.showAlert("User deleted successfully", {
            title: "Success",
            icon: "success",
          });
        }
      })
      .catch((error) => {
        errorHandler.logError(error, "button[delete-userid]", "user.js");
        errorHandler.showAlert(
          "An error occurred while trying to delete the user. Please try again later."
        );
      });
  }
});
