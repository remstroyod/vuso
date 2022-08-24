<!-- Modal Review Company -->
<div
    class="modal fade modal-add-feeback"
    id="modal-add-feedback"
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

            <div class="modal-header">
                <button
                    type="button"
                    class="modal-close"
                    data-bs-dismiss="modal"
                    aria-label="{{ __( 'Close' ) }}"></button>
            </div>

            <!-- body -->
            <div class="modal-body">

                @include( 'forms.reviews' )

            </div>
            <!-- end body -->

        </div>
        <!-- end content -->

    </div>
    <!-- end dialog -->

</div>
<!-- End Modal Review Company -->
