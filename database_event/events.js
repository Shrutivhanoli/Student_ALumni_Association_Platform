
// // Function to add event box to events-container with Remove button
// // function addEventBox(title, date, description, index) {
// //     const eventBox = document.createElement("div");
// //     eventBox.classList.add("event-box");
// //     eventBox.innerHTML = `
// //         <h2 class="event-title">${title}</h2>
// //         <p class="event-date">${new Date(date).toDateString()}</p>
// //         <p class="event-description">${description}</p>
// //         <a href="#" class="view-btn">View</a>
// //         <button class="remove-btn" onclick="removeEvent(${index})">Remove</button>
// //     `;
// //     document.getElementById("events-container").appendChild(eventBox);
// // }

// // Function to remove event from localStorage and UI
// function removeEvent(index) {
//     // Remove the event from eventDataArray
//     eventDataArray.splice(index, 1);

//     // Update localStorage
//     localStorage.setItem("eventData", JSON.stringify(eventDataArray));

//     // Refresh the displayed events
//     displayAllEvents();
// }

// // Retrieve event data from localStorage
// const eventDataArray = JSON.parse(localStorage.getItem("eventData")) || [];

// // Function to display all stored events
// function displayAllEvents() {
//     const container = document.getElementById("events-container");
//     container.innerHTML = ""; // Clear previous events
//     eventDataArray.forEach((eventData, index) => {
//         addEventBox(eventData.title, eventData.date, eventData.shortInfo, index);
//     });
// }

// // Initial display of all events when the page loads
// displayAllEvents();

// // Function to display events based on the selected date
// function displayEventsByDate(selectedDate) {
//     const container = document.getElementById("events-container");
//     container.innerHTML = ""; // Clear previous events
//     const filteredEvents = eventDataArray.filter(event => event.date === selectedDate);
//     filteredEvents.forEach((eventData, index) => {
//         addEventBox(eventData.title, eventData.date, eventData.shortInfo, index);
//     });
//     if (filteredEvents.length === 0) {
//         container.innerHTML = "<p>No events found for this date.</p>";
//     }
// }

// // Search function
// document.getElementById("search-form").addEventListener("submit", function (event) {
//     event.preventDefault();
//     const query = document.getElementById("search").value.toLowerCase();
//     const container = document.getElementById("events-container");
//     container.innerHTML = ""; // Clear previous events
//     const filteredEvents = eventDataArray.filter(event => event.title.toLowerCase().includes(query));
//     filteredEvents.forEach((eventData, index) => {
//         addEventBox(eventData.title, eventData.date, eventData.shortInfo, index);
//     });
//     if (filteredEvents.length === 0) {
//         container.innerHTML = "<p>No events found.</p>";
//     }
// });


document.addEventListener('DOMContentLoaded', function () {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'addEventButton'
        },
        customButtons: {
            addEventButton: {
                text: 'Add Event',
                click: function () {
                    var eventTitle = prompt('Enter Event Title:');
                    var eventDate = prompt('Enter Date (YYYY-MM-DD):');
                    if (eventTitle && eventDate) {
                        // Add event to FullCalendar
                        calendar.addEvent({
                            title: eventTitle,
                            start: eventDate,
                            allDay: true
                        });

                        // Save event in localStorage to persist between sessions
                        eventDataArray.push({ title: eventTitle, date: eventDate });
                        localStorage.setItem("eventData", JSON.stringify(eventDataArray));

                        alert('Event added!');
                    }
                }
            }
        },
        events: eventDataArray.map(event => ({
            title: event.title,
            start: event.date,
            allDay: true
        })),
        eventDisplay: 'block', // Show events as blocks within each day cell
        dayMaxEventRows: true,  // Enable showing multiple events with a "more" button if needed
        moreLinkClick: 'popover' // Show dropdown/popover for extra events
    });

    // Render the calendar
    calendar.render();
});

// Load events from localStorage upon page load
// const eventDataArray = JSON.parse(localStorage.getItem("eventData")) || [];

