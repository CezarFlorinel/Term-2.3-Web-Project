




var calendarEvents = [
    { title: 'History', date: '2024-07-27', startTime: '10:00', endTime: '15:00', paid: true, location: 'Conference Room A' },
    { title: 'Dance', date: '2024-07-28', startTime: '15:00', endTime: '16:00', paid: false, location: 'Online via Zoom' },
    { title: 'Restaurant', date: '2024-07-28', startTime: '15:00', endTime: '16:00', paid: false, location: 'Online via Zoom' },
    { title: 'Restaurant', date: '2024-07-26', startTime: '15:00', endTime: '16:00', paid: false, location: 'Online via Zoom' }
];




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
            details.textContent = `${arg.event.extendedProps.startTime} - ${arg.event.extendedProps.endTime}, ${arg.event.extendedProps.paid ? 'Paid' : 'Unpaid'}`;

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
                paid: event.paid,
                location: event.location
            },
            classNames: [event.title.toLowerCase().replace(/\s+/g, '')]
        })),
    });

    calendar.render();
});

