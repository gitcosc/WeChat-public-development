<?php
/*
 *获取微信token
*/
$appid="wx78478e595939c538";
$secret="5540e8ccab4f71dfad752f73cfb85780";
$url="https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$appid."&secret=".$secret."";

//$token=(array)json_decode(file_get_contents($url));

$output=gettoken($url);

$token=(array)json_decode($output);

$token=$token['access_token'];
//print_r($token);
//echo $token['access_token'];
$date='{"action_name": "QR_LIMIT_SCENE", "action_info": {"scene": {"scene_id": 100}}}';
$erweimaurl="https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token=".$token."";
$erweimaarr=(array)json_decode(getshort($date,$erweimaurl));
//echo $erweimaarr['ticket'];

$huanurl="https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=".$erweimaarr['ticket']."";
echo gettoken($huanurl);

function gettoken($url)
{
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.22 (KHTML, like Gecko) Chrome/25.0.1364.172 Safari/537.22");
	curl_setopt($ch, CURLOPT_ENCODING ,'gzip'); //加入gzip解析
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
	$output = curl_exec($ch);
	curl_close($ch);
	return $output;
}

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