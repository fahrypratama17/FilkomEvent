window.toggleBookmark = function (eventId, el) {
  const wasBookmarked = el.classList.contains("bg-orange-550");
  const bookmarkPage = document
    .getElementById("eventList")
    ?.getAttribute("data-page") === "bookmark";

  fetch(`/bookmark/${eventId}`, {
    method: "POST",
    headers: {
      "X-CSRF-TOKEN": document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content"),
      "Content-Type": "application/json",
    },
  })
    .then((res) => res.json())
    .then(() => {
      el.classList.remove("bookmark-animate");
      void el.offsetWidth;
      el.classList.add("bookmark-animate");

      const icon = el.querySelector("i");

      if (el.classList.contains("bg-white")) {
        el.classList.remove("bg-white");
        el.classList.add("bg-orange-550", "text-white");
        icon.classList.add("fill-white");
      } else {
        el.classList.remove("bg-orange-550", "text-white");
        el.classList.add("bg-white");
        icon.classList.remove("fill-white");
      }

      if (bookmarkPage && wasBookmarked) {
        el.closest("article")?.remove();

        if (typeof window.showToast === "function") {
          window.showToast("Berhasil", "Bookmark dihapus", "success", 3000);
        }

        const list = document.getElementById("eventList");
        const emptyMessage = document.getElementById("bookmark-empty");
        if (list && emptyMessage && list.querySelectorAll("article").length === 0) {
          emptyMessage.classList.remove("hidden");
        }
      }
    });
};
