<?php

function clean($message) {
    return htmlspecialchars(trim($message));
}

function random_strings($length_of_string) {
    $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZIJKLMNOP28427JEKUBKQOPDH';
    $str_shuffled = str_shuffle($str_result);
    return substr($str_shuffled, 0, $length_of_string);
}

if ((strpos($message, "/code") === 0) || (strpos($message, "!code") === 0) || (strpos($message, ".code") === 0)) {
    $owners = file_get_contents('Database/owner.txt');
    $admins = explode("\n", $owners);
    if (!in_array($userId, $admins)) {
        sendMessage($chatId, "You are Not ADMIN ! ", $messageId);
    } else {
        $command = substr($message, 6);
        $command = clean($command);

        if ($command == ' ' || $command == '') {
            $expiryDays = 1;
            $amountOfCodes = 1;
        } else {
            $cmdExplode = explode('-', $command); // assuming the format is {expiry_days}-{amount_of_codes}
            $expiryDays = (int)$cmdExplode[0];
            $amountOfCodes = (int)$cmdExplode[1];
        }

        $expiryDate = date('d M Y', strtotime("+$expiryDays days")); // setting the key expiry date as provided by the owner

        $credt = array();
        while ($amountOfCodes > 0) {
            $rnds = 'FINGER-' . random_strings(4) . '-' . random_strings(4) . '-' . random_strings(4);
            $credt[] = $rnds;
            $amountOfCodes = $amountOfCodes - 1;
        }

        foreach ($credt as $code) {
            $credtf = fopen('Database/codes.txt', 'a');
            fwrite($credtf, "[$code|$expiryDays],\n");
            fclose($credtf);
            $formattedCode = "<code>$code</code>";
            $messageToSend = urlencode(
                "↳ 𝙎𝙋𝙀𝘾𝙄𝘼𝙇 𝙂𝙍𝘼𝘿𝙀 𝙆𝙀𝙔 ↲

<b>𖤐 BOT </b>- <a href='t.me/STRIPECHKxBOT'>𝙎𝙐𝙆𝙐𝙉𝘼 - 𝙎𝙍</a>
<b>𖤐 RANK - <code>SPECIAL GRADE</code>
𖤐 FINGER KEY - <code>$formattedCode</code>
𖤐 ACTIVATION CODE - <code>$expiryDays</code>
𖤐 EXPIRE DATE - <code> $expiryDate</code>

𖤐 USAGE -<code>/eatkey $formattedCode</code>

</b>"
            );
            sendMessage($chatId, $messageToSend, $messageId); // using $messageId instead of $message_id_1
        }
    }
}
?>
