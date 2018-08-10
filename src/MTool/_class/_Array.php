<?php
namespace MTool\_class;
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/9
 * Time: 11:38
 */
class _Array
{

    /**数组过滤查询
     * @param $data  数组
     * @param $arg  参数
     * @param bool $is_keep_index 是否保留索引
     * @return array
     */
    public function _filter($data,$arg,$is_keep_index = true){

        switch (gettype($arg)){
            case 'array':
                return $this->_filter_array($data,$arg,$is_keep_index);
            case 'object':
                return $this->_filter_object($data,$arg);
                break;
            default:
                break;
        }
        return $data;
    }

    /**过滤数组对象
     * @param $data
     * @param $arg
     * @return array
     */
    private function _filter_array($data,$arg,$is_keep_index){

        $_list    = [];

        $_arg_num = count($arg);

        foreach ($data as $k=>$v){

            $_filter_num = 0;

            foreach ($arg as $kn =>$vo){

                if(isset($v[$kn]) && $v[$kn] == $vo){

                    $_filter_num+=1;
                }
            }

            if($_filter_num == $_arg_num){
                if($is_keep_index){
                    $_list[$k] = $v;
                }else{
                    $_list[] = $v;
                }
            }
        }

        return $_list;
    }

    /**
     * 过滤对象类型
     */
    private function _filter_object($data,$arg){

        $_list    = [];

        foreach ($data as $k=>$v){
            if($arg($k,$v)){
                $_list[] = $v;
            }
        }

        return $_list;
    }

    /**删除数组
     * @param $data
     * @param $data_arg
     * @return array
     */
    public function _remove($data,$data_arg){

        $_that  =  __CLASS__;

        $_list  = array_udiff($data,$data_arg,array($_that,"_call_udiff"));

        return $_list;
    }

    /**数组差集比较
     * @param $data1
     * @param $data2
     * @return int
     */
    public function _call_udiff($data1,$data2)
    {
        if ($data1===$data2)
        {
            return 0;
        }
        return ($data1>$data2)?1:-1;
    }

    /**根据两个数组的条件来修改要修改的数组,返回第一个数组修改的数据(仅支持两个数组层级是一层)
     * @param $data1   数组1
     * @param $data2   数组2
     * @param $where   条件路径   ['id=>id',*] //多个数组条件  id 为键名
     * @param $mod_data 要修改的字段数据  ['stauts'=>1,'delete'=>1] 数字不区分条件  ['stauts'=>[1,0],'delete'=>[1,0]]   数组按条件区分 数组[0] 匹配条件 数组[1] 不匹配条件
     */
    public function _mod_filter($data1,$data2,$where,$mod_data){

        $_where_num     = count($where);

        $_arr_filter_num = [];

        foreach ($where as $kn =>$vo){

            $arr            = [];

            if($this->_str_has("=>",$vo)){

                $arr        = explode("=>",$vo);
            }

            if($arr){

                foreach ($data1 as $k1=>$v1){

                    foreach ($data2 as $k2=>$v2){

                        if( $v1[$arr[0]] == $v2[$arr[1]] ){

                            if(isset($_arr_filter_num[$k1])){

                                $_arr_filter_num[$k1] +=1;

                            }else{

                                $_arr_filter_num[$k1] =1;
                            }
                            break;
                        }
                    }
                }

            }
        }

        foreach ($data1 as $kv=>$vdata){

            $flag = false;

            if(isset($_arr_filter_num[$kv]) && $_arr_filter_num[$kv] == $_where_num){

                $flag = true;
            }

            foreach ( $mod_data as $k3=>$v3){

                if(is_numeric($v3)){

                    $data1[$kv][$k3] = $v3;

                }else if(is_array($v3)){

                    if($flag && isset($v3[0])){

                        $data1[$kv][$k3] = $v3[0];

                    }else if($flag == false && isset($v3[1]) ){

                        $data1[$kv][$k3] = $v3[1];
                    }
                }
            }
        }

        return $data1;
    }

    private function _str_has($needle,$str){

        if(strpos($str,$needle) !==false){

            return  true;

        }

        return false;
    }

    /**数组回调循环
     * @param $data
     * @param $arg
     * @return mixed
     */
    public function _forEach($data,$arg){

        if(gettype($arg) == "object"){

            foreach ($data as $k=>$v){

                $arg($k,$v);
            }
        }

        return $data;
    }


    /**数组排序
     * @param $data  数组
     * @param $arg   排序参数
     * @param bool $is_keep_index   是否保留索引
     * @return mixed
     */
    public function _sortBy($data,$arg,$is_keep_index = true){


        if(gettype($arg) == "array"){

            if($is_keep_index){

                $_data               = $data;

                $keysvalue           = [];

                $new_array           = [];

                foreach ($arg as $key=>$val){

                    $keysvalue  =  array_column($_data, $key);

                    if($val == 'desc'){

                        arsort($keysvalue);

                    }else if($val == 'asc'){

                        asort($keysvalue);
                    }

                    reset($keysvalue);

                    foreach ($keysvalue as $k=>$v){
                        $_data[$k] = $data[$k];
                    }
                }

                foreach ($keysvalue as $k=>$v){
                    $new_array[$k] = $data[$k];
                }

                return $new_array;

            }else{

                $multisort_args      = [];

                $_data               = $data;

                foreach ($arg as $key=>$val){

                    $multisort_args[] = array_column($_data, $key);

                    if($val == 'desc'){

                        $multisort_args[] = SORT_DESC;

                    }else if($val == 'asc'){

                        $multisort_args[] = SORT_ASC;

                    }else{

                        $multisort_args[] = SORT_ASC;
                    }
                }

                $multisort_args[] = &$_data;

                call_user_func_array('array_multisort',$multisort_args);

                return array_pop($multisort_args);

            }
        }

        return $data;
    }
}