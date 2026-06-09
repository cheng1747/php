<?php

// 關閉錯誤訊息顯示
error_reporting(0);

// 啟用 Session 功能
session_start();

// 判斷是否已登入
// 如果 Session 裡沒有 id，表示尚未登入
if (!$_SESSION["id"]) {

    // 顯示提示訊息
    echo "請登入帳號";

    // 3 秒後自動跳轉到登入頁面
    echo "<meta http-equiv=REFRESH content='3, url=2.login.html'>";
}
else {    

   // mysqli_connect()：建立資料庫連線
   // 參數依序為：主機位置、帳號、密碼、資料庫名稱
   $conn = mysqli_connect(
       "120.105.96.90",
       "immust",
       "immustimmust",
       "immust"
   );

   // 建立新增資料的 SQL 指令
   // insert into 表格名稱(欄位1,欄位2)
   // values(值1,值2)
   $sql = "insert into user(id,pwd)
           values('{$_POST['id']}', '{$_POST['pwd']}')";

   // 顯示 SQL 指令（除錯時可取消註解）

   // mysqli_query()：執行 SQL 指令
   if (!mysqli_query($conn, $sql)) {

     // 新增失敗時顯示訊息
     echo "新增命令錯誤";
   }
   else {

     // 新增成功訊息
     echo "新增使用者成功，三秒鐘後回到網頁";

     // 3 秒後自動跳轉回使用者管理頁面
     echo "<meta http-equiv=REFRESH content='3, url=18.user.php'>";
   }
}
?>
