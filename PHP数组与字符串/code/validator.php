<?php
// 1. 初始化一个空数组，用于收集所有错误信息
$errors = array();
$username = "";
$email = "";

// 2. 检查表单是否已提交
if (isset($_POST['submit'])) {

    // --- 字符串操作：使用 trim() 清理输入 ---
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password']; // 密码通常不清理首尾空格

    // --- 3. 正则表达式与字符串验证 ---
    
    // 验证用户名：必须是5-15个字母、数字或下划线
    // \w 等同于 [a-zA-Z0-9_]
    if (!preg_match('/^\w{5,15}$/', $username)) {
        $errors[] = "用户名必须是 5-15 个字母、数字或下划线。";
    }
    
    // 验证Email：使用更通用的正则表达式
    if (!preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $email)) {
        $errors[] = "Email 格式不正确。";
    }
    
    // 验证密码：使用 strlen() 检查长度 
    if (strlen($password) < 8) {
        $errors[] = "密码必须至少为 8 个字符。";
    }
    
    // 验证密码：使用 preg_match() 检查是否包含数字
    if (!preg_match('/\d/', $password)) {
        $errors[] = "密码必须包含至少一个数字。";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>综合项目一：高级表单验证器</title>
    <style>
        body { font-family: sans-serif; line-height: 1.6; }
        .container { max-width: 500px; margin: 20px auto; padding: 20px; border: 1px solid #ccc; }
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; margin-bottom: 5px; }
        .form-group input { width: 95%; padding: 8px; }
        .errors { color: red; border: 1px solid red; background: #ffeeee; padding: 10px; }
        .success { color: green; border: 1px solid green; background: #eeffee; padding: 10px; }
    </style>
</head>
<body>

    <div class="container">
        <h2>新用户注册</h2>

        <?php
        // 只有在表单已提交 且 错误数组不为空时 才显示
        if (isset($_POST['submit']) && count($errors) > 0) {
            echo '<div class="errors"><strong>注册失败：</strong><ul>';
            // 使用 foreach 遍历数组并输出
            foreach ($errors as $error) {
                echo '<li>' . $error . '</li>';
            }
            echo '</ul></div>';
        }
        
        // 只有在表单已提交 且 错误数组为空时 才显示成功
        if (isset($_POST['submit']) && count($errors) == 0 && !empty($username)) {
            echo '<div class="success"><strong>注册成功！</strong> 欢迎您, ' . htmlspecialchars($username) . '！</div>';
        }
        ?>

        <form method="post" action="">
            <div class="form-group">
                <label for="username">用户名:</label>
                <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($username); ?>">
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="text" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>">
            </div>
            <div class="form-group">
                <label for="password">密码:</label>
                <input type="password" id="password" name="password">
            </div>
            <input type="submit" name="submit" value="注册">
        </form>
    </div>

</body>
</html>