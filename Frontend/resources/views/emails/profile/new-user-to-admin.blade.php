<div>
    <h2>
        {{ __( 'На сайте зарегистрирован новый пользователь!' ) }}
    </h2>

    <ul>

        <li>
            <strong>{{ __( 'Логин' ) }}</strong>: {{ $user->name }}
        </li>
        <li>
            <strong>{{ __( 'E-mail' ) }}</strong>: {{ $user->email }}
        </li>

    </ul>

</div>
