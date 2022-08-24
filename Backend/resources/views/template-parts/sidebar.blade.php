@if( ! request()->routeIs(['constructor.show', 'b2b.products.builder']) )
<!-- Sidebar -->
<nav class="sidebar">

  <!-- Sidebar > Header -->
  <div class="sidebar-header">

    <!-- Brand Logo -->
    <a href="#" class="sidebar-brand">
      VUSO<span>UI</span>
    </a>
    <!-- End Brand Logo -->

    <!-- Brand Logo -->
    <div class="sidebar-toggler not-active">
      <span></span>
      <span></span>
      <span></span>
    </div>
    <!-- End Brand Logo -->

  </div>
  <!-- End Sidebar > Header -->

  <!-- Sidebar > Body -->
  <div class="sidebar-body">

    {{ \Backend\Facades\Menu::make('primary') }}

  </div>
  <!-- End Sidebar > Body -->

</nav>
<!-- End Sidebar -->
@endif
