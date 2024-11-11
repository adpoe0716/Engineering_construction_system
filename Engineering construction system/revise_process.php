<?php
session_start();
$link = @mysqli_connect(
    'localhost',
    'adpoe',
    '123456',
    'engineering_construction_system'
);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["user_register_name"];
    $email = $_POST["user_register_email"];
    $password = $_POST["user_register_password"];
    $phone = $_POST["user_register_phone_number"];
    $address = $_POST["user_register_address"];
    echo $name . $email . $password . $phone . $address;

    session_start();
    $user = $_SESSION['user'];
    $user2 = array_values($user);

    if ($link) {
        $query = "UPDATE `user` SET `user_name` = '$name', `user_email` = '$email', `user_password` = '$password', `user_phone_number` = '$phone', `user_address` = '$address' WHERE `user_id` = '$user2[0]'";
        if (mysqli_query($link, $query)) {
            unset($_SESSION['user']);
            $_SESSION['user'] = array(
                'user_id' => $user2[0],
                'user_name' => $name,
                'user_email' => $email,
                'user_password' => $password,
                'user_phone_number' => $phone,
                'user_address' => $address,
                'user_who' => '業主'
            );
            echo '<script>alert("修改成功！"); window.location.href = "user_login.php";</script>';
        } else {
            echo "註冊失敗，請重試。";
        }
    } else
        echo "資料庫連接失敗。";
}
mysqli_close($link);

//header("Location:user_login.php");
