<?php
// 1. 安全获取通过 URL (GET) 传递过来的数据
$XH = isset($_GET["XH"]) ? htmlspecialchars($_GET["XH"]) : '';
$XM = isset($_GET["XM"]) ? htmlspecialchars($_GET["XM"]) : '';
$XB = isset($_GET["SEX"]) ? htmlspecialchars($_GET["SEX"]) : '';
$CSSJ = isset($_GET["Birthday"]) ? htmlspecialchars($_GET["Birthday"]) : '';
$ZY = isset($_GET["ZY"]) ? htmlspecialchars($_GET["ZY"]) : '';
$BZ = isset($_GET["BZ"]) ? htmlspecialchars($_GET["BZ"]) : '';
$XQ = isset($_GET["XQ"]) ? htmlspecialchars($_GET["XQ"]) : '';

// 2. 验证必要字段是否存在（可选，根据需求）
if (empty($XH) || empty($XM)) {
    // 可以添加重定向回表单页面的逻辑
    // header("Location: EX5-1a.php");
    // exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>学生信息确认</title>
    <style>
        /* 使用与 EX5-1a.php 相同的表格样式 */
        table { 
            width: 400px; 
            margin: 20px auto; 
            background: #CCFFCC; 
            border-collapse: collapse; 
            font-family: sans-serif;
        }
        td { 
            border: 1px solid #999; 
            height: 30px; 
            padding: 5px;
        }
        .label { 
            width: 150px; 
            text-align: center; 
            font-weight: bold;
            background: #e0ffe0;
        }
        .value { 
            padding-left: 10px; 
            background: white;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .container {
            text-align: center;
            margin-top: 20px;
        }
        .back-btn {
            padding: 8px 16px;
            background: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .back-btn:hover {
            background: #45a049;
        }
    </style>
</head>
<body>
    <h1>学生信息确认</h1>
    
    <table>
        <tr>
            <td class="label">学号</td>
            <td class="value"><?php echo $XH; ?></td>
        </tr>
        <tr>
            <td class="label">姓名</td>
            <td class="value"><?php echo $XM; ?></td>
        </tr>
        <tr>
            <td class="label">性别</td>
            <td class="value"><?php echo $XB; ?></td>
        </tr>
        <tr>
            <td class="label">出生日期</td>
            <td class="value"><?php echo $CSSJ; ?></td>
        </tr>
        <tr>
            <td class="label">所学专业</td>
            <td class="value"><?php echo $ZY; ?></td>
        </tr>
        <tr>
            <td class="label">备注</td>
            <td class="value"><?php echo !empty($BZ) ? $BZ : '无'; ?></td>
        </tr>
        <tr>
            <td class="label">兴趣</td>
            <td class="value"><?php echo !empty($XQ) ? $XQ : '无'; ?></td>
        </tr>
    </table>
    
    <div class="container">
        <button class="back-btn" onclick="window.history.back()">返回修改</button>
        <button class="back-btn" onclick="window.print()">打印信息</button>
    </div>
</body>
</html>