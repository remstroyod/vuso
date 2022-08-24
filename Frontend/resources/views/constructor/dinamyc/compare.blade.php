<!-- section -->
<section class="row clearfix category">

    <!-- compare -->
    <div class="category__compare">

        <!-- container -->
        <div class="container">

            @isset( $shortcode->title )

                <!-- title -->
                <div class="category__compare-title">
                    {{ $shortcode->title }}
                </div>
                <!-- end title -->

                {!! $items->template !!}

            @endisset

        </div>
        <!-- end container -->

    </div>
    <!-- end compare -->

</section>
<!-- end section -->
