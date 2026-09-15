<?php
/**
 * Структура страницы «Цены калькулятора ЮР» (dashbord/priceChange.php?calc=ur).
 * Ключи совпадают с `pricecalc_ur.name` и используются калькулятором dashbord/calcUr/mainur.js через get_price.php?calc=ur.
 * Цены — итоговые рубли за единицу (прежний коэффициент 165% уже учтён).
 * Формат групп тот же, что в helpers/priceChangeConfig.php.
 *
 * Разделы с 'hidden' => true — позиции, которые сейчас скрыты в калькуляторе стилями calcUr/index.php
 * (бумага кроме обычной 80 г, копирование со стекла, твёрдый переплёт, «Прочее» (c), «Дизайн», «Багетка»).
 */

require_once __DIR__ . '/priceChangeHelpers.php';

$urTiersScan = [0, 10, 50, 100, 500];
$urTiersLam = [0, 10, 50];
$urHiddenNote = 'Скрыто в калькуляторе';

$urSizes = ['A2' => 'А2', 'A1' => 'А1', 'A0' => 'А0', 'ns' => 'Нестандарт, м²'];

$urRows = function (array $sizes, array $suffixes, $prefix) {
    $rows = [];
    foreach ($sizes as $code => $label) {
        $keys = [];
        foreach ($suffixes as $suffix) {
            $keys[] = "{$prefix}_{$code}_{$suffix}";
        }
        $rows[] = [$label, $keys];
    }
    return $rows;
};

$urBaget = function ($prefix) {
    $rows = [];
    foreach (['5' => 'Толщина 5 мм', '10' => 'Толщина 10 мм'] as $mm => $label) {
        $keys = [];
        foreach (['A4', 'A3', 'A2', 'A1', 'A0', 'm2'] as $size) {
            $keys[] = "{$prefix}_{$mm}_{$size}";
        }
        $rows[] = [$label, $keys];
    }
    return $rows;
};

