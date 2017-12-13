<?php
/**
 * redis驱动类，需要安装phpredis扩展
 * Created by PhpStorm.
 * User: PENGPN
 * Date: 2017/12/13
 * Time: 10:53
 */

class QRedis
{
    private $_redis = null;

    public function __construct()
    {
        if ($this->_redis === null) {
            try{
                $redis = new Redis();
                $conn = $redis->connect('127.0.0.1',6379);
                if ($conn) {
                    $this->_redis = $redis;
                } else {
                    echo 'redis服务器无法连接';
                    $this->_redis = false;
                    exit();
                }
            }catch (RedisException $e) {
                echo "phpredis扩展没有安装:" . $e->getMessage();
            }
        }
    }

    /*
     * 队列尾追加
     */
    public function addRlist($key, $value)
    {
        $result = $this->_redis->rPush($key, $value);
        return $result;
    }
    
    /*
     * 队列头追加
     */
    public function addLlist($key, $value)
    {
        $result = $this->_redis->lPush($key, $value);
        return $result;
    }
    
    /*
     * 头出队列
     */
    public function lpoplist($key)
    {
        $result = $this->_redis->lPop($key);
        return $result;
    }
    
    /*
     * 尾出队列
     */
    public function rpoplist($key)
    {
        $result = $this->_redis->rPop($key);
        return $result;
    }

    /*
     * 查看队列
     */
    public function showlist($key)
    {
        $result = $this->_redis->lRange($key, 0, -1);
        return $result;
    }

    /*
     * 队列数量
     */
    public function listcount($key)
    {
        $result = $this->_redis->lSize($key);
        return $result;
    }

    /*
     * 清空队列
     */
    public function clearlist($key)
    {
        $result = $this->_redis->delete($key);
        return $result;
    }

    /*
     * 获取redis资源对象
     */
    public function getConnection()
    {
        return $this->_redis;
    }

    
}