{{--Component: О компании :Component--}}
{{--Fields: title, description, link, linktext, image :Fields--}}
@if( $block )

    <!-- About -->
    <section class="about wow animate__fadeIn" data-wow-delay=".2s" data-wow-offset="30">

        <!-- container -->
        <div class="container">

            <!-- row -->
            <div class="row">

                <!-- text -->
                <div class="col-4 about__text">

                    @if( $block->title )
                        <!-- title -->
                        <h2 class="block-title about__title">
                            {{ $block->title }}
                        </h2>
                        <!-- end title -->
                    @endif

                    @if( $block->description )
                        <!-- description -->
                        <div class="about__descr">
                            {!! $block->description !!}
                        </div>
                        <!-- end description -->
                    @endif

                    @if( $block->link )
                        <!-- link -->
                        <a href="{{ $block->link }}" class="about__link">
                            <span>
                                {{ $block->linktext }}
                            </span>
                            <svg width="10" height="17" viewBox="0 0 10 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M0.91711 15.8412C0.627663 15.5452 0.627663 15.0653 0.91711 14.7693L7.31067 8.23155L0.91711 1.69378C0.627663 1.39781 0.627663 0.917934 0.91711 0.621958C1.20656 0.325982 1.67584 0.325982 1.96529 0.621958L8.88294 7.69564C9.17239 7.99162 9.17239 8.47149 8.88294 8.76747L1.96529 15.8412C1.67584 16.1371 1.20656 16.1371 0.91711 15.8412Z" fill="currentColor"/>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M0.702626 16.0509C0.299157 15.6383 0.299157 14.9721 0.702626 14.5596L6.89106 8.23155L0.702626 1.90354C0.299157 1.49097 0.299157 0.824773 0.702626 0.412205C1.10975 -0.00410099 1.77265 -0.00410099 2.17978 0.412205L9.09743 7.48589C9.50089 7.89846 9.50089 8.56465 9.09743 8.97722L2.17978 16.0509C1.77265 16.4672 1.10975 16.4672 0.702626 16.0509ZM1.13159 14.9791C0.956168 15.1585 0.956168 15.452 1.13159 15.6314C1.30337 15.807 1.57903 15.807 1.75081 15.6314L8.66846 8.55771C8.84388 8.37833 8.84388 8.08478 8.66846 7.9054L1.75081 0.831711C1.57903 0.656064 1.30337 0.656064 1.13159 0.831711C0.956168 1.0111 0.956168 1.30465 1.13159 1.48403L7.52515 8.0218C7.63917 8.13839 7.63917 8.32472 7.52515 8.44131L1.13159 14.9791Z" fill="currentColor"/>
                            </svg>
                        </a>
                        <!-- end link -->
                    @endif

                </div>
                <!-- end text -->

                @if ( $block->image && Storage::disk('public')->exists('images/blocks/' . $block->image) )
                    <!-- banner -->
                    <div class="col-8 about__banner wow animate__fadeIn" data-wow-delay=".8s">
                        <picture>
                            <source
                                    srcset="{{ Storage::url('images/blocks/' . $block->image) }}"
                                    media="(min-width: 768px)"
                            >
                            <img
                                    src="{{ Storage::url('images/blocks/' . $block->image) }}"
                                    alt="{{ $block->title }}"
                                    title="{{ $block->title }}"
                            >
                        </picture>
                    </div>
                    <!-- end banner -->
                @endif

            </div>
            <!-- end row -->

        </div>
        <!-- end container -->

    </section>
    <!-- End About -->

@endif
