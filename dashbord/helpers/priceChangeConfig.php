<?php
/**
 * Структура страницы «Изменение цен калькулятора» (dashbord/priceChange.php).
 * Ключи совпадают с `pricecalc.name` и используются калькулятором через get_price.php.
 * Калькулятор ЮР: helpers/priceChangeConfigUr.php (таблица pricecalc_ur).
 *
 * Типы групп:
 *  - list   — список позиций: [ключ, название, единица?]
 *  - matrix — таблица: строки × колонки, в ячейке ключ или null (позиции нет)
 */

require_once __DIR__ . '/priceChangeHelpers.php';

$tiersA4A3 = [0, 10, 50, 100, 250, 500, 1000, 10000];
$tiersBig = [0, 10, 100, 1000];
$tiersBwBig = [0, 50, 200, 500];
$tiersScan = [0, 10, 50, 100, 500];
$tiersLam = [0, 10, 50];
$vizQty = [100, 200, 300, 500, 1000];

$wideFormat = function ($kind, $suffixMat, $withFilm = false) {
    $rows = [];
    foreach (['A2' => 'А2', 'A1' => 'А1', 'A0' => 'А0', 'ns' => 'Нестандартная'] as $code => $label) {
        $cells = [
            "petchat_{$kind}_{$code}_{$suffixMat}",
            "petchat_{$kind}_{$code}_gl",
            $code === 'A0' ? null : "petchat_{$kind}_{$code}_kalka",
        ];
        if ($withFilm) {
            $cells[] = "petchat_{$kind}_{$code}_samokl";
            $cells[] = "petchat_{$kind}_{$code}_xolst";
        }
        $rows[] = [$label, $cells];
    }
    return $rows;
};

$vizRow = function ($label, $sides, $urgency) use ($vizQty) {
    return [$label, array_map(function ($q) use ($sides, $urgency) {
        return "dis_viz_{$sides}_{$urgency}_{$q}";
    }, $vizQty)];
};

