<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
            font-family: Arial, sans-serif;
        }

        .container {
            background-color: #33cc33;
            padding: 20px;
        }

        h1 {
            color: black;
            text-align: center;
        }

        form {
            text-align: center;
            margin-top: 50px;
        }

        input[type="text"],
        input[type="password"] {
            padding: 10px;
            width: 200px;
            margin-bottom: 10px;
        }

        input[type="submit"] {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            cursor: pointer;
        }
    </style>

</head>

<body>
    <form method="POST">
        <h1>工程建案資訊系統</h1>
        <input type="text" name="user_email" placeholder="請輸入帳號">
        <input type="text" name="user_password" placeholder="請輸入密碼">
        <br>
        <input type="submit" name="login" value="登入" formaction="user_login_process.php">

        <input type="submit" name="register" value="註冊" formaction="user_register.php">
</body>

</html>