document.addEventListener('DOMContentLoaded', () => {
  const searchInput = document.getElementById('searchInput');
  const categoryFilter = document.getElementById('categoryFilter');
  const eventList = document.getElementById('eventList');

  let timeout = null;

  function fetchEvents() {
    const search = searchInput ? searchInput.value : '';
    const category = categoryFilter ? categoryFilter.value : '';

    const params = new URLSearchParams({
      search: search,
      category: category
    });

    eventList.innerHTML = `<p class="text-center col-span-3">Loading...</p>`;

    fetch(`?${params.toString()}`, {
      headers: {
        'X-Requested-With': 'XMLHttpRequest'
      }
    })
      .then(response => response.text())
      .then(data => {
        eventList.innerHTML = data;
      })
      .catch(() => {
        eventList.innerHTML = `<p class="text-center col-span-3 text-red-500">Gagal memuat data</p>`;
      });
  }

  if (searchInput) {
    searchInput.addEventListener('keyup', () => {
      clearTimeout(timeout);
      timeout = setTimeout(fetchEvents, 400);
    });
  }

  if (categoryFilter) {
    categoryFilter.addEventListener('change', fetchEvents);
  }
});
