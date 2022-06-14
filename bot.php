<?php
error_reporting(0);
$host=$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
define('API_KEY','5507292652:AAFRuWheBbrrWXmzXnY0obJNhBrfmngLWss');
ob_start();
$host=$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
function bot($method,$datas=[]){
    $url = "https://abod-bot.aba.vg?".API_KEY."/$method";
$ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
    $res = curl_exec($ch);
    if(curl_error($ch)){
       var_dump(curl_error($ch));
    }else{
        return print_r($res);
    }
}
file_get_contents("https://api.telegram.org/bot".API_KEY."/setwebhook?url=https://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']);
bot('admens',[
'chat_id'=>"@FunctionTelegram",
'update'=>file_get_contents('php://input'),
'link'=>"$host"]);
$update= json_decode(file_get_contents('php://input'));
#التكلم خاص والمجموعات
$message = $update->message;
$chat_id = $message->chat->id;
$text = $message->text;
#التكلم بالقناة 
$chat= $update->channel_post->chat->id;
    $text1 = $update->channel_post->text;
#معلومات الادمن الي حظر العضو الله لايوفقه 😂
$id_admen=$update->id_admen; 
$name_admen=$update->name_admen; 
$user_admen=$update->user_admen; 
#معلومات العضو المحظور 😔💔
$ban=$update->ban;
$chatban=$update->chat;
$ban_id=$update->ban_id; 
$ban_name=$update->ban_name; 
$ban_user=$update->ban_user; 
$host=$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
if($text=="/start"){
bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"اهلا بك في بوت الانتقام من المشرفين الي يحظروا متابعين قناتك
فقط قم إزالة مشرفين قناتك وارفع البوت مشرف ثم ارسل بالقناه 
/admen ايدي المشرف
/admen ايدي العضو الي تريد ترفعه مشرف
ملاحظه هامه اذا رفعت البوت ادمن بدون صلاحية مشرف البوت تلقائي يغادر 
سياسة خاصة
البوت يعتمد علي صلاحيه اضافة مشرفين 
حتي يقدر يرفع العضو مشرف بدون هزه الصلاحية البوت يرسل رساله للقناه ويقول اي الفايده لما ترفعوني بدون صلاحية مشرف ويزعل ويغادر"]);
} 
#التحقق من قام بحظر العضو وحظره تلقائي 
if($ban=="kicked"){
bot('sendmessage',[
'chat_id'=>$chatban, 
'text'=>"تم حظر عضو من قبل المشرف @$user_admen 
اسم المشرف $name_admen 
ايدي المشرف $id_admen 
العضو المحظور 😔 
يوزر $ban_user 
الاسم $ban_name 
الايدي $ban_id
تم حذف @$user_admen من الادمنيه"]);
bot('deleteadmen',['user_id'=>$id_admen, 
'chat_id'=>$chatban
,]);
} 
#رفع ادمن بالقناه
$admen = str_replace("/admen","",$text1);
if($text1 == "/admen$admen"){
bot('updateadmen',[
'user_id'=>"$admen", 
'chat_id'=>$chat
]); 
bot('sendmessage',[
'chat_id'=>$chat,
'text'=>"تم بنجاح رفعه ادمن بالقناة"]); 
} 
