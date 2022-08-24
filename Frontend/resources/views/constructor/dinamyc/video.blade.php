<!-- section -->
<section class="row clearfix livecam">

    <!-- container -->
    <div class="container">

        <!-- inner -->
        <div class="livecam__inner">


            @isset( $items->source )

                <!-- control -->
                <a href="{{ $items->source }}" class="livecam__control" data-fancybox="video" data-src="{{ $items->source }}">
                    <svg width="23" height="30" viewBox="0 0 23 30" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.499817 1.83166C0.499817 1.0405 1.37506 0.562658 2.04057 0.990487L22.5247 14.1588C23.137 14.5525 23.137 15.4475 22.5247 15.8412L2.04057 29.0095C1.37506 29.4373 0.499817 28.9595 0.499817 28.1683V1.83166Z" fill="white"/></svg>

                    @isset( $shortcode->title )
                        <span>
                            {{ $shortcode->title }}
                        </span>
                    @endisset

                </a>
                <!-- end control -->

            @endisset

            @if ( isset( $items->image ) && Storage::disk('public')->exists('images/constructor/dinamyc/' . $items->image) )
                <!-- picture -->
                <picture class="livecam__bg">
                    <source
                            srcset="{{ Storage::url('images/constructor/dinamyc/' . $items->image) }}"
                            media="(min-width: 768px)"
                    >
                    <img
                            src="{{ Storage::url('images/constructor/dinamyc/' . $items->image) }}"
                            alt="{{ $items->name }}"
                            title="{{ $items->name }}"
                    >
                </picture>
                <!-- end picture -->
            @endif

        </div>
        <!-- end inner -->

    </div>
    <!-- end container -->

</section>
<!-- end section -->
