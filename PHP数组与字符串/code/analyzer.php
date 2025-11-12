<?php
// 初始化变量
$original_text = "";
$censored_text = "";
$word_count = 0;

// 1. 定义一个敏感词数组
$censor_list = array("banned", "danger", "secret");

// 2. 检查表单是否提交
if (isset($_POST['analyze'])) {
    $original_text = $_POST['comment'];
    
    // --- 3. 字符串与数组操作：过滤敏感词 ---
    // str_replace 可以直接接收一个数组作为查找目标
    $censored_text = str_replace($censor_list, "***", $original_text);

    // --- 4. 正则表达式操作：过滤模式 (例如手机号) ---
    // 匹配 11 位数字
    $phone_pattern = '/\d{11}/';
    $censored_text = preg_replace($phone_pattern, "[PHONE]", $censored_text);
    
    // --- 5. 综合分析：统计词数 ---
    // 统一转小写，以便统计
    $text_to_analyze = strtolower($original_text);
    // 使用 preg_split 按一个或多个非单词字符 (\W+) 拆分，并过滤空值
    $words = preg_split('/\W+/', $text_to_analyze, -1, PREG_SPLIT_NO_EMPTY);
    // 使用 count() 统计数组元素
    $word_count = count($words);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>综合项目二：文本过滤器与分析器</title>
    <style>
        body { font-family: sans-serif; line-height: 1.6; }
        .container { max-width: 600px; margin: 20px auto; padding: 20px; border: 1px solid #ccc; }
        textarea { width: 98%; height: 100px; }
        .results { border-top: 2px dashed #eee; margin-top: 20px; padding-top: 20px; }
        .results pre { background: #f4f4f4; padding: 10px; white-space: pre-wrap; word-wrap: break-word; }
    </style>
</head>
<body>

    <div class="container">
        <h2>文本过滤器与分析器</h2>
        <p>（敏感词: banned, danger, secret | 过滤模式: 11位数字）</p>

        <form method="post" action="">
            <textarea name="comment"><?php echo htmlspecialchars($original_text); ?></textarea>
            <br><br>
            <input type="submit" name="analyze" value="分析与过滤">
        </form>

        <?php if (isset($_POST['analyze'])): ?>
            <div class="results">
                <h3>分析结果：</h3>
                <p>总词数 (大约): <?php echo $word_count; ?></p>
                
                <h3>过滤后文本：</h3>
                <pre><?php echo htmlspecialchars($censored_text); ?></pre>
                
                <h3>原始文本：</h3>
                <pre><?php echo htmlspecialchars($original_text); ?></pre>
            </div>
        <?php endif; ?>
    </div>

</body>
</html>