@extends('layouts.app')

@section('meta')

    <meta name="description" content="{{ ($page->seo) ? $page->seo->description : '' }}">
    <title>{{ ($page->seo) ? $page->seo->title : '' }}</title>

@endsection

@section('content')

    @if( $blocks->count() )

        @foreach( $blocks as $block)

            @include( 'components.' . $block->component, ['block' => $block] )

        @endforeach

    @else

        <section class="widget">
            <iframe src="{{ asset('assets/app/interactive-app.html') }}" height="768" id="widget-frame"></iframe>
        </section>

        @if( $slider )

            <!-- Slider -->
            <section class="cta">

                <!-- container -->
                <div class="container">

                    <!-- swiper -->
                    <div class="cta__slider swiper-container">

                        <!-- wrapper -->
                        <div class="swiper-wrapper">

                        @foreach( $slider as $slide )

                            <!-- slide -->
                                <div class="cta__slide swiper-slide">

                                    <!-- inner -->
                                    <div class="cta__slide__inner">

                                    @if ( $slide->image && Storage::disk('public')->exists('images/home/slider/' . $slide->image) )
                                        <!-- image -->
                                            <picture class="cta__slide__bg">
                                                <source srcset="{{ Storage::url('images/home/slider/' . $slide->image) }}" media="(min-width: 768px)">
                                                <img
                                                        src="{{ Storage::url('images/home/slider/' . $slide->image) }}"
                                                        alt="{{ $slide->name }}"
                                                        title="{{ $slide->name }}"
                                                >
                                            </picture>
                                            <!-- end image -->
                                    @endif

                                    <!-- content -->
                                        <div class="cta__slide__content">

                                            <!-- title -->
                                            <h2 class="cta__slide__title">
                                                {{ $slide->name }}
                                            </h2>
                                            <!-- end title -->

                                        @if( $slide->excerpt )
                                            <!-- excerpt -->
                                                <div class="cta__slide__descr">
                                                    {!! $slide->excerpt !!}
                                                </div>
                                                <!-- end excerpt -->
                                        @endif

                                        @if( $slide->url )
                                            <!-- excerpt -->
                                                <a href="{{ $slide->url }}" class="btn yellow cta__slide__btn">
                                                    <span>{{ __( 'Подробнее' ) }}</span>
                                                    <svg width="10" height="17" viewBox="0 0 10 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M0.91708 16.3412C0.627632 16.0452 0.627632 15.5653 0.91708 15.2693L7.31064 8.73155L0.91708 2.19378C0.627632 1.89781 0.627632 1.41793 0.91708 1.12196C1.20653 0.825982 1.67581 0.825982 1.96526 1.12196L8.88291 8.19564C9.17236 8.49162 9.17236 8.97149 8.88291 9.26747L1.96526 16.3412C1.67581 16.6371 1.20653 16.6371 0.91708 16.3412Z" fill="currentColor"/>
                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M0.702595 16.5509C0.299127 16.1383 0.299127 15.4721 0.702595 15.0596L6.89103 8.73155L0.702595 2.40354C0.299127 1.99097 0.299127 1.32477 0.702595 0.912205C1.10972 0.495899 1.77262 0.495899 2.17975 0.912205L9.09739 7.98589C9.50086 8.39846 9.50086 9.06465 9.09739 9.47722L2.17975 16.5509C1.77262 16.9672 1.10972 16.9672 0.702595 16.5509ZM1.13156 15.4791C0.956137 15.6585 0.956137 15.952 1.13156 16.1314C1.30334 16.307 1.579 16.307 1.75078 16.1314L8.66843 9.05771C8.84385 8.87833 8.84385 8.58478 8.66843 8.4054L1.75078 1.33171C1.579 1.15606 1.30334 1.15606 1.13156 1.33171C0.956137 1.5111 0.956137 1.80465 1.13156 1.98403L7.52512 8.5218C7.63914 8.63839 7.63914 8.82472 7.52512 8.94131L1.13156 15.4791Z" fill="currentColor"/>
                                                    </svg>
                                                </a>
                                                <!-- end excerpt -->
                                            @endif

                                        </div>
                                        <!-- end content -->

                                    </div>
                                    <!-- end inner -->

                                </div>
                                <!-- end slide -->

                            @endforeach

                        </div>
                        <!-- end wrapper -->

                        <!-- pagination -->
                        <div class="swiper-pagination"></div>
                        <!-- end agination -->

                    </div>
                    <!-- end swiper -->

                </div>
                <!-- end container -->

            </section>
            <!-- End Slider -->

        @endif

        <!-- Insurance -->
        <section class="insurance">

            <!-- container -->
            <div class="container">

                <!-- row -->
                <div class="row">

                    <!-- col -->
                    <div class="col col-4 insurance__text">

                        <!-- title -->
                        <h2 class="block-title">
                            {{ __( 'Что страхуем?' ) }}
                        </h2>
                        <!-- end title -->

                        <!-- excerpt -->
                        <div class="insurance__descr">
                            {{ __( 'Мы 19 лет выплачиваем своим клиентам компенсацию. Делаем и делали это без промедления даже во времена всех 3-х экономических кризисов, которые переживала Украина.' ) }}
                        </div>
                        <!-- end excerpt -->

                    </div>
                    <!-- end col -->

                    <!-- col -->
                    <div class="col col-8 insurance__cards">

                        <!-- card -->
                        <div class="insurance__card">

                            <!-- image -->
                            <div class="insurance__card__image">
                                <img
                                        src="{{ asset('assets/app/img/temp/card-1.jpg') }}"
                                        alt=""
                                        title=""
                                >
                            </div>
                            <!-- end image -->

                            <!-- info -->
                            <div class="insurance__card__info">

                                <!-- title -->
                                <div class="insurance__card__title">
                                    Машину
                                </div>
                                <!-- end title -->

                                <!-- excerpt -->
                                <div class="insurance__card__descr">
                                    Все обязательные и добровольные виды страхования с возможностью дополнительного покрытия
                                </div>
                                <!-- end excerpt -->

                                <!-- control -->
                                <div class="insurance__card__control">

                                    <!-- link -->
                                    <a href="/" class="insurance__card__link">
                                                    <span class="icon">
                                                        <svg width="17" height="15" viewBox="0 0 17 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M15.895 5.59755L14.7548 1.73449C14.4948 0.853495 13.7123 0.261963 12.8078 0.261963H5.17497C4.27048 0.261963 3.48804 0.853496 3.22805 1.73449L2.08782 5.59755C1.36784 5.91556 0.862381 6.64382 0.862381 7.49147V11.6226C0.862381 12.193 1.31736 12.6554 1.87851 12.6554H1.87857L1.87851 13.6881C1.87851 14.2585 2.33342 14.721 2.89464 14.721H3.91083C4.47198 14.721 4.92696 14.2585 4.92696 13.6882L4.92652 12.6554H13.0559L13.0559 13.6881C13.0559 14.2585 13.5108 14.721 14.072 14.721H15.0882C15.6494 14.721 16.1043 14.2585 16.1043 13.6882V12.6555L16.1039 12.6554H16.1043C16.6655 12.6554 17.1204 12.193 17.1204 11.6226V7.49147C17.1204 6.64382 16.615 5.91556 15.895 5.59754L15.895 5.59755ZM5.17494 2.32754H12.8078L13.7224 5.4259H4.2604L5.17494 2.32754H5.17494ZM4.92687 10.0734C4.36565 10.0734 3.91074 9.611 3.91074 9.04065C3.91074 8.47023 4.36565 8.00786 4.92687 8.00786C5.48808 8.00786 5.94299 8.47023 5.94299 9.04065C5.94299 9.611 5.48808 10.0734 4.92687 10.0734ZM13.0559 10.0734C12.4947 10.0734 12.0398 9.611 12.0398 9.04065C12.0398 8.47023 12.4947 8.00786 13.0559 8.00786C13.6171 8.00786 14.072 8.47023 14.072 9.04065C14.072 9.611 13.6171 10.0734 13.0559 10.0734Z" fill="white"/>
                                                        </svg>
                                                    </span>
                                        <span class="text">Автострахование</span>
                                    </a>
                                    <!-- end link -->

                                </div>
                                <!-- end control -->

                            </div>
                            <!-- end info -->

                        </div>
                        <!-- end card -->

                        <!-- card -->
                        <div class="insurance__card">
                            <div class="insurance__card__image">
                                <img src="{{ asset('assets/app/img/temp/card-2.jpg') }}" alt="">
                            </div>
                            <div class="insurance__card__info">
                                <div class="insurance__card__title">Путешествие</div>
                                <div class="insurance__card__descr">Страхование выезжающих за границу, в том числе от невыезда за границу из-за коронавируса</div>
                                <div class="insurance__card__control">
                                    <a href="/" class="insurance__card__link">
                                                    <span class="icon">
                                                        <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M0.136026 15.4843L7.77162 3.1419L6.43582 1.07569C6.25704 0.799123 6.33617 0.43037 6.61273 0.251591C6.8893 0.0728127 7.2588 0.151565 7.43795 0.428877L8.49942 2.07222L9.56239 0.428503C9.74117 0.151938 10.1107 0.0728127 10.3869 0.251591C10.6634 0.43037 10.7426 0.799497 10.5645 1.07606L9.22909 3.14228L16.8643 15.4847C17.0364 15.759 17.0457 16.1028 16.8886 16.3861C16.7318 16.6697 16.4332 16.8433 16.1096 16.8433H12.73C12.4251 16.8433 12.1407 16.6876 11.9757 16.4312L9.10443 11.9498C8.97231 11.7438 8.74464 11.6195 8.50017 11.6195C8.25608 11.6195 8.02803 11.7438 7.89591 11.9502L5.02612 16.4312C4.8619 16.6884 4.57749 16.844 4.27182 16.844H0.891076C0.56711 16.844 0.268524 16.6705 0.111766 16.3864C-0.0449918 16.1024 -0.0360342 15.7587 0.136026 15.4843Z" fill="white"/>
                                                        </svg>
                                                    </span>
                                        <span class="text">Туристическое страхование</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- end card -->

                        <!-- card -->
                        <div class="insurance__card">
                            <div class="insurance__card__image">
                                <img src="{{ asset('assets/app/img/temp/card-3.jpg') }}" alt="">
                            </div>
                            <div class="insurance__card__info">
                                <div class="insurance__card__title">Недвижимость</div>
                                <div class="insurance__card__descr">Страхование недвижимости, отделки, предметов домашнего обихода, ответственности</div>
                                <div class="insurance__card__control">
                                    <a href="/" class="insurance__card__link">
                                                    <span class="icon">
                                                        <svg width="17" height="18" viewBox="0 0 17 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M16.5433 7.39493C16.543 7.39455 16.5426 7.39416 16.5422 7.39377L9.60682 0.458665C9.3112 0.162919 8.91817 0 8.50011 0C8.08204 0 7.68901 0.16279 7.39327 0.458535L0.461536 7.39013C0.459201 7.39247 0.456866 7.39493 0.454532 7.39727C-0.152525 8.00783 -0.151487 8.99845 0.457515 9.60745C0.735749 9.88581 1.10323 10.047 1.49613 10.0639C1.51208 10.0655 1.52817 10.0662 1.54438 10.0662H1.8208V15.1701C1.8208 16.18 2.64253 17.0017 3.65273 17.0017H6.36607C6.64106 17.0017 6.86417 16.7788 6.86417 16.5036V12.5023C6.86417 12.0414 7.23904 11.6665 7.69991 11.6665H9.30031C9.76118 11.6665 10.136 12.0414 10.136 12.5023V16.5036C10.136 16.7788 10.359 17.0017 10.6341 17.0017H13.3475C14.3577 17.0017 15.1794 16.18 15.1794 15.1701V10.0662H15.4357C15.8537 10.0662 16.2467 9.90345 16.5426 9.60771C17.1522 8.99767 17.1525 8.00536 16.5433 7.39493Z" fill="white"/>
                                                        </svg>
                                                    </span>
                                        <span class="text">Страхование имущества</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- end card -->

                        <!-- card -->
                        <div class="insurance__card">
                            <div class="insurance__card__image">
                                <img src="{{ asset('assets/app/img/temp/card-4.jpg') }}" alt="">
                            </div>
                            <div class="insurance__card__info">
                                <div class="insurance__card__title">Себя и близких</div>
                                <div class="insurance__card__descr">Страхование жизни и здоровья <br>от несчастных случаев, болезней</div>
                                <div class="insurance__card__control">
                                    <a href="/" class="insurance__card__link">
                                                    <span class="icon">
                                                        <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M8.49532 2.24093C4.78983 -1.00004 0.0783684 1.84757 0.00111063 5.70797C-0.0185773 6.6918 0.265421 7.65014 0.830727 8.53364H4.49488L5.14661 7.44738C5.33585 7.13201 5.79382 7.12185 5.99378 7.43626L7.36885 9.59706L9.37327 5.36561C9.54807 4.99638 10.069 4.98466 10.2618 5.3427L11.98 8.53364H16.1599C19.2563 3.69432 13.1368 -1.81867 8.49532 2.24093Z" fill="white"/>
                                                            <path d="M11.2429 9.26746L9.85059 6.68176L7.88176 10.8381C7.71426 11.1918 7.2216 11.2225 7.01154 10.8923L5.58491 8.65053L5.20267 9.28758C5.11267 9.43758 4.95058 9.52935 4.77565 9.52935H1.61734C1.71634 9.63296 1.18869 9.10637 8.14285 16.0245C8.33707 16.2178 8.65105 16.2178 8.84531 16.0245C15.6925 9.21281 15.272 9.63276 15.3708 9.52935H11.6814C11.4981 9.52938 11.3297 9.42878 11.2429 9.26746Z" fill="white"/>
                                                        </svg>
                                                    </span>
                                        <span class="text">Страхование жизни <br>и здоровья</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- end card -->

                    </div>
                    <!-- end col -->

                </div>
                <!-- end row -->

            </div>
            <!-- end container -->

        </section>
        <!-- End Insurance -->

        @include( 'cta.cta-9' )

        @include( 'partials.last-reviews' )

        @if( $page->video )

            <!-- Video -->
            <section class="livecam">

                <!-- container -->
                <div class="container">

                    <!-- inner -->
                    <div class="livecam__inner">

                        <!-- button -->
                        <a href="{{ $page->video }}" class="livecam__control" data-bs-toggle="modal" data-bs-target="#modal-video">
                            <svg width="23" height="30" viewBox="0 0 23 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M0.499817 1.83166C0.499817 1.0405 1.37506 0.562658 2.04057 0.990487L22.5247 14.1588C23.137 14.5525 23.137 15.4475 22.5247 15.8412L2.04057 29.0095C1.37506 29.4373 0.499817 28.9595 0.499817 28.1683V1.83166Z" fill="white"/>
                            </svg>
                            <span>{{ __( 'Vuso Life' ) }}</span>
                        </a>
                        <!-- end button -->

                    @if ( Storage::disk('public')->exists('images/home/' . $page->video_poster) )
                        <!-- image -->
                            <picture class="livecam__bg">
                                <source
                                        srcset="{{ Storage::url('images/home/' . $page->video_poster) }}"
                                        media="(min-width: 768px)"
                                >
                                <img
                                        src="{{ Storage::url('images/home/slider/' . $page->video_poster) }}"
                                        alt="{{ __( 'Vuso Life' ) }}"
                                        title="{{ __( 'Vuso Life' ) }}"
                                >
                            </picture>
                            <!-- end image -->
                        @endif

                    </div>
                    <!-- end inner -->

                </div>
                <!-- end container -->

            </section>
            <!-- End Video -->

        @endif

        <!-- About -->
        <section class="about">

            <!-- container -->
            <div class="container">

                <!-- row -->
                <div class="row">

                    <!-- text -->
                    <div class="col-4 about__text">

                        <!-- title -->
                        <h2 class="block-title about__title">
                            {{ __( 'О нас' ) }}
                        </h2>
                        <!-- end title -->

                        <!-- description -->
                        <div class="about__descr">
                            <p>
                                ВУСО – украинская страховая компания, поэтому мы знаем и понимаем украинцев.
                            </p>
                            <p>
                                Мы, действительно, хотим улучшить качество жизни наших сограждан, предостерегая <br>их от рисков и лишних хлопот
                            </p>
                        </div>
                        <!-- end description -->

                        <!-- link -->
                        <a href="/about" class="about__link">
                        <span>
                            {{ __( 'Читать' ) }}
                        </span>
                            <svg width="10" height="17" viewBox="0 0 10 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M0.91711 15.8412C0.627663 15.5452 0.627663 15.0653 0.91711 14.7693L7.31067 8.23155L0.91711 1.69378C0.627663 1.39781 0.627663 0.917934 0.91711 0.621958C1.20656 0.325982 1.67584 0.325982 1.96529 0.621958L8.88294 7.69564C9.17239 7.99162 9.17239 8.47149 8.88294 8.76747L1.96529 15.8412C1.67584 16.1371 1.20656 16.1371 0.91711 15.8412Z" fill="currentColor"/>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M0.702626 16.0509C0.299157 15.6383 0.299157 14.9721 0.702626 14.5596L6.89106 8.23155L0.702626 1.90354C0.299157 1.49097 0.299157 0.824773 0.702626 0.412205C1.10975 -0.00410099 1.77265 -0.00410099 2.17978 0.412205L9.09743 7.48589C9.50089 7.89846 9.50089 8.56465 9.09743 8.97722L2.17978 16.0509C1.77265 16.4672 1.10975 16.4672 0.702626 16.0509ZM1.13159 14.9791C0.956168 15.1585 0.956168 15.452 1.13159 15.6314C1.30337 15.807 1.57903 15.807 1.75081 15.6314L8.66846 8.55771C8.84388 8.37833 8.84388 8.08478 8.66846 7.9054L1.75081 0.831711C1.57903 0.656064 1.30337 0.656064 1.13159 0.831711C0.956168 1.0111 0.956168 1.30465 1.13159 1.48403L7.52515 8.0218C7.63917 8.13839 7.63917 8.32472 7.52515 8.44131L1.13159 14.9791Z" fill="currentColor"/>
                            </svg>
                        </a>
                        <!-- end link -->

                    </div>
                    <!-- end text -->

                    <!-- banner -->
                    <div class="col-8 about__banner">
                        <picture>
                            <source
                                    srcset="{{ asset('assets/app/img/temp/about-banner-desktop.jpg') }}"
                                    media="(min-width: 768px)"
                            >
                            <img
                                    src="{{ asset('assets/app/img/temp/about-banner-desktop.jpg') }}"
                                    alt="{{ __( 'О нас' ) }}"
                                    title="{{ __( 'О нас' ) }}"
                            >
                        </picture>
                    </div>
                    <!-- end banner -->

                </div>
                <!-- end row -->

            </div>
            <!-- end container -->

        </section>
        <!-- End About -->

    @endif

@endsection
