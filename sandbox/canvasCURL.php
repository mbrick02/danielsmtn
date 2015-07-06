<?php
// This code worked (next look at creating class and adding PUT):
// also see GDrv API (REST) n LTI
$domain = "vmi.instructure.com";
$authDir = "/login/oauth2";
$courseid = "970";
$endpoint = "/api/v1/courses/$courseid/pages/"; // **?? . $url
// below is latest test ***??? 7/5/15
$token = "2646~B3Wp3zAufRstmg2NKopLHt30L3C56BoMSXsPrxLjAkFUvSIeVKfQrZ9W7hDGvxRb";
// **?? without specific url: $headers = array('Authorization: Bearer ' . $token);
$headers = array('Authorization: Bearer ' . $token, "https://$domain" . $authDir);
// put below to have all setopt together (remove if fail): curl_setopt($ch_subs, CURLOPT_HTTPHEADER, $headers);

$ch = curl_init('https://'.$domain.$endpoint);  // ** removed following since using HTTPHEADER line: .'?access_token='.$token
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
// ***??or: curl_setopt($ch, CURLOPT_HEADER, "Authorization: Bearer " . $token, https://vmi.instructure.com/login/oauth2;);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
//** ?? NOT YET: curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
//** ?? NOT YET: curl_setopt($ch, CURLOPT_POSTFIELDS, 'wiki_page[body]='.urlencode($html));

$response = curl_exec($ch);
if(curl_errno($ch)){
    echo 'error:' . curl_error($ch);
} else {
  print_r($response);
}

?>