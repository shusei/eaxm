<form method="post" action="">
    <label for="number">自由輸入數字： </label>
    <input type="text" name="number">
    <button type="submit">送出</button>
</form>


<?php

require __DIR__.'/../vendor/autoload.php';

$data = collect(array(  "A01KA029", "A02KA032", "A03KA028", "A01KA029001",
                "A01KA029002", "A01KA029003", "A01KA029004", "A01KA029005", "A02KA032001",
                "A02KA032002", "A02KA032003", "A02KA032004", "A02KA032005", "A03KA028001",
                "A03KA028002", "A03KA028003", "A03KA028004", "A03KA028005"
            ));
$result = collect([]);
$number = 0;


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $number = $_POST["number"];
    if (is_numeric($number)) {
        
        $result = $data->filter(function ($item) use ($number) {
            return str_contains($item, $number);
        });

    } else {
        echo '<script>alert("僅可輸入數字！");</script>';
    }
}

if (!$result->isEmpty()) {

    $result->each(function ($item) {
        echo $item . "<br>";
    });
    
} elseif ($_SERVER["REQUEST_METHOD"] == "POST"){
    
    echo "無找到！<br>";
}