return [
    [
        'id' => 'print',
        'title' => 'Печать',
        'icon' => 'bx-printer',
        'groups' => [
            [
                'title' => 'Цветная A4 / A3, обычная 80 г',
                'note' => 'Цена за лист',
                'type' => 'matrix',
                'cols' => ['Односторонняя', 'Двусторонняя'],
                'rows' => [
                    ['A4', ['petchat_chet_A4_odn', 'petchat_chet_A4_dvx']],
                    ['A3', ['petchat_chet_A3_odn', 'petchat_chet_A3_dvx']],
                ],
            ],
            [
                'title' => 'Черно-белая A4 / A3, обычная 80 г',
                'note' => 'Цена за лист',
                'type' => 'matrix',
                'cols' => ['Односторонняя', 'Двусторонняя'],
                'rows' => [
                    ['A4', ['petchat_bw_A4_odn', 'petchat_bw_A4_dvx']],
                    ['A3', ['petchat_bw_A3_odn', 'petchat_bw_A3_dvx']],
                ],
            ],
            [
                'title' => 'Цветная A2 – A0, обычная 80 г',
                'note' => 'Цена за лист',
                'type' => 'matrix',
                'cols' => ['Заливка до 20%', 'Заливка более 20%'],
                'rows' => $urRows($urSizes, ['z0', 'z20'], 'petchat_chet'),
            ],
            [
                'title' => 'Черно-белая A2 – A0',
                'note' => 'Цена за лист',
                'type' => 'matrix',
                'cols' => ['Обычная 80 г', 'Калька 90 г'],
                'rows' => $urRows($urSizes, ['80', '90'], 'petchat_bw'),
            ],
            [
                'title' => 'Цветная широкоформатная',
                'note' => 'Цена за лист',
                'type' => 'matrix',
                'cols' => ['Матовая 180 г', 'Глянец HP', 'Калька 90 г', 'Самоклейка', 'Холст 320 г'],
                'rows' => $urRows($urSizes, ['mat', 'gl', 'kalka', 'samokl', 'xolst'], 'petchat_chet'),
            ],
        ],
    ],
    [
        'id' => 'pereplet',
        'title' => 'Переплёт',
        'icon' => 'bx-book-bookmark',
        'groups' => [
            [
                'title' => 'Пластиковая пружина',
                'note' => 'Новый переплёт',
                'type' => 'matrix',
                'cols' => ['Малая, до 100 л', 'Средняя, 100–240 л', 'Большая, 240–480 л'],
                'rows' => [
                    ['A4', ['pereplet_pl_A4_m', 'pereplet_pl_A4_s', 'pereplet_pl_A4_b']],
                    ['A3', ['pereplet_pl_A3_m', 'pereplet_pl_A3_s', 'pereplet_pl_A3_b']],
                ],
            ],
            [
                'title' => 'Дополнительно',
                'type' => 'list',
                'items' => [
                    ['pereplet_pl_per', 'Переброшюровка пластиковой пружиной'],
                    ['pereplet_mt', 'Переплёт металлической пружиной'],
                    ['pereplet_vs_k', 'Вставка конверта для CD'],
                    ['pereplet_vs_f', 'Вставка файла в переплёт'],
                ],
            ],
        ],
    ],
    [
        'id' => 'prochee',
        'title' => 'Прочее',
        'icon' => 'bx-cut',
        'groups' => [
            [
                'title' => 'Фальцовка',
                'note' => 'Цена за лист',
                'type' => 'matrix',
                'cols' => ['А4', 'А3', 'А2', 'А1', 'А0'],
                'rows' => [
                    ['Фальцовка', ['falc_A4', 'falc_A3', 'falc_A2', 'falc_A1', 'falc_A0']],
                ],
            ],
            [
                'title' => 'Сканирование (цветное)',
                'note' => 'Цена за лист',
                'type' => 'matrix',
                'cols' => ['А2', 'А1', 'А0'],
                'rows' => [
                    ['Цветное сканирование', ['scan_color_A2', 'scan_color_A1', 'scan_color_A0']],
                ],
            ],
            [
                'title' => 'Сканирование',
                'note' => 'Цена за лист по количеству',
                'type' => 'matrix',
                'colsTitle' => 'Тираж, шт →',
                'cols' => priceTierCols($urTiersScan),
                'rows' => [
                    priceTierRow('A4 автоскан', 'prochee_scan_{t}_A4_av', $urTiersScan),
                    priceTierRow('A4 со стекла', 'prochee_scan_{t}_A4_r', $urTiersScan),
                    priceTierRow('A3 автоскан', 'prochee_scan_{t}_A3_av', $urTiersScan),
                    priceTierRow('A3 со стекла', 'prochee_scan_{t}_A3_r', $urTiersScan),
                    priceTierRow('A2', 'prochee_scan_{t}_A2', $urTiersScan),
                    priceTierRow('A1', 'prochee_scan_{t}_A1', $urTiersScan),
                    priceTierRow('A0', 'prochee_scan_{t}_A0', $urTiersScan),
                ],
            ],
        ],
    ],
    [
        'id' => 'hidden_print',
        'title' => 'Скрыто: печать, переплёт',
        'icon' => 'bx-hide',
        'hidden' => true,
        'groups' => [
            [
                'title' => 'Доплата за бумагу A4',
                'note' => $urHiddenNote . ' · прибавляется к цене листа 80 г',
                'type' => 'list',
                'items' => [
                    ['petchat_A4_mt120', 'Матовая 120 г'],
                    ['petchat_A4_mt160', 'Матовая 160 г'],
                    ['petchat_A4_mt200', 'Матовая 200 г'],
                    ['petchat_A4_mt250', 'Матовая 250 г'],
                    ['petchat_A4_mt300', 'Матовая 300 г'],
                    ['petchat_A4_gl170', 'Глянец 170 г'],
                    ['petchat_A4_gl250', 'Глянец 250 г'],
                    ['petchat_A4_klk250', 'Калька 250 г'],
                    ['petchat_A4_sk', 'Самоклейка (сейчас не используется)'],
                ],
            ],
            [
                'title' => 'Доплата за бумагу A3',
                'note' => $urHiddenNote . ' · прибавляется к цене листа 80 г',
                'type' => 'list',
                'items' => [
                    ['petchat_A3_mt160', 'Матовая 160 г'],
                    ['petchat_A3_mt200', 'Матовая 200 г'],
                    ['petchat_A3_mt250', 'Матовая 250 г'],
                    ['petchat_A3_mt280', 'Матовая 280 г'],
                    ['petchat_A3_gl170', 'Глянец 170 г'],
                    ['petchat_A3_gl250', 'Глянец 250 г'],
                    ['petchat_A3_klk250', 'Калька 250 г'],
                ],
            ],
            [
                'title' => 'Копирование со стекла',
                'note' => $urHiddenNote,
                'type' => 'list',
                'items' => [
                    ['petchat_copy_glass', 'Наценка к цене печати', 'лист'],
                ],
            ],
            [
                'title' => 'Твёрдый переплёт',
                'note' => $urHiddenNote . ' · переброшюровка = половина цены',
                'type' => 'list',
                'items' => [
                    ['pereplet_tv_5', 'Корешок 5–7 мм'],
                    ['pereplet_tv_10', 'Корешок 10–13 мм'],
                    ['pereplet_tv_16', 'Корешок 16–20 мм'],
                    ['pereplet_tv_24', 'Корешок 24–32 мм'],
                ],
            ],
        ],
    ],
    [
        'id' => 'hidden_prochee',
        'title' => 'Скрыто: услуги',
        'icon' => 'bx-hide',
        'hidden' => true,
        'groups' => [
            [
                'title' => 'Услуги',
                'note' => $urHiddenNote,
                'type' => 'list',
                'items' => [
                    ['prochee_r', 'Резка'],
                    ['prochee_rr', 'Ручная резка'],
                    ['prochee_opf', 'Отправка / приём файлов через интернет'],
                    ['prochee_rk', 'Работа на компьютере', 'мин.'],
                    ['prochee_nt', 'Набор текста', 'стр. А4'],
                    ['prochee_df', 'Доработка файлов клиента', 'мин.'],
                    ['prochee_dc', 'Запись на CD/DVD, диск клиента'],
                    ['prochee_dk', 'Запись на CD/DVD, диск компании'],
                    ['prochee_shiv', 'Сшивание / расшивание'],
                    ['prochee_perfor', 'Перфорация листов'],
                    ['prochee_stepler', 'Степлер'],
                    ['prochee_bigovka', 'Биговка'],
                    ['prochee_tisn', 'Тиснение'],
                    ['prochee_dost', 'Доставка'],
                    ['prochee_ps', 'Папка-скоросшиватель'],
                    ['prochee_A4', 'Файл A4'],
                    ['prochee_A3', 'Файл A3'],
                ],
            ],
            [
                'title' => 'Ламинирование',
                'note' => $urHiddenNote . ' · цена за лист по количеству',
                'type' => 'matrix',
                'colsTitle' => 'Тираж, шт →',
                'cols' => priceTierCols($urTiersLam),
                'rows' => [
                    priceTierRow('Глянцевое A6', 'prochee_lam_{t}_A6_g', $urTiersLam),
                    priceTierRow('Глянцевое A5', 'prochee_lam_{t}_A5_g', $urTiersLam),
                    priceTierRow('Глянцевое A4', 'prochee_lam_{t}_A4_g', $urTiersLam),
                    priceTierRow('Глянцевое A3', 'prochee_lam_{t}_A3_g', $urTiersLam),
                    priceTierRow('Матовое A6', 'prochee_lam_{t}_A6_m', $urTiersLam),
                    priceTierRow('Матовое A5', 'prochee_lam_{t}_A5_m', $urTiersLam),
                    priceTierRow('Матовое A4', 'prochee_lam_{t}_A4_m', $urTiersLam),
                    priceTierRow('Матовое A3', 'prochee_lam_{t}_A3_m', $urTiersLam),
                ],
            ],
            [
                'title' => 'Фальцовка (старый раздел)',
                'note' => $urHiddenNote . ' · цена за лист по количеству',
                'type' => 'matrix',
                'colsTitle' => 'Тираж, шт →',
                'cols' => priceTierCols([0, 100]),
                'rows' => [
                    priceTierRow('Фальцовка', 'prochee_falc_{t}', [0, 100]),
                ],
            ],
            [
                'title' => 'Распознавание текста',
                'note' => $urHiddenNote . ' · цена за страницу по количеству',
                'type' => 'matrix',
                'colsTitle' => 'Страниц →',
                'cols' => priceTierCols([0, 50, 100]),
                'rows' => [
                    priceTierRow('Распознавание', 'prochee_ocr_{t}', [0, 50, 100]),
                ],
            ],
        ],
    ],
    [
        'id' => 'hidden_dizain',
        'title' => 'Скрыто: дизайн, багетка',
        'icon' => 'bx-hide',
        'hidden' => true,
        'groups' => [
            [
                'title' => 'Услуги дизайнера',
                'note' => $urHiddenNote,
                'type' => 'list',
                'items' => [
                    ['dis_one_ysl', 'Услуги дизайнера', 'мин.'],
                    ['dis_one_vv', 'Вёрстка визитки'],
                    ['dis_fd', 'Фото на документы'],
                    ['dis_one_fr', 'Фоторетушь', 'час'],
                    ['dis_one_vm', 'Вёрстка макета', 'час'],
                    ['dis_one_rl', 'Разработка логотипа'],
                ],
            ],
            [
                'title' => 'Печать визиток',
                'note' => $urHiddenNote,
                'type' => 'matrix',
                'cols' => ['1 сторона', '2 стороны'],
                'rows' => [
                    ['Черно-белая', ['dis_viz_1s_bw', 'dis_viz_2s_bw']],
                    ['Цветная', ['dis_viz_1s_c', 'dis_viz_2s_c']],
                ],
            ],
            [
                'title' => 'Дизайнерская бумага',
                'note' => $urHiddenNote,
                'type' => 'list',
                'items' => [
                    ['dis_db_db', 'Дизайнерская бумага'],
                    ['dis_db_tc', 'Touche Cover'],
                ],
            ],
            [
                'title' => 'Печати и штампы',
                'note' => $urHiddenNote,
                'type' => 'list',
                'items' => [
                    ['dis_pet_kp', 'Круглая печать, штамп или факсимиле'],
                    ['dis_pet_hm', 'Маленький штамп (1–2 слова)'],
                    ['dis_pet_ott', 'Печать или штамп по оттиску'],
                    ['dis_pet_iks', 'Личная печать, экслибрис'],
                ],
            ],
            [
                'title' => 'Оснастки',
                'note' => $urHiddenNote,
                'type' => 'list',
                'items' => [
                    ['dis_osn_gbr', 'Автоматическая оснастка GBR'],
                    ['dis_osn_pr', 'Простая оснастка'],
                    ['dis_osn_karm', 'Карманная печать'],
                    ['dis_osn_avto_m', 'Автоматическая оснастка для маленьких штампов'],
                    ['dis_osn_avto_b', 'Автоматическая оснастка для больших штампов'],
                ],
            ],
            [
                'title' => 'Штемпельные подушки и краска',
                'note' => $urHiddenNote,
                'type' => 'list',
                'items' => [
                    ['dis_krask_1', 'Подушка 2 pads 50×90'],
                    ['dis_krask_2', 'Подушка 2 pads 70×110'],
                    ['dis_krask_3', 'Подушка 50×90'],
                    ['dis_krask_4', 'Подушка 70×110'],
                    ['dis_krask_5', 'Краска'],
                ],
            ],
            [
                'title' => 'Накатка на пенокартон',
                'note' => $urHiddenNote,
                'type' => 'matrix',
                'cols' => ['А4', 'А3', 'А2', 'А1', 'А0', '1 кв. м'],
                'rows' => $urBaget('baget_nak'),
            ],
            [
                'title' => 'Накатка на пенокартон для студентов',
                'note' => $urHiddenNote,
                'type' => 'matrix',
                'cols' => ['А4', 'А3', 'А2', 'А1', 'А0', '1 кв. м'],
                'rows' => $urBaget('baget_nak_st'),
            ],
        ],
    ],
];
