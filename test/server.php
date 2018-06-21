<?php
 //放到最外层
require_once __DIR__ . '/../vendor/autoload.php';  
use Safe\Verification;  

$mod    = new Verification('helloword', 60); //秘钥和过期时间

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