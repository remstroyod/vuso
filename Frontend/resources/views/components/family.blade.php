{{--Component: Семья :Component--}}
{{--Fields: title :Fields--}}
@if( $block )
    <!-- Info -->
    <section class="company-info wow animate__fadeIn" data-wow-delay=".1s" data-wow-offset="30">
        <div class="container">
            <div class="row">
                <div class="col-4">
                    @if( $block->title )
                        <h2 class="company-info__title">
                            {{ $block->title }}
                        </h2>
                    @endif
                </div>
                <div class="col-8">
                    @if( $block->elements->count() )
                        <div class="company-info__circles swiper-container company-circles-swiper">
                            <div class="swiper-wrapper">
                                @foreach( $block->elements as $item )
                                    @if ( $item->image && Storage::disk('public')->exists('images/blocks/elements/' . $item->image) )
                                        <div class="swiper-slide">
                                            <a
                                                href="{{ Storage::url('images/blocks/elements/' . $item->image) }}"
                                                class="company-info__circle"
                                                data-fancybox="gallery"
                                            >
                                                <img
                                                    src="{{ Storage::url('images/blocks/elements/' . $item->image) }}"
                                                    alt="{{ $item->title }}"
                                                    title="{{ $item->title }}"
                                                    loading="lazy"
                                                >
                                            </a>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.css" />
        <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>
    </section>
    <!-- End Info -->
@endif
