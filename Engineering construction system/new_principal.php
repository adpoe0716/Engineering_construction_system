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
    </style>
</head>

<body>
    <form method="POST">
        <div class="header">
            <h1>負責人新增</h1>
        </div>
        <div class="nav-bar">
            <a href="user_management.php">上一頁</a>
            <a href="function.php">主頁</a>
            <a href="user_login.php">登出</a>
        </div>
        <input type="text" placeholder="負責人姓名" name="user_register_name" />
        <br />
        <input type="email" placeholder="帳號" name="user_register_email" />
        <br />
        <input type="password" placeholder="密碼" name="user_register_password" />
        <br />
        <input type="tel" placeholder="電話號碼" name="user_register_phone_number" pattern="[0-9]{10}" required title ="請輸入正確09開頭電話號碼" />
        <br />
        <input type="hidden" name="who" value="principal">
        <input type="submit" value="註冊" name="user_register" formaction="user_register_process.php">
</body>

</html>
<?
