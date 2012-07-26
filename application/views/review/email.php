<?php
$bodyText = '';

$message = '<html>
			<head><title>New Reviews</title>
			<link rel="stylesheet" href="http://www.appleseedinteractive.com/tripreviewer/stylesheets/main.css" />
			</head>
			<body>';


if(!empty($data['trip'])){
	$bodyText .= "<h1>TripAdvisor</h1>";
	for($i = 0; $i < count($data['trip']); $i++){
		$bodyText .= "<p>".$data['trip'][$i]['hotelname']."</p>";
		$bodyText .= "<p>".$data['trip'][$i]['description']."</p>";
		$bodyText .= "<p class='rating_".$data['trip'][$i]['rating']."'></p>";
	}
}else{
	$bodyText .= "No TripAdvisor Reviews today!";
}

if(!empty( $data['orb'] )){
	$bodyText .= "<h1>Orbitz</h1>";
	for($a = 0; $a < count($data['orb']); $a++){
		$bodyText .= "<p>".$data['orb'][$a]['hotel_name']."</p>";
		$bodyText .= "<p>".$data['orb'][$a]['title']."</p>";
		$bodyText .= "<p class='rating_".$data['orb'][$a]['score']."'></p>";
		$bodyText .= "<p>".$data['orb'][$a]['summary']."</p>";		
	}
}

$message = $message.$bodyText;

echo $message .='</body></html>';

?>