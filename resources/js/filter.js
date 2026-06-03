import { createIcons, icons } from "lucide";

export function initFilters(eventList) {
  const categoryFilter = document.getElementById("categoryFilter");
  const statusFilter = document.getElementById("statusFilter");
  const searchInput = document.getElementById("searchInput");

  function setLoading() {
    const skeleton = document.getElementById("eventListSkeleton");
    if (skeleton) {
      skeleton.classList.remove("hidden");
      eventList.classList.add("hidden");
      return;
    }

    eventList.innerHTML = `<p class="text-center col-span-3">Loading...</p>`;
  }

  function fetchEvents(urlOverride = null) {
    const search = searchInput ? searchInput.value : "";
    const category = categoryFilter ? categoryFilter.value : "";
    const status = statusFilter ? statusFilter.value : "";

    const params = new URLSearchParams({
      search,
      category,
      status,
    });

    const url = typeof urlOverride === "string" ? urlOverride : `?${params.toString()}`;

    setLoading();

    fetch(url, {
      headers: {
        "X-Requested-With": "XMLHttpRequest",
      },
    })
      .then((res) => res.text())
      .then((html) => {
        eventList.innerHTML = html;
        createIcons({ icons });

        const skeleton = document.getElementById("eventListSkeleton");
        if (skeleton) {
          skeleton.classList.add("hidden");
          eventList.classList.remove("hidden");
        }
      })
      .catch(() => {
        eventList.innerHTML = `
          <p class="text-center col-span-3 text-red-500">
            Gagal memuat data
          </p>
        `;
      });
  }

  if (categoryFilter) {
    categoryFilter.addEventListener("change", () => fetchEvents());
  }

  if (statusFilter) {
    statusFilter.addEventListener("change", () => fetchEvents());
  }

  eventList.addEventListener("click", (event) => {
    const link = event.target.closest("a");
    if (!link) return;

    const pagination = link.closest("nav");
    if (!pagination) return;

    event.preventDefault();
    fetchEvents(link.href);
  });
}
