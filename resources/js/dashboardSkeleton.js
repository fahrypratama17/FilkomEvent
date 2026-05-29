document.addEventListener("DOMContentLoaded", () => {
  const eventSkeleton = document.getElementById("dashboardEventSkeleton");
  const eventList = document.getElementById("dashboardEventList");
  const statsSkeleton = document.getElementById("dashboardStatsSkeleton");
  const statsContent = document.getElementById("dashboardStatsContent");

  if (!eventSkeleton || !eventList || !statsSkeleton || !statsContent) return;

  eventSkeleton.classList.remove("hidden");
  eventList.classList.add("hidden");
  statsSkeleton.classList.remove("hidden");
  statsContent.classList.add("hidden");

  setTimeout(() => {
    eventSkeleton.classList.add("hidden");
    eventList.classList.remove("hidden");
    statsSkeleton.classList.add("hidden");
    statsContent.classList.remove("hidden");
  }, 1500);
});
