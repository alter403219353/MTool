<?php
namespace MTool;
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/9
 * Time: 11:37
 */
use MTool\_class\_Array;

class MToolBase
{
    public function  __construct()
    {
        $this->_Array = new _Array();
        $this->_Version = "1.0";
    }

    /**数组类
     * @return _Array
     */
    public function _Array(){

        return  $this->_Array;
    }
}