return [
    [
        'id' => 'print',
        'title' => 'Печать',
        'icon' => 'bx-printer',
        'groups' => [
            [
                'title' => 'Цветная A4 / A3',
                'note' => 'Цена за лист по тиражу',
                'type' => 'matrix',
                'colsTitle' => 'Тираж, шт →',
                'cols' => priceTierCols($tiersA4A3),
                'rows' => [
                    priceTierRow('A4 односторонняя', 'petchat_chet_A4_{t}_odn', $tiersA4A3),
                    priceTierRow('A4 двусторонняя', 'petchat_chet_A4_{t}_dvx', $tiersA4A3),
                    priceTierRow('A3 односторонняя', 'petchat_chet_A3_{t}_odn', $tiersA4A3),
                    priceTierRow('A3 двусторонняя', 'petchat_chet_A3_{t}_dvx', $tiersA4A3),
                ],
            ],
            [
                'title' => 'Цветная A2 – A0, обычная бумага',
                'note' => 'Цена за лист по тиражу',
                'type' => 'matrix',
                'colsTitle' => 'Тираж, шт →',
                'cols' => priceTierCols($tiersBig),
                'rows' => [
                    priceTierRow('A2, заливка до 20%', 'petchat_chet_A2_{t}_z0', $tiersBig),
                    priceTierRow('A2, заливка более 20%', 'petchat_chet_A2_{t}_z20', $tiersBig),
                    priceTierRow('A1, заливка до 20%', 'petchat_chet_A1_{t}_z0', $tiersBig),
                    priceTierRow('A1, заливка более 20%', 'petchat_chet_A1_{t}_z20', $tiersBig),
                    priceTierRow('A0, заливка до 20%', 'petchat_chet_A0_{t}_z0', $tiersBig),
                    priceTierRow('A0, заливка более 20%', 'petchat_chet_A0_{t}_z20', $tiersBig),
                    priceTierRow('Нестандарт, заливка до 20%', 'petchat_chet_ns_{t}_z0', $tiersBig),
                    priceTierRow('Нестандарт, заливка более 20%', 'petchat_chet_ns_{t}_z20', $tiersBig),
                ],
            ],
            [
                'title' => 'Цветная широкоформатная',
                'type' => 'matrix',
                'cols' => ['Матовая 180 г', 'Глянец HP', 'Калька 90 г', 'Самоклейка', 'Холст 320 г'],
                'rows' => $wideFormat('chet', 'mat', true),
            ],
            [
                'title' => 'Черно-белая A4 / A3',
                'note' => 'Цена за лист по тиражу',
                'type' => 'matrix',
                'colsTitle' => 'Тираж, шт →',
                'cols' => priceTierCols($tiersA4A3),
                'rows' => [
                    priceTierRow('A4 односторонняя', 'petchat_bw_A4_{t}_odn', $tiersA4A3),
                    priceTierRow('A4 двусторонняя', 'petchat_bw_A4_{t}_dvx', $tiersA4A3),
                    priceTierRow('A3 односторонняя', 'petchat_bw_A3_{t}_odn', $tiersA4A3),
                    priceTierRow('A3 двусторонняя', 'petchat_bw_A3_{t}_dvx', $tiersA4A3),
                ],
            ],
            [
                'title' => 'Черно-белая A2 – A0, обычная 80 г',
                'note' => 'Цена за лист по тиражу',
                'type' => 'matrix',
                'colsTitle' => 'Тираж, шт →',
                'cols' => priceTierCols($tiersBwBig),
                'rows' => [
                    priceTierRow('A2', 'petchat_bw_A2_{t}_80', $tiersBwBig),
                    priceTierRow('A1', 'petchat_bw_A1_{t}_80', $tiersBwBig),
                    priceTierRow('A0', 'petchat_bw_A0_{t}_80', $tiersBwBig),
                    priceTierRow('Нестандарт', 'petchat_bw_ns_{t}_80', $tiersBwBig),
                ],
            ],
            [
                'title' => 'Черно-белая широкоформатная',
                'type' => 'matrix',
                'cols' => ['Матовая 180 г', 'Глянец HP', 'Калька 90 г'],
                'rows' => $wideFormat('bw', 'mat_180'),
            ],
            [
                'title' => 'Самоклейка A4 / A3',
                'note' => 'Цена за лист, тираж не влияет',
                'type' => 'matrix',
                'cols' => ['A4', 'A3'],
                'rows' => [
                    ['Цветная печать', ['petchat_chet_A4_sk', 'petchat_chet_A3_sk']],
                    ['Черно-белая печать', ['petchat_bw_A4_sk', 'petchat_bw_A3_sk']],
                ],
            ],
            [
                'title' => 'Доплата за плотную бумагу',
                'note' => 'Прибавляется к цене листа на обычной 80 г',
                'type' => 'matrix',
                'cols' => ['Матовая 170 г', 'Матовая 300 г'],
                'rows' => [
                    ['A4', ['petchat_A4_mt160', 'petchat_A4_mt300']],
                    ['A3', ['petchat_A3_mt160', 'petchat_A3_mt280']],
                ],
            ],
        ],
    ],
    [
        'id' => 'pereplet',
        'title' => 'Переплёт',
        'icon' => 'bx-book-bookmark',
        'groups' => [
            [
                'title' => 'Пружина',
                'note' => 'Размер пружины',
                'type' => 'matrix',
                'cols' => ['Малая', 'Средняя', 'Большая'],
                'rows' => [
                    ['Пластиковая A4', ['pereplet_pl_A4_m', 'pereplet_pl_A4_s', 'pereplet_pl_A4_b']],
                    ['Пластиковая A3', ['pereplet_pl_A3_m', 'pereplet_pl_A3_s', 'pereplet_pl_A3_b']],
                    ['Металлическая A4', ['pereplet_mt_A4_m', 'pereplet_mt_A4_s', 'pereplet_mt_A4_b']],
                    ['Металлическая A3', ['pereplet_mt_A3_m', 'pereplet_mt_A3_s', 'pereplet_mt_A3_b']],
                ],
            ],
            [
                'title' => 'Твёрдый переплёт',
                'type' => 'list',
                'items' => [
                    ['pereplet_tv_5', 'Твёрдый 5–7'],
                    ['pereplet_tv_10', 'Твёрдый 10–13'],
                    ['pereplet_tv_16', 'Твёрдый 16–20'],
                ],
            ],
            [
                'title' => 'Дополнительно',
                'type' => 'list',
                'items' => [
                    ['pereplet_vs_k', 'Вставка конверта'],
                    ['pereplet_vs_f', 'Вставка файла'],
                    ['pereplet_pl_per', 'Пластиковая переброшюровка'],
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
                'title' => 'Услуги',
                'type' => 'list',
                'items' => [
                    ['prochee_r', 'Резка'],
                    ['prochee_rr', 'Ручная резка'],
                    ['prochee_opf', 'Отправка / приём файлов'],
                    ['prochee_rk', 'Работа на компьютере'],
                    ['prochee_nt', 'Набор текста'],
                    ['prochee_df', 'Доработка файлов'],
                    ['prochee_dc', 'Запись на диск клиента'],
                    ['prochee_dk', 'Диск компании'],
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
                'title' => 'Сканирование',
                'note' => 'Цена за лист по количеству',
                'type' => 'matrix',
                'colsTitle' => 'Тираж, шт →',
                'cols' => priceTierCols($tiersScan),
                'rows' => [
                    priceTierRow('A4 автоподача', 'prochee_scan_{t}_A4_av', $tiersScan),
                    priceTierRow('A4 вручную', 'prochee_scan_{t}_A4_r', $tiersScan),
                    priceTierRow('A3 автоподача', 'prochee_scan_{t}_A3_av', $tiersScan),
                    priceTierRow('A3 вручную', 'prochee_scan_{t}_A3_r', $tiersScan),
                    priceTierRow('A2', 'prochee_scan_{t}_A2', $tiersScan),
                    priceTierRow('A1', 'prochee_scan_{t}_A1', $tiersScan),
                    priceTierRow('A0', 'prochee_scan_{t}_A0', $tiersScan),
                ],
            ],
            [
                'title' => 'Ламинирование',
                'note' => 'Цена за лист по количеству',
                'type' => 'matrix',
                'colsTitle' => 'Тираж, шт →',
                'cols' => priceTierCols($tiersLam),
                'rows' => [
                    priceTierRow('Глянцевое A6', 'prochee_lam_{t}_A6_g', $tiersLam),
                    priceTierRow('Глянцевое A5', 'prochee_lam_{t}_A5_g', $tiersLam),
                    priceTierRow('Глянцевое A4', 'prochee_lam_{t}_A4_g', $tiersLam),
                    priceTierRow('Глянцевое A3', 'prochee_lam_{t}_A3_g', $tiersLam),
                    priceTierRow('Матовое A6', 'prochee_lam_{t}_A6_m', $tiersLam),
                    priceTierRow('Матовое A5', 'prochee_lam_{t}_A5_m', $tiersLam),
                    priceTierRow('Матовое A4', 'prochee_lam_{t}_A4_m', $tiersLam),
                    priceTierRow('Матовое A3', 'prochee_lam_{t}_A3_m', $tiersLam),
                ],
            ],
        ],
    ],
    [
        'id' => 'dizain',
        'title' => 'Дизайн',
        'icon' => 'bx-palette',
        'groups' => [
            [
                'title' => 'Услуги дизайнера',
                'type' => 'list',
                'items' => [
                    ['dis_one_ysl', 'Услуги дизайнера', 'мин.'],
                    ['dis_one_vv', 'Вёрстка визитки'],
                    ['dis_one_fr', 'Фоторетушь', 'час'],
                    ['dis_one_vm', 'Вёрстка макета', 'час'],
                    ['dis_one_rl', 'Разработка логотипа'],
                ],
            ],
            [
                'title' => 'Печать визиток',
                'note' => 'Цена за тираж, шт',
                'type' => 'matrix',
                'colsTitle' => 'Тираж, шт →',
                'cols' => array_map('strval', $vizQty),
                'rows' => [
                    $vizRow('1 сторона, не срочно', '1s', 'n'),
                    $vizRow('1 сторона, срочно', '1s', 's'),
                    $vizRow('2 стороны, не срочно', '2s', 'n'),
                    $vizRow('2 стороны, срочно', '2s', 's'),
                ],
            ],
            [
                'title' => 'Печать фото',
                'type' => 'list',
                'items' => [
                    ['dis_foto_10x15', 'Фото 10×15'],
                    ['dis_foto_15x20', 'Фото 15×20'],
                    ['dis_foto_20x30', 'Фото 20×30'],
                    ['dis_foto_30x40', 'Фото 30×40'],
                ],
            ],
            [
                'title' => 'Фото на документы',
                'type' => 'list',
                'items' => [
                    ['dis_fd_1', 'Комплект фото / эл. файл'],
                    ['dis_fd_2', 'Комплект фото + эл. файл'],
                    ['dis_fd_3', 'Комплект фото + костюм'],
                    ['dis_fd_4', 'Комплект фото + костюм + эл. файл'],
                    ['dis_fd_5', 'Дополнительный комплект'],
                ],
            ],
            [
                'title' => 'Дизайнерская бумага',
                'type' => 'list',
                'items' => [
                    ['dis_db_db', 'Дизайнерская бумага'],
                    ['dis_db_tc', 'Touche Cover'],
                    ['dis_db_vl', 'Verona лён'],
                    ['dis_db_m', 'Majestic'],
                ],
            ],
            [
                'title' => 'Печати и штампы',
                'type' => 'list',
                'items' => [
                    ['dis_pet_kp', 'Круглая печать'],
                    ['dis_pet_hm', 'Штамп малый'],
                    ['dis_pet_hs', 'Штамп средний'],
                    ['dis_pet_hb', 'Штамп большой'],
                    ['dis_pet_fa', 'Факсимиле'],
                    ['dis_pet_iks', 'Экслибрис'],
                    ['dis_pet_otp', 'Отрисовка печати'],
                ],
            ],
            [
                'title' => 'Оснастки',
                'type' => 'list',
                'items' => [
                    ['dis_osn_1', 'Автоматическая оснастка Ø 30/40/42'],
                    ['dis_osn_2', 'Простая оснастка'],
                    ['dis_osn_3', 'Автоштамп малый'],
                    ['dis_osn_4', 'Автоштамп средний'],
                    ['dis_osn_5', 'Автоштамп большой'],
                    ['dis_osn_6', 'Простая оснастка для штампа'],
                ],
            ],
            [
                'title' => 'Штемпельные подушки и краска',
                'type' => 'list',
                'items' => [
                    ['dis_krask_1', 'Подушка 2 pads 50×90'],
                    ['dis_krask_2', 'Подушка 2 pads 70×110'],
                    ['dis_krask_3', 'Подушка 50×90'],
                    ['dis_krask_4', 'Подушка 70×110'],
                    ['dis_krask_5', 'Краска'],
                ],
            ],
        ],
    ],
];
