<?php
/**
 * 自定义函数：isPrime()
 * 功能：判断一个数是否为素数（质数）
 * 素数定义：大于1的自然数中，仅能被1和自身整除的数
 */
function isPrime($num) {
    $num = (int)$num; // 强制转换为整数，避免非数字干扰

    // 小于等于1的数不是素数
    if ($num <= 1) {
        return false;
    }

    // 2是唯一的偶数素数
    if ($num == 2) {
        return true;
    }

    // 排除所有偶数（除2外）
    if ($num % 2 == 0) {
        return false;
    }

    // 循环检查：从3开始的奇数，直到num的平方根（优化性能）
    $sqrt = sqrt($num);
    for ($i = 3; $i <= $sqrt; $i += 2) {
        if ($num % $i == 0) {
            return false; // 存在其他因数，不是素数
        }
    }

    return true; // 无其他因数，是素数
}
?>

<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <title>区间素数查找器</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: "Microsoft YaHei", sans-serif;
            line-height: 1.8;
            background-color: #f8f9fa;
            padding: 20px;
        }
        .finder-form {
            max-width: 500px;
            margin: 30px auto;
            padding: 25px;
            background-color: #fff;
            border: 1px solid #eee;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }
        .finder-form h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
            font-size: 20px;
        }
        .finder-form .input-group {
            text-align: center;
            margin-bottom: 20px;
        }
        .finder-form input[type='text'] {
            width: 100px;
            padding: 8px 12px;
            margin: 0 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
        }
        .finder-form input[type='text']::placeholder {
            color: #ccc;
        }
        .finder-form input[type='submit'] {
            padding: 8px 25px;
            background-color: #4299e1;
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .finder-form input[type='submit']:hover {
            background-color: #3182ce;
        }
        .results {
            max-width: 500px;
            margin: 10px auto 30px;
            padding: 20px;
            border-radius: 10px;
            font-size: 16px;
        }
        .success {
            background-color: #e6fffa;
            border: 1px solid #b2f5ea;
            color: #2d3748;
        }
        .error {
            background-color: #fee2e2;
            border: 1px solid #fecaca;
            color: #dc2626;
        }
        .results h3 {
            font-size: 18px;
            margin-bottom: 12px;
        }
    </style>
</head>
<body>

    <div class="finder-form">
        <h2>区间素数查找器</h2>
        <form method="post" action="">
            <div class="input-group">
                请输入范围：
                <input type="text" name="start_num" placeholder="起始数字" required>
                到
                <input type="text" name="end_num" placeholder="结束数字" required>
                <br><br>
                <input type="submit" name="find" value="查找素数">
            </div>
        </form>
    </div>

    <?php
    // 检查表单是否提交
    if (isset($_POST['find'])) {
        // 1. 获取并处理输入（过滤空格，默认空字符串）
        $start_input = trim($_POST['start_num'] ?? '');
        $end_input = trim($_POST['end_num'] ?? '');

        // 2. 校验输入合法性（必须是数字）
        if (!is_numeric($start_input) || !is_numeric($end_input)) {
            echo '<div class="results error">';
            echo '<h3>❌ 输入错误</h3>';
            echo '<p>请输入有效的数字（整数或小数，会自动转为整数）！</p>';
            echo '</div>';
            exit;
        }

        // 3. 转换为整数并修正区间顺序（确保起始值 ≤ 结束值）
        $start = (int)$start_input;
        $end = (int)$end_input;
        $title = ''; // 初始化变量，避免未定义报错

        if ($start > $end) {
            $temp = $start;
            $start = $end;
            $end = $temp;
            $title = "（已自动修正区间为：$start ~ $end）";
        }

        // 4. 查找区间内的素数
        echo '<div class="results success">';
        echo "<h3>✅ 查找结果 $title</h3>";
        echo "<p>在 $start 和 $end 之间的素数：</p>";
        echo "<p style='font-weight: 600; margin-top: 8px;'>";

        $found = false; // 标记是否找到素数
        for ($i = $start; $i <= $end; $i++) {
            if (isPrime($i)) {
                echo $i . "  ";
                $found = true;
            }
        }

        // 未找到素数时的提示
        if (!$found) {
            echo "该区间内没有符合条件的素数";
        }

        echo "</p>";
        echo '</div>';
    }
    ?>

</body>
</html>