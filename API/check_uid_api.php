<?php
// uid:(不得為空白，必須存在)
// {"state" : true,"message":"uid驗證成功", "data":"會員資料"}
// {"state" : false,"message":"uid驗證失敗"}
// {"state" : false,"message":"欄位不允許空白"}
// {"state" : false,"message":"欄位錯誤(UID)"}

if(isset($_POST["uid"])){
    if($_POST["uid"] != ""){   
        $p_uid = $_POST["uid"];

require_once "dbtools.php";

$conn = create_connect();
$sql = "SELECT ID, Username, Nickname, Email, Created_at, interest, address FROM member WHERE uid01 = '$p_uid'";

$result = execute_sql($conn, 'testdb', $sql);
if (mysqli_num_rows($result) > 0) {
    $mydata = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $mydata[] = $row;
    }
    echo '{"state" : true, "message" : "uid驗證成功", "data" : ' . json_encode($mydata) . '}';
} else {
    echo '{"state" : false, "message" : "uid驗證失敗"}';
}

mysqli_close($conn);
    }else{
        echo '{"state" : false,"message":"欄位不允許空白"}';
    }
}else{
    echo '{"state" : false,"message":"欄位錯誤(UID)"}';
}