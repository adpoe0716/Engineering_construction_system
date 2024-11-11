<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Document</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 20px;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="submit"],
        input[type="tel"] {
            margin: 10px;
            padding: 5px 10px;
            font-size: 16px;
            width: 200px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .header {
            background-color: #333;
            color: #fff;
            padding: 20px;
            text-align: center;
        }

        .nav-bar {
            background-color: gray;
            padding: 10px 0;
            margin-bottom: 20px;
            display: flex;
            justify-content: flex-start;
            align-items: center;
            color: #fff;
        }

        .nav-bar a {
            text-decoration: none;
            font-weight: bold;
            padding: 5px 10px;
            border-radius: 5px;
            color: #fff;
        }

        .user-info {
            margin-left: auto;
        }
    </style>
</head>
<?php
session_start();
if (isset($_POST['new'])) {
    $new = $_POST['new'];
    $user = $_SESSION['user'];
    $user2 = array_values($user);
} else {
    $new = 3;
}

?>

<body>
    <form method="POST">
        <?php
        if ($new == 0) {
            $a = "修改";
            $b = "revise_process.php";
        ?>
            <div class="header">
                <h1>使用者資料修改</h1>
            </div>
            <div class="nav-bar">
                <a href="function.php">主頁</a>
                <div class="user-info">
                    <?php
                    echo "<p>目前使用者: " . end($user2) . $user2[1] . "</p>"; ?>
                </div>
            </div><?php
                } else {
                    $a = "註冊";
                    $b = "user_register_process.php";
                    ?>
            <div class="header">
                <h1>使用者註冊</h1>
            </div>
            <div class="nav-bar">
                <a href="user_login.php">登入</a>
            </div>
        <?php
                }
        ?>
        <div>
            <input type="text" placeholder="使用者姓名" name="user_register_name" />
            <br />
            <input type="email" placeholder="帳號" name="user_register_email" />
            <br />
            <input type="password" placeholder="密碼" name="user_register_password" />
            <br />
            <input type="tel" placeholder="電話號碼" name="user_register_phone_number" pattern="[0-9]{10}" required title ="請輸入正確09開頭電話號碼" />
            <br />
            <input type="text" placeholder="地址" name="user_register_address" />
            <br />
            <input type="hidden" name="who" value="owner">
            <input type="submit" value="<?php echo $a; ?>" name="user_register" formaction="<?php echo $b; ?>">
        </div>
    </form>
</body>

</html>
<?
