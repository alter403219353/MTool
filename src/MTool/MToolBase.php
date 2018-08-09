<?php
namespace MTool;
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/9
 * Time: 11:37
 */
use MTool\_class\_Array;
use MTool\_class\_Valid;

class MToolBase
{
    public function  __construct()
    {
        $this->_Version = "1.0.3";
    }

    /**数组类
     * @return _Array
     */
    public function _Array(){

        if (!isset($this->_Array)) {
            $this->_Array = new _Array();
        }
        return  $this->_Array;
    }

    /**验证类
     * @return _Valid
     */
    public function _Valid(){

        if (!isset($this->_Valid)) {
            $this->_Valid = new _Valid();
        }
        return  $this->_Valid;
    }
}