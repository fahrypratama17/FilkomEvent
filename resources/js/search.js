import { debounce } from "./debounce";
import { createIcons, icons } from "lucide";

export function initSearch(eventList) {
  const searchInput = document.getElementById("searchInput");

  if (!searchInput) return;

  const handleSearch = debounce(() => {
    const query = searchInput.value;

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
        eventList.innerHTML = html;
        createIcons({ icons });
      });
  }, 500);

  searchInput.addEventListener("input", handleSearch);
}
