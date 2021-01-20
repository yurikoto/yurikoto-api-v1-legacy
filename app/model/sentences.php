<?php
namespace app\model;
use core\base\model;

class sentences extends model{
    /**
     * sentences constructor.
     */
    public function __construct(){
        $this->table = DB_PREFIX . 'sentences';
    }

    /**
     * 随机获取一条记录
     * @return array
     */
    public function get_rand(){
        $sql = "SELECT * FROM " . $this->table . " AS t1 JOIN (SELECT ROUND(RAND() * ((SELECT MAX(id) FROM " . $this->table . ")-(SELECT MIN(id) FROM " . $this->table . ")) + (SELECT MIN(id) FROM " . $this->table . ")) AS id) AS t2 WHERE t1.id >= t2.id ORDER BY t1.id LIMIT 1;";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll()[0];
    }
}