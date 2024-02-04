
<?php
include 'function/antispam.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

ini_set('log_errors', TRUE);
ini_set('error_log', 'errors.log');

//=========RANK DETERMINE=========//
$gate = "Braintree 3D LookUp";
$currentDate = date('Y-m-d');
$rank = "FREE";
$expiryDate = "0";
$paidUsers = file('Database/paid.txt', FILE_IGNORE_NEW_LINES);
$freeUsers = file('Database/free.txt', FILE_IGNORE_NEW_LINES);
$owners = file('Database/owner.txt', FILE_IGNORE_NEW_LINES);
if (in_array($userId, $owners)) {
    $rank = "OWNER";
    $expiryDate = "UNTIL DEAD";
} else {
    foreach ($paidUsers as $index => $line) {
        list($userIdFromFile, $userExpiryDate) = explode(" ", $line);
        if ($userIdFromFile == $userId) {
            if ($userExpiryDate < $currentDate) {
                unset($paidUsers[$index]);
                file_put_contents('Database/paid.txt', implode("\n", $paidUsers));
                $freeUsers[] = $userId;
                file_put_contents('Database/free.txt', implode("\n", $freeUsers));
            } else {
                $rank = "PAID";
                $expiryDate = $userExpiryDate;
            }
        }
    }
}
//=======RANK DETERMINE END=========//
$update = json_decode(file_get_contents("php://input"), TRUE);
$text = $update["message"]["text"];
//========WHO CAN CHECK FUNC========//
if (preg_match('/^(\/xxx|\.xxx|!xxx)/', $text)) {
    $userid = $update['message']['from']['id'];
    if (!checkAccess($userid)) {
        $sent_message_id = send_reply($chatId, $message_id, $keyboard, "<b> $userlink You're not Premium user❌</b>", $message_id);
        exit();
    }
    $start_time = microtime(true);
    $chatId = $update["message"]["chat"]["id"];
    $message_id = $update["message"]["message_id"];
    $keyboard = "";
    //=======WHO CAN CHECK END========//
    //====ANTISPAM AND WRONG FORMAT====//
    if (strlen($text) <= 5) {
        sendMessage($chatId, '<b>• Wrong Format! ⚠️</b>%0A• 𝘚𝘦𝘯𝘥 <code>/vbv cc|mm|yy|cvv</code>%0A• 𝘎𝘢𝘵𝘦𝘸𝘢𝘺 <code>3DS Lookup</code>', $message_id);
        exit();
    }


  

    //==ANTISPAM AND WRONG FORMAT END==//
    //=======checker part start========//
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        extract($_POST);
    } elseif ($_SERVER['REQUEST_METHOD'] == "GET") {
        extract($_GET);
    }
    function inStr($string, $start, $end, $value) {
        $str = explode($start, $string);
        $str = explode($end, $str[$value]);
        return $str[0];
    }
    $lista = substr($text, 5);
    $separa = explode("|", $lista);
    $cc = isset($separa[0]) ? substr($separa[0], 0, 16) : ''; // Get only first 16 digits
    $mes = isset($separa[1]) ? $separa[1] : '';
    $ano = isset($separa[2]) ? $separa[2] : '';
    $cvv = isset($separa[3]) ? $separa[3] : '';
    $last4 = substr($cc, 12, 16);
    $sent_message_id = send_reply($chatId, $message_id, $keyboard, "<b>REVIEWING YOU'RE REQUEST ✅</b>");
    function value($str, $find_start, $find_end) {
        $start = @strpos($str, $find_start);
        if ($start === false) {
            return "";
        }
        $length = strlen($find_start);
        $end = strpos(substr($str, $start + $length), $find_end);
        return trim(substr($str, $start + $length, $end));
    }
    function mod($dividendo, $divisor) {
        return round($dividendo - (floor($dividendo / $divisor) * $divisor));
    }
    //================[Functions and Variables]================//
    function vbv($input) {
        // Replace underscores with spaces
        $output = str_replace('_', ' ', $input);
        // Convert to title case (first letter uppercase, rest lowercase)
        $output = ucwords(strtolower($output));
        return $output;
    }
    #------[CC Type Randomizer]------#
    $cardNames = array("3" => "American Express", "4" => "Visa", "5" => "MasterCard", "6" => "Discover");
    $card_type = $cardNames[substr($cc, 0, 1) ];

    //==================[BIN LOOK-UP]======================//
    // Initialize cURL session
