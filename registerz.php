<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/config.php';

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    if ($_POST["id"] == "vizitki")
    {
        $name = $_POST["login"];
        $email = $_POST["email"];
        $phon = $_POST["phon"];

        $kolit = $_POST["kolit"];
        $tibum = $_POST["tibum"];
        $cvet = $_POST["cvet"];
        $sizebum = $_POST["sizebum"];
        $srok = $_POST["srok"];

        $data = [];
        array_push($data, $kolit, $tibum, $cvet, $sizebum, $srok);

        $info = serialize($data);

        $db = getDbInstance();
        $datat = date('d.m.y H:i');

            $db->query("INSERT INTO zayavki
            ( `name`, `email`, `phon`,  `created_at`, `info`,`tip`)
            VALUES
            ('".$name."','".$email."','".$phon."','".$datat."','".$info."','vizitka')");

           $json = '{
                "status":"success"
            }';


            //require_once 'send.php';
            //sendmessage("glushok19999@gmail.com");
            echo $json;
    }

    if ($_POST["id"] == "listovki")
    {
        $name = $_POST["login"];
        $email = $_POST["email"];
        $phon = $_POST["phon"];

        $kolit = $_POST["kolit"];
        $tibum = $_POST["tibum"];
        $cvet = $_POST["cvet"];
        $sizebum = $_POST["sizebum"];
        $srok = $_POST["srok"];

        $data = [];
        array_push($data, $kolit, $tibum, $cvet, $sizebum, $srok);

        $info = serialize($data);

        $db = getDbInstance();
        $datat = date('d.m.y H:i');

            $db->query("INSERT INTO zayavki
            ( `name`, `email`, `phon`,  `created_at`, `info`,`tip`)
            VALUES
            ('".$name."','".$email."','".$phon."','".$datat."','".$info."','listovki')");

           $json = '{
                "status":"success"
            }';

            //require_once 'send.php';
            //sendmessage("glushok19999@gmail.com");
            echo $json;
    }

    if ($_POST["id"] == "petchat")
    {
        $name = $_POST["login"];
        $email = $_POST["email"];
        $phon = $_POST["phon"];

        $petchat_tip = $_POST["petchat_tip"];
        $osnastka = $_POST["osnastka"];
        $avt_osnastka = $_POST["avt_osnastka"];
        $srok = $_POST["srok"];

        $data = [];
        array_push($data, $petchat_tip, $osnastka, $avt_osnastka,  $srok);

        $info = serialize($data);

        $db = getDbInstance();
        $datat = date('d.m.y H:i');

            $db->query("INSERT INTO zayavki
            ( `name`, `email`, `phon`,  `created_at`, `info`,`tip`)
            VALUES
            ('".$name."','".$email."','".$phon."','".$datat."','".$info."','petchat')");

           $json = '{
                "status":"success"
            }';

            //require_once 'send.php';
            //sendmessage("glushok19999@gmail.com");
            echo $json;
    }

    if ($_POST["id"] == "petfoto")
    {
        $name = $_POST["login"];
        $email = $_POST["email"];
        $phon = $_POST["phon"];

        $sizebum = $_POST["sizebum"];
        $tibum = $_POST["tibum"];
        $kolit = $_POST["kolit"];
        $srok = $_POST["srok"];

        $data = [];
        array_push($data, $sizebum, $tibum, $kolit,  $srok);

        $info = serialize($data);

        $db = getDbInstance();
        $datat = date('d.m.y H:i');

            $db->query("INSERT INTO zayavki
            ( `name`, `email`, `phon`,  `created_at`, `info`,`tip`)
            VALUES
            ('".$name."','".$email."','".$phon."','".$datat."','".$info."','petfoto')");

           $json = '{
                "status":"success"
            }';


            echo $json;
    }

    if ($_POST["id"] == "ОБРАТНАЯ СВЯЗЬ")
    {
        $name = $_POST["login"];
        $email = $_POST["email"];
        $phon = $_POST["phon"];

        $vid = $_POST["vid"];
        $srok = $_POST["srok"];



        $db = getDbInstance();
        $datat = date('d.m.y H:i');

            $db->query("INSERT INTO zayavki
            ( `name`, `email`, `phon`,  `created_at`, `info`,`tip`,`kwiz_vid`,`kwiz_srok`)
            VALUES
            ('".$name."','".$email."','".$phon."','".$datat."','ОБРАТНАЯ СВЯЗЬ','ОБРАТНАЯ СВЯЗЬ','".$vid."','".$srok."')");

           $json = '{
                "status":"success"
            }';

            echo $json;
    }

    if ($_POST["id"] == "штендер")
    {
        $name = $_POST["name"];
        $email = $_POST["email"];
        $phon = $_POST["phone"];

        $name1 = $_POST["name1"];
        $zv1 = $_POST["zv1"];
        $ye1 = $_POST["ye1"];
        $name2 = $_POST["name2"];
        $zv2 = $_POST["zv2"];
        $ye2 = $_POST["ye2"];
        $flret = $_POST["flret"];
        $format = $_POST["format"];
        $template = $_POST["template"];
        $screenimg_ext = $_POST["screenimg_ext"];
        $photo1img_ext = $_POST["photo1img_ext"];
        $photo2img_ext = $_POST["photo2img_ext"];
        $screenimg = $_POST["screenimg"];
        $photo1img = $_POST["photo1img"];
        $photo2img = $_POST["photo2img"];

        $unid = uniqid();
        $url_screenimg = '';
        if ($screenimg != null){
            list($type, $screenimg) = explode(';', $screenimg);
            list(, $screenimg)      = explode(',', $screenimg);
            $screenimg = base64_decode($screenimg);
            $url_screenimg = 'upload/shtender_scrin/'.$unid .'.'.$screenimg_ext.'';
            file_put_contents($url_screenimg , $screenimg);
            $url_screenimg = "/".$url_screenimg;
        }
        $url_photo1img = '';
        if ($photo1img != null){
            list($type, $photo1img) = explode(';', $photo1img);
            list(, $photo1img)      = explode(',', $photo1img);
            $photo1img = base64_decode($photo1img);
            $url_photo1img = 'upload/shtender_img1/'.$unid.'.'.$photo1img_ext.'';
            file_put_contents($url_photo1img , $photo1img);
            $url_photo1img = "/".$url_photo1img;
        }
        $url_photo2img = '';
        if ($photo2img != null){
            list($type, $photo2img) = explode(';', $photo2img);
            list(, $photo2img)      = explode(',', $photo2img);
            $photo2img = base64_decode($photo2img);
            $url_photo2img = 'upload/shtender_img2/'.$unid.'.'.$photo2img_ext.'';
            file_put_contents($url_photo2img, $photo2img);
            $url_photo2img = "/".$url_photo2img;
        }


        $data = [];
        array_push($data, $name1, $zv1, $ye1,  $name2, $zv2, $ye2, $flret,  $format, $template, $url_screenimg, $url_photo1img, $url_photo2img);

        $info = serialize($data);

        $db = getDbInstance();
        $datat = date('d.m.y H:i');

            $db->query("INSERT INTO zayavki
            ( `name`, `email`, `phon`,  `created_at`, `info`,`tip`)
           VALUES
            ('".$name."','".$email."','".$phon."','".$datat."','".$info."','штендер')");
    }
    
    if ($_POST["id"] == "kalendari")
    {
        $name = $_POST["login"];
        $email = $_POST["email"];
        $phon = $_POST["phon"];

        $kolit = $_POST["kolit"];
        $vid = $_POST["vid"];
        $srok = $_POST["srok"];

        $data = [];
        array_push($data, $vid, $srok);

        $info = serialize($data);

        $db = getDbInstance();
        $datat = date('d.m.y H:i');

        $db->query("INSERT INTO zayavki
        ( `name`, `email`, `phon`,  `created_at`, `info`,`tip`)
        VALUES
        ('".$name."','".$email."','".$phon."','".$datat."','".$info."','Календари')");

        $json = '{
            "status":"success"
        }';

        echo $json;
    }

    if ($_POST["id"] == "order-kalkulator")
    {
        $name = $_POST["fio"];
        $email = $_POST["email"];
        $phone = $_POST["phone"];
        $idOrder = $_POST["id-order"];

        $db = getDbInstance();
        $datat = date('d.m.y H:i');

        $db->query("INSERT INTO zayavki
        ( `name`, `email`, `phon`, `created_at`, `comment`,`tip`)
        VALUES
        (
            '".$name."',
            '".$email."',
            '".$phone."',
            '".$datat."',
            'Чек в заявках № ".$idOrder."',
            'С калькулятора')"
        );

        $json = '{
            "status":"success"
        }';

        echo $json;
    }

    require_once 'send.php';

    sendmessage("info@copymaster.biz");
    sendmessage("Manager@copymaster.biz");
    sendmessage("design@copymaster.biz");
}
