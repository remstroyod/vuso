<!-- section -->
<section class="row clearfix subscribe">

    <!-- container -->
    <div class="container">

        <!-- inner -->
        <div class="subscribe__inner">

            <!-- text -->
            <div class="subscribe__text">

                @isset( $shortcode->title )

                    <!-- title -->
                    <h2 class="subscribe__title">
                        {{ $shortcode->title }}
                    </h2>
                    <!-- end title -->

                @endisset

                @isset( $shortcode->subtitle )

                    <!-- subtitle -->
                    <div class="subscribe__descr">
                        {{ $shortcode->subtitle }}
                    </div>
                    <!-- end subtitle -->

                @endisset

            </div>
            <!-- end text -->

            <!-- form -->
            <div class="subscribe__form">

                [form template="book-consultation-email"]

            </div>
            <!-- end form -->

        </div>
        <!-- end inner -->

    </div>
    <!-- end container -->

</section>
<!-- end section -->
