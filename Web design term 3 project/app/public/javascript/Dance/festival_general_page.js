import ErrorHandler from '../Utilities/error_handler_class.js';
import { addEventListenersToContainer } from './order_tickets_dance_home.js';
const errorHandler = new ErrorHandler();

const ticketsContainer = document.getElementById('js_ticketDisplayContainer');
const artistSelect = document.getElementById('js_artists');
const filterRadios = document.querySelectorAll('input[name="filter"]');

document.addEventListener("DOMContentLoaded", () => {

    setTheListenersOnButtons();

    artistSelect.addEventListener('change', function () {
        const selectedArtist = this.value;

        // Clear existing tickets
        ticketsContainer.innerHTML = '';

        // Filter tickets by the selected artist
        if (selectedArtist === 'All_Artists') {
            generateTickets(danceTickets);
            return;
        }

        let filteredTickets = danceTickets.filter(ticket => {
            // Normalize the names by converting to lowercase for case-insensitive comparison
            const singers = ticket.singer.toLowerCase();
            const normalizedSelectedArtist = selectedArtist.toLowerCase();

            // Check if selectedArtist is 'All Artists' or if the ticket's singer string contains the selected artist
            return normalizedSelectedArtist === 'all_artists' || singers.includes(normalizedSelectedArtist);
        });

        generateTickets(filteredTickets);
    });


    filterRadios.forEach(radio => {
        radio.addEventListener('change', function () {
            const selectedFilter = this.value;

            // Clear existing tickets
            ticketsContainer.innerHTML = '';

            // Determine the type of filter based on the value pattern
            if (selectedFilter.includes('.')) {
                filterTicketsByDate(selectedFilter);
            } else {
                // Filter tickets by the selected location
                filterTicketsByLocation(selectedFilter);
            }
        });
    });

    function filterTicketsByDate(date) {
        let filteredTickets = danceTickets.filter(ticket => {
            const ticketDate = new Date(ticket.dateAndTime);
            const formattedDate = `${(ticketDate.getMonth() + 1).toString().padStart(2, '0')}.${ticketDate.getDate().toString().padStart(2, '0')}`;
            console.log(formattedDate);
            return formattedDate === date;
        });
        generateTickets(filteredTickets);
    }

    function filterTicketsByLocation(location) {
        let filteredTickets = danceTickets.filter(ticket => ticket.location.toLowerCase() === location.toLowerCase());
        generateTickets(filteredTickets);
    }

    document.getElementById('js_resetFiltersButton').addEventListener('click', () => {
        generateTickets(danceTickets);
    });

});

function generateTickets(filteredTickets) {
    filteredTickets.forEach(ticket => {

        const date = new Date(ticket.dateAndTime);

        // Format the date using toLocaleDateString with options for day, month, and weekday
        const displayDate = date.toLocaleDateString('en-US', {
            day: '2-digit', // Two digit day
            month: 'short', // Abbreviated month
            weekday: 'long' // Full name of the day of the week
        }).toUpperCase(); // Convert the formatted string to uppercase

        const startTime = formatTime(ticket.startTime);
        const endTime = formatTime(ticket.endTime);
        const formattedPrice = parseFloat(ticket.price).toFixed(2);

        const ticketHTML = `
                <div id="js_ticketDanceContainer_${ticket.D_TicketID}" class="bg-gray-900 p-6 rounded-lg shadow-lg text-white flex flex-col w-full mx-auto border border-blue-900">
                    <div class="flex-1 mb-4">
                        <div class="text-2xl font-bold mb-2 text-center lg:text-left">${ticket.singer}</div>
                        <div class="flex justify-center items-center space-x-4 lg:space-x-10">
                            <div class="text-center">
                                <div class="font-semibold">Location</div>
                                <div>📍 ${ticket.location}</div>
                            </div>
                            <div class="text-center">
                                <div class="font-semibold">Date & Time</div>
                                <div>${displayDate}</div>
                                <div>${startTime} - ${endTime}</div>
                            </div>
                            <div class="text-center">
                                <div class="font-semibold">Session</div>
                                <div>${ticket.sessionType}</div>
                            </div>
                            <div class="text-center">
                                <div class="font-semibold">Price</div>
                                <div>€ ${formattedPrice}</div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 flex justify-end items-center space-x-2">
                        <button class="js_decreaseTicketQuantityButton bg-gray-700 p-1 rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <i class="fas fa-minus text-white text-xs"></i>
                        </button>
                        <span class="js_ticketQuantity">1</span>
                        <button class="js_increaseTicketQuantityButton bg-gray-700 p-1 rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <i class="fas fa-plus text-white text-xs"></i>
                        </button>
                        <button data-ticket-id="${ticket.D_TicketID}"  data-order-id="${order.orderID}"  class="js_addTicketToCartButton bg-blue-500 py-1 px-4 rounded-lg font-bold text-white text-sm hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            Add ticket to cart
                        </button>
                    </div>
                </div>
            `;

        ticketsContainer.innerHTML += ticketHTML;

        let ticketContainers = document.querySelectorAll("[id^=js_ticketDanceContainer_]");
        addEventListenersToContainer(ticketContainers);
    });
}

