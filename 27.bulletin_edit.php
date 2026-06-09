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

        // 建立修改佈告的 SQL 指令
        // 根據 bid 修改標題、內容、時間與類型
        $sql = "
            update bulletin
            set
                title='{$_POST['title']}',
                content='{$_POST['content']}',
                time='{$_POST['time']}',
                type={$_POST['type']}
            where bid='{$_POST['bid']}'
        ";

        // 執行 SQL 指令
        if (!mysqli_query($conn, $sql)) {

            // 修改失敗時顯示訊息
            echo "修改錯誤";

            // 3 秒後返回佈告欄列表頁面
            echo "<meta http-equiv=REFRESH content='3, url=11.bulletin.php'>";
        }
        else {

            // 修改成功時顯示訊息
            echo "修改成功，三秒鐘後回到佈告欄列表";

            // 3 秒後返回佈告欄列表頁面
            echo "<meta http-equiv=REFRESH content='3, url=11.bulletin.php'>";
        }
    }
?>
