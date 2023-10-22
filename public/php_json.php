<?php
$data = '{
    "STATUS": 200,
    "DATA": {
        "ERROR": 0,
        "MESSAGE": "Hello",
        "SUCCESS": 1,
        "erpkey": "2111LV11MD0Y_X_A01AR2111",
        "EMAIL": "zzz@zzz.com"
    }
}';

echo 'erpkey： ' . (json_decode($data, true)['DATA']['erpkey'] ?? "erpkey沒東西！");


echo "<br><br><br><br><br>------------------------------------------------------------------------<br>";
echo "json_decode()有加true回傳關聯陣列，沒加true或false，則回傳一個物件。";



echo "<br><br><br><br><br>------------------------------------------------------------------------<br>";
echo "Usage：  http://localhost:8000/php_json.php?mode=1or2 <br>";
echo "回傳資料1or2。 <br><br>";

$mode = $_GET['mode'] ?? null;

$data1 = array( 'name' => 'George', 'key' => '1234' );
$data2 = array( 'name' => 'Judy', 'key' => '5678' );

switch ($mode) {
    case '1':
        $response = $data1;
        break;
    case '2':
        $response = $data2;
        break;
    default:
        $response = null;
}

if ($response !== null) {
    echo json_encode($response);
}