function updateArtistDisplay(dateFilter) {
    const container = document.getElementById('js_containerForArtistSchedule');
    container.innerHTML = ''; // Clear existing content

    // Filter danceTickets based on dateFilter, if it's not 'ALL'
    const filteredTickets = dateFilter === 'ALL' ? danceTickets : danceTickets.filter(ticket => {
        const ticketDate = new Date(ticket.dateAndTime);
        const formattedDate = `${(ticketDate.getMonth() + 1).toString().padStart(2, '0')}-${ticketDate.getDate().toString().padStart(2, '0')}`;
        return formattedDate === dateFilter;
    });

    // Loop over filtered danceTickets and create HTML for each
    filteredTickets.forEach(ticket => {

        let imagePathOfArtist = ''; // Initialize the image path variable

        danceTickets.forEach(ticket => {
            const singerNameLower = ticket.singer.toLowerCase();
            artists.forEach(artist => {
                const artistNameLower = artist.name.toLowerCase();
                // Check if the first word of the singer's name is in the artist's name
                if (artistNameLower.includes(singerNameLower.split(' ')[0])) {
                    imagePathOfArtist = artist.imageArtistLineupPath;
                }
            });
        });

        const imagePath = imagePathOfArtist;
        const startTime = formatTime(ticket.startTime);
        const endTime = formatTime(ticket.endTime);

        const artistHtml = `
                <div class="artist-container">
                    <img class="w-full h-48 object-cover rounded" src="${imagePath}" alt="Artist">
                    <p class="mt-2">${ticket.singer}</p>
                    <p class="text-xs">${startTime} - ${endTime}</p>
                    <p class="text-xs">${ticket.location.toUpperCase()}</p>
                </div>
            `;
        container.innerHTML += artistHtml; // Append new artist container
    });
}

function formatTime(timeStr) {
    return timeStr.substring(0, 5); // Gets only the "HH:MM" part of "HH:MM:SS.0000000"
}

function setActiveButton(activeButtonId) {
    // List all button IDs
    const buttonIds = ['js_allEventsButton', 'js_26EventsButton', 'js_27EventsButton', 'js_28EventsButton'];

    // Reset styles for all buttons and set active style for the clicked one
    buttonIds.forEach(id => {
        const button = document.getElementById(id);
        if (id === activeButtonId) {
            button.className = 'bg-red-800 hover:bg-red-700 text-white font-bold py-2 px-4 rounded';
        } else {
            button.className = 'bg-gray-800 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded';
        }
    });
}

function setTheListenersOnButtons() {
    // Event listeners for each button
    document.getElementById('js_allEventsButton').addEventListener('click', () => {
        updateArtistDisplay('ALL');
        setActiveButton('js_allEventsButton');
    });
    document.getElementById('js_26EventsButton').addEventListener('click', () => {
        updateArtistDisplay('07-26');
        setActiveButton('js_26EventsButton');
    });
    document.getElementById('js_27EventsButton').addEventListener('click', () => {
        updateArtistDisplay('07-27');
        setActiveButton('js_27EventsButton');
    });
    document.getElementById('js_28EventsButton').addEventListener('click', () => {
        updateArtistDisplay('07-28');
        setActiveButton('js_28EventsButton');
    });
}
