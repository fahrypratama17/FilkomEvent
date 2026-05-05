window.togglePassword = function () {
  const input = document.getElementById("password");
  const eyeOpen = document.getElementById("eye-open-password");
  const eyeClose = document.getElementById("eye-close-password");

  if (input.type === "password") {
    input.type = "text";

    eyeOpen.classList.remove("opacity-100", "scale-100");
    eyeOpen.classList.add("opacity-0", "scale-75");

    eyeClose.classList.remove("opacity-0", "scale-75");
    eyeClose.classList.add("opacity-100", "scale-100");
  } else {
    input.type = "password";

    eyeOpen.classList.remove("opacity-0", "scale-75");
    eyeOpen.classList.add("opacity-100", "scale-100");

    eyeClose.classList.remove("opacity-100", "scale-100");
    eyeClose.classList.add("opacity-0", "scale-75");
  }
};

window.togglePasswordConfirmation = function () {
  const input = document.getElementById("password_confirmation");
  const eyeOpen = document.getElementById("eye-open-confirmation");
  const eyeClose = document.getElementById("eye-close-confirmation");

  if (input.type === "password") {
    input.type = "text";

    eyeOpen.classList.remove("opacity-100", "scale-100");
    eyeOpen.classList.add("opacity-0", "scale-75");

    eyeClose.classList.remove("opacity-0", "scale-75");
    eyeClose.classList.add("opacity-100", "scale-100");
  } else {
    input.type = "password";

    eyeOpen.classList.remove("opacity-0", "scale-75");
    eyeOpen.classList.add("opacity-100", "scale-100");

    eyeClose.classList.remove("opacity-100", "scale-100");
    eyeClose.classList.add("opacity-0", "scale-75");
  }
};
