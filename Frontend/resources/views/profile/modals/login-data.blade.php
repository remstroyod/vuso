<div
        class="modal fade modal-change-credentials"
        id="modal-change-credentials"
        data-bs-backdrop="static"
        data-bs-keyboard="false"
        tabindex="-1"
        aria-labelledby="staticBackdropLabel"
        aria-hidden="true"
>
    <div class="modal-overlay" data-bs-dismiss="modal"></div>
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">
                    {{ __( 'Изменение данных для входа' ) }}
                </h5>
                <button
                        type="button"
                        class="modal-close"
                        data-bs-dismiss="modal"
                        aria-label="{{ __( 'Close' ) }}"
                ></button>
            </div>

            <div class="modal-body">
                <form class="change-credentials-form"
                      data-action-check="{{ route('profile.person.loginData.check') }}"
                      data-action-save="{{ route('profile.person.loginData.save') }}"
                >
                    <div class="form-group">
                        <h3>{{ __( 'Изменить номер телефона' ) }}</h3>
                        <div class="input-wrapper">
                            <label for="current-phone">{{ __( 'Текущий номер телефона' ) }}</label>
                            <input type="phone" id="current-phone" value="+{{ $user->detail->phone ?? '' }}" disabled>
                        </div>
                        <div class="input-wrapper">
                            <label for="new-phone">{{ __( 'Новый номер телефона' ) }}</label>
                            <input type="phone" name="phone" id="new-phone">
                        </div>
                    </div>
                    <!-- для смены телефона -->
                    <div class="form-group js__sms-block" style="display: none;">
                        <h3>
                            {{ __( 'Мы отправили смс или сообщение в Viber с одноразовым кодом на номер' ) }}
                            <span class="js__new-phone"></span>, {{ __( 'пожалуйста введите его' ) }}
                        </h3>
                        <div class="input-wrapper">
                            <label for="code">{{ __( 'Код из смс' ) }}</label>
                            <input type="text" name="code" id="code" placeholder="ХХХХ">
                        </div>
                    </div>

                    <div class="form-group js__password-block">
                        <h3>{{ __( 'Изменить пароль' ) }}</h3>
                        <div class="input-wrapper">
                            <label for="current-password">{{ __( $user->password ? 'Текущий пароль' : 'Новый пароль' ) }}</label>
                            <input type="password" name="password" id="current-password">
                        </div>
                        @if ($user->password)
                            <div class="input-wrapper">
                                <label for="new-password">{{ __( 'Новый пароль' ) }}</label>
                                <input type="password" name="newPassword" id="new-password">
                            </div>
                        @endif
                    </div>
                    <button type="submit" class="btn yellow">{{ __( 'Сохранить' ) }}</button>
                </form>
            </div>
        </div>
    </div>
</div>
