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

        
    }

    //查看商品列表
    public function goodsLists()
    {
        $lists = $this->_goodsModel->getGoodses();

        foreach ($lists as $key => &$value) {
            $id = $value['id'];
            $key = 'goods_list_' . $id;


        }

    }

    //设置商品库存
    public function setGoodsCount()
    {
        //
    }
}