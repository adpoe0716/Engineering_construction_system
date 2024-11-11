<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>
    <title>建案日誌</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .header {
            background-color: #333;
            color: #fff;
            padding: 20px;
            text-align: center;
        }

        h1 {
            margin: 0;
        }

        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: flex-start;
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

        .message {
            flex-grow: 1;
            margin-left: 20px;
        }

        .message h2 {
            color: #333;
        }

        .photo_up {
            margin: 20px;
        }

        .photo_up select,
        .photo_up input[type="file"],
        .photo_up input[type="submit"] {
            margin-top: 10px;
        }

        .photo_out {
            margin: 20px;
        }

        .photo-wrapper {
            display: inline-block;
            margin-bottom: 20px;
        }

        .photo-date {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .photo {
            max-width: 70%;
            height: auto;
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
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $case_id = $_POST['build'];
    $_SESSION['case_build'] = $case_id;
} else {
    $case_id = $_SESSION['case_build'];
}

$query = "SELECT * FROM `buildcase` WHERE `buildcase_id` = $case_id";
$result = mysqli_query($link, $query);

$case = mysqli_fetch_assoc($result);
$case2 = array_values($case);

$stday = new DateTime($case2[3]); //生成日期物件2023-06-06


$query2 = "SELECT * FROM `case_schedule` WHERE `case_schedule_buildcase` = $case2[0]";
$result2 = mysqli_query($link, $query2);
$sehcudle = mysqli_fetch_assoc($result2);
$sehcudle2 = array_values($sehcudle);



$query3 = "SELECT many FROM `case_schedule` WHERE `case_schedule_buildcase` = $case2[0]";
$result3 = mysqli_query($link, $query3);


$query4 = "SELECT case_schedule_work FROM `case_schedule` WHERE `case_schedule_buildcase` = $case2[0]";
$result4 = mysqli_query($link, $query4);

$query5 = "SELECT * FROM `case2company` WHERE `2case_id` = $case_id";
$result5 = mysqli_query($link, $query5);

$query6 = "SELECT `case_diary_text` FROM `case_diary` WHERE `build` = $case_id";
$result6 = mysqli_query($link, $query6);


$case2company_rows = mysqli_fetch_all($result5, MYSQLI_ASSOC);
// foreach ($case2company_rows as $row) {
//     $company_id = $row['2company_id'];
//     echo $company_id . "\n";
// }

date_default_timezone_set('Asia/Taipei');
$user = $_SESSION['user'];
$user2 = array_values($user);


?>

<body>
    <div class="header">
        <h1>建案日誌</h1>
    </div>
    <div class="nav-bar">
        <a href="user_login.php">登出</a>
        <a href="case_diary_guide.php">上一頁</a>
        <a href="function.php">主頁</a>
        <div class="user-info">
            <?php
            echo "<p>目前使用者: " . end($user2) . $user2[1] . "</p>";
            ?>
        </div>

    </div>
    <div class="container">


        <div class="project-info">
            <h2>建案相關資料</h2>
            <?php
            $query7 = "SELECT * FROM principal WHERE principal_id = $case2[6]";
            $result7 = mysqli_query($link,$query7);
            $pr = mysqli_fetch_assoc($result7);
            $pr2 = $pr['principal_name'];

            $query8 = "SELECT * FROM `user` WHERE `user_id` = $case2[7]";
            $result8 = mysqli_query($link,$query8);
            $ow = mysqli_fetch_assoc($result8);
            $ow2 = $ow['user_name'];

            echo "建案名稱:" . $case2[1] . '<br/>';
            echo "建案概要:" . $case2[2] . '<br/>';
            echo "建案規畫日期:" . $case2[3] . "--" . $case2[4] . '<br/>';
            echo "建案地址:" . $case2[5] . '<br/>';
            echo "負責人:" . $pr2 . '<br/>';
            echo "業主:" . $ow2 . '<br/>';
            ?>
        </div>
        <div class="timeline">
            <h2>建案規畫日誌</h2>
            <table class="timeline-table">
                <?php
                while ($sehcudle4 = mysqli_fetch_assoc($result4)) {
                    $sehcudle44 = array_values($sehcudle4); //工作內容
                    while ($sehcudle3 = mysqli_fetch_assoc($result3)) { //many 單純$sehcudle3:第一列 0,1,2...... while後跑第二列
                        $sehcudle33 = array_values($sehcudle3);  //轉陣列->之後拆分,
                        $stday = new DateTime($case2[3]); // 生成日期物件
                        $daysToAdd = explode(', ', $sehcudle33[0]); // 將 $sehcudle33[0] 拆分成數字陣列
                        echo $sehcudle44[0] . "     ";
                        echo "<br/>";
                        foreach ($daysToAdd as $days) {
                            $stday2 = clone $stday;
                            $stday2->modify('+' . $days . ' day'); // 將日期物件增加相應的天數
                            echo $stday2->format('Y-m-d') . "  ";
                        }
                        echo "<br/>";
                        break;
                    }
                }
                ?>
            </table>
        </div>
        <div class="message">
            <h2>留言板</h2>
            <form method="POST">
                <input type='hidden' name='build' value='$case_id'>
                <h3>留言</h3>
                <textarea name="company_message" rows="20" cols="100" readonly><?php

                                                                                while ($row6 = mysqli_fetch_assoc($result6)) {
                                                                                    $case_diary_text = $row6['case_diary_text'];
                                                                                    echo $case_diary_text . "\n";
                                                                                }
                                                                                ?>
            </textarea><br>
                <input type="text" name="user_input" style="width: 750px;">
                <input type="submit" value="發表留言" formaction="case_diary_process.php">
                <?php
                ?>
            </form>
        </div>
    </div>



    <?php
    $user = $_SESSION['user'];
    $user2 = array_values($user);
    ?>


    <div class="photo_up">
        <form method="POST" enctype="multipart/form-data">
            <br>

            <select name="date_photo" id="date_photo">
                <?php
                $startDate = new DateTime($case2[3]);
                $endDate = new DateTime($case2[4]);
                $interval = new DateInterval('P1D'); // 间隔为一天
                $period = new DatePeriod($startDate, $interval, $endDate);

                foreach ($period as $date) {
                    echo '<option value="' . $date->format('Y-m-d') . '">' . $date->format('Y-m-d') . '</option>';
                }
                ?>

            </select>
            <?php
            echo '<input type="file" name="photo" id="photo-upload">';
            echo '<input type="submit" value="Upload" name="上傳" formaction="photo.php" />';
            ?>
        </form>
    </div>



    <div class="photo_out">
        <h3>照片顯示</h3>
        <?php


        foreach ($period as $date) {
            $date_str = $date->format('Y-m-d');
            $photo_query = "SELECT * FROM `photo` WHERE `photo_date` = '$date_str' AND `photo_case` = '$case_id'";
            $photo_result = mysqli_query($link, $photo_query);
            if ($photo_result) {
                while ($photo_row = mysqli_fetch_assoc($photo_result)) {
                    $photo_name = $photo_row['photo_name'];
                    $photo_data = base64_encode($photo_row['photo']);
                    echo '<div class="photo-wrapper">';
                    echo '<div class="photo-date">' . $date_str . '</div>';
                    echo '<img class="photo" src="data:image/jpeg;base64,' . $photo_data . '" alt="' . $photo_name . '">';
                    echo '</div>';
                }
            } else {
                echo '無照片可顯示';
            }
        }
        ?>
    </div>


</body>

</html>
<?php

mysqli_free_result($result);


mysqli_close($link);
?>