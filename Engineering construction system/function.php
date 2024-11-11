<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 20px;
            background-color: #f2f2f2;
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
    </style>
</head>
<?php
session_start();
$user = $_SESSION['user'];
$user2 = array_values($user);

?>

<body>
    <div class="header">
        <h1>工程建案管理系統</h1>
    </div>
    <form method="POST">
        <div class="nav-bar">
            <a href="user_login.php">登出</a>
            <div class="user-info">
                <?php
                echo "<p>目前使用者: " . end($user2) . $user2[1] . "</p>";
                ?>
            </div>

        </div>

        <div>
            <?php if ($user2[0] >= 900) { ?>
                <input type="submit" value="新增建案" formaction="new_case.php">
                <input type="submit" value="刪除建案" formaction="case_delete.php">
                <input type="submit" value="用戶管理" formaction="user_management.php">
            <?php } ?>
            <input type="submit" value="建案日誌" formaction="case_diary_guide.php">
            <input type="submit" value="負責人/建商/業主查詢" name="search" formaction="search.php">
            <?php if ($user2[0] >= 100 && $user2[0] <= 200) { ?>
                <input type="hidden" name="new" value='0'>
                <input type="submit" value="個人資料修改" name="revise" formaction="user_register.php">
            <?php } ?>
        </div>
</body>

</html>