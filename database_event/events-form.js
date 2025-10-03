// function addEvent() {
//     const title = document.getElementById("event-title").value;
//     const shortInfo = document.getElementById("short-description").value;
//     const detailedInfo = document.getElementById("detailed-description").value;
//     const date = document.getElementById("event-date").value;

//     const eventData = {
//         title,
//         shortInfo,
//         detailedInfo,
//         date
//     };
//     localStorage.setItem("eventData", JSON.stringify(eventData));

//     // Redirect to news.html to display the news
//     window.location.href = "events.php";
// }

function addEvent() {
    const title = document.getElementById("event-title").value;
    const shortInfo = document.getElementById("short-description").value;
    const detailedInfo = document.getElementById("detailed-description").value;
    const date = document.getElementById("event-date").value;

    // Retrieve existing events from localStorage or initialize as an empty array
    const existingEvents = JSON.parse(localStorage.getItem("eventData")) || [];

    // Create a new event object
    const newEvent = {
        title,
        shortInfo,
        detailedInfo,
        date
    };

    // Add the new event to the existing events array
    existingEvents.push(newEvent);

    // Save the updated events array back to localStorage
    localStorage.setItem("eventData", JSON.stringify(existingEvents));

    // Redirect to events.html to display the events
    window.location.href = "events.php";

    return false; // Prevent the default form submission 
}