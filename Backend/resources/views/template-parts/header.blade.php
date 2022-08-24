<!-- Navbar -->
<nav class="navbar">

  <!-- Burger Menu -->
  <a
          href="javascript:;"
          class="sidebar-toggler"
  >
    <i data-feather="menu"></i>
  </a>
  <!-- End Burger Menu -->

  <!-- Content -->
  <div class="navbar-content">

    @if( request()->routeIs('constructor.show') || request()->routeIs('b2b.products.builder') )

      <!-- Btn Group -->
      <div class="btn-group-flex">

        <!-- center -->
        <div>

          <a href="{{ request()->routeIs('constructor.show') ? route('constructor.edit', $model) : route('b2b.products.builder', ['product' => $model]) }}" class="btn btn-primary btnSaveConstructor">
            {{ __( 'Сохранить' ) }}
          </a>

          <a href="@if( $model->id ){{ request()->routeIs('constructor.show') ? route('constructor.edit', $model) : route('b2b.products.edit', ['product' => $model]) }}@else{{ request()->routeIs('constructor.show') ? route('constructor.index') : route('b2b.products.edit', ['product' => $model]) }}@endif" type="button" class="btn btn-secondary">
            {{ __( 'Отмена' ) }}
          </a>

          @if( request()->routeIs('constructor.show') )
            <a href="{{ $model->getPreviewUrl() }}" target="_blank">{{ $model->getPreviewUrl() }}</a>
          @endif

        </div>
        <!-- end center -->

      </div>
      <!-- End Btn Group -->

    @endif

    <!-- Nav -->
    <ul class="navbar-nav">

      <!-- locale -->
      <li class="nav-item dropdown">

        <!-- link -->
        <a
                class="nav-link dropdown-toggle"
                href="javascript:;"
                id="languageDropdown"
                role="button"
                data-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false"
        >
          <i class="flag-icon flag-icon-{{ app()->getLocale() }} mt-1" title="{{ app()->getLocale() }}"></i>
          <span class="font-weight-medium ml-1 mr-1">
            {{ config('app.available_locales')[app()->getLocale()] }}
          </span>
        </a>
        <!-- end link -->

        <!-- dropdown -->
        <div class="dropdown-menu" aria-labelledby="languageDropdown">
          @foreach( config('app.available_locales') as $key => $language )
            <a
                    href="{{ route('localization', ['locale' => $key]) }}"
                    class="dropdown-item py-2"
            >
              <i class="flag-icon flag-icon-{{ $key }}" title="{{ $key }}" id="{{ $key }}"></i>
              <span class="ml-1"> {{ $language }} </span>
            </a>
          @endforeach
        </div>
        <!-- end dropdown -->

      </li>
      <!-- end locale -->

      <!-- profile -->
      <li class="nav-item dropdown nav-profile">

        <!-- avatar -->
        <a
                class="nav-link dropdown-toggle"
                href="{{ route('users.profile.index') }}"
                id="profileDropdown"
                role="button"
                data-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false"
        >
          @if( isset(auth()->user()->detail) )
          <img
                  src="@if( auth()->user()->detail->avatar ) {{ url('storage/images/user/' . auth()->user()->id . '/' . auth()->user()->detail->avatar) }} @else {{ url('https://via.placeholder.com/30x30') }} @endif"
                  alt="{{ auth()->user()->name }}"
                  title="{{ auth()->user()->name }}"
          >
          @else
            <img
                    src="{{ url('https://via.placeholder.com/30x30') }}"
                    alt="{{ auth()->user()->name }}"
                    title="{{ auth()->user()->name }}"
            >
          @endif

        </a>
        <!-- end avatar -->

        <!-- menu -->
        <div class="dropdown-menu" aria-labelledby="profileDropdown">

          <!-- dropdown -->
          <div class="dropdown-header d-flex flex-column align-items-center">

            <!-- figure -->
            <div class="figure mb-3">
              @if( isset(auth()->user()->detail) )
                <img
                        src="@if( auth()->user()->detail->avatar ) {{ url('storage/images/user/' . auth()->user()->id . '/' . auth()->user()->detail->avatar) }} @else {{ url('https://via.placeholder.com/100x100') }} @endif"
                        alt="{{ auth()->user()->name }}"
                        title="{{ auth()->user()->name }}"
                >
              @else
                <img
                        src="{{ url('https://via.placeholder.com/100x100') }}"
                        alt="{{ auth()->user()->name }}"
                        title="{{ auth()->user()->name }}"
                >
              @endif
            </div>
            <!-- end figure -->

            <!-- info -->
            <div class="info text-center">
              <p class="name font-weight-bold mb-0">
                @if( isset(auth()->user()->detail) )
                  @if( auth()->user()->detail->view_name ) {{ auth()->user()->detail->view_name }} @else {{auth()->user()->detail->full_name}} @endif
                @else
                  {{ auth()->user()->name }}
                @endif
              </p>
              <p class="email text-muted mb-3">
                {{auth()->user()->email}}
              </p>
            </div>
            <!-- end info -->

          </div>
          <!-- end dropdown -->

          <!-- dropdown -->
          <div class="dropdown-body">

            <!-- List -->
            <ul class="profile-nav p-0 pt-3">

              @permission('profile_access')
              <li class="nav-item">

                <!-- Profile -->
                <a href="{{ route('users.profile.index') }}" class="nav-link">
                  <i data-feather="user"></i>
                  <span>{{ __('Профиль') }}</span>
                </a>
                <!-- End Profile -->

              </li>
              @endpermission

              <li class="nav-item">

                <!-- Logout -->
                <a href="{{route('logout')}}" class="nav-link">
                  <i data-feather="log-out"></i>
                  <span>{{ __('Выйти') }}</span>
                </a>
                <!-- End Logout -->

              </li>

            </ul>
            <!-- End List -->

          </div>
          <!-- end dropdown -->

        </div>
        <!-- end menu -->

      </li>
      <!-- end profile -->

    </ul>
    <!-- End Nav -->

  </div>
  <!-- End Content -->

</nav>
<!-- End Navbar -->
