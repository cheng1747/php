<?php
    // 關閉錯誤訊息顯示
    error_reporting(0);

    // 啟用 Session 功能
    session_start();

    // 判斷使用者是否已登入
    // 如果 Session 中沒有 id，代表尚未登入
    if (!$_SESSION["id"]) {

        // 顯示提示訊息
        echo "please login first";

        // 3 秒後自動跳轉到登入頁面
        echo "<meta http-equiv=REFRESH content='3, url=2.login.html'>";
    }
    else {

        // 建立資料庫連線
        // mysqli_connect(主機, 帳號, 密碼, 資料庫名稱)
        $conn = mysqli_connect(
            "120.105.96.90",
            "immust",
            "immustimmust",
            "immust"
        );

        // 建立新增佈告的 SQL 指令
        // insert into 資料表(欄位)
        // values(對應的值)
        $sql = "
            insert into bulletin(title, content, type, time)
            values(
                '{$_POST['title']}',
                '{$_POST['content']}',
                {$_POST['type']},
                '{$_POST['time']}'
            )
        ";

        // 執行 SQL 指令
        if (!mysqli_query($conn, $sql)) {

            // 新增失敗時顯示訊息
            echo "新增命令錯誤";
        }
        else {

            // 新增成功時顯示訊息
            echo "新增佈告成功，三秒鐘後回到網頁";

            // 3 秒後自動跳轉回佈告頁面
            echo "<meta http-equiv=REFRESH content='3, url=11.bulletin.php'>";
        }
    }
?>
