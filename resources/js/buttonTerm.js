document.addEventListener("DOMContentLoaded", () => {
  const checkbox = document.getElementById("termsCheckbox");
  const button = document.getElementById("registerBtn");

  if (!checkbox || !button) return;

  checkbox.addEventListener("change", function () {
    if (this.checked) {
      button.disabled = false;

      button.classList.remove("bg-gray-400", "cursor-not-allowed");
      button.classList.add("bg-primary-lighter", "cursor-pointer");
    } else {
      button.disabled = true;

      button.classList.add("bg-gray-400", "cursor-not-allowed");
      button.classList.remove("bg-primary-lighter", "cursor-pointer");
    }
  });
});
