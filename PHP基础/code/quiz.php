<!DOCTYPE html>
<html>
<head>
    <title>PHP 基础知识自测</title>
    <style>
        body { font-family: sans-serif; line-height: 1.6; }
        .quiz-form { max-width: 600px; margin: 20px auto; padding: 20px; border: 1px solid #ccc; border-radius: 8px; }
        .question { margin-bottom: 20px; }
        .question p { font-weight: bold; }
        .options div { margin-bottom: 5px; }
        .results { max-width: 600px; margin: 20px auto; padding: 15px; background-color: #f0f9ff; border: 1px solid #b0e0ff; }
    </style>
</head>
<body>

    <div class="quiz-form">
        <h2>PHP 基础知识自测</h2>

        <form method="post" action="">
            
            <div class="question">
                <p>1. 在PHP中，哪个符号用于定义变量？</p>
                <div class="options">
                    <div><input type="radio" name="q1" value="&"> &</div>
                    <div><input type="radio" name="q1" value="$"> $</div>
                    <div><input type="radio" name="q1" value="%"> %</div>
                </div>
            </div>

            <div class="question">
                <p>2. 以下哪些是PHP中的循环语句？ (请选择所有正确答案)</p>
                <div class="options">
                    <div><input type="checkbox" name="q2[]" value="if"> if</div>
                    <div><input type="checkbox" name="q2[]" value="for"> for</div>
                    <div><input type="checkbox" name="q2[]" value="while"> while</div>
                    <div><input type="checkbox" name="q2[]" value="switch"> switch</div>
                </div>
            </div>

            <input type="submit" name="submit" value="提交答案">
        </form>
    </div>

    <?php
    // 检查表单是否已提交
    if (isset($_POST['submit'])) {
        
        // 初始化计分变量
        $score = 0;

        // 批改问题 1 (单选)
        if (isset($_POST['q1'])) {
            $q1_answer = $_POST['q1'];
            if ($q1_answer == "$") {
                $score++; // 正确得1分
            }
        }

        // 批改问题 2 (多选)：正确答案是 for 和 while，且不能选 if 和 switch
        $has_for = false;
        $has_while = false;
        $has_if = false;
        $has_switch = false;
        
        if (isset($_POST['q2'])) {
            foreach ($_POST['q2'] as $answer) {
                switch ($answer) {
                    case 'for': $has_for = true; break;
                    case 'while': $has_while = true; break;
                    case 'if': $has_if = true; break;
                    case 'switch': $has_switch = true; break;
                }
            }
        }
        
        // 满足条件得1分
        if ($has_for && $has_while && !$has_if && !$has_switch) {
            $score++;
        }

        // 输出结果
        echo '<div class="results">';
        echo '<h3>测验结果：</h3>';
        echo "<p>您的得分是： {$score} / 2</p>";
        echo '</div>';
    }
    ?>

</body>
</html>