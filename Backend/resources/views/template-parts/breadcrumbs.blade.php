<!-- Breadcrumbs -->
<nav class="page-breadcrumb">

    <!-- Breadcrumbs > List -->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ url()->to('/') }}">
                {{ __( 'Dashboard' ) }}
            </a>
        </li>
        @if( $breadcrumbsList )
            @foreach( $breadcrumbsList as $item )
                @if( $item['active'] )
                    <li class="breadcrumb-item active" aria-current="page">
                        {{ $item['title'] }}
                    </li>
                @else
                    <li class="breadcrumb-item">
                        <a href="{{ $item['url'] }}">
                            {{ $item['title'] }}
                        </a>
                    </li>
                @endif
            @endforeach
        @endif
    </ol>
    <!-- End Breadcrumbs > List -->

</nav>
<!-- End Breadcrumbs -->
