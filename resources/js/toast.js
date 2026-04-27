function showToast(title, message, type = "error", duration = 4000) {
  const container = document.getElementById("toast-container");
  if (!container) return;

  const toast = document.createElement("div");

  let bgColor = type === "success" ? "bg-green-500" : "bg-red-500";

  toast.className = `${bgColor} w-full max-w-[500px] relative overflow-hidden text-white px-6 py-3 rounded-lg shadow-lg transition-all duration-300 transform translate-x-full opacity-0`;
  toast.innerHTML = `
    <div class="overflow-hidden">
      <div class="pr-4 text-xl">${title}</div>
      <div class="pr-4">${message}</div>
      <div class="absolute bottom-0 left-0 h-1 bg-white/50 progress-bar"></div>
    </div>
  `;

  container.appendChild(toast);
  const progressBar = toast.querySelector(".progress-bar");

  setTimeout(() => {
    toast.classList.remove("translate-x-full", "opacity-0");
  }, 100);

  progressBar.style.width = "100%";
  progressBar.style.transition = `width ${duration}ms linear`;

  setTimeout(() => {
    progressBar.style.width = "0%";
  }, 100);

  setTimeout(() => {
    toast.classList.add("opacity-0", "translate-x-full");

    setTimeout(() => toast.remove(), 500);
  }, duration);
}

window.addEventListener("DOMContentLoaded", () => {
  if (window.toastError) {
    window.toastError.forEach((err) =>
      showToast("Terjadi Kesalahan", err, "error", 5000),
    );
  }

  if (window.toastSuccess) {
    showToast("Berhasil", window.toastSuccess, "success", 3000);
  }
});
