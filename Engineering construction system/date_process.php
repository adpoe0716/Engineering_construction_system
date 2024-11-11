
<?php


$link = @mysqli_connect('localhost', 'adpoe', '123456', 'engineering_construction_system');
$workDates = $_POST['work_date'];
$workNames = $_POST['work_name'];
// foreach ($workDates as $workDate) {
//     foreach ($workDate as $a) {
//         echo $a."\n";
//     }
//     echo "<br/>";
// }

// foreach ($workNames as $a) {
//     echo $a."\n";
// }


$aArray = []; // 创建空的字符串数组

foreach ($workDates as $workDate) {
    $aString = ''; // 创建空的字符串

    foreach ($workDate as $a) {

        $aString .= $a . ", "; // 將 $a 的值追加到字串變數並加上逗號
    }

    $aString = rtrim($aString, ", "); // 移除,
    $aArray[] = $aString; // 将 $aString 添加到字符串数组中
}

// 输出字符串数组
foreach ($aArray as $index => $a) {
    echo "\$a[$index] = $a<br/>";
    echo "Index: $index, Value: $a<br/>";
}

foreach ($workNames as $a) {
    echo $a . "\n";
}





session_start();
$userCount = $_SESSION['buile_date']['userCount'];
$build_start_date = $_SESSION['buile_date']['build_start_date'];
$build_end_date = $_SESSION['buile_date']['build_end_date'];
$num = count($workNames);

$start = new DateTime($build_start_date);
$end = new DateTime($build_end_date);
$interval = $start->diff($end);
$days = $interval->days;




$id_num = "SELECT COUNT(case_schedule_id) AS total FROM `case_schedule`";
$result = mysqli_query($link, $id_num);
if ($result) {

    $row = mysqli_fetch_assoc($result);

    $caseCount = $row['total'] + 1;
    global $caseCount;
}

foreach ($workNames as $index => $workName) {
    $a = $aArray[$index];
    echo $workName . " " . $a . "<br/>";
    $query = "INSERT INTO `case_schedule` (`case_schedule_id`, `case_schedule_start`, `case_schedule_end`,`many`,`case_schedule_work`, 
     `case_schedule_buildcase`) VALUES ('$caseCount', '$build_start_date', '$build_end_date','$a','$workName', 
      '$userCount')";
    mysqli_query($link, $query);
    $caseCount++;
}
echo '<script>alert("建案日程表建立成功!"); window.location.href = "function.php";</script>';


// array(1) {有幾項工作被勾選
//     [1]=> //name
//     array(1) {
//       [0]=>
//       string(1) "0" //第幾個被勾選
//     }
//   }
