<?php

//https://www.itread01.com/content/1541072643.html

/*
//---
//phpqrcode直接輸出二維碼：
require_once("phpqrcode.php");
$url="http://jashliao.eu"; 
$errorCorrectionLevel = "H"; // 糾錯級別：L、M、Q、H  
$matrixPointSize = "10"; //生成圖片大小 ：1到10  
QRcode::png($url, false, $errorCorrectionLevel, $matrixPointSize);  
exit();
//---phpqrcode直接輸出二維碼：
*/
/*
//---
//儲存二維碼圖片到本地：
require_once("phpqrcode.php");
$value="http://jashliao.eu";
$filename = 'xiaozhang.png';  //  生成的檔名  
$errorCorrectionLevel = "H"; // 糾錯級別：L、M、Q、H  
$matrixPointSize = "10"; //生成圖片大小 ：1到10  
QRcode::png($value, $filename, $errorCorrectionLevel, $matrixPointSize,2);  
exit();
//---儲存二維碼圖片到本地：
*/

//---
//生成帶LOGO的二維碼：
require_once("phpqrcode.php");
$value="http://jashliao.eu";
$errorCorrectionLevel = 'H';//容錯級別
$matrixPointSize = 10;//生成圖片大小
$filename = 'xiaozhang.png';  //  生成的檔名  
//生成二維碼圖片
QRcode::png($value, 'qrcode.png', $errorCorrectionLevel, $matrixPointSize, 2);
$logo = 'icon.png';//準備好的logo圖片
$QR = 'qrcode.png';//已經生成的原始二維碼圖
if ($logo !== FALSE) {
    $QR = imagecreatefromstring(file_get_contents($QR));
    $logo = imagecreatefromstring(file_get_contents($logo));
    $QR_width = imagesx($QR);//二維碼圖片寬度
    $QR_height = imagesy($QR);//二維碼圖片高度
    $logo_width = imagesx($logo);//logo圖片寬度
    $logo_height = imagesy($logo);//logo圖片高度
    $logo_qr_width = $QR_width / 5; //logo圖片在二維碼圖片中寬度大小
    $scale = $logo_width/$logo_qr_width;
    $logo_qr_height = $logo_height/$scale; //logo圖片在二維碼圖片中高度大小
    $from_width = ($QR_width - $logo_qr_width) / 2;
    //重新組合圖片並調整大小
    imagecopyresampled($QR, $logo, $from_width, $from_width, 0, 0, $logo_qr_width,
        $logo_qr_height, $logo_width, $logo_height);
}

ImagePng($QR,$filename);//儲存合成結果

//直接輸出圖片到瀏覽器
Header("Content-type: image/png");
ImagePng($QR);

exit();
//---生成帶LOGO的二維碼：
?>