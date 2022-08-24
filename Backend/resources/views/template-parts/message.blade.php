@if ($errors->any())

  <!-- Message > Error -->
  <div class="error-messages alert alert-danger" role="alert">
    @foreach ($errors->all() as $error)
      <div>{{ $error }}</div>
    @endforeach
  </div>
  <!-- End Message > Error -->

@endif

@if (session('message'))

  <!-- Message > Success -->
  <div class="success-messages alert alert-success" role="alert">
    <div>{{ session('message') }}</div>
  </div>
  <!-- End Message > Success -->

@endif
