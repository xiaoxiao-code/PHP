<?php
$log_file = "access_log.txt";
$results = array(); // 存放筛选结果

// --- 1. 日期时间：获取表单提交的日期范围 ---
$start_date_str = @$_GET['start_date']; // 使用 @ 抑制未设置时的提示
$end_date_str = @$_GET['end_date'];

// 将日期字符串转换为 UNIX 时间戳
$start_ts = strtotime($start_date_str); // 
$end_ts = strtotime($end_date_str);

// --- 2. 文件读取与筛选 ---
if (file_exists($log_file)) { // 
    
    // 将日志文件的每一行读入数组 $lines 
    $lines = file($log_file);
    
    foreach ($lines as $line) {
        // 3. 字符串操作：解析日志行
        // "2025-11-12 08:30:00 | INFO | ..."
        $parts = explode(" | ", $line, 2); // 切割成 2 部分 
        
        if (count($parts) == 2) {
            $log_date_str = trim($parts[0]);
            
            // 4. 日期时间：转换日志时间为时间戳
            $log_ts = strtotime($log_date_str);
            
            // 5. 筛选逻辑
            $keep = true; // 默认显示
            
            if ($start_ts && $log_ts < $start_ts) {
                // 如果设置了开始日期，且日志时间早于开始时间，则不显示
                $keep = false;
            }
            if ($end_ts && $log_ts > ($end_ts + 86400)) { // +86400 包含结束当天的23:59
                // 如果设置了结束日期，且日志时间晚于结束时间，则不显示
                $keep = false;
            }

            if ($keep) {
                $results[] = $line; // 将符合条件的行添加到结果数组
            }
        }
    }
} else {
    $results[] = "错误：日志文件 $log_file 未找到。";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>日志文件日期过滤器</title>
    <style>
        body { font-family: sans-serif; }
        .container { max-width: 700px; margin: 20px auto; }
        .log-display { background: #333; color: #eee; border: 1px solid #000; padding: 10px; white-space: pre-wrap; }
    </style>
</head>
<body>
    <div class="container">
        <h2>日志文件日期过滤器</h2>
        
        <form method="get" action="filter.php">
            <label>开始日期:</label>
            <input type="date" name="start_date" value="<?php echo htmlspecialchars($start_date_str); ?>">
            
            <label>结束日期:</label>
            <input type="date" name="end_date" value="<?php echo htmlspecialchars($end_date_str); ?>">
            
            <input type="submit" value="筛选">
            <a href="filter.php">重置</a>
        </form>

        <div class="log-display">
            <?php
            if (count($results) > 0) {
                foreach ($results as $line) {
                    echo htmlspecialchars($line);
                }
            } else {
                echo "在指定日期范围内没有日志条目。";
            }
            ?>
        </div>
    </div>
</body>
</html>