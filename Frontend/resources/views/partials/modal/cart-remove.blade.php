<!-- Modal Cart Remove -->
<div
        class="modal fade modal-cart-product-remove"
        id="modal-cart-product-remove"
        data-bs-backdrop="static"
        data-bs-keyboard="false"
        tabindex="-1"
        aria-labelledby="staticBackdropLabel"
        aria-hidden="true"
>

    <!-- overlay -->
    <div class="modal-overlay" data-bs-dismiss="modal"></div>
    <!-- end overlay -->

    <!-- dialog -->
    <div class="modal-dialog modal-dialog-centered">

        <!-- content -->
        <div class="modal-content">

            <!-- header -->
            <div class="modal-header">

                <!-- title -->
                <h5 class="modal-title" id="staticBackdropLabel">
                    {{ __( 'Удалить полис из оформления?' ) }}
                </h5>
                <!-- end title -->

                <!-- button -->
                <button type="button" class="modal-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <!-- end button -->

            </div>
            <!-- end header -->

            <!-- body -->
            <div class="modal-body">

                <!-- descr -->
                <div class="cart-product-descr">
                    {{ __( 'Вы собираетесь удалить из оформления страховой полис' ) }} “<span data-product id="modalCartRemoveProduct"></span>”. {{ __( 'Введенные Вами ранее данные по этому страховому полису будут утеряны' ) }}
                </div>
                <!-- end descr -->

                <!-- controls -->
                <form action="{{ route('web.cart.destroy') }}" method="post" class="cart-product-controls" id="modalCartRemoveForm">
                    @csrf
                    @method('delete')

                    <input type="hidden" value="" name="item">

                    <button class="btn red" type="submit">
                        {{ __( 'Удалить' ) }}
                    </button>
                    <button class="btn yellow" data-bs-dismiss="modal" aria-label="Close" type="button">
                        {{ __( 'Оставить' ) }}
                    </button>

                </form>
                <!-- end controls -->

                <div class="error"></div>

            </div>
            <!-- end body -->

        </div>
        <!-- end content -->

    </div>
    <!-- end dialog -->

</div>
<!-- End Modal Cart Remove -->
