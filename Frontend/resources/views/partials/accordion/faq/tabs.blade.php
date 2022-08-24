<!-- accordion -->
<div class="support__accordion accordion" id="support__accordion">

    @foreach( $items as $item )

        <!-- item -->
        <div class="accordion-item">

            <!-- header -->
            <h3 class="accordion-header" id="support-elem-header-{{ $loop->iteration }}">

                <button
                        class="accordion-button collapsed"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#support-elem-body-{{ $loop->iteration }}"
                        aria-expanded="true"
                        aria-controls="support-elem-body-{{ $loop->iteration }}"
                >
                    {{ $item->name }}
                </button>

            </h3>
            <!-- end header -->

            <!-- collapse -->
            <div
                    id="support-elem-body-{{ $loop->iteration }}"
                    class="accordion-collapse collapse"
                    aria-labelledby="support-elem-header-{{ $loop->iteration }}"
                    data-bs-parent="#support__accordion"
            >

                <!-- body -->
                <div class="accordion-body">
                    {!! $item->description !!}
                </div>
                <!-- end body -->

            </div>
            <!-- end collapse -->

        </div>
        <!-- end item -->

    @endforeach

</div>
<!-- end accordion -->
