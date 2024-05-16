let selectedLanguage = null;
let quantity = 0;
let ticketType = 'regular';
let ticketPrice = 0;
let totalPrice = 0;
let date = null;
let time = null;
let filteredToursByLanguage = [];
let filteredToursByDate = [];
let filteredToursByTime = [];


// JavaScript code for selecting a flag
document.addEventListener('DOMContentLoaded', () => {
    addEventListenerToFlags();

    document.getElementById('js_minusQuantityButton').addEventListener('click', () => {
        changeNumberOfTickets(-1);
    });

    document.getElementById('js_addQuantityButton').addEventListener('click', () => {
        changeNumberOfTickets(1);
    });
});


function addEventListenerToFlags() {
    const flagContainer = document.querySelector('.form-group.flag-icons .flex');
    const flags = Array.from(flagContainer.querySelectorAll('img'));

    flags.forEach(flag => {
        // Clone the node to remove existing event listeners
        const newFlag = flag.cloneNode(true);
        flagContainer.replaceChild(newFlag, flag);

        newFlag.addEventListener('click', () => {
            // Remove the selected class from all flags (use the new flags collection)
            const newFlags = flagContainer.querySelectorAll('img');
            newFlags.forEach(f => f.classList.remove('selected-flag'));

            // Add the selected class to the clicked flag
            newFlag.classList.add('selected-flag');

            // Update the selected language
            selectedLanguage = newFlag.alt;

            filterToursByLanguage();
        });
    });
}

function filterToursByLanguage() {
    filteredToursByLanguage = [];
    // Iterate over the tours object and filter based on selected language
    Object.values(tours).forEach(tour => {
        if (selectedLanguage === 'English' && tour.englishTour >= 1) {
            filteredToursByLanguage.push(tour);
        } else if (selectedLanguage === 'Dutch' && tour.dutchTour >= 1) {
            filteredToursByLanguage.push(tour);
        } else if (selectedLanguage === 'Chinese' && tour.chineseTour >= 1) {
            filteredToursByLanguage.push(tour);
        }
    });

    console.log('Filtered tours by language:', filteredToursByLanguage);
    enableDates();
}

function enableDates() {
    // Disable all date buttons initially
    const dateButtons = document.querySelectorAll('#date-group button');
    dateButtons.forEach(button => {
        button.disabled = true;
        // Clone the button to remove existing event listeners
        const newButton = button.cloneNode(true);
        button.parentNode.replaceChild(newButton, button);
    });

    // Collect available dates from filtered tours
    const availableDates = new Set(filteredToursByLanguage.map(tour => new Date(tour.date).getDate()));

    // Enable only the buttons for the available dates
    availableDates.forEach(date => {
        const dateButton = document.getElementById(`js_date${date}`);
        if (dateButton) {
            dateButton.disabled = false;
            dateButton.addEventListener('click', () => selectDate(date, dateButton));
        }
    });
}


function selectDate(selectedDate, dateButton) {

    const dateButtons = document.querySelectorAll('#date-group button');
    dateButtons.forEach(button => button.classList.add('active'));
    dateButton.classList.remove('active');

    date = selectedDate;
    console.log('Selected date:', date);


    // Enable times based on selected date
    filterToursByDate(date);
}

function filterToursByDate(date) {

    filteredToursByDate = [];
    // Iterate over the tours object and filter based on selected date
    filteredToursByLanguage.forEach(tour => {
        if (new Date(tour.date).getDate() === date) {
            filteredToursByDate.push(tour);
        }
    });

    console.log('Filtered tours by date:', filteredToursByDate);
    enableTimes();
}

function enableTimes() {
    // Disable all time buttons initially
    const timeButtons = document.querySelectorAll('#time-group button');
    timeButtons.forEach(button => {
        button.disabled = true;
        // Clone the button to remove existing event listeners
        const newButton = button.cloneNode(true);
        button.parentNode.replaceChild(newButton, button);
    });

    // Collect available start times from filtered tours
    const availableTimes = new Set(filteredToursByDate.map(tour => tour.startTime));

    // Enable only the buttons for the available start times
    timeButtons.forEach(button => {
        const time = button.innerText;
        if (availableTimes.has(`${time}:00.0000000`)) {
            button.disabled = false;
            button.addEventListener('click', () => selectTime(time, button));
        }
    });
}

function selectTime(selectedTime, timeButton) {
    const timeButtons = document.querySelectorAll('#time-group button');
    timeButtons.forEach(button => button.classList.remove('active'));
    timeButton.classList.add('active');

    console.log('Selected time:', selectedTime);
}




function changeNumberOfTickets(amount) {
    const numberOfTicketsInput = document.getElementById('js_number-of-tickets');
    let currentValue = parseInt(numberOfTicketsInput.value, 10);

    // Ensure the current value is a valid number
    if (isNaN(currentValue)) {
        currentValue = 0;
    }

    // Update the value
    const newValue = currentValue + amount;

    // Ensure the value does not go below 0
    if (newValue >= 0) {
        numberOfTicketsInput.value = newValue;
    }
}