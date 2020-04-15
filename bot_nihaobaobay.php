<?php
require "dbConnect.php";

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

SendMessage_Bot("Chào Cậu Chủ, ngày mới tốt lành !!! gâu gâu");

/*
if(date('m') == 2){
SendMessage_Bot("Loa Loa Thông Báo !!!");
SendMessage_Bot("Tình hình dịch bệnh Corona phức tạp, nghỉ học hết tháng 2");
die();
}*/


$NgayHomNay = getNgayHomNay();
$strQuery = "SELECT `tenMon`, `noiDungHoc`, `thoiGianHoc`, `tietHoc`, `phongHoc` FROM `lichhoc` WHERE thoiGianHoc = '$NgayHomNay'";
$resultCheck = mysqli_query($connect, $strQuery);

if(mysqli_num_rows($resultCheck) == 0){
	SendMessage_Bot("Hôm nay là ".getNgayHomNay().", ".date('d-m-Y').", Cậu Chủ được nghỉ học 😎");
	SendMessage_Bot("Có kế hoạch gì để chill không ??? gâu gâu");
	die();
}else{
	SendMessage_Bot("Hôm nay là ".getNgayHomNay().", ".date('d-m-Y').", Cậu Chủ có lịch học môn: ");
	while ($user = mysqli_fetch_array($resultCheck)) {
		SendMessage_Bot("-".$user['tenMon']." (".$user['noiDungHoc'].")".", Tiết: ".$user['tietHoc'].", Phòng: ".$user['phongHoc']);
	}
}
?>