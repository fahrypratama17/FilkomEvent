<div id="toast-container" class="fixed top-5 right-5 z-50 space-y-4"></div>

@if ($errors->any())
  <script>
    window.toastError = @json($errors->all());
  </script>
@endif

@if (session('success'))
  <script>
    window.toastSuccess = "{{ session('success') }}"
  </script>
@endif
