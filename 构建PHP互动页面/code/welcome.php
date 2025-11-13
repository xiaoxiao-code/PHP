<?php
// 1. 启动会话以访问 $_SESSION 变量
session_start();

// 2. 会话验证：检查 'user_login' 会话变量是否存在
if (!isset($_SESSION['user_login'])) {
    // 如果不存在，说明未登录，强制跳转回登录页面
    header("Location: login.php");
    exit;
}

// 3. 访问会话变量
$username = $_SESSION['user_login'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>欢迎页面</title>
</head>
<body>

    <h2>欢迎您, <?php echo htmlspecialchars($username); ?>！</h2>
    <p>这是一个受保护的页面。</p>

    <p><a href="logout.php">点击这里退出登录</a></p>

</body>
</html>