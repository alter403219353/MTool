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

            //过滤条件返回结果(默认为保留索引)
            $r1 = $MToolBase->_Array()->_filter($data,['type'=>1]);

            //不保留索引
            $r2 = $MToolBase->_Array()->_filter($data,['type'=>1],false);

            //回调过滤条件
            $r3 = $MToolBase->_Array()->_filter($data,function ($k,$v){

                    return $v['type'] == 1;
            });

            print_r($r1);
			

Array
(
    [3] => Array
        (
            [id] => 1
            [name] => test1
            [type] => 1
        )

    [4] => Array
        (
            [id] => 2
            [name] => test2
            [type] => 1
        )

)

       print_r($r2);
			
Array
(
    [0] => Array
        (
            [id] => 1
            [name] => test1
            [type] => 1
        )

    [1] => Array
        (
            [id] => 2
            [name] => test2
            [type] => 1
        )

)

     print_r($r3);
			
Array
(
    [0] => Array
        (
            [id] => 1
            [name] => test1
            [type] => 1
        )

    [1] => Array
        (
            [id] => 2
            [name] => test2
            [type] => 1
        )

)
```
