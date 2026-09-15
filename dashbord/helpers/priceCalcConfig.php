<?php
/**
 * Калькуляторы дашборда и их таблицы цен/названий.
 * Используется get_price.php, getTitelPrice.php, priceChange.php и save_price.php (параметр calc=fiz|ur).
 *
 *  - priceTable  — таблица цен (name → price)
 *  - titleTable  — таблица названий позиций (name → titel)
 *  - config      — структура страницы изменения цен (файл в dashbord/helpers/)
 */

if (!function_exists('priceCalcKey')) {
    /**
     * Ключ калькулятора из запроса: пусто → 'fiz', известный ключ → он сам, иначе null.
     */
    function priceCalcKey(array $calcs, $raw)
    {
        if ($raw === null || $raw === '') {
            return 'fiz';
        }
        return is_string($raw) && isset($calcs[$raw]) ? $raw : null;
    }
}

return [
    'fiz' => [
        'label' => 'Калькулятор ФИЗ',
        'short' => 'ФИЗ',
        'priceTable' => 'pricecalc',
        'titleTable' => 'titel_calc',
        'config' => 'priceChangeConfig.php',
    ],
    'ur' => [
        'label' => 'Калькулятор ЮР',
        'short' => 'ЮР',
        'priceTable' => 'pricecalc_ur',
        'titleTable' => 'titel_calc_ur',
        'config' => 'priceChangeConfigUr.php',
    ],
];
