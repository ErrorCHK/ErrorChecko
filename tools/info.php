
<?php

function getUserProfilePhoto($userId) {
    global $website;
    $url = $website . "/getUserProfilePhotos?user_id=" . $userId . "&limit=1";

    $response = json_decode(file_get_contents($url), TRUE);

    if ($response === FALSE) {
        error_log("Failed to get user profile photo: " . $url);
        return null;
    }
    if ($response['ok'] && count($response['result']['photos']) > 0) {
        return $response['result']['photos'][0][0]['file_id'];
    }

    return null;
}



//============function end==========//
if (preg_match('/^(\/id|\.id|!info)/', $text)) {

    $photoId = getUserProfilePhoto($userId);

    $m = "↳ 𝙐𝙎𝙀𝙍 𝙄𝙉𝙏𝙄𝙈𝘼𝙏𝙄𝙊𝙉 ↲%0A━━━━━━━━━━━━━%0A<b>× UESERNAME - @$username%0A× USAGE NAME  ↯ $firstname%0A× TG ID  ↯ <code>$userId</code>%0A× CHAT ID ↯ <code>$chatId</code>%0A× RANK ↯ $rank%0A× PLAN EXPIREY ↯ $expiryDate</b>%0A━━━━━━━━━━━━━%0A<b>|×| DEV - @C0LL_BR0KEN</b>";

    if ($photoId) {
        sendPhotox($chatId, $photoId, $m);
    } else {
        sendMessage($chatId, $m, $message_id);
    }
}
