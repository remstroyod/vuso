@foreach( $categories as $category )

    <!-- tab -->
    <div
            class="info-text__tab @if( $loop->iteration === 1 ) active @endif"
            id="tab-{{ $category->id }}"
    >

        <!-- Title -->
        <h3 class="info-text__tab-title">
            {{ $category->name }}
        </h3>
        <!-- End Title -->

        <!-- group -->
        <div class="info-text__text-group">

            {!! $category->description !!}

            @if( request()->routeIs('informations.index') )

                @php( $informations = $category->informations )

                @if( count($informations) )

                    <!-- list -->
                    <ul class="list-unstyled">

                        @foreach( $informations as $item )

                            @include( 'partials.loop.informations-item', [ 'item' => $item ] )

                        @endforeach

                    </ul>
                    <!-- end list -->

                @endif

            @endif

        </div>
        <!-- end group -->

    </div>
    <!-- end tab -->

@endforeach
