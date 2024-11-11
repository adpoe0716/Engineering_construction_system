<?php
$link = @mysqli_connect(
    'localhost',
    'adpoe',
    '123456',
    'engineering_construction_system'
);
$case_id = $_POST['build'];

$query = "DELETE FROM buildcase WHERE `buildcase`.`buildcase_id` = $case_id";
$query2 = "DELETE FROM `case2company` WHERE 2case_id = $case_id";
$query3 = "DELETE FROM `case_diary` WHERE build = $case_id";
$query4 = "DELETE FROM `case_schedule` WHERE case_schedule_buildcase = $case_id";
$query5 = "DELETE FROM `photo` WHERE photo_case = $case_id";

$queryString = $query5 . ";" . $query4 . ";" . $query3 . ";" . $query2 . ";" . $query;

if (mysqli_multi_query($link, $queryString)) {
    do {
 
        if ($result = mysqli_store_result($link)) {
       
            mysqli_free_result($result);
        }
    } while (mysqli_next_result($link));
} else {
 
}
echo '<script>alert("刪除成功！"); window.location.href = "function.php";</script>';
mysqli_close($link);
