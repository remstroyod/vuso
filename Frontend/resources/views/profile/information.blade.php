@extends('layouts.app')

@section('meta')

    <meta name="description" content="{{ ($page->seo) ? $page->seo->description : '' }}">
    <title>{{ ($page->seo) ? $page->seo->title : '' }}</title>

@endsection

@section('content')

    <!-- Cabinet -->
    <section class="cabinet">

        <!-- container -->
        <div class="container">

            @include( 'profile.partials.partial-headpanel' )

            <div class="cabinet__group cabinet__personal">
                <div class="cabinet__group-title">
                    Мои данные
                </div>
                <div class="cabinet__group-content cabinet__personal-list">
                    <div class="cabinet__personal-item cabinet__personal-item--person">
                        <div class="cabinet__personal-item__head">
                            <div class="cabinet__personal-item__title">{{ __('Личная информация') }}</div>
                            <!-- поправил кнопку -->
                            <button class="cabinet__personal-item__edit">
                                            <span>
                                                Изменить
                                            </span>
                                <span>
                                                Сохранить изменения
                                            </span>
                            </button>
                        </div>
                        <div class="cabinet__personal-item__body">
                            <div class="cabinet__personal-item__content">
                                <div class="cabinet__personal-item__param-groups">
                                    <div class="cabinet__personal-item__param-group wide">
                                        <div class="cabinet__personal-item__param-label">ФИО (на украинском)</div>
                                        <div class="cabinet__personal-item__param-value">Яблочкова Валентина Инокентиевна</div>
                                        <div class="cabinet__personal-item__param-inputs">
                                            <div class="input-wrapper">
                                                <input type="text" value="Яблочкова" placeholder="Введите вашу фамилию" required>
                                            </div>
                                            <div class="input-wrapper">
                                                <input type="text" value="Валентина" placeholder="Введите ваше имя" required>
                                            </div>
                                            <div class="input-wrapper">
                                                <input type="text" value="Інокентіївна" placeholder="Введите ваше отчество" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="cabinet__personal-item__param-group">
                                        <div class="cabinet__personal-item__param-label">Телефон</div>
                                        <div class="cabinet__personal-item__param-value">+380 (68) 660 22 22</div>
                                        <div class="cabinet__personal-item__param-inputs">
                                            <div class="input-wrapper">
                                                <input type="phone" value="+380 (68) 660 22 22" placeholder="Введите ваш телефон" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="cabinet__personal-item__param-group">
                                        <div class="cabinet__personal-item__param-label">Дата рождения</div>
                                        <div class="cabinet__personal-item__param-value">21.04.1984</div>
                                        <div class="cabinet__personal-item__param-inputs">
                                            <div class="input-wrapper">
                                                <input type="text" value="21.04.1984" placeholder="Введите дату рождения" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="cabinet__personal-item__param-group wide">
                                        <div class="cabinet__personal-item__param-label">Емейл</div>
                                        <div class="cabinet__personal-item__param-value">valentina@gmail.com</div>
                                        <div class="cabinet__personal-item__param-inputs">
                                            <div class="input-wrapper">
                                                <input type="email" value="valentina@mail.com" placeholder="Введите вашу почту" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- добавленные группы -->
                                <div class="cabinet__personal-item__param-groups hidden">
                                    <div class="cabinet__personal-item__param-group wide">
                                        <div class="cabinet__personal-item__param-label">Адрес прописки</div>
                                        <div class="cabinet__personal-item__param-value">г. Одесса, ул.Крымская, дом 84, квартира 32</div>
                                        <div class="cabinet__personal-item__param-inputs address-inputs">
                                            <div class="input-wrapper">
                                                <input type="text" value="г. Одесса" placeholder="Введите ваш город" required>
                                            </div>
                                            <div class="input-wrapper select-wrapper street-type-wrapper">
                                                <select>
                                                    <option value="Улица" selected>Улица</option>
                                                    <option value="Проспект">Проспект</option>
                                                    <option value="Бульвар">Бульвар</option>
                                                    <option value="Переулок">Переулок</option>
                                                    <option value="Тупик">Тупик</option>
                                                    <option value="Набережная">Набережная</option>
                                                    <option value="Взвоз">Взвоз</option>
                                                    <option value="Аллея">Аллея</option>
                                                    <option value="Тракт">Тракт</option>
                                                </select>
                                            </div>
                                            <div class="input-wrapper street-name-wrapper">
                                                <input type="text" value="Крымская" placeholder="Введите вашу улицу" required>
                                            </div>
                                            <div class="input-wrapper building-number-wrapper">
                                                <input type="text" value="Дом 84" placeholder="Введите номер дома" required>
                                            </div>
                                            <div class="input-wrapper apartment-number-wrapper">
                                                <input type="text" value="Квартира 32" placeholder="Введите номер квартиры" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="cabinet__personal-item__param-group wide">
                                        <div class="cabinet__personal-item__param-label">Номер паспорта</div>
                                        <div class="cabinet__personal-item__param-value">2359834659611</div>
                                        <div class="cabinet__personal-item__param-inputs">
                                            <div class="input-wrapper">
                                                <input type="text" value="2359834659611" placeholder="Введите номер паспорта" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="cabinet__personal-item__param-group wide">
                                        <div class="cabinet__personal-item__param-label">ИНН</div>
                                        <div class="cabinet__personal-item__param-value">9834659611</div>
                                        <div class="cabinet__personal-item__param-inputs">
                                            <div class="input-wrapper">
                                                <input type="text" value="9834659611" placeholder="Введите ваш ИНН" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cabinet__personal-item__param-groups hidden">
                                    <div class="cabinet__personal-item__param-group wide">
                                        <div class="cabinet__personal-item__param-label">Имя и фамилия в загранпаспорте (на латинице)</div>
                                        <div class="cabinet__personal-item__param-value">Yablochkova Valentina</div>
                                        <div class="cabinet__personal-item__param-inputs">
                                            <div class="input-wrapper">
                                                <input type="text" value="Yablochkova" placeholder="Введите фамилию в загранпаспорте">
                                            </div>
                                            <div class="input-wrapper">
                                                <input type="text" value="Valentina" placeholder="Введите имя в загранпаспорте">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="cabinet__personal-item__param-group wide international-passport-group">
                                        <div class="cabinet__personal-item__param-label">Номер загранпаспорта</div>
                                        <div class="cabinet__personal-item__param-value">2359834659611</div>
                                        <div class="cabinet__personal-item__param-inputs">
                                            <div class="input-wrapper">
                                                <input type="text" value="2359834659611" placeholder="Введите номер загранпаспорта">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="cabinet__personal-item__param-group wide">
                                        <div class="cabinet__personal-item__param-label">Серия загранпаспорта </div>
                                        <div class="cabinet__personal-item__param-value">9834659611</div>
                                        <div class="cabinet__personal-item__param-inputs">
                                            <div class="input-wrapper">
                                                <input type="text" value="2359834659611" placeholder="Введите серию загранпаспорта">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- конец добавленные группы -->
                            </div>

                            <!-- поправил кнопку -->
                            <button class="cabinet__personal-item__toggler">
                                            <span>
                                                Показать всю информацию
                                            </span>
                                <span>
                                                Скрыть дополнительную информацию
                                            </span>
                            </button>
                        </div>
                    </div>

                    <div class="cabinet__personal-item">
                        <div class="cabinet__personal-item__head">
                            <div class="cabinet__personal-item__title">Подключенные сервисы</div>

                            <div class="popover-trigger" data-bs-toggle="popover" data-bs-placement="bottom" data-bs-trigger="hover focus" title="Popover title" data-bs-content="And here's some amazing content. It's very engaging. Right?"></div>
                        </div>
                        <div class="cabinet__personal-item__body">
                            <div class="cabinet__personal-item__content">
                                <div class="cabinet__personal-item__content-descr">
                                    Вы можете подключить сервисы, чтобы авторизироваться с их помощью при повторном входе в личный кабинет
                                </div>
                                <div class="cabinet__personal-item__services">
                                    <button class="cabinet__personal-item__service diya active">ДІЯ</button>
                                    <button class="cabinet__personal-item__service bankid">BankID</button>
                                    <button class="cabinet__personal-item__service telegram">Telegram</button>
                                    <button class="cabinet__personal-item__service appleid">Apple ID</button>
                                    <button class="cabinet__personal-item__service facebook">Facebook</button>
                                    <button class="cabinet__personal-item__service googleplus">Google +</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="cabinet__personal-item">
                        <div class="cabinet__personal-item__head">
                            <div class="cabinet__personal-item__title">Ваш автомобиль</div>
                            <button class="cabinet__personal-item__edit">
                                            <span>
                                                Изменить
                                            </span>
                                <span>
                                                Сохранить изменения
                                            </span>
                            </button>
                        </div>
                        <div class="cabinet__personal-item__body">
                            <div class="cabinet__personal-item__content">
                                <div class="cabinet__personal-item__content-title">Volkswagen</div>
                                <div class="cabinet__personal-item__param-groups">
                                    <div class="cabinet__personal-item__param-group">
                                        <div class="cabinet__personal-item__param-label">Гос. номер</div>
                                        <div class="cabinet__personal-item__param-value">ВН 1015 МХ</div>
                                        <div class="cabinet__personal-item__param-inputs">
                                            <div class="input-wrapper">
                                                <input type="text" value="ВН 1015 МХ" placeholder="Введите гос.номер">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="cabinet__personal-item__param-group">
                                        <div class="cabinet__personal-item__param-label">Объём двигателя</div>
                                        <div class="cabinet__personal-item__param-value">1984 см3</div>
                                        <div class="cabinet__personal-item__param-inputs">
                                            <div class="input-wrapper">
                                                <input type="text" value="1984" placeholder="Введите объём двигателя, куб.см">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="cabinet__personal-item__param-group">
                                        <div class="cabinet__personal-item__param-label">Примерная стоимость</div>
                                        <div class="cabinet__personal-item__param-value">850 000 грн</div>

                                        <div class="cabinet__personal-item__param-inputs">
                                            <div class="input-wrapper">
                                                <input type="text" value="850 000" placeholder="Введите ориентировочную стоимость авто">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="cabinet__personal-item__param-group">
                                        <div class="cabinet__personal-item__param-label">Год выпуска</div>
                                        <div class="cabinet__personal-item__param-value">2016</div>

                                        <div class="cabinet__personal-item__param-inputs">
                                            <div class="input-wrapper">
                                                <input type="text" value="2016" placeholder="Введите год выпуска">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- пока нет обновлений по этим блокам структуру сделал наскидку -->
                                <div class="cabinet__personal-item__param-groups hidden">
                                    <div class="cabinet__personal-item__param-group">
                                        <div class="cabinet__personal-item__param-label">Гос. номер</div>
                                        <div class="cabinet__personal-item__param-value">ВН 1015 МХ</div>
                                        <div class="cabinet__personal-item__param-inputs">
                                            <div class="input-wrapper">
                                                <input type="text" value="ВН 1015 МХ" placeholder="Введите гос.номер">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="cabinet__personal-item__param-group">
                                        <div class="cabinet__personal-item__param-label">Объём двигателя</div>
                                        <div class="cabinet__personal-item__param-value">1984 см3</div>
                                        <div class="cabinet__personal-item__param-inputs">
                                            <div class="input-wrapper">
                                                <input type="text" value="1984" placeholder="Введите объём двигателя, куб.см">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="cabinet__personal-item__param-group wide">
                                        <div class="cabinet__personal-item__param-label">Примерная стоимость</div>
                                        <div class="cabinet__personal-item__param-value">850 000 грн</div>

                                        <div class="cabinet__personal-item__param-inputs">
                                            <div class="input-wrapper">
                                                <input type="text" value="850 000" placeholder="Введите ориентировочную стоимость авто">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="cabinet__personal-item__param-group wide">
                                        <div class="cabinet__personal-item__param-label">Год выпуска</div>
                                        <div class="cabinet__personal-item__param-value">2016</div>

                                        <div class="cabinet__personal-item__param-inputs">
                                            <div class="input-wrapper">
                                                <input type="text" value="2016" placeholder="Введите год выпуска">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cabinet__personal-item__param-groups hidden">
                                    <div class="cabinet__personal-item__param-group wide">
                                        <div class="cabinet__personal-item__param-label">Гос. номер</div>
                                        <div class="cabinet__personal-item__param-value">ВН 1015 МХ</div>
                                        <div class="cabinet__personal-item__param-inputs">
                                            <div class="input-wrapper">
                                                <input type="text" value="ВН 1015 МХ" placeholder="Введите гос.номер">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="cabinet__personal-item__param-group">
                                        <div class="cabinet__personal-item__param-label">Объём двигателя</div>
                                        <div class="cabinet__personal-item__param-value">1984 см3</div>
                                        <div class="cabinet__personal-item__param-inputs">
                                            <div class="input-wrapper">
                                                <input type="text" value="1984" placeholder="Введите объём двигателя, куб.см">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="cabinet__personal-item__param-group">
                                        <div class="cabinet__personal-item__param-label">Примерная стоимость</div>
                                        <div class="cabinet__personal-item__param-value">850 000 грн</div>

                                        <div class="cabinet__personal-item__param-inputs">
                                            <div class="input-wrapper">
                                                <input type="text" value="850 000" placeholder="Введите ориентировочную стоимость авто">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="cabinet__personal-item__param-group wide">
                                        <div class="cabinet__personal-item__param-label">Год выпуска</div>
                                        <div class="cabinet__personal-item__param-value">2016</div>

                                        <div class="cabinet__personal-item__param-inputs">
                                            <div class="input-wrapper">
                                                <input type="text" value="2016" placeholder="Введите год выпуска">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="cabinet__personal-item__toggler">
                                            <span>
                                                Показать всю информацию
                                            </span>
                                <span>
                                                Скрыть дополнительную информацию
                                            </span>
                            </div>
                        </div>
                    </div>

                    <!-- карточка другого человека скорее всего идентична моей информации -->
                    <div class="cabinet__personal-item">
                        <div class="cabinet__personal-item__head">
                            <div class="cabinet__personal-item__title">Григоренко Григорий</div>
                            <button class="cabinet__personal-item__edit">
                                            <span>
                                                Изменить
                                            </span>
                                <span>
                                                Сохранить изменения
                                            </span>
                            </button>
                        </div>

                        <!-- Сделал дубль структуры боди ниже с моей информации -->
                        <div class="cabinet__personal-item__body">
                            <div class="cabinet__personal-item__content">
                                <div class="cabinet__personal-item__param-groups">
                                    <div class="cabinet__personal-item__param-group wide">
                                        <div class="cabinet__personal-item__param-label">ФИО (на украинском)</div>
                                        <div class="cabinet__personal-item__param-value">Григоренко Григорий Инокентиевна</div>
                                        <div class="cabinet__personal-item__param-inputs">
                                            <div class="input-wrapper">
                                                <input type="text" value="Яблочкова" placeholder="Введите вашу фамилию" required>
                                            </div>
                                            <div class="input-wrapper">
                                                <input type="text" value="Валентина" placeholder="Введите ваше имя" required>
                                            </div>
                                            <div class="input-wrapper">
                                                <input type="text" value="Інокентіївна" placeholder="Введите ваше отчество" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="cabinet__personal-item__param-group">
                                        <div class="cabinet__personal-item__param-label">Телефон</div>
                                        <div class="cabinet__personal-item__param-value">+380 (68) 660 22 22</div>
                                        <div class="cabinet__personal-item__param-inputs">
                                            <div class="input-wrapper">
                                                <input type="phone" value="+380 (68) 660 22 22" placeholder="Введите ваш телефон" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="cabinet__personal-item__param-group">
                                        <div class="cabinet__personal-item__param-label">Дата рождения</div>
                                        <div class="cabinet__personal-item__param-value">21.04.1984</div>
                                        <div class="cabinet__personal-item__param-inputs">
                                            <div class="input-wrapper">
                                                <input type="text" value="21.04.1984" placeholder="Введите дату рождения" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="cabinet__personal-item__param-group wide">
                                        <div class="cabinet__personal-item__param-label">Емейл</div>
                                        <div class="cabinet__personal-item__param-value">gregory@gmail.com</div>
                                        <div class="cabinet__personal-item__param-inputs">
                                            <div class="input-wrapper">
                                                <input type="email" value="valentina@mail.com" placeholder="Введите вашу почту" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- добавленные группы -->
                                <div class="cabinet__personal-item__param-groups hidden">
                                    <div class="cabinet__personal-item__param-group wide">
                                        <div class="cabinet__personal-item__param-label">Адрес прописки</div>
                                        <div class="cabinet__personal-item__param-value">г. Одесса, ул.Крымская, дом 84, квартира 32</div>
                                        <div class="cabinet__personal-item__param-inputs address-inputs">
                                            <div class="input-wrapper">
                                                <input type="text" value="г. Одесса" placeholder="Введите ваш город" required>
                                            </div>
                                            <div class="input-wrapper select-wrapper street-type-wrapper">
                                                <select>
                                                    <option value="Улица" selected>Улица</option>
                                                    <option value="Проспект">Проспект</option>
                                                    <option value="Бульвар">Бульвар</option>
                                                    <option value="Переулок">Переулок</option>
                                                    <option value="Тупик">Тупик</option>
                                                    <option value="Набережная">Набережная</option>
                                                    <option value="Взвоз">Взвоз</option>
                                                    <option value="Аллея">Аллея</option>
                                                    <option value="Тракт">Тракт</option>
                                                </select>
                                            </div>
                                            <div class="input-wrapper street-name-wrapper">
                                                <input type="text" value="Крымская" placeholder="Введите вашу улицу" required>
                                            </div>
                                            <div class="input-wrapper building-number-wrapper">
                                                <input type="text" value="Дом 84" placeholder="Введите номер дома" required>
                                            </div>
                                            <div class="input-wrapper apartment-number-wrapper">
                                                <input type="text" value="Квартира 32" placeholder="Введите номер квартиры" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="cabinet__personal-item__param-group wide">
                                        <div class="cabinet__personal-item__param-label">Номер паспорта</div>
                                        <div class="cabinet__personal-item__param-value">2359834659611</div>
                                        <div class="cabinet__personal-item__param-inputs">
                                            <div class="input-wrapper">
                                                <input type="text" value="2359834659611" placeholder="Введите номер паспорта" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="cabinet__personal-item__param-group wide">
                                        <div class="cabinet__personal-item__param-label">ИНН</div>
                                        <div class="cabinet__personal-item__param-value">9834659611</div>
                                        <div class="cabinet__personal-item__param-inputs">
                                            <div class="input-wrapper">
                                                <input type="text" value="9834659611" placeholder="Введите ваш ИНН" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cabinet__personal-item__param-groups hidden">
                                    <div class="cabinet__personal-item__param-group wide">
                                        <div class="cabinet__personal-item__param-label">Имя и фамилия в загранпаспорте (на латинице)</div>
                                        <div class="cabinet__personal-item__param-value">Gregory Gregory</div>
                                        <div class="cabinet__personal-item__param-inputs">
                                            <div class="input-wrapper">
                                                <input type="text" value="Yablochkova" placeholder="Введите фамилию в загранпаспорте">
                                            </div>
                                            <div class="input-wrapper">
                                                <input type="text" value="Valentina" placeholder="Введите имя в загранпаспорте">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="cabinet__personal-item__param-group wide international-passport-group">
                                        <div class="cabinet__personal-item__param-label">Номер загранпаспорта</div>
                                        <div class="cabinet__personal-item__param-value">2359834659611</div>
                                        <div class="cabinet__personal-item__param-inputs">
                                            <div class="input-wrapper">
                                                <input type="text" value="2359834659611" placeholder="Введите номер загранпаспорта">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="cabinet__personal-item__param-group wide">
                                        <div class="cabinet__personal-item__param-label">Серия загранпаспорта </div>
                                        <div class="cabinet__personal-item__param-value">9834659611</div>
                                        <div class="cabinet__personal-item__param-inputs">
                                            <div class="input-wrapper">
                                                <input type="text" value="2359834659611" placeholder="Введите серию загранпаспорта">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- конец добавленные группы -->
                            </div>

                            <!-- поправил кнопку -->
                            <button class="cabinet__personal-item__toggler">
                                            <span>
                                                Показать всю информацию
                                            </span>
                                <span>
                                                Скрыть дополнительную информацию
                                            </span>
                            </button>
                        </div>
                    </div>

                    <div class="cabinet__personal-item">
                        <div class="cabinet__personal-item__head">
                            <div class="cabinet__personal-item__title">Ваш автомобиль</div>
                            <button class="cabinet__personal-item__edit">
                                            <span>
                                                Изменить
                                            </span>
                                <span>
                                                Сохранить изменения
                                            </span>
                            </button>
                        </div>
                        <div class="cabinet__personal-item__body">
                            <div class="cabinet__personal-item__content">
                                <div class="cabinet__personal-item__content-title">Volkswagen</div>
                                <div class="cabinet__personal-item__param-groups">
                                    <div class="cabinet__personal-item__param-group">
                                        <div class="cabinet__personal-item__param-label">Гос. номер</div>
                                        <div class="cabinet__personal-item__param-value">ВН 1015 МХ</div>
                                        <div class="cabinet__personal-item__param-inputs">
                                            <div class="input-wrapper">
                                                <input type="text" value="ВН 1015 МХ" placeholder="Введите гос.номер">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="cabinet__personal-item__param-group">
                                        <div class="cabinet__personal-item__param-label">Объём двигателя</div>
                                        <div class="cabinet__personal-item__param-value">1984 см3</div>
                                        <div class="cabinet__personal-item__param-inputs">
                                            <div class="input-wrapper">
                                                <input type="text" value="1984" placeholder="Введите объём двигателя, куб.см">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="cabinet__personal-item__param-group">
                                        <div class="cabinet__personal-item__param-label">Примерная стоимость</div>
                                        <div class="cabinet__personal-item__param-value">850 000 грн</div>

                                        <div class="cabinet__personal-item__param-inputs">
                                            <div class="input-wrapper">
                                                <input type="text" value="850 000" placeholder="Введите ориентировочную стоимость авто">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="cabinet__personal-item__param-group">
                                        <div class="cabinet__personal-item__param-label">Год выпуска</div>
                                        <div class="cabinet__personal-item__param-value">2016</div>

                                        <div class="cabinet__personal-item__param-inputs">
                                            <div class="input-wrapper">
                                                <input type="text" value="2016" placeholder="Введите год выпуска">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- пока нет обновлений по этим блокам структуру сделал наскидку -->
                                <div class="cabinet__personal-item__param-groups hidden">
                                    <div class="cabinet__personal-item__param-group">
                                        <div class="cabinet__personal-item__param-label">Гос. номер</div>
                                        <div class="cabinet__personal-item__param-value">ВН 1015 МХ</div>
                                        <div class="cabinet__personal-item__param-inputs">
                                            <div class="input-wrapper">
                                                <input type="text" value="ВН 1015 МХ" placeholder="Введите гос.номер">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="cabinet__personal-item__param-group">
                                        <div class="cabinet__personal-item__param-label">Объём двигателя</div>
                                        <div class="cabinet__personal-item__param-value">1984 см3</div>
                                        <div class="cabinet__personal-item__param-inputs">
                                            <div class="input-wrapper">
                                                <input type="text" value="1984" placeholder="Введите объём двигателя, куб.см">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="cabinet__personal-item__param-group wide">
                                        <div class="cabinet__personal-item__param-label">Примерная стоимость</div>
                                        <div class="cabinet__personal-item__param-value">850 000 грн</div>

                                        <div class="cabinet__personal-item__param-inputs">
                                            <div class="input-wrapper">
                                                <input type="text" value="850 000" placeholder="Введите ориентировочную стоимость авто">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="cabinet__personal-item__param-group wide">
                                        <div class="cabinet__personal-item__param-label">Год выпуска</div>
                                        <div class="cabinet__personal-item__param-value">2016</div>

                                        <div class="cabinet__personal-item__param-inputs">
                                            <div class="input-wrapper">
                                                <input type="text" value="2016" placeholder="Введите год выпуска">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cabinet__personal-item__param-groups hidden">
                                    <div class="cabinet__personal-item__param-group wide">
                                        <div class="cabinet__personal-item__param-label">Гос. номер</div>
                                        <div class="cabinet__personal-item__param-value">ВН 1015 МХ</div>
                                        <div class="cabinet__personal-item__param-inputs">
                                            <div class="input-wrapper">
                                                <input type="text" value="ВН 1015 МХ" placeholder="Введите гос.номер">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="cabinet__personal-item__param-group">
                                        <div class="cabinet__personal-item__param-label">Объём двигателя</div>
                                        <div class="cabinet__personal-item__param-value">1984 см3</div>
                                        <div class="cabinet__personal-item__param-inputs">
                                            <div class="input-wrapper">
                                                <input type="text" value="1984" placeholder="Введите объём двигателя, куб.см">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="cabinet__personal-item__param-group">
                                        <div class="cabinet__personal-item__param-label">Примерная стоимость</div>
                                        <div class="cabinet__personal-item__param-value">850 000 грн</div>

                                        <div class="cabinet__personal-item__param-inputs">
                                            <div class="input-wrapper">
                                                <input type="text" value="850 000" placeholder="Введите ориентировочную стоимость авто">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="cabinet__personal-item__param-group wide">
                                        <div class="cabinet__personal-item__param-label">Год выпуска</div>
                                        <div class="cabinet__personal-item__param-value">2016</div>

                                        <div class="cabinet__personal-item__param-inputs">
                                            <div class="input-wrapper">
                                                <input type="text" value="2016" placeholder="Введите год выпуска">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="cabinet__personal-item__toggler">
                                            <span>
                                                Показать всю информацию
                                            </span>
                                <span>
                                                Скрыть дополнительную информацию
                                            </span>
                            </div>
                        </div>
                    </div>

                    <div class="cabinet__personal-create">
                        <button class="cabinet__personal-create__btn cabinet__personal-create__btn--car">
                            Добавить еще один автомобиль
                        </button>
                        <button class="cabinet__personal-create__btn cabinet__personal-create__btn--person">
                            Добавить еще информацию <br>
                            о близком человеке
                        </button>
                        <button class="cabinet__personal-create__btn cabinet__personal-create__btn--estate">
                            Добавить информацию <br>
                            о недвижимости
                        </button>
                    </div>

                    <!-- подложка под активную группу -->
                    <div class="cabinet__personal-overlay"></div>
                </div>
            </div>


        </div>
        <!-- end container -->

    </section>
    <!-- End Cabinet -->



@endsection

@push('custom-scripts')
    <script src="{{ asset('assets/app/js/profile.js') }}"></script>
@endpush
