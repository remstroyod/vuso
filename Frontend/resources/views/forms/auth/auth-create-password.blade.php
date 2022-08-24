<!-- Form -->
<form
        action="{{ route('auth.store.password.form', ['user' => $user]) }}"
        method="post"
        enctype="multipart/form-data"
        class="auth-group__phone-subgroup__confirm auth-group__phone-subgroup__confirm--create-password-form authStorePassword"
>
    @csrf

    <input
            type="text"
            class="auth-group__phone-subgroup__selected-input"
            data-selected-phone-input value="{{ $phone }}"
            readonly
    >

    <!-- annotation -->
    <div class="auth-group__phone-subgroup__annotation">
        {{ __( 'Придумайте пароль из 8-16 символов, в пароле обязательно должны присутствовать минимум 2 цифры и буквы разного регистра' ) }}
    </div>
    <!-- end annotation -->

    <!-- row -->
    <div class="auth-group__phone-subgroup__confirm-row">

        <label
                class="auth-group__phone-subgroup__confirm-label"
        >
            {{ __( 'Придумайте пароль' ) }}
        </label>

        <input
                type="password"
                name="password"
                class="auth-group__phone-subgroup__confirm-input"
                placeholder="ХХХХХХХХ"
        >

    </div>
    <!-- end row -->

    <!-- row -->
    <div class="auth-group__phone-subgroup__confirm-row">

        <label
                class="auth-group__phone-subgroup__confirm-label"
        >
            {{ __( 'Повторите пароль' ) }}
        </label>

        <input
                type="password"
                name="password_confirmation"
                class="auth-group__phone-subgroup__confirm-input"
                placeholder="ХХХХХХХХ"
        >

    </div>
    <!-- end row -->

    <button
            class="auth-group__phone-subgroup__step-btn purple auth-group__phone-subgroup__confirm-password-btn"
            type="submit"
    >
        {{ __( 'Создать пароль и продолжить' ) }}
    </button>

</form>
<!-- End Form -->
