<!-- Header -->
<div class="modal-header">

    <!-- Title -->
    <h5 class="modal-title" id="staticBackdropLabel">

        @if( ! empty( $model->message ) )
            {{ __( 'Спасибо, Вы забронировали консультацию на' ) }}:
        @else
            {{ __( 'Спасибо, ваш запрос успешно отправлен!' ) }}
        @endif

    </h5>
    <!-- End Title -->

</div>
<!-- End Header -->

<!-- Body -->
<div class="modal-body">

    <!-- value -->
    @if( ! empty( $model->message ) )
        <div class="selected-value">
            {{ $model->message }}
        </div>
    @else
        <p>
            {{ __( 'Наш менеджер свяжется с вами в ближайшее время.' ) }}
        </p>
    @endif
    <!-- End value -->

    <!-- Close -->
    <button class="btn yellow" data-bs-dismiss="modal">
        {{ __( 'Закрыть' ) }} <span class="icon"></span> <div class="countdown">(<span>5</span> сек.)</div>
    </button>
    <!-- End Close -->

</div>
<!-- End Body -->
