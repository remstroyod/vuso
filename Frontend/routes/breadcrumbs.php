<?php
// Home
Breadcrumbs::for('home', function ($trail) {
    $trail->push(__( 'Главная' ), route('home'));
});

// Home > News
Breadcrumbs::for('articles', function ($trail) {
    $trail->parent('home');
    $trail->push(__( 'Новости' ), route('news.index', ['category' => 'stati']));
});

// Home > News > {article}
Breadcrumbs::for('article', function ($trail, $post) {
    $trail->parent('articles');
    $trail->push($post->name, route('news.show', [$post->category, $post]));
});

// Home > Partners
Breadcrumbs::for('partners', function ($trail) {
    $trail->parent('home');
    $trail->push(__( 'Партнеры' ), route('partners.index'));
});

// Home > Faq
Breadcrumbs::for('faq', function ($trail) {
    $trail->parent('home');
    $trail->push(__( 'Вопросы и ответы' ), route('faq.index'));
});

// Home > Contacts
Breadcrumbs::for('contacts', function ($trail) {
    $trail->parent('home');
    $trail->push(__( 'Адреса представительств' ), route('contacts.index'));
});

// Home > Contacts
Breadcrumbs::for('payment_delivery', function ($trail) {
    $trail->parent('home');
    $trail->push(__( 'Оплата и доставка' ), route('payment_delivery.index'));
});

// Home > Informations
Breadcrumbs::for('informations', function ($trail) {
    $trail->parent('home');
    $trail->push(__( 'Раскрытие информации' ), route('informations.index'));
});

// Home > Support
Breadcrumbs::for('support', function ($trail) {
    $trail->parent('home');
    $trail->push(__( 'Поддержка' ), route('support.index'));
});

// Home > {slug}
Breadcrumbs::for('static-page', function ($trail, $post) {
    $trail->parent('home');
    $trail->push($post->name, route('static.pages.index', $post));
});

// Home > Catalog
Breadcrumbs::for('catalog', function ($trail, $post) {
    $trail->parent('home');
    $trail->push($post->name, route('catalog.index', $post));
});

// Payment
Breadcrumbs::for('payment', function ($trail) {
    $trail->parent('home');
    $trail->push(__( 'Оплатить Online' ), route('payment.index'));
});
