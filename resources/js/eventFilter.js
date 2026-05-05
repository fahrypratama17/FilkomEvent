import { initSearch } from "./search";
import { initFilters } from "./filter";

document.addEventListener("DOMContentLoaded", () => {
  const eventList = document.getElementById("eventList");

  if (!eventList) return;

  initSearch(eventList);
  initFilters(eventList);
});
