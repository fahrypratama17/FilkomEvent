window.kirimWhatsApp = function () {
  let nama = document.querySelector('[name="nama"]').value;
  let email = document.querySelector('[name="email"]').value;
  let nim = document.querySelector('[name="nim"]').value;
  let pesan = document.querySelector('[name="pesan"]').value;

  let text = encodeURIComponent(
    `Halo, perkenalkan saya ${nama}\nEmail: ${email}\nNIM: ${nim}\nPesan: ${pesan}`,
  );
  let nomor = "6289651622100";

  window.open(`https://wa.me/${nomor}?text=${text}`, "_blank");
};
