<?php
/**
 * Created by PhpStorm.
 * User: jerryzst
 * Date: 2019/9/2 0002
 * Time: 14:56
 */

namespace easywa\wapay\Common;


abstract class ConfigInterface
{
    public function toArray()
    {
        return get_object_vars($this);
    }
}