{{--Component: CTA: Финансовые показатели :Component--}}
{{--Fields: title :Fields--}}
@if( $block )

    <!-- stats -->
    <div class="info-text__stats">

        @if( $block->title )
            <!-- Title -->
            <h3 class="info-text__stats-title">
                {{ $block->title }}
            </h3>
            <!-- End Title -->
        @endif

        @if( $block->elements->count() )

            <!-- list -->
            <div class="info-text__stats-list">

                @foreach( $block->elements as $item )

                    <!-- Stats -->
                    <div class="info-text__stats-item @if( $item->description ) dropdown @endif">

                        <!-- Head -->
                        <div class="info-text__stats-item__head">
                            @if( $item->title )
                                <!-- Title -->
                                <div class="info-text__stats-item__title">
                                    {{ $item->title }}
                                </div>
                                <!-- End Title -->
                            @endif

                            @if( $item->subtitle )
                                <!-- Subtitle -->
                                <div class="info-text__stats-item__value">
                                    {{ $item->subtitle }}
                                </div>
                                <!-- End Subtitle -->
                            @endif
                        </div>
                        <!-- End Head -->

                        <!-- body -->
                        <div class="info-text__stats-item__body">
                            {!! $item->description !!}
                        </div>
                        <!-- End body -->

                    </div>
                    <!-- End Stats -->

                @endforeach

            </div>
            <!-- end list -->

        @endif

    </div>
    <!-- end stats -->
    
@endif
