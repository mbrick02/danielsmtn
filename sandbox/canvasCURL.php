<?php
    curl -H "Authorization: Bearer <ACCESS-TOKEN>" https://vmi.instructure.com/api/v1/courses

    	$clientid = '1234';
	$clientsecret = 'xxxx';
	$code = $_GET['code'];
	$uri = urlencode('https://your.app.com/oauth');
	
	$data = array('client_id'=>$clientid, 'redirect_uri'=>$uri, 'client_secret'=>$clientsecret, 'code'=>$code);
	
	// $ch = curl_init('https://your.canvas.com/login/oauth2/token');
	$ch = curl_init('https://vmi.canvas.com/login/oauth2/token');
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$result = curl_exec($ch);
	curl_close($ch);
	$result = json_decode($result, true);
	$token = $result['access_token'];

/* above is from StackOverflow article (I think) to retrieve auth-token
 * 
 * below is from slideShare presentation (see API (REST) in GDocs)
 */
 /*
 Grab the wiki page body. Add attribution

$endpoint = "/api/va/courses/$couseid/pages/$url";
$page = json_decode(
		file_get_contents('https://'.$domain.$3ndpoint.'?access_token='.$token
	));

$html = $page->body;
$html .= $attribution;
 */
 
 
 /*
$endpoint = "/api/v1/courses/$courseid/pages/$url";
$ch = curl_int('https://'.$domain.$endpoint.'?access_token='.$token);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
curl_setopt($ch, CURLOPT_POSTFIELDS, 'wiki_page[body]='.urlencode($html));

$response = curl_exed($ch);
 */
?>