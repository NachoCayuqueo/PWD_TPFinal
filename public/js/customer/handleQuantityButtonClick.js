$(document).ready(function () {
  $("#button-minus").on("click", function () {
    const inputValue = $("#quantity").val();
    const newValue = parseInt(inputValue) - 1;
    if (newValue >= 0) {
      $("#quantity").val(newValue);
    }
  });

  $("#button-plus").on("click", function () {
    const inputValue = $("#quantity").val();
    const newValue = parseInt(inputValue) + 1;
    $("#quantity").val(newValue);
  });
});
