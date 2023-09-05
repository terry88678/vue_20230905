<?php
// username:帳號(不得為空白，必須存在)
// {"state" : true,"message":"此帳號不存在可以使用"}
// {"state" : true,"message":"此帳號已存在不可使用"}
// {"state" : true,"message":"欄位不允許空白"}
// {"state" : true,"message":"欄位錯誤"}



if (isset($_POST["username"])) {
    if ($_POST["username"] != "" ) {
        $p_username = $_POST["username"];

        require_once "dbtools.php";

        $conn = create_connect();
        $sql = "SELECT Username FROM member WHERE Username = '$p_username'";
        $result = execute_sql($conn, 'testdb', $sql);

        if (mysqli_num_rows($result) == 0) {
            echo '{"state" : true,"message":"此帳號不存在可以使用"}';
        } else {
            echo '{"state" : false,"message":"此帳號已存在不可使用"}';
        }
        mysqli_close($conn);
    } else {
        echo '{"state" : true,"message":"欄位不允許空白"}';
    }
} else {
    echo '{"state" : true,"message":"欄位錯誤(帳號)"}';
}
