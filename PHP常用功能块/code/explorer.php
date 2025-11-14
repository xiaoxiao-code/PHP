<?php
// --- 1. 处理表单和URL操作 ---

$message = ""; // 用于向用户显示反馈

// a. 处理创建目录
if (isset($_POST['create_folder'])) {
    $folder_name = trim($_POST['folder_name']);
    if (!empty($folder_name) && !file_exists($folder_name)) {
        if (mkdir($folder_name)) { // 
            $message = "目录 '{$folder_name}' 创建成功！";
        } else {
            $message = "创建目录失败。";
        }
    } elseif (file_exists($folder_name)) {
        $message = "错误：文件或目录 '{$folder_name}' 已存在。";
    } else {
        $message = "错误：目录名不能为空。";
    }
}

// b. 处理删除文件 (使用 GET 参数)
if (isset($_GET['delete_file'])) {
    $file_to_delete = $_GET['delete_file'];
    
    // 安全检查：确保文件存在且不是一个目录
    if (file_exists($file_to_delete) && !is_dir($file_to_delete)) { // [cite: 1792-1793, 1800-1802]
        if (unlink($file_to_delete)) { // 
            $message = "文件 '{$file_to_delete}' 删除成功！";
        } else {
            $message = "删除文件失败。";
        }
    } elseif (is_dir($file_to_delete)) {
        $message = "错误：不能删除目录。";
    } else {
        $message = "错误：文件不存在。";
    }
}

// --- 2. 读取和显示目录内容 ---
$current_dir = "."; // "." 表示当前目录
$files_and_folders = scandir($current_dir); // 

?>
<!DOCTYPE html>
<html>
<head>
    <title>简单文件管理器</title>
    <style>
        body { font-family: sans-serif; }
        .container { max-width: 600px; margin: 20px auto; }
        .file-list { list-style: none; padding: 0; }
        .file-list li { padding: 5px; border-bottom: 1px solid #eee; }
        .file-list li a { color: red; text-decoration: none; float: right; }
        .folder { font-weight: bold; }
        .message { background: #f0f0f0; padding: 10px; margin-bottom: 10px; }
    </style>
</head>
<body>

    <div class="container">
        <h2>文件管理器</h2>
        <p>当前目录: <?php echo getcwd(); // ?></p>

        <?php if (!empty($message)): ?>
            <div class="message"><?php echo $message; ?></div>
        <?php endif; ?>

        <form method="post" action="explorer.php">
            <input type="text" name="folder_name" placeholder="新目录名称">
            <input type="submit" name="create_folder" value="创建目录">
        </form>
        <hr>

        <ul class="file-list">
            <?php foreach ($files_and_folders as $item): ?>
                <?php
                // 忽略 . 和 .. 这两个特殊目录
                if ($item == '.' || $item == '..') continue;
                ?>
                <li>
                    <?php if (is_dir($item)): // ?>
                        <span class="folder">[目录] <?php echo $item; ?></span>
                    <?php else: ?>
                        <span class="file">[文件] <?php echo $item; ?></span>
                        <a href="explorer.php?delete_file=<?php echo urlencode($item); ?>" onclick="return confirm('确认删除 <?php echo $item; ?> 吗？');">删除</a>
                    <?php endif; ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

</body>
</html>