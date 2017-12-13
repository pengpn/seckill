<?php
/**
 * Created by PhpStorm.
 * User: PENGPN
 * Date: 2017/12/13
 * Time: 17:22
 */
$url = 'http://seckill.app/index.php?app=app&c=seckill&a=addQsec&gid=2&type=redis';
$result = file_get_contents($url);

var_dump($result);