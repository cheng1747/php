<?php
    // 關閉錯誤訊息顯示
    error_reporting(0);

    // 啟用 Session 功能
    session_start();

    // 判斷使用者是否已登入
    // 如果 Session 中沒有 id，代表尚未登入
    if (!$_SESSION["id"]) {

        // 顯示提示訊息
        echo "請登入帳號";

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

        // 建立刪除佈告的 SQL 指令
        // 根據網址傳來的 bid 刪除指定佈告
        $sql = "delete from bulletin where bid='{$_GET["bid"]}'";

        // 顯示 SQL 指令（除錯時可取消註解）
        // echo $sql;

        // 執行 SQL 指令
        if (!mysqli_query($conn, $sql)) {

            // 刪除失敗時顯示訊息
            echo "佈告刪除錯誤";
        }
        else {

            // 刪除成功時顯示訊息
            echo "佈告刪除成功";
        }

        // 3 秒後自動跳轉回佈告欄列表頁面
        echo "<meta http-equiv=REFRESH content='3, url=11.bulletin.php'>";
    }
?>
