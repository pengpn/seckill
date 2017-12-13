<?php
/**
 * Created by PhpStorm.
 * User: pengpn
 * Date: 2017/12/12
 * Time: 下午10:30
 */
class Goods extends Common
{
    private $_goodsModel = null;
    private $_redis = null;

    public function __construct()
    {
        if ($this->_goodsModel === null) {
            $this->_goodsModel = new GoodsModel();
        }

        if ($this->_redis === null) {
            $this->_redis = new QRedis();
        }
    }

    //查看商品列表
    public function goodsList()
    {
        $lists = $this->_goodsModel->getGoodses();
        $redis = $this->_redis;
        foreach ($lists as $key => &$value) {
            $id = $value['id'];
            $key = 'goods_list_' . $id;
            $count = $redis->listcount($key);
            $value['rediscount'] = $count;

        }
        $this->render('',['list' => $lists]);
    }

    //设置商品库存
    public function setGoodsCount()
    {
        $gid = $_POST['gid'];
        $count = $_POST['counts'];
        $goodsInfo = $this->_goodsModel->getGoods($gid);

        if ($goodsInfo) {
            $id = $goodsInfo['id'];
            $result = $this->_goodsModel->setGoodsCount($id, $count);
            if ($result) {
                //更新redis list
                $redis = $this->_redis;
                $key = 'goods_list_' . $id;
                $redis->clearlist($key);
                for ($i = 1; $i <= $count; $i++) {
                    $redis->addRlist($key, 1);
                }
                $this->ajaxReturn(['status' => 1,'info' => '编辑成功']);
            }
        }
        $this->ajaxReturn(['status' => 0, 'info' => '编辑失败']);
    }
}