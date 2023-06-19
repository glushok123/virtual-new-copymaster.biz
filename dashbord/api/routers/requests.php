<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/config.php';


function route($method, $urlData, $formData)
{

    // Получение информации о заявках
    // GET /requests/
    if ($method === 'GET') {
        // Вытаскиваем заявки из базы...
        $db = getDbInstance();
        if (empty($urlData[0])) {
            $res = $db->query("SELECT * FROM `zayavki`");
            $json = '[';
            foreach ($res as $z) {

                if ($z["tip"] == "vizitka") {
                    $z["tip"] = "ВИЗИТКА";
                }

                if ($z["tip"] == "listovki") {
                    $z["tip"] = "ЛИСТОВКА";
                }

                if ($z["tip"] == "petchat") {
                    $z["tip"] = "ПЕЧАТЬ";
                }

                if ($z["tip"] == "petfoto") {
                    $z["tip"] = "ПЕЧАТЬ ФОТО";
                }

                if ($z["tip"] == "ОБРАТНАЯ СВЯЗЬ") {
                    $z["tip"] = $z["tip"] . "<hr>" . $z["kwiz_vid"] . "<hr>" . $z["kwiz_srok"];
                }

                if ($z["tip"] == "Печать на кружке") {
                    $z["tip"] = $z["tip"] . "<hr> Артикул кружки: " . $z["kwiz_vid"] . "<hr>" . $z["kwiz_srok"];
                }

                if ($z["tip"] === "Футболка") {
                    if (!empty($z["info"])) {
                        $info = unserialize($z["info"]);

                        if (!empty($info["screenShots"])) {
                            if (!empty($info["screenShots"][0])) {
                                $z["tip"] = $z["tip"] . "<hr><a href='/constructorT-Shirt/phpModules/" . $info["screenShots"][0] . "' target='_blank'>Скрин 1(просмотр)</a>";
                            }

                            if (!empty($info["screenShots"][1])) {
                                $z["tip"] = $z["tip"] . "<br><a href='/constructorT-Shirt/phpModules/" . $info["screenShots"][1] . "' target='_blank'>Скрин 2(просмотр)</a>";
                            }
                        }

                        if (!empty($info["images"])) {
                            if (!empty($info["images"][0])) {
                                $z["tip"] = $z["tip"] . "<hr><a href='" . $info["images"][0] . "' target='_blank'>Image 1(просмотр)</a>";
                            }

                            if (!empty($info["images"][1])) {
                                $z["tip"] = $z["tip"] . "<br><a href='" . $info["images"][1] . "' target='_blank'>Image 2(просмотр)</a>";
                            }

                            if (!empty($info["images"][2])) {
                                $z["tip"] = $z["tip"] . "<br><a href='" . $info["images"][2] . "' target='_blank'>Image 3(просмотр)</a>";
                            }
                        }
                    }
                }

                $text = '{ "id":"' . $z["id"] . '", "name":"' . $z["name"] . '",  "email":"' . $z["email"] . '",  "status":"' . $z["status"] . '",  "comment":"' . $z["comment"] . '","price":"' . $z["price"] . '",  "created_at":"' . $z["created_at"] . '",  "updated_at":"' . $z["updated_at"] . '",  "phon":"' . $z["phon"] . '", "tip":"' . $z["tip"] . '"},';
                $json = $json . $text;
            }
            $json = $json . ']';
            $json = str_replace(',]', ']', $json);
        } else {
            $id = $urlData[0];
            $res = $db->query("SELECT * FROM `zayavki` WHERE id='$id'");
            $json = '[';
            if ($res[0]["tip"] != "ОБРАТНАЯ СВЯЗЬ") {
                $info = unserialize($res[0]["info"]);
            }


            if ($res[0]["tip"] == "vizitka") {
                $text = '{ "id":"' . $res[0]["id"] . '", "kol":"' . $info[0] . '","tipbum":"' . $info[1] . '","cvet":"' . $info[2] . '","size":"' . $info[3] . '","srok":"' . $info[4] . '","status":"' . $res[0]["status"] . '" ,"price":"' . $res[0]["price"] . '","comment":"' . $res[0]["comment"] . '", "tip":"' . $res[0]["tip"] . '"  }';
            }
            if ($res[0]["tip"] == "listovki") {
                $text = '{ "id":"' . $res[0]["id"] . '", "kol":"' . $info[0] . '","tipbum":"' . $info[1] . '","cvet":"' . $info[2] . '","size":"' . $info[3] . '","srok":"' . $info[4] . '","status":"' . $res[0]["status"] . '" ,"price":"' . $res[0]["price"] . '","comment":"' . $res[0]["comment"] . '", "tip":"' . $res[0]["tip"] . '"  }';
            }

            if ($res[0]["tip"] == "petchat") {
                $text = '{ "id":"' . $res[0]["id"] . '", "petchat_tip":"' . $info[0] . '","osnastka":"' . $info[1] . '","avt_osnastka":"' . $info[2] . '","srok":"' . $info[3] . '","status":"' . $res[0]["status"] . '" ,"price":"' . $res[0]["price"] . '","comment":"' . $res[0]["comment"] . '", "tip":"' . $res[0]["tip"] . '"  }';
            }

            if ($res[0]["tip"] == "petfoto") {
                $text = '{ "id":"' . $res[0]["id"] . '", "size":"' . $info[0] . '","tipbum":"' . $info[1] . '","kol":"' . $info[2] . '","srok":"' . $info[3] . '","status":"' . $res[0]["status"] . '" ,"price":"' . $res[0]["price"] . '","comment":"' . $res[0]["comment"] . '", "tip":"' . $res[0]["tip"] . '"  }';
            }
            if ($res[0]["tip"] == "штендер") {
                $text = '{ "id":"' . $res[0]["id"] . '", "name1":"' . $info[0] . '","zv1":"' . $info[1] . '","ye1":"' . $info[2] . '","name2":"' . $info[3] . '","zv2":"' . $info[4] . '" ,"ye2":"' . $info[5] . '",  "flret":"' . $info[6] . '","format":"' . $info[7] . '","template":"' . $info[8] . '","url_screenimg":"' . $info[9] . '","url_photo1img":"' . $info[10] . '", "url_photo2img":"' . $info[11] . '","status":"' . $res[0]["status"] . '" ,"price":"' . $res[0]["price"] . '","comment":"' . $res[0]["comment"] . '", "tip":"' . $res[0]["tip"] . '"   }';
            }
            if ($res[0]["tip"] == "ОБРАТНАЯ СВЯЗЬ") {
                $text = '{ "id":"' . $res[0]["id"] . '", "status":"' . $res[0]["status"] . '" ,"price":"' . $res[0]["price"] . '","comment":"' . $res[0]["comment"] . '", "tip":"' . $res[0]["tip"] . '"  }';
            }

            $json = $json . $text;

            $json = $json . ']';
            $json = str_replace(',]', ']', $json);
        }
        // Выводим ответ клиенту
        echo json_encode($json);
        return;
    }


    // Добавление новой заявки
    // POST /requests/
    if ($method === 'POST' && empty($urlData)) {
        // Добавляем заявки в базу...


        if ($formData['name'] == "") {
            echo json_encode(
                array(
                    'error' => 'Bad Request'
                )
            );
            return;
        }
        if ($formData['email'] == "") {
            echo json_encode(
                array(
                    'error' => 'Bad Request'
                )
            );
            return;
        }
        if ($formData['message'] == "") {
            echo json_encode(
                array(
                    'error' => 'Bad Request'
                )
            );
            return;
        }

        $db = getDbInstance();
        $date_creat = date('Y-m-d H:i:s');
        $db->query("INSERT INTO zayavki    ( `name`, `email`, `message`, `created_at`)
        VALUES
        ('" . $formData['name'] . "','" . $formData['email'] . "','" . $formData['message'] . "','" . $date_creat . "')");
        // Выводим ответ клиенту

        //$res = $db->query("SELECT * FROM `zayavki` WHERE id=$Id");
        require_once 'send.php';
        sendmessage("info@copymaster.biz");


        echo json_encode(
            array(
                'method' => 'POST',
                'id' => rand(1, 100),
                'formData' => $formData['name']
            )
        );
        return;
    }


    // Обновление данных заявки
    // PUT /requests/{Id}/
    if ($method === 'PUT' && count($urlData) === 1) {
        // Получаем id заявки
        if ($formData["tipz"] == "vizitka") {
            $Id = $urlData[0];
            $kolit = $formData["kol"];
            $tibum = $formData["tip"];
            $cvet = $formData["cvet"];
            $sizebum = $formData["size"];
            $srok = $formData["srok"];
            $data = [];

            array_push($data, $kolit, $tibum, $cvet, $sizebum, $srok);
            $info = serialize($data);

            $db = getDbInstance();
            $date_update = date('Y-m-d H:i:s');
            $db->query("UPDATE `zayavki` SET `price`='" . $formData['price'] . "',`status`='" . $formData['status'] . "', `comment`='" . $formData['comment'] . "',`updated_at`='" . $date_update . "',`info`='" . $info . "' WHERE id=$Id");
            // Выводим ответ клиенту
        }
        if ($formData["tipz"] == "listovki") {
            $Id = $urlData[0];
            $kolit = $formData["kol"];
            $tibum = $formData["tip"];
            $cvet = $formData["cvet"];
            $sizebum = $formData["size"];
            $srok = $formData["srok"];
            $data = [];

            array_push($data, $kolit, $tibum, $cvet, $sizebum, $srok);
            $info = serialize($data);

            $db = getDbInstance();
            $date_update = date('Y-m-d H:i:s');
            $db->query("UPDATE `zayavki` SET `price`='" . $formData['price'] . "',`status`='" . $formData['status'] . "', `comment`='" . $formData['comment'] . "',`updated_at`='" . $date_update . "',`info`='" . $info . "' WHERE id=$Id");
            // Выводим ответ клиенту
        }
        if ($formData["tipz"] == "petchat") {
            $Id = $urlData[0];
            $petchat_tip = $formData["petchat_tip"];
            $osnastka = $formData["osnastka"];
            $avt_osnastka = $formData["avt_osnastka"];
            $srok = $formData["srok"];
            $data = [];

            array_push($data, $petchat_tip, $osnastka, $avt_osnastka, $srok);
            $info = serialize($data);

            $db = getDbInstance();
            $date_update = date('Y-m-d H:i:s');
            $db->query("UPDATE `zayavki` SET `price`='" . $formData['price'] . "',`status`='" . $formData['status'] . "', `comment`='" . $formData['comment'] . "',`updated_at`='" . $date_update . "',`info`='" . $info . "' WHERE id=$Id");
            // Выводим ответ клиенту
        }
        if ($formData["tipz"] == "petfoto") {
            $Id = $urlData[0];

            $kolit = $formData["kol"];
            $tibum = $formData["tip"];
            $sizebum = $formData["size"];
            $srok = $formData["srok"];

            $data = [];

            array_push($data, $sizebum, $tibum, $kolit, $srok);
            $info = serialize($data);

            $db = getDbInstance();
            $date_update = date('Y-m-d H:i:s');
            $db->query("UPDATE `zayavki` SET `price`='" . $formData['price'] . "',`status`='" . $formData['status'] . "', `comment`='" . $formData['comment'] . "',`updated_at`='" . $date_update . "',`info`='" . $info . "' WHERE id=$Id");
            // Выводим ответ клиенту
        }
        if ($formData["tipz"] == "штендер") {
            $Id = $urlData[0];

            $name1 = $formData["name1"];
            $zv1 = $formData["zv1"];
            $ye1 = $formData["ye1"];

            $name2 = $formData["name2"];
            $zv2 = $formData["zv2"];
            $ye2 = $formData["ye2"];

            $url_photo1img = $formData["url_photo1img"];
            $url_photo2img = $formData["url_photo2img"];
            $url_screenimg = $formData["url_screenimg"];

            $data = [];

            array_push($data, $name1, $zv1, $ye1, $name2, $zv2, $ye2, $flret, $format, $template, $url_screenimg, $url_photo1img, $url_photo2img);
            $info = serialize($data);

            $db = getDbInstance();
            $date_update = date('Y-m-d H:i:s');
            $db->query("UPDATE `zayavki` SET `price`='" . $formData['price'] . "',`status`='" . $formData['status'] . "', `comment`='" . $formData['comment'] . "',`updated_at`='" . $date_update . "',`info`='" . $info . "' WHERE id=$Id");
            // Выводим ответ клиенту
        }
        if ($formData["tipz"] == "ОБРАТНАЯ СВЯЗЬ") {
            $Id = $urlData[0];
            $db = getDbInstance();
            $date_update = date('Y-m-d H:i:s');
            $db->query("UPDATE `zayavki` SET `price`='" . $formData['price'] . "',`status`='" . $formData['status'] . "', `comment`='" . $formData['comment'] . "',`updated_at`='" . $date_update . "' WHERE id=$Id");
            // Выводим ответ клиенту
        }
        echo json_encode(
            array(
                'method' => 'PUT',
                'id' => $Id,
                'formData' => $formData,
                'email' => $res[0]['email']
            )
        );

        return;
    }

    // Удаление заявки
    // DELETE /requests/{Id}
    if ($method === 'DELETE' && count($urlData) === 1) {
        // Получаем id заявки
        $Id = $urlData[0];

        // Удаляем заявку из базы...
        $db = getDbInstance();
        $db->query("DELETE FROM `zayavki` WHERE id=$urlData[0]");
        // Выводим ответ клиенту
        echo json_encode(
            array(
                'method' => 'DELETE',
                'id' => $Id
            )
        );
        return;
    }


    // Возвращаем ошибку
    header('HTTP/1.0 400 Bad Request');
    echo json_encode(
        array(
            'error' => 'Bad Request'
        )
    );

}