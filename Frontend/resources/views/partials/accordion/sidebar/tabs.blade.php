<!-- selectors -->
<div class="info-text__tab-selectors">

    @foreach( $items as $item)

        @if( $item->isParent() )

            <!-- group -->
            <div class="
                info-text__selectors-group
                @if( $item->isChildren() ) has-children @endif
                @if( $loop->iteration === 1 ) active @endif
                "
            >

                <!-- header -->
                <div
                        class="info-text__selectors-group__head"
                        tab-id="tab-{{ $item->id }}"
                >
                    {{ $item->name }}
                </div>
                <!-- end header -->

                    @php( $parents = $item->parents )

                    @if( count($parents) )

                        <!-- list -->
                        <div class="info-text__selectors-group__list">

                        @foreach( $parents as $parent )

                            <!-- subgroup -->
                                <div class="info-text__selectors-subgroup">

                                    <!-- link -->
                                    <a
                                        tab-id="tab-{{ $parent->id }}"
                                        class="info-text__selector @if( $loop->iteration === 1 ) active @endif"
                                    >
                                        {{ $parent->name }}
                                    </a>
                                    <!-- end link -->

                                    <!-- text -->
                                    <div class="info-text__items-mobile">

                                        {!! $parent->description !!}

                                    </div>
                                    <!-- end text -->

                                </div>
                                <!-- end subgroup -->

                            @endforeach

                        </div>
                        <!-- end list -->

                    @endif

            </div>
            <!-- end group -->

        @endif

    @endforeach

</div>
<!-- end selectors -->
