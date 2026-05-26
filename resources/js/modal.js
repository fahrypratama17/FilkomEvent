document.addEventListener("DOMContentLoaded", () => {
  const modal = document.getElementById("delete-modal");
  const closeButton = document.getElementById("close-delete-modal");

  const deleteForm = document.getElementById("delete-form");
  const eventTitle = document.getElementById("delete-event-title");

  const deleteButtons = document.querySelectorAll(".delete-button");

  deleteButtons.forEach((button) => {
    button.addEventListener("click", () => {
      const url = button.dataset.url;
      const title = button.dataset.title;

      deleteForm.action = url;
      eventTitle.textContent = title;

      modal.classList.remove("hidden");
      modal.classList.add("flex");
    });
  });

  function closeModal() {
    modal.classList.remove("flex");
    modal.classList.add("hidden");

    deleteForm.action = "";
    eventTitle.textContent = "";
  }

  closeButton.addEventListener("click", closeModal);

  modal.addEventListener("click", (e) => {
    if (e.target === modal) {
      closeModal();
    }
  });
});
