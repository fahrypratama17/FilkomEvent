export function initSpeakers() {
  const addSpeakerButton = document.getElementById('addSpeaker');
  const speakerWrapper = document.getElementById('speakerWrapper');

  addSpeakerButton?.addEventListener('click', function () {
    const row = document.createElement('div');
    row.className = 'relative';
    row.innerHTML = `
      <input type="text" name="speakers[]" placeholder="Nama pembicara" class="h-[48px] w-full rounded-[8px] bg-[#E7E7E7] px-[30px] pr-[60px] text-[17px] font-medium text-[#555] outline-none placeholder:text-[#666] focus:ring-2 focus:ring-[#263F92]/30">
      <button type="button" class="remove-speaker absolute right-[21px] top-1/2 -translate-y-1/2 text-[28px] font-extrabold leading-none text-[#FF5F2A]">-</button>
    `;
    speakerWrapper?.appendChild(row);
  });

  speakerWrapper?.addEventListener('click', function (event) {
    if (event.target.classList.contains('remove-speaker')) {
      event.target.closest('.relative').remove();
    }
  });

  const addPurposeButton = document.getElementById('addPurpose');
  const purposeWrapper = document.getElementById('purposeWrapper');

  addPurposeButton?.addEventListener('click', function () {
    const row = document.createElement('div');
    row.className = 'relative';
    row.innerHTML = `
      <input type="text" name="event_purpose[]" placeholder="Tujuan dari Event" class="h-[48px] w-full rounded-[8px] bg-[#E7E7E7] px-[30px] pr-[60px] text-[17px] font-medium text-[#555] outline-none placeholder:text-[#666] focus:ring-2 focus:ring-[#263F92]/30">
      <button type="button" class="remove-purpose absolute right-[21px] top-1/2 -translate-y-1/2 text-[28px] font-extrabold leading-none text-[#FF5F2A]">-</button>
    `;
    purposeWrapper?.appendChild(row);
  });

  purposeWrapper?.addEventListener('click', function (event) {
    if (event.target.classList.contains('remove-purpose')) {
      event.target.closest('.relative').remove();
    }
  });

  const categorySelect = document.querySelector('select[name="category_id"]');
  const speakerContainer = document.getElementById('speakerContainer');
  const firstSpeakerInput = document.getElementById('firstSpeakerInput');

  function checkCategory() {
    if (categorySelect && categorySelect.value === '1') {
      speakerContainer.classList.add('hidden');
      if (firstSpeakerInput) firstSpeakerInput.value = '';
      const extraSpeakers = speakerWrapper?.querySelectorAll('.relative:not(:first-child)') || [];
      extraSpeakers.forEach(row => row.remove());
    } else {
      speakerContainer.classList.remove('hidden');
    }
  }

  categorySelect?.addEventListener('change', checkCategory);
  checkCategory();
}

