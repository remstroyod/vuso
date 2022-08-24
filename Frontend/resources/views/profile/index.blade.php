@extends('layouts.app')

@section('meta')

    <meta name="description" content="{{ ($page->seo) ? $page->seo->description : $page->name }}">
    <title>{{ ($page->seo) ? $page->seo->title : $page->name }}</title>

@endsection

@section('content')

    <!-- Cabinet -->
    <section class="cabinet">

        <!-- container -->
        <div class="container">

            <!-- head -->
            <div class="cabinet__head">
                @include( 'partials.page-title', ['class' => 'cabinet__title'] )
                <a
                    href="{{ route('home', [ 'widget-state' => 'incident' ]) }}"
                    class="btn red cabinet__issue-request"
                    target="_blank"
                >
                    {{ __( 'Заявить о страховом случае' ) }}
                </a>
            </div>
            <!-- end head -->

            <div class="cabinet__controls">
                <ul class="nav nav-pills cabinet__pills">
                    <li class="nav-item">
                        <a
                            class="nav-link @if( request()->routeIs('profile') ) active @endif"
                            href="{{ route( 'profile' ) }}"
                        >
                            {{ __( 'Общая информация' ) }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a
                            class="nav-link @if( request()->routeIs('profile.edit') ) active @endif"
                            aria-current="page"
                            href="{{ route( 'profile.edit' ) }}"
                        >
                            {{ __( 'Мои данные' ) }}
                        </a>
                    </li>
                </ul>

                <div class="cabinet__control-links">
                    <div class="loginDataCellForm">
                        @include('profile.modals.login-data')
                    </div>
                    <button
                        class="cabinet__control-link cabinet__change-login-info"
                        data-bs-toggle="modal"
                        data-bs-target="#modal-change-credentials"
                    >
                        {{ __( 'Изменить данные для входа' ) }}
                    </button>
                    <a href="{{ route('logout') }}" class="cabinet__control-link cabinet__logout">
                        {{ __( 'Выйти из аккаунта' ) }}
                    </a>
                </div>
            </div>

            @includeWhen( request()->routeIs('profile.edit'), 'profile.pages.personal' )
            @includeWhen( request()->routeIs('profile'), 'profile.pages.general' )

        </div>
        <!-- end container -->

    </section>
    <!-- End Cabinet -->
    @if(false)
        @include( 'cta.cta-11' )
    @endif
    <!-- Section -->
    <section class="accordion-with-card">

        <!-- container -->
        <div class="container">

            <!-- row -->
            <div class="row">

                <!-- col -->
                <div class="col col-8">

                    @include( 'partials.accordion.faq.profile' )

                </div>
                <!-- end col -->

                <!-- col -->
                <div class="col col-4">

                    @includeWhen( $sales, 'partials.loop.sales', ['item' => $sales] )

                </div>
                <!-- end col -->

            </div>
            <!-- end row -->

        </div>
        <!-- end container -->

    </section>
    <!-- End Section -->

    @include( 'cta.cta-subscribe' )

@endsection

@push('custom-scripts')
    <script src="{{ asset('assets/app/js/profile.js') }}"></script>
@endpush
