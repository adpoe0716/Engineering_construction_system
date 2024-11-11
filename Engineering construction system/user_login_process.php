<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_email = $_POST["user_email"];
    $user_password = $_POST["user_password"];

    $link = @mysqli_connect(
        'localhost',
        'adpoe',
        '123456',
        'engineering_construction_system'
    );
    $ff = 0;
  
    if (!$link) {
        die('資料庫連接失敗: ' . mysqli_connect_error());
    }

    $query = "SELECT * FROM `user` WHERE user_email = '" . mysqli_real_escape_string($link, $user_email) . "' AND user_password = '" . mysqli_real_escape_string($link, $user_password) . "'";
    $query2 = "SELECT * FROM `principal` WHERE principal_email = '" . mysqli_real_escape_string($link, $user_email) . "' AND principal_password = '" . mysqli_real_escape_string($link, $user_password) . "'";
    $query3 = "SELECT * FROM `company` WHERE company_email = '" . mysqli_real_escape_string($link, $user_email) . "' AND company_password = '" . mysqli_real_escape_string($link, $user_password) . "'";
   
    $result = mysqli_query($link, $query);
    $result2 = mysqli_query($link, $query2);
    $result3 = mysqli_query($link, $query3);


    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);     
        $user['5'] = '業主';
        $_SESSION['user'] = $user;
        echo '<script>alert("登入成功！"); window.location.href = "function.php";</script>';
    } else if (mysqli_num_rows($result2) > 0) {
        $user = mysqli_fetch_assoc($result2);
        $user['6'] = '負責人';
        $_SESSION['user'] = $user;
        echo '<script>alert("登入成功！"); window.location.href = "function.php";</script>';
    } else if (mysqli_num_rows($result3) > 0) {
        $user = mysqli_fetch_assoc($result3);
        $user['6'] = '工班';
        $_SESSION['user'] = $user;
        echo '<script>alert("登入成功！"); window.location.href = "function.php";</script>';
    } else {
        echo '<script>alert("查無帳號！"); window.location.href = "user_login.php";</script>';
    }

    mysqli_close($link);
}
