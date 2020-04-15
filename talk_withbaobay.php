<?php
require 'dbConnect.php';

date_default_timezone_set("Asia/Ho_Chi_Minh");

function GetLastMessage(){
	$token = "1084297001:AAHIHsC4uUQSzFoK_OEXZs63GCFg-fRIDC0";
	$url_req = "https://api.telegram.org/bot".$token."/getUpdates";

	$ch = curl_init($url_req);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);

	$json = curl_exec($ch);
	curl_close($ch);

	$api_result = json_decode($json, true);

	$length = count($api_result["result"]);

	$array = array('date' => $api_result["result"][$length-1]["message"]["date"],'text' => $api_result["result"][$length-1]["message"]["text"]); 

	return $array;
}

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

function InsertDatetoSQL($mess_time){
	require 'dbConnect.php';
	$strQuery = "INSERT INTO `messlogs`(`thoiGian`) VALUES ('$mess_time')";
	$resultCheck = mysqli_query($connect, $strQuery);
}

function CheckDatetoSQL($mess_time){
	require 'dbConnect.php';
	$strQuery = "SELECT * FROM `messlogs` WHERE `thoiGian` = '$mess_time'";
	$resultCheck = mysqli_query($connect, $strQuery);

	if(mysqli_fetch_array($resultCheck) == 0){
		return false;
	}else{
		return true;
	}	
}

function CheckStatusMesstoSQL($mess_time, $status){
	require 'dbConnect.php';

	$strQuery = "SELECT * FROM `messlogs` WHERE `thoiGian` = '$mess_time' AND 'phanHoi' = $status";
	$resultCheck = mysqli_query($connect, $strQuery);

	if(mysqli_fetch_array($resultCheck) == 0){
		return false;
	}else{
		return true;
	}	
}

function UpdateLogDatetoSQL($mess_time, $log_condi){
	if($log_condi){
		require 'dbConnect.php';
		
		$strQuery = "UPDATE `messlogs` SET `phanHoi`='1' WHERE `thoiGian` = '$mess_time'";
		$resultCheck = mysqli_query($connect, $strQuery);
	}else{
		require 'dbConnect.php';
		
		$strQuery = "UPDATE `messlogs` SET `phanHoi`='0' WHERE `thoiGian` = '$mess_time'";
		$resultCheck = mysqli_query($connect, $strQuery);
	}
}

function DeleteAllMesstoSQL(){
	require 'dbConnect.php';

	$strQuery = "SELECT * FROM `messlogs`";
	$resultCheck = mysqli_query($connect, $strQuery);

	if(mysqli_num_rows($resultCheck) == 100){
		$strDelQuery = "DELETE FROM `messlogs`";
		$result = mysqli_query($connect, $strDelQuery);
		return true;
	}

	return false;
}

function SaveLastMessage($mess_time){
	require 'dbConnect.php';
		
	$strQuery = "UPDATE `lastmessage` SET `mess_date`= '$mess_time' WHERE 1";
	$resultCheck = mysqli_query($connect, $strQuery);
}

function CheckLastMessage($mess_time){
	require 'dbConnect.php';
		
	$strQuery = "SELECT * FROM `lastmessage` WHERE `mess_date` = '$mess_time'";
	$resultCheck = mysqli_query($connect, $strQuery);

	while ($row = mysqli_fetch_array($resultCheck)) {
		if($row["mess_date"] == $mess_time){
			die();
		}
	}
}

//Kiểm Tra Thời Gian Logs Của Mess
$array_mess = GetLastMessage();
$mess_time = $array_mess["date"]; 
$mess_text = $array_mess["text"];
CheckLastMessage($mess_time);

if(CheckDatetoSQL($mess_time)){
	die();
}

InsertDatetoSQL($mess_time);

if($mess_text == "/help"){
	if(CheckStatusMesstoSQL($mess_time,0)){
		SendMessage_Bot("Gâu Gâu Gâu !!!");
		SendMessage_Bot("Để thực hiện việc giao tiếp với Bot, cậu chủ hãy sử dụng các lệnh được hỗ trợ sau:\n1. Gõ /lichhoc : để kiểm tra lịch học hôm nay.\n2. Gõ "."/thoitiet : để kiểm tra thời tiết hiện tại\n3. Gõ /help : để xem hướng dẫn sử dụng.");
		UpdateLogDatetoSQL($mess_time,true);
		SaveLastMessage($mess_time);
	}else{
		die();
	}
}

if($mess_text == "/lichhoc"){
 	if(CheckStatusMesstoSQL($mess_time,0)){
		$request_url = "https://thcldev.000webhostapp.com/bot_nhaclichhoc_telegram/bot_nihaobaobay.php";
 		file_get_contents($request_url);
		UpdateLogDatetoSQL($mess_time,true);
		SaveLastMessage($mess_time);
	}else{
		die();
	}
}

if($mess_text == "/thoitiet"){
 	if(CheckStatusMesstoSQL($mess_time,0)){
		$request_url = "https://thcldev.000webhostapp.com/bot_nhaclichhoc_telegram/bot_thoitietbaobay.php";
 		file_get_contents($request_url);
		UpdateLogDatetoSQL($mess_time,true);
		SaveLastMessage($mess_time);
	}else{
		die();
	}
}

DeleteAllMesstoSQL();

?>