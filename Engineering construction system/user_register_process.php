<?php


$link = @mysqli_connect(
    'localhost',
    'adpoe',
    '123456',
    'engineering_construction_system'
);

$num = array(101, 901, 801);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $who = $_POST["who"];
    $name = $_POST["user_register_name"];
    $email = $_POST["user_register_email"];
    $password = $_POST["user_register_password"];
    $phone = $_POST["user_register_phone_number"];
    if ($who == "owner") {
        $address = $_POST["user_register_address"];
        $id_num = "SELECT COUNT(user_id) AS total FROM user";
        $num2 = 0;
    } else if ($who == "principal") {
        $id_num = "SELECT COUNT(principal_id) AS total FROM principal";
        $num2 = 1;
    } else if ($who == "company") {
        $type = $_POST['user_type'];
        $id_num = "SELECT COUNT(company_id) AS total FROM company";
        $num2 = 2;
    }

    $result = mysqli_query($link, $id_num);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $userCount = $row['total'] + $num[$num2];
        global $userCount;
    }


    if ($link && $who == "owner") {
        $query = "INSERT INTO `user` (`user_id`, `user_name`, `user_email`, `user_password`, `user_phone_number`, `user_address`) VALUES ('$userCount', '$name', '$email', '$password', '$phone', '$address')";
        // $result = mysqli_query($link, $query);

        if (mysqli_query($link, $query)) {
            echo '<script>alert("註冊成功！ 請再次登入!"); window.location.href = "user_login.php";</script>';
        } else {
            echo "註冊失敗，請重試。";
        }
    } else if ($link && $who == "principal") {
        $query = "INSERT INTO `principal` (`principal_id`, `principal_name`, `principal_email`, `principal_password`, `principal_number`) VALUES ('$userCount', '$name', '$email', '$password', '$phone')";
        if (mysqli_query($link, $query)) {
            echo '<script>alert("註冊成功！"); window.location.href = "user_management.php";</script>';
        } else {
            echo "註冊失敗，請重試。";
        }
    } else if ($link && $who == "company") {
        $query = "INSERT INTO `company` (`company_id`, `company_name`, `company_email`, `company_password`, `phone`,`company_type`) VALUES ('$userCount', '$name', '$email', '$password', '$phone','$type')";
        if (mysqli_query($link, $query)) {
            echo '<script>alert("註冊成功！"); window.location.href = "user_management.php";</script>';
        } else {
            echo "註冊失敗，請重試。";
        }
    }
}

mysqli_close($link);

//header("Location:user_login.php");
