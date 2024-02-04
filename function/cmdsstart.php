<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

ini_set('log_errors', TRUE);
ini_set('error_log', 'errors.log');


$users = file_get_contents('Database/free.txt');
$freeusers = explode("\n", $users);

$videoURLStart = "https://t.me/BR0KENxCC/6";


if (preg_match('/^(\/start|\.start|!start)/', $text)) {
    if (in_array($userId, $freeusers)) {
        $caption = "𖤐 𝙒𝙘𝙡𝙢 𝙏𝙤 𝙈𝙮 𝙊𝙬𝙣 𝙒𝙤𝙧𝙡𝙙 𝙊𝙛 𝘿𝙚𝙫𝙞𝙡 𖤐
𝙍𝙚𝙢𝙚𝙢𝙗𝙚𝙧 <code>@$username</code> 𝙔𝙤𝙪'𝙧𝙚 <code>$rank</code> 𝘽𝙪𝙩 𝙎𝙩𝙞𝙡𝙡 𝘾𝙖𝙣'𝙩 𝘿𝙚𝙛𝙚𝙖𝙩 𝙈𝙚!

@$username 𝙉𝙚𝙫𝙚𝙧 𝙂𝙞𝙫𝙚 𝙈𝙚 𝙊𝙧𝙙𝙚𝙧... 𝙊𝙩𝙝𝙚𝙧𝙬𝙞𝙨𝙚 𝙔𝙤𝙪 𝙒𝙞𝙡𝙡 𝙋𝙖𝙮 𝙁𝙤𝙧 𝙄𝙩 😒

𝙅𝙪𝙨𝙩 𝘾𝙡𝙞𝙘𝙠 '/cmds' 𝙏𝙤 𝙁𝙚𝙚𝙡 𝙈𝙮 𝙋𝙤𝙬𝙚𝙧...";
        sendVideox($chatId, $videoURLStart, $caption, $keyboard);
    } else {
        reply_tox($chatId,$message_id,$keyboard,"<code>You are not registered, Register first with</code> '/register' <code>to use me</code>");
    }
}
//=========START END========//
if (preg_match('/^(\/cmds|\.cmds|!cmds)/', $text)) {

    $videoUrl = "https://t.me/BR0KENxCC/6"; 

    $keyboard2 = json_encode([
        'inline_keyboard' => [
            [
                             ['text' => '𝕲𝖆𝖙𝖊𝖜𝖆𝖞𝖘', 'callback_data' => 'gates'],
                                 ['text' => '𝕿𝖔𝖔𝖑 𝕶𝖎𝖙', 'callback_data' => 'herr'],
                                 ],
                                 [
                                 ['text' => '𝕸𝖞 𝖂𝖔𝖗𝖑𝖉', 'callback_data' => 'channel'],
                             ],
        ]
    ]);

    $caption = "𝙒𝙚𝙡𝙘𝙤𝙢𝙚 𝙏𝙤 𝙈𝙮 𝙎𝙤𝙪𝙡, 𝙔𝙤𝙪 𝘿𝙖𝙧𝙚 𝙏𝙤𝙪𝙘𝙝 𝙈𝙮 𝙎𝙤𝙪𝙡? 𝙄 𝙏𝙝𝙞𝙣𝙠 𝙔𝙤𝙪 𝙎𝙝𝙤𝙪𝙡𝙙 𝙂𝙤 𝘼𝙬𝙖𝙮 𝙊𝙧 𝙀𝙡𝙨𝙚 𝙔𝙤𝙪 𝙎𝙝𝙤𝙪𝙡𝙙 𝙋𝙖𝙮 𝙁𝙤𝙧 𝙄𝙩...

𝙒𝙚𝙡𝙡 𝘽𝙚𝙛𝙤𝙧𝙚 𝙂𝙤𝙞𝙣𝙜 𝙂𝙚𝙩 𝙈𝙚 𝙈𝙮 𝙊𝙣𝙚 𝙁𝙞𝙣𝙜𝙚𝙧 𝘽𝙮 @C0LL_BR0KEN";
    file_get_contents("https://api.telegram.org/bot6881971010:AAGREmUTJWq15vRLQjBw-SO6ZWfwB0KLpEM/deleteMessage?chat_id=$chatId&message_id=$messageId");

    // Using sendVideo endpoint instead of sendPhoto
    file_get_contents("https://api.telegram.org/bot$botToken/sendVideo?chat_id=$chatId&video=$videoUrl&caption=" . urlencode($caption) . "&parse_mode=HTML&reply_markup=$keyboard2");
}

