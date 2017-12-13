<?php
/**
 * Created by PhpStorm.
 * User: pengpn
 * Date: 2017/12/12
 * Time: 下午9:44
 */


defined('SEC_ROOT_PATH') or define('SEC_ROOT_PATH',dirname(dirname(__FILE__)));

include 'app/common.php';
include 'Model/Model.php';
include 'Model/GoodsModel.php';
include 'Model/OrderModel.php';
include 'Redis/QRedis.php';