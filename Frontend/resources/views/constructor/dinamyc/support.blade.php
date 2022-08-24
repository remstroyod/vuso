<!-- section -->
<section class="row clearfix support">

    <!-- container -->
    <div class="container">

        <!-- content -->
        <div class="support__content">

            @if( $items->count() )

                <!-- accordion -->
                <div class="support__accordion accordion" id="support__accordion">

                    @foreach( $items as $item )

                        <!-- item -->
                        <div class="accordion-item">

                            <!-- header -->
                            <h3 class="accordion-header" id="support-elem-header-{{ $item->id }}">
                                <button
                                        class="accordion-button collapsed"
                                        type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#support-elem-body-{{ $item->id }}"
                                        aria-expanded="false"
                                        aria-controls="support-elem-body-{{ $item->id }}"
                                >{{ $item->name }}</button>
                            </h3>
                            <!-- end header -->

                            <!-- body -->
                            <div
                                    id="support-elem-body-{{ $item->id }}"
                                    class="accordion-collapse collapse"
                                    aria-labelledby="support-elem-header-{{ $item->id }}"
                                    data-bs-parent="#support__accordion"
                            >
                                <div class="accordion-body">
                                    {{ $item->excerpt }}
                                </div>
                            </div>
                            <!-- end body -->

                        </div>
                        <!-- end item -->

                    @endforeach

                </div>
                <!-- end accordion -->

            @endif

            <!-- form -->
            <div class="support__form">

                @isset( $shortcode->title )

                    <!-- title -->
                    <h3 class="support__form-title">
                        {{ $shortcode->title }}
                    </h3>
                    <!-- end title -->

                @endisset

                @isset( $shortcode->subtitle )

                    <!-- subtitle -->
                    <div class="support__form-descr">
                        {{ $shortcode->subtitle }}
                    </div>
                    <!-- endsubtitle -->

                @endisset

                [form template="support"]

            </div>
            <!-- end form -->

        </div>
        <!-- end content -->

    </div>
    <!-- end container -->

</section>
<!-- end section -->
