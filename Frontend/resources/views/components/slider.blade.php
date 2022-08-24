{{--Component: Слайдер :Component--}}
{{--Fields: title :Fields--}}
@if( $block )

    <!-- Slider -->
    <section class="cta wow animate__fadeIn" data-wow-delay=".15s" data-wow-offset="200">

        <!-- container -->
        <div class="container">

            <!-- swiper -->
            <div class="cta__slider swiper-container">

                <!-- wrapper -->
                <div class="swiper-wrapper">

                    @foreach( $block->elements as $item )

                        <!-- slide -->
                        <div class="cta__slide swiper-slide">

                            <!-- inner -->
                            <div class="cta__slide__inner">

                            @if ( $item->image && Storage::disk('public')->exists('images/blocks/elements/' . $item->image) )
                                <!-- image -->
                                    <picture class="cta__slide__bg">
                                        <source srcset="{{ Storage::url('images/blocks/elements/' . $item->image) }}" media="(min-width: 768px)">
                                        <img
                                                src="{{ Storage::url('images/blocks/elements/' . $item->image) }}"
                                                alt="{{ $item->name }}"
                                                title="{{ $item->name }}"
                                        >
                                    </picture>
                                    <!-- end image -->
                            @endif

                            <!-- content -->
                                <div class="cta__slide__content">

                                    <!-- title -->
                                    <h2 class="cta__slide__title">
                                        {{ $item->title }}
                                    </h2>
                                    <!-- end title -->

                                @if( $item->excerpt )
                                    <!-- excerpt -->
                                        <div class="cta__slide__descr">
                                            {!! $item->excerpt !!}
                                        </div>
                                        <!-- end excerpt -->
                                @endif

                                @if( $item->link )
                                    <!-- excerpt -->
                                        <a href="{{ $item->link }}" class="btn yellow cta__slide__btn">
                                            <span>{{ $item->linktext }}</span>
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
