<form method="post">
    <label for="email">Email： </label>
    <input type="text" name="email" id="email">
    <button type="submit">送出</button>
</form>

<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        $email = $_POST["email"];
        
        // 檢查email格式
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailName = explode('@', $email);
            echo "Email Name：" . $emailName[0];
        } else {
            echo "請輸入正確的Email";
        }
    }
?>