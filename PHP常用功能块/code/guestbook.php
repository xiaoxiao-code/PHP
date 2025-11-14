<?php
$guestbook_file = "guestbook.txt"; // 存储留言的文件

// --- 1. 处理表单提交 (写入文件) ---
if (isset($_POST['submit'])) {
    // 获取并清理数据
    $name = trim($_POST['name']);
    $message = trim($_POST['message']);

    if (!empty($name) && !empty($message)) {
        // 格式化要写入的字符串
        // date('Y-m-d H:i:s') (来自 8.2.3 节的 date() 函数)
        $entry = date('Y-m-d H:i:s') . " | " . $name . ": " . $message . "\n";

        // 使用 file_put_contents() 追加内容
        // FILE_APPEND 标志确保内容被追加到末尾，而不是覆盖 [cite: 1510-1511, 1560-1561]
        file_put_contents($guestbook_file, $entry, FILE_APPEND);
    }
}

// --- 2. 读取留言 (读取文件) ---
$entries = array(); // 初始化一个空数组
if (file_exists($guestbook_file)) { // 
    // file() 将文件的每一行读取为数组的一个元素 
    $entries = file($guestbook_file);
    // 数组反转，让最新的留言显示在最上面 
    $entries = array_reverse($entries);
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>简单访客留言本</title>
    <style>
        body { font-family: sans-serif; }
        .container { max-width: 500px; margin: 20px auto; }
        .form-group { margin-bottom: 10px; }
        .form-group label { display: block; }
        .form-group input, .form-group textarea { width: 98%; }
        .guestbook-entry { background: #f9f9f9; border: 1px solid #ddd; padding: 10px; margin-bottom: 10px; }
    </style>
</head>
<body>

    <div class="container">
        <h2>访客留言本</h2>

        <form method="post" action="guestbook.php">
            <div class="form-group">
                <label for="name">您的昵称:</label>
                <input type="text" id="name" name="name">
            </div>
            <div class="form-group">
                <label for="message">留言内容:</label>
                <textarea id="message" name="message" rows="4"></textarea>
            </div>
            <input type="submit" name="submit" value="提交留言">
        </form>

        <hr>

        <h3>所有留言 (<?php echo count($entries); //?> 条)</h3>
        <div class="entries-list">
            <?php if (count($entries) > 0): ?>
                <?php foreach ($entries as $entry): ?>
                    <div class="guestbook-entry">
                        <?php echo htmlspecialchars($entry); ?>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>暂无留言。</p>
            <?php endif; ?>
        </div>
    </div>

</body>
</html>