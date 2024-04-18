let cuisineTypes = []; // will hold the current state of cuisine types

export function initializeCuisineTypes() {
    // Populate the initial cuisineTypes array from the HTML
    document.querySelectorAll('.cuisine-type').forEach(element => {
        cuisineTypes.push(element.textContent);
    });
}

function updateCuisineDisplay() {
    const container = document.querySelector('.container-cuisine-types');
    container.innerHTML = ''; // Clear existing content
    cuisineTypes.forEach(type => {
        // Create the container for the cuisine type
        const typeElement = document.createElement('div');
        typeElement.className = 'bg-gray-300 rounded-full m-1 flex items-center';

        // Create the paragraph element for displaying the type
        const typeParagraph = document.createElement('p');
        typeParagraph.className = 'cuisine-type text-lg font-semibold text-black-500 bg-gray-300 rounded-full px-2 py-1 m-1';
        typeParagraph.textContent = DOMPurify.sanitize(type);  // may cause an error if DOMPurify is not imported via CDN

        // Create the delete button
        const deleteButton = document.createElement('button');
        deleteButton.className = 'delete-cuisine-btn py-1 px-2 bg-red-500 text-white rounded-full hover:bg-red-700 transition duration-150';
        deleteButton.textContent = 'Delete';

        // Add an event listener to the delete button
        deleteButton.addEventListener('click', function () {
            deleteCuisineType(type);
        });

        // Append the paragraph and button to the type element
        typeElement.appendChild(typeParagraph);
        typeElement.appendChild(deleteButton);

        // Append the type element to the container
        container.appendChild(typeElement);
    });
}

function addCuisineType(newType) {
    if (newType && !cuisineTypes.includes(newType)) {
        cuisineTypes.push(newType);
        updateCuisineDisplay();
        sendCuisineUpdate();
    }
}

export function deleteCuisineType(cuisineType) {
    const index = cuisineTypes.indexOf(cuisineType);
    if (index > -1) {
        cuisineTypes.splice(index, 1);
        updateCuisineDisplay();
        sendCuisineUpdate();
    }
}

function sendCuisineUpdate() {
    const container = document.getElementById("container-restaurant-info");
    const id = container.getAttribute('data-id');

    let trimmedCuisineTypes = cuisineTypes.map(type => type.trim());
    let cuisineString = trimmedCuisineTypes.join(';');

    const data = JSON.stringify({
        restaurantID: id,
        cuisineTypes: cuisineString
    });

    fetch('/api/restaurantIndividualAdmin/updateRestaurantCuisineTypes', {
        method: 'PATCH',
        headers: {
            'Content-Type': 'application/json'
        },
        body: data
    })
        .then(response => response.json())
        .then(data => console.log('Success:', data))
        .catch((error) => {
            console.error('Error:', error);
        });
}

export function addCuisine() {
    const addButton = document.getElementById('add-cuisine-btn');
    addButton.addEventListener('click', function () {
        const newTypeInput = document.getElementById('new-cuisine-type');
        const newType = newTypeInput.value.trim(); // Get the new type from the input field and trim any whitespace
        addCuisineType(newType);
        newTypeInput.value = ''; // Clear the input field after adding
    });

}


