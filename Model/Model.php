<?php
/**
 * Model驱动类 需要安装pdo扩展
 * Created by PhpStorm.
 * User: pengpn
 * Date: 2017/12/12
 * Time: 下午10:45
 */

class Model
{
    private $_pdo = null;

    public function __construct()
    {
        if ($this->_pdo == null) {
            $conn = 'mysql:host=127.0.0.1;dbname=seckill';
            try{
                $this->_pdo = new PDO($conn,'root','root');
            }catch (PDOException $exception) {
                echo '数据库连接失败' . $exception->getMessage();
                exit;
            }
        }
    }

    public function getConnection()
    {
        return $this->_pdo;
    }

    /*
     * 查询sql
     */
    public function query($sql)
    {
        $handel = $this->_pdo->query($sql);
        $result = [];
        foreach ($handel as $row) {
            $result[] = $row;
        }

        return $result;
    }

    /*
     * 执行sql
     */
    public function exec($sql)
    {
        $result = $this->_pdo->exec($sql);
        return $result;
    }

}