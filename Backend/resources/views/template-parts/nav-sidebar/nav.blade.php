<ul class="nav">

    @foreach( $items as $key => $item )

        @if( !auth()->user()->hasRole('admin') )

                @if( array_key_exists( 'permission', $item ) )

                    @if( auth()->user()->can($item['permission']) )
                            <li class="nav-item nav-category">
                                {{ __( $item['title'] ) }}
                            </li>
                    @endif

                @else
                    <li class="nav-item nav-category">
                        {{ __( $item['title'] ) }}
                    </li>
                @endif

        @else

            <li class="nav-item nav-category">
                {{ __( $item['title'] ) }}
            </li>

        @endif

        @if( $item['child'] )

            @foreach( $item['child'] as $keyItem => $child )

                @if( !auth()->user()->hasRole('admin') )

                    @if( auth()->user()->can($child['permission']) )
                        @include( 'template-parts.nav-sidebar.nav-row' )
                    @endif

                @else

                    @include( 'template-parts.nav-sidebar.nav-row' )

                @endif

            @endforeach

        @endif

    @endforeach

</ul>
