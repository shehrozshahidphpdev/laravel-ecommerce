{{-- Toast Notification Component --}}
{{-- Place this in: resources/views/components/toast.blade.php --}}

{{-- Auto-display Laravel session messages --}}
@if(session('success'))
  <div data-toast data-toast-type="success" data-toast-title="Success" style="display: none">
    {{ session('success') }}
  </div>
@endif

@if(session('error'))
  <div data-toast data-toast-type="error" data-toast-title="Error" style="display: none">
    {{ session('error') }}
  </div>
@endif

@if(session('warning'))
  <div data-toast data-toast-type="warning" data-toast-title="Warning" style="display: none">
    {{ session('warning') }}
  </div>
@endif

@if(session('info'))
  <div data-toast data-toast-type="info" data-toast-title="Info" style="display: none">
    {{ session('info') }}
  </div>
@endif