
var calendarEvents = reservations.map(reservation => ({
    title: `Restaurant ${reservation.restaurant_name}`,
    className: 'restaurant',
    date: reservation.date,
    startTime: reservation.session_start_time.split('.')[0], // Remove fractional seconds
    endTime: reservation.session_end_time.split('.')[0], // Remove fractional seconds
    location: reservation.restaurant_location
}));

const danceEvents = danceTicketsForAgenda.map(ticket => ({
    title: `Concert ${ticket.singer}`,
    className: 'dance',
    date: ticket.dateAndTime,
    startTime: ticket.startTime.split('.')[0],
    endTime: ticket.endTime.split('.')[0],
    location: ticket.location
}));

const historyEvents = historyTicketsForAgenda.map(ticket => {
    const dateAndTime = new Date(ticket.dateAndTime);

    // Calculate end time by adding 2 hours and 30 minutes
    const endTime = new Date(dateAndTime.getTime() + (2.5 * 60 * 60 * 1000)); // 2.5 hours in milliseconds

    return {
        title: `History Tour ${ticket.language}`,
        className: 'history',
        date: dateAndTime.toISOString().split('T')[0], // Extracts only the date part
        startTime: dateAndTime.toISOString().split('T')[1].slice(0, 8), // Extracts and formats the time part
        endTime: endTime.toISOString().split('T')[1].slice(0, 8), // Formats the new end time
        location: historyFirstRoute
    };
});



calendarEvents = calendarEvents.concat(danceEvents);
calendarEvents = calendarEvents.concat(historyEvents);


console.log(calendarEvents);

document.addEventListener('DOMContentLoaded', function () {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'timeGridWeek',
        initialDate: '2024-07-26',  // Set the initial date to July 26, 2024

        firstDay: 0,  // Sunday as the first day of the week
        slotLabelFormat: {
            hour: '2-digit',
            minute: '2-digit',
            slotDuration: '00:15:00',
            hour12: false
        },
        eventContent: function (arg) {
            // Create the HTML structure for the event content
            var title = document.createElement('b');
            title.textContent = arg.event.title;

            var details = document.createElement('div');
            details.textContent = `${arg.event.extendedProps.startTime} - ${arg.event.extendedProps.endTime}`;

            var location = document.createElement('div');
            location.textContent = `Location: ${arg.event.extendedProps.location}`;
            location.style.fontSize = '12px';  // Adjust font size as needed

            var arrayOfDomNodes = [title, details, location];
            return { domNodes: arrayOfDomNodes };
        },
        events: calendarEvents.map(event => ({
            title: event.title,
            start: `${event.date}T${event.startTime}`,
            end: `${event.date}T${event.endTime}`,
            extendedProps: {
                startTime: event.startTime,
                endTime: event.endTime,
                location: event.location
            },
            classNames: [event.className]
        })),
    });

    calendar.render();
});

