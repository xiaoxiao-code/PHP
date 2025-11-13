<?php
// 1. 启动会话
session_start();

// 2. 删除所有会话变量
session_unset();

// 3. 删除会话 (销毁 session_id)
session_destroy();

// 4. 跳转回登录页面
header("Location: login.php");
exit;
?>