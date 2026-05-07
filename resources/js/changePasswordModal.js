const openBtn = document.getElementById("openPasswordModal");
const closeBtn = document.getElementById("closePasswordModal");
const modal = document.getElementById("passwordModal");

openBtn?.addEventListener("click", () => {
  modal.classList.remove("hidden");
});

closeBtn?.addEventListener("click", () => {
  modal.classList.add("hidden");
});

modal?.addEventListener("click", (e) => {
  if (e.target === modal) modal.classList.add("hidden");
});
