<?php
namespace Database\Seeders;

use Backend\Models\Permission;
use Backend\Modules\EDocuments\Models\EDocuments;
use Backend\Modules\EDocuments\Models\EDocumentsPlaceholders;
use Illuminate\Database\Seeder;

class EDocumentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        EDocuments::insert([
            [
                'id' => 1,
                'name' => 'Персональное предложение',
                'description' => 'Уникальный для каждого СП',
                'type' => 1,
                'endpoint' => 'edoc_1',
                'folder' => '/',
                'filename' => '{file}',
            ],
            [
                'id' => 2,
                'name' => 'Договор страхования',
                'description' => 'Уникальный для каждого СП',
                'type' => 1,
                'endpoint' => 'edoc_2',
                'folder' => '/',
                'filename' => '{file}',
            ],
            [
                'id' => 3,
                'name' => 'Протокол о заключении электронного договора',
                'description' => 'Делается на основании лог-файла действий клиента на сайте для подтверждения волеизлияния реального человека на покупку СП. Клиенту  отдавать только сам Протокол и то сразу в ЛК. Одинаковый для всех СП',
                'type' => 1,
                'endpoint' => 'edoc_3',
                'folder' => '/',
                'filename' => '{file}',
            ],
            [
                'id' => 4,
                'name' => 'Заявление на выплату',
                'description' => 'Уникальный для каждого СП',
                'type' => 1,
                'endpoint' => 'edoc_4',
                'folder' => '/',
                'filename' => '{file}',
            ],
            [
                'id' => 5,
                'name' => 'Решение о Выплате',
                'description' => '',
                'type' => 1,
                'endpoint' => 'edoc_5',
                'folder' => '/',
                'filename' => '{file}',
            ],
            [
                'id' => 6,
                'name' => 'Решение об отказе',
                'description' => '',
                'type' => 1,
                'endpoint' => 'edoc_6',
                'folder' => '/',
                'filename' => '{file}',
            ],
            [
                'id' => 7,
                'name' => 'Подтверждение оплаты',
                'description' => 'Док, подтверждающий, что СК получали оплату по данному конкретному договору. Одинаковое для всех СП',
                'type' => 1,
                'endpoint' => 'edoc_7',
                'folder' => '/',
                'filename' => '{file}',
            ],
            [
                'id' => 8,
                'name' => 'Страховой акт',
                'description' => '',
                'type' => 1,
                'endpoint' => 'edoc_8',
                'folder' => '/',
                'filename' => '{file}',
            ],
            [
                'id' => 9,
                'name' => 'Log File действия клиента на сайте при покупке СП',
                'description' => 'Одинаковый для всех СП',
                'type' => 1,
                'endpoint' => 'edoc_9',
                'folder' => '/',
                'filename' => '{file}',
            ],
        ]);

        Permission::insert([
            [
                'name' => 'Модуль E-Documents: просмотр',
                'slug' => 'modules_edocuments_access',
            ],
            [
                'name' => 'Модуль E-Documents: Типы (просмотр)',
                'slug' => 'modules_edocuments_type_access',
            ],
            [
                'name' => 'Модуль E-Documents: Типы (создание)',
                'slug' => 'modules_edocuments_type_create',
            ],
            [
                'name' => 'Модуль E-Documents: Типы (обновление)',
                'slug' => 'modules_edocuments_type_update',
            ],
            [
                'name' => 'Модуль E-Documents: Типы (удаление)',
                'slug' => 'modules_edocuments_type_destroy',
            ],
            [
                'name' => 'Модуль E-Documents: Документы (просмотр)',
                'slug' => 'modules_edocuments_documents_access',
            ],
            [
                'name' => 'Модуль E-Documents: Документы (создание)',
                'slug' => 'modules_edocuments_documents_create',
            ],
            [
                'name' => 'Модуль E-Documents: Документы (обновление)',
                'slug' => 'modules_edocuments_documents_update',
            ],
            [
                'name' => 'Модуль E-Documents: Документы (удаление)',
                'slug' => 'modules_edocuments_documents_destroy',
            ],
            [
                'name' => 'Модуль E-Documents: Настройки (просмотр)',
                'slug' => 'modules_edocuments_settings_access',
            ],
            [
                'name' => 'Модуль E-Documents: Настройки (обновление)',
                'slug' => 'modules_edocuments_settings_update',
            ],
            [
                'name' => 'Модуль E-Documents: Плейсхолдеры (просмотр)',
                'slug' => 'modules_edocuments_placeholders_access',
            ],
            [
                'name' => 'Модуль E-Documents: Плейсхолдеры (создание)',
                'slug' => 'modules_edocuments_placeholders_create',
            ],
            [
                'name' => 'Модуль E-Documents: Плейсхолдеры (обновление)',
                'slug' => 'modules_edocuments_placeholders_update',
            ],
            [
                'name' => 'Модуль E-Documents: Плейсхолдеры (удаление)',
                'slug' => 'modules_edocuments_placeholders_destroy',
            ],
        ]);

        EDocumentsPlaceholders::insert([
            [
                'name' => 'Имя',
                'slug' => 'first_name',
                'render' => 'Вася',
            ],
            [
                'name' => 'Фамилия',
                'slug' => 'last_name',
                'render' => 'Пуговкин',
            ],
            [
                'name' => 'Полное имя',
                'slug' => 'name',
                'render' => 'Василий Пуговкин',
            ],
            [
                'name' => 'Телефон',
                'slug' => 'phone',
                'render' => '+38(048) 111-22-33',
            ],
            [
                'name' => 'E-mail',
                'slug' => 'email',
                'render' => 'vasiliy-pugovkin@gmail.com',
            ],
            [
                'name' => 'Почтовый индекс',
                'slug' => 'postcode',
                'render' => '65000',
            ],
            [
                'name' => 'Возраст',
                'slug' => 'age',
                'render' => '28 лет',
            ],
            [
                'name' => 'Страна',
                'slug' => 'country',
                'render' => 'Украина',
            ],
            [
                'name' => 'Город',
                'slug' => 'city',
                'render' => 'Одесса',
            ],
            [
                'name' => 'Уица',
                'slug' => 'street',
                'render' => 'Дерибасовская',
            ],
            [
                'name' => 'Дом',
                'slug' => 'house',
                'render' => '2А',
            ],
        ]);

    }
}

