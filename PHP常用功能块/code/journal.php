<?php
// --- 1. 配置与初始化 ---

// 设置时区为 "PRC" (中华人民共和国) 
date_default_timezone_set('PRC'); 

// 定义日志存储的目录
$log_directory = "journal_logs"; 

// 初始化变量
$message = ""; // 用于反馈
$current_date = date("Y-m-d"); // 获取 "Y-m-d" 格式的当前日期 
$log_content = "";

// --- 2. 目录操作：检查并创建日志目录 ---
if (!is_dir($log_directory)) { // 
    mkdir($log_directory); // 
}

// --- 3. 文件写入：处理表单提交 ---
if (isset($_POST['submit'])) {
    $entry_content = trim($_POST['entry']);
    
    if (!empty($entry_content)) {
        // 获取当前时间 H:i:s 
        $timestamp = date("H:i:s"); 
        
        // 格式化要写入的行
        $log_line = $timestamp . " | " . $entry_content . "\n";
        
        // 定义日志文件名
        $file_path = $log_directory . "/" . $current_date . ".txt";
        
        // 使用 file_put_contents 和 FILE_APPEND 标志追加内容
        // 
        if (file_put_contents($file_path, $log_line, FILE_APPEND | LOCK_EX)) {
            $message = "日志已于 $timestamp 保存。";
        } else {
            $message = "错误：无法写入日志文件。";
        }
    } else {
        $message = "错误：日志内容不能为空。";
    }
}

// --- 4. 文件读取：加载今天的日志 ---
$today_log_file = $log_directory . "/" . $current_date . ".txt";

if (file_exists($today_log_file)) { // 
    // 一次性读取整个文件内容 
    $log_content = file_get_contents($today_log_file);
} else {
    $log_content = "今日暂无日志条目。";
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>每日日志系统</title>
    <style>
        body { font-family: sans-serif; }
        .container { max-width: 600px; margin: 20px auto; }
        textarea { width: 98%; height: 100px; }
        .log-display { background: #f4f4f4; border: 1px solid #ddd; padding: 10px; margin-top: 20px; white-space: pre-wrap; }
        .message { background: #e0ffe0; padding: 10px; }
    </style>
</head>
<body>

    <div class="container">
        <h2>每日日志 - <?php echo $current_date; ?></h2>

        <?php if (!empty($message)) { echo "<p class='message'>$message</p>"; } ?>

        <form method="post" action="journal.php">
            <textarea name="entry" placeholder="在此输入日志内容..."></textarea>
            <br><br>
            <input type="submit" name="submit" value="保存今日日志">
        </form>

        <div class="log-display">
            <h3>今日日志内容：</h3>
            <?php echo htmlspecialchars($log_content); ?>
        </div>
    </div>

</body>
</html>