<?php
// 1. 启动或恢复会话。必须在所有 HTML 输出之前调用。
session_start();

// 检查是否已提交表单
if (isset($_POST['submit'])) {
    
    // 2. 获取表单数据
    $username = $_POST['username'];
    $password = $_POST['password'];

    // 3. 验证表单数据 (此处为硬编码验证)
    if ($username == 'admin' && $password == '123456') {
        
        // 4. 验证成功：定义会话变量
        $_SESSION['user_login'] = $username;
        
        // 5. PHP页面跳转：重定向到欢迎页面
        header("Location: welcome.php");
        exit; // 确保 header() 后停止执行脚本

    } else {
        
        // 6. PHP 嵌入 JavaScript：验证失败时弹出提示
        $error_message = "用户名或密码错误！";
        echo "<script>alert('{$error_message}');</script>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>用户登录</title>
</head>
<body>

    <h2>请登录</h2>
    
    <form method="post" action="">
        <div>
            <label>用户名:</label>
            <input type="text" name="username">
        </div>
        <div>
            <label>密&nbsp;&nbsp;&nbsp;码:</label>
            <input type="password" name="password">
        </div>
        <input type="submit" name="submit" value="登录">
    </form>

</body>
</html>