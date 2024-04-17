function handleEditableFieldsForTicketPrices(button, updateFunction) {
    const container = button.closest("div[data-id]");
    const editableTextElements = container.querySelectorAll(".editable");
    const editableInputElements = container.querySelectorAll(".editable-price"); // Selecting price inputs
    const isEditing = container.getAttribute("data-editing");
    const id = container.getAttribute("data-id");

    if (isEditing === "true") {
        // Switch off editing and update information
        editableTextElements.forEach(el => {
            el.contentEditable = 'false';
        });
        editableInputElements.forEach(input => {
            input.readOnly = true; // Make inputs read-only
        });

        let ticketType = editableTextElements[0].innerText; // Assuming the first editable is the type
        let price = editableInputElements[0].value; // Assuming the first input is the price
        let description = editableTextElements[1].innerText; // Assuming the second editable is the description

        button.textContent = "Edit";
        container.removeAttribute("data-editing");
        // Update ticket information
        updateFunction(id, price, ticketType, description);
    } else {
        // Enable editing
        editableTextElements.forEach(el => {
            el.contentEditable = 'true';
        });
        editableInputElements.forEach(input => {
            input.readOnly = false; // Allow inputs to be edited
        });
        button.textContent = "Save";
        container.setAttribute("data-editing", "true");
    }
}

function updateHistoryTicketPrices(id, price, type, description) {
    fetch("/api/historyadmin/updateHistoryTicketPricesInformation", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify({
            informationID: id,
            price: price,
            type: type,
            description: description,
        }),
    })
        .then((response) => response.json())
        .then((data) => {
            console.log(data);
            // You can handle success or failure here, e.g., by showing a message to the user
        })
        .catch((error) => {
            console.error("Error:", error);
            alert("There was an error updating the ticket price");
        });

}

export { handleEditableFieldsForTicketPrices, updateHistoryTicketPrices };