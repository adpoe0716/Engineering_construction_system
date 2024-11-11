<?php
session_start();
$user = $_SESSION['user'];
$user2 = array_values($user);


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <style>
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

        input[type="submit"] {
            margin: 10px;
            padding: 15px 30px;
            font-size: 20px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .user-info {
            margin-left: auto;
        }

        body {
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 20px;
            background-color: #f2f2f2;
        }
    </style>

<body>
    <div class="header">
        <h1>用戶管理</h1>
    </div>
    <form method="POST">
        <div class="nav-bar">
            <a href="user_login.php">登出</a>
            <a href="function.php">主頁</a>
            <div class="user-info">
                <?php
                echo "<p>目前使用者: " . end($user2) . $user2[1] . "</p>";
                ?>
            </div>
        </div>

        <div>
            <input type="submit" value="負責人新增" formaction="new_principal.php">
            <input type="submit" value="工班建商新增" formaction="new_company.php">
</body>

</html>