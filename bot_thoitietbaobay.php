<?php
date_default_timezone_set("Asia/Ho_Chi_Minh");

function SendMessage_Bot($mess){
	$token = "1084297001:AAHIHsC4uUQSzFoK_OEXZs63GCFg-fRIDC0";
	$user_id = "926685076";

 	$request_params = [
 		'chat_id' => $user_id,
 		'text' => $mess
 	];

 	$request_url = "https://api.telegram.org/bot".$token."/sendMessage?".http_build_query($request_params);
 	file_get_contents($request_url);
}

function getNgayHomNay(){
	if(strcmp(date("l"), "Monday") == 0){
		return "Thứ Hai";
	}
	if(strcmp(date("l"), "Tuesday") == 0){
		return "Thứ Ba";
	}
	if(strcmp(date("l"), "Wednesday") == 0){
		return "Thứ Tư";
	}
	if(strcmp(date("l"), "Thursday") == 0){
		return "Thứ Năm";
	}
	if(strcmp(date("l"), "Friday") == 0){
		return "Thứ Sáu";
	}
	if(strcmp(date("l"), "Saturday") == 0){
		return "Thứ Bảy";
	}
	if(strcmp(date("l"), "Sunday") == 0){
		return "Chủ Nhật";
	}
}

function getJSONWeather($location){
	$api_key = 'cc55262277464674ff9283ca157fc0e4';
	$url_str =('http://api.openweathermap.org/data/2.5/weather?q='.$location.'&'.'appid='.$api_key.'&units=metric'.'&lang=vi');

	$ch = curl_init($url_str);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	$json = curl_exec($ch);
	curl_close($ch);

	return $json;
}

$api_result = json_decode(getJSONWeather("Ho Chi Minh"),true);

SendMessage_Bot("Thời Tiết ".$api_result['name'].". \n".getNgayHomNay().", ".date('d-m-Y').".  Trời ".$api_result['weather'][0]['description'].".\nNhiệt độ hiện tại: ".$api_result['main']['temp']." C°\nĐộ ẩm không khí: ".$api_result['main']["humidity"]."%");

?>