// Price \\\

if (preg_match('/^(\/price|\.price|!price)/', $text))

{

    $videoUrl = "https://t.me/BR0KENxCC/6"; 

    $keyboard2 = json_encode([
        'inline_keyboard' => [
            [
                      
                                 ['text' => '𝕮𝖔𝖒𝖋𝖎𝖗𝖒 𝕻𝖆𝖞𝖒𝖊𝖓𝖙', 'url' => 'https://t.me/C0LL_BR0KEN'],   ], ]
    ]);

    $caption = "〄 𝙎𝙐𝙆𝙐𝙉𝘼 - 𝙎𝙍 〄
━━━━━━━━━━━━━━━━━━
⑄ 𝘚𝘜𝘉𝘚𝘊𝘙𝘐𝘗𝘛𝘐𝘖𝘕 𝘖𝘕𝘓𝘠 ⑄
━━━━━━━━━━━━━━━━━━
× 15 𝘋𝘢𝘺'𝘴 1.99$ / 166₹
× 30 𝘋𝘢𝘺'𝘴 4.99$ / 330₹
━━━━━━━━━━━━━━━━━━
• <b>3</b> 𝙍𝙀𝘼𝙎𝙊𝙉𝙎 𝙐 𝙎𝙃𝙊𝙐𝙇𝘿 𝙏𝙊 𝘽𝙐𝙔 •
× 𝘕𝘖 𝘈𝘕𝘛𝘐 𝘚𝘗𝘈𝘔 ✅
× 24/7 𝘊𝘜𝘚𝘛𝘖𝘔𝘌𝘙 𝘊𝘈𝘙𝘌 ✅
× 𝘕𝘖 𝘊𝘊 𝘖𝘙 𝘉𝘐𝘕 𝘎𝘌𝘛 𝘓𝘌𝘈𝘒 ✅
━━━━━━━━━━━━━━━━━━
 • 𝙋𝘼𝙔𝙈𝙀𝙉𝙏 𝙈𝙀𝙏𝙃𝙊𝘿 •
 𝘉𝘛𝘊 - 𝘓𝘛𝘊 - 𝘜𝘚𝘋𝘛 - 𝘜𝘗𝘐
━━━━━━━━━━━━━━━━━━
[⛈️] 𝘽𝙏𝘾 𝘼𝘿𝘿𝙍𝙀𝙎𝙎 - 
<code>$btca</code>

[⛈️] 𝙐𝙎𝘿𝙏 𝘼𝘿𝘿𝙍𝙀𝙎𝙎 -
<code>$usdta</code>

[⛈️] 𝙇𝙏𝘾 𝘼𝘿𝘿𝙍𝙀𝙎𝙎 -
<code>$ltca</code>

[⛈️] 𝙏𝙍𝙓 𝘼𝘿𝘿𝙍𝙀𝙎𝙎 -
<code>$trxa</code>

[⛈️] 𝘽𝙄𝙉𝘼𝙉𝘾𝙀 𝙋𝘼𝙔 𝙄𝘿 - <code>$bpayid</code>
━━━━━━━━━━━━━━━━━━
⚠️ 𝘛𝘏𝘐𝘚 𝘛𝘖𝘗-𝘜𝘗 𝘈𝘙𝘌 𝘕𝘖𝘕 𝘙𝘌𝘍𝘜𝘕𝘋𝘈𝘉𝘓𝘌 ⚠️";
  

file_get_contents("https://api.telegram.org/bot$botToken/deleteMessage?chat_id=$chatId&message_id=$messageId");

    // Using sendVideo endpoint instead of sendPhoto
    file_get_contents("https://api.telegram.org/bot$botToken/sendVideo?chat_id=$chatId&video=$videoUrl&caption=" . urlencode($caption) . "&parse_mode=HTML&reply_markup=$keyboard2");
}