@if (count($breadcrumbs))

    <!-- Breadcrumbs -->
    <nav aria-label="breadcrumb">

        <!-- container -->
        <div class="container">

            <!-- list -->
            <ol class="breadcrumb">

                @foreach ($breadcrumbs as $breadcrumb)

                    @if ($breadcrumb->url && !$loop->last)
                        <li class="breadcrumb-item"><a href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a></li>
                    @else
                        <li class="breadcrumb-item active">{{ $breadcrumb->title }}</li>
                    @endif

                @endforeach

            </ol>
            <!-- end list -->

        </div>
        <!-- end container -->

    </nav>
    <!-- End Breadcrumbs -->

@endif
