-- Калькулятор ФИЗ: визитки упрощены до «1/2 стороны → не срочно/срочно → 100/200/300/500/1000».
-- Прежнее дерево (виды бумаги, заливка) скрыто в dashbord/calc/main.js (dc_hidden), раздел «Багетка» скрыт.
-- Стартовые цены — прежние для мелованной бумаги 300 г, заливка до 20% (срочно ×1.3).

-- 1. Цены за тираж (редактируются в dashbord/priceChange.php → Дизайн → Печать визиток)
INSERT INTO `pricecalc` (`name`, `price`)
SELECT * FROM (
    SELECT 'dis_viz_1s_n_100' AS `name`, '550' AS `price`
    UNION ALL SELECT 'dis_viz_1s_n_200', '1100'
    UNION ALL SELECT 'dis_viz_1s_n_300', '1650'
    UNION ALL SELECT 'dis_viz_1s_n_500', '2750'
    UNION ALL SELECT 'dis_viz_1s_n_1000', '5500'
    UNION ALL SELECT 'dis_viz_1s_s_100', '715'
    UNION ALL SELECT 'dis_viz_1s_s_200', '1430'
    UNION ALL SELECT 'dis_viz_1s_s_300', '2145'
    UNION ALL SELECT 'dis_viz_1s_s_500', '3575'
    UNION ALL SELECT 'dis_viz_1s_s_1000', '7150'
    UNION ALL SELECT 'dis_viz_2s_n_100', '650'
    UNION ALL SELECT 'dis_viz_2s_n_200', '1300'
    UNION ALL SELECT 'dis_viz_2s_n_300', '1950'
    UNION ALL SELECT 'dis_viz_2s_n_500', '3250'
    UNION ALL SELECT 'dis_viz_2s_n_1000', '6500'
    UNION ALL SELECT 'dis_viz_2s_s_100', '845'
    UNION ALL SELECT 'dis_viz_2s_s_200', '1690'
    UNION ALL SELECT 'dis_viz_2s_s_300', '2535'
    UNION ALL SELECT 'dis_viz_2s_s_500', '4225'
    UNION ALL SELECT 'dis_viz_2s_s_1000', '8450'
) AS new_rows
WHERE NOT EXISTS (SELECT 1 FROM `pricecalc` p WHERE p.`name` = new_rows.`name`);

-- 2. Резервная копия названий: ключи dcaa, dcab, dcaaa… раньше означали вид бумаги/срочность в старом дереве
CREATE TABLE `titel_calc_backup_20260915` AS SELECT * FROM `titel_calc`;

-- 3. Названия позиций нового дерева
UPDATE `titel_calc` SET `titel` = '(Не Срочное изготовление)' WHERE `name` = 'dcaa';
UPDATE `titel_calc` SET `titel` = '100 шт' WHERE `name` = 'dcaaa';
UPDATE `titel_calc` SET `titel` = '200 шт' WHERE `name` = 'dcaab';
UPDATE `titel_calc` SET `titel` = '300 шт' WHERE `name` = 'dcaac';
UPDATE `titel_calc` SET `titel` = '500 шт' WHERE `name` = 'dcaad';
UPDATE `titel_calc` SET `titel` = '1000 шт' WHERE `name` = 'dcaae';
UPDATE `titel_calc` SET `titel` = '(Срочное изготовление)' WHERE `name` = 'dcab';
UPDATE `titel_calc` SET `titel` = '100 шт' WHERE `name` = 'dcaba';
UPDATE `titel_calc` SET `titel` = '200 шт' WHERE `name` = 'dcabb';
UPDATE `titel_calc` SET `titel` = '300 шт' WHERE `name` = 'dcabc';
UPDATE `titel_calc` SET `titel` = '500 шт' WHERE `name` = 'dcabd';
UPDATE `titel_calc` SET `titel` = '1000 шт' WHERE `name` = 'dcabe';
UPDATE `titel_calc` SET `titel` = '(Не Срочное изготовление)' WHERE `name` = 'dcba';
UPDATE `titel_calc` SET `titel` = '100 шт' WHERE `name` = 'dcbaa';
UPDATE `titel_calc` SET `titel` = '200 шт' WHERE `name` = 'dcbab';
UPDATE `titel_calc` SET `titel` = '300 шт' WHERE `name` = 'dcbac';
UPDATE `titel_calc` SET `titel` = '500 шт' WHERE `name` = 'dcbad';
UPDATE `titel_calc` SET `titel` = '1000 шт' WHERE `name` = 'dcbae';
UPDATE `titel_calc` SET `titel` = '(Срочное изготовление)' WHERE `name` = 'dcbb';
UPDATE `titel_calc` SET `titel` = '100 шт' WHERE `name` = 'dcbba';
UPDATE `titel_calc` SET `titel` = '200 шт' WHERE `name` = 'dcbbb';
UPDATE `titel_calc` SET `titel` = '300 шт' WHERE `name` = 'dcbbc';
UPDATE `titel_calc` SET `titel` = '500 шт' WHERE `name` = 'dcbbd';
UPDATE `titel_calc` SET `titel` = '1000 шт' WHERE `name` = 'dcbbe';

INSERT INTO `titel_calc` (`name`, `titel`)
SELECT * FROM (
    SELECT 'dcaa' AS `name`, '(Не Срочное изготовление)' AS `titel`
    UNION ALL SELECT 'dcaaa', '100 шт'
    UNION ALL SELECT 'dcaab', '200 шт'
    UNION ALL SELECT 'dcaac', '300 шт'
    UNION ALL SELECT 'dcaad', '500 шт'
    UNION ALL SELECT 'dcaae', '1000 шт'
    UNION ALL SELECT 'dcab', '(Срочное изготовление)'
    UNION ALL SELECT 'dcaba', '100 шт'
    UNION ALL SELECT 'dcabb', '200 шт'
    UNION ALL SELECT 'dcabc', '300 шт'
    UNION ALL SELECT 'dcabd', '500 шт'
    UNION ALL SELECT 'dcabe', '1000 шт'
    UNION ALL SELECT 'dcba', '(Не Срочное изготовление)'
    UNION ALL SELECT 'dcbaa', '100 шт'
    UNION ALL SELECT 'dcbab', '200 шт'
    UNION ALL SELECT 'dcbac', '300 шт'
    UNION ALL SELECT 'dcbad', '500 шт'
    UNION ALL SELECT 'dcbae', '1000 шт'
    UNION ALL SELECT 'dcbb', '(Срочное изготовление)'
    UNION ALL SELECT 'dcbba', '100 шт'
    UNION ALL SELECT 'dcbbb', '200 шт'
    UNION ALL SELECT 'dcbbc', '300 шт'
    UNION ALL SELECT 'dcbbd', '500 шт'
    UNION ALL SELECT 'dcbbe', '1000 шт'
) AS new_rows
WHERE NOT EXISTS (SELECT 1 FROM `titel_calc` t WHERE t.`name` = new_rows.`name`);
