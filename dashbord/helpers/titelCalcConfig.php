<?php
/**
 * Настройки страницы «Названия позиций калькулятора» (dashbord/titelPriceChange.php)
 * и её эндпоинта сохранения (dashbord/updateTitelPrice.php).
 *
 * Ключ калькулятора приходит в параметре ?calc= / POST calc и работает как белый список:
 * имя таблицы берётся только отсюда, никогда из запроса.
 *
 *  table          — таблица названий (столбцы id, name, titel)
 *  label          — подпись калькулятора
 *  script         — JS калькулятора (путь от dashbord/): по нему видно, какие ключи реально читаются
 *                   через titelBD['…'] или T('…', …); если файла нет или ключей в нём нет — проверка отключается
 *  hiddenSections — разделы, скрытые в калькуляторе целиком (код сохранён)
 *  hidden         — узлы скрытых веток кода: регулярка по id → пометка
 */

if (!function_exists('titelCalcKey')) {
    /** Разделы дерева: первая буква id. Всё остальное попадает в «Прочие ключи». */
    function titelCalcSections()
    {
        return [
            'a' => ['title' => 'Печать', 'icon' => 'bx-printer'],
            'b' => ['title' => 'Переплёт', 'icon' => 'bx-book-bookmark'],
            'c' => ['title' => 'Прочее', 'icon' => 'bx-cut'],
            'd' => ['title' => 'Дизайн', 'icon' => 'bx-palette'],
            'e' => ['title' => 'Багетка', 'icon' => 'bx-image'],
        ];
    }

    /** Нормализует ключ калькулятора; неизвестный → первый в списке (ФИЗ). */
    function titelCalcKey(array $configs, $key)
    {
        $key = is_string($key) ? $key : '';
        if (isset($configs[$key])) {
            return $key;
        }
        reset($configs);
        return key($configs);
    }

    /** id, которые калькулятор читает: titelBD['id'] (ФИЗ) или T('id', …) (ЮР). null — узнать не удалось. */
    function titelCalcScriptIds($file)
    {
        if (!$file || !is_readable($file)) {
            return null;
        }
        $source = file_get_contents($file);
        if ($source === false || !preg_match_all('/(?:titelBD\[|\bT\()\s*[\'"]([^\'"\s\]]+)[\'"]/u', $source, $m)) {
            return null;
        }
        return array_flip($m[1]);
    }

    /** Символы id по одному (в id бывает кириллица, поэтому не байты). */
    function titelCalcChars($id)
    {
        $chars = preg_split('//u', (string)$id, -1, PREG_SPLIT_NO_EMPTY);
        return is_array($chars) ? $chars : str_split((string)$id);
    }

    /** Пометка скрытой ветки для id или null. */
    function titelCalcHiddenNote($id, array $rules)
    {
        foreach ($rules as $rule) {
            if (preg_match($rule['pattern'], $id)) {
                return $rule['note'];
            }
        }
        return null;
    }

    /** Название пригодно для сохранения: getTitelPrice.php склеивает JSON строками без экранирования. */
    function titelCalcValidTitle($value)
    {
        return is_string($value)
            && preg_match('/^.{0,1000}$/su', $value) === 1
            && preg_match('/["\\\\<>\x00-\x1F\x7F]/', $value) === 0;
    }
}

return [
    'fiz' => [
        'table' => 'titel_calc',
        'label' => 'Калькулятор ФИЗ',
        'script' => 'calc/main.js',
        'hiddenSections' => ['e'],
        'hidden' => [
            // Старое дерево визиток живёт в main.js под ключом dc_hidden:
            // варианты бумаги dcac/dcad/dcbc/dcbd и уровни «заливка» → «тираж».
            ['pattern' => '/^dc[ab][cd]/', 'note' => 'старые визитки'],
            ['pattern' => '/^dc[a-z]{4,}$/', 'note' => 'старые визитки'],
        ],
    ],
    'ur' => [
        'table' => 'titel_calc_ur',
        'label' => 'Калькулятор ЮР',
        'script' => 'calcUr/mainur.js',
        'hiddenSections' => [],
        'hidden' => [],
    ],
];
