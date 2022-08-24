<!-- section -->
<section class="row clearfix faq">

    <!-- container -->
    <div class="container">

        <!-- form -->
        <div class="faq__form">

            @isset( $shortcode->title )

                <!-- title -->
                <h3 class="faq__form-title">
                    {{ $shortcode->title }}
                </h3>
                <!-- end title -->

            @endisset

            [form template="catalog-faq"]

        </div>
        <!-- end form -->

    </div>
    <!-- end container -->

</section>
<!-- end section -->
