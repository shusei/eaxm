<?php

require __DIR__.'/../vendor/autoload.php';

use Carbon\Carbon;


$saveTimeDuration = 10800;      // session 保存三小時
$addOneDay;
$addOneMonth;
$addOneYear;


date_default_timezone_set('Asia/Taipei');

session_set_cookie_params($saveTimeDuration);

session_start();

$currentTime =  Carbon::now();

$_SESSION['recorded_time'] = $currentTime;

echo "現在時間： " . $_SESSION['recorded_time'] . "<br>";

$addOneDay      = $currentTime->copy()->addDay();
$addOneMonth    = $currentTime->copy()->addMonth();
$addOneYear     = $currentTime->copy()->addYear();

echo "加一天： " . $addOneDay . "<br>";
echo "加一月： " . $addOneMonth . "<br>";
echo "加一年： " . $addOneYear . "<br>";

echo "<br>";

echo "考題四的答案是「每天 02:00 執行 releaseSession.php」";




