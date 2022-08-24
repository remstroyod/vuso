<!-- Form -->
<form
        action="{{ route('auth.enter.password.check', ['user' => $user]) }}"
        method="post"
        enctype="multipart/form-data"
        class="auth-group__phone-subgroup__confirm auth-group__phone-subgroup__confirm--password-form authEnterPassword"
>
    @csrf

    <input
            type="text"
            class="auth-group__phone-subgroup__selected-input"
            data-selected-phone-input value="{{ $phone }}"
            readonly
    >

    <!-- row -->
    <div class="auth-group__phone-subgroup__confirm-row">

        <label
                class="auth-group__phone-subgroup__confirm-label"
        >
            {{ __( 'Пароль' ) }}
        </label>

        <input
                type="password"
                name="password"
                class="auth-group__phone-subgroup__confirm-input"
        >

        <button
                type="submit"
                class="auth-group__phone-subgroup__confirm-submit"
        ></button>

    </div>
    <!-- end row -->

    <button
            class="auth-group__phone-subgroup__step-btn auth-group__phone-subgroup__sms-code-btn showFormSmsCode"
    >
        {{ __( 'Ввести код вместо пароля' ) }}
    </button>

</form>
<!-- End Form -->
