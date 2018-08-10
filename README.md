这是一个常用的php工具类

``` php5
use MTool\MToolBase;

//数组类常用方法

            $MToolBase = new MToolBase();

            $data[3] =[
                'id'    =>1,
                'name' =>'test1',
                'type' =>1,
            ];

            $data[4] =[
                'id'    =>2,
                'name' =>'test2',
                'type' =>1,
            ];

            $data[5] =[
                'id'    =>3,
                'name' =>'test3',
                'type' =>2,
            ];

            $data1 = [

                [
                    'id'    =>1,
                    'name' =>'test1',
                ],
                [
                    'id'    =>2,
                    'name' =>'test2',
                ]

            ];

            //过滤条件返回结果(默认为保留索引)
            $r1 = $MToolBase->_Array()->_filter($data,['type'=>1]);

            print_r($r1);

            //过滤条件返回结果)不保留索引)
            $r2 = $MToolBase->_Array()->_filter($data,['type'=>1],false);

            print_r($r2);

            //回调过滤条件(保留索引)
            $r3 = $MToolBase->_Array()->_filter($data,function ($k,$v){

                    return $v['type'] == 1;
            });

            print_r($r3);

            //回调过滤条件(不保留索引)
            $r4 = $MToolBase->_Array()->_filter($data,function ($k,$v){

                return $v['type'] == 1;

            },false);

            print_r($r4);

            //删除数组(数组为$r3)
            $r5  = $MToolBase->_Array()->_remove($data,$r3);

            print_r($r5);

            /**根据两个数组的条件来修改要修改的数组,返回第一个数组修改的数据(仅支持两个数组层级是一层)
             * @param $data   数组1
             * @param $data1  数组2
             * @param $where   条件路径   ['id=>id',*] //多个数组条件     数组1(键值)=>数组2(键值)=,*  id 为键名
             * @param $mod_data 要修改的字段数据  ['stauts'=>1,'delete'=>1] 数字不区分条件  ['stauts'=>[1,0],'delete'=>[1,0]]   数组按条件区分 数组[0] 匹配条件 数组[1] 不匹配条件
             */

            $where     = ["id=>id"];

            $mod_data = ["status"=>[1,0],'delete'=>1];

            $r6  = $MToolBase->_Array()->_mod_filter($data,$data1,$where,$mod_data);

            print_r($r6);

            //数组排序(默认为保留索引) 排序参数 desc  升序  asc 降序
            $r7   = $MToolBase->_Array()->_sortBy($data,['id'=>'desc']);

            print_r($r7);

            $r8   = $MToolBase->_Array()->_sortBy($data,['id'=>'desc'],false);

            print_r($r8);
```
