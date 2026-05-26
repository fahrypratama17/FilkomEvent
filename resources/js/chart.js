document.addEventListener("DOMContentLoaded", () => {
  const root = document.getElementById("chartRoot");

  const chart = document.getElementById("donutChart");
  const legend = document.getElementById("chartLegend");
  const totalText = document.getElementById("totalEvents");
  const tooltip = document.getElementById("tooltip");

  if (!root || !chart || !legend || !totalText || !tooltip) return;

  let categoryData = [];

  try {
    categoryData = JSON.parse(root.dataset.stats || "[]");
  } catch (e) {
    categoryData = [];
  }

  const colors = ["#1E90FF", "#FFD700", "#FF4D4D", "#00C49F", "#A78BFA"];

  const total = categoryData.reduce(
    (sum, item) => sum + Number(item.total || 0),
    0,
  );

  totalText.innerText = total;

  if (total === 0) {
    chart.style.background = "#ddd";
    legend.innerHTML = "<p class='text-white/70'>Belum ada data</p>";
    return;
  }

  let currentPercent = 0;
  let gradientParts = [];

  categoryData.forEach((item, index) => {
    const percent = (Number(item.total) / total) * 100;
    const start = currentPercent;
    const end = currentPercent + percent;
    const color = colors[index % colors.length];

    gradientParts.push(`${color} ${start}% ${end}%`);

    const div = document.createElement("div");
    div.className = "flex items-center gap-2 cursor-pointer";
    div.innerHTML = `
      <span class="w-3 h-3 rounded-full shrink-0"
            style="background:${color}">
      </span>

      <span>${item.category_name}</span>
    `;

    div.addEventListener("mousemove", (e) => {
      tooltip.classList.remove("hidden");
      tooltip.innerHTML = `
        <strong>${item.category_name}</strong><br>
        ${item.total} events<br>
        ${percent.toFixed(1)}%
      `;

      tooltip.style.left = `${e.clientX + 12}px`;
      tooltip.style.top = `${e.clientY + 12}px`;
    });

    div.addEventListener("mouseleave", () => {
      tooltip.classList.add("hidden");
    });

    legend.appendChild(div);
    currentPercent = end;
  });

  chart.style.transition = "background 1s ease";

  setTimeout(() => {
    chart.style.background = `conic-gradient(${gradientParts.join(",")})`;
  }, 200);
});
