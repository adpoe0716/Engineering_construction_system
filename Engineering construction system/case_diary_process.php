<?php
$link = @mysqli_connect(
    'localhost',
    'adpoe',
    '123456',
    'engineering_construction_system'
);

 $user_input = $_POST['user_input'];
// $build = $_POST['build'];
session_start();
$user = $_SESSION['user'];
$user2 = array_values($user);
$case = $_SESSION['case_build'];

$currentDateTime = date('Y-m-d H:i');
//echo $currentDateTime."  ".$user_input ."  by".end($user2).$user2[1];
$input_text=$currentDateTime."  [".$user_input ."]  by ".end($user2).$user2[1];
echo $input_text;

$id_num = "SELECT COUNT(case_diary_id) AS total FROM `case_diary`";
$result = mysqli_query($link, $id_num);
if ($result) {
    $row = mysqli_fetch_assoc($result);
    $userCount = $row['total'] + 1;
    global $userCount;
}

$query = "INSERT INTO `case_diary` (`case_diary_id`,`build` , `case_diary_text`,`who`) VALUES ('$userCount','$case','$input_text', '$user2[0]')";
$result = mysqli_query($link, $query);
header("Location:case_diary.php");
exit();
?>