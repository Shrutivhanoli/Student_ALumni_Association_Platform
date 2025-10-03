function addEvent() {
    const title = document.getElementById("event-title").value;
    const shortInfo = document.getElementById("short-description").value;
    const detailedInfo = document.getElementById("detailed-description").value;
    const date = document.getElementById("event-date").value;

    const eventData = {
        title,
        shortInfo,
        detailedInfo,
        date
    };
    localStorage.setItem("eventData", JSON.stringify(eventData));

    // Redirect to news.html to display the news
    window.location.href = "events.html";
}