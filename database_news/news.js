
// // Function to add event box to events-container with Remove button
// function addNewsBox(title, date, summary, index) {
//     const eventBox = document.createElement("div");
//     eventBox.classList.add("news-box");
//     eventBox.innerHTML = `
//         <h2 class="title">${title}</h2>
//         <p class="date">${new Date(date).toDateString()}</p>
//         <p class="short-info">${summary}</p>
//         <button class="read-btn">Read More</button>
//         <button class="remove-btn" onclick="removeEvent(${index})">Remove</button>
//     `;
//     document.getElementById("news-container").appendChild(newsBox);
// }

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
// const newsDataArray = JSON.parse(localStorage.getItem("newsData")) || [];

// // Function to display all stored events
// function displayAllNews() {
//     const container = document.getElementById("news-container");
//     container.innerHTML = ""; // Clear previous events
//     newsDataArray.forEach((newsData, index) => {
//         addNewsBox(newsData.title, newsData.date, newsData.summary, index);
//     });
// }

// // Initial display of all events when the page loads
// displayAllNews();

// // Function to display events based on the selected date
// // function displayEventsByDate(selectedDate) {
// //     const container = document.getElementById("events-container");
// //     container.innerHTML = ""; // Clear previous events
// //     const filteredEvents = eventDataArray.filter(event => event.date === selectedDate);
// //     filteredEvents.forEach((eventData, index) => {
// //         addEventBox(eventData.title, eventData.date, eventData.shortInfo, index);
// //     });
// //     if (filteredEvents.length === 0) {
// //         container.innerHTML = "<p>No events found for this date.</p>";
// //     }
// // }

// // Search function
// document.getElementById("search-form").addEventListener("submit", function (event) {
//     event.preventDefault();
//     const query = document.getElementById("search").value.toLowerCase();
//     const container = document.getElementById("news-container");
//     container.innerHTML = ""; // Clear previous events
//     const filteredNews = newsDataArray.filter(event => event.title.toLowerCase().includes(query));
//     filteredNews.forEach((newsData, index) => {
//         addNewsBox(newsData.title, newsData.date, newsData.summary, index);
//     });
//     if (filteredNews.length === 0) {
//         container.innerHTML = "<p>No news found.</p>";
//     }
// });


function addNewsBox(title, date, summary, index) {
    const newsBox = document.createElement("div");
    newsBox.classList.add("news-box");
    newsBox.innerHTML = `
        <h2 class="title">${title}</h2>
        <p class="date">${new Date(date).toDateString()}</p>
        <p class="short-info">${summary}</p>
        <div class = "btn-container">
        <button class="read-btn" onclick="readMore(${index})">Read More</button>
        <button class="remove-btn" onclick="removeNews(${index})">Remove</button>
        </div>
    `;
    document.getElementById("news-container").appendChild(newsBox);
}

function removeNews(index) {
    newsDataArray.splice(index, 1);
    localStorage.setItem("newsData", JSON.stringify(newsDataArray));
    displayAllNews();
}

const newsDataArray = JSON.parse(localStorage.getItem("newsData")) || [];

function displayAllNews() {
    const container = document.getElementById("news-container");
    container.innerHTML = ""; // Clear previous news
    newsDataArray.forEach((newsData, index) => {
        addNewsBox(newsData.title, newsData.date, newsData.summary, index);
    });
}

displayAllNews();

document.getElementById("search-form").addEventListener("submit", function (event) {
    event.preventDefault();
    const query = document.getElementById("search").value.toLowerCase();
    const container = document.getElementById("news-container");
    container.innerHTML = ""; // Clear previous news
    const filteredNews = newsDataArray.filter(news => news.title.toLowerCase().includes(query));
    filteredNews.forEach((newsData, index) => {
        addNewsBox(newsData.title, newsData.date, newsData.summary, index);
    });
    if (filteredNews.length === 0) {
        container.innerHTML = "<p>No news found.</p>";
    }
});


function readMore(index) {
    // Get the specific event object using the index
    const selectedNews = newsDataArray[index];

    // Store the selected event object in localStorage for access in view.html
    localStorage.setItem("selectedNews", JSON.stringify(selectedNews));

    // Open view.html in a new tab
    window.open("readMore.html", "_blank");
}
