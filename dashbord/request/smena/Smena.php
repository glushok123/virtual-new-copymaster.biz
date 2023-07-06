<?
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');

session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/config.php';

class Smena {
    public $db;
    public $arrayInfo = [];
    public $buttonAction = '<button type="button" class="btn btn-outline-danger">Закрыть</button>';

    public function __construct() {
        $this->db = getDbInstance();
    }
    
    /**
     * Информация для таблицы смен
     *
     */
    public function getArrayInfoForTable()
    {
        $res = $this->db->query("SELECT * FROM `smena`");
        $action = '';

        foreach($res as $item) {
            $type = $item['type'] == 0 ? "Ночь" : "День";

            if (!empty($item['date_start'])) {
                $dateStart = new \DateTime($item['date_start']);
                $dateStart = $dateStart->format('Y-m-d H:i:s');
            }else {
                $dateStart = '';
            }

            if (!empty($item['date_end'])) {
                $dateEnd = new \DateTime($item['date_end']);
                $dateEnd = $dateEnd->format('Y-m-d H:i:s');
            }else {
                $dateEnd = '';
            }

            if (empty($dateEnd)) {
                $action = '<button type="button" class="btn btn-outline-danger">Закрыть</button>';
            }

            $this->arrayInfo[] = [
                $item['id'],
                $type,
                $dateStart,
                $dateEnd,
                '
                <table class="table">
                    <tr>
                        <td>Тип</td>
                        <td>Количество</td>
                    </tr>
                    <tr>
                        <td>594</td>
                        <td>' . $item['type_594'] . '</td>
                    </tr>
                    <tr>
                        <td>914</td>
                        <td>' . $item['type_914'] . '</td>
                    </tr>
                    <tr>
                        <td>610(м)</td>
                        <td>' . $item['type_610_m'] . '</td>
                    </tr>
                    <tr>
                        <td>841</td>
                        <td>' . $item['type_841'] . '</td>
                    </tr>
                    <tr>
                        <td>1060 (м)</td>
                        <td>' . $item['type_1060_м'] . '</td>
                    </tr>
                    <tr>
                        <td>420</td>
                        <td>' . $item['type_420'] . '</td>
                    </tr>
                    <tr>
                        <td>297</td>
                        <td>' . $item['type_297'] . '</td>
                    </tr>
                    <tr>
                        <td>A4</td>
                        <td>' . $item['type_A4'] . '</td>
                    </tr>
                    <tr></tr>
                        <td>A3</td>
                        <td>' . $item['type_A3'] . '</td>
                    </tr>
                </table>
                ',
                //$item['comment_end'],
                $item['user_created'],
                //$action
            ];
        }

        return json_encode($this->arrayInfo);
    }


    /**
     * @param string $comment
     * 
     * @return [type]
     */
    public function createSmena(array $request) 
    {
        $date = date('d.m.y H:i');
        $type = '';

        $type = $request['formOpenType'] == 'День' ? 1 : 0;

        $res = $this->db->query("SELECT * FROM `smena` WHERE ISNULL(date_end)");

        foreach ($res as $item) {
            $this->db->query("
                UPDATE smena
                SET 
                date_end='" . $date . "'
                WHERE id=" . $item['id'] . "
            ");
        }

        $this->db->query("INSERT INTO smena
            ( 
                `type`, 
                `date_start`, 
                `date_end`, 
                `date_created`, 
                `user_created`,
                `type_594`,
                `type_914`,
                `type_610_m`,
                `type_841`,
                `type_1060_м`,
                `type_420`,
                `type_297`,
                `type_A4`,
                `type_A3`
            )
            VALUES
            (
                '" . $type . "',
                '" . $date . "', 
                null,
                '" . $date . "', 
                '" . $_SESSION['login'] . "',
                '" .  $request['type_594'] . "',
                '" .  $request['type_914'] . "',
                '" .  $request['type_610_m'] . "',
                '" .  $request['type_841'] . "',
                '" .  $request['type_1060_м'] . "',
                '" .  $request['type_420'] . "',
                '" .  $request['type_297'] . "',
                '" .  $request['type_A4'] . "',
                '" .  $request['type_A3'] . "'
            )");

        return json_encode([
            'status' => "success"
        ]);
    }

    /**
     * @param string $comment
     * 
     * @return [type]
     */
    public function closeSmena(string $comment) 
    {
        //
    }
}