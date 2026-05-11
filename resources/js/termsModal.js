window.openTermsModal = function () {
  const modal = document.getElementById("termsModal");

  modal.classList.remove("hidden");
  modal.classList.add("flex");

  document.body.classList.add("overflow-hidden");
};

window.closeTermsModal = function () {
  const modal = document.getElementById("termsModal");

  modal.classList.add("hidden");
  modal.classList.remove("flex");

  document.body.classList.remove("overflow-hidden");
};

window.addEventListener("click", function (e) {
  const modal = document.getElementById("termsModal");

  if (e.targe === modal) {
    closeTermsModal();
  }
});
