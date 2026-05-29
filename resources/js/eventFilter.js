import { initSearch } from "./search";
import { initFilters } from "./filter";

document.addEventListener("DOMContentLoaded", () => {
  const eventList = document.getElementById("eventList");
  const skeleton = document.getElementById("eventListSkeleton");

  if (!eventList) return;

  if (skeleton) {
    skeleton.classList.remove("hidden");
    eventList.classList.add("hidden");

    setTimeout(() => {
      skeleton.classList.add("hidden");
      eventList.classList.remove("hidden");
    }, 1500);
  }

  initSearch(eventList);
  initFilters(eventList);
});
