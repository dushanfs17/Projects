// Filter books by category
document
  .getElementById("category-form")
  .addEventListener("submit", function (e) {
    e.preventDefault();

    var check = Array.from(
      this.querySelectorAll('input[name="category[]"]:checked')
    );
    var values = check.map((box) => box.value).join(",");
    var baseUrl = window.location.href.split("?")[0];
    window.location.href = baseUrl + "?category=" + values;
  });
