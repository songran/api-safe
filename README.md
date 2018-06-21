引入
composer require songran/api-safe dev-master



# api_verifycation

描述：api接口安全 验证接口
	1.实现业务验签 签名秘钥
	2.实现防刷    时间戳




# api_encryption
RSA密钥生成命令 （后期使用）

1、生成RSA私钥
openssl>genrsa -out rsa_private_key.pem 1024
	得到exponent: 65537

2、生成modulus:
openssl>rsa -in rsa_private_key.pem  -modulus  -out rsa_moules.pem

3、生成RSA公钥
openssl>rsa -in rsa_private_key.pem -pubout -out rsa_public_key.pem

注意：“>”符号后面的才是需要输入的命令。
 
 

