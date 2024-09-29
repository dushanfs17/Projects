// Handle delete confirmation with Sweet Alert
document.addEventListener("DOMContentLoaded", function () {
  const deleteForms = document.querySelectorAll(".delete-form");

  // Function to handle delete confirmation
  deleteForms.forEach(function (form) {
    form.addEventListener("submit", function (e) {
      e.preventDefault();

      Swal.fire({
        // Display the confirmation alert
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
      }).then((result) => {
        if (result.isConfirmed) {
          // Display the success alert first
          Swal.fire({
            title: "Deleted!",
            text: "Successfully deleted.",
            icon: "success",
          }).then(() => {
            // Then submit the form after the success alert is closed
            form.submit();
          });
        }
      });
    });
  });
});
