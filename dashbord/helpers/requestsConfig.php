<?php
/**
 * Заявки с сайта (таблица zayavki): статусы, типы и справочники параметров.
 *
 * Заявки создаёт registerz.php (формы zakaz_*.php, kalendarProducts.php, штендер «Бессмертный полк»,
 * обратная связь, конструкторы кружек и футболок, калькулятор). Параметры заказа лежат в колонке info
 * как serialize()-массив, коды совпадают со значениями <option> в формах сайта.
 *
 * Поле:  key — ключ в API; label — подпись; src — откуда брать значение:
 *        ['info', N] — элемент N массива info, ['col', 'kwiz_vid'] — колонка, ['assoc', 'sizeShit'] — ключ info-словаря,
 *        ['check'] — номер чека калькулятора из comment;
 *        options — справочник кодов; kind — select|text|number; edit — можно ли менять в админке;
 *        urgent — коды «срочно».
 */
$srokDay = 'Не срочно (1 рабочий день)';
$srok4h = 'В течение 4 часов';

return [
	// Статусы в БД (varchar(10)). «Новая» — вычисляемый: status = «Активна» и заявку ещё ни разу не сохраняли (updated_at IS NULL).
	'statuses' => [
		'new' => ['db' => 'Активна', 'label' => 'Новая', 'hint' => 'Ещё не обрабатывалась', 'open' => true],
		'active' => ['db' => 'Активна', 'label' => 'В работе', 'hint' => 'Взята в работу', 'open' => true],
		'wait' => ['db' => 'Ожидание', 'label' => 'Ожидание', 'hint' => 'Ждём ответа клиента', 'open' => true],
		'paid' => ['db' => 'Оплачена', 'label' => 'Оплачена', 'hint' => 'Оплачена, в производстве', 'open' => true],
		'closed' => ['db' => 'Закрыта', 'label' => 'Закрыта', 'hint' => 'Выполнена', 'open' => false],
		'cancel' => ['db' => 'Отмена', 'label' => 'Отмена', 'hint' => 'Отменена', 'open' => false],
	],

	'types' => [
		'shtender' => [
			'tip' => 'штендер', 'label' => 'Штендер', 'full' => 'Штендер «Бессмертный полк»', 'icon' => 'bx-id-card',
			'fields' => [
				['key' => 'name1', 'label' => 'ФИО', 'group' => 'Человек 1', 'src' => ['info', 0], 'kind' => 'text', 'edit' => true],
				['key' => 'zv1', 'label' => 'Звание', 'group' => 'Человек 1', 'src' => ['info', 1], 'kind' => 'text', 'edit' => true],
				['key' => 'ye1', 'label' => 'Годы жизни', 'group' => 'Человек 1', 'src' => ['info', 2], 'kind' => 'text', 'edit' => true],
				['key' => 'name2', 'label' => 'ФИО', 'group' => 'Человек 2', 'src' => ['info', 3], 'kind' => 'text', 'edit' => true],
				['key' => 'zv2', 'label' => 'Звание', 'group' => 'Человек 2', 'src' => ['info', 4], 'kind' => 'text', 'edit' => true],
				['key' => 'ye2', 'label' => 'Годы жизни', 'group' => 'Человек 2', 'src' => ['info', 5], 'kind' => 'text', 'edit' => true],
				['key' => 'format', 'label' => 'Формат', 'group' => 'Макет', 'src' => ['info', 7], 'kind' => 'text', 'edit' => true],
				['key' => 'template', 'label' => 'Шаблон', 'group' => 'Макет', 'src' => ['info', 8], 'kind' => 'text', 'edit' => true],
				['key' => 'flret', 'label' => 'Ретушь, реставрация', 'group' => 'Макет', 'src' => ['info', 6], 'kind' => 'text', 'edit' => true],
			],
			'files' => [
				['label' => 'Скриншот макета', 'src' => ['info', 9]],
				['label' => 'Фото 1', 'src' => ['info', 10]],
				['label' => 'Фото 2', 'src' => ['info', 11]],
			],
			'summary' => ['name1', 'name2', 'format'],
		],
		'feedback' => [
			'tip' => 'ОБРАТНАЯ СВЯЗЬ', 'label' => 'Обратная связь', 'icon' => 'bx-message-dots',
			'fields' => [
				['key' => 'vid', 'label' => 'Что нужно', 'src' => ['col', 'kwiz_vid'], 'kind' => 'text'],
				['key' => 'srok', 'label' => 'Срочность', 'src' => ['col', 'kwiz_srok'], 'kind' => 'text', 'urgent' => ['В течении 4 часов', 'В течение 4 часов', 'В течении часа']],
			],
			'summary' => ['vid', 'srok'],
		],
		'petfoto' => [
			'tip' => 'petfoto', 'label' => 'Печать фото', 'icon' => 'bx-photo-album',
			'fields' => [
				['key' => 'size', 'label' => 'Размер', 'src' => ['info', 0], 'kind' => 'select', 'edit' => true,
					'options' => ['1' => '10×15 см (A6)', '2' => '15×20 см (A5)', '3' => '21×30 см (A4)']],
				['key' => 'paper', 'label' => 'Бумага', 'src' => ['info', 1], 'kind' => 'select', 'edit' => true,
					'options' => ['4' => 'Матовая', '5' => 'Глянцевая']],
				['key' => 'qty', 'label' => 'Количество', 'src' => ['info', 2], 'kind' => 'number', 'edit' => true, 'suffix' => ' шт'],
				['key' => 'srok', 'label' => 'Срочность', 'src' => ['info', 3], 'kind' => 'select', 'edit' => true,
					'options' => ['6' => $srokDay, '7' => $srok4h], 'urgent' => ['7']],
			],
			'summary' => ['qty', 'size', 'paper'],
		],
		'vizitka' => [
			'tip' => 'vizitka', 'label' => 'Визитки', 'icon' => 'bx-id-card',
			'fields' => [
				['key' => 'qty', 'label' => 'Тираж', 'src' => ['info', 0], 'kind' => 'select', 'edit' => true, 'suffix' => ' шт',
					'options' => ['11' => '100', '12' => '200', '13' => '300', '14' => '500', '15' => '1000', '16' => '2000', '17' => '5000']],
				['key' => 'size', 'label' => 'Размер', 'src' => ['info', 3], 'kind' => 'select', 'edit' => true,
					'options' => ['1' => '85×55', '2' => '90×50']],
				['key' => 'paper', 'label' => 'Бумага', 'src' => ['info', 1], 'kind' => 'select', 'edit' => true,
					'options' => ['3' => 'Мелованная 300 г', '4' => 'Лён белый', '5' => 'Лён слоновая кость', '6' => 'Тачкавер белый', '7' => 'Тачкавер слоновая кость', '8' => 'Золотая бумага']],
				['key' => 'color', 'label' => 'Цветность', 'src' => ['info', 2], 'kind' => 'select', 'edit' => true,
					'options' => ['9' => '4+0 (односторонние)', '10' => '4+4 (двусторонние)']],
				['key' => 'srok', 'label' => 'Срочность', 'src' => ['info', 4], 'kind' => 'select', 'edit' => true,
					'options' => ['18' => $srokDay, '19' => $srok4h], 'urgent' => ['19']],
			],
			'summary' => ['qty', 'size', 'paper', 'color'],
		],
		'listovki' => [
			'tip' => 'listovki', 'label' => 'Листовки', 'icon' => 'bx-file',
			'fields' => [
				['key' => 'qty', 'label' => 'Тираж', 'src' => ['info', 0], 'kind' => 'select', 'edit' => true, 'suffix' => ' шт',
					'options' => ['12' => '100', '13' => '200', '14' => '300', '15' => '500', '16' => '1000', '17' => '2000', '18' => '5000']],
				['key' => 'size', 'label' => 'Размер', 'src' => ['info', 3], 'kind' => 'select', 'edit' => true,
					'options' => ['1' => '10,5×15 см (A6)', '2' => '10×20 см (1/3 A4)', '3' => '15×20 см (A5)', '4' => '21×30 см (A4)', '5' => '90×50']],
				['key' => 'paper', 'label' => 'Бумага', 'src' => ['info', 1], 'kind' => 'select', 'edit' => true,
					'options' => ['6' => 'Мелованная 130 г', '7' => 'Мелованная 170 г', '8' => 'Мелованная 250 г', '9' => 'Мелованная 300 г']],
				['key' => 'color', 'label' => 'Цветность', 'src' => ['info', 2], 'kind' => 'select', 'edit' => true,
					'options' => ['10' => '4+0 (односторонние)', '11' => '4+4 (двусторонние)']],
				['key' => 'srok', 'label' => 'Срочность', 'src' => ['info', 4], 'kind' => 'select', 'edit' => true,
					'options' => ['19' => $srokDay, '20' => $srok4h], 'urgent' => ['20']],
			],
			'summary' => ['qty', 'size', 'paper', 'color'],
		],
		'petchat' => [
			'tip' => 'petchat', 'label' => 'Печати', 'icon' => 'bx-certification',
			'fields' => [
				['key' => 'kind', 'label' => 'Печать', 'src' => ['info', 0], 'kind' => 'select', 'edit' => true,
					'options' => ['1' => 'Первичная печать', '2' => 'Печать по оттиску']],
				['key' => 'osnastka', 'label' => 'Оснастка', 'src' => ['info', 1], 'kind' => 'select', 'edit' => true,
					'options' => ['3' => 'Автоматическая', '4' => 'Ручная (пешка)']],
				['key' => 'avt', 'label' => 'Автоматическая оснастка', 'src' => ['info', 2], 'kind' => 'select', 'edit' => true,
					'options' => ['0' => 'Не определился', '5' => 'd40 мм', '6' => 'Карманная, d40 мм', '7' => '20×20 мм', '8' => '30×50 мм', '9' => '10×27 мм', '10' => '14×38 мм', '11' => '23×59 мм', '12' => '30×69 мм', '13' => '37×76 мм', '14' => '25×82 мм']],
				['key' => 'srok', 'label' => 'Срочность', 'src' => ['info', 3], 'kind' => 'select', 'edit' => true,
					'options' => ['15' => $srokDay, '16' => $srok4h, '17' => 'В течение часа'], 'urgent' => ['16', '17']],
			],
			'summary' => ['kind', 'osnastka', 'avt'],
		],
		'calc' => [
			'tip' => 'С калькулятора', 'label' => 'С калькулятора', 'icon' => 'bx-calculator',
			'fields' => [
				['key' => 'check', 'label' => 'Калькулятор на сайте', 'src' => ['check'], 'kind' => 'text', 'prefix' => 'Чек № '],
			],
			'summary' => ['check'],
			'clientComment' => true,
		],
		'mugConstructor' => [
			'tip' => 'Кружка (Конструктор)', 'label' => 'Кружка (конструктор)', 'icon' => 'bx-coffee-togo',
			'fields' => [],
			'files' => [
				['label' => 'Макет JPG', 'src' => ['assocList', 'images', 0], 'prefix' => '/constructor-Mugs/'],
				['label' => 'Макет PNG', 'src' => ['assocList', 'images', 0], 'prefix' => '/constructor-Mugs/', 'png' => true],
			],
			'summary' => [],
			'clientComment' => true,
		],
		'mug' => [
			'tip' => 'Печать на кружке', 'label' => 'Печать на кружке', 'icon' => 'bx-coffee',
			'fields' => [
				['key' => 'article', 'label' => 'Артикул кружки', 'src' => ['col', 'kwiz_vid'], 'kind' => 'text'],
			],
			'summary' => ['article'],
		],
		'shirt' => [
			'tip' => 'Футболка', 'label' => 'Футболка (конструктор)', 'icon' => 'bx-closet',
			'fields' => [
				['key' => 'sizeShirt', 'label' => 'Размер', 'src' => ['assoc', 'sizeShit'], 'kind' => 'text'],
			],
			'files' => [
				['label' => 'Скрин 1', 'src' => ['assocList', 'screenShots', 0], 'prefix' => '/constructorT-Shirt/phpModules/'],
				['label' => 'Скрин 2', 'src' => ['assocList', 'screenShots', 1], 'prefix' => '/constructorT-Shirt/phpModules/'],
				['label' => 'Изображение 1', 'src' => ['assocList', 'images', 0]],
				['label' => 'Изображение 2', 'src' => ['assocList', 'images', 1]],
				['label' => 'Изображение 3', 'src' => ['assocList', 'images', 2]],
			],
			'summary' => ['sizeShirt'],
			'clientComment' => true,
		],
		'calendar' => [
			'tip' => 'Календари', 'label' => 'Календари', 'icon' => 'bx-calendar',
			'fields' => [
				['key' => 'vid', 'label' => 'Вид продукции', 'src' => ['info', 0], 'kind' => 'text'],
				['key' => 'srok', 'label' => 'Срочность', 'src' => ['info', 1], 'kind' => 'select',
					'options' => ['18' => $srokDay, '19' => $srok4h], 'urgent' => ['19']],
			],
			'summary' => ['vid'],
		],
	],
];
