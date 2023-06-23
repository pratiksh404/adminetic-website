  <footer class="footer">
      <div class="container-fluid">
          <div class="row">
              <div class="col-md-12 footer-copyright text-center">
                  <p class="mb-0">Copyright {{ \Carbon\Carbon::now()->year }} ©
                      {{ $setting->title ?? config('adminetic.name', 'Adminetic') }} by DOCTYPE NEPAL </p>
              </div>
          </div>
      </div>
  </footer>

  {{-- Alpine --}}
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.12.1/dist/cdn.min.js"></script>
  <style>
      [x-cloak] {
          display: none !important;
      }
  </style>
