-- Самоклейка A4 и A3 в разделе «Печать» (цветная и черно-белая): цены были вписаны в код
-- калькуляторов, теперь берутся из pricecalc и редактируются в dashbord/priceChange.php.
-- Стартовые значения равны прежним из кода: A4 — 150 р., A3 — 290 р.

INSERT INTO `pricecalc` (`name`, `price`)
SELECT * FROM (
    SELECT 'petchat_chet_A4_sk' AS `name`, '150' AS `price`
    UNION ALL SELECT 'petchat_chet_A3_sk', '290'
    UNION ALL SELECT 'petchat_bw_A4_sk', '150'
    UNION ALL SELECT 'petchat_bw_A3_sk', '290'
) AS new_rows
WHERE NOT EXISTS (SELECT 1 FROM `pricecalc` p WHERE p.`name` = new_rows.`name`);

-- Названия позиций A3: раньше подставлялось название от A4 (ключ aaai)

INSERT INTO `titel_calc` (`name`, `titel`)
SELECT * FROM (
    SELECT 'aabj' AS `name`, 'самоклейка' AS `titel`
    UNION ALL SELECT 'abbg', 'самоклейка'
) AS new_rows
WHERE NOT EXISTS (SELECT 1 FROM `titel_calc` t WHERE t.`name` = new_rows.`name`);
