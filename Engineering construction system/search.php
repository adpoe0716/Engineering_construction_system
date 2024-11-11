<?php
session_start();
$user = $_SESSION['user'];
$user2 = array_values($user);

$link = @mysqli_connect(
    'localhost',
    'adpoe',
    '123456',
    'engineering_construction_system'
);
$query = "SELECT * FROM `user`";
$result = mysqli_query($link, $query);

$query2 = "SELECT * FROM `principal`";
$result2 = mysqli_query($link, $query2);

$query3 = "SELECT * FROM `company`";
$result3 = mysqli_query($link, $query3);





if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["who"])) {
    $who = $_POST["who"];
} else {
    $who = end($user2);
}
//echo $who;
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <style>
        /* CSS styles */
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
        .user-info {
            margin-left: auto;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>負責人/建商查詢</h1>
    </div>
    <div class="nav-bar">
        <a href="function.php">主頁</a>
        <a href="user_login.php">登出</a>
        <div class="user-info">
            <?php
            echo "<p>目前使用者: " . end($user2) . $user2[1] . "</p>";
            ?>
        </div>
    </div>



    <form method="post">
        <?php
        if (isset($_POST['who']) && $_POST['who'] != "") {
            $who = $_POST['who'];
            echo $who . "<br>";
            echo '<input type="hidden" name="who" value="' . $who . '" />';
            echo '<div>
            <select name="who2" id="user">';
            if ($who == '業主') {
                while ($row = $result->fetch_assoc()) {
                    echo '<option value="' . $row['user_id'] . '">' . $row['user_name'] . "</option>";
                }
            } else if ($who == '負責人') {
                while ($row = $result2->fetch_assoc()) {
                    echo '<option value="' . $row['principal_id'] . '">' . $row['principal_name'] . "</option>";
                }
            } else if ($who == '工班') {
                while ($row = $result3->fetch_assoc()) {
                    echo "<option value='" . $row['company_id'] . "'>" . $row['company_name'] . "</option>";
                }
            }
            echo '</select>
            <input type="submit" value="查詢" formaction="">
            </div>';
        } else {
            echo '<select name="who" id="who">
            <option value="負責人">負責人</option>
            <option value="業主">業主</option>
            <option value="工班">工班</option>
            </select>
            <input type="submit" value="職位查詢" formaction="">';
        }

        if (isset($_POST['who2'])) {
            $who2 = $_POST['who2'];
            // echo $who . $who2;
            if ($who2 >= 100 && $who2 <= 200) {
                //echo $who2;
                $query4 = "SELECT * FROM `user` where `user_id` = $who2";
                $result4 = mysqli_query($link, $query4);
            } else if ($who2 >= 800 && $who2 <= 900) {
                $query4 = "SELECT * FROM `company` where `company_id` = '$who2'";
                $result4 = mysqli_query($link, $query4);
            } else if ($who2 >= 900) {
                $query4 = "SELECT * FROM `principal` where `principal_id` = '$who2'";
                $result4 = mysqli_query($link, $query4);
            }


            $result4 = mysqli_query($link, $query4);
            if ($result4) {
                $out = mysqli_fetch_assoc($result4);
                $out2 = array_values($out);
                // echo $out2[0];
                echo '<div>
            <h3>資料顯示:</h3>
            <p>姓名:' .  $out2[1] . '</p>
            <p>帳號:' .   $out2[2] . '</p>';
                // <p>密碼:' .   $out2[3] . '</p>';

                if ($out2[0] >= 800 && $out2[0] <= 900) {
                    echo '<p>工種:' . $out2[5]  . '</p>';
                } else {
                    echo '<p>電話:' . $out2[4]  . '</p>';
                }


                if ($out2[0] >= 100 && $out2[0] <= 800) {
                    echo '<p>地址:' . $out2[5]  . '</p>';
                }

                '</div>';
            } else {
                echo "查詢失敗";
            }
            if ($out2[0] >= 800 && $out2[0] <= 900) {
                //echo 123 . $out2[0];
                $query5 = "SELECT * FROM `case2company` WHERE `2company_id` = '$out2[0]'";
                $result5 = mysqli_query($link, $query5);
                if ($result5) {
                    echo '曾參與建案:' . '<br/>';
                    while ($case = mysqli_fetch_assoc($result5)) {
                        $case2 = array_values($case);
                        $query6 = "SELECT * FROM `buildcase` WHERE `buildcase_id` = '$case2[2]'";
                        $result6 = mysqli_query($link, $query6);

                        if ($result6) {
                            while ($build = mysqli_fetch_assoc($result6)) {
                                $build2 = array_values($build);
                                echo  $build2[1] . '<br/>';
                            }
                        }
                    }
                } else {
                    echo "沒有";
                }
            } else if ($out2[0] >= 900) {
                $query5 = "SELECT * FROM `buildcase` WHERE `buildcase_principal` = '$out2[0]'";
                $result5 = mysqli_query($link, $query5);
                if ($result5) {
                    echo '曾負責建案:' . '<br/>';
                    while ($case = mysqli_fetch_assoc($result5)) {
                        $case2 = array_values($case);
                        echo $case2[1] . '<br/>';
                    }
                }
            } else if ($out2[0] >= 100 && $out2[0] <= 200) {
                $query5 = "SELECT * FROM `buildcase` WHERE `buildcase_owner` = '$out2[0]'";
                $result5 = mysqli_query($link, $query5);
                if ($result5) {
                    echo '曾委託建案:' . '<br/>';
                    while ($case = mysqli_fetch_assoc($result5)) {
                        $case2 = array_values($case);
                        echo $case2[1] . '<br/>';
                    }
                }
            }
        }
        ?>
    </form>
    <form method="post">
        <?php
        if (isset($_POST['who']) && $_POST['who'] != "") {
            echo '<input type="hidden" name="who" value="" />';
            echo '<input type="submit" name="submit" value="重新查詢" />';
        }
        ?>
    </form>




</body>

</html>