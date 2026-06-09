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

        // 查詢指定 bid 的佈告資料
        // $_GET["bid"] 為網址傳來的佈告編號
        $result = mysqli_query(
            $conn,
            "select * from bulletin where bid={$_GET["bid"]}"
        );

        // 將查詢結果取出成陣列
        $row = mysqli_fetch_array($result);

        // 初始化 radio button 的 checked 狀態
        $checked1 = "";
        $checked2 = "";
        $checked3 = "";

        // 根據 type 決定哪個 radio button 要被預設勾選
        if ($row['type'] == 1)
            $checked1 = "checked";

        if ($row['type'] == 2)
            $checked2 = "checked";

        if ($row['type'] == 3)
            $checked3 = "checked";

        // 顯示修改佈告表單
        echo "

        <html>

            <head>
                <title>新增佈告</title>
            </head>

            <body>

                <!-- 表單送出到 27.bulletin_edit.php -->
                <form method=post action=27.bulletin_edit.php>

                    <!-- 顯示佈告編號 -->
                    佈告編號：{$row['bid']}

                    <!-- 隱藏欄位：傳送 bid -->
                    <input type=hidden name=bid value={$row['bid']}>
                    <br>

                    <!-- 修改標題 -->
                    標    題：
                    <input type=text name=title value={$row['title']}>
                    <br>

                    <!-- 修改內容 -->
                    內    容：
                    <br>

                    <textarea name=content rows=20 cols=20>
{$row['content']}
                    </textarea>
                    <br>

                    <!-- 修改佈告類型 -->
                    佈告類型：

                    <!-- type=1：系上公告 -->
                    <input type=radio name=type value=1 {$checked1}>
                    系上公告 

                    <!-- type=2：獲獎資訊 -->
                    <input type=radio name=type value=2 {$checked2}>
                    獲獎資訊

                    <!-- type=3：徵才資訊 -->
                    <input type=radio name=type value=3 {$checked3}>
                    徵才資訊

                    <br>

                    <!-- 修改發布時間 -->
                    發布時間：
                    <input type=date name=time value={$row['time']}>

                    <p></p>

                    <!-- 送出修改 -->
                    <input type=submit value=修改佈告>

                    <!-- 清除表單 -->
                    <input type=reset value=清除>

                </form>
            </body>
        </html>
        ";
    }
?>
