<?php

$link = @mysqli_connect('localhost', 'adpoe', '123456', 'engineering_construction_system');
session_start();
$case_id = $_SESSION['case_build'];
$user = $_SESSION['user'];
$user2 = array_values($user);
$photo_num = "SELECT COUNT(`photo_id`) AS total FROM `photo`";


$result = mysqli_query($link, $photo_num);


if ($result) {
   // 提取結果行
    $row = mysqli_fetch_assoc($result);

  
    $photoCount = $row['total'] + 1;
    global $photoCount;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $selectedDate = $_POST['date_photo'];
    $photoData = file_get_contents($_FILES['photo']['tmp_name']);
    $photoName = $_FILES['photo']['name'];

 
    $query = "INSERT INTO `photo` (`photo_id`, `photo_name`, `photo`, `photo_up`, `photo_case`, `photo_date`) VALUES (?, ?, ?, ?, ?, ?)";
    $statement = mysqli_prepare($link, $query);
    mysqli_stmt_bind_param($statement, 'ssssss', $photoCount, $photoName, $photoData, $user2[0], $case_id, $selectedDate);
    mysqli_stmt_execute($statement);


    if (mysqli_stmt_affected_rows($statement) > 0) {
        echo "成功！";
    } else {
        echo "失敗！";
    }
   
    mysqli_stmt_close($statement);
    mysqli_close($link);
    header("Location:case_diary.php");
}
?>
