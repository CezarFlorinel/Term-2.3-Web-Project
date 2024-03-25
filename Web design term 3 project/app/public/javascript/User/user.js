document.addEventListener('DOMContentLoaded', function () {
    const registrationForm = document.getElementById('registrationForm');

    if (registrationForm) {
        registrationForm.addEventListener('registerButton', function (event) {
            event.preventDefault();

            const name = document.getElementById('name').value;
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            const passwordConfirm = document.getElementById('confirmPassword').value;

            if (!name || !email || !password || !passwordConfirm) {
                alert('Please fill in all fields.');
                return;
            }

            if (password !== passwordConfirm) {
                alert('Passwords do not match.');
                return;
            }

            const formData = {
                name: name,
                email: email,
                password: password,
                passwordConfirm: passwordConfirm,
                userRole: 'Member',
            };

            fetch('http://localhost/api/user', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(formData),
            })
                .then(response => response.json())
                .then(data => {
                    window.location.href = '/login/index';
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        });
    }
});

// document.addEventListener('DOMContentLoaded', function () {
//     const userRoles = {
//         1: 'User',
//         2: 'Admin'
//     };

//     fetch('/api/user')
//         .then(response => response.json())
//         .then(data => {
//             const tableBody = document.querySelector('#userTable tbody');

//             data.data.forEach(user => {
//                 const row = tableBody.insertRow();
//                 row.innerHTML = `
//                     <tr data-userid="${user.id}">
//                     <td>${user.id}</td>
//                     <td>${user.email}</td>
//                     <td>${user.name}</td>
//                     <td>${user.phone}</td>
//                     <td>${userRoles[user.user_role_id]}</td>
//                     <td class="d-flex justify-content-center">
//                         <a href="/user/edit?id=${user.id}"><button update-userid="${user.id} type="button" class="btn btn-warning btn-sm mx-2">Edit</button></a>
//                         <button delete-userid="${user.id}" type="button" class="btn btn-danger btn-sm mx-2">Delete</button>
//                     </td>
//                     </tr>
//                 `;
//             });

//             const deleteButtons = document.querySelectorAll('#userTable tbody button[delete-userid]');
//             deleteButtons.forEach(deleteButton => {
//                 deleteButton.addEventListener('click', function () {
//                     const userId = this.getAttribute('delete-userid');
//                     deleteUser(userId);
//                 });
//             });
//         })
//         .catch(error => console.error('Error fetching data:', error));

//     function deleteUser(userId) {
//         const confirmDelete = confirm('Are you sure you want to delete this user?');
//         if (!confirmDelete) {
//             return;
//         }

//         fetch(`/api/user?id=${userId}`, {
//             method: 'DELETE',
//         })
//             .then(response => {
//                 if (response.ok) {
//                     location.reload()
//                     console.log('User deleted successfully');
//                 } else {
//                     console.error('Error deleting user');
//                 }
//             })
//             .catch(error => {
//                 console.error('Error:', error);
//             });
//     }
// });

// document.addEventListener('DOMContentLoaded', function () {
//     const addUserForm = document.getElementById('addUserForm');

//     if (addUserForm) {
//         addUserForm.addEventListener('submit', function (event) {
//             event.preventDefault();

//             const name = document.getElementById('addName').value;
//             const email = document.getElementById('addEmail').value;
//             const phone = document.getElementById('addPhone').value;
//             const role = document.getElementById('addRole').value;
//             const pass = document.getElementById('addPassword').value;
//             const repeatPass = document.getElementById('addRepeatPassword').value;

//             if (pass.length < 8) {
//                 alert('Password must be at least 8 characters long.');
//                 return;
//             }

//             if (pass !== repeatPass) {
//                 alert('Passwords do not match.');
//                 return;
//             }

//             const formData = {
//                 name: name,
//                 email: email,
//                 phone: phone,
//                 user_role_id: role,
//                 password: pass,
//             };

//             fetch('/api/user', {
//                 method: 'POST',
//                 headers: {
//                     'Content-Type': 'application/json',
//                 },
//                 body: JSON.stringify(formData),
//             })
//                 .then(response => response.json())
//                 .then(data => {
//                     if (data.status === 'success') {
//                         window.location.href = '/user';
//                     } else {
//                         console.error('Error updating user:', data.message);
//                     }
//                 })
//                 .catch(error => {
//                     console.error('Error:', error);
//                 });
//         });
//     }
// });

// document.addEventListener('DOMContentLoaded', function () {
//     const editUserForm = document.getElementById('editUserForm');

//     if (editUserForm) {
//         const userId = getUserIdFromUrl();

//         fetch(`/api/user?id=${userId}`)
//             .then(response => response.json())
//             .then(data => {
//                 document.getElementById('editName').value = data.data.name;
//                 document.getElementById('editEmail').value = data.data.email;
//                 document.getElementById('editPhone').value = data.data.phone;
//                 document.getElementById('editRole').value = data.data.user_role_id;
//             })
//             .catch(error => console.error('Error fetching user data:', error));

//         editUserForm.addEventListener('submit', function (event) {
//             event.preventDefault();

//             const name = document.getElementById('editName').value;
//             const email = document.getElementById('editEmail').value;
//             const phone = document.getElementById('editPhone').value;
//             const role = document.getElementById('editRole').value;

//             console.log(document.getElementById('editRole').value);

//             const formData = {
//                 name: name,
//                 email: email,
//                 phone: phone,
//                 user_role_id: role,
//             };

//             fetch(`/api/user?id=${userId}`, {
//                 method: 'PUT',
//                 headers: {
//                     'Content-Type': 'application/json',
//                 },
//                 body: JSON.stringify(formData),
//             })
//                 .then(response => response.json())
//                 .then(data => {
//                     if (data.status === 'success') {
//                         window.location.href = '/user';
//                     } else {
//                         console.error('Error updating user:', data.message);
//                     }
//                 })
//                 .catch(error => {
//                     console.error('Error:', error);
//                 });
//         });
//     }

//     function getUserIdFromUrl() {
//         const url = new URL(window.location.href);

//         const userId = url.searchParams.get('id');

//         return userId;
//     }
//});


