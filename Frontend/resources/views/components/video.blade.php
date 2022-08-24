{{--Component: Видео :Component--}}
{{--Fields: title, link, image :Fields--}}
@if( $block )

    <!-- Video -->
    <section class="livecam wow animate__fadeIn" data-wow-delay=".1s" data-wow-offset="30">

        <!-- container -->
        <div class="container">

            <!-- inner -->
            <div class="livecam__inner">

                <!-- button -->
                <a
                        href="{{ $block->link }}"
                        class="livecam__control"
                        data-bs-toggle="modal"
                        data-bs-target="#modal-video"
                >
                    <svg width="23" height="30" viewBox="0 0 23 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0.499817 1.83166C0.499817 1.0405 1.37506 0.562658 2.04057 0.990487L22.5247 14.1588C23.137 14.5525 23.137 15.4475 22.5247 15.8412L2.04057 29.0095C1.37506 29.4373 0.499817 28.9595 0.499817 28.1683V1.83166Z" fill="white"/>
                    </svg>
                    <span>{{ $block->title }}</span>
                </a>
                <!-- end button -->

                @if ( $block->image && Storage::disk('public')->exists('images/blocks/' . $block->image) )
                    <!-- image -->
                    <picture class="livecam__bg">
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
                    <!-- end image -->
                @endif

            </div>
            <!-- end inner -->

        </div>
        <!-- end container -->

    </section>
    <!-- End Video -->

@endif
