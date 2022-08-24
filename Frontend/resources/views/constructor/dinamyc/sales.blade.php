<!-- section -->
<section class="row clearfix actions">

    <!-- container -->
    <div class="container">

        @isset( $shortcode->title )

            <!-- title -->
            <h2 class="block-title">
                {{ $shortcode->title }}
            </h2>
            <!-- end title -->

        @endisset

        @if( $items->count() )

            <!-- list -->
            <div class="actions__list">

                @foreach( $items as $item )

                    <!-- card -->
                    <div class="card">

                        @php( $title = $item->name )

                        @if( $general === true )

                            @if ( Storage::disk('public')->exists('images/articles/' . $item->image) )
                                <!-- Picture -->
                                <img
                                        src="{{ Storage::url('images/articles/' . $item->image) }}"
                                        class="card-img-top"
                                        alt="{{ $title }}"
                                        title="{{ $title }}"
                                >
                                <!-- End Picture -->
                            @endif

                        @else

                            @if ( Storage::disk('public')->exists('images/constructor/dinamyc/' . $item->image) )
                                <!-- Picture -->
                                <img
                                        src="{{ Storage::url('images/constructor/dinamyc/' . $item->image) }}"
                                        class="card-img-top"
                                        alt="{{ $title }}"
                                        title="{{ $title }}"
                                >
                                <!-- End Picture -->
                            @endif

                        @endif

                        <!-- body -->
                        <div class="card-body">

                            <!-- title -->
                            <h5 class="card-title">
                                {{ $title }}
                            </h5>

                            <!-- footer -->
                            <div class="card-footer">

                                @if( $general === true )
                                    <a href="{{ route('news.show', [$item->category, $item]) }}" class="card-link">
                                        {{ __( 'Читать полностью' ) }}
                                    </a>
                                @else
                                    @if( $item->url_one )
                                        <a href="{{ $item->url_one }}" class="card-link">
                                            {{ $item->url_one_title }}
                                        </a>
                                    @endif
                                @endif

                                <!-- date -->
                                <div class="card-date">
                                    {{ Date::parse($item->published_at)->format('j F Y') }}
                                </div>
                                <!-- end date -->

                            </div>
                            <!-- end footer -->

                        </div>
                        <!-- end body -->

                    </div>
                    <!-- end card -->

                @endforeach

            </div>
            <!-- end list -->

        @endif

    </div>
    <!-- end container -->

</section>
<!-- end section -->
