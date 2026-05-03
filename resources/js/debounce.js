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

      fetch(`/events?search=${query}`)
        .then((res) => res.text())
        .then((html) => {
          const parser = new DOMParser();
          const doc = parser.parseFromString(html, "text/html");

          const newContent = doc.querySelector("#eventList");
          document.querySelector("#eventList").innerHTML = newContent.innerHTML;
        });
    }),
  );
}
