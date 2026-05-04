import { createIcons, icons } from "lucide";

function debounce(func, delay = 500) {
  let timeout;
  return function (...args) {
    clearTimeout(timeout);
    timeout = setTimeout(() => func.apply(this, args), delay);
  };
}

const searchInput = document.getElementById("searchInput");

if (searchInput) {
  searchInput.addEventListener(
    "input",
    debounce(function () {
      const query = this.value;

      const isBookmarkPage = window.location.pathname.includes("bookmark");

      const url = isBookmarkPage
        ? `/bookmark?search=${query}`
        : `/events?search=${query}`;

      fetch(url, {
        headers: {
          "X-Requested-With": "XMLHttpRequest",
        },
      })
        .then((res) => res.text())
        .then((html) => {
          document.querySelector("#eventList").innerHTML = html;
          createIcons({ icons });
        });
    }),
  );
}
