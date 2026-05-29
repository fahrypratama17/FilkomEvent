import { debounce } from "./debounce";
import { createIcons, icons } from "lucide";

export function initSearch(eventList) {
  const searchInput = document.getElementById("searchInput");

  if (!searchInput) return;

  const handleSearch = debounce(() => {
    const query = searchInput.value;
    const params = new URLSearchParams(window.location.search);

    params.set("search", query);

    const url = `${window.location.pathname}?${params.toString()}`;

    eventList.innerHTML = `<p class="text-center col-span-3">Loading...</p>`;

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
