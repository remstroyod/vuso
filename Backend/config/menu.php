<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Menu List
    |--------------------------------------------------------------------------
    */
    'list' => [

        'primary' => [

            [
                'title' => 'Начало',
                'child' => [
                    [
                        'title' => 'Dashboard',
                        'route' => 'dashboard',
                        'routeIs' => 'dashboard.*',
                        'icon' => 'box',
                        'permission' => '',
                    ],
                    [
                        'title' => 'Оформить заказ',
                        'route' => 'users.orders.index',
                        'routeIs' => 'users.*',
                        'icon' => 'clipboard',
                        'permission' => '',
                    ],
                    [
                        'title' => 'Документация',
                        'route' => 'documentation.index',
                        'routeIs' => 'documentation.*',
                        'icon' => 'book',
                        'permission' => 'documentation_access',
                    ],
                    [
                        'title' => 'Настройки',
                        'route' => 'settings.edit',
                        'routeIs' => 'settings.*',
                        'icon' => 'settings',
                        'permission' => 'settings_access',
                    ],
                    [
                        'title' => 'Профиль',
                        'routeIs' => 'users.profile.*',
                        'icon' => 'user',
                        'permission' => 'profile_access',
                        'child' => [
                            [
                                'title' => 'Главная',
                                'route' => 'users.profile.index',
                                'permission' => 'profile_access',
                            ],
                            [
                                'title' => 'Основное',
                                'route' => 'users.profile.edit',
                                'permission' => 'profile_update',
                            ],
                            [
                                'title' => 'Социальные сети',
                                'route' => 'users.profile.socials.index',
                                'permission' => 'profile_update',
                            ],
                        ],
                    ],
                    [
                        'title' => 'Права и роли',
                        'routeIs' => 'security.*',
                        'icon' => 'shield',
                        'permission' => 'roles_and_permissions_access',
                        'child' => [
                            [
                                'title' => 'Роли',
                                'route' => 'security.roles.index',
                                'permission' => 'roles_access',
                            ],
                            [
                                'title' => 'Права',
                                'route' => 'security.permission.index',
                                'permission' => 'permissions_access',
                            ],
                        ],
                    ],
                    [
                        'title' => 'Пользователи',
                        'route' => 'users.list.index',
                        'routeIs' => 'users.list.*',
                        'icon' => 'users',
                        'permission' => 'users_access',
                    ],
                    [
                        'title' => 'Конструктор меню',
                        'route' => 'menu.index',
                        'routeIs' => 'menu.*',
                        'icon' => 'settings',
                        'permission' => 'menu_access',
                    ],
                ],
            ],

            [
                'title' => 'Данные форм',
                'permission' => 'formsdata_access',
                'child' => [
                    [
                        'title' => 'Все формы',
                        'route' => 'forms.data.index',
                        'routeIs' => 'forms.data.index',
                        'icon' => 'at-sign',
                        'permission' => 'formsdata_access',
                    ],
                ],
            ],

            [
                'title' => 'Статические страницы',
                'permission' => 'pages_access',
                'child' => [

                    [
                        'title' => 'Все страницы',
                        'route' => 'static-pages.index',
                        'routeIs' => 'static-pages.index',
                        'icon' => 'compass',
                        'permission' => 'pages_access',
                    ],

                    [
                        'title' => 'Главная',
                        'route' => 'home.edit',
                        'routeIs' => 'home.*',
                        'page' => 'home',
                        'icon' => 'home',
                        'permission' => 'pages_access',
                        'child' => [
                            [
                                'title' => 'Основное',
                                'route' => 'home.edit',
                                'permission' => 'pages_access',
                            ],
                            [
                                'title' => 'Блоки',
                                'route' => 'blocks.default.index',
                                'request' => ['page' => 'home'],
                                'permission' => 'pages_blocks_access',
                            ],
                            [
                                'title' => 'Вопросы и ответы',
                                'route' => 'attach.faq.form',
                                'request' => ['page' => 'home'],
                                'permission' => 'pages_access',
                            ],
                            [
                                'title' => 'SEO данные',
                                'route' => 'home.seo',
                                'request' => ['id' => 'home'],
                                'permission' => 'seo_access',
                            ],
                        ],
                    ],

                    [
                        'title' => 'О компании',
                        'route' => 'about.edit',
                        'routeIs' => 'about.*',
                        'page' => 'about',
                        'icon' => 'book',
                        'permission' => 'pages_access',
                        'child' => [
                            [
                                'title' => 'Главная',
                                'route' => 'about.edit',
                                'permission' => 'pages_access',
                            ],
                            [
                                'title' => 'Блоки',
                                'route' => 'blocks.default.index',
                                'request' => ['page' => 'about'],
                                'permission' => 'pages_blocks_access',
                            ],
                            [
                                'title' => 'Вопросы и ответы',
                                'route' => 'attach.faq.form',
                                'request' => ['page' => 'about'],
                                'permission' => 'pages_access',
                            ],
                            [
                                'title' => 'История',
                                'route' => 'about.history.index',
                                'permission' => 'pages_access',
                            ],
                            [
                                'title' => 'Команда',
                                'route' => 'about.team.index',
                                'permission' => 'pages_access',
                            ],
                            [
                                'title' => 'Награды',
                                'route' => 'about.awards.index',
                                'permission' => 'pages_access',
                            ],
                            [
                                'title' => 'SEO данные',
                                'route' => 'about.seo',
                                'request' => ['id' => 'about'],
                                'permission' => 'seo_access',
                            ],
                        ],
                    ],

                    [
                        'title' => 'Контакты',
                        'route' => 'contacts.edit',
                        'routeIs' => 'contacts.*',
                        'page' => 'contacts',
                        'icon' => 'mail',
                        'permission' => 'pages_access',
                        'child' => [
                            [
                                'title' => 'Главная',
                                'route' => 'contacts.edit',
                                'permission' => 'pages_access',
                            ],
                            [
                                'title' => 'Блоки',
                                'route' => 'blocks.default.index',
                                'request' => ['page' => 'contacts'],
                                'permission' => 'pages_blocks_access',
                            ],
                            [
                                'title' => 'Вопросы и ответы',
                                'route' => 'attach.faq.form',
                                'request' => ['page' => 'contacts'],
                                'permission' => 'pages_access',
                            ],
                            [
                                'title' => 'Представительства',
                                'route' => 'contacts.offices.index',
                                'permission' => 'pages_access',
                            ],
                            [
                                'title' => 'Города',
                                'route' => 'contacts.countries.index',
                                'permission' => 'pages_access',
                            ],
                            [
                                'title' => 'SEO данные',
                                'route' => 'contacts.seo',
                                'request' => ['id' => 'contacts'],
                                'permission' => 'seo_access',
                            ],
                        ],
                    ],

                    [
                        'title' => 'Поддержка',
                        'route' => 'support.edit',
                        'routeIs' => 'support.*',
                        'page' => 'support',
                        'icon' => 'umbrella',
                        'permission' => 'pages_access',
                        'child' => [
                            [
                                'title' => 'Главная',
                                'route' => 'support.edit',
                                'permission' => 'pages_access',
                            ],
                            [
                                'title' => 'Блоки',
                                'route' => 'blocks.default.index',
                                'request' => ['page' => 'support'],
                                'permission' => 'pages_blocks_access',
                            ],
                            [
                                'title' => 'Вопросы и ответы',
                                'route' => 'attach.faq.form',
                                'request' => ['page' => 'support'],
                                'permission' => 'pages_access',
                            ],
                            [
                                'title' => 'SEO данные',
                                'route' => 'support.seo',
                                'request' => ['id' => 'support'],
                                'permission' => 'seo_access',
                            ],
                        ],
                    ],

                    [
                        'title' => 'Партнеры',
                        'route' => 'partners.edit',
                        'routeIs' => 'partners.*',
                        'page' => 'partners',
                        'icon' => 'users',
                        'permission' => 'pages_access',
                        'child' => [
                            [
                                'title' => 'Главная',
                                'route' => 'partners.edit',
                                'permission' => 'pages_access',
                            ],
                            [
                                'title' => 'Блоки',
                                'route' => 'blocks.default.index',
                                'request' => ['page' => 'partners'],
                                'permission' => 'pages_blocks_access',
                            ],
                            [
                                'title' => 'Вопросы и ответы',
                                'route' => 'attach.faq.form',
                                'request' => ['page' => 'partners'],
                                'permission' => 'pages_access',
                            ],
                            [
                                'title' => 'Категории',
                                'route' => 'partners.categories.index',
                                'permission' => 'pages_access',
                            ],
                            [
                                'title' => 'Список',
                                'route' => 'partners.list.index',
                                'permission' => 'pages_access',
                            ],
                            [
                                'title' => 'SEO данные',
                                'route' => 'partners.seo',
                                'request' => ['id' => 'partners'],
                                'permission' => 'seo_access',
                            ],
                        ],
                    ],

                    [
                        'title' => 'Информация',
                        'route' => 'informations.edit',
                        'routeIs' => 'informations.*',
                        'page' => 'informations',
                        'icon' => 'book-open',
                        'permission' => 'pages_access',
                        'child' => [
                            [
                                'title' => 'Главная',
                                'route' => 'informations.edit',
                                'permission' => 'pages_access',
                            ],
                            [
                                'title' => 'Блоки',
                                'route' => 'blocks.default.index',
                                'request' => ['page' => 'informations'],
                                'permission' => 'pages_blocks_access',
                            ],
                            [
                                'title' => 'Вопросы и ответы',
                                'route' => 'attach.faq.form',
                                'request' => ['page' => 'informations'],
                                'permission' => 'pages_access',
                            ],
                            [
                                'title' => 'Категории',
                                'route' => 'informations.categories.index',
                                'permission' => 'pages_access',
                            ],
                            [
                                'title' => 'Список',
                                'route' => 'informations.list.index',
                                'permission' => 'pages_access',
                            ],
                            [
                                'title' => 'SEO данные',
                                'route' => 'informations.seo',
                                'request' => ['id' => 'informations'],
                                'permission' => 'seo_access',
                            ],
                        ],
                    ],

                    [
                        'title' => 'Оплата и доставка',
                        'route' => 'payment_delivery.edit',
                        'routeIs' => 'payment_delivery.*',
                        'page' => 'payment_delivery',
                        'icon' => 'truck',
                        'permission' => 'pages_access',
                        'child' => [
                            [
                                'title' => 'Главная',
                                'route' => 'payment_delivery.edit',
                                'permission' => 'pages_access',
                            ],
                            [
                                'title' => 'Блоки',
                                'route' => 'blocks.default.index',
                                'request' => ['page' => 'payment_delivery'],
                                'permission' => 'pages_blocks_access',
                            ],
                            [
                                'title' => 'Вопросы и ответы',
                                'route' => 'attach.faq.form',
                                'request' => ['page' => 'payment_delivery'],
                                'permission' => 'pages_access',
                            ],
                            [
                                'title' => 'Категории',
                                'route' => 'payment_delivery.categories.index',
                                'permission' => 'pages_access',
                            ],
                            [
                                'title' => 'SEO данные',
                                'route' => 'payment_delivery.seo',
                                'request' => ['id' => 'payment_delivery'],
                                'permission' => 'seo_access',
                            ],
                        ],
                    ],

                    [
                        'title' => 'Оплата Online',
                        'route' => 'payment.edit',
                        'routeIs' => 'payment.*',
                        'page' => 'payment',
                        'icon' => 'dollar-sign',
                        'permission' => 'pages_access',
                        'child' => [
                            [
                                'title' => 'Главная',
                                'route' => 'payment.edit',
                                'permission' => 'pages_access',
                            ],
                            [
                                'title' => 'Блоки',
                                'route' => 'blocks.default.index',
                                'request' => ['page' => 'payment'],
                                'permission' => 'pages_blocks_access',
                            ],
                            [
                                'title' => 'SEO данные',
                                'route' => 'payment.seo',
                                'request' => ['id' => 'payment'],
                                'permission' => 'seo_access',
                            ],
                        ],
                    ],

                    [
                        'title' => 'Личный кабинет',
                        'route' => 'profile.edit',
                        'routeIs' => 'profile.*',
                        'page' => 'profile',
                        'icon' => 'lock',
                        'permission' => 'pages_access',
                        'child' => [
                            [
                                'title' => 'Главная',
                                'route' => 'profile.edit',
                                'permission' => 'pages_access',
                            ],
                            [
                                'title' => 'Блоки',
                                'route' => 'blocks.default.index',
                                'request' => ['page' => 'profile'],
                                'permission' => 'pages_blocks_access',
                            ],
                            [
                                'title' => 'Вопросы и ответы',
                                'route' => 'attach.faq.form',
                                'request' => ['page' => 'profile'],
                                'permission' => 'pages_access',
                            ],
                            [
                                'title' => 'SEO данные',
                                'route' => 'profile.seo',
                                'request' => ['id' => 'profile'],
                                'permission' => 'seo_access',
                            ],
                        ],
                    ],

                    [
                        'title' => 'Результаты поиска',
                        'route' => 'search.edit',
                        'routeIs' => 'search.*',
                        'page' => 'search',
                        'icon' => 'search',
                        'permission' => 'pages_access',
                        'child' => [
                            [
                                'title' => 'Главная',
                                'route' => 'search.edit',
                                'permission' => 'pages_access',
                            ],
                            [
                                'title' => 'Блоки',
                                'route' => 'blocks.default.index',
                                'request' => ['page' => 'search'],
                                'permission' => 'pages_blocks_access',
                            ],
                            [
                                'title' => 'Вопросы и ответы',
                                'route' => 'attach.faq.form',
                                'request' => ['page' => 'search'],
                                'permission' => 'pages_access',
                            ],
                            [
                                'title' => 'SEO данные',
                                'route' => 'search.seo',
                                'request' => ['id' => 'search'],
                                'permission' => 'seo_access',
                            ],
                        ],
                    ],

                    [
                        'title' => 'Конструктор',
                        'route' => 'constructor.index',
                        'routeIs' => 'constructor.index',
                        'icon' => 'box',
                        'permission' => 'constructor_access',
                    ],

                ],
            ],

            [
                'title' => 'Контент',
                'permission' => 'pages_access',
                'child' => [

                    [
                        'title' => 'Каталог',
                        'route' => 'catalog.edit',
                        'routeIs' => 'catalog.*',
                        'icon' => 'trello',
                        'permission' => 'catalog_access',
                        'child' => [
                            [
                                'title' => 'Главная',
                                'route' => 'catalog.edit',
                                'permission' => 'catalog_access',
                            ],
                            [
                                'title' => 'Блоки',
                                'route' => 'blocks.default.index',
                                'request' => ['page' => 'catalog'],
                                'permission' => 'catalog_access',
                            ],
                            [
                                'title' => 'Контрагенты',
                                'route' => 'catalog.contragents.index',
                                'permission' => 'catalog_access',
                            ],
                            [
                                'title' => 'Категории',
                                'route' => 'catalog.categories.index',
                                'permission' => 'catalog_access',
                            ],
                            [
                                'title' => 'Вопросы и ответы',
                                'route' => 'attach.faq.form',
                                'request' => ['page' => 'catalog'],
                                'permission' => 'pages_access',
                            ],
                            [
                                'title' => 'Продукты',
                                'route' => 'catalog.products.index',
                                'permission' => 'catalog_access',
                            ],
                            [
                                'title' => 'SEO данные',
                                'route' => 'catalog.seo',
                                'request' => ['id' => 'catalog'],
                                'permission' => 'seo_access',
                            ],
                        ],
                    ],

                    [
                        'title' => 'Каталог B2B',
                        'route' => 'b2b.edit',
                        'routeIs' => 'b2b.*',
                        'icon' => 'trello',
                        'permission' => 'catalog_access',
                        'child' => [
                            [
                                'title' => 'Главная',
                                'route' => 'b2b.edit',
                                'permission' => 'catalog_access',
                            ],
                            [
                                'title' => 'Блоки',
                                'route' => 'blocks.default.index',
                                'request' => ['page' => 'b2b'],
                                'permission' => 'catalog_access',
                            ],
                            [
                                'title' => 'Контрагенты',
                                'route' => 'b2b.contragents.index',
                                'permission' => 'catalog_access',
                            ],
                            [
                                'title' => 'Категории',
                                'route' => 'b2b.categories.index',
                                'permission' => 'catalog_access',
                            ],
                            [
                                'title' => 'Вопросы и ответы',
                                'route' => 'attach.faq.form',
                                'request' => ['page' => 'b2b'],
                                'permission' => 'pages_access',
                            ],
                            [
                                'title' => 'Продукты',
                                'route' => 'b2b.products.index',
                                'permission' => 'catalog_access',
                            ],
                            [
                                'title' => 'SEO данные',
                                'route' => 'b2b.seo',
                                'request' => ['id' => 'b2b'],
                                'permission' => 'seo_access',
                            ],
                        ],
                    ],

                    [
                        'title' => 'Блог',
                        'route' => 'articles.edit',
                        'routeIs' => 'articles.*',
                        'icon' => 'rss',
                        'permission' => 'articles_access',
                        'child' => [
                            [
                                'title' => 'Главная',
                                'route' => 'articles.edit',
                                'permission' => 'articles_access',
                            ],
                            [
                                'title' => 'Блоки',
                                'route' => 'blocks.default.index',
                                'request' => ['page' => 'articles'],
                                'permission' => 'articles_access',
                            ],
                            [
                                'title' => 'Вопросы и ответы',
                                'route' => 'attach.faq.form',
                                'request' => ['page' => 'articles'],
                                'permission' => 'pages_access',
                            ],
                            [
                                'title' => 'Список',
                                'route' => 'articles.list.index',
                                'permission' => 'articles_access',
                            ],
                            [
                                'title' => 'Категории',
                                'route' => 'articles.categories.index',
                                'permission' => 'articles_access',
                            ],
                            [
                                'title' => 'SEO данные',
                                'route' => 'articles.seo',
                                'request' => ['id' => 'articles'],
                                'permission' => 'seo_access',
                            ],
                        ],
                    ],

//                    [
//                        'title' => 'Акции',
//                        'route' => 'sales.edit',
//                        'routeIs' => 'sales.*',
//                        'icon' => 'gift',
//                        'permission' => 'sales_access',
//                        'child' => [
//                            [
//                                'title' => 'Главная',
//                                'route' => 'sales.edit',
//                                'permission' => 'sales_access',
//                            ],
//                            [
//                                'title' => 'Вопросы и ответы',
//                                'route' => 'attach.faq.form',
//                                'request' => ['page' => 'sales'],
//                                'permission' => 'pages_access',
//                            ],
//                            [
//                                'title' => 'Список',
//                                'route' => 'sales.list.index',
//                                'permission' => 'sales_access',
//                            ],
//                            [
//                                'title' => 'Категории',
//                                'route' => 'sales.categories.index',
//                                'permission' => 'sales_access',
//                            ],
//                            [
//                                'title' => 'SEO данные',
//                                'route' => 'sales.seo',
//                                'request' => ['id' => 'sales'],
//                                'permission' => 'seo_access',
//                            ],
//                        ],
//                    ],

                    [
                        'title' => 'Отзывы',
                        'route' => 'reviews.edit',
                        'routeIs' => 'reviews.*',
                        'icon' => 'star',
                        'permission' => 'reviews_access',
                        'child' => [
                            [
                                'title' => 'Главная',
                                'route' => 'reviews.edit',
                                'permission' => 'reviews_access',
                            ],
                            [
                                'title' => 'Список',
                                'route' => 'reviews.list.index',
                                'permission' => 'reviews_access',
                            ],
                            [
                                'title' => 'SEO данные',
                                'route' => 'reviews.seo',
                                'request' => ['id' => 'reviews'],
                                'permission' => 'seo_access',
                            ],
                        ],
                    ],
                    [
                        'title' => 'FAQ',
                        'route' => 'faq.edit',
                        'routeIs' => 'faq.*',
                        'icon' => 'book-open',
                        'permission' => 'faq_access',
                        'child' => [
                            [
                                'title' => 'Главная',
                                'route' => 'faq.edit',
                                'permission' => 'faq_access',
                            ],
                            [
                                'title' => 'Блоки',
                                'route' => 'blocks.default.index',
                                'request' => ['page' => 'faq'],
                                'permission' => 'faq_access',
                            ],
                            [
                                'title' => 'Список',
                                'route' => 'faq.list.index',
                                'permission' => 'faq_access',
                            ],
                            [
                                'title' => 'Категории',
                                'route' => 'faq.categories.index',
                                'permission' => 'faq_access',
                            ],
                            [
                                'title' => 'SEO данные',
                                'route' => 'faq.seo',
                                'request' => ['id' => 'faq'],
                                'permission' => 'seo_access',
                            ],
                        ],
                    ],
                    [
                        'title' => 'Тэги',
                        'route' => 'tag.edit',
                        'routeIs' => 'tag.*',
                        'icon' => 'hash',
                        'permission' => 'tags_access',
                        'child' => [
                            [
                                'title' => 'Список',
                                'route' => 'tag.index',
                                'permission' => 'tags_access',
                            ],
                        ],
                    ],

                ],
            ],

            [
                'title' => 'E-Commerce',
                'permission' => 'ecommerce_access',
                'child' => [

                    [
                        'title' => 'Заказы',
                        'route' => 'ecommerce.order.index',
                        'routeIs' => 'ecommerce.order.index',
                        'icon' => 'shopping-cart',
                        'permission' => 'ecommerce_orders_access',
                    ],

                    [
                        'title' => 'Промокоды',
                        'route' => 'ecommerce.promocodes.index',
                        'routeIs' => 'ecommerce.promocodes.index',
                        'icon' => 'percent',
                        'permission' => 'ecommerce_promocodes_access',
                    ],

                ],
            ],

            [
                'title' => 'Модули',
                'permission' => 'modules_access',
                'child' => [

                    [
                        'title' => 'E-Documents',
                        'routeIs' => 'edocuments.*',
                        'icon' => 'hash',
                        'permission' => 'modules_access',
                        'child' => [
                            [
                                'title' => 'Документы',
                                'route' => 'edocuments.index',
                                'permission' => 'modules_edocuments_documents_access',
                            ],
                            [
                                'title' => 'Типы документов',
                                'route' => 'edocuments.type.index',
                                'permission' => 'modules_edocuments_type_access',
                            ],
                            [
                                'title' => 'Плейсхолдеры',
                                'route' => 'edocuments.placeholders.index',
                                'permission' => 'modules_edocuments_placeholders_access',
                            ],
//                            [
//                                'title' => 'Настройки',
//                                'route' => '',
//                                'permission' => 'modules_edocuments_access',
//                            ],

                        ],
                    ],

                    [
                        'title' => 'PayHub',
                        'routeIs' => 'payhub.*',
                        'icon' => 'dollar-sign',
                        'permission' => 'modules_payhub_access',
                        'child' => [
                            [
                                'title' => 'Главная',
                                'route' => 'payhub.index',
                                'permission' => 'modules_payhub_access',
                            ],
                            [
                                'title' => 'Системы оплат',
                                'route' => 'payhub.systems.index',
                                'permission' => 'modules_payhub_systems_access',
                            ],
                            [
                                'title' => 'История',
                                'route' => 'payhub.logs.index',
                                'permission' => 'modules_payhub_access',
                            ],

                        ],
                    ],


                ],
            ],

        ],

    ],

    /**
     * Template Nav
     */
    'template' => 'template-parts.nav-sidebar.nav'

];
