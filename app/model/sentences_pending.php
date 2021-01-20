<?php
namespace app\model;
use core\base\model;

class sentences_pending extends model{
    /**
     * sentencePending model constructor.
     */
    public function __construct(){
        $this->table = DB_PREFIX . 'sentences_pending';
    }

    /**
     * 添加记录
     * @param $fingerprint string 用户指纹
     * @param $content string 台词内容
     * @param $source string 台词来源
     * @param $email string 发送者邮箱
     * @param $ip string 发送者ip
     */
    public function add($fingerprint, $content, $source, $email, $ip){
        $sql = "INSERT INTO " . $this->table . "(fingerprint, content, source, email, ip) VALUES (?, ?, ?, ?, ?);";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$fingerprint, $content, $source, $email, $ip]);
    }
}