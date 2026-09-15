<?php
/**
 * Общие функции конфигураций страницы изменения цен
 * (helpers/priceChangeConfig.php — ФИЗ, helpers/priceChangeConfigUr.php — ЮР).
 */

if (!function_exists('priceTierCols')) {
    /** Подписи колонок тиража. Калькулятор берёт цену колонки N, если тираж > N. */
    function priceTierCols(array $tiers)
    {
        $cols = [];
        foreach ($tiers as $i => $from) {
            $start = number_format($from + 1, 0, '', "\xE2\x80\xAF");
            $cols[] = isset($tiers[$i + 1])
                ? $start . '–' . number_format($tiers[$i + 1], 0, '', "\xE2\x80\xAF")
                : $start . '+';
        }
        return $cols;
    }

    /** Строка матрицы тиражей: ключи по шаблону с {t}. */
    function priceTierRow($label, $pattern, array $tiers)
    {
        return [$label, array_map(function ($t) use ($pattern) {
            return str_replace('{t}', $t, $pattern);
        }, $tiers)];
    }

    /** Все ключи конфигурации — белый список для save_price.php. */
    function priceChangeKeys(array $sections)
    {
        $keys = [];
        foreach ($sections as $section) {
            foreach ($section['groups'] as $group) {
                if ($group['type'] === 'list') {
                    foreach ($group['items'] as $item) {
                        $keys[] = $item[0];
                    }
                } else {
                    foreach ($group['rows'] as $row) {
                        foreach ($row[1] as $key) {
                            if ($key !== null) {
                                $keys[] = $key;
                            }
                        }
                    }
                }
            }
        }
        return $keys;
    }
}
