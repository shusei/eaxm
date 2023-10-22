<?php

require __DIR__.'/../vendor/autoload.php';

use Carbon\Carbon;

$now =  Carbon::now();

echo "現在時間： " . $now . "<br>";

$afterTime = $now->addMonths(14);

echo "加14個月： " . $afterTime . "<br>";

echo "年：" . $afterTime->year . "<br>";
echo "月：" . $afterTime->month . "<br>";
echo "日：" . $afterTime->day . "<br>";