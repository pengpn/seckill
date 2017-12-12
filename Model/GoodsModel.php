<?php
/**
 * Created by PhpStorm.
 * User: pengpn
 * Date: 2017/12/12
 * Time: 下午10:41
 */

class GoodsModel extends Model
{
    /*
     * 获取商品信息
     */
    public function getGoods($id)
    {
        $sql = "SELECT * FROM goods WHERE id = " . $id;
        $result = $this->query($sql);
        if ($result[0]) {
            return $result[0];
        } else {
            return false;
        }
    }

    /*
     * 获取所有商品信息
     */
    public function getGoodses()
    {
        $sql = "SELECT * FROM goods";
        $result = $this->query($sql);
        return $result;
    }

    /*
     * 更新商品库存
     */
    public function setGoodsCount($gid,$count)
    {
        $sql = 'UPDATE goods SET counts = ' . $count . ' WHERE id = ' . $gid;
        $result = $this->exec($sql);
        return $result;
    }
}