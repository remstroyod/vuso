<!-- actions -->
<section class="actions">

    <!-- container -->
    <div class="container">

        <!-- title -->
        <h2 class="block-title">
            {{ __( 'Акции' ) }}
        </h2>
        <!-- end title -->

        <!-- list -->
        <div class="actions__list">

            @foreach( $sales as $item )

                @include( 'partials.loop.sales' )

            @endforeach

        </div>
        <!-- end list -->

    </div>
    <!-- end container -->

</section>
<!-- end actions -->
