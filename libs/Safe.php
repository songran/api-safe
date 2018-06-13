<?php 
/**
 * 接口安全验证
 * @Author   SongRan
 */
namespace libs;
class Safe{

	private  $signKey   = 'helloword';  //秘钥
	private  $timeSpace = '60';          //时间限制 这个时间内有效

	/**
	 * 验证传入的数据  必须参数 timeStamp sign
	 * @Author   SongRan
	 * @DateTime 2018-06-12
	 * @param    [type]     $arr [要验证的数据]
	 * @return   [type]          [code msg]
	 */
	public function checkData($arr) {
  		$sign = isset($arr['sign'])?$arr['sign']:false;
  		$time = isset($arr['timeStamp'])?$arr['timeStamp']:false;
  		if(!$sign){
  			return $this->getMsg(1);
  		}
      if(!$time){
        return $this->getMsg(4); 
      }
  		// 业务验签
      
  		unset($arr['sign']);
 
  		$signTem  = $this->getSign($arr);
  		if($sign != $signTem) {
  			return $this->getMsg(3);
  		}
  		//验证时效
  		if(!$this->checkTime($time)) {
  			return $this->getMsg(2);	
  		}
  		return $this->getMsg(0);
	}

	/**
     * 业务验签 对数组的参数进行签名
     * @param string $method（采用md5签名）
     * @param array $arrInput
     * @return string
    */
    public  function getSign($arrInput)
    { 
        ksort ($arrInput);
        $signStr = '';
        foreach($arrInput as $key => $val) {
            $signStr .= '&'.$key.'='.$val;
        }
        $signStr = substr($signStr, 1);
        $signStr = $signStr.'&key='.$this->signKey;
        $sign = md5($signStr);
        return $sign;
    }

  	/**
  	 * 验证时间是否有效
  	 * @Author   SongRan
  	 * @DateTime 2018-06-12
  	 * @param    [type]     $time [时间戳]
  	 * @return   [type]           true or false
  	 */
    public function checkTime($time)
    {
      	$timeSpace = time() - $time ;
  	    if($timeSpace > $this->timeSpace){
  	  	   	return false;
  	  	}else{
  	  		return true;
  	  	}
    }

  	/**
  	 * 根据code 返回结果值
  	 * @Author   SongRan
  	 * @DateTime 2018-06-12
  	 * @param    [type]     $code [description]
  	 * @return   [type]           [description]
  	 */
    public function getMsg($code){
      	$arr = array(
      		0 =>'成功',
      		1 =>'sign不存在',
      		2 =>'时间已经过期',
      		3 =>'验证失败',
          4 =>'时间戳不存在'
      	);
      	return ['code'=>$code,'msg'=>$arr[$code]];
    }

} 