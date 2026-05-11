let activePayment = null;

document.addEventListener("DOMContentLoaded", () => {
  window.togglePayment = function (id) {
    const content = document.getElementById(`content-${id}`);
    const icon = document.getElementById(`icon-${id}`);

    if (!content || !icon) return;

    if (activePayment === id) {
      content.style.maxHeight = null;
      content.style.opacity = 0;
      icon.style.transform = "rotate(0deg)";
      activePayment = null;
      return;
    }

    document.querySelectorAll('[id^="content-"]').forEach((el) => {
      el.style.maxHeight = null;
      el.style.opacity = 0;
    });

    document.querySelectorAll('[id^="icon-"]').forEach((el) => {
      el.style.transform = "rotate(0deg)";
    });

    content.style.maxHeight = content.scrollHeight + "px";
    content.style.opacity = 1;
    icon.style.transform = "rotate(180deg)";

    activePayment = id;
  };
});
