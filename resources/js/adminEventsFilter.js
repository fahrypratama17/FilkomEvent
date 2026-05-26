import { debounce } from "./debounce";
import { createIcons, icons } from "lucide";

document.addEventListener("DOMContentLoaded", () => {
  const resultsContainer = document.getElementById("adminEventResults");
  const searchInput = document.getElementById("searchInput");
  const categoryFilter = document.getElementById("categoryFilter");
  const statusFilter = document.getElementById("statusFilter");

  if (!resultsContainer || !searchInput || !categoryFilter || !statusFilter) {
    return;
  }

  const buildParams = () => {
    const params = new URLSearchParams();

    if (searchInput.value.trim()) {
      params.set("search", searchInput.value.trim());
    }

    if (categoryFilter.value) {
      params.set("category_id", categoryFilter.value);
    }

    if (statusFilter.value) {
      params.set("event_status", statusFilter.value);
    }

    return params;
  };

  const updateUrl = (params) => {
    const query = params.toString();
    const newUrl = query ? `${window.location.pathname}?${query}` : window.location.pathname;
    window.history.replaceState({}, "", newUrl);
  };

  const renderLoading = () => {
    resultsContainer.innerHTML = "<div class=\"py-12 text-center\">Memuat data...</div>";
  };

  const fetchResults = (pageUrl = null) => {
    const params = buildParams();

    if (pageUrl) {
      const url = new URL(pageUrl, window.location.origin);
      const page = url.searchParams.get("page");
      if (page) {
        params.set("page", page);
      }
    }

    renderLoading();

    fetch(`${window.location.pathname}?${params.toString()}`, {
      headers: {
        "X-Requested-With": "XMLHttpRequest",
      },
    })
      .then((res) => res.text())
      .then((html) => {
        resultsContainer.innerHTML = html;
        updateUrl(params);
        createIcons({ icons });
      })
      .catch(() => {
        resultsContainer.innerHTML = "<div class=\"py-12 text-center text-red-500\">Gagal memuat data.</div>";
      });
  };

  const handleSearch = debounce(() => {
    fetchResults();
  }, 400);

  searchInput.addEventListener("input", handleSearch);
  categoryFilter.addEventListener("change", () => fetchResults());
  statusFilter.addEventListener("change", () => fetchResults());

  resultsContainer.addEventListener("click", (event) => {
    const link = event.target.closest("a");
    if (!link || !link.href) {
      return;
    }

    if (!link.closest("nav")) {
      return;
    }

    event.preventDefault();
    fetchResults(link.href);
  });
});

