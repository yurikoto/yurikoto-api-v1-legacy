<?php
namespace app\model;
use core\base\model;

class wallpapers extends model{
    /**
     * wallpapers constructor.
     */
    public function __construct(){
        $this->table = DB_PREFIX . 'wallpapers';
    }

    /**
     * 随机获取指定类型的一条记录
     * @param $type string 类型
     * @return mixed
     */
    public function get_rand_by_type($type){
        // $sql = "SELECT * FROM " . $this->table . " AS t1 JOIN (SELECT ROUND(RAND() * ((SELECT MAX(id) FROM " . $this->table . " WHERE type = ?) - (SELECT MIN(id) FROM " . $this->table . " WHERE type = ?)) + (SELECT MIN(id) FROM " . $this->table . " WHERE type = ?)) AS id) AS t2 WHERE t1.id >= t2.id ORDER BY t1.id LIMIT 1;";
        $sql = "SELECT * FROM " . $this->table . " WHERE type = ? ORDER BY RAND() LIMIT 1";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$type]);
        return $stmt->fetchAll()[0];
    }

    /**
     * 随机获取一条记录
     * @param $type string 类型
     * @return mixed
     */
    public function get_rand(){
        $sql = "SELECT * FROM " . $this->table . " AS t1 JOIN (SELECT ROUND(RAND() * ((SELECT MAX(id) FROM " . $this->table . ") - (SELECT MIN(id) FROM " . $this->table . ")) + (SELECT MIN(id) FROM " . $this->table . ")) AS id) AS t2 WHERE t1.id >= t2.id ORDER BY t1.id LIMIT 1;";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll()[0];
    }
}