document.addEventListener("DOMContentLoaded", () => {
  const form = document.getElementById("author-form");

  form.addEventListener("submit", (e) => {
    const firstName = document.getElementById("author_first_name").value;
    const lastName = document.getElementById("author_last_name").value;
    const shortBio = document.getElementById("author_biography").value;

    let errorMessage = "";

    // Validate inputs
    if (firstName.length < 2) {
      errorMessage += "First name must be at least 2 characters long.\n";
    }

    if (lastName.length < 4) {
      errorMessage += "Last name must be at least 4 characters long.\n";
    }

    if (shortBio.length < 20) {
      errorMessage += "Author biography must be at least 20 characters long.\n";
    }

    if (errorMessage) {
      // Prevent refresh if there is errors
      e.preventDefault();
      Swal.fire({
        icon: "error",
        title: "Validation Error",
        text: errorMessage,
      });
    }
  });
});
