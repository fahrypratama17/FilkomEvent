(function () {
  const qrisCard = document.getElementById("qris-card");
  if (!qrisCard) return;

  let qrisTimerStarted = false;
  qrisCard.addEventListener("click", function () {
    if (qrisTimerStarted) return;
    qrisTimerStarted = true;

    const redirectUrl = qrisCard.getAttribute("data-redirect");
    if (!redirectUrl) return;

    setTimeout(function () {
      window.location.href = redirectUrl;
    }, 5000);
  });
})();

