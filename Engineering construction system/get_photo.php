<?php
// 取得選擇的日期
$link = @mysqli_connect('localhost', 'adpoe', '123456', 'engineering_construction_system');
$selectedDate = $_POST['date_photo'] ?? $startDate->format('Y-m-d');
session_start();
$case_id = $_SESSION['case_build'];
// 查詢與日期和 case_id 相符的照片
$photo_query = "SELECT * FROM `photo` WHERE `photo_date` = '$selectedDate' AND `photo_case` = '$case_id'";
$photo_result = mysqli_query($link, $photo_query);

if ($photo_result) {
    while ($photo_row = mysqli_fetch_assoc($photo_result)) {
        $photo_name = $photo_row['photo_name'];
        $photo_data = base64_encode($photo_row['photo']);
        echo '<img src="data:image/jpeg;base64,' . $photo_data . '" alt="' . $photo_name . '">';
    }
} else {
    echo '無照片可顯示';
}

header("Location:case_diary.php");
exit();
?>
