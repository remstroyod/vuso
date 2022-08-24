@extends('layouts.app', ['body_class' => 'with-bg'])

@section('meta')

    <meta name="description" content="{{ ($page->seo) ? $page->seo->description : '' }}">
    <title>{{ ($page->seo) ? $page->seo->title : '' }}</title>

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
                        {{ __( 'Ошибка оплаты' ) }}
                    </div>
                    <!-- end title -->

                    <!-- descr -->
                    <div class="success-payment__descr">
                        <p>
                            {{ __( 'При оплате произошла ошибка' ) }}
                        </p>
                    </div>
                    <!-- end descr -->

                </div>
                <!-- end content -->

            </div>
            <!-- end container -->

        </section>
        <!-- End Section -->

    </div>
    <!-- End Section -->

@endsection
