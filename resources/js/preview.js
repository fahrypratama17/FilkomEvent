export function initImagePreview() {
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
}

