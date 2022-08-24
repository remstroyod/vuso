<!-- section -->
<section class="accordion-with-card">

    <!-- container -->
    <div class="container">

        <!-- row -->
        <div class="row">

            <!-- col -->
            <div class="col col-8">

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

            </div>
            <!-- end col -->

            @if( $record )

                <!-- col -->
                <div class="col col-4">

                    <!-- card -->
                    <div class="card">

                        @if ( Storage::disk('public')->exists('images/articles/' . $record->image) )
                            <!-- Picture -->
                            <img
                                    src="{{ Storage::url('images/articles/' . $record->image) }}"
                                    class="card-img-top"
                                    alt="{{ $record->name }}"
                                    title="{{ $record->name }}"
                            >
                            <!-- End Picture -->
                        @endif

                        <!-- body -->
                        <div class="card-body">

                            <!-- title -->
                            <h5 class="card-title">
                                {{ $record->name }}
                            </h5>
                            <!-- end title -->

                            <!-- footer -->
                            <div class="card-footer">

                                <!-- link -->
                                <a href="{{ route('news.show', [$record->category, $record]) }}" class="card-link">
                                    {{ __( 'Читать полностью' ) }}
                                </a>
                                <!-- end link -->

                                <!-- date -->
                                <div class="card-date">
                                    {{ Date::parse($record->published_at)->format('j F Y') }}
                                </div>
                                <!-- end date -->

                            </div>
                            <!-- end footer -->

                        </div>
                        <!-- end body -->

                    </div>
                    <!-- end card -->

                </div>
                <!-- end col -->

            @endif

        </div>
        <!-- end row -->

    </div>
    <!-- end container -->

</section>
<!-- end section -->
