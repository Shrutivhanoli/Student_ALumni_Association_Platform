// const eventData = JSON.parse(localStorage.getItem("eventData"));
// if (eventData) {
//     const eventBox = document.createElement("div");
//     eventBox.classList.add("event-box");
//     eventBox.innerHTML = `
//         <h1 class="event-title">${eventData.title}</h2>
//         <p class = "event-date">${eventData.date}</p>
//         <p class="event-description">${eventData.shortInfo}</p>
//         <a href="#" class="view-btn">View</a>
//     `;

//     document.getElementById("events-container").appendChild(eventBox);
//     localStorage.removeItem("newsData");
// }

// Function to add event box to events-container with Remove button
function addEventBox(title, date, description, index) {
    const eventBox = document.createElement("div");
    eventBox.classList.add("event-box");
    eventBox.innerHTML = `
        <h2 class="event-title">${title}</h2>
        <p class="event-date">${new Date(date).toDateString()}</p>
        <p class="event-description">${description}</p>
        <a href="#" class="view-btn">View</a>
        <button class="remove-btn" onclick="removeEvent(${index})">Remove</button>
    `;
    document.getElementById("events-container").appendChild(eventBox);
}

// Function to remove event from localStorage and UI
function removeEvent(index) {
    // Remove the event from eventDataArray
    eventDataArray.splice(index, 1);

    // Update localStorage
    localStorage.setItem("eventData", JSON.stringify(eventDataArray));

    // Refresh the displayed events
    displayAllEvents();
}

// Retrieve event data from localStorage
const eventDataArray = JSON.parse(localStorage.getItem("eventData")) || [];

// Function to display all stored events
function displayAllEvents() {
    const container = document.getElementById("events-container");
    container.innerHTML = ""; // Clear previous events
    eventDataArray.forEach((eventData, index) => {
        addEventBox(eventData.title, eventData.date, eventData.shortInfo, index);
    });
}

// Initial display of all events when the page loads
displayAllEvents();

// Function to display events based on the selected date
function displayEventsByDate(selectedDate) {
    const container = document.getElementById("events-container");
    container.innerHTML = ""; // Clear previous events
    const filteredEvents = eventDataArray.filter(event => event.date === selectedDate);
    filteredEvents.forEach((eventData, index) => {
        addEventBox(eventData.title, eventData.date, eventData.shortInfo, index);
    });
    if (filteredEvents.length === 0) {
        container.innerHTML = "<p>No events found for this date.</p>";
    }
}

// Search function
document.getElementById("search-form").addEventListener("submit", function (event) {
    event.preventDefault();
    const query = document.getElementById("search").value.toLowerCase();
    const container = document.getElementById("events-container");
    container.innerHTML = ""; // Clear previous events
    const filteredEvents = eventDataArray.filter(event => event.title.toLowerCase().includes(query));
    filteredEvents.forEach((eventData, index) => {
        addEventBox(eventData.title, eventData.date, eventData.shortInfo, index);
    });
    if (filteredEvents.length === 0) {
        container.innerHTML = "<p>No events found.</p>";
    }
});
