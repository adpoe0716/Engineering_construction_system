<?php
$link = @mysqli_connect(
    'localhost',
    'adpoe',
    '123456',
    'engineering_construction_system'
);
if ($link) {
    echo "ok<br/>";
} else {
    "0";
};

$sql = "SELECT * FROM `user`";

if ($k = mysqli_query($link, $sql)) {
    while ($row = mysqli_fetch_assoc($k)) {
        echo implode("-", $row) . "<br/>";
        //echo $row["user_id"] . "-" . $row["user_name"] . "<br/>";
    }
}

$a=1;
$b=$a;
$b++;
echo $a;

/*
buildcase 201
company   801
case2company 601
compant_type 701木工702水電 703泥作 704油漆
user  101
principal 901 
*/