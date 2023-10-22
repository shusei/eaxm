<form method="post" action="">
    <label for="number">自由輸入數字： </label>
    <input type="text" name="number">
    <button type="submit">送出</button>
</form>


<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $number = $_POST["number"];
    
    if (is_numeric($number)) {
        echo number_format(round($number), 0, '.', ',');
    } else {
        echo '<script>alert("僅可輸入數字！");</script>';
    }
}


echo "<br><br><br><br><br>------------------------------------------------------------------------<br>";
echo '考題七：<br> 1. SELECT SUM(Sales) AS "總銷售金額" FROM Store_Information;<br>';
echo '2. SELECT * FROM Store_Information WHERE Store_Name LIKE "%台北%";';