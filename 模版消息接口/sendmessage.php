<?php
/*
 *获取微信token
*/
/*$appid="wx78478e595939c538";
$secret="5540e8ccab4f71dfad752f73cfb85780";
$url="https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$appid."&secret=".$secret."";

//$token=(array)json_decode(file_get_contents($url));

$output=gettoken($url);

$token=(array)json_decode($output);
*/
$token="YdNlREj0nrgh4WeP1SYB2gGiejBw98-qYnzRe-h49J5VLbu4xsmKaoyIslAaK3zxOrE7Gy6nR9vxh4VBxh_kJV3HV-gkONlgqSLdjWbMt6w";
//print_r($token);
//echo $token['access_token'];

$openid="";
$url='';
$date=
'{
	"touser":"'.$openid.'",
	"template_id":"PA-8HdWXmpu7NiP6XOyKy6lDpUtFySnCRutAcY3oUYM",
	"url":"'.$url.'",
	"topcolor":"#FF0000",
	"data":{
			"first": {
			"value":"您好，您收到了新消息。",
			"color":"#b81919"
			},
			"keynote1":{
			"value":"极客学院",
			"color":"#173177"
			},
			"keynote2":{
			"value":"'.date("Y-m-d H:i:s",time()).'",
			"color":"#173177"
			},
			"remark":{
			"value":"\n\t您好，极客学院微信公众平台高级接口视频教程已上线，欢迎您的收看",
			"color":"#173177"
			}
		}
}
';
$sendurl="https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=".$token."";
$sendarr=(array)json_decode(getshort($date,$sendurl));
print_r($sendarr);


function getshort($data,$url){
	 $ch = curl_init();
	 curl_setopt($ch, CURLOPT_URL, $url);
	 curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
	 curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	 curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
	 curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
	 curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	 curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
	 curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	 $tmpInfo = curl_exec($ch);
	 if (curl_errno($ch)) {
	  return curl_error($ch);
	 }
	 curl_close($ch);
	 return $tmpInfo;
}
?>