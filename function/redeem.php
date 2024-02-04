<?php

if (strpos($message, "/eatkey") === 0) {
    $codeToRedeem = trim(substr($message, 8)); // get the code from the message

    $codesAndExpiryDays = file('Database/codes.txt', FILE_IGNORE_NEW_LINES);
    $found = false;
    $newCodesAndExpiryDays = [];

    foreach ($codesAndExpiryDays as $line) {
        $line = trim($line);
        if (strpos($line, '[') === 0 && strpos($line, ']') !== false) {
            $parts = explode("|", substr($line, 1, -1)); // remove brackets and split code and expiry
            $codeFromFile = trim($parts[0]);
            
            if ($codeToRedeem === $codeFromFile && !$found) {
                $found = true;
                
                // Add the user id and the expiry date to the paid.txt file
                $expiryDays = (int) $parts[1];
                $expiryDate = date('Y-m-d', strtotime("+$expiryDays days"));
                file_put_contents('Database/paid.txt', "$userId $expiryDate\n", FILE_APPEND);

                sendMessage($chatId, "<b> Thanks For The Finger ✅, Now You Can Use My Unlimited Power</b>", $messageId);
            } else {
                $newCodesAndExpiryDays[] = $line;
            }
        }
    }

    if ($found) {
        file_put_contents('Database/codes.txt', implode("\n", $newCodesAndExpiryDays));
    } else {
        sendMessage($chatId, "<b>This Finger Is Already Eaten Or Invalid 🔴</b>", $messageId);
    }
}
?>
