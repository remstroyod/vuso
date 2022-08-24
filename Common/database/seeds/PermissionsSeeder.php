<?php

namespace Database\Seeders;

use Backend\Models\Permission;
use Backend\Models\Profile\User;
use Backend\Models\Role;
use Backend\Models\Roles;
use Illuminate\Database\Seeder;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Permission::insert([
            [
                'name' => 'Настройки: просмотр',
                'slug' => 'settings_access'
            ],
            [
                'name' => 'Настройки: изменение',
                'slug' => 'settings_update'
            ],
            [
                'name' => 'Профиль: просмотр',
                'slug' => 'profile_access'
            ],
            [
                'name' => 'Профиль: редактирование',
                'slug' => 'profile_update'
            ],
            [
                'name' => 'Пользователи: просмотр',
                'slug' => 'users_access'
            ],
            [
                'name' => 'Пользователи: создание',
                'slug' => 'users_create'
            ],
            [
                'name' => 'Пользователи: обновление',
                'slug' => 'users_update'
            ],
            [
                'name' => 'Пользователи: удаление',
                'slug' => 'users_destroy'
            ],
            [
                'name' => 'Роли и права',
                'slug' => 'roles_and_permissions_access'
            ],
            [
                'name' => 'Роли: просмотр',
                'slug' => 'roles_access'
            ],
            [
                'name' => 'Роли: создание',
                'slug' => 'roles_create'
            ],
            [
                'name' => 'Роли: обновление',
                'slug' => 'roles_update'
            ],
            [
                'name' => 'Роли: удаление',
                'slug' => 'roles_destroy'
            ],
            [
                'name' => 'Права: просмотр',
                'slug' => 'permissions_access'
            ],
            [
                'name' => 'Права: создание',
                'slug' => 'permissions_create'
            ],
            [
                'name' => 'Права: обновление',
                'slug' => 'permissions_update'
            ],
            [
                'name' => 'Права: удаление',
                'slug' => 'permissions_destroy'
            ],
            [
                'name' => 'Данные форм: просмотр',
                'slug' => 'formsdata_access'
            ],
            [
                'name' => 'Данные форм: обновление',
                'slug' => 'formsdate_update'
            ],
            [
                'name' => 'Данные форм: удаление',
                'slug' => 'formsdate_destroy'
            ],
            [
                'name' => 'Страницы: просмотр',
                'slug' => 'pages_access'
            ],
            [
                'name' => 'Страницы: создание',
                'slug' => 'pages_create'
            ],
            [
                'name' => 'Страницы: обновление',
                'slug' => 'pages_update'
            ],
            [
                'name' => 'Страницы: удаление',
                'slug' => 'pages_destroy'
            ],
            [
                'name' => 'Конструктор: просмотр',
                'slug' => 'constructor_access'
            ],
            [
                'name' => 'Конструктор: создание',
                'slug' => 'constructor_create'
            ],
            [
                'name' => 'Конструктор: обновление',
                'slug' => 'constructor_update'
            ],
            [
                'name' => 'Конструктор: удаление',
                'slug' => 'constructor_destroy'
            ],
            [
                'name' => 'Новости: просмотр',
                'slug' => 'articles_access'
            ],
            [
                'name' => 'Новости: создание',
                'slug' => 'articles_create'
            ],
            [
                'name' => 'Новости: обновление',
                'slug' => 'articles_update'
            ],
            [
                'name' => 'Новости: удаление',
                'slug' => 'articles_destroy'
            ],
            [
                'name' => 'Акции: просмотр',
                'slug' => 'sales_access'
            ],
            [
                'name' => 'Акции: создание',
                'slug' => 'sales_create'
            ],
            [
                'name' => 'Акции: обновление',
                'slug' => 'sales_update'
            ],
            [
                'name' => 'Акции: удаление',
                'slug' => 'sales_destroy'
            ],
            [
                'name' => 'Отзывы: просмотр',
                'slug' => 'reviews_access'
            ],
            [
                'name' => 'Отзывы: создание',
                'slug' => 'reviews_create'
            ],
            [
                'name' => 'Отзывы: обновление',
                'slug' => 'reviews_update'
            ],
            [
                'name' => 'Отзывы: удаление',
                'slug' => 'reviews_destroy'
            ],
            [
                'name' => 'FAQ: просмотр',
                'slug' => 'faq_access'
            ],
            [
                'name' => 'FAQ: создание',
                'slug' => 'faq_create'
            ],
            [
                'name' => 'FAQ: обновление',
                'slug' => 'faq_update'
            ],
            [
                'name' => 'FAQ: удаление',
                'slug' => 'faq_destroy'
            ],
            [
                'name' => 'Модули',
                'slug' => 'modules_access'
            ],
            [
                'name' => 'Модуль E-Documents: просмотр',
                'slug' => 'modules_edocuments_access'
            ],
            [
                'name' => 'SEO: просмотр',
                'slug' => 'seo_access'
            ],
            [
                'name' => 'SEO: обновление',
                'slug' => 'seo_update'
            ],
            [
                'name' => 'Каталог: просмотр',
                'slug' => 'catalog_access'
            ],
            [
                'name' => 'Каталог: создание',
                'slug' => 'catalog_create'
            ],
            [
                'name' => 'Каталог: обновление',
                'slug' => 'catalog_update'
            ],
            [
                'name' => 'Каталог: удаление',
                'slug' => 'catalog_destroy'
            ],
            [
                'name' => 'Документация: просмотр',
                'slug' => 'documentation_access'
            ],
            [
                'name' => 'Ecommerce: просмотр',
                'slug' => 'ecommerce_access'
            ],
            [
                'name' => 'Ecommerce: заказы (просмотр)',
                'slug' => 'ecommerce_orders_access'
            ],
            [
                'name' => 'Ecommerce: промокоды (просмотр)',
                'slug' => 'ecommerce_promocodes_access'
            ],
            [
                'name' => 'Ecommerce: заказы (обновление)',
                'slug' => 'ecommerce_orders_update'
            ],
            [
                'name' => 'Ecommerce: заказы (удаление)',
                'slug' => 'ecommerce_orders_destroy'
            ],
            [
                'name' => 'Ecommerce: заказы (создание)',
                'slug' => 'ecommerce_orders_create'
            ],
            [
                'name' => 'Ecommerce: промокоды (создание)',
                'slug' => 'ecommerce_promocodes_create'
            ],
            [
                'name' => 'Ecommerce: промокоды (обновление)',
                'slug' => 'ecommerce_promocodes_update'
            ],
            [
                'name' => 'Ecommerce: промокоды (удаление)',
                'slug' => 'ecommerce_promocodes_destroy'
            ],

            [
                'name' => 'Страницы: блоки (просмотр)',
                'slug' => 'pages_blocks_access'
            ],
            [
                'name' => 'Страницы: блоки (создание)',
                'slug' => 'pages_blocks_create'
            ],
            [
                'name' => 'Страницы: блоки (обновление)',
                'slug' => 'pages_blocks_update'
            ],
            [
                'name' => 'Страницы: блоки (удаление)',
                'slug' => 'pages_blocks_destroy'
            ],
            [
                'name' => 'Меню: просмотр',
                'slug' => 'menu_access'
            ],
            [
                'name' => 'Меню: создание',
                'slug' => 'menu_create'
            ],
            [
                'name' => 'Меню: обновление',
                'slug' => 'menu_update'
            ],
            [
                'name' => 'Меню: удаление',
                'slug' => 'menu_destroy'
            ],
            [
                'name' => 'Тэги: просмотр',
                'slug' => 'tags_access'
            ],
            [
                'name' => 'Тэги: создание',
                'slug' => 'tags_create'
            ],
            [
                'name' => 'Тэги: обновление',
                'slug' => 'tags_update'
            ],
            [
                'name' => 'Тэги: удаление',
                'slug' => 'tags_destroy'
            ],
            [
                'name' => 'Модуль PayHub: просмотр',
                'slug' => 'modules_payhub_access'
            ],
            [
                'name' => 'Модуль PayHub: Системы оплат (просмотр)',
                'slug' => 'modules_payhub_systems_access'
            ],
            [
                'name' => 'Модуль PayHub: Системы оплат (создание)',
                'slug' => 'modules_payhub_systems_create'
            ],
            [
                'name' => 'Модуль PayHub: Системы оплат (обновление)',
                'slug' => 'modules_payhub_systems_update'
            ],
            [
                'name' => 'Модуль PayHub: Системы оплат (удаление)',
                'slug' => 'modules_payhub_systems_destroy'
            ],
        ]);

        Roles::insert([
           [
               'user_id' => 1,
               'role_id' => 1
           ],
        ]);

    }
}
