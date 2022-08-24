@extends('layouts.app')

@section('content')
  <!-- Profile Page -->
  <div class="profile-page tx-13">

    <!-- Row -->
    <div class="row">

      <!-- col -->
      <div class="col-12 grid-margin">

        <!-- header -->
        <div class="profile-header">

          <!-- cover -->
          <div class="cover">

            <div class="gray-shade"></div>

            <!-- Image -->
            <figure>

              @if( isset( auth()->user()->detail ) )
                <img
                        src="@if( auth()->user()->detail->image ) {{ url('storage/images/user/' . auth()->user()->id . '/' . auth()->user()->detail->image) }} @else {{ url('https://via.placeholder.com/1148x272') }} @endif"
                        class="img-fluid"
                        alt="{{ auth()->user()->detail->full_name }}"
                        title="{{ auth()->user()->detail->full_name }}"
                >
              @else
                <img
                        src="{{ url('https://via.placeholder.com/1148x272') }}"
                        class="img-fluid"
                        alt="{{ auth()->user()->name }}"
                        title="{{ auth()->user()->name }}"
                >
              @endif

            </figure>
            <!-- end Image -->

            <!-- items -->
            <div class="cover-body d-flex justify-content-between align-items-center mb-5">

              <!-- Info -->
              <div>

                <!-- img -->
                @if( isset( auth()->user()->detail ) )
                  <img
                          class="profile-pic" src="@if( auth()->user()->detail->avatar ) {{ url('storage/images/user/' . auth()->user()->id . '/' . auth()->user()->detail->avatar) }} @else {{ url('https://via.placeholder.com/100x100') }} @endif"
                          alt="{{ auth()->user()->detail->full_name }}"
                          title="{{ auth()->user()->detail->full_name }}"
                  >
                @else
                  <img
                          class="profile-pic" src="{{ url('https://via.placeholder.com/100x100') }}"
                          alt="{{ auth()->user()->name }}"
                          title="{{ auth()->user()->name }}"
                  >
                @endif
                <!-- end img -->

                <!-- name -->
                <span class="profile-name">
                  @if( isset( auth()->user()->detail ) )
                    @if( auth()->user()->detail->view_name ) {{ auth()->user()->detail->view_name }} @else {{auth()->user()->detail->full_name}} @endif
                  @else
                    {{auth()->user()->name}}
                  @endif
                </span>
                <!-- end name -->

              </div>
              <!-- end Info -->

              <!-- Button -->
              <div class="d-none d-md-block">

                @permission('profile_update')
                  <a
                          href="{{ route('users.profile.edit') }}"
                          class="btn btn-primary btn-icon-text btn-edit-profile"
                  >
                    <i data-feather="edit" class="btn-icon-prepend"></i>
                    {{ __( 'Редактировать профиль' ) }}
                  </a>
                @endpermission

              </div>
              <!-- End Button -->

            </div>
            <!-- end items -->

          </div>
          <!-- end cover -->

        </div>
        <!-- end header -->

      </div>
      <!-- end col -->

    </div>
    <!-- End Row -->

    <!-- Row -->
    <div class="row profile-body">

      <!-- left wrapper start -->
      <div class="d-none d-md-block col-md-4 col-xl-3 left-wrapper">

        <!-- card -->
        <div class="card rounded">

          <!-- card body -->
          <div class="card-body">

            <!-- title -->
            <div class="d-flex align-items-center justify-content-between mb-2">
              <h6 class="card-title mb-0">
                {{ __( 'Обо мне' ) }}
              </h6>
            </div>
            <!-- end title -->

            @isset( auth()->user()->detail )
              @if( auth()->user()->detail->about )
                <!-- about -->
                <p>
                  {{ auth()->user()->detail->about }}
                </p>
                <!-- end about -->
              @endif
            @endisset

            <!-- date registration -->
            <div class="mt-3">
              <label class="tx-11 font-weight-bold mb-0 text-uppercase">
                {{ __( 'Дата регистрации' ) }}:
              </label>
              <p class="text-muted">
                {{ auth()->user()->created_at->format('j F Y г.') }}
              </p>
            </div>
            <!-- end date registration -->

            @isset( auth()->user()->detail )
              @if( auth()->user()->detail->city )
                <!-- Locations -->
                <div class="mt-3">
                  <label class="tx-11 font-weight-bold mb-0 text-uppercase">
                    {{ __( 'Город' ) }}:
                  </label>
                  <p class="text-muted">
                    {{ auth()->user()->detail->city }}
                  </p>
                </div>
                <!-- end Locations -->
              @endif
            @endisset

            @if( auth()->user()->email )
              <!-- Email -->
              <div class="mt-3">
                <label class="tx-11 font-weight-bold mb-0 text-uppercase">
                  {{ __( 'E-mail' ) }}:
                </label>
                <p class="text-muted">
                  {{ auth()->user()->email }}
                </p>
              </div>
              <!-- end Email -->
            @endif

            @isset( auth()->user()->detail )
              @if( auth()->user()->detail->website )
                <!-- WebSite -->
                <div class="mt-3">
                  <label class="tx-11 font-weight-bold mb-0 text-uppercase">
                    {{ __( 'Сайт' ) }}:
                  </label>
                  <p class="text-muted">
                    {{ auth()->user()->detail->website }}
                  </p>
                </div>
                <!-- End WebSite -->
              @endif
            @endisset

            @if( auth()->user()->socials )

              <!-- Socials -->
              <div class="mt-3 d-flex social-links">

                @foreach( auth()->user()->socials as $social )
                  <a href="{{ $social->url }}" class="btn d-flex align-items-center justify-content-center border mr-2 btn-icon {{ $social->image }}">
                    <i data-feather="{{ $social->image }}" data-toggle="tooltip" title="{{ $social->name }}"></i>
                  </a>
                @endforeach
              </div>
              <!-- End Socials -->

            @endif

          </div>
          <!-- end card body -->

        </div>
        <!-- end card -->

      </div>
      <!-- left wrapper end -->

      <!-- middle wrapper start -->
      <div class="col-md-8 col-xl-6 middle-wrapper">

        <!-- row -->
        <div class="row">

          <!-- col -->
          <div class="col-md-12">

            <!-- card -->
            <div class="card rounded">

              <!-- card > header -->
              <div class="card-header">
                <div class="d-flex align-items-center justify-content-between">
                  <div class="d-flex align-items-center">
                    <img class="img-xs rounded-circle" src="{{ url('https://via.placeholder.com/37x37') }}" alt="">
                    <div class="ml-2">
                      <p>Mike Popescu</p>
                      <p class="tx-11 text-muted">5 min ago</p>
                    </div>
                  </div>
                  <div class="dropdown">
                    <button class="btn p-0" type="button" id="dropdownMenuButton3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="icon-lg pb-3px" data-feather="more-horizontal"></i>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton3">
                      <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="meh" class="icon-sm mr-2"></i> <span class="">Unfollow</span></a>
                      <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="corner-right-up" class="icon-sm mr-2"></i> <span class="">Go to post</span></a>
                      <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="share-2" class="icon-sm mr-2"></i> <span class="">Share</span></a>
                      <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="copy" class="icon-sm mr-2"></i> <span class="">Copy link</span></a>
                    </div>
                  </div>
                </div>
              </div>
              <!-- end card > header -->

              <!-- card > body -->
              <div class="card-body">
                <p class="mb-3 tx-14">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                <img class="img-fluid" src="{{ url('https://via.placeholder.com/513x432') }}" alt="">
              </div>
              <!-- end card > body -->

            </div>
            <!-- end card -->

          </div>
          <!-- end col -->

        </div>
        <!-- end row -->

      </div>
      <!-- middle wrapper end -->

      <!-- right wrapper start -->
      <div class="d-none d-xl-block col-xl-3 right-wrapper">

        <!-- row -->
        <div class="row">

          <!-- col -->
          <div class="col-md-12 grid-margin">

            <!-- card -->
            <div class="card rounded">

              <!-- card > body -->
              <div class="card-body">

                <!-- title -->
                <h6 class="card-title">
                  {{ __( 'Избранные продукты' ) }}
                </h6>
                <!-- end title -->

                <!-- latest -->
                <div class="latest-photos">

                  <!-- row -->
                  <div class="row">
                    <div class="col-md-4">
                      <figure>
                        <img class="img-fluid" src="{{ url('https://via.placeholder.com/67x67') }}" alt="">
                      </figure>
                    </div>
                    <div class="col-md-4">
                      <figure>
                        <img class="img-fluid" src="{{ url('https://via.placeholder.com/67x67') }}" alt="">
                      </figure>
                    </div>
                    <div class="col-md-4">
                      <figure>
                        <img class="img-fluid" src="{{ url('https://via.placeholder.com/67x67') }}" alt="">
                      </figure>
                    </div>
                    <div class="col-md-4">
                      <figure>
                        <img class="img-fluid" src="{{ url('https://via.placeholder.com/67x67') }}" alt="">
                      </figure>
                    </div>
                    <div class="col-md-4">
                      <figure>
                        <img class="img-fluid" src="{{ url('https://via.placeholder.com/67x67') }}" alt="">
                      </figure>
                    </div>
                    <div class="col-md-4">
                      <figure>
                        <img class="img-fluid" src="{{ url('https://via.placeholder.com/67x67') }}" alt="">
                      </figure>
                    </div>
                    <div class="col-md-4">
                      <figure class="mb-0">
                        <img class="img-fluid" src="{{ url('https://via.placeholder.com/67x67') }}" alt="">
                      </figure>
                    </div>
                    <div class="col-md-4">
                      <figure class="mb-0">
                        <img class="img-fluid" src="{{ url('https://via.placeholder.com/67x67') }}" alt="">
                      </figure>
                    </div>
                    <div class="col-md-4">
                      <figure class="mb-0">
                        <img class="img-fluid" src="{{ url('https://via.placeholder.com/67x67') }}" alt="">
                      </figure>
                    </div>
                  </div>
                  <!-- end row -->

                </div>
                <!-- end latest -->

              </div>
              <!-- end card > body -->

            </div>
            <!-- end card -->

          </div>
          <!-- end col -->

        </div>
        <!-- end row -->

      </div>
      <!-- right wrapper end -->

    </div>
    <!-- End Row -->

  </div>
  <!-- End Profile Page -->
@endsection
