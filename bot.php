<?php
error_reporting(0);

set_time_limit(0);

flush();
$API_KEY = '5422346990:AAEGjYahCY_xBo9rb-7q1xXCP3qtImU-0_Y'; //Your token
##------------------------------##
define('API_KEY',$API_KEY);
function bot($method,$datas=[]){
    $url = "https://api.telegram.org/bot".API_KEY."/".$method;
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
    $res = curl_exec($ch);
    if(curl_error($ch)){
        var_dump(curl_error($ch));
    }else{
        return json_decode($res);
    }
}
 function sendmessage($chat_id, $text, $model){
	bot('sendMessage',[
	'chat_id'=>$chat_id,
	'text'=>$text,
	'parse_mode'=>$mode
	]);
	}
	
//==============QWERTSKI======================//
$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$message_id = $update->message->id;
$chat_id = $message->chat->id;
$name = $from_id = $message->from->first_name;
$from_id = $message->from->id;
$text = $message->text;
$fromid = $update->callback_query->from->id;
$username = $update->message->from->username;
$chatid = $update->callback_query->message->chat->id;
if($text == '/start')
bot('sendmessage', [
                'chat_id' =>$chat_id,
                'text' =>"***Welcome to bin checker
Use*** `/bin xxxxx` ***to check the bin.
Made By @IMNOOB_XD***",
'parse_mode'=>"MarkDown",
]);
if(strpos($text,"/bin") !== false){ 
$bin = trim(str_replace("/bin","",$text)); 

$data = json_decode(file_get_contents("https://lookup.binlist.net/$bin"),true);
$bank = $data['bank']['name'];
$country = $data['country']['alpha2'];
$currency = $data['country']['currency'];
$emoji = $data['country']['emoji'];
$scheme = $data['scheme'];
$Brand = $data['brand'];
$type = $data['type'];
 if($data['scheme']){
bot('sendmessage', [
                'chat_id' =>$chat_id,
                'text' =>"***VALID BIN✅
                
Bin: $bin
Type: $scheme
Brand : $Brand
Bank: $bank
Country: $country $emoji
Currency: $currency
Credit/Debit:$type
Checked By @$username***",
'parse_mode'=>"MarkDown",
]);
    }
else {
bot('sendmessage', [
                'chat_id' =>$chat_id,
                'text' =>"INVALID BIN❌",
               
]);
}
}
