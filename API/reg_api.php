<?php
if (isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["nickname"]) && isset($_POST["email"]) && isset($_POST["interest"]) && isset($_POST["address"])) {
    if ($_POST["username"] != "" && $_POST["password"] != "" && $_POST["nickname"] != "" && $_POST["email"] != "" && $_POST["interest"] != "" && $_POST["address"] != "") {
        $p_username = $_POST["username"];
        $p_password = md5(substr(md5($_POST["password"]),0,5).substr(md5($_POST["password"]),27,5)) ;
        $p_nickname = $_POST["nickname"];
        $p_email    = $_POST["email"];
        $p_interest = $_POST["interest"];
        $p_address  = $_POST["address"];

        require_once "dbtools.php";

        $conn = create_connect();
        $sql = "INSERT INTO member(Username, Password, Nickname, Email, interest, address) VALUES('$p_username', '$p_password', '$p_nickname', '$p_email', '$p_interest', '$p_address')";
        if (execute_sql($conn, 'testdb', $sql)) {
            echo '{"state" : true, "message" : "註冊成功"}';
        } else {
            echo '{"state" : false, "message" : "註冊失敗"}';
        }
        mysqli_close($conn);
    } else {
        echo '{"state" : false, "message" : "欄位不允許空白"}';
    }
} else {
    echo '{"state" : false, "message" : "欄位錯誤(註冊)"}';
}
