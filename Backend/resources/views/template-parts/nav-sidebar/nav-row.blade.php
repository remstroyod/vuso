@php

    $collapse_active = '';
    $collapse_show = '';

@endphp

@if( request()->routeIs('blocks.*') )

    @if( array_key_exists( 'page', $child ) )

        @if( request()->route()->page->page === $child['page'] )

            @php
                $collapse_active = 'active';
                $collapse_show = 'show';
            @endphp

        @endif

    @endif

@else

    @if( request()->routeIs($child['routeIs']) )

        @php
            $collapse_active = 'active';
            $collapse_show = 'show';
        @endphp

    @endif

@endif

<li class="nav-item {{ $collapse_active }}">

    <a
            href="{{ array_key_exists('child', $child) ? '#submenu-'.$key . '-' . $keyItem : route($child['route']) }}"
            class="nav-link"
            @if( array_key_exists('child', $child) ) data-toggle="collapse" role="button" aria-expanded="false" @endif
    >
        <i class="link-icon" data-feather="{{ $child['icon'] }}"></i>
        <span class="link-title">{{ __( $child['title'] ) }}</span>
        @if( array_key_exists('child', $child) )
            <i class="link-arrow" data-feather="chevron-down"></i>
        @endif
    </a>

    @if( array_key_exists('child', $child) )

        <div class="collapse {{ $collapse_show }}" id="submenu-{{ $key . '-' . $keyItem }}">

            <ul class="nav sub-menu">

                @foreach( $child['child'] as $subKey => $subChild )

                    <li class="nav-item">
                        <a
                                href="{{ array_key_exists('route', $subChild) ? route($subChild['route'], array_key_exists( 'request', $subChild ) ? $subChild['request'] : []) : '' }}"
                                class="nav-link @if( request()->routeIs($subChild['route']) ) active @endif"
                        >
                            {{ __( $subChild['title'] ) }}
                        </a>
                    </li>

                @endforeach

            </ul>

        </div>

    @endif

</li>
