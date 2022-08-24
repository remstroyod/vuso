<ul>
    @foreach( $categories as $category )
        @if( $category->isChildren() )
            <li class="has-children" tab-id="{{ $category->id }}">
                <span>{{ $category->name }}</span>
                @include( 'pages.informations.item-tab', ['categories' => $category->parents] )
            </li>
        @else
            <li tab-id="{{ $category->id }}">
                <span>{{ $category->name }}</span>

                <div class="info-text__items-mobile">
                    <h3 class="info-text__tab-title">
                        {{ $category->name }}
                    </h3>
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
            </li>
        @endif
    @endforeach
</ul>
