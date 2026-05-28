export function initWizard() {
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
}

