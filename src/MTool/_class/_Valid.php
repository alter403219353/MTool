<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/9
 * Time: 17:07
 */

namespace MTool\_class;


class _Valid
{
    /**
     * 校验日期格式是否正确
     *
     * @param string $date 日期
     * @param string $formats 需要检验的格式数组
     * @return boolean
     */
    public function checkDateIsValid($date, $formats = array("Y-m-d", "Y/m/d")) {
        $unixTime = strtotime($date);
        if (!$unixTime) { //strtotime转换不对，日期格式显然不对。
            return false;
        }

        //校验日期的有效性，只要满足其中一个格式就OK
        foreach ($formats as $format) {
            if (date($format, $unixTime) == $date) {
                return true;
            }
        }

        return false;
    }

    /**
     * 判断两个日期是否在指定的时间范围内(默认1天)
     * @param $one_date_val
     * @param $two_date_val
     * @param array $formats
     */
    public function checkTwoDateIsValid($one_date_val,$two_date_val,$second,$formats = array("Y-m-d", "Y/m/d")){

        $one_date = $this->checkDateIsValid($one_date_val,$formats);

        $two_date = $this->checkDateIsValid($two_date_val,$formats);

        if($one_date && $two_date) {

            if (strtotime($two_date_val) > strtotime($one_date_val)) {

                $diff_second  =  floor((strtotime($two_date_val) - strtotime($one_date_val))%86400%60);

                if($second >= $diff_second){

                    return ['status'=>true,'message'=>'验证通过'];

                }else{

                    return ['status'=>false,'message'=>'输入的结束时间应大于'.$second.'秒'];
                }
            }else{

                return ['status'=>false,'message'=>'输入的结束时间比开始时间早'];
            }
        }else{

            return ['status'=>false,'message'=>'输入的两个日期格式不正确'];
        }
    }
}