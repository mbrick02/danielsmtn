<?php
if(!empty ($_GET['location'])){
	$maps_url = 'https://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($_GET['location']);

	$maps_json = file_get_contents($maps_url);

	$maps_array = json_decode($maps_json, true);

	$lat = $maps_array['results'][0]['geometry']['location']['lat'];
	$lng = $maps_array['results'][0]['geometry']['location']['lng'];

	//  0624 app: testMashCode
	$instagram_url = 'https://api.instagram.com/v1/media/search?lat=' . $lat . '&lng=' .$lng;
	$instagram_url .= '&client_id=db58737c6196475685a3de434ee544b0';
	// 062415 secret: 798ae44d3dc84b399351d76af7370fff
	// Note: he has a video on how to generate instagram access tokens
	//        https://www.youtube.com/watch?v=LkuJtIcXR68  (disable implicit oAuth)


	$instagram_json = file_get_contents($instagram_url);
	$instagram_array = json_decode($instagram_json, true);
	 
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8"/>
	<title>geogram</title>
</head>
<body>
<form action="">
	<input type="text" name="location"/>
	<button type="submit">submit</button>
	<br/>
	<?php
	if(!empty($instagram_arry)){
	    foreach($instagram_array['data'] as $image) {
		echo '<img src"'
		.$image['images']['low_resolution']['url'].'" alt="" />';
		}
	}
	?>
</form>
</body>
</html>