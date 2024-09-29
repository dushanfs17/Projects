document.addEventListener("DOMContentLoaded", () => {
  const requestOptions = {
    method: "GET",
    redirect: "follow",
  };

  // Function to fetch and update the quote
  function fetchQuote() {
    fetch("https://api.quotable.io/random", requestOptions)
      .then((response) => response.json())
      .then((data) => {
        // Check if the data contains the quote and author
        if (data && data.content && data.author) {
          const quote = `${data.content}`;
          const author = `- ${data.author}`;
          const quoteElement = document.querySelector("#quote");
          // Update the content of the #quote element
          if (quoteElement) {
            // Update the content of the #quote element
            quoteElement.innerText = `${quote} ${author}`;
          }
        }
      })
      // If an error occurs, display an error message
      .catch((error) => {
        console.error("Error fetching quote:", error);
        const quoteElement = document.querySelector("#quote");
        if (quoteElement) {
          quoteElement.innerText = "Quote not available.";
        }
      });
  }

  // Fetch a new quote every time the page is loaded or refreshed
  fetchQuote();
});
