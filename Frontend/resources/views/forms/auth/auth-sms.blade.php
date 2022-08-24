<!-- Form -->
<form
        action="{{ route('auth.web.sms.phone') }}"
        method="post"
        enctype="multipart/form-data"
        class="auth-group__phone-subgroup__initial-form authPhone"
>
    @csrf

    <input
            type="text"
            id="phone-number-input"
            class="auth-group__phone-subgroup__initial-input"
            placeholder="{{ __( 'Телефон' ) }}"
            name="phone"
    />

    <button
            type="submit"
            class="auth-group__phone-subgroup__confirm-submit"
    ></button>

    @include( 'partials.message' )

</form>
<!-- End Form -->
