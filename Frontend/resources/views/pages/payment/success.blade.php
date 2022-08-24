@extends('layouts.app', ['body_class' => 'with-bg'])

@section('meta')

    <meta name="description" content="{{ isset($page->seo) ? $page->seo->description : '' }}">
    <title>{{ isset($page->seo) ? $page->seo->title : '' }}</title>

@endsection

@section('content')

    @if( $page->is_breadcrumbs )
        {{ Breadcrumbs::render('payment') }}
    @endif

    <!-- Section -->
    <div class="payment-sections">

        <!-- Section -->
        <section class="success-payment">

            <!-- container -->
            <div class="container">

                <!-- content -->
                <div class="success-payment__content">

                    <svg width="48" height="35" viewBox="0 0 48 35" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M47.219 1.11454C48.2604 2.15594 48.2604 3.84438 47.219 4.88578L17.8856 34.2191C16.8442 35.2605 15.1558 35.2605 14.1144 34.2191L0.781049 20.8858C-0.26035 19.8444 -0.26035 18.1559 0.781049 17.1145C1.82245 16.0731 3.51089 16.0731 4.55229 17.1145L16 28.5623L43.4477 1.11454C44.4891 0.0731465 46.1776 0.0731465 47.219 1.11454Z" fill="#02A16A"></path>
                    </svg>

                    <!-- title -->
                    <div class="success-payment__title">
                        {{ __( 'Оплата прошла успешно!' ) }}
                    </div>
                    <!-- end title -->

                    <!-- descr -->
                    <div class="success-payment__descr">
                        <p>
                            {{ __( 'Спасибо, Вы успешно оплатили страховой полис' ) }} “{{ $contract->product->name }}”
                        </p>
                        <p>
                            {{ __( 'Номер платежа' ) }}: {{ request()->input('transactionId') }}
                        </p>
                    </div>
                    <!-- end descr -->

                    <!-- download -->
                    <a download="" href="/" class="success-payment__ticket">
                        {{ __( 'Скачать квитанцию' ) }} .pdf
                    </a>
                    <!-- end download -->

                    <!-- mailsend -->
                    <div class="success-payment__mailsend">

                        <!-- title -->
                        <div class="success-payment__mailsend-title">
                            Или отправить квитанцию на e-mail
                        </div>
                        <!-- end title -->

                        <!-- form -->
                        <form action="/" class="success-payment__mailsend-form" method="post">
                            @csrf

                            <input
                                    type="email"
                                    placeholder="E-mail"
                                    class="success-payment__mailsend-input"
                                    id="success-payment-email"
                                    required=""
                                    name="email"
                            >

                            <button
                                    type="submit"
                                    class="success-payment__mailsend-submit"
                                    disabled=""
                            ></button>

                        </form>
                        <!-- form -->

                    </div>
                    <!-- end mailsend -->

                    <!-- socials -->
                    <div class="success-payment__socials">

                        <!-- title -->
                        <div class="success-payment__socials-title">
                            {{ __( 'Следите за статусом страхового полиса у себя в' ) }} <a href="{{ route('profile') }}">{{ __( 'личном кабинете' ) }}</a> {{ __( 'или в чат-ботах' ) }}:
                        </div>
                        <!-- end title -->

                        <!-- list -->
                        <div class="success-payment__socials-list">
                            <a href="/" target="_blank" rel="noindex nofollow noreferrer">
                                            <span>
                                                Telegram-бот
                                            </span>
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M9.52246 19.0309C9.98226 19.0309 10.1854 18.8303 10.4421 18.5923L12.8943 16.3179L9.83543 14.5586" fill="#453F9B"></path>
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M9.83511 14.559L17.247 19.7821C18.0928 20.2272 18.7032 19.9967 18.9139 19.0331L21.931 5.47242C22.2398 4.29121 21.4589 3.75547 20.6497 4.10585L2.93382 10.6215C1.72454 11.0841 1.73159 11.7276 2.71339 12.0144L7.2597 13.3678L17.7849 7.03429C18.2818 6.7469 18.7378 6.90141 18.3635 7.21825" fill="#453F9B"></path>
                                </svg>

                            </a>
                            <a href="/" target="_blank" rel="noindex nofollow noreferrer">
                                            <span>
                                                Viber-бот
                                            </span>
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M21.6677 13.6404C22.2883 8.41703 21.3696 5.11936 19.7125 3.62783L19.7134 3.62696C17.0389 1.07983 8.00647 0.702826 4.80674 3.74136C3.3698 5.22769 2.86367 7.40909 2.8082 10.1096C2.75274 12.811 2.68687 17.8715 7.4024 19.2443H7.40673L7.4024 21.3408C7.4024 21.3408 7.37033 22.1901 7.91287 22.3608C8.5334 22.5619 8.8142 22.1676 10.7443 19.8622C13.9717 20.1422 16.4504 19.5008 16.7321 19.4072C17.3838 19.1888 21.0715 18.7009 21.6677 13.6404ZM11.0623 18.3872C11.0623 18.3872 9.0196 20.9343 8.38433 21.5956C8.17633 21.8105 7.9484 21.7906 7.95187 21.3642C7.95187 21.0842 7.96747 17.8836 7.96747 17.8836C3.96954 16.7379 4.20527 12.4288 4.2486 10.1746C4.29194 7.91956 4.70447 6.07269 5.92127 4.82903C8.7284 2.19696 16.6471 2.78543 18.6647 4.68169C21.1313 6.86829 20.2533 13.0459 20.2585 13.2565C19.7515 17.4806 16.7633 17.7484 16.2138 17.9313C15.9789 18.0093 13.7993 18.57 11.0623 18.3872Z" fill="#453F9B"></path>
                                    <path d="M12.1924 5.32422C11.8587 5.32422 11.8587 5.84422 12.1924 5.84855C14.7811 5.86849 16.9131 7.67289 16.9365 10.9827C16.9365 11.332 17.4479 11.3276 17.4435 10.9784H17.4427C17.4149 7.41202 15.0871 5.34415 12.1924 5.32422Z" fill="#453F9B"></path>
                                    <path d="M15.5976 10.4342C15.5898 10.7791 16.1002 10.7956 16.1046 10.4463C16.147 8.47983 14.9346 6.86003 12.6561 6.68929C12.3224 6.66503 12.2877 7.18936 12.6205 7.21363C14.5965 7.36356 15.6374 8.71209 15.5976 10.4342Z" fill="#453F9B"></path>
                                    <path d="M15.0516 12.6708C14.6235 12.423 14.1875 12.5772 14.0073 12.8208L13.6303 13.3087C13.4387 13.5566 13.0808 13.5236 13.0808 13.5236C10.4687 12.8329 9.77014 10.0994 9.77014 10.0994C9.77014 10.0994 9.73807 9.72936 9.97727 9.53089L10.4487 9.14089C10.6845 8.95369 10.8335 8.50303 10.5935 8.06016C9.95214 6.90143 9.5214 6.50189 9.30214 6.19509C9.0716 5.90649 8.72494 5.84149 8.3644 6.03649H8.3566C7.60694 6.47502 6.7862 7.29576 7.0488 8.14076C7.49687 9.03169 8.3202 11.8718 10.9445 14.0176C12.1777 15.0325 14.1295 16.0725 14.958 16.3126L14.9658 16.3247C15.7822 16.5968 16.5761 15.744 16.9999 14.9718V14.9658C17.1879 14.5922 17.1255 14.2386 16.8508 14.0072C16.3637 13.5323 15.6288 13.008 15.0516 12.6708Z" fill="#453F9B"></path>
                                    <path d="M13.0133 8.62352C13.8462 8.67205 14.2501 9.10712 14.2934 10.0007C14.309 10.3499 14.816 10.3257 14.8004 9.97639C14.7449 8.80985 14.1365 8.15985 13.041 8.09919C12.7074 8.07925 12.6762 8.60359 13.0133 8.62352Z" fill="#453F9B"></path>
                                </svg>

                            </a>
                        </div>
                        <!-- end list -->

                    </div>
                    <!-- end socials -->

                </div>
                <!-- end content -->

            </div>
            <!-- end container -->

        </section>
        <!-- End Section -->

    </div>
    <!-- End Section -->

@endsection

