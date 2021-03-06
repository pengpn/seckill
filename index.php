<?php
/**
 * 系统入口文件
 * 访问模式：
 * http://ip/index.php?app=app&c=order&a=buypub
 * Created by PhpStorm.
 * User: pengpn
 * Date: 2017/12/12
 * Time: 下午9:42
 */

include 'Common/bootstrap.php';

$app             = isset($_GET['app']) ? $_GET['app'] : 'app';
$controller      = isset($_GET['c']) ? $_GET['c'] : 'goods';
$action          = isset($_GET['a']) ? $_GET['a'] : 'goodsList';
$file            = SEC_ROOT_PATH . DIRECTORY_SEPARATOR . $app . DIRECTORY_SEPARATOR . $controller . '.php';

if (is_file($file)) {

    defined('APP') or define('APP',$app);
    defined('CONTROLLER') or define('CONTROLLER', $controller);
    defined('ACTION') or define('ACTION', $action);

    include $file;

    $appClass = new $controller();
    $appClass->$action();
} else {
    throw new Exception('应用错误',1);
}