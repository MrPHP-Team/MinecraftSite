<?php return [
/**
 * Конфигурационный файл
 *
 * CoreProtect Lookup Web Конфигурация интерфейса
 * @since 1.0.0
 */

########################
# Настройка аккаунта
# Доступны только две учетные записи: администратор и пользователь.
# Массив выглядит следующим образом: [ username, password ]

# Учетная запись администратора может управлять конфигурацией из Интернета.
# установить пароль для доступа администратора (на данный момент специальных разрешений нет).
'administrator' => ['Administrator', 'Пароль_Администратора'],

# Учетная запись пользователя для доступа к поиску.
# установить пароль для входа в систему для использования поиска.
'user' => ['User', 'Пароль_пользователя'],


################################
# База данных / Конфигурация сервера
# Если у вас есть несколько баз данных, настройте каждый источник базы данных здесь
# копирование массива 'server' прямо под и переименование 'server' в другое
# название сервера.
#   type         = 'mysql' or 'sqlite' в Нижнем регистре
#   path         = SQLite путь к CoreProtect database.db
#   host         = MySQL database host[:port]
#   database     = MySQL название базы данных
#   username     = MySQL пользователь
#   password     = MySQL пароль
#   flags        = MySQL флаги ставить в конце URI соединения
#                  (не меняйте, если вам не нужно)
#   prefix       = CoreProtect prefix
#   preBlockName = Добавлять ли "minecraft:" для имени материала, если нет двоеточия (:)
#                  (Может потребоваться отключить для баз данных с данными из MC 1.7)
#   mapLink      = Ссылка для просмотра на карте. (Dynmap, Overviewer и т. д.)
#                  {world} для мира; {x} {y} {z} для координат XYZ
'database' => [
    'server' => [
        'type'        => 'mysql',
        'path'        => 'path/to/database.db',
        'host'        => 'localhost:3306',
        'database'    => 'minecraft',
        'username'    => 'username',
        'password'    => 'password',
        'flags'       => '',
        'prefix'      => 'co_',
        'preBlockName'=> true,
        'mapLink'     => 'https://localhost:8123/?worldname={world}&mapname=surface&zoom=3&x={x}&y={y}&z={z}'
    ],
],

########################
# Конфигурация сайта

# Конфигурация формы
#   limit           = ограничение поискового запроса по умолчанию
#   moreLimit       = лимит запроса "Загрузить больше" по умолчанию
#   max             = максимальный лимит для одного запроса
#   pageInterval    = на сколько записей делить нумерацию страниц
#   timeDivider     = сколько записей в таблице отображается до появления интервала
#   locale          = Данные для перевода (скоро будет локаль сайта?....)
#   dateTimeFormat  = Формат даты(Смотрите https://momentjs.com/docs/#/parsing/string-format/)
#                     (попробуй 'YYYY.MM.DD hh:mm:ss a')
'form' => [
    'count'         => 30,
    'moreCount'     => 10,
    'max'           => 300,
    'pageInterval'  => 25,
    'timeDivider'   => 300,
    'dateTimeFormat'=> 'LL LTS'
],

# Название веб-страницы и конфигурация стиля
#   bootstrap = Ссылка на образец начальной загрузки, локальный или из CDN.
#               Если из CDN, рекомендуется использовать HTML <link> с
#               'integrity' и 'crossorigin' рекомендуется!
#               (Вы можете получить ссылку на тему из:)
#               https://www.bootstrapcdn.com/bootswatch/
#   darkInput = если 'true' тема начальной загрузки будет темная
#               (Влияет только на цвет полей ввода)
#   name      = Название страницы
#   href      = ссылка, по которой ведет название страницы
'page' => [
    'bootstrap' => '<link href="https://stackpath.bootstrapcdn.com/bootswatch/4.4.1/slate/bootstrap.min.css" rel="stylesheet" integrity="sha384-G9YbB4o4U6WS4wCthMOpAeweY4gQJyyx0P3nZbEBHyz+AtNoeasfRChmek1C2iqV" crossorigin="anonymous">',
    'darkInput' => true,
    'name'      => 'Веб-интерфейс поиска CoreProtect',
    'href'      => '/',
    'copyright' => 'Удивительный сервер, 2020'
],

# Настройка панели навигации
# добавить больше ссылок, чтобы они появились в панели навигации.
'navbar' => [
    'Главная' => 'index.php',
    'SpigotRU' => 'https://spigotmc.ru/',
    #'Бан-Лист' => '/banmanager/',
    #'Онлайн Карта' => 'http://127.0.0.1:8123/',
]
];
