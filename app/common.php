<?php
/**
 * Created by PhpStorm.
 * User: pengpn
 * Date: 2017/12/12
 * Time: 下午9:49
 */

class Common
{
    protected function render($view = '', $data = [])
    {
        $viewPath = SEC_ROOT_PATH . '/view/';
        $viewFile = $viewPath . ($view ? $view : CONTROLLER . '/' . ACTION ) . '.php';

        if (is_file($viewFile)) {
            //页面缓存
            ob_start();
            ob_implicit_flush(0);
            // 模板阵列变量分解成为独立变量
            extract($data , EXTR_OVERWRITE);
            include $viewFile;

            //获取并清空缓存
            $content = ob_get_clean();
            echo $content;
        } else {
            throw new Exception("模板文件不存在");
        }

    }


}