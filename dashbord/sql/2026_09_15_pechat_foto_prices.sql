-- Дизайн > Печать фото: цены редактируются в dashbord/priceChange.php,
-- используются калькуляторами (d > dl > dla/dlb/dlc/dld).
-- Стартовые цены взяты из ранее захардкоженных значений dashbord/calc/main.js.

INSERT INTO `pricecalc` (`name`, `price`)
SELECT * FROM (
    SELECT 'dis_foto_10x15' AS `name`, '30' AS `price`
    UNION ALL SELECT 'dis_foto_15x20', '70'
    UNION ALL SELECT 'dis_foto_20x30', '150'
    UNION ALL SELECT 'dis_foto_30x40', '250'
) AS new_rows
WHERE NOT EXISTS (SELECT 1 FROM `pricecalc` p WHERE p.`name` = new_rows.`name`);

INSERT INTO `titel_calc` (`name`, `titel`)
SELECT 'dld', '30Х40' FROM DUAL
WHERE NOT EXISTS (SELECT 1 FROM `titel_calc` WHERE `name` = 'dld');
