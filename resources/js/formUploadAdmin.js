import { initImagePreview } from "./preview.js";
import { initSpeakers } from "./speaker.js";
import { initWizard } from "./wizard.js";

(function () {
  document.addEventListener("DOMContentLoaded", function () {
    initImagePreview();
    initSpeakers();
    initWizard();

    const toasts = ["toast-success", "toast-error", "toast-validation"];
    toasts.forEach((id) => {
      const toastElement = document.getElementById(id);
      if (toastElement) {
        setTimeout(() => {
          toastElement.style.opacity = "0";
          toastElement.style.transform = "translateY(-10px)";
          setTimeout(() => {
            toastElement.remove();
          }, 300);
        }, 4000);
      }
    });
  });
})();