$ch = curl_init();

      $bin = substr($cc, 0, 6);

      curl_setopt($ch, CURLOPT_URL, 'https://binlist.io/lookup/' . $bin . '/');
      curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        $ch = curl_init();

        $bin = substr($cc, 0, 6);

        curl_setopt($ch, CURLOPT_URL, 'https://binlist.io/lookup/' . $bin . '/');
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        $bindata = curl_exec($ch);
        $binna = json_decode($bindata, true);
        $brand = $binna['scheme'];
        $country = $binna['country']['name'];
        $alpha2 = $binna['country']['alpha2'];
        $emoji = $binna['country']['emoji'];
        $type = $binna['type'];
        $category = $binna['category'];
        $bank = $binna['bank']['name'];
        $url = $binna['bank']['url'];
        $phone = $binna['bank']['phone'];
        curl_close($ch);

        $bank = "$bank";
        $country = "$country $emoji ";
        $bin = "$bin - ($alpha2) -[$emoji] ";
        $bininfo = "$type - $brand - $category";
        $url = "$url";
        $type = strtoupper($type);


  
  
    //==================[BIN LOOK-UP-END]======================//
    sleep(1);
    edit_sent_message($chatId, $sent_message_id, "<b>
[×] PROCESS - ■□□□
- - - - - - - - - - - - - - - - - - -
[×] CARD ↯ <code>$lista</code>
[×] GATEWAY ↯ $gate
[×] BANK ↯ $bank
[×] TYPE ↯ $bininfo
[×] COUNTRY ↯ $country
- - - - - - - - - - - - - - - - - - -
|×| MAXIMUM TIME ↯ 25 SEC
|×| REQ BY ↯ @$username</b>");

    //-------------------Req 1--------------//

    //==================req 2 end===============//

    sleep(1);
    edit_sent_message($chatId, $sent_message_id, "<b>
[×] PROCESS - ■■■■
- - - - - - - - - - - - - - - - - - -
[×] CARD ↯ <code>$lista</code>
[×] GATEWAY ↯ $gate
[×] BANK ↯ $bank
[×] TYPE ↯ $bininfo
[×] COUNTRY ↯ $country
- - - - - - - - - - - - - - - - - - -
|×| MAXIMUM TIME ↯ 25 SEC
|×| REQ BY ↯ @$username</b>");

    $end_time = microtime(true);
    $time = number_format($end_time - $start_time, 2);
    //======checker part end=========//



    if (strpos($curl11, 'authenticate_successful')) {
        $response = "

𝐂𝐚𝐫𝐝 ↯ <code>$lista</code>
𝐆𝐚𝐭𝐞𝐰𝐚𝐲 ↯ <code>$gate</code>
𝐑𝐞𝐬𝐩𝐨𝐧𝐬𝐞 ↯ <code>$Status</code>

𝐁𝐢𝐧 𝐈𝐧𝐟𝐨 ↯ <code>$bininfo</code> 
𝐁𝐚𝐧𝐤 ↯ <code>$bank</code>
𝐂𝐨𝐮𝐧𝐭𝐫𝐲 ↯ <code>$country</code>

𝐓𝐢𝐦𝐞 ↯ <code>$time Seconds</code>
$botu";
        sleep(1);
        edit_sent_message($chatId, $sent_message_id, $response);

        } else {
        $response = "┏━━×
┃𝗔𝗽𝗽𝗿𝗼𝘃𝗲𝗱  ✅
┗━━━━━━━━×

𝗖𝗮𝗿𝗱  ↯ <code>$lista</code>
𝗚𝗮𝘁𝗲𝘄𝗮𝘆  ↯ <code>Special Grade</code>
𝗥𝗲𝘀𝗽𝗼𝗻𝘀𝗲  ↯ <code>Success</code>

𝗕𝗶𝗻 𝗶𝗻𝗳𝗼  ↯ <code>$bininfo</code> 
𝗕𝗮𝗻𝗸 ↯ <code>$bank</code>
𝗖𝗼𝘂𝗻𝘁𝗿𝘆 ↯ <code>$country</code>

𝗧𝗶𝗺𝗲 𝗧𝗮𝗸𝗲𝗻 ↯ <code>$time Seconds</code>
";
        sleep(1);
        edit_sent_message($chatId, $sent_message_id, $response);
    }
}