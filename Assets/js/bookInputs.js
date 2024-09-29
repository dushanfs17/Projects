// Add event listener to the form submission
document
  .getElementById("book-form")
  .addEventListener("submit", function (event) {
    // Get form fields
    const bookTitle = document.getElementById("book_title").value.trim();
    const bookPublishYear = document
      .getElementById("book_publish_year")
      .value.trim();
    const bookPages = document.getElementById("book_pages").value.trim();
    const bookImage = document.getElementById("book_image").value.trim();
    const bookAuthor = document.getElementById("book_author").value;
    const bookCategory = document.getElementById("book_category").value;

    // Validate form fields
    if (
      !bookTitle ||
      !bookPublishYear ||
      !bookPages ||
      !bookImage ||
      !bookAuthor ||
      !bookCategory
    ) {
      // Prevent form submission
      event.preventDefault();

      // Display error message using SweetAlert
      Swal.fire({
        icon: "error",
        title: "All fields are required!",
        text: "Please fill in all the fields before submitting the form.",
        confirmButtonText: "OK",
        confirmButtonColor: "#3085d6",
      });
    }
  });
