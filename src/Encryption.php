<?php
/**
 * api加密解密类
 */
namespace safe;
class Encryption{

    
    private $priKey ;//openssl 私钥
    private $pubKey;  //openssl 公钥

    public  function __construct() {
        $this->priKey =  openssl_pkey_get_private(file_get_contents(__DIR__.'/../conf/openssl/rsa_private_key.pem')) ;
        
        $this->pubKey  = openssl_pkey_get_public(file_get_contents(__DIR__.'/../conf/openssl/rsa_public_key.pem'));
    }
	
    /**
     * 业务验签 对数组的参数进行签名
     * @param string $method（采用md5签名）
     * @param array $arrInput
     * @param string $signKey
     * @return string
    */
    public  function signArray( $arrInput, $signKey)
    {
        $arrInput = ksort ($arrInput);
        $signStr = '';
        foreach ($arrInput as $key => $val) {
            $signStr .= '&'.$key.'='.$val;
        }
        $signStr = substr($signStr, 1);
        $signStr = $signStr.'&key='.$signKey;
        $sign = md5($signStr);
        return $ret;
    }

   
    //公钥加密
    public function  jiami($data){
        $encrypt_data = '';  
       openssl_public_encrypt($data, $encrypt_data, $this->pubKey); 
        $encrypt_data = base64_encode($encrypt_data);  
        return  $encrypt_data;
    }
    //私钥解密
    public function jiemi($encrypt_data){       
        $encrypt_data = base64_decode($encrypt_data); 
        openssl_private_decrypt($encrypt_data, $decrypt_data, $this->priKey);
        return $decrypt_data;
    }
    
    

}