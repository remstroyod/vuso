<!-- Header -->
<div class="modal-header">

    <!-- Title -->
    <h5 class="modal-title" id="staticBackdropLabel">
        {{ __( 'Спасибо, Вы забронировали время для оплаты в офисе на' ) }}:
    </h5>
    <!-- End Title -->

</div>
<!-- End Header -->

<!-- Body -->
<div class="modal-body">

    <!-- value -->
    <div class="selected-value">
        {{ $model->message }}
    </div>
    <!-- End value -->

    <!-- Close -->
    <button class="btn yellow" data-bs-dismiss="modal">
        {{ __( 'Закрыть' ) }} <span class="icon"></span> <div class="countdown">(<span>5</span> сек.)</div>
    </button>
    <!-- End Close -->

</div>
<!-- End Body -->
