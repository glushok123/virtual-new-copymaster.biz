<?php

// Получение данных из тела запроса
function getFormData($method)
{

    // GET или POST: данные возвращаем как есть
    if ($method === 'GET')
        return $_GET;
    if ($method === 'POST')
        return $_POST;

    // PUT, PATCH или DELETE
    $data = array();
    $exploded = explode('&', file_get_contents('php://input'));

    foreach ($exploded as $pair) {
        $item = explode('=', $pair);
        if (count($item) == 2) {
            $data[urldecode($item[0])] = urldecode($item[1]);
        }
    }

    return $data;
}

// Определяем метод запроса
$method = $_SERVER['REQUEST_METHOD'];

// Получаем данные из тела запроса
$formData = getFormData($method);


// Разбираем url
$url = (isset($_GET['q'])) ? $_GET['q'] : '';
$url = rtrim($url, '/');
$urls = explode('/', $url);

// Определяем роутер и url data
$router = $urls[0];
$urlData = array_slice($urls, 1);

// Подключаем файл-роутер и запускаем главную функцию.
// Имя роутера — только латиница: иначе через ../ можно было подключить любой .php на сервере.
if (!preg_match('/^[a-z]+$/', $router) || !is_file(__DIR__ . '/routers/' . $router . '.php')) {
    http_response_code(404);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode(array('error' => 'Not Found'));
    exit;
}
include_once __DIR__ . '/routers/' . $router . '.php';
route($method, $urlData, $formData);