<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

<!-- Wrapper -->
<div class="wrapper">

    <h1>{{ __( 'Добро пожаловать на сайт' ) }}, {{ $user->name }}</h1>
    <div>
        Вы были зарегистрированы администратором на сайте Vuso.<br />
        <hr>
        <h2>Данные для авторизации</h2>
        <strong>Логин</strong>: "{{ app('request')->email }}"<br />
        <strong>Пароль</strong>: "{{ app('request')->password }}"<br />
        <strong>Ссылка в админ-панель</strong>: <a href="http://test.vuso-back.d2.digital/" target="_blank">Перейти</a>
    </div>

</div>
<!-- End Wrapper -->

</body>
</html>
