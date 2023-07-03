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
                $type,
                $dateStart,
                $dateEnd,
                $item['comment_start'],
                $item['comment_end'],
                $action
            ];
        }

        return json_encode($this->arrayInfo);
    }


    /**
     * @param string $comment
     * 
     * @return [type]
     */
    public function createSmena(string $comment) 
    {
        //
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