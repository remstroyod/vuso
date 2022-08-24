@isset( $page )

    @if( $page->is_header )

        <!-- Header -->
        <header class="header">

            <!-- container -->
            <div class="container">

                <!-- row -->
                <div class="row align-items-center justify-content-between">

                    <!-- logo -->
                    <a href="{{ route('home') }}" class="col-auto header__logo">
                        @if( settings('site_logo') )
                            <picture>
                                @if ( Storage::disk('public')->exists('images/settings/' . settings('site_logo')) )
                                    <source
                                        srcset="{{ Storage::url('images/settings/' . settings('site_logo')) }}"
                                        media="(min-width: 768px)"
                                    >
                                @endif
                                @if ( Storage::disk('public')->exists('images/settings/' . settings('site_logo_mobile')) )
                                    <img
                                        src="{{ Storage::url('images/settings/' . settings('site_logo_mobile')) }}"
                                        alt="{{ settings('site_name') }}"
                                        title="{{ settings('site_name') }}"
                                    >
                                @endif
                            </picture>
                        @endif
                    </a>
                    <!-- end logo -->

                    <!-- menu -->
                    <div class="col-auto header__menu">

                        <!-- button -->
                        <button class="header__btn header__menu__btn black">
                            <svg width="16" height="14" viewBox="0 0 16 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M0.5 1.00008C0.5 0.539844 0.873096 0.166748 1.33333 0.166748H14.6667C15.1269 0.166748 15.5 0.539844 15.5 1.00008C15.5 1.46032 15.1269 1.83341 14.6667 1.83341H1.33333C0.873096 1.83341 0.5 1.46032 0.5 1.00008Z" fill="currentColor"/>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M0.5 6.00008C0.5 5.53984 0.873096 5.16675 1.33333 5.16675H14.6667C15.1269 5.16675 15.5 5.53984 15.5 6.00008C15.5 6.46032 15.1269 6.83342 14.6667 6.83342H1.33333C0.873096 6.83342 0.5 6.46032 0.5 6.00008Z" fill="currentColor"/>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M0.5 11.0001C0.5 10.5398 0.873096 10.1667 1.33333 10.1667H14.6667C15.1269 10.1667 15.5 10.5398 15.5 11.0001C15.5 11.4603 15.1269 11.8334 14.6667 11.8334H1.33333C0.873096 11.8334 0.5 11.4603 0.5 11.0001Z" fill="currentColor"/>
                            </svg>
                            <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M12.8432 1.1568C13.3856 1.69919 13.3856 2.57859 12.8432 3.12098L3.12098 12.8432C2.57859 13.3856 1.69919 13.3856 1.1568 12.8432C0.614401 12.3008 0.614401 11.4214 1.1568 10.879L10.879 1.1568C11.4214 0.614401 12.3008 0.614401 12.8432 1.1568Z" fill="#151826"/>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M1.1568 1.1568C1.69919 0.614401 2.57859 0.614401 3.12098 1.1568L12.8432 10.879C13.3856 11.4214 13.3856 12.3008 12.8432 12.8432C12.3008 13.3856 11.4214 13.3856 10.879 12.8432L1.1568 3.12098C0.614401 2.57859 0.614401 1.69919 1.1568 1.1568Z" fill="#151826"/>
                            </svg>

                            <span>{{ __( 'Меню' ) }}</span>
                        </button>
                        <!-- end button -->

                        <!-- menu -->
                        <div class="header__dropdown-menu header__site-menu">

                            <!-- container -->
                            <div class="container">

                                @include( 'forms.search', ['class' => 'header__search'] )

                                <!-- content -->
                                <div class="header__site-menu__content">

                                    <!-- main -->
                                    {{ \Frontend\Facades\Menu::make(1) }}
                                    <!-- end main -->

                                    <!-- secondary -->
                                    {{ \Frontend\Facades\Menu::make(2) }}
                                    <!-- end secondary -->

                                    <!-- phone -->
                                    <div class="header__site-menu__lang-phone">
                                        <div class="header__site-menu__lang">
                                            <a class="{{app()->getLocale() === 'ru' ? 'disabledLink' : '' }}" href="{{ changeLocal('ru') }}">RU</a>
                                            <a class="{{app()->getLocale() === 'ua' ? 'disabledLink' : '' }}" href="{{ changeLocal('ua') }}">UA</a>
                                        </div>
                                        <div class="header__site-menu__phone">
                                            <a href="tel:0800503773">0 800 50 37 73</a>
                                        </div>
                                    </div>
                                    <!-- end phone -->

                                    <!-- socials -->
                                    <div class="header__site-menu__socials">
                                        {{ \Frontend\Facades\Menu::make(5) }}
                                    </div>
                                    <!-- end socials -->

                                    <!-- footer -->
                                    <div class="header__site-menu__footer">
                                        {{ \Frontend\Facades\Menu::make(10) }}
                                        {{ \Frontend\Facades\Menu::make(9) }}
                                    </div>
                                    <!-- end footer -->

                                </div>
                                <!-- end content -->

                            </div>
                            <!-- end container -->

                        </div>
                        <!-- end menu -->

                    </div>
                    <!-- end menu -->

                    <!-- case -->
                    <div class="col-auto header__insurance-case">
                        <button class="header__btn header__insurance-case__btn red">
                            <span>
                                {{ __( 'Страховой случай' ) }}
                            </span>
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M7.98992 0.501674C5.98608 0.534478 4.07565 1.35452 2.6716 2.78454C1.96908 3.48395 1.4148 4.31782 1.04187 5.2363C0.66895 6.15478 0.485047 7.13902 0.501157 8.13019C0.500004 9.0987 0.689994 10.0579 1.06024 10.9529C1.43048 11.8478 1.9737 12.6609 2.65876 13.3455C3.34383 14.0302 4.15726 14.5729 5.05246 14.9426C5.94766 15.3123 6.90702 15.5017 7.87555 15.5H8.00929C10.0137 15.4794 11.9281 14.6645 13.3324 13.2341C14.7367 11.8037 15.5163 9.87464 15.4999 7.87022C15.5022 6.88997 15.3085 5.91914 14.9301 5.01485C14.5518 4.11055 13.9964 3.29104 13.2967 2.6045C12.597 1.91797 11.767 1.37827 10.8557 1.01714C9.94434 0.656018 8.96998 0.48076 7.98992 0.501674ZM7.06312 10.8393C7.05861 10.7167 7.07859 10.5945 7.12186 10.4798C7.16514 10.3651 7.23086 10.2601 7.31518 10.1711C7.3995 10.0821 7.50072 10.0108 7.61292 9.96131C7.72513 9.91186 7.84607 9.88528 7.96867 9.88312H7.98554C8.23215 9.88359 8.46901 9.97952 8.64645 10.1508C8.82389 10.322 8.92813 10.5553 8.93734 10.8018C8.94193 10.9243 8.92202 11.0466 8.87877 11.1613C8.83552 11.2761 8.76981 11.3811 8.68547 11.4701C8.60114 11.5591 8.49989 11.6305 8.38764 11.6799C8.2754 11.7293 8.15442 11.7558 8.03179 11.7579H8.01492C7.7684 11.7571 7.53172 11.6611 7.35435 11.4899C7.17698 11.3187 7.07263 11.0856 7.06312 10.8393ZM7.37559 8.3133V4.56372C7.37559 4.39798 7.44144 4.23902 7.55864 4.12183C7.67584 4.00463 7.8348 3.93879 8.00054 3.93879C8.16629 3.93879 8.32525 4.00463 8.44245 4.12183C8.55965 4.23902 8.62549 4.39798 8.62549 4.56372V8.3133C8.62549 8.47904 8.55965 8.63799 8.44245 8.75519C8.32525 8.87239 8.16629 8.93823 8.00054 8.93823C7.8348 8.93823 7.67584 8.87239 7.55864 8.75519C7.44144 8.63799 7.37559 8.47904 7.37559 8.3133Z" fill="currentColor"/>
                            </svg>
                        </button>
                    </div>
                    <!-- end case -->

                    <!-- auth -->
                    <div class="col-auto header__auth">
                        @auth
                            <a class="header__btn header__auth-btn black" href="{{ route( 'profile' ) }}">
                                {{ __( 'Мой кабинет' ) }}
                            </a>
                        @endauth
                        @guest
                            <!-- button -->
                            <button class="header__btn header__auth-btn black" id="auth-modal" data-bs-toggle="modal" data-bs-target="#modal-auth">
                                <span>
                                    {{ __( 'Войти' ) }}
                                </span>
                                <svg width="14" height="16" viewBox="0 0 14 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6.90541 7.72557C7.89691 7.72557 8.75536 7.36954 9.45698 6.66711C10.1584 5.96478 10.5141 5.10545 10.5141 4.11267C10.5141 3.12024 10.1585 2.26079 9.45687 1.55824C8.75525 0.856026 7.8968 0.5 6.90541 0.5C5.91379 0.5 5.05545 0.856026 4.35395 1.55835C3.65244 2.26067 3.29671 3.12013 3.29671 4.11267C3.29671 5.10545 3.65244 5.9649 4.35395 6.66722C5.05568 7.36943 5.91413 7.72557 6.90541 7.72557Z" fill="currentColor"/>
                                    <path d="M13.2196 12.0343C13.1994 11.742 13.1585 11.4232 13.0983 11.0865C13.0374 10.7473 12.9591 10.4266 12.8654 10.1335C12.7685 9.8306 12.6369 9.53145 12.474 9.24477C12.3052 8.94723 12.1067 8.68813 11.8841 8.47493C11.6512 8.25189 11.3661 8.07256 11.0365 7.94175C10.708 7.81163 10.3439 7.74571 9.95445 7.74571C9.80151 7.74571 9.65359 7.80854 9.36794 7.99474C9.19213 8.10952 8.98649 8.24227 8.75696 8.3891C8.5607 8.5143 8.29482 8.6316 7.96641 8.7378C7.64601 8.8416 7.32069 8.89424 6.99948 8.89424C6.67851 8.89424 6.35319 8.8416 6.03255 8.7378C5.70449 8.63171 5.4385 8.51441 5.24257 8.38921C5.01521 8.24376 4.80946 8.11101 4.63103 7.99462C4.3456 7.80843 4.19769 7.7456 4.04474 7.7456C3.65518 7.7456 3.29123 7.81163 2.96282 7.94186C2.63339 8.07244 2.34819 8.25177 2.11512 8.47504C1.89244 8.68836 1.69401 8.94734 1.52529 9.24477C1.36263 9.53145 1.23095 9.83048 1.13401 10.1336C1.04039 10.4267 0.962094 10.7473 0.901282 11.0865C0.840928 11.4227 0.80012 11.7416 0.779888 12.0346C0.759998 12.3211 0.749939 12.6192 0.749939 12.9204C0.749939 13.7034 0.998558 14.3373 1.48882 14.8048C1.97303 15.2661 2.61361 15.5 3.39285 15.5H10.607C11.386 15.5 12.0266 15.2661 12.5109 14.8048C13.0013 14.3376 13.2499 13.7035 13.2499 12.9203C13.2498 12.618 13.2397 12.3199 13.2196 12.0343Z" fill="currentColor"/>
                                </svg>
                            </button>
                            <!-- end button -->
                        @endguest

                    </div>
                    <!-- end auth -->

                    <!-- insure -->
                    <div class="col-auto header__insure">

                        <!-- button -->
                        <button class="header__btn header__insure-btn black">
                            <span>
                                {{ __( 'Застраховать' ) }}
                            </span>
                            <svg width="10" height="8" viewBox="0 0 10 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M0.123078 1.2098L4.2704 7.61558C4.34637 7.73291 4.45343 7.82993 4.58124 7.89728C4.70905 7.96462 4.85329 8 5 8C5.14671 8 5.29095 7.96462 5.41876 7.89728C5.54657 7.82993 5.65363 7.73291 5.7296 7.61558L9.87692 1.2098C9.95515 1.08889 9.99759 0.950714 9.9999 0.809424C10.0022 0.668135 9.96431 0.52881 9.89008 0.405718C9.81584 0.282626 9.70794 0.180189 9.57743 0.108899C9.44692 0.0376082 9.29848 2.58748e-05 9.14732 0L0.852676 6.52627e-07C0.701516 2.65512e-05 0.553079 0.0376089 0.422566 0.108899C0.292054 0.18019 0.184157 0.282627 0.109924 0.405719C0.0356902 0.528811 -0.00221169 0.668136 9.97367e-05 0.809425C0.00241117 0.950714 0.0448523 1.08889 0.123078 1.2098Z" fill="currentColor"/>
                            </svg>
                        </button>
                        <!-- end button -->

                        <!-- menu -->
                        <div class="header__dropdown-menu header__insure-menu">

                            <!-- container -->
                            <div class="container">

                                @include( 'forms.search', ['class' => 'header__search'] )

                                <!-- sections -->
                                <div class="header__insure-menu__sections">

                                    @isset( $catalog_categories )

                                        @if( $catalog_categories )

                                            @foreach( $catalog_categories as $category )

                                                @include( 'partials.loop.menu-catalog' )

                                            @endforeach

                                        @endif

                                    @endisset

                                </div>
                                <!-- end sections -->

                                <!-- footer -->
                                <div class="header__insure-menu__footer">
                                    {{ \Frontend\Facades\Menu::make(10) }}
                                    {{ \Frontend\Facades\Menu::make(11) }}
                                    {{ \Frontend\Facades\Menu::make(9) }}
                                </div>
                                <!-- end footer -->

                            </div>
                            <!-- end container -->

                        </div>
                        <!-- end menu -->

                    </div>
                    <!-- end insure -->

                </div>
                <!-- end row -->

            </div>
            <!-- end container -->

            @includeWhen( auth()->check() && $cartContent->count(), 'partials.cart.mini-cart' )

        </header>
        <!-- End Header -->

    @endif

@endisset
