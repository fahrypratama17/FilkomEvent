// document.addEventListener("DOMContentLoaded", async () => {
//   const canvas = document.getElementById("adminCategoryChart");
//   const legend = document.getElementById("adminCategoryLegend");
//
//   if (!canvas || !legend) return;
//
//   const { default: Chart } = await import("chart.js/auto");
//
//   let categoryStats = [];
//
//   try {
//     categoryStats = JSON.parse(canvas.dataset.stats || "[]");
//   } catch (error) {
//     categoryStats = [];
//   }
//
//   const labels = categoryStats.map((category) => category.label);
//   const values = categoryStats.map((category) => Number(category.value || 0));
//   const colors = categoryStats.map((category) => category.color);
//   const total = values.reduce((sum, value) => sum + value, 0);
//
//   legend.replaceChildren();
//
//   if (total === 0) {
//     const emptyMessage = document.createElement("p");
//     emptyMessage.className = "text-[18px] font-extrabold text-[#1F388B]";
//     emptyMessage.textContent = "Belum ada data event.";
//     legend.appendChild(emptyMessage);
//   } else {
//     categoryStats.forEach((category) => {
//       const item = document.createElement("div");
//       item.className = "flex items-center gap-[30px]";
//
//       const dot = document.createElement("span");
//       dot.className = "h-[20px] w-[20px] shrink-0 rounded-full";
//       dot.style.backgroundColor = category.color;
//
//       const label = document.createElement("span");
//       label.className = "min-w-0 flex-1 text-[18px] font-extrabold";
//       label.style.color = category.color;
//       label.textContent = category.label;
//
//       const value = document.createElement("span");
//       value.className = "text-[18px] font-extrabold";
//       value.style.color = category.color;
//       value.textContent = Number(category.value || 0);
//
//       item.append(dot, label, value);
//       legend.appendChild(item);
//     });
//   }
//
//   new Chart(canvas, {
//     type: "doughnut",
//     data: {
//       labels: total === 0 ? ["Belum ada data"] : labels,
//       datasets: [
//         {
//           data: total === 0 ? [1] : values,
//           backgroundColor: total === 0 ? ["#E5E7EB"] : colors,
//           borderWidth: 0,
//           hoverOffset: total === 0 ? 0 : 8,
//         },
//       ],
//     },
//     options: {
//       responsive: true,
//       maintainAspectRatio: false,
//       cutout: "40%",
//       plugins: {
//         legend: {
//           display: false,
//         },
//         tooltip: {
//           enabled: total > 0,
//           callbacks: {
//             label(context) {
//               const value = Number(context.raw || 0);
//               const percentage = total === 0 ? 0 : (value / total) * 100;
//
//               return `${context.label}: ${value} event (${percentage.toFixed(1)}%)`;
//             },
//           },
//         },
//       },
//     },
//   });
// });
