<?php
// 1. 获取 URL 参数值 (使用 $_GET)
// @ 符号抑制未定义索引的提示
$product_id = @$_GET['id'];
$product_name = @$_GET['name'];

// 2. 处理表单数据 (使用 $_POST)
$comment_result = "";
if (isset($_POST['submit_comment'])) {
    $comment = $_POST['comment'];
    // (此处应有数据库保存操作，项目中简化为 echo)
    $comment_result = "<h4>评论已收到：</h4><p>" . htmlspecialchars($comment) . "</p>";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>商品详情</title>
    
    <script>
    // 参照 "【例 5-8】"
    function validateForm() {
        // 获取表单控件的值
        var comment = document.form1.comment.value;
        
        if (comment == "") {
            // 使用 alert() 方法
            alert("评论内容不能为空！");
            return false; // 阻止表单提交
        }
        
        return true; // 允许表单提交
    }
    </script>
</head>
<body>

    <h1><?php echo htmlspecialchars($product_name); ?></h1>
    <p>商品 ID: <?php echo htmlspecialchars($product_id); ?></p>
    <p>这里是 <?php echo htmlspecialchars($product_name); ?> 的详细描述...</p>
    
    <hr>
    
    <?php echo $comment_result; ?>

    <h3>发表评论</h3>
    <form name="form1" method="post" action="" onsubmit="return validateForm();">
        <textarea name="comment" style="width: 300px; height: 80px;"></textarea>
        <br>
        <input type="submit" name="submit_comment" value="提交评论">
    </form>
    
    <p>
        <a href="product_list.php">返回列表 (HTML跳转)</a>
        |
        <a href="#" onclick="window.history.back(); return false;">返回上一页 (JS跳转)</a>
    </p>

</body>
</html>