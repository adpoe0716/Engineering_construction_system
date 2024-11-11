<?php
$link = @mysqli_connect(
    'localhost',
    'adpoe',
    '123456',
    'engineering_construction_system'
);

$id_num = "SELECT COUNT(buildcase_id) AS total FROM `buildcase`";
$id_num2 = "SELECT COUNT(case2company_id) AS total FROM `case2company`";

// 執行查詢
$result1 = mysqli_query($link, $id_num);
$result2 = mysqli_query($link, $id_num2);
// 檢查查詢結果
if ($result1) {
    // 提取結果行
    $row1 = mysqli_fetch_assoc($result1);

    // 獲取數量
    $userCount = $row1['total'] + 201;
    global $userCount;
}
if ($result2) {
    // 提取結果行
    $row2 = mysqli_fetch_assoc($result2);

    // 獲取數量
    $userCount2 = $row2['total'] + 601;
    global $userCount2;
}
echo $userCount2;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $build_name = $_POST["build_name"];
    $build_introduction = $_POST["build_introduction"];
    $build_start_date = $_POST["build_start_date"];
    $build_end_date = $_POST["build_end_date"];
    $build_address = $_POST["build_address"];

    //$build_company = $_POST["selected_companies[]"];

    $build_principal = $_POST["build_principal"];
    $build_owner = $_POST["build_owner"];
    $build_company = $_POST['selected_companies'];


    $selectedCompaniesIds = $_POST['selected_companies_ids'];
    $selectedIds = array_map('intval', explode(',', $selectedCompaniesIds));

    foreach ($selectedIds as $company) {
        echo $company;
    }
}
// 在此使用 $selectedIds 進行後續處理



// 进行数据库插入操作
if ($link) {

    $query3 = "INSERT INTO `buildcase` (`buildcase_id`, `buildcase_name`, `buildcase_Introduction`, `buildcase_start`, 
        `buildcase_end`, `buildcase_address`,`buildcase_principal`,
        `buildcase_owner`) VALUES ('$userCount', '$build_name', '$build_introduction','$build_start_date', 
        '$build_end_date', '$build_address','$build_principal','$build_owner')";
    // $result = mysqli_query($link, $query);

    if (mysqli_query($link, $query3)) {


        //echo "建立。";
        session_start();
        $_SESSION['buile_date'] = array(
            'userCount' => $userCount,
            'build_start_date' => $build_start_date,
            'build_end_date' => $build_end_date
        );
        echo $userCou;
        foreach ($selectedIds as $companyId) {
            $query5 = "INSERT INTO `case2company` (`case2company_id`, `2company_id`, `2case_id`) VALUES ('$userCount2', '$companyId', '$userCount')";
            $userCount2++;
            echo $userCount2;
            if (mysqli_query($link, $query5)) {
                echo "建立成功。";;
            } else {
                echo "建立失敗，請重試。";
            }
        }
         echo '<script>alert("建立成功！請建立建案日程表"); window.location.href = "date.php";</script>';
    } else {
        echo "建立失敗，請重試。";
    }
} else
    echo "資料庫連接失敗。";
//sleep(3);




mysqli_close($link);
