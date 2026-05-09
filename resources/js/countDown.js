const countDownElement = document.getElementById("countdown");

if (countDownElement) {
  const waktuMulai = new Date(countDownElement.dataset.start).getTime();

  function updateCountDown() {
    const sekarang = new Date().getTime();
    const distance = waktuMulai - sekarang;

    if (distance <= 0) {
      countDownElement.innerHTML = "Event telah dimulai";
      return;
    }

    const hari = Math.floor(distance / (1000 * 60 * 60 * 24));
    const jam = Math.floor(
      (distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60),
    );
    const menit = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    const detik = Math.floor((distance % (1000 * 60)) / 1000);

    countDownElement.innerHTML = `${hari} <span class="text-[10px]">hari</span> : ${jam} <span class="text-[10px]">jam</span> : ${menit} <span class="text-[10px]">menit</span> : ${detik} <span class="text-[10px]">detik</span>`;
  }

  updateCountDown();
  setInterval(updateCountDown, 1000);
}
