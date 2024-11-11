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
            background-color: #f1f1f1;
            padding: 20px;
        }

        .container {
            max-width: 400px;
            margin: 0 auto;
            background-color: #fff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        p {
            margin-bottom: 10px;
            font-size: 18px;
        }

        select {
            padding: 8px;
            width: 30%;
            border: 1px solid #ccc;
            border-radius: 4px;
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
            text-decoration: wavy;
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
$link = @mysqli_connect(
    'localhost',
    'adpoe',
    '123456',
    'engineering_construction_system'
);


if (!$link) {
    die('無法連接到資料庫: ' . mysqli_connect_error());
}

session_start();
$user = $_SESSION['user'];
$user2 = array_values($user);
//echo $user2[2];
$user_id = $user2[0];

if (end($user2) == '負責人') {
    $query = "SELECT * FROM `buildcase` WHERE `buildcase_principal` = $user_id";
} else if (end($user2) == '業主') {
    $query = "SELECT * FROM `buildcase` WHERE `buildcase_owner` = $user_id";
} else if (end($user2) == '工班') {
    $query2 = "SELECT * FROM `case2company` WHERE `2company_id` = $user_id";
    $result2 = mysqli_query($link, $query2);
    $row2 = mysqli_fetch_assoc($result2);
    $query = "SELECT * FROM `buildcase` WHERE `buildcase_id` =" . $row2['2case_id'];
}

$result = mysqli_query($link, $query);
/*

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {

        echo $row['buildcase_name'];
    }
}
//var_dump($result);
*/
?>

<body>
    <div class="nav-bar">
        <a href="function.php">主頁</a>
        <a href="user_login.php">登出</a>
        <div class="user-info">
            <?php
            echo "<p>目前使用者: " . end($user2) . $user2[1] . "</p>";
            ?>
        </div>
    </div>
    <p>欲觀看之建案</p>
    <form method="post" action="case_diary.php">
        <select name="build" id="build">
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
                if (end($user2) == '工班') {
                    echo "<option value='" . $row['2company_id'] . "'>" . $row['2case_id'] . "</option>";
                }
                echo "<option value='" . $row['buildcase_id'] . "'>" . $row['buildcase_name'] . "</option>";
            }
            ?>
        </select>
        <input type="submit" value="進入建案日誌" formaction="case_diary.php">
    </form>
</body>


</html>