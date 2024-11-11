<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>生成表格</title>
    <style>
        table {
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
        }

        .checkbox {
            width: 50px;
            height: 50px;
        }
    </style>
</head>

<body>
    <form method="POST">
        <?php
        session_start();
        $userCount = $_SESSION['buile_date']['userCount'];
        $build_start_date = $_SESSION['buile_date']['build_start_date'];
        $build_end_date = $_SESSION['buile_date']['build_end_date'];

        //echo $build_start_date. $build_end_date;



        if (isset($_POST["num_of_works"])) {
            $num_of_works = $_POST["num_of_works"];
            intval($num_of_works);
        } else {
            $num_of_works = 5; // 工作数量
        }
        //echo $num_of_works;
        // 日期範圍和工作數量

        // 計算日期範圍的天數
        $start = new DateTime($build_start_date); //生成日期物件2022/03/05 2023-26-06
        $end = new DateTime($build_end_date);
        $interval = $start->diff($end); //取得日期的差距
        $num_of_days = $interval->days + 1;


        //設定地區(調整中文星期用的)
        //$locale = 'zh_TW';  // 設定地區
        //$formatter = new IntlDateFormatter($locale, IntlDateFormatter::NONE, IntlDateFormatter::NONE, 'Asia/Taipei', IntlDateFormatter::GREGORIAN, 'EEEE');


        // 生成表格
        echo "<table>";
        echo "<tr>";
        echo "<th>建案日誌規劃</th>"; // 空白表頭
        for ($day = 0; $day < $num_of_days; $day++) {
            $date = clone $start; //避免更改$date時$start一起動到 (物件)
            $date->modify("+$day day"); //+1天 +2 天 +3天...
            //echo "<th>" . $date->format("Y-m-d") ."<br/>".$formatter->format($date). "</th>";
            echo "<th>" . $date->format("Y-m-d") . "<br/>" . $date->format('l') . "</th>";
        }
        echo "</tr>";

        for ($work = 1; $work <= $num_of_works; $work++) {
            echo "<tr>";
            echo "<th><textarea name='work_name[]' placeholder='預定工作事項'>";
            if (isset($_POST['work_name'][$work - 1])) {
                echo $_POST['work_name'][$work - 1];
            }
            echo "</textarea></th>";
            for ($day = 0; $day < $num_of_days; $day++) {
                echo "<td><input type='checkbox' class='checkbox' name='work_date[$work][]' value='$day'";

                if (isset($_POST['work_date'][$work]) && is_array($_POST['work_date'][$work]) && in_array($day, $_POST['work_date'][$work])) {
                    echo " checked";
                }
                echo "></td>"; // 空白單元格
            }
            echo "</tr>";
        }



        echo "</table>";
        $num_of_works = intval($num_of_works);
        $num_of_works = $num_of_works + 1;
        echo "<input type='hidden' name='num_of_works' value='$num_of_works'>";
        echo "<input type='hidden' name='build_start_date' value='$build_start_date'>";
        echo "<input type='hidden' name='build_end_date' value='$build_end_date'>";
        echo "<input type='submit' value='增加工作'  formaction='date.php'>";
        echo "<input type='submit' value='確認' formaction='date_process.php'>";
        
        ?>
    </form>
</body>

</html>