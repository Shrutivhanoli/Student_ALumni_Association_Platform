function addNews() {
    const title = document.getElementById("title").value;
    const summary = document.getElementById("short-info").value;
    const detailedescr = document.getElementById("detailed-descr").value;
    const date = document.getElementById("date").value;

    const newsData = {
        title,
        summary,
        detailedescr,
        date
    };
    localStorage.setItem("newsData", JSON.stringify(newsData));

    // Redirect to news.html to display the news
    window.location.href = "news.html";
}

// document.getElementById("news-form").addEventListener("submit", function (event) {
//     event.preventDefault();

//     const title = document.getElementById("title").value;
//     const summary = document.getElementById("short-info").value;
//     const detailedDescr = document.getElementById("detailed-descr").value;
//     const date = document.getElementById("date").value;

//     const newsData = { title, summary, detailedDescr, date };

//     // Retrieve existing news and add new news
//     const existingNews = JSON.parse(localStorage.getItem("newsData")) || [];
//     existingNews.push(newsData);
//     localStorage.setItem("newsData", JSON.stringify(existingNews));

//     // Redirect to news.html to display the news
//     window.location.href = "news.html";
// });
