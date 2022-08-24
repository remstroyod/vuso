{{--Component: Продукты :Component--}}
{{--Fields: title, excerpt :Fields--}}
@if( $block && $block->content )
    <!-- Insurance -->
    <section class="insurance wow animate__fadeIn" data-wow-delay=".1s" data-wow-offset="30">

        <!-- container -->
        <div class="container">

            <!-- row -->
            <div class="row">

                <!-- col -->
                <div class="col col-4 insurance__text">

                @if( $block->title )
                    <!-- title -->
                    <h2 class="block-title">
                        {{ $block->title }}
                    </h2>
                    <!-- end title -->
                @endif

                @if( $block->excerpt )
                    <!-- excerpt -->
                    <div class="insurance__descr">
                        {{ $block->excerpt }}
                    </div>
                    <!-- end excerpt -->
                @endif

                </div>
                <!-- end col -->

                @if( $block->elements->count() )

                    <!-- col -->
                    <div class="col col-8 insurance__cards wow animate__fadeIn" data-wow-delay=".5s">

                        @foreach( $block->elements as $item )
                            <!-- card -->
                            <div class="insurance__card">

                                @if ( $item->image && Storage::disk('public')->exists('images/blocks/elements/' . $item->image) )
                                    <!-- image -->
                                    <div class="insurance__card__image">
                                        <img
                                                src="{{ Storage::url('images/blocks/elements/' . $item->image) }}"
                                                alt="{{ $item->title }}"
                                                title="{{ $item->title }}"
                                        >
                                    </div>
                                    <!-- end image -->
                                @endif

                                <!-- info -->
                                <div class="insurance__card__info">

                                    @if( $item->title )
                                        <!-- title -->
                                        <div class="insurance__card__title">
                                            {{ $item->title }}
                                        </div>
                                        <!-- end title -->
                                    @endif

                                    @if( $item->excerpt )
                                        <!-- excerpt -->
                                        <div class="insurance__card__descr">
                                            {{ $item->excerpt }}
                                        </div>
                                        <!-- end excerpt -->
                                    @endif

                                    <!-- control -->
                                    <div class="insurance__card__control">

                                        @if( $item->link )
                                            <!-- link -->
                                            <a href="{{ $item->link }}" class="insurance__card__link">

                                                @if ( $item->icon && Storage::disk('public')->exists('images/blocks/elements/' . $item->icon) )
                                                    <span class="icon">
                                                        <img
                                                                src="{{ Storage::url('images/blocks/elements/' . $item->icon) }}"
                                                                alt="{{ $item->title }}"
                                                                title="{{ $item->title }}"
                                                        >
                                                    </span>
                                                @endif

                                                @if( $item->linktext )
                                                    <span class="text">
                                                        {{ $item->linktext }}
                                                    </span>
                                                @endif

                                            </a>
                                            <!-- end link -->
                                        @endif

                                    </div>
                                    <!-- end control -->

                                </div>
                                <!-- end info -->

                            </div>
                            <!-- end card -->
                        @endforeach

                    </div>
                    <!-- end col -->

                @endif

            </div>
            <!-- end row -->

        </div>
        <!-- end container -->

    </section>
    <!-- End Insurance -->
@endif
