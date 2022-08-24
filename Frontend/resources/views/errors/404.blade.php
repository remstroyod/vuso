@extends('layouts.app', [ 'page' => (object) [ 'is_header' => true, 'is_footer' => true ] ])

@section('meta')

    <meta name="description" content="">
    <title>404 Page Not Found</title>

@endsection

@section('content')

    <!-- Error Page -->
    <section class="site-error">

        <!-- container -->
        <div class="container">

            <!-- content -->
            <div class="site-error__content">

                <!-- number -->
                <div class="site-error__number">
                    <!-- todo -->
                    404
                    {{--<svg width="518" height="178" viewBox="0 0 518 178" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M81.5 165V14.2173C81.5 13.2355 80.2328 12.8416 79.6762 13.6504L13.0782 110.433C12.6217 111.097 13.0966 112 13.902 112H122.5" stroke="#453F9B" stroke-width="25" stroke-linecap="round"/>
                        <path d="M244.113 6.43799C201.87 6.43799 167.5 42.7319 167.5 87.344C167.5 131.951 201.87 168.245 244.113 168.245C286.519 168.245 321.019 131.951 321.019 87.344C321.019 42.7319 286.519 6.43799 244.113 6.43799ZM244.113 141.999C216.685 141.999 193.514 116.971 193.514 87.344C193.514 57.7173 216.685 32.6893 244.113 32.6893C272.016 32.6893 294.713 57.2063 294.713 87.344C294.713 117.477 272.016 141.999 244.113 141.999Z" fill="#453F9B"/>
                        <path d="M311.692 92.6344C270.919 66.5846 238.559 90.4382 243.645 103.331C277.415 84.8961 286.195 122.02 326.037 123.426C361.7 122.074 374.379 100.422 373.453 81.2702C372.732 66.3684 356.112 121.018 311.692 92.6344Z" fill="#FFCE6B"/>
                        <path d="M464 165V14.2173C464 13.2355 462.733 12.8416 462.176 13.6504L395.578 110.433C395.122 111.097 395.597 112 396.402 112H505" stroke="#453F9B" stroke-width="25" stroke-linecap="round"/>
                    </svg> --}}
                </div>
                <!-- end number -->

                <!-- text -->
                <div class="site-error__text">

                    <!-- title -->
                    <h1 class="page-title site-error__title">
                        {{ __( 'Кажется, такой страницы нет...' ) }}
                    </h1>
                    <!-- end title -->

                    <!-- descr -->
                    <div class="site-error__descr">
                        {{ __( 'Возможно, мы удалили эту страницу или Вы ввели неверный адрес в адресной строке' ) }}
                    </div>
                    <!-- end descr -->

                </div>
                <!-- end text -->

                <!-- suggestions -->
                <div class="site-error__suggestions">

                    <!-- title -->
                    <div class="site-error__suggestions-title">
                        {{ __( 'Также ищут' ) }}:
                    </div>
                    <!-- end title -->

                    <!-- list -->
                    {{ \Frontend\Facades\Menu::make(6) }}
                    <!-- end list -->

                </div>
                <!-- end suggestions -->

            </div>
            <!-- end content -->

        </div>
        <!-- end container -->

    </section>
    <!-- End Error Page -->

@endsection
