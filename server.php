<?php
function myLoader($class){
    $class = str_replace('\\','/',$class);
    require __DIR__ . '/' . $class . '.php';
}
spl_autoload_register('myLoader');

$mod    = new \libs\Safe();

// $time = time();
// $time  = 1528798567;
// echo '<pre>';
// echo $time ;
// echo '<hr>';
// $arr = array(
// 	'id'    =>123,
// 	'name'  =>'hello',
// 	'sex'   =>'boy',
// 	'age'   =>23, 
// 	'timeStamp' =>$time
//  );
// $sign = $mod->getSign($arr);
// echo $sign;

// $arr['sign'] = $sign;

// print_r($mod->checkData($arr));
// 
print_r($_POST);
print_r($mod->checkData($_POST));