<!DOCTYPE html>
<html lang="en">

<?php
// 连接到数据库
$link = @mysqli_connect(
  'localhost',
  'adpoe',
  '123456',
  'engineering_construction_system'
);
if (!$link) {
  die("数据库连接失败: " . mysqli_connect_error());
}
// 从数据库中检索公司数据
$query = "SELECT * FROM company";
$query2 = "SELECT * FROM `principal`";
$query3 = "SELECT * FROM `user`";
$result = mysqli_query($link, $query);
$result2 = mysqli_query($link, $query2);
$result3 = mysqli_query($link, $query3);

?>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>建案建立</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f1f1f1;
      padding: 20px;
    }

    .header {
      background-color: #333;
      color: #fff;
      padding: 20px;
      text-align: center;
    }
    .container {
      max-width: 600px;
      margin: 0 auto;
      background-color: #fff;
      border-radius: 8px;
      padding: 20px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .h1 {
      font-size: 24px;
      color: #333;
      margin-bottom: 20px;
    }

    input[type="text"],
    input[type="date"],
    select {
      margin-bottom: 10px;
      padding: 8px;
      width: 100%;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    .submit-btn {
      background-color: #4CAF50;
      color: #fff;
      border: none;
      padding: 10px 20px;
      font-size: 16px;
      border-radius: 4px;
      cursor: pointer;
    }

    .submit-btn:hover {
      background-color: #45a049;
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
<?php
session_start();
$user = $_SESSION['user'];
$user2 = array_values($user);

?>

<body>
  <div class="header">
    <h1>建案建立</h1>
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
    <div class="container">

      <label for="build_name">建案名稱：</label>
      <input type="text" id="build_name" placeholder="建案名稱" name="build_name" /><br />

      <label for="build_introduction">工程概要：</label>
      <input type="text" id="build_introduction" placeholder="工程概要" name="build_introduction" /><br />

      <label for="build_start_date">施工起始日：</label>
      <input type="date" id="build_start_date" placeholder="施工起始日" name="build_start_date" /><br />

      <label for="build_end_date">施工結束日：</label>
      <input type="date" id="build_end_date" placeholder="施工結束日" name="build_end_date" /><br />

      <label for="build_address">施工地點：</label>
      <input type="text" id="build_address" placeholder="build_address" name="build_address" /><br />



      <label for="build_company_select">施工廠商：</label>
      <select name="selected_companies" id="build_company_select" multiple>
        <?php
        // 创建下拉列表的选项
        while ($row = mysqli_fetch_assoc($result)) {
          echo '<option value="' . $row['company_id'] . '">' . $row['company_type'] . "--" . $row['company_name'] . '</option>';
        }
        ?>
      </select><br />

      <button class="submit-btn" type="button" onclick="updateValues()">選擇建商/工班</button>
      <input type="text" id="selected_companies" placeholder="選取建商/工班" name="selected_companies" readonly /><br />
      <input type="hidden" id="selected_companies_ids" name="selected_companies_ids" /><br />


      <script>
        function updateValues() {
          var select = document.getElementById("build_company_select");
          var selectedOptions = select.selectedOptions;
          var selectedNames = [];
          var selectedIds = [];

          for (var i = 0; i < selectedOptions.length; i++) {
            var optionName = selectedOptions[i].text;
            var optionId = parseInt(selectedOptions[i].value); // 將 ID 解析為整數
            selectedNames.push(optionName);
            selectedIds.push(optionId);
          }

          document.getElementById("selected_companies").value = selectedNames.join(", ");
          document.getElementById("selected_companies_ids").value = selectedIds.join(",");
        }
      </script>



      <label for="build_principal_select">負責人名稱：</label>
      <select name="build_principal" id="build_principal_select">
        <?php
        // 创建下拉列表的选项
        while ($row2 = mysqli_fetch_assoc($result2)) {
          echo '<option value="' . $row2['principal_id'] . '">' . $row2['principal_name'] . '</option>';
        }
        ?>
      </select><br />

      <label for="build_owner_select">業主姓名：</label>
      <select name="build_owner" id="build_owner_select">
        <?php
        // 创建下拉列表的选项
        while ($row3 = mysqli_fetch_assoc($result3)) {
          echo '<option value="' . $row3['user_id'] . '">' . $row3['user_name'] . '</option>';
        }
        ?>

      </select><br />
      <input type="submit" value="建立" formaction="new_case_process.php" />


    </div>
</body>

</html>

<?php

// 关闭数据库连接
mysqli_close($link);
?>