<?php
/**
 * Created by PhpStorm.
 * User: jerryzst
 * Date: 2019/9/2 0002
 * Time: 15:04
 */

namespace easywa\wapay\Common;


interface BaseHandle
{
    public function handle(array $data);
}