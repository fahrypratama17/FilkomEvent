window.toggleBookmark = function(eventId, el) {
  fetch(`/bookmark/${eventId}`, {
    method: 'POST',
    headers: {
      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
      'Content-Type': 'application/json'
    }
  })
    .then(res => res.json())
    .then(data => {

      // animasi
      el.classList.remove('bookmark-animate');
      void el.offsetWidth;
      el.classList.add('bookmark-animate');

      const icon = el.querySelector('i');

      // 🎯 LOGIKA WARNA YANG BENAR
      if (el.classList.contains('bg-white')) {
        el.classList.remove('bg-white');
        el.classList.add('bg-orange-550', 'text-white');
        icon.classList.add('fill-white');
      } else {
        el.classList.remove('bg-orange-550', 'text-white');
        el.classList.add('bg-white');
        icon.classList.remove('fill-white');
      }
    });
}
