<html>

    <head>
        <title>修改使用者</title>
    </head>

    <body>

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

        // 查詢指定 id 的使用者資料
        // $_GET['id'] 是從網址取得的使用者帳號
        $result = mysqli_query(
            $conn,
            "select * from user where id='{$_GET['id']}'"
        );

        // 將查詢結果取出成陣列
        $row = mysqli_fetch_array($result);

        // 顯示修改使用者表單
        echo "

        <form method=post action=20.user_edit.php>

            <!-- 隱藏欄位：傳送原本的帳號 -->
            <input type=hidden name=id value={$row['id']}>

            <!-- 顯示帳號 -->
            帳號：{$row['id']}
            <br> 

            <!-- 可修改的密碼欄位 -->
            密碼：
            <input type=text name=pwd value={$row['pwd']}>
            <p></p>

            <!-- 送出修改 -->
            <input type=submit value=修改>
        </form>
        ";
    }
    ?>
    </body>
</html>
