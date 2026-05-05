const counters = document.querySelectorAll(".counter");
const duration = 2500;

counters.forEach((counter) => {
  const animate = () => {
    const target = +counter.getAttribute("data-target");
    const start = 0;
    let timeStart = null;

    const step = (timestamp) => {
      if (!timeStart) timeStart = timestamp;
      const progress = Math.min((timestamp - timeStart) / duration, 1);

      const currentNumber = Math.floor(progress * (target - start) + start);
      counter.innerText = currentNumber;

      if (progress < 1) {
        window.requestAnimationFrame(step);
      }
    };
    window.requestAnimationFrame(step);
  };

  animate();
});
