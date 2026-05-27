(function () {
  const imageInput = document.getElementById('image_url');
  const fileNamePreview = document.getElementById('fileNamePreview');
  const imagePreview = document.getElementById('imagePreview');
  const uploadIconContainer = document.getElementById('uploadIconContainer');
  const uploadLabel = document.getElementById('uploadLabel');

  imageInput?.addEventListener('change', function () {
    const file = this.files?.[0];
    if (file) {
      fileNamePreview.textContent = file.name;
      const reader = new FileReader();
      reader.onload = function (e) {
        imagePreview.src = e.target.result;
        uploadIconContainer.classList.add('hidden');
        imagePreview.classList.remove('hidden');
        uploadLabel.classList.remove('min-h-[202px]', 'bg-[#FF5F2A]');
        uploadLabel.classList.add('bg-white', 'border-2', 'border-dashed', 'border-[#FF5F2A]');
      };
      reader.readAsDataURL(file);
    } else {
      fileNamePreview.textContent = '';
      imagePreview.src = '#';
      imagePreview.classList.add('hidden');
      uploadIconContainer.classList.remove('hidden');
      uploadLabel.classList.add('min-h-[202px]', 'bg-[#FF5F2A]');
      uploadLabel.classList.remove('bg-white', 'border-2', 'border-dashed', 'border-[#FF5F2A]');
    }
  });

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

  let currentStep = 1;
  const totalSteps = 3;

  const steps = document.querySelectorAll('.form-step');
  const prevBtn = document.getElementById('prevBtn');
  const nextBtn = document.getElementById('nextBtn');
  const submitBtn = document.getElementById('submitBtn');
  const indicators = document.querySelectorAll('.step-indicator');
  const lines = document.querySelectorAll('.step-line');

  function updateFormStep() {
    steps.forEach((step, idx) => {
      if (idx === currentStep - 1) {
        step.classList.remove('hidden');
      } else {
        step.classList.add('hidden');
      }
    });

    if (currentStep === 1) {
      prevBtn.classList.add('hidden');
      nextBtn.classList.remove('hidden');
      submitBtn.classList.add('hidden');
    } else if (currentStep === totalSteps) {
      prevBtn.classList.remove('hidden');
      nextBtn.classList.add('hidden');
      submitBtn.classList.remove('hidden');
    } else {
      prevBtn.classList.remove('hidden');
      nextBtn.classList.remove('hidden');
      submitBtn.classList.add('hidden');
    }

    indicators.forEach((indicator, idx) => {
      const stepNumSpan = indicator.querySelector('span');
      if (idx < currentStep) {
        indicator.classList.remove('text-gray-400');
        indicator.classList.add('text-[#FF5F2A]');
        stepNumSpan.classList.remove('bg-gray-300');
        stepNumSpan.classList.add('bg-[#FF5F2A]');
      } else {
        indicator.classList.remove('text-[#FF5F2A]');
        indicator.classList.add('text-gray-400');
        stepNumSpan.classList.remove('bg-[#FF5F2A]');
        stepNumSpan.classList.add('bg-gray-300');
      }
    });

    lines.forEach((line, idx) => {
      if (idx < currentStep - 1) {
        line.classList.remove('bg-gray-300');
        line.classList.add('bg-[#FF5F2A]');
      } else {
        line.classList.remove('bg-[#FF5F2A]');
        line.classList.add('bg-gray-300');
      }
    });
  }

  nextBtn?.addEventListener('click', () => {
    if (currentStep < totalSteps) {
      currentStep++;
      updateFormStep();
      window.scrollTo({ top: 0, behavior: 'smooth' });
    }
  });

  prevBtn?.addEventListener('click', () => {
    if (currentStep > 1) {
      currentStep--;
      updateFormStep();
      window.scrollTo({ top: 0, behavior: 'smooth' });
    }
  });

  document.addEventListener('DOMContentLoaded', function () {
    checkCategory();

    const toasts = ['toast-success', 'toast-error', 'toast-validation'];
    toasts.forEach(id => {
      const toastElement = document.getElementById(id);
      if (toastElement) {
        setTimeout(() => {
          toastElement.style.opacity = '0';
          toastElement.style.transform = 'translateY(-10px)';
          setTimeout(() => { toastElement.remove(); }, 300);
        }, 4000);
      }
    });
  });